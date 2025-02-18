<?php
/**
 * PHPMaker 2024 User Level Settings
 */
namespace PHPMaker2024\CMS;

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
$USER_LEVEL_PRIVS = [["{CMS}audit_logs","-2","0"],
    ["{CMS}audit_logs","0","0"],
    ["{CMS}systems","-2","0"],
    ["{CMS}systems","0","0"],
    ["{CMS}user_level_assignments","-2","0"],
    ["{CMS}user_level_assignments","0","0"],
    ["{CMS}user_level_permissions","-2","0"],
    ["{CMS}user_level_permissions","0","0"],
    ["{CMS}user_levels","-2","0"],
    ["{CMS}user_levels","0","0"],
    ["{CMS}users","-2","0"],
    ["{CMS}users","0","0"],
    ["{CMS}aggregated_audit_logs","-2","0"],
    ["{CMS}aggregated_audit_logs","0","0"],
    ["{CMS}MainDashboard.php","-2","0"],
    ["{CMS}MainDashboard.php","0","0"],
    ["{CMS}departments","-2","0"],
    ["{CMS}departments","0","0"],
    ["{CMS}notifications","-2","0"],
    ["{CMS}notifications","0","0"],
    ["{CMS}client_contacts","-2","0"],
    ["{CMS}client_contacts","0","0"],
    ["{CMS}client_contracts","-2","0"],
    ["{CMS}client_contracts","0","0"],
    ["{CMS}client_documents","-2","0"],
    ["{CMS}client_documents","0","0"],
    ["{CMS}client_equipment","-2","0"],
    ["{CMS}client_equipment","0","0"],
    ["{CMS}client_types","-2","0"],
    ["{CMS}client_types","0","0"],
    ["{CMS}clients","-2","0"],
    ["{CMS}clients","0","0"],
    ["{CMS}contract_services","-2","0"],
    ["{CMS}contract_services","0","0"],
    ["{CMS}contract_terms","-2","0"],
    ["{CMS}contract_terms","0","0"],
    ["{CMS}service_requests","-2","0"],
    ["{CMS}service_requests","0","0"],
    ["{CMS}service_types","-2","0"],
    ["{CMS}service_types","0","0"],
    ["{CMS}support_ticket_updates","-2","0"],
    ["{CMS}support_ticket_updates","0","0"],
    ["{CMS}support_tickets","-2","0"],
    ["{CMS}support_tickets","0","0"]];

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
$USER_LEVEL_TABLES = [["audit_logs","audit_logs","audit logs",true,"{CMS}",""],
    ["systems","systems","systems",true,"{CMS}","SystemsList"],
    ["user_level_assignments","user_level_assignments","user level assignments",true,"{CMS}","UserLevelAssignmentsList"],
    ["user_level_permissions","user_level_permissions","user level permissions",true,"{CMS}",""],
    ["user_levels","_user_levels","user levels",true,"{CMS}",""],
    ["users","users","users",true,"{CMS}","UsersList"],
    ["aggregated_audit_logs","aggregated_audit_logs","audit logs",true,"{CMS}","AggregatedAuditLogsList"],
    ["MainDashboard.php","MainDashboard","Dashboard",true,"{CMS}","MainDashboard"],
    ["departments","departments","departments",true,"{CMS}","DepartmentsList"],
    ["notifications","notifications","notifications",true,"{CMS}",""],
    ["client_contacts","client_contacts","client contacts",true,"{CMS}","ClientContactsList"],
    ["client_contracts","client_contracts","client contracts",true,"{CMS}","ClientContractsList"],
    ["client_documents","client_documents","client documents",true,"{CMS}","ClientDocumentsList"],
    ["client_equipment","client_equipment","client equipment",true,"{CMS}","ClientEquipmentList"],
    ["client_types","client_types","client types",true,"{CMS}","ClientTypesList"],
    ["clients","clients","clients",true,"{CMS}","ClientsList"],
    ["contract_services","contract_services","contract services",true,"{CMS}","ContractServicesList"],
    ["contract_terms","contract_terms","contract terms",true,"{CMS}","ContractTermsList"],
    ["service_requests","service_requests","service requests",true,"{CMS}","ServiceRequestsList"],
    ["service_types","service_types","service types",true,"{CMS}","ServiceTypesList"],
    ["support_ticket_updates","support_ticket_updates","support ticket updates",true,"{CMS}","SupportTicketUpdatesList"],
    ["support_tickets","support_tickets","support tickets",true,"{CMS}","SupportTicketsList"]];
