<?php
/**
 * Main Dashboard For AMS (Asset Management System)
 */
namespace PHPMaker2024\AMS;

// Key Metrics - Active Towers and Equipment
$activeTowers = ExecuteScalar("
    SELECT COUNT(*) 
    FROM towers 
    WHERE status_id IN (
        SELECT status_id 
        FROM status_types 
        WHERE category = 'tower' 
        AND name = 'Active'
    )", "philtower_ams");

$totalEquipment = ExecuteScalar("
    SELECT COUNT(*) 
    FROM tower_equipment 
    WHERE is_active = TRUE", "philtower_ams");

$maintenanceRequired = ExecuteScalar("
    SELECT COUNT(*) 
    FROM tower_equipment 
    WHERE next_maintenance <= CURRENT_DATE + INTERVAL '7 days'
    AND is_active = TRUE", "philtower_ams");

$activeAlerts = ExecuteScalar("
    SELECT COUNT(*) 
    FROM maintenance_findings 
    WHERE severity = 'High' 
    AND created_at >= CURRENT_DATE - INTERVAL '24 hours'", "philtower_ams");

// Tower Status with Location Data
$towerStatus = ExecuteRowsAssociative("
    SELECT 
        t.tower_id,
        t.name,
        t.code,
        t.height,
        t.latitude,
        t.longitude,
        tt.name as tower_type,
        st.name as status,
        st.color_code,
        COUNT(te.equipment_id) as equipment_count,
        COUNT(CASE WHEN te.next_maintenance <= CURRENT_DATE + INTERVAL '7 days' 
              THEN 1 END) as maintenance_needed
    FROM towers t
    JOIN tower_types tt ON t.type_id = tt.type_id
    JOIN status_types st ON t.status_id = st.status_id
    LEFT JOIN tower_equipment te ON t.tower_id = te.tower_id
    GROUP BY t.tower_id, t.name, t.code, t.height, t.latitude, t.longitude, 
             tt.name, st.name, st.color_code
    ORDER BY t.code", "philtower_ams");

// Equipment Status Summary
$equipmentStatus = ExecuteRowsAssociative("
    SELECT 
        et.name as equipment_type,
        COUNT(te.equipment_id) as total_count,
        COUNT(CASE WHEN te.status_id IN (
            SELECT status_id FROM status_types 
            WHERE category = 'equipment' AND name = 'Operational'
        ) THEN 1 END) as operational_count,
        COUNT(CASE WHEN te.next_maintenance <= CURRENT_DATE + INTERVAL '7 days' 
              THEN 1 END) as maintenance_needed
    FROM equipment_types et
    LEFT JOIN tower_equipment te ON et.type_id = te.model_id
    GROUP BY et.type_id, et.name
    ORDER BY et.name", "philtower_ams");

// Recent Maintenance Activities
$recentMaintenance = ExecuteRowsAssociative("
    SELECT 
        ml.log_id,
        t.name as tower_name,
        t.code as tower_code,
        mt.name as maintenance_type,
        ml.start_time,
        ml.end_time,
        st.name as status,
        st.color_code,
        string_agg(mf.description, '; ') as findings
    FROM maintenance_logs ml
    JOIN maintenance_schedules ms ON ml.schedule_id = ms.schedule_id
    JOIN tower_equipment te ON ms.equipment_id = te.equipment_id
    JOIN towers t ON te.tower_id = t.tower_id
    JOIN maintenance_types mt ON ms.maintenance_type_id = mt.type_id
    JOIN status_types st ON ml.status_id = st.status_id
    LEFT JOIN maintenance_findings mf ON ml.log_id = mf.log_id
    WHERE ml.created_at >= CURRENT_DATE - INTERVAL '7 days'
    GROUP BY ml.log_id, t.name, t.code, mt.name, ml.start_time, ml.end_time, 
             st.name, st.color_code
    ORDER BY ml.start_time DESC
    LIMIT 10", "philtower_ams");

// Equipment Distribution by Type
$equipmentDistribution = ExecuteRowsAssociative("
    SELECT 
        et.name as type_name,
        COUNT(te.equipment_id) as count,
        string_agg(DISTINCT m.name, ', ') as manufacturers
    FROM equipment_types et
    LEFT JOIN equipment_models em ON et.type_id = em.type_id
    LEFT JOIN manufacturers m ON em.manufacturer_id = m.manufacturer_id
    LEFT JOIN tower_equipment te ON em.model_id = te.model_id
    GROUP BY et.type_id, et.name
    ORDER BY count DESC", "philtower_ams");

// Maintenance Team Performance
$teamPerformance = ExecuteRowsAssociative("
    SELECT 
        mt.name as team_name,
        COUNT(ml.log_id) as completed_tasks,
        AVG(EXTRACT(EPOCH FROM (ml.end_time - ml.start_time))/3600)::numeric(10,2) as avg_duration,
        COUNT(CASE WHEN mf.severity = 'High' THEN 1 END) as critical_findings
    FROM maintenance_teams mt
    LEFT JOIN team_members tm ON mt.team_id = tm.team_id
    LEFT JOIN maintenance_logs ml ON tm.user_id = ml.performed_by
    LEFT JOIN maintenance_findings mf ON ml.log_id = mf.log_id
    WHERE ml.created_at >= CURRENT_DATE - INTERVAL '30 days'
    GROUP BY mt.team_id, mt.name
    ORDER BY completed_tasks DESC", "philtower_ams");

// Create GeoJSON for towers
$features = [];
foreach ($towerStatus as $tower) {
    $features[] = [
        'type' => 'Feature',
        'geometry' => [
            'type' => 'Point',
            'coordinates' => [$tower['longitude'], $tower['latitude']]
        ],
        'properties' => [
            'tower_id' => $tower['tower_id'],
            'name' => $tower['name'],
            'code' => $tower['code'],
            'type' => $tower['tower_type'],
            'status' => $tower['status'],
            'color' => $tower['color_code'],
            'equipment_count' => $tower['equipment_count'],
            'maintenance_needed' => $tower['maintenance_needed']
        ]
    ];
}

$towerGeoJson = json_encode([
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
                <span class="info-box-icon bg-info"><i class="fas fa-broadcast-tower"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Active Towers</span>
                    <span class="info-box-number"><?= $activeTowers ?></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-server"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Equipment</span>
                    <span class="info-box-number"><?= $totalEquipment ?></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-tools"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Maintenance Required</span>
                    <span class="info-box-number"><?= $maintenanceRequired ?></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-exclamation-triangle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Active Alerts</span>
                    <span class="info-box-number"><?= $activeAlerts ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Tower Map -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tower Network Map</h3>
                </div>
                <div class="card-body">
                    <div id="towerMap" style="height: 500px;"></div>
                </div>
            </div>
        </div>

        <!-- Equipment Status -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Equipment Status</h3>
                </div>
                <div class="card-body">
                    <canvas id="equipmentStatusChart"></canvas>
                </div>
            </div>

            <!-- Recent Maintenance -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Maintenance</h3>
                </div>
                <div class="card-body p-0">
                    <div class="timeline timeline-inverse">
                        <?php foreach ($recentMaintenance as $maintenance): ?>
                        <div>
                            <i class="fas fa-tools bg-primary"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    <i class="far fa-clock"></i> 
                                    <?= date('H:i', strtotime($maintenance['start_time'])) ?>
                                </span>
                                <h3 class="timeline-header">
                                    <?= $maintenance['tower_code'] ?> - <?= $maintenance['maintenance_type'] ?>
                                </h3>
                                <div class="timeline-body">
                                    <?= $maintenance['findings'] ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Equipment Distribution -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Equipment Distribution</h3>
                </div>
                <div class="card-body">
                    <canvas id="equipmentDistributionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Team Performance -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Maintenance Team Performance</h3>
                </div>
                <div class="card-body">
                    <canvas id="teamPerformanceChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Required Scripts -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Leaflet map
    var map = L.map('towerMap').setView([14.669935, 120.983336], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Add tower markers
    var towers = <?= $towerGeoJson ?>;
    
    L.geoJSON(towers, {
        pointToLayer: function(feature, latlng) {
            return L.marker(latlng, {
                icon: L.divIcon({
                    className: 'tower-marker',
                    html: `<div style="background-color: ${feature.properties.color}" 
                          class="marker-pin">
                            <i class="fas fa-broadcast-tower"></i>
                          </div>`,
                    iconSize: [30, 30],
                    iconAnchor: [15, 30]
                })
            });
        },
        onEachFeature: function(feature, layer) {
            layer.bindPopup(`
                <div class="tower-popup">
                    <h4>${feature.properties.name}</h4>
                    <p>Code: ${feature.properties.code}</p>
                    <p>Type: ${feature.properties.type}</p>
                    <p>Status: ${feature.properties.status}</p>
                    <p>Equipment: ${feature.properties.equipment_count}</p>
                    <p>Maintenance Needed: ${feature.properties.maintenance_needed}</p>
                </div>
            `);
        }
    }).addTo(map);

    // Equipment Status Chart
    var equipmentCtx = document.getElementById('equipmentStatusChart').getContext('2d');
    new Chart(equipmentCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($equipmentStatus, 'equipment_type')) ?>,
            datasets: [{
                label: 'Total',
                data: <?= json_encode(array_column($equipmentStatus, 'total_count')) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Operational',
                data: <?= json_encode(array_column($equipmentStatus, 'operational_count')) ?>,
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
            }
        }
    });

    // Equipment Distribution Chart
    var distributionCtx = document.getElementById('equipmentDistributionChart').getContext('2d');
    new Chart(distributionCtx, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(array_column($equipmentDistribution, 'type_name')) ?>,
            datasets: [{
                data: <?= json_encode(array_column($equipmentDistribution, 'count')) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: true,
                    text: 'Equipment Type Distribution'
                }
            }
        }
    });

    // Team Performance Chart
    var performanceCtx = document.getElementById('teamPerformanceChart').getContext('2d');
    new Chart(performanceCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($teamPerformance, 'team_name')) ?>,
            datasets: [{
                label: 'Completed Tasks',
                data: <?= json_encode(array_column($teamPerformance, 'completed_tasks')) ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }, {
                label: 'Critical Findings',
                data: <?= json_encode(array_column($teamPerformance, 'critical_findings')) ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
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
                    text: 'Team Performance (Last 30 Days)'
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
.tower-marker {
    text-align: center;
}

.marker-pin {
    width: 30px;
    height: 30px;
    border-radius: 50% 50% 50% 0;
    position: relative;
    transform: rotate(-45deg);
    display: flex;
    align-items: center;
    justify-content: center;
}

.marker-pin i {
    transform: rotate(45deg);
    color: white;
}

.tower-popup {
    padding: 5px;
}

.tower-popup h4 {
    margin: 0 0 5px 0;
    color: #333;
    font-size: 1.1em;
}

.tower-popup p {
    margin: 0 0 3px 0;
    color: #666;
}

.timeline {
    margin: 0;
    padding: 0;
    position: relative;
    max-height: 400px;
    overflow-y: auto;
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

.timeline > div > .fa,
.timeline > div > .fas,
.timeline > div > .far {
    width: 30px;
    height: 30px;
    font-size: 15px;
    line-height: 30px;
    position: absolute;
    border-radius: 50%;
    text-align: center;
    left: 18px;
    top: 0;
}

.timeline > div {
    margin-right: 10px;
    margin-left: 70px;
    margin-bottom: 15px;
    position: relative;
}

.timeline > div > .timeline-item {
    margin-top: 0;
    border-radius: 3px;
    margin-left: 0;
    margin-right: 0;
    margin-bottom: 15px;
    padding: 0;
    position: relative;
    background: #fff;
    border: 1px solid #ddd;
    width: 100%;
    box-shadow: 0 1px 3px rgba(0,0,0,.1);
}

.timeline > div > .timeline-item > .time {
    float: right;
    padding: 10px;
    font-size: .7rem;
}

.timeline > div > .timeline-item > .timeline-header {
    margin: 0;
    color: #555;
    border-bottom: 1px solid #f4f4f4;
    padding: 10px;
    font-size: 1rem;
    line-height: 1.1;
    font-weight: 600;
}

.timeline > div > .timeline-item > .timeline-body {
    padding: 10px;
    color: #666;
}

.info-box {
    min-height: 100px;
}

.card {
    margin-bottom: 1.5rem;
}

.card-header {
    background-color: rgba(0,0,0,.03);
}

#towerMap {
    border-radius: 3px;
}

@media (max-width: 767.98px) {
    .timeline {
        margin: 0;
        padding: 0;
    }
    
    .timeline > div {
        margin-left: 50px;
    }
    
    .timeline > div > .timeline-item {
        margin-left: 0;
    }
}
</style>