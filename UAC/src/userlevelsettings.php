<?php
/**
 * PHPMaker 2024 User Level Settings
 */
namespace PHPMaker2024\UAC;

/**
 * User levels
 *
 * @var array<int, string>
 * [0] int User level ID
 * [1] string User level name
 */
$USER_LEVELS = [["-2","Anonymous"],
    ["0","Default"]];

/**
 * User level permissions
 *
 * @var array<string, int, int>
 * [0] string Project ID + Table name
 * [1] int User level ID
 * [2] int Permissions
 */
$USER_LEVEL_PRIVS = [["{UAC}audit_logs","-2","0"],
    ["{UAC}audit_logs","0","0"],
    ["{UAC}systems","-2","0"],
    ["{UAC}systems","0","0"],
    ["{UAC}user_level_assignments","-2","0"],
    ["{UAC}user_level_assignments","0","0"],
    ["{UAC}user_level_permissions","-2","0"],
    ["{UAC}user_level_permissions","0","0"],
    ["{UAC}user_levels","-2","0"],
    ["{UAC}user_levels","0","0"],
    ["{UAC}users","-2","0"],
    ["{UAC}users","0","0"],
    ["{UAC}aggregated_audit_logs","-2","0"],
    ["{UAC}aggregated_audit_logs","0","0"],
    ["{UAC}MainDashboard.php","-2","0"],
    ["{UAC}MainDashboard.php","0","0"],
    ["{UAC}departments","-2","0"],
    ["{UAC}departments","0","0"],
    ["{UAC}notifications","-2","0"],
    ["{UAC}notifications","0","0"],
    ["{UAC}UserManagement.php","-2","0"],
    ["{UAC}UserManagement.php","0","0"],
    ["{UAC}UserAccess.php","-2","0"],
    ["{UAC}UserAccess.php","0","0"]];

/**
 * Tables
 *
 * @var array<string, string, string, bool, string>
 * [0] string Table name
 * [1] string Table variable name
 * [2] string Table caption
 * [3] bool Allowed for update (for userpriv.php)
 * [4] string Project ID
 * [5] string URL (for OthersController::index)
 */
$USER_LEVEL_TABLES = [["audit_logs","audit_logs","audit logs",false,"{UAC}","AuditLogsList"],
    ["systems","systems","systems",true,"{UAC}","SystemsList"],
    ["user_level_assignments","user_level_assignments","user level assignments",true,"{UAC}","UserLevelAssignmentsList"],
    ["user_level_permissions","user_level_permissions","user level permissions",false,"{UAC}",""],
    ["user_levels","_user_levels","user levels",true,"{UAC}","UserLevelsList"],
    ["users","users","users",true,"{UAC}","UsersList"],
    ["aggregated_audit_logs","aggregated_audit_logs","audit logs",true,"{UAC}","AggregatedAuditLogsList"],
    ["MainDashboard.php","MainDashboard","Dashboard",true,"{UAC}","MainDashboard"],
    ["departments","departments","departments",true,"{UAC}","DepartmentsList"],
    ["notifications","notifications","notifications",true,"{UAC}","NotificationsList"],
    ["UserManagement.php","UserManagement","User Level Management",true,"{UAC}","UserManagement"],
    ["UserAccess.php","UserAccess","User Access Management",true,"{UAC}","UserAccess"]];
