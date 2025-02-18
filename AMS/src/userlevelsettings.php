<?php
/**
 * PHPMaker 2024 User Level Settings
 */
namespace PHPMaker2024\AMS;

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
$USER_LEVEL_PRIVS = [["{AMS}audit_logs","-2","0"],
    ["{AMS}audit_logs","0","0"],
    ["{AMS}systems","-2","0"],
    ["{AMS}systems","0","0"],
    ["{AMS}user_level_assignments","-2","0"],
    ["{AMS}user_level_assignments","0","0"],
    ["{AMS}user_level_permissions","-2","0"],
    ["{AMS}user_level_permissions","0","0"],
    ["{AMS}user_levels","-2","0"],
    ["{AMS}user_levels","0","0"],
    ["{AMS}users","-2","0"],
    ["{AMS}users","0","0"],
    ["{AMS}aggregated_audit_logs","-2","0"],
    ["{AMS}aggregated_audit_logs","0","0"],
    ["{AMS}MainDashboard.php","-2","0"],
    ["{AMS}MainDashboard.php","0","0"],
    ["{AMS}departments","-2","0"],
    ["{AMS}departments","0","0"],
    ["{AMS}notifications","-2","0"],
    ["{AMS}notifications","0","0"],
    ["{AMS}equipment_models","-2","0"],
    ["{AMS}equipment_models","0","0"],
    ["{AMS}equipment_specifications","-2","0"],
    ["{AMS}equipment_specifications","0","0"],
    ["{AMS}equipment_types","-2","0"],
    ["{AMS}equipment_types","0","0"],
    ["{AMS}maintenance_actions","-2","0"],
    ["{AMS}maintenance_actions","0","0"],
    ["{AMS}maintenance_findings","-2","0"],
    ["{AMS}maintenance_findings","0","0"],
    ["{AMS}maintenance_logs","-2","0"],
    ["{AMS}maintenance_logs","0","0"],
    ["{AMS}maintenance_parts","-2","0"],
    ["{AMS}maintenance_parts","0","0"],
    ["{AMS}maintenance_schedules","-2","0"],
    ["{AMS}maintenance_schedules","0","0"],
    ["{AMS}maintenance_teams","-2","0"],
    ["{AMS}maintenance_teams","0","0"],
    ["{AMS}maintenance_types","-2","0"],
    ["{AMS}maintenance_types","0","0"],
    ["{AMS}manufacturers","-2","0"],
    ["{AMS}manufacturers","0","0"],
    ["{AMS}measurement_units","-2","0"],
    ["{AMS}measurement_units","0","0"],
    ["{AMS}specification_types","-2","0"],
    ["{AMS}specification_types","0","0"],
    ["{AMS}status_types","-2","0"],
    ["{AMS}status_types","0","0"],
    ["{AMS}team_members","-2","0"],
    ["{AMS}team_members","0","0"],
    ["{AMS}tower_equipment","-2","0"],
    ["{AMS}tower_equipment","0","0"],
    ["{AMS}tower_specifications","-2","0"],
    ["{AMS}tower_specifications","0","0"],
    ["{AMS}tower_types","-2","0"],
    ["{AMS}tower_types","0","0"],
    ["{AMS}towers","-2","0"],
    ["{AMS}towers","0","0"],
    ["{AMS}unit_categories","-2","0"],
    ["{AMS}unit_categories","0","0"]];

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
$USER_LEVEL_TABLES = [["audit_logs","audit_logs","audit logs",true,"{AMS}",""],
    ["systems","systems","systems",true,"{AMS}","SystemsList"],
    ["user_level_assignments","user_level_assignments","user level assignments",true,"{AMS}","UserLevelAssignmentsList"],
    ["user_level_permissions","user_level_permissions","user level permissions",true,"{AMS}",""],
    ["user_levels","_user_levels","user levels",true,"{AMS}",""],
    ["users","users","users",true,"{AMS}","UsersList"],
    ["aggregated_audit_logs","aggregated_audit_logs","audit logs",true,"{AMS}","AggregatedAuditLogsList"],
    ["MainDashboard.php","MainDashboard","Dashboard",true,"{AMS}","MainDashboard"],
    ["departments","departments","departments",true,"{AMS}","DepartmentsList"],
    ["notifications","notifications","notifications",true,"{AMS}",""],
    ["equipment_models","equipment_models","equipment models",true,"{AMS}","EquipmentModelsList"],
    ["equipment_specifications","equipment_specifications","equipment specifications",true,"{AMS}","EquipmentSpecificationsList"],
    ["equipment_types","equipment_types","equipment types",true,"{AMS}","EquipmentTypesList"],
    ["maintenance_actions","maintenance_actions","maintenance actions",true,"{AMS}","MaintenanceActionsList"],
    ["maintenance_findings","maintenance_findings","maintenance findings",true,"{AMS}","MaintenanceFindingsList"],
    ["maintenance_logs","maintenance_logs","maintenance logs",true,"{AMS}","MaintenanceLogsList"],
    ["maintenance_parts","maintenance_parts","maintenance parts",true,"{AMS}","MaintenancePartsList"],
    ["maintenance_schedules","maintenance_schedules","maintenance schedules",true,"{AMS}","MaintenanceSchedulesList"],
    ["maintenance_teams","maintenance_teams","maintenance teams",true,"{AMS}","MaintenanceTeamsList"],
    ["maintenance_types","maintenance_types","maintenance types",true,"{AMS}","MaintenanceTypesList"],
    ["manufacturers","manufacturers","manufacturers",true,"{AMS}","ManufacturersList"],
    ["measurement_units","measurement_units","measurement units",true,"{AMS}","MeasurementUnitsList"],
    ["specification_types","specification_types","specification types",true,"{AMS}","SpecificationTypesList"],
    ["status_types","status_types","status types",true,"{AMS}","StatusTypesList"],
    ["team_members","team_members","team members",true,"{AMS}","TeamMembersList"],
    ["tower_equipment","tower_equipment","tower equipment",true,"{AMS}","TowerEquipmentList"],
    ["tower_specifications","tower_specifications","tower specifications",true,"{AMS}","TowerSpecificationsList"],
    ["tower_types","tower_types","tower types",true,"{AMS}","TowerTypesList"],
    ["towers","towers","towers",true,"{AMS}","TowersList"],
    ["unit_categories","unit_categories","unit categories",true,"{AMS}","UnitCategoriesList"]];
