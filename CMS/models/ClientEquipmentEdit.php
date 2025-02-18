<?php

namespace PHPMaker2024\CMS;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use Slim\Routing\RouteCollectorProxy;
use Slim\App;
use Closure;

/**
 * Page class
 */
class ClientEquipmentEdit extends ClientEquipment
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "ClientEquipmentEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "ClientEquipmentEdit";

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        return rtrim(UrlFor($route->getName(), $args), "/") . "?";
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<div id="ew-page-header">' . $header . '</div>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<div id="ew-page-footer">' . $footer . '</div>';
        }
    }

    // Set field visibility
    public function setVisibility()
    {
        $this->equipment_id->setVisibility();
        $this->client_id->setVisibility();
        $this->contract_id->setVisibility();
        $this->tower_equipment_id->setVisibility();
        $this->installation_date->setVisibility();
        $this->removal_date->setVisibility();
        $this->status->setVisibility();
        $this->maintenance_schedule->setVisibility();
        $this->last_maintenance_date->setVisibility();
        $this->next_maintenance_date->setVisibility();
        $this->notes->setVisibility();
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'client_equipment';
        $this->TableName = 'client_equipment';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-edit-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (client_equipment)
        if (!isset($GLOBALS["client_equipment"]) || $GLOBALS["client_equipment"]::class == PROJECT_NAMESPACE . "client_equipment") {
            $GLOBALS["client_equipment"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'client_equipment');
        }

        // Start timer
        $DebugTimer = Container("debug.timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents(): string
    {
        global $Response;
        return $Response?->getBody() ?? ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

        // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }
        DispatchEvent(new PageUnloadedEvent($this), PageUnloadedEvent::NAME);
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show response for API
                $ar = array_merge($this->getMessages(), $url ? ["url" => GetUrl($url)] : []);
                WriteJson($ar);
            }
            $this->clearMessages(); // Clear messages for API request
            return;
        } else { // Check if response is JSON
            if (WithJsonResponse()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $pageName = GetPageName($url);
                $result = ["url" => GetUrl($url), "modal" => "1"];  // Assume return to modal for simplicity
                if (
                    SameString($pageName, GetPageName($this->getListUrl())) ||
                    SameString($pageName, GetPageName($this->getViewUrl())) ||
                    SameString($pageName, GetPageName(CurrentMasterTable()?->getViewUrl() ?? ""))
                ) { // List / View / Master View page
                    if (!SameString($pageName, GetPageName($this->getListUrl()))) { // Not List page
                        $result["caption"] = $this->getModalCaption($pageName);
                        $result["view"] = SameString($pageName, "ClientEquipmentView"); // If View page, no primary button
                    } else { // List page
                        $result["error"] = $this->getFailureMessage(); // List page should not be shown as modal => error
                        $this->clearFailureMessage();
                    }
                } else { // Other pages (add messages and then clear messages)
                    $result = array_merge($this->getMessages(), ["modal" => "1"]);
                    $this->clearMessages();
                }
                WriteJson($result);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from result set
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Result set
            while ($row = $rs->fetch()) {
                $this->loadRowValues($row); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($row);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DataType::BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['equipment_id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->equipment_id->Visible = false;
        }
    }

    // Lookup data
    public function lookup(array $req = [], bool $response = true)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $req["field"] ?? null;
        if (!$fieldName) {
            return [];
        }
        $fld = $this->Fields[$fieldName];
        $lookup = $fld->Lookup;
        $name = $req["name"] ?? "";
        if (ContainsString($name, "query_builder_rule")) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }

        // Get lookup parameters
        $lookupType = $req["ajax"] ?? "unknown";
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $req["q"] ?? $req["sv"] ?? "";
            $pageSize = $req["n"] ?? $req["recperpage"] ?? 10;
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $req["q"] ?? "";
            $pageSize = $req["n"] ?? -1;
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $req["start"] ?? -1;
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $req["page"] ?? -1;
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($req["s"] ?? "");
        $userFilter = Decrypt($req["f"] ?? "");
        $userOrderBy = Decrypt($req["o"] ?? "");
        $keys = $req["keys"] ?? null;
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $req["v0"] ?? $req["lookupValue"] ?? "";
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $req["v" . $i] ?? "";
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, $response); // Use settings from current page
    }

    // Properties
    public $FormClassName = "ew-form ew-edit-form overlay-wrapper";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $Language, $Security, $CurrentForm, $SkipHeaderFooter;

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Load user profile
        if (IsLoggedIn()) {
            Profile()->setUserName(CurrentUserName())->loadFromStorage();

            // Force logout user
            if (!IsSysAdmin() && Profile()->isForceLogout(session_id())) {
                $this->terminate("logout");
                return;
            }

            // Check if valid user and update last accessed time
            if (!IsSysAdmin() && !IsPasswordExpired() && !Profile()->isValidUser(session_id(), false)) {
                $this->terminate("logout"); // Handle as session expired
                return;
            }
        }

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->setVisibility();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        DispatchEvent(new PageLoadingEvent($this), PageLoadingEvent::NAME);

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Hide fields for add/edit
        if (!$this->UseAjaxActions) {
            $this->hideFieldsForAddEdit();
        }
        // Use inline delete
        if ($this->UseAjaxActions) {
            $this->InlineDelete = true;
        }

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("equipment_id") ?? Key(0) ?? Route(2)) !== null) {
                $this->equipment_id->setQueryStringValue($keyValue);
                $this->equipment_id->setOldValue($this->equipment_id->QueryStringValue);
            } elseif (Post("equipment_id") !== null) {
                $this->equipment_id->setFormValue(Post("equipment_id"));
                $this->equipment_id->setOldValue($this->equipment_id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action", "") !== "") {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("equipment_id") ?? Route("equipment_id")) !== null) {
                    $this->equipment_id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->equipment_id->CurrentValue = null;
                }
            }

            // Load result set
            if ($this->isShow()) {
                    // Load current record
                    $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("ClientEquipmentList"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "ClientEquipmentList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "ClientEquipmentList") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "ClientEquipmentList"; // Return list page content
                        }
                    }
                    if (IsJsonResponse()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->IsModal && $this->UseAjaxActions) { // Return JSON error message
                    WriteJson(["success" => false, "validation" => $this->getValidationErrors(), "error" => $this->getFailureMessage()]);
                    $this->clearFailureMessage();
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = RowType::EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            DispatchEvent(new PageRenderingEvent($this), PageRenderingEvent::NAME);

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'equipment_id' first before field var 'x_equipment_id'
        $val = $CurrentForm->hasValue("equipment_id") ? $CurrentForm->getValue("equipment_id") : $CurrentForm->getValue("x_equipment_id");
        if (!$this->equipment_id->IsDetailKey) {
            $this->equipment_id->setFormValue($val);
        }

        // Check field name 'client_id' first before field var 'x_client_id'
        $val = $CurrentForm->hasValue("client_id") ? $CurrentForm->getValue("client_id") : $CurrentForm->getValue("x_client_id");
        if (!$this->client_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->client_id->Visible = false; // Disable update for API request
            } else {
                $this->client_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'contract_id' first before field var 'x_contract_id'
        $val = $CurrentForm->hasValue("contract_id") ? $CurrentForm->getValue("contract_id") : $CurrentForm->getValue("x_contract_id");
        if (!$this->contract_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contract_id->Visible = false; // Disable update for API request
            } else {
                $this->contract_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'tower_equipment_id' first before field var 'x_tower_equipment_id'
        $val = $CurrentForm->hasValue("tower_equipment_id") ? $CurrentForm->getValue("tower_equipment_id") : $CurrentForm->getValue("x_tower_equipment_id");
        if (!$this->tower_equipment_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tower_equipment_id->Visible = false; // Disable update for API request
            } else {
                $this->tower_equipment_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'installation_date' first before field var 'x_installation_date'
        $val = $CurrentForm->hasValue("installation_date") ? $CurrentForm->getValue("installation_date") : $CurrentForm->getValue("x_installation_date");
        if (!$this->installation_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->installation_date->Visible = false; // Disable update for API request
            } else {
                $this->installation_date->setFormValue($val, true, $validate);
            }
            $this->installation_date->CurrentValue = UnFormatDateTime($this->installation_date->CurrentValue, $this->installation_date->formatPattern());
        }

        // Check field name 'removal_date' first before field var 'x_removal_date'
        $val = $CurrentForm->hasValue("removal_date") ? $CurrentForm->getValue("removal_date") : $CurrentForm->getValue("x_removal_date");
        if (!$this->removal_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->removal_date->Visible = false; // Disable update for API request
            } else {
                $this->removal_date->setFormValue($val, true, $validate);
            }
            $this->removal_date->CurrentValue = UnFormatDateTime($this->removal_date->CurrentValue, $this->removal_date->formatPattern());
        }

        // Check field name 'status' first before field var 'x_status'
        $val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
            }
        }

        // Check field name 'maintenance_schedule' first before field var 'x_maintenance_schedule'
        $val = $CurrentForm->hasValue("maintenance_schedule") ? $CurrentForm->getValue("maintenance_schedule") : $CurrentForm->getValue("x_maintenance_schedule");
        if (!$this->maintenance_schedule->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->maintenance_schedule->Visible = false; // Disable update for API request
            } else {
                $this->maintenance_schedule->setFormValue($val);
            }
        }

        // Check field name 'last_maintenance_date' first before field var 'x_last_maintenance_date'
        $val = $CurrentForm->hasValue("last_maintenance_date") ? $CurrentForm->getValue("last_maintenance_date") : $CurrentForm->getValue("x_last_maintenance_date");
        if (!$this->last_maintenance_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->last_maintenance_date->Visible = false; // Disable update for API request
            } else {
                $this->last_maintenance_date->setFormValue($val, true, $validate);
            }
            $this->last_maintenance_date->CurrentValue = UnFormatDateTime($this->last_maintenance_date->CurrentValue, $this->last_maintenance_date->formatPattern());
        }

        // Check field name 'next_maintenance_date' first before field var 'x_next_maintenance_date'
        $val = $CurrentForm->hasValue("next_maintenance_date") ? $CurrentForm->getValue("next_maintenance_date") : $CurrentForm->getValue("x_next_maintenance_date");
        if (!$this->next_maintenance_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->next_maintenance_date->Visible = false; // Disable update for API request
            } else {
                $this->next_maintenance_date->setFormValue($val, true, $validate);
            }
            $this->next_maintenance_date->CurrentValue = UnFormatDateTime($this->next_maintenance_date->CurrentValue, $this->next_maintenance_date->formatPattern());
        }

        // Check field name 'notes' first before field var 'x_notes'
        $val = $CurrentForm->hasValue("notes") ? $CurrentForm->getValue("notes") : $CurrentForm->getValue("x_notes");
        if (!$this->notes->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->notes->Visible = false; // Disable update for API request
            } else {
                $this->notes->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->equipment_id->CurrentValue = $this->equipment_id->FormValue;
        $this->client_id->CurrentValue = $this->client_id->FormValue;
        $this->contract_id->CurrentValue = $this->contract_id->FormValue;
        $this->tower_equipment_id->CurrentValue = $this->tower_equipment_id->FormValue;
        $this->installation_date->CurrentValue = $this->installation_date->FormValue;
        $this->installation_date->CurrentValue = UnFormatDateTime($this->installation_date->CurrentValue, $this->installation_date->formatPattern());
        $this->removal_date->CurrentValue = $this->removal_date->FormValue;
        $this->removal_date->CurrentValue = UnFormatDateTime($this->removal_date->CurrentValue, $this->removal_date->formatPattern());
        $this->status->CurrentValue = $this->status->FormValue;
        $this->maintenance_schedule->CurrentValue = $this->maintenance_schedule->FormValue;
        $this->last_maintenance_date->CurrentValue = $this->last_maintenance_date->FormValue;
        $this->last_maintenance_date->CurrentValue = UnFormatDateTime($this->last_maintenance_date->CurrentValue, $this->last_maintenance_date->formatPattern());
        $this->next_maintenance_date->CurrentValue = $this->next_maintenance_date->FormValue;
        $this->next_maintenance_date->CurrentValue = UnFormatDateTime($this->next_maintenance_date->CurrentValue, $this->next_maintenance_date->formatPattern());
        $this->notes->CurrentValue = $this->notes->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from result set or record
     *
     * @param array $row Record
     * @return void
     */
    public function loadRowValues($row = null)
    {
        $row = is_array($row) ? $row : $this->newRow();

        // Call Row Selected event
        $this->rowSelected($row);
        $this->equipment_id->setDbValue($row['equipment_id']);
        $this->client_id->setDbValue($row['client_id']);
        $this->contract_id->setDbValue($row['contract_id']);
        $this->tower_equipment_id->setDbValue($row['tower_equipment_id']);
        $this->installation_date->setDbValue($row['installation_date']);
        $this->removal_date->setDbValue($row['removal_date']);
        $this->status->setDbValue($row['status']);
        $this->maintenance_schedule->setDbValue($row['maintenance_schedule']);
        $this->last_maintenance_date->setDbValue($row['last_maintenance_date']);
        $this->next_maintenance_date->setDbValue($row['next_maintenance_date']);
        $this->notes->setDbValue($row['notes']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['equipment_id'] = $this->equipment_id->DefaultValue;
        $row['client_id'] = $this->client_id->DefaultValue;
        $row['contract_id'] = $this->contract_id->DefaultValue;
        $row['tower_equipment_id'] = $this->tower_equipment_id->DefaultValue;
        $row['installation_date'] = $this->installation_date->DefaultValue;
        $row['removal_date'] = $this->removal_date->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        $row['maintenance_schedule'] = $this->maintenance_schedule->DefaultValue;
        $row['last_maintenance_date'] = $this->last_maintenance_date->DefaultValue;
        $row['next_maintenance_date'] = $this->next_maintenance_date->DefaultValue;
        $row['notes'] = $this->notes->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        if ($this->OldKey != "") {
            $this->setKey($this->OldKey);
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = ExecuteQuery($sql, $conn);
            if ($row = $rs->fetch()) {
                $this->loadRowValues($row); // Load row values
                return $row;
            }
        }
        $this->loadRowValues(); // Load default row values
        return null;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // equipment_id
        $this->equipment_id->RowCssClass = "row";

        // client_id
        $this->client_id->RowCssClass = "row";

        // contract_id
        $this->contract_id->RowCssClass = "row";

        // tower_equipment_id
        $this->tower_equipment_id->RowCssClass = "row";

        // installation_date
        $this->installation_date->RowCssClass = "row";

        // removal_date
        $this->removal_date->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // maintenance_schedule
        $this->maintenance_schedule->RowCssClass = "row";

        // last_maintenance_date
        $this->last_maintenance_date->RowCssClass = "row";

        // next_maintenance_date
        $this->next_maintenance_date->RowCssClass = "row";

        // notes
        $this->notes->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // equipment_id
            $this->equipment_id->ViewValue = $this->equipment_id->CurrentValue;

            // client_id
            $this->client_id->ViewValue = $this->client_id->CurrentValue;
            $this->client_id->ViewValue = FormatNumber($this->client_id->ViewValue, $this->client_id->formatPattern());

            // contract_id
            $this->contract_id->ViewValue = $this->contract_id->CurrentValue;
            $this->contract_id->ViewValue = FormatNumber($this->contract_id->ViewValue, $this->contract_id->formatPattern());

            // tower_equipment_id
            $this->tower_equipment_id->ViewValue = $this->tower_equipment_id->CurrentValue;
            $this->tower_equipment_id->ViewValue = FormatNumber($this->tower_equipment_id->ViewValue, $this->tower_equipment_id->formatPattern());

            // installation_date
            $this->installation_date->ViewValue = $this->installation_date->CurrentValue;
            $this->installation_date->ViewValue = FormatDateTime($this->installation_date->ViewValue, $this->installation_date->formatPattern());

            // removal_date
            $this->removal_date->ViewValue = $this->removal_date->CurrentValue;
            $this->removal_date->ViewValue = FormatDateTime($this->removal_date->ViewValue, $this->removal_date->formatPattern());

            // status
            $this->status->ViewValue = $this->status->CurrentValue;

            // maintenance_schedule
            $this->maintenance_schedule->ViewValue = $this->maintenance_schedule->CurrentValue;

            // last_maintenance_date
            $this->last_maintenance_date->ViewValue = $this->last_maintenance_date->CurrentValue;
            $this->last_maintenance_date->ViewValue = FormatDateTime($this->last_maintenance_date->ViewValue, $this->last_maintenance_date->formatPattern());

            // next_maintenance_date
            $this->next_maintenance_date->ViewValue = $this->next_maintenance_date->CurrentValue;
            $this->next_maintenance_date->ViewValue = FormatDateTime($this->next_maintenance_date->ViewValue, $this->next_maintenance_date->formatPattern());

            // notes
            $this->notes->ViewValue = $this->notes->CurrentValue;

            // equipment_id
            $this->equipment_id->HrefValue = "";

            // client_id
            $this->client_id->HrefValue = "";

            // contract_id
            $this->contract_id->HrefValue = "";

            // tower_equipment_id
            $this->tower_equipment_id->HrefValue = "";

            // installation_date
            $this->installation_date->HrefValue = "";

            // removal_date
            $this->removal_date->HrefValue = "";

            // status
            $this->status->HrefValue = "";

            // maintenance_schedule
            $this->maintenance_schedule->HrefValue = "";

            // last_maintenance_date
            $this->last_maintenance_date->HrefValue = "";

            // next_maintenance_date
            $this->next_maintenance_date->HrefValue = "";

            // notes
            $this->notes->HrefValue = "";
        } elseif ($this->RowType == RowType::EDIT) {
            // equipment_id
            $this->equipment_id->setupEditAttributes();
            $this->equipment_id->EditValue = $this->equipment_id->CurrentValue;

            // client_id
            $this->client_id->setupEditAttributes();
            $this->client_id->EditValue = $this->client_id->CurrentValue;
            $this->client_id->PlaceHolder = RemoveHtml($this->client_id->caption());
            if (strval($this->client_id->EditValue) != "" && is_numeric($this->client_id->EditValue)) {
                $this->client_id->EditValue = FormatNumber($this->client_id->EditValue, null);
            }

            // contract_id
            $this->contract_id->setupEditAttributes();
            $this->contract_id->EditValue = $this->contract_id->CurrentValue;
            $this->contract_id->PlaceHolder = RemoveHtml($this->contract_id->caption());
            if (strval($this->contract_id->EditValue) != "" && is_numeric($this->contract_id->EditValue)) {
                $this->contract_id->EditValue = FormatNumber($this->contract_id->EditValue, null);
            }

            // tower_equipment_id
            $this->tower_equipment_id->setupEditAttributes();
            $this->tower_equipment_id->EditValue = $this->tower_equipment_id->CurrentValue;
            $this->tower_equipment_id->PlaceHolder = RemoveHtml($this->tower_equipment_id->caption());
            if (strval($this->tower_equipment_id->EditValue) != "" && is_numeric($this->tower_equipment_id->EditValue)) {
                $this->tower_equipment_id->EditValue = FormatNumber($this->tower_equipment_id->EditValue, null);
            }

            // installation_date
            $this->installation_date->setupEditAttributes();
            $this->installation_date->EditValue = HtmlEncode(FormatDateTime($this->installation_date->CurrentValue, $this->installation_date->formatPattern()));
            $this->installation_date->PlaceHolder = RemoveHtml($this->installation_date->caption());

            // removal_date
            $this->removal_date->setupEditAttributes();
            $this->removal_date->EditValue = HtmlEncode(FormatDateTime($this->removal_date->CurrentValue, $this->removal_date->formatPattern()));
            $this->removal_date->PlaceHolder = RemoveHtml($this->removal_date->caption());

            // status
            $this->status->setupEditAttributes();
            if (!$this->status->Raw) {
                $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->CurrentValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // maintenance_schedule
            $this->maintenance_schedule->setupEditAttributes();
            if (!$this->maintenance_schedule->Raw) {
                $this->maintenance_schedule->CurrentValue = HtmlDecode($this->maintenance_schedule->CurrentValue);
            }
            $this->maintenance_schedule->EditValue = HtmlEncode($this->maintenance_schedule->CurrentValue);
            $this->maintenance_schedule->PlaceHolder = RemoveHtml($this->maintenance_schedule->caption());

            // last_maintenance_date
            $this->last_maintenance_date->setupEditAttributes();
            $this->last_maintenance_date->EditValue = HtmlEncode(FormatDateTime($this->last_maintenance_date->CurrentValue, $this->last_maintenance_date->formatPattern()));
            $this->last_maintenance_date->PlaceHolder = RemoveHtml($this->last_maintenance_date->caption());

            // next_maintenance_date
            $this->next_maintenance_date->setupEditAttributes();
            $this->next_maintenance_date->EditValue = HtmlEncode(FormatDateTime($this->next_maintenance_date->CurrentValue, $this->next_maintenance_date->formatPattern()));
            $this->next_maintenance_date->PlaceHolder = RemoveHtml($this->next_maintenance_date->caption());

            // notes
            $this->notes->setupEditAttributes();
            $this->notes->EditValue = HtmlEncode($this->notes->CurrentValue);
            $this->notes->PlaceHolder = RemoveHtml($this->notes->caption());

            // Edit refer script

            // equipment_id
            $this->equipment_id->HrefValue = "";

            // client_id
            $this->client_id->HrefValue = "";

            // contract_id
            $this->contract_id->HrefValue = "";

            // tower_equipment_id
            $this->tower_equipment_id->HrefValue = "";

            // installation_date
            $this->installation_date->HrefValue = "";

            // removal_date
            $this->removal_date->HrefValue = "";

            // status
            $this->status->HrefValue = "";

            // maintenance_schedule
            $this->maintenance_schedule->HrefValue = "";

            // last_maintenance_date
            $this->last_maintenance_date->HrefValue = "";

            // next_maintenance_date
            $this->next_maintenance_date->HrefValue = "";

            // notes
            $this->notes->HrefValue = "";
        }
        if ($this->RowType == RowType::ADD || $this->RowType == RowType::EDIT || $this->RowType == RowType::SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != RowType::AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language, $Security;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
            if ($this->equipment_id->Visible && $this->equipment_id->Required) {
                if (!$this->equipment_id->IsDetailKey && EmptyValue($this->equipment_id->FormValue)) {
                    $this->equipment_id->addErrorMessage(str_replace("%s", $this->equipment_id->caption(), $this->equipment_id->RequiredErrorMessage));
                }
            }
            if ($this->client_id->Visible && $this->client_id->Required) {
                if (!$this->client_id->IsDetailKey && EmptyValue($this->client_id->FormValue)) {
                    $this->client_id->addErrorMessage(str_replace("%s", $this->client_id->caption(), $this->client_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->client_id->FormValue)) {
                $this->client_id->addErrorMessage($this->client_id->getErrorMessage(false));
            }
            if ($this->contract_id->Visible && $this->contract_id->Required) {
                if (!$this->contract_id->IsDetailKey && EmptyValue($this->contract_id->FormValue)) {
                    $this->contract_id->addErrorMessage(str_replace("%s", $this->contract_id->caption(), $this->contract_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->contract_id->FormValue)) {
                $this->contract_id->addErrorMessage($this->contract_id->getErrorMessage(false));
            }
            if ($this->tower_equipment_id->Visible && $this->tower_equipment_id->Required) {
                if (!$this->tower_equipment_id->IsDetailKey && EmptyValue($this->tower_equipment_id->FormValue)) {
                    $this->tower_equipment_id->addErrorMessage(str_replace("%s", $this->tower_equipment_id->caption(), $this->tower_equipment_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->tower_equipment_id->FormValue)) {
                $this->tower_equipment_id->addErrorMessage($this->tower_equipment_id->getErrorMessage(false));
            }
            if ($this->installation_date->Visible && $this->installation_date->Required) {
                if (!$this->installation_date->IsDetailKey && EmptyValue($this->installation_date->FormValue)) {
                    $this->installation_date->addErrorMessage(str_replace("%s", $this->installation_date->caption(), $this->installation_date->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->installation_date->FormValue, $this->installation_date->formatPattern())) {
                $this->installation_date->addErrorMessage($this->installation_date->getErrorMessage(false));
            }
            if ($this->removal_date->Visible && $this->removal_date->Required) {
                if (!$this->removal_date->IsDetailKey && EmptyValue($this->removal_date->FormValue)) {
                    $this->removal_date->addErrorMessage(str_replace("%s", $this->removal_date->caption(), $this->removal_date->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->removal_date->FormValue, $this->removal_date->formatPattern())) {
                $this->removal_date->addErrorMessage($this->removal_date->getErrorMessage(false));
            }
            if ($this->status->Visible && $this->status->Required) {
                if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                    $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
                }
            }
            if ($this->maintenance_schedule->Visible && $this->maintenance_schedule->Required) {
                if (!$this->maintenance_schedule->IsDetailKey && EmptyValue($this->maintenance_schedule->FormValue)) {
                    $this->maintenance_schedule->addErrorMessage(str_replace("%s", $this->maintenance_schedule->caption(), $this->maintenance_schedule->RequiredErrorMessage));
                }
            }
            if ($this->last_maintenance_date->Visible && $this->last_maintenance_date->Required) {
                if (!$this->last_maintenance_date->IsDetailKey && EmptyValue($this->last_maintenance_date->FormValue)) {
                    $this->last_maintenance_date->addErrorMessage(str_replace("%s", $this->last_maintenance_date->caption(), $this->last_maintenance_date->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->last_maintenance_date->FormValue, $this->last_maintenance_date->formatPattern())) {
                $this->last_maintenance_date->addErrorMessage($this->last_maintenance_date->getErrorMessage(false));
            }
            if ($this->next_maintenance_date->Visible && $this->next_maintenance_date->Required) {
                if (!$this->next_maintenance_date->IsDetailKey && EmptyValue($this->next_maintenance_date->FormValue)) {
                    $this->next_maintenance_date->addErrorMessage(str_replace("%s", $this->next_maintenance_date->caption(), $this->next_maintenance_date->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->next_maintenance_date->FormValue, $this->next_maintenance_date->formatPattern())) {
                $this->next_maintenance_date->addErrorMessage($this->next_maintenance_date->getErrorMessage(false));
            }
            if ($this->notes->Visible && $this->notes->Required) {
                if (!$this->notes->IsDetailKey && EmptyValue($this->notes->FormValue)) {
                    $this->notes->addErrorMessage(str_replace("%s", $this->notes->caption(), $this->notes->RequiredErrorMessage));
                }
            }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Load old values
            $this->loadDbValues($rsold);
        }

        // Get new row
        $rsnew = $this->getEditRow($rsold);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);
        if ($updateRow) {
            if (count($rsnew) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($rsnew, "", $rsold);
                if (!$editRow && !EmptyValue($this->DbErrorMessage)) { // Show database error
                    $this->setFailureMessage($this->DbErrorMessage);
                }
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("UpdateCancelled"));
            }
            $editRow = false;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_EDIT_ACTION"), $table => $row]);
        }
        return $editRow;
    }

    /**
     * Get edit row
     *
     * @return array
     */
    protected function getEditRow($rsold)
    {
        global $Security;
        $rsnew = [];

        // client_id
        $this->client_id->setDbValueDef($rsnew, $this->client_id->CurrentValue, $this->client_id->ReadOnly);

        // contract_id
        $this->contract_id->setDbValueDef($rsnew, $this->contract_id->CurrentValue, $this->contract_id->ReadOnly);

        // tower_equipment_id
        $this->tower_equipment_id->setDbValueDef($rsnew, $this->tower_equipment_id->CurrentValue, $this->tower_equipment_id->ReadOnly);

        // installation_date
        $this->installation_date->setDbValueDef($rsnew, UnFormatDateTime($this->installation_date->CurrentValue, $this->installation_date->formatPattern()), $this->installation_date->ReadOnly);

        // removal_date
        $this->removal_date->setDbValueDef($rsnew, UnFormatDateTime($this->removal_date->CurrentValue, $this->removal_date->formatPattern()), $this->removal_date->ReadOnly);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, $this->status->ReadOnly);

        // maintenance_schedule
        $this->maintenance_schedule->setDbValueDef($rsnew, $this->maintenance_schedule->CurrentValue, $this->maintenance_schedule->ReadOnly);

        // last_maintenance_date
        $this->last_maintenance_date->setDbValueDef($rsnew, UnFormatDateTime($this->last_maintenance_date->CurrentValue, $this->last_maintenance_date->formatPattern()), $this->last_maintenance_date->ReadOnly);

        // next_maintenance_date
        $this->next_maintenance_date->setDbValueDef($rsnew, UnFormatDateTime($this->next_maintenance_date->CurrentValue, $this->next_maintenance_date->formatPattern()), $this->next_maintenance_date->ReadOnly);

        // notes
        $this->notes->setDbValueDef($rsnew, $this->notes->CurrentValue, $this->notes->ReadOnly);
        return $rsnew;
    }

    /**
     * Restore edit form from row
     * @param array $row Row
     */
    protected function restoreEditFormFromRow($row)
    {
        if (isset($row['client_id'])) { // client_id
            $this->client_id->CurrentValue = $row['client_id'];
        }
        if (isset($row['contract_id'])) { // contract_id
            $this->contract_id->CurrentValue = $row['contract_id'];
        }
        if (isset($row['tower_equipment_id'])) { // tower_equipment_id
            $this->tower_equipment_id->CurrentValue = $row['tower_equipment_id'];
        }
        if (isset($row['installation_date'])) { // installation_date
            $this->installation_date->CurrentValue = $row['installation_date'];
        }
        if (isset($row['removal_date'])) { // removal_date
            $this->removal_date->CurrentValue = $row['removal_date'];
        }
        if (isset($row['status'])) { // status
            $this->status->CurrentValue = $row['status'];
        }
        if (isset($row['maintenance_schedule'])) { // maintenance_schedule
            $this->maintenance_schedule->CurrentValue = $row['maintenance_schedule'];
        }
        if (isset($row['last_maintenance_date'])) { // last_maintenance_date
            $this->last_maintenance_date->CurrentValue = $row['last_maintenance_date'];
        }
        if (isset($row['next_maintenance_date'])) { // next_maintenance_date
            $this->next_maintenance_date->CurrentValue = $row['next_maintenance_date'];
        }
        if (isset($row['notes'])) { // notes
            $this->notes->CurrentValue = $row['notes'];
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ClientEquipmentList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0 && count($fld->Lookup->FilterFields) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $key = $row["lf"];
                    if (IsFloatType($fld->Type)) { // Handle float field
                        $key = (float)$key;
                    }
                    $ar[strval($key)] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        $pageNo = Get(Config("TABLE_PAGE_NUMBER"));
        $startRec = Get(Config("TABLE_START_REC"));
        $infiniteScroll = false;
        $recordNo = $pageNo ?? $startRec; // Record number = page number or start record
        if ($recordNo !== null && is_numeric($recordNo)) {
            $this->StartRecord = $recordNo;
        } else {
            $this->StartRecord = $this->getStartRecordNumber();
        }

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || intval($this->StartRecord) <= 0) { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
        }
        if (!$infiniteScroll) {
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Get page count
    public function pageCount() {
        return ceil($this->TotalRecords / $this->DisplayRecords);
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == "success") {
            //$msg = "your success message";
        } elseif ($type == "failure") {
            //$msg = "your failure message";
        } elseif ($type == "warning") {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Page Breaking event
    public function pageBreaking(&$break, &$content)
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"break-after:page;\"></div>"; // Modify page break content
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
