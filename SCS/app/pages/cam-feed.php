<?php
namespace PHPMaker2024\SCS;

// Create page object
if (!isset($CamFeed)) {
    $CamFeed = new CamFeed();
}

// Run the page
$CamFeed->run();
?>

<div class="card ew-card shadow-lg">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title mb-0">Camera Feed</h3>
    </div>
    <div class="card-body p-4">
        <div class="row">
            <!-- Camera Feed Section -->
            <div class="col-12">
                <div class="camera-container position-relative" style="min-height: 480px;">
                    <video id="video" width="100%" height="480" autoplay muted style="background: #000; border-radius: 12px;"></video>
                    <canvas id="overlay" class="position-absolute top-0 left-0 w-100 h-100"></canvas>
                    
                    <!-- Recognition Info -->
                    <div class="recognition-info position-absolute" style="bottom: 20px; left: 20px; background: rgba(0,0,0,0.8); color: white; padding: 12px; border-radius: 8px; max-width: 300px;">
                        <div class="d-flex align-items-center">
                            <span class="status-indicator" id="statusIndicator"></span>
                            <span id="statusText" class="ms-2">Initializing...</span>
                        </div>
                        <div id="detectionInfo" class="mt-2"></div>
                    </div>
                </div>

                <!-- Camera Controls -->
                <div class="mt-4 text-center">
                    <div class="d-flex gap-3 justify-content-center">
                        <button type="button" class="btn btn-primary btn-lg" id="startButton">
                            <i class="fas fa-camera me-2"></i>Launch Camera
                        </button>
                        <button type="button" class="btn btn-danger btn-lg" id="endButton" style="display:none">
                            <i class="fas fa-stop-circle me-2"></i>Stop Camera
                        </button>
                        <button type="button" class="btn btn-info btn-lg" id="infoButton" data-bs-toggle="modal" data-bs-target="#cameraInfoModal">
                            <i class="fas fa-info-circle me-2"></i>Camera Info
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Camera Info Modal -->
<div class="modal fade" id="cameraInfoModal" tabindex="-1" aria-labelledby="cameraInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cameraInfoModalLabel">Camera Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="cameraDetails" class="overflow-auto" style="max-height: 400px;">
                    <p class="text-muted mb-0">No camera active.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
.status-indicator {
    display: inline-block;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin-right: 8px;
    transition: background-color 0.3s ease;
}
.status-indicator.active { background: #28a745; }
.status-indicator.inactive { background: #dc3545; }
.camera-container { overflow: hidden; border-radius: 12px; }
#video { object-fit: cover; border-radius: 12px; }
.btn { transition: all 0.3s ease; }
.btn:hover { transform: translateY(-2px); }
#cameraDetails::-webkit-scrollbar {
    width: 8px;
}
#cameraDetails::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}
#cameraDetails::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}
#cameraDetails::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>

<!-- JavaScript -->
<script>
$(function() {
    let video;
    let canvas;
    let stream = null;

    // Initialize camera elements
    function initializeCamera() {
        try {
            video = document.getElementById('video');
            canvas = document.getElementById('overlay');
            
            if (!video || !canvas) {
                throw new Error('Video or canvas element not found');
            }

            // Add event listeners
            document.getElementById('startButton').addEventListener('click', startCamera);
            document.getElementById('endButton').addEventListener('click', stopCamera);
            
            updateStatus('Camera ready', true);
        } catch (error) {
            console.error('Initialization error:', error);
            updateStatus('Initialization error: ' + error.message, false);
        }
    }

    // Start camera
    async function startCamera() {
        try {
            // Check if getUserMedia is supported
            if (!navigator.mediaDevices?.getUserMedia) {
                throw new Error('Camera access is not supported in this browser');
            }

            // Request camera access
            stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    width: { ideal: 1280 },
                    height: { ideal: 720 },
                    facingMode: "user"
                }
            });
            
            // Set video source and show stream
            video.srcObject = stream;
            video.style.display = 'block';
            
            // Update UI
            document.getElementById('startButton').style.display = 'none';
            document.getElementById('endButton').style.display = 'inline-block';
            
            // Add stream info to the camera details panel
            const track = stream.getVideoTracks()[0];
            const settings = track.getSettings();
            document.getElementById('cameraDetails').innerHTML = `
                <p><strong>Camera:</strong> ${track.label}</p>
                <p><strong>Resolution:</strong> ${settings.width}x${settings.height}</p>
                <p><strong>Frame Rate:</strong> ${settings.frameRate}fps</p>
            `;

            updateStatus('Camera active', true);
        } catch (error) {
            console.error('Camera error:', error);
            ew.alert('Could not access camera: ' + error.message);
            updateStatus('Camera error', false);
        }
    }

    // Stop camera
    function stopCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
            video.srcObject = null;
            
            // Update UI
            document.getElementById('startButton').style.display = 'inline-block';
            document.getElementById('endButton').style.display = 'none';
            document.getElementById('cameraDetails').innerHTML = '<p class="text-muted mb-0">No camera active.</p>';
            
            updateStatus('Camera stopped', false);
        }
    }

    // Update status indicator
    function updateStatus(message, isActive) {
        const statusIndicator = document.getElementById('statusIndicator');
        const statusText = document.getElementById('statusText');
        
        if (statusIndicator && statusText) {
            statusIndicator.className = 'status-indicator ' + (isActive ? 'active' : 'inactive');
            statusText.textContent = message;
        }
    }

    // Handle page visibility change
    document.addEventListener('visibilitychange', () => {
        if (document.hidden && stream) {
            stopCamera();
        }
    });

    // Initialize when page is ready
    initializeCamera();
});
</script>