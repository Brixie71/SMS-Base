<?php

namespace PHPMaker2024\UAC;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(9, "mi_MainDashboard", $Language->menuPhrase("9", "MenuText"), "MainDashboard", -1, "", AllowListMenu('{UAC}MainDashboard.php'), false, false, "fas fa-chart-line", "", false, true);
$sideMenu->addMenuItem(3, "mi_systems", $Language->menuPhrase("3", "MenuText"), "SystemsList", -1, "", AllowListMenu('{UAC}systems'), false, false, "fas fa-network-wired", "", false, true);
$sideMenu->addMenuItem(10, "mi_departments", $Language->menuPhrase("10", "MenuText"), "DepartmentsList", -1, "", AllowListMenu('{UAC}departments'), false, false, "fas fa-user-group", "", false, true);
$sideMenu->addMenuItem(13, "mi_UserAccess", $Language->menuPhrase("13", "MenuText"), "UserAccess", -1, "", AllowListMenu('{UAC}UserAccess.php'), false, false, "fas fa-user-lock", "", false, true);
$sideMenu->addMenuItem(12, "mi_UserManagement", $Language->menuPhrase("12", "MenuText"), "UserManagement", -1, "", AllowListMenu('{UAC}UserManagement.php'), false, false, "fas fa-user-shield", "", false, true);
$sideMenu->addMenuItem(6, "mi__user_levels", $Language->menuPhrase("6", "MenuText"), "UserLevelsList?cmd=resetall", -1, "", AllowListMenu('{UAC}user_levels'), false, false, "fas fa-layer-group", "", false, true);
$sideMenu->addMenuItem(7, "mi_users", $Language->menuPhrase("7", "MenuText"), "UsersList?cmd=resetall", -1, "", AllowListMenu('{UAC}users'), false, false, "fas fa-users", "", false, true);
$sideMenu->addMenuItem(8, "mi_aggregated_audit_logs", $Language->menuPhrase("8", "MenuText"), "AggregatedAuditLogsList?cmd=resetall", -1, "", AllowListMenu('{UAC}aggregated_audit_logs'), false, false, "fas fa-history", "", false, true);
echo $sideMenu->toScript();
