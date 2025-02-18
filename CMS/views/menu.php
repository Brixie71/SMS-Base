<?php

namespace PHPMaker2024\CMS;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
$topMenu->addMenuItem(21, "mci_User_Management", $Language->menuPhrase("21", "MenuText"), "", -1, "", true, false, true, "fas fa-users", "", true, false);
$topMenu->addMenuItem(3, "mi_systems", $Language->menuPhrase("3", "MenuText"), "SystemsList", 21, "", AllowListMenu('{CMS}systems'), false, false, "fas fa-network-wired", "", true, false);
$topMenu->addMenuItem(10, "mi_departments", $Language->menuPhrase("10", "MenuText"), "DepartmentsList", 21, "", AllowListMenu('{CMS}departments'), false, false, "fas fa-user-group", "", true, false);
$topMenu->addMenuItem(8, "mi_aggregated_audit_logs", $Language->menuPhrase("8", "MenuText"), "AggregatedAuditLogsList?cmd=resetall", 21, "", AllowListMenu('{CMS}aggregated_audit_logs'), false, false, "fas fa-history", "", true, false);
$topMenu->addMenuItem(7, "mi_users", $Language->menuPhrase("7", "MenuText"), "UsersList?cmd=resetall", 21, "", AllowListMenu('{CMS}users'), false, false, "fas fa-users", "", true, false);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(9, "mi_MainDashboard", $Language->menuPhrase("9", "MenuText"), "MainDashboard", -1, "", AllowListMenu('{CMS}MainDashboard.php'), false, false, "fas fa-chart-line", "", false, true);
$sideMenu->addMenuItem(21, "mci_User_Management", $Language->menuPhrase("21", "MenuText"), "", -1, "", true, false, true, "fas fa-users", "", true, true);
$sideMenu->addMenuItem(3, "mi_systems", $Language->menuPhrase("3", "MenuText"), "SystemsList", 21, "", AllowListMenu('{CMS}systems'), false, false, "fas fa-network-wired", "", true, true);
$sideMenu->addMenuItem(10, "mi_departments", $Language->menuPhrase("10", "MenuText"), "DepartmentsList", 21, "", AllowListMenu('{CMS}departments'), false, false, "fas fa-user-group", "", true, true);
$sideMenu->addMenuItem(8, "mi_aggregated_audit_logs", $Language->menuPhrase("8", "MenuText"), "AggregatedAuditLogsList?cmd=resetall", 21, "", AllowListMenu('{CMS}aggregated_audit_logs'), false, false, "fas fa-history", "", true, true);
$sideMenu->addMenuItem(7, "mi_users", $Language->menuPhrase("7", "MenuText"), "UsersList?cmd=resetall", 21, "", AllowListMenu('{CMS}users'), false, false, "fas fa-users", "", true, true);
$sideMenu->addMenuItem(45, "mci_CLIENT_MANAGEMENT", $Language->menuPhrase("45", "MenuText"), "", -1, "", true, true, true, "", "", false, true);
$sideMenu->addMenuItem(22, "mi_client_contacts", $Language->menuPhrase("22", "MenuText"), "ClientContactsList", 45, "", AllowListMenu('{CMS}client_contacts'), false, false, "fas fa-address-book", "", false, true);
$sideMenu->addMenuItem(23, "mi_client_contracts", $Language->menuPhrase("23", "MenuText"), "ClientContractsList", 45, "", AllowListMenu('{CMS}client_contracts'), false, false, "fas fa-file-contract", "", false, true);
$sideMenu->addMenuItem(24, "mi_client_documents", $Language->menuPhrase("24", "MenuText"), "ClientDocumentsList", 45, "", AllowListMenu('{CMS}client_documents'), false, false, "fas fa-file-alt", "", false, true);
$sideMenu->addMenuItem(25, "mi_client_equipment", $Language->menuPhrase("25", "MenuText"), "ClientEquipmentList", 45, "", AllowListMenu('{CMS}client_equipment'), false, false, "fas fa-cogs", "", false, true);
$sideMenu->addMenuItem(26, "mi_client_types", $Language->menuPhrase("26", "MenuText"), "ClientTypesList", 45, "", AllowListMenu('{CMS}client_types'), false, false, "fas fa-tags", "", false, true);
$sideMenu->addMenuItem(27, "mi_clients", $Language->menuPhrase("27", "MenuText"), "ClientsList", 45, "", AllowListMenu('{CMS}clients'), false, false, "fas fa-users", "", false, true);
$sideMenu->addMenuItem(46, "mci_CONTRACT_MANAGEMENT", $Language->menuPhrase("46", "MenuText"), "", -1, "", true, true, true, "", "", false, true);
$sideMenu->addMenuItem(28, "mi_contract_services", $Language->menuPhrase("28", "MenuText"), "ContractServicesList", 46, "", AllowListMenu('{CMS}contract_services'), false, false, "fas fa-handshake", "", false, true);
$sideMenu->addMenuItem(29, "mi_contract_terms", $Language->menuPhrase("29", "MenuText"), "ContractTermsList", 46, "", AllowListMenu('{CMS}contract_terms'), false, false, "fas fa-clock", "", false, true);
$sideMenu->addMenuItem(47, "mci_SERVICE_MANAGEMENT", $Language->menuPhrase("47", "MenuText"), "", -1, "", true, true, true, "", "", false, true);
$sideMenu->addMenuItem(30, "mi_service_requests", $Language->menuPhrase("30", "MenuText"), "ServiceRequestsList", 47, "", AllowListMenu('{CMS}service_requests'), false, false, "fas fa-clipboard-list", "", false, true);
$sideMenu->addMenuItem(31, "mi_service_types", $Language->menuPhrase("31", "MenuText"), "ServiceTypesList", 47, "", AllowListMenu('{CMS}service_types'), false, false, "fas fa-cogs", "", false, true);
$sideMenu->addMenuItem(48, "mci_SUPPORT_MANAGEMENT", $Language->menuPhrase("48", "MenuText"), "", -1, "", true, true, true, "", "", false, true);
$sideMenu->addMenuItem(32, "mi_support_ticket_updates", $Language->menuPhrase("32", "MenuText"), "SupportTicketUpdatesList", 48, "", AllowListMenu('{CMS}support_ticket_updates'), false, false, "fas fa-comments", "", false, true);
$sideMenu->addMenuItem(33, "mi_support_tickets", $Language->menuPhrase("33", "MenuText"), "SupportTicketsList", 48, "", AllowListMenu('{CMS}support_tickets'), false, false, "fas fa-ticket-alt", "", false, true);
echo $sideMenu->toScript();
