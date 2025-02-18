<?php

namespace PHPMaker2024\AMS;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
$topMenu->addMenuItem(21, "mci_User_Management", $Language->menuPhrase("21", "MenuText"), "", -1, "", true, false, true, "fas fa-users", "", true, false);
$topMenu->addMenuItem(3, "mi_systems", $Language->menuPhrase("3", "MenuText"), "SystemsList", 21, "", AllowListMenu('{AMS}systems'), false, false, "fas fa-network-wired", "", true, false);
$topMenu->addMenuItem(10, "mi_departments", $Language->menuPhrase("10", "MenuText"), "DepartmentsList", 21, "", AllowListMenu('{AMS}departments'), false, false, "fas fa-user-group", "", true, false);
$topMenu->addMenuItem(8, "mi_aggregated_audit_logs", $Language->menuPhrase("8", "MenuText"), "AggregatedAuditLogsList?cmd=resetall", 21, "", AllowListMenu('{AMS}aggregated_audit_logs'), false, false, "fas fa-history", "", true, false);
$topMenu->addMenuItem(7, "mi_users", $Language->menuPhrase("7", "MenuText"), "UsersList?cmd=resetall", 21, "", AllowListMenu('{AMS}users'), false, false, "fas fa-users", "", true, false);
$topMenu->addMenuItem(57, "mci_Settings", $Language->menuPhrase("57", "MenuText"), "", -1, "", true, false, true, "fas fa-cogs", "", true, false);
$topMenu->addMenuItem(33, "mi_measurement_units", $Language->menuPhrase("33", "MenuText"), "MeasurementUnitsList", 57, "", AllowListMenu('{AMS}measurement_units'), false, false, "fas fa-ruler", "", true, false);
$topMenu->addMenuItem(34, "mi_specification_types", $Language->menuPhrase("34", "MenuText"), "SpecificationTypesList", 57, "", AllowListMenu('{AMS}specification_types'), false, false, "fas fa-cogs", "", true, false);
$topMenu->addMenuItem(35, "mi_status_types", $Language->menuPhrase("35", "MenuText"), "StatusTypesList", 57, "", AllowListMenu('{AMS}status_types'), false, false, "fas fa-circle", "", true, false);
$topMenu->addMenuItem(41, "mi_unit_categories", $Language->menuPhrase("41", "MenuText"), "UnitCategoriesList", 57, "", AllowListMenu('{AMS}unit_categories'), false, false, "fas fa-cogs", "", true, false);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(9, "mi_MainDashboard", $Language->menuPhrase("9", "MenuText"), "MainDashboard", -1, "", AllowListMenu('{AMS}MainDashboard.php'), false, false, "fas fa-chart-line", "", false, true);
$sideMenu->addMenuItem(21, "mci_User_Management", $Language->menuPhrase("21", "MenuText"), "", -1, "", true, false, true, "fas fa-users", "", true, true);
$sideMenu->addMenuItem(3, "mi_systems", $Language->menuPhrase("3", "MenuText"), "SystemsList", 21, "", AllowListMenu('{AMS}systems'), false, false, "fas fa-network-wired", "", true, true);
$sideMenu->addMenuItem(10, "mi_departments", $Language->menuPhrase("10", "MenuText"), "DepartmentsList", 21, "", AllowListMenu('{AMS}departments'), false, false, "fas fa-user-group", "", true, true);
$sideMenu->addMenuItem(8, "mi_aggregated_audit_logs", $Language->menuPhrase("8", "MenuText"), "AggregatedAuditLogsList?cmd=resetall", 21, "", AllowListMenu('{AMS}aggregated_audit_logs'), false, false, "fas fa-history", "", true, true);
$sideMenu->addMenuItem(7, "mi_users", $Language->menuPhrase("7", "MenuText"), "UsersList?cmd=resetall", 21, "", AllowListMenu('{AMS}users'), false, false, "fas fa-users", "", true, true);
$sideMenu->addMenuItem(53, "mci_EQUIPMENT", $Language->menuPhrase("53", "MenuText"), "", -1, "", true, true, true, "", "", false, true);
$sideMenu->addMenuItem(22, "mi_equipment_models", $Language->menuPhrase("22", "MenuText"), "EquipmentModelsList", 53, "", AllowListMenu('{AMS}equipment_models'), false, false, "fas fa-cogs", "", false, true);
$sideMenu->addMenuItem(23, "mi_equipment_specifications", $Language->menuPhrase("23", "MenuText"), "EquipmentSpecificationsList", 53, "", AllowListMenu('{AMS}equipment_specifications'), false, false, "fas fa-clipboard-list", "", false, true);
$sideMenu->addMenuItem(24, "mi_equipment_types", $Language->menuPhrase("24", "MenuText"), "EquipmentTypesList", 53, "", AllowListMenu('{AMS}equipment_types'), false, false, "fas fa-list-alt", "", false, true);
$sideMenu->addMenuItem(32, "mi_manufacturers", $Language->menuPhrase("32", "MenuText"), "ManufacturersList", 53, "", AllowListMenu('{AMS}manufacturers'), false, false, "fas fa-industry", "", false, true);
$sideMenu->addMenuItem(54, "mci_MAINTENANCE", $Language->menuPhrase("54", "MenuText"), "", -1, "", true, true, true, "", "", false, true);
$sideMenu->addMenuItem(25, "mi_maintenance_actions", $Language->menuPhrase("25", "MenuText"), "MaintenanceActionsList", 54, "", AllowListMenu('{AMS}maintenance_actions'), false, false, "fas fa-tools", "", false, true);
$sideMenu->addMenuItem(26, "mi_maintenance_findings", $Language->menuPhrase("26", "MenuText"), "MaintenanceFindingsList", 54, "", AllowListMenu('{AMS}maintenance_findings'), false, false, "fas fa-exclamation-triangle", "", false, true);
$sideMenu->addMenuItem(27, "mi_maintenance_logs", $Language->menuPhrase("27", "MenuText"), "MaintenanceLogsList", 54, "", AllowListMenu('{AMS}maintenance_logs'), false, false, "fas fa-file-alt", "", false, true);
$sideMenu->addMenuItem(28, "mi_maintenance_parts", $Language->menuPhrase("28", "MenuText"), "MaintenancePartsList", 54, "", AllowListMenu('{AMS}maintenance_parts'), false, false, "fas fa-puzzle-piece", "", false, true);
$sideMenu->addMenuItem(29, "mi_maintenance_schedules", $Language->menuPhrase("29", "MenuText"), "MaintenanceSchedulesList", 54, "", AllowListMenu('{AMS}maintenance_schedules'), false, false, "fas fa-calendar-check", "", false, true);
$sideMenu->addMenuItem(30, "mi_maintenance_teams", $Language->menuPhrase("30", "MenuText"), "MaintenanceTeamsList", 54, "", AllowListMenu('{AMS}maintenance_teams'), false, false, "fas fa-users", "", false, true);
$sideMenu->addMenuItem(31, "mi_maintenance_types", $Language->menuPhrase("31", "MenuText"), "MaintenanceTypesList", 54, "", AllowListMenu('{AMS}maintenance_types'), false, false, "fas fa-wrench", "", false, true);
$sideMenu->addMenuItem(36, "mi_team_members", $Language->menuPhrase("36", "MenuText"), "TeamMembersList", 54, "", AllowListMenu('{AMS}team_members'), false, false, "fas fa-user-tie", "", false, true);
$sideMenu->addMenuItem(56, "mci_TOWER", $Language->menuPhrase("56", "MenuText"), "", -1, "", true, true, true, "", "", false, true);
$sideMenu->addMenuItem(37, "mi_tower_equipment", $Language->menuPhrase("37", "MenuText"), "TowerEquipmentList", 56, "", AllowListMenu('{AMS}tower_equipment'), false, false, "fas fa-gopuram", "", false, true);
$sideMenu->addMenuItem(38, "mi_tower_specifications", $Language->menuPhrase("38", "MenuText"), "TowerSpecificationsList", 56, "", AllowListMenu('{AMS}tower_specifications'), false, false, "fas fa-columns", "", false, true);
$sideMenu->addMenuItem(39, "mi_tower_types", $Language->menuPhrase("39", "MenuText"), "TowerTypesList", 56, "", AllowListMenu('{AMS}tower_types'), false, false, "fas fa-cogs", "", false, true);
$sideMenu->addMenuItem(40, "mi_towers", $Language->menuPhrase("40", "MenuText"), "TowersList", 56, "", AllowListMenu('{AMS}towers'), false, false, "fas fa-broadcast-tower", "", false, true);
$sideMenu->addMenuItem(57, "mci_Settings", $Language->menuPhrase("57", "MenuText"), "", -1, "", true, false, true, "fas fa-cogs", "", true, true);
$sideMenu->addMenuItem(33, "mi_measurement_units", $Language->menuPhrase("33", "MenuText"), "MeasurementUnitsList", 57, "", AllowListMenu('{AMS}measurement_units'), false, false, "fas fa-ruler", "", true, true);
$sideMenu->addMenuItem(34, "mi_specification_types", $Language->menuPhrase("34", "MenuText"), "SpecificationTypesList", 57, "", AllowListMenu('{AMS}specification_types'), false, false, "fas fa-cogs", "", true, true);
$sideMenu->addMenuItem(35, "mi_status_types", $Language->menuPhrase("35", "MenuText"), "StatusTypesList", 57, "", AllowListMenu('{AMS}status_types'), false, false, "fas fa-circle", "", true, true);
$sideMenu->addMenuItem(41, "mi_unit_categories", $Language->menuPhrase("41", "MenuText"), "UnitCategoriesList", 57, "", AllowListMenu('{AMS}unit_categories'), false, false, "fas fa-cogs", "", true, true);
echo $sideMenu->toScript();
