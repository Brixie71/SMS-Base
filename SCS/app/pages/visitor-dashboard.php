<?php
/**
 * Visitor Management Dashboard
 * System: Security Management System (SMS)
 */
namespace PHPMaker2024\SCS;

// Ensure user is authenticated
if (!$Security->isLoggedIn()) {
    return;
}

// Initialize variables
$visitorStats = ['known_visitors' => 0, 'unknown_visitors' => 0];
$visitorFrequency = [];
$recentVisitors = [];

try {
    // Get visitor frequency data for the last 30 days
    $visitorFrequency = ExecuteRowsAssociative("
        WITH RECURSIVE date_range AS (
            SELECT DATE_TRUNC('day', CURRENT_DATE - INTERVAL '29 days') AS date
            UNION ALL
            SELECT date + INTERVAL '1 day'
            FROM date_range
            WHERE date < CURRENT_DATE
        )
        SELECT 
            TO_CHAR(dr.date, 'YYYY-MM-DD') as visit_date,
            COALESCE(COUNT(DISTINCT al.employee_id), 0) as visitor_count
        FROM date_range dr
        LEFT JOIN access_logs al ON DATE_TRUNC('day', al.timestamp) = dr.date
            AND al.access_type = 'Entry'
            AND al.status = 'Granted'
        GROUP BY dr.date
        ORDER BY dr.date
    ", "philtower_sms");

    // Get known vs unknown visitors stats
    $visitorStatsResult = ExecuteRowAssociative("
        SELECT 
            COUNT(DISTINCT CASE WHEN ac.employee_id IS NOT NULL THEN al.employee_id END) as known_visitors,
            COUNT(DISTINCT CASE WHEN ac.employee_id IS NULL THEN al.employee_id END) as unknown_visitors
        FROM access_logs al
        LEFT JOIN access_cards ac ON al.card_id = ac.card_id
        WHERE al.timestamp >= CURRENT_DATE - INTERVAL '30 days'
        AND al.access_type = 'Entry'
    ", "philtower_sms");

    if ($visitorStatsResult) {
        $visitorStats = $visitorStatsResult;
    }

    // Get recent visitor activity
    $recentVisitors = ExecuteRowsAssociative("
        SELECT 
            al.employee_id,
            al.timestamp,
            al.access_type,
            al.status,
            al.verification_method,
            ap.name as access_point,
            sz.name as zone_name
        FROM access_logs al
        JOIN access_points ap ON al.point_id = ap.point_id
        JOIN security_zones sz ON ap.zone_id = sz.zone_id
        WHERE al.timestamp >= CURRENT_DATE - INTERVAL '24 hours'
        ORDER BY al.timestamp DESC
        LIMIT 10
    ", "philtower_sms");

    // Prepare chart data
    $chartLabels = array_column($visitorFrequency, 'visit_date');
    $visitorCounts = array_column($visitorFrequency, 'visitor_count');

    $chartData = [
        'labels' => $chartLabels,
        'datasets' => [
            [
                'label' => 'Daily Visitors',
                'data' => $visitorCounts,
                'borderColor' => 'rgba(60,141,188,0.8)',
                'backgroundColor' => 'rgba(60,141,188,0.1)',
                'fill' => true
            ]
        ]
    ];

    $knownUnknownData = [
        'labels' => ['Known Visitors', 'Unknown Visitors'],
        'datasets' => [
            [
                'data' => [
                    intval($visitorStats['known_visitors'] ?? 0),
                    intval($visitorStats['unknown_visitors'] ?? 0)
                ],
                'backgroundColor' => ['#00a65a', '#f56954']
            ]
        ]
    ];

} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Error accessing database: " . htmlspecialchars($e->getMessage()) . "</div>";
}

// URLs for quick actions
$manageAccessCardsUrl = GetUrl("AccessCardsList");
$manageAccessPointsUrl = GetUrl("AccessPointsList");
$viewAccessLogsUrl = GetUrl("AccessLogsList");
?>


<!-- Rest of your existing HTML/JavaScript code remains exactly the same -->

<!-- Main content -->
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Visitors (30 Days)</span>
                    <span class="info-box-number">
                        <?php echo number_format(($visitorStats['known_visitors'] ?? 0) + ($visitorStats['unknown_visitors'] ?? 0)); ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Known Visitors</span>
                    <span class="info-box-number">
                        <?php echo number_format($visitorStats['known_visitors'] ?? 0); ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-question"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Unknown Visitors</span>
                    <span class="info-box-number"><?php echo number_format($visitorStats['unknown_visitors'] ?? 0); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Visitor Frequency Chart -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Visitor Frequency (Last 30 Days)</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="visitorFrequencyChart" style="min-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Visitor Activity -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Visitor Activity</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Visitor ID</th>
                                <th>Access Point</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Method</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($recentVisitors)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No recent visitor activity</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($recentVisitors as $visitor): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($visitor['timestamp']))); ?></td>
                                    <td><?php echo htmlspecialchars($visitor['employee_id']); ?></td>
                                    <td><?php echo htmlspecialchars($visitor['access_point']); ?></td>
                                    <td>
                                        <span class="badge badge-<?php echo $visitor['access_type'] === 'Entry' ? 'success' : 'info'; ?>">
                                            <?php echo htmlspecialchars($visitor['access_type']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-<?php echo $visitor['status'] === 'Granted' ? 'success' : 'danger'; ?>">
                                            <?php echo htmlspecialchars($visitor['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($visitor['verification_method']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Known vs Unknown Visitors -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Visitor Distribution</h3>
                </div>
                <div class="card-body">
                    <canvas id="visitorDistributionChart"></canvas>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Actions</h3>
                </div>
                <div class="card-body d-grid">
                    <a href="<?php echo htmlspecialchars($manageAccessCardsUrl); ?>" class="btn btn-primary btn-block mb-3">
                        <i class="fas fa-id-card mr-2"></i> Manage Access Cards
                    </a>
                    <a href="<?php echo htmlspecialchars($manageAccessPointsUrl); ?>" class="btn btn-info btn-block mb-3">
                        <i class="fas fa-door-open mr-2"></i> Manage Access Points
                    </a>
                    <a href="<?php echo htmlspecialchars($viewAccessLogsUrl); ?>" class="btn btn-secondary btn-block">
                        <i class="fas fa-history mr-2"></i> View Access Logs
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Visitor Frequency Chart
    var frequencyCtx = document.getElementById('visitorFrequencyChart').getContext('2d');
    new Chart(frequencyCtx, {
        type: 'line',
        data: <?php echo json_encode($chartData); ?>,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });

    // Visitor Distribution Chart
    var distributionCtx = document.getElementById('visitorDistributionChart').getContext('2d');
    new Chart(distributionCtx, {
        type: 'pie',
        data: <?php echo json_encode($knownUnknownData); ?>,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
});
</script>