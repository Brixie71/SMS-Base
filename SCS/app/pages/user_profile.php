<?php
namespace PHPMaker2024\PRMS;

// Security check
if (!$Security->isLoggedIn()) {
    header("Location: login.php");
    exit();
}

// Get current user data with proper table references for bridged database
$userId = CurrentUserID();
$userData = ExecuteRow("
    SELECT 
        u.user_id,
        u.username,
        u.email,
        u.first_name,
        u.middle_name,
        u.last_name,
        u.date_created,
        u.last_login,
        u.is_active,
        u.user_level_id,
        u.reports_to_user_id,
        u.photo,
        u.mobile_number,
        u.department_id,
        u.profile,
        d.department_name,
        ul.name as user_level_name
    FROM users u
    LEFT JOIN departments d ON u.department_id = d.department_id
    LEFT JOIN user_levels ul ON CAST(u.user_level_id AS INTEGER) = ul.user_level_id
    WHERE u.user_id =
" . $userId, "DB");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - <?= htmlspecialchars($userdata['first_name'] . ' ' . $userdata['last_name']) ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 30px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info h1 {
            margin: 0 0 5px 0;
            color: #333;
            font-size: 24px;
        }

        .profile-info p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }

        .profile-info .badge {
            display: inline-block;
            padding: 4px 12px;
            background: #e3f2fd;
            color: #1a237e;
            border-radius: 15px;
            font-size: 12px;
            margin-top: 8px;
        }

        .profile-sections {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
        }

        .section h2 {
            margin: 0 0 15px 0;
            font-size: 18px;
            color: #333;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .info-item {
            background: white;
            padding: 12px;
            border-radius: 6px;
        }

        .info-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 14px;
            color: #333;
        }

        .profile-actions {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: opacity 0.2s;
        }

        .btn-primary {
            background: #1a237e;
            color: white;
        }

        .btn-secondary {
            background: #f0f2f5;
            color: #333;
        }

        .btn:hover {
            opacity: 0.9;
        }

        @media (max-width: 600px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-avatar">
                <?php if (!empty($userData['photo'])): ?>

                    <img src="<?= GetSignedUrl("NLEX/UAC/photo/".$userData['photo']) ?>" alt="Profile Photo">
                <?php else: ?>
                    <i class="fas fa-user fa-3x" style="color: #1a237e;"></i>
                <?php endif; ?>
            </div>
            <div class="profile-info">
                <h1><?= htmlspecialchars($userData['first_name'] . ' ' . $userData['last_name']) ?></h1>
                <p><?= htmlspecialchars($userData['department_name']) ?></p>
                <div class="badge"><?= htmlspecialchars($userData['user_level_name']) ?></div>
            </div>
        </div>

        <div class="profile-sections">
            <div class="section">
                <h2>Personal Information</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Username</div>
                        <div class="info-value"><?= htmlspecialchars($userData['username']) ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value"><?= htmlspecialchars($userData['email']) ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Mobile Number</div>
                        <div class="info-value"><?= htmlspecialchars($userData['mobile_number'] ?? 'Not provided') ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Department</div>
                        <div class="info-value"><?= htmlspecialchars($userData['department_name']) ?></div>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>Account Information</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Account Created</div>
                        <div class="info-value"><?= FormatDateTime($userData['date_created']) ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Last Login</div>
                        <div class="info-value"><?= FormatDateTime($userData['last_login']) ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Status</div>
                        <div class="info-value"><?= $userData['is_active'] ? 'Active' : 'Inactive' ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Access Level</div>
                        <div class="info-value"><?= htmlspecialchars($userData['user_level_name']) ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-actions">
            <button class="btn btn-primary" onclick="window.location.href='UserEdit?user_id=<?= $userId ?>'">
                Edit Profile
            </button>
            <button class="btn btn-secondary" onclick="window.location.href='UserChangePassword?user_id=<?= $userId ?>'">
                Change Password
            </button>
        </div>
    </div>
</body>
</html>