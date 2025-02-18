<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhilTower PRIME Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@400;600&family=Inria+Sans:wght@400;700&display=swap');
        
        :root {
            --tower-blue: #0033a0;    /* From the logo's blue section */
            --tower-red: #ff0000;     /* From the logo's red section */
            --tower-yellow: #ffd700;  /* From the logo's yellow section */
            --tower-light: #f8f9fa;
        }

        .logo {
            max-width: 300px;
            height: auto;
            margin-bottom: 20px;
        }


        body {
            background-color: var(--tower-light);
            font-family: "Inria Sans", sans-serif;
        }

        .system-card {
            transition: all 0.3s ease;
            border-radius: 15px;
            height: 100%;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .system-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(26, 35, 126, 0.15);
            border-color: var(--tower-yellow);
        }

        .btn-primary {
            background-color: var(--tower-blue);
            border-color: var(--tower-blue);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--tower-red);
            border-color: var(--tower-red);
        }

        .system-subtitle {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
        }

        .display-4 {
            color: var(--tower-blue);
        }

        .lead {
            color: var(--tower-red);
        }

        .card-title {
            color: var(--tower-blue);
            font-weight: bold;
        }

        .system-card:hover .card-title {
            color: var(--tower-red);
        }

        .system-icon {
            max-width: 120px;
            height: auto;
            margin-bottom: 0rem;
        }

        .card-text {
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="text-center mb-5">
            <img src="../_shared/images/philtower-logo.svg" alt="PhilTower Logo" class="logo">
            <h1 class="display-4">PhilTower PRIME</h1>
            <p class="lead">Property & Resource Integrated Management Environment</p>
        </div>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col">
                <div class="card system-card">
                    <div class="card-body text-center d-flex flex-column">
                        <img src="../_shared/images/prime-uac-detailed.svg" alt="UAC" class="system-icon mx-auto">
                        <h5 class="card-title">User Access Control</h5>
                        <p class="system-subtitle"></p>
                        <p class="card-text flex-grow-1">Authentication & Security System</p>
                        <a href="/UAC" class="btn btn-primary mt-auto">Access System</a>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card system-card">
                    <div class="card-body text-center d-flex flex-column">
                        <img src="../_shared/images/prime-ccs-detailed.svg" alt="CCS" class="system-icon mx-auto">
                        <h5 class="card-title">Command Center System</h5>
                        <p class="system-subtitle"></p>
                        <p class="card-text flex-grow-1">Tower Operations Hub</p>
                        <a href="/CCS" class="btn btn-primary mt-auto">Access System</a>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card system-card">
                    <div class="card-body text-center d-flex flex-column">
                        <img src="../_shared/images/prime-ams-detailed.svg" alt="AMS" class="system-icon mx-auto">
                        <h5 class="card-title">Asset Management System</h5>
                        <p class="system-subtitle"></p>
                        <p class="card-text flex-grow-1">Tower & Equipment Management</p>
                        <a href="/AMS" class="btn btn-primary mt-auto">Access System</a>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card system-card">
                    <div class="card-body text-center d-flex flex-column">
                        <img src="../_shared/images/prime-scs-detailed.svg" alt="SCS" class="system-icon mx-auto">
                        <h5 class="card-title">Security Control System</h5>
                        <p class="system-subtitle"></p>
                        <p class="card-text flex-grow-1">Access & Surveillance Platform</p>
                        <a href="/SCS" class="btn btn-primary mt-auto">Access System</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card system-card">
                    <div class="card-body text-center d-flex flex-column">
                        <img src="../_shared/images/prime-cms-detailed.svg" alt="CMS" class="system-icon mx-auto">
                        <h5 class="card-title">Client Management System</h5>
                        <p class="system-subtitle"></p>
                        <p class="card-text flex-grow-1">Client & Contract Management</p>
                        <a href="/CMS" class="btn btn-primary mt-auto">Access System</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card system-card">
                    <div class="card-body text-center d-flex flex-column">
                        <img src="../_shared/images/prime-ems-detailed.svg" alt="EMS" class="system-icon mx-auto">
                        <h5 class="card-title">Employee Management System</h5>
                        <p class="system-subtitle"></p>
                        <p class="card-text flex-grow-1">Personnel & Training Control</p>
                        <a href="/EMS" class="btn btn-primary mt-auto">Access System</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>