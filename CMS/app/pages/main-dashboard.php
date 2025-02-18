<?php
/**
 * Main Dashboard For CMS (Client Management System)
 */
namespace PHPMaker2024\CMS;

// Key Metrics - Active Clients and Contracts
$activeClients = ExecuteScalar("
    SELECT COUNT(*) 
    FROM clients 
    WHERE status = 'Active'", "philtower_cms");

$activeContracts = ExecuteScalar("
    SELECT COUNT(*) 
    FROM client_contracts 
    WHERE status = 'Active' 
    AND CURRENT_DATE BETWEEN start_date AND end_date", "philtower_cms");

$expiringContracts = ExecuteScalar("
    SELECT COUNT(*) 
    FROM client_contracts 
    WHERE status = 'Active' 
    AND end_date BETWEEN CURRENT_DATE AND (CURRENT_DATE + INTERVAL '90 days')", "philtower_cms");

$openTickets = ExecuteScalar("
    SELECT COUNT(*) 
    FROM support_tickets 
    WHERE status NOT IN ('Closed', 'Resolved')", "philtower_cms");

// Client Status Summary
$clientSummary = ExecuteRowsAssociative("
    SELECT 
        ct.name as client_type,
        COUNT(c.client_id) as total_clients,
        COUNT(cc.contract_id) as active_contracts,
        COUNT(ce.equipment_id) as total_equipment,
        string_agg(DISTINCT c.client_code, ', ') as client_codes
    FROM client_types ct
    LEFT JOIN clients c ON ct.type_id = c.type_id AND c.status = 'Active'
    LEFT JOIN client_contracts cc ON c.client_id = cc.client_id 
        AND cc.status = 'Active'
        AND CURRENT_DATE BETWEEN cc.start_date AND cc.end_date
    LEFT JOIN client_equipment ce ON c.client_id = ce.client_id 
        AND ce.status = 'Active'
    GROUP BY ct.type_id, ct.name
    ORDER BY ct.priority_level", "philtower_cms");

// Contract Expiry Timeline
$contractTimeline = ExecuteRowsAssociative("
    SELECT 
        c.client_code,
        c.company_name,
        cc.contract_code,
        cc.start_date,
        cc.end_date,
        cc.service_level,
        COUNT(cs.service_id) as services_count
    FROM client_contracts cc
    JOIN clients c ON cc.client_id = c.client_id
    LEFT JOIN contract_services cs ON cc.contract_id = cs.contract_id
    WHERE cc.status = 'Active'
    AND cc.end_date >= CURRENT_DATE
    GROUP BY c.client_code, c.company_name, cc.contract_code, 
             cc.start_date, cc.end_date, cc.service_level
    ORDER BY cc.end_date
    LIMIT 10", "philtower_cms");

// Service Level Performance
$slaPerformance = ExecuteRowsAssociative("
    SELECT 
        c.client_code,
        st.priority,
        COUNT(*) as total_tickets,
        AVG(response_time_minutes)::integer as avg_response_time,
        COUNT(CASE WHEN sla_compliant THEN 1 END) as compliant_tickets,
        ROUND(COUNT(CASE WHEN sla_compliant THEN 1 END)::decimal / 
              COUNT(*)::decimal * 100, 2) as compliance_rate
    FROM support_tickets st
    JOIN clients c ON st.client_id = c.client_id
    WHERE st.created_at >= CURRENT_DATE - INTERVAL '30 days'
    GROUP BY c.client_code, st.priority
    ORDER BY c.client_code, st.priority", "philtower_cms");

// Recent Support Tickets
$recentTickets = ExecuteRowsAssociative("
    SELECT 
        st.ticket_id,
        c.client_code,
        st.subject,
        st.priority,
        st.status,
        st.created_at,
        COALESCE(st.response_time_minutes, 0) as response_time,
        st.sla_compliant
    FROM support_tickets st
    JOIN clients c ON st.client_id = c.client_id
    WHERE st.created_at >= CURRENT_DATE - INTERVAL '7 days'
    ORDER BY st.created_at DESC
    LIMIT 10", "philtower_cms");

// Equipment Distribution by Client
$equipmentDistribution = ExecuteRowsAssociative("
    SELECT 
        c.client_code,
        c.company_name,
        COUNT(ce.equipment_id) as total_equipment,
        COUNT(CASE WHEN ce.status = 'Active' THEN 1 END) as active_equipment,
        COUNT(CASE WHEN ce.next_maintenance_date <= CURRENT_DATE + INTERVAL '30 days' 
              THEN 1 END) as maintenance_due
    FROM clients c
    LEFT JOIN client_equipment ce ON c.client_id = ce.client_id
    WHERE c.status = 'Active'
    GROUP BY c.client_id, c.client_code, c.company_name
    HAVING COUNT(ce.equipment_id) > 0
    ORDER BY total_equipment DESC", "philtower_cms");

// Create GeoJSON for active client equipment locations
$features = [];
foreach ($equipmentDistribution as $client) {
    // Note: In practice, you'd get actual coordinates from your equipment records
    $features[] = [
        'type' => 'Feature',
        'properties' => [
            'client_code' => $client['client_code'],
            'company_name' => $client['company_name'],
            'total_equipment' => $client['total_equipment'],
            'active_equipment' => $client['active_equipment'],
            'maintenance_due' => $client['maintenance_due']
        ]
    ];
}

$clientGeoJson = json_encode([
    'type' => 'FeatureCollection',
    'features' => $features
]);
?>

<!-- Main Dashboard Content -->
<div class="container-fluid">
    <!-- Key Metrics -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-building"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Active Clients</span>
                    <span class="info-box-number"><?= $activeClients ?></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-file-contract"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Active Contracts</span>
                    <span class="info-box-number"><?= $activeContracts ?></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Expiring Soon</span>
                    <span class="info-box-number"><?= $expiringContracts ?></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-ticket-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Open Tickets</span>
                    <span class="info-box-number"><?= $openTickets ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Client Summary -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Client Overview</h3>
                </div>
                <div class="card-body">
                    <canvas id="clientSummaryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- SLA Performance -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SLA Performance</h3>
                </div>
                <div class="card-body">
                    <canvas id="slaPerformanceChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Contract Timeline -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contract Timeline</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Contract</th>
                                    <th>Level</th>
                                    <th>Expires</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($contractTimeline as $contract): 
                                    $daysUntilExpiry = (strtotime($contract['end_date']) - time()) / (60 * 60 * 24);
                                    $statusClass = $daysUntilExpiry <= 90 ? 'warning' : 
                                                 ($daysUntilExpiry <= 30 ? 'danger' : 'success');
                                ?>
                                <tr>
                                    <td><?= $contract['company_name'] ?></td>
                                    <td><?= $contract['contract_code'] ?></td>
                                    <td><?= $contract['service_level'] ?></td>
                                    <td><?= date('Y-m-d', strtotime($contract['end_date'])) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $statusClass ?>">
                                            <?= ceil($daysUntilExpiry) ?> days
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Tickets -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Support Tickets</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>SLA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentTickets as $ticket): ?>
                                <tr>
                                    <td><?= $ticket['client_code'] ?></td>
                                    <td>
                                        <span class="badge bg-<?= strtolower($ticket['priority']) === 'high' ? 'danger' : 
                                                             (strtolower($ticket['priority']) === 'medium' ? 'warning' : 'info') ?>">
                                            <?= $ticket['priority'] ?>
                                        </span>
                                    </td>
                                    <td><?= $ticket['status'] ?></td>
                                    <td>
                                        <i class="fas fa-<?= $ticket['sla_compliant'] ? 'check text-success' : 'times text-danger' ?>"></i>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Equipment Distribution -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Equipment Distribution</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Total Equipment</th>
                                    <th>Active</th>
                                    <th>Maintenance Due</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($equipmentDistribution as $dist): ?>
                                <tr>
                                    <td><?= $dist['company_name'] ?></td>
                                    <td><?= $dist['total_equipment'] ?></td>
                                    <td><?= $dist['active_equipment'] ?></td>
                                    <td><?= $dist['maintenance_due'] ?></td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" style="width: <?= ($dist['active_equipment'] / $dist['total_equipment'] * 100) ?>%">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Required Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Client Summary Chart
    var clientCtx = document.getElementById('clientSummaryChart').getContext('2d');
    new Chart(clientCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($clientSummary, 'client_type')) ?>,
            datasets: [{
                label: 'Total Clients',
                data: <?= json_encode(array_column($clientSummary, 'total_clients')) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Active Contracts',
                data: <?= json_encode(array_column($clientSummary, 'active_contracts')) ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Client Distribution by Type'
                }
            }
        }
    });

    // SLA Performance Chart
    var slaCtx = document.getElementById('slaPerformanceChart').getContext('2d');
    new Chart(slaCtx, {
        type: 'line',
        data: {
            labels: <?= json_encode(array_column($slaPerformance, 'client_code')) ?>,
            datasets: [{
                label: 'Compliance Rate (%)',
                data: <?= json_encode(array_column($slaPerformance, 'compliance_rate')) ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'SLA Compliance %'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: '30-Day SLA Performance'
                }
            }
        }
    });

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Auto-refresh dashboard every 5 minutes
    setInterval(function() {
        window.location.reload();
    }, 300000);
});
</script>

<style>
.info-box {
    min-height: 100px;
    background: #fff;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-radius: 2px;
    margin-bottom: 15px;
}

.info-box-icon {
    border-top-left-radius: 2px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 2px;
    display: block;
    float: left;
    height: 100px;
    width: 90px;
    text-align: center;
    font-size: 45px;
    line-height: 90px;
    background: rgba(0,0,0,0.2);
}

.info-box-content {
    padding: 5px 10px;
    margin-left: 90px;
}

.info-box-text {
    display: block;
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-transform: uppercase;
}

.info-box-number {
    display: block;
    font-weight: bold;
    font-size: 18px;
}

.card {
    margin-bottom: 1.5rem;
}

.progress {
    height: 20px;
}

.badge {
    font-size: 0.9em;
    padding: 5px 10px;
}

.timeline {
    position: relative;
    margin: 0 0 30px 0;
    padding: 0;
    list-style: none;
}

.timeline:before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    width: 4px;
    background: #ddd;
    left: 31px;
    margin: 0;
    border-radius: 2px;
}

.table td, .table th {
    padding: 0.75rem;
    vertical-align: middle;
}

.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,.075);
}

.card-header {
    background-color: rgba(0,0,0,.03);
    border-bottom: 1px solid rgba(0,0,0,.125);
    padding: 0.75rem 1.25rem;
    position: relative;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}

.table-responsive {
    max-height: 400px;
    overflow-y: auto;
}

@media (max-width: 767.98px) {
    .info-box-content {
        margin-left: 80px;
    }

    .info-box-icon {
        width: 80px;
        height: 90px;
        line-height: 80px;
    }
}
</style>