<?php

namespace PHPMaker2024\AMS;

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
class MaintenanceLogsAdd extends MaintenanceLogs
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "MaintenanceLogsAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "MaintenanceLogsAdd";

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
        $this->log_id->Visible = false;
        $this->schedule_id->setVisibility();
        $this->start_time->setVisibility();
        $this->end_time->setVisibility();
        $this->performed_by->setVisibility();
        $this->verified_by->setVisibility();
        $this->status_id->setVisibility();
        $this->next_maintenance_date->setVisibility();
        $this->created_by->setVisibility();
        $this->created_at->setVisibility();
        $this->updated_by->setVisibility();
        $this->updated_at->setVisibility();
        $this->notes->setVisibility();
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'maintenance_logs';
        $this->TableName = 'maintenance_logs';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (maintenance_logs)
        if (!isset($GLOBALS["maintenance_logs"]) || $GLOBALS["maintenance_logs"]::class == PROJECT_NAMESPACE . "maintenance_logs") {
            $GLOBALS["maintenance_logs"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'maintenance_logs');
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
                        $result["view"] = SameString($pageName, "MaintenanceLogsView"); // If View page, no primary button
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
            $key .= @$ar['log_id'];
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
            $this->log_id->Visible = false;
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
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $CopyRecord;

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

        // Load default values for add
        $this->loadDefaultValues();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action", "") !== "") {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("log_id") ?? Route("log_id")) !== null) {
                $this->log_id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
                $this->setKey($this->OldKey); // Set up record key
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record or default values
        $rsold = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$rsold) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("MaintenanceLogsList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($rsold)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "MaintenanceLogsList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "MaintenanceLogsView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "MaintenanceLogsList") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "MaintenanceLogsList"; // Return list page content
                        }
                    }
                    if (IsJsonResponse()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
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
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = RowType::ADD; // Render add type

        // Render row
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

    // Load default values
    protected function loadDefaultValues()
    {
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'schedule_id' first before field var 'x_schedule_id'
        $val = $CurrentForm->hasValue("schedule_id") ? $CurrentForm->getValue("schedule_id") : $CurrentForm->getValue("x_schedule_id");
        if (!$this->schedule_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->schedule_id->Visible = false; // Disable update for API request
            } else {
                $this->schedule_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'start_time' first before field var 'x_start_time'
        $val = $CurrentForm->hasValue("start_time") ? $CurrentForm->getValue("start_time") : $CurrentForm->getValue("x_start_time");
        if (!$this->start_time->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->start_time->Visible = false; // Disable update for API request
            } else {
                $this->start_time->setFormValue($val, true, $validate);
            }
            $this->start_time->CurrentValue = UnFormatDateTime($this->start_time->CurrentValue, $this->start_time->formatPattern());
        }

        // Check field name 'end_time' first before field var 'x_end_time'
        $val = $CurrentForm->hasValue("end_time") ? $CurrentForm->getValue("end_time") : $CurrentForm->getValue("x_end_time");
        if (!$this->end_time->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->end_time->Visible = false; // Disable update for API request
            } else {
                $this->end_time->setFormValue($val, true, $validate);
            }
            $this->end_time->CurrentValue = UnFormatDateTime($this->end_time->CurrentValue, $this->end_time->formatPattern());
        }

        // Check field name 'performed_by' first before field var 'x_performed_by'
        $val = $CurrentForm->hasValue("performed_by") ? $CurrentForm->getValue("performed_by") : $CurrentForm->getValue("x_performed_by");
        if (!$this->performed_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->performed_by->Visible = false; // Disable update for API request
            } else {
                $this->performed_by->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'verified_by' first before field var 'x_verified_by'
        $val = $CurrentForm->hasValue("verified_by") ? $CurrentForm->getValue("verified_by") : $CurrentForm->getValue("x_verified_by");
        if (!$this->verified_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->verified_by->Visible = false; // Disable update for API request
            } else {
                $this->verified_by->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'status_id' first before field var 'x_status_id'
        $val = $CurrentForm->hasValue("status_id") ? $CurrentForm->getValue("status_id") : $CurrentForm->getValue("x_status_id");
        if (!$this->status_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status_id->Visible = false; // Disable update for API request
            } else {
                $this->status_id->setFormValue($val, true, $validate);
            }
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

        // Check field name 'created_by' first before field var 'x_created_by'
        $val = $CurrentForm->hasValue("created_by") ? $CurrentForm->getValue("created_by") : $CurrentForm->getValue("x_created_by");
        if (!$this->created_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->created_by->Visible = false; // Disable update for API request
            } else {
                $this->created_by->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'created_at' first before field var 'x_created_at'
        $val = $CurrentForm->hasValue("created_at") ? $CurrentForm->getValue("created_at") : $CurrentForm->getValue("x_created_at");
        if (!$this->created_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->created_at->Visible = false; // Disable update for API request
            } else {
                $this->created_at->setFormValue($val, true, $validate);
            }
            $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        }

        // Check field name 'updated_by' first before field var 'x_updated_by'
        $val = $CurrentForm->hasValue("updated_by") ? $CurrentForm->getValue("updated_by") : $CurrentForm->getValue("x_updated_by");
        if (!$this->updated_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->updated_by->Visible = false; // Disable update for API request
            } else {
                $this->updated_by->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'updated_at' first before field var 'x_updated_at'
        $val = $CurrentForm->hasValue("updated_at") ? $CurrentForm->getValue("updated_at") : $CurrentForm->getValue("x_updated_at");
        if (!$this->updated_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->updated_at->Visible = false; // Disable update for API request
            } else {
                $this->updated_at->setFormValue($val, true, $validate);
            }
            $this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
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

        // Check field name 'log_id' first before field var 'x_log_id'
        $val = $CurrentForm->hasValue("log_id") ? $CurrentForm->getValue("log_id") : $CurrentForm->getValue("x_log_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->schedule_id->CurrentValue = $this->schedule_id->FormValue;
        $this->start_time->CurrentValue = $this->start_time->FormValue;
        $this->start_time->CurrentValue = UnFormatDateTime($this->start_time->CurrentValue, $this->start_time->formatPattern());
        $this->end_time->CurrentValue = $this->end_time->FormValue;
        $this->end_time->CurrentValue = UnFormatDateTime($this->end_time->CurrentValue, $this->end_time->formatPattern());
        $this->performed_by->CurrentValue = $this->performed_by->FormValue;
        $this->verified_by->CurrentValue = $this->verified_by->FormValue;
        $this->status_id->CurrentValue = $this->status_id->FormValue;
        $this->next_maintenance_date->CurrentValue = $this->next_maintenance_date->FormValue;
        $this->next_maintenance_date->CurrentValue = UnFormatDateTime($this->next_maintenance_date->CurrentValue, $this->next_maintenance_date->formatPattern());
        $this->created_by->CurrentValue = $this->created_by->FormValue;
        $this->created_at->CurrentValue = $this->created_at->FormValue;
        $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        $this->updated_by->CurrentValue = $this->updated_by->FormValue;
        $this->updated_at->CurrentValue = $this->updated_at->FormValue;
        $this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
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
        $this->log_id->setDbValue($row['log_id']);
        $this->schedule_id->setDbValue($row['schedule_id']);
        $this->start_time->setDbValue($row['start_time']);
        $this->end_time->setDbValue($row['end_time']);
        $this->performed_by->setDbValue($row['performed_by']);
        $this->verified_by->setDbValue($row['verified_by']);
        $this->status_id->setDbValue($row['status_id']);
        $this->next_maintenance_date->setDbValue($row['next_maintenance_date']);
        $this->created_by->setDbValue($row['created_by']);
        $this->created_at->setDbValue($row['created_at']);
        $this->updated_by->setDbValue($row['updated_by']);
        $this->updated_at->setDbValue($row['updated_at']);
        $this->notes->setDbValue($row['notes']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['log_id'] = $this->log_id->DefaultValue;
        $row['schedule_id'] = $this->schedule_id->DefaultValue;
        $row['start_time'] = $this->start_time->DefaultValue;
        $row['end_time'] = $this->end_time->DefaultValue;
        $row['performed_by'] = $this->performed_by->DefaultValue;
        $row['verified_by'] = $this->verified_by->DefaultValue;
        $row['status_id'] = $this->status_id->DefaultValue;
        $row['next_maintenance_date'] = $this->next_maintenance_date->DefaultValue;
        $row['created_by'] = $this->created_by->DefaultValue;
        $row['created_at'] = $this->created_at->DefaultValue;
        $row['updated_by'] = $this->updated_by->DefaultValue;
        $row['updated_at'] = $this->updated_at->DefaultValue;
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

        // log_id
        $this->log_id->RowCssClass = "row";

        // schedule_id
        $this->schedule_id->RowCssClass = "row";

        // start_time
        $this->start_time->RowCssClass = "row";

        // end_time
        $this->end_time->RowCssClass = "row";

        // performed_by
        $this->performed_by->RowCssClass = "row";

        // verified_by
        $this->verified_by->RowCssClass = "row";

        // status_id
        $this->status_id->RowCssClass = "row";

        // next_maintenance_date
        $this->next_maintenance_date->RowCssClass = "row";

        // created_by
        $this->created_by->RowCssClass = "row";

        // created_at
        $this->created_at->RowCssClass = "row";

        // updated_by
        $this->updated_by->RowCssClass = "row";

        // updated_at
        $this->updated_at->RowCssClass = "row";

        // notes
        $this->notes->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // log_id
            $this->log_id->ViewValue = $this->log_id->CurrentValue;

            // schedule_id
            $this->schedule_id->ViewValue = $this->schedule_id->CurrentValue;
            $this->schedule_id->ViewValue = FormatNumber($this->schedule_id->ViewValue, $this->schedule_id->formatPattern());

            // start_time
            $this->start_time->ViewValue = $this->start_time->CurrentValue;
            $this->start_time->ViewValue = FormatDateTime($this->start_time->ViewValue, $this->start_time->formatPattern());

            // end_time
            $this->end_time->ViewValue = $this->end_time->CurrentValue;
            $this->end_time->ViewValue = FormatDateTime($this->end_time->ViewValue, $this->end_time->formatPattern());

            // performed_by
            $this->performed_by->ViewValue = $this->performed_by->CurrentValue;
            $this->performed_by->ViewValue = FormatNumber($this->performed_by->ViewValue, $this->performed_by->formatPattern());

            // verified_by
            $this->verified_by->ViewValue = $this->verified_by->CurrentValue;
            $this->verified_by->ViewValue = FormatNumber($this->verified_by->ViewValue, $this->verified_by->formatPattern());

            // status_id
            $this->status_id->ViewValue = $this->status_id->CurrentValue;
            $this->status_id->ViewValue = FormatNumber($this->status_id->ViewValue, $this->status_id->formatPattern());

            // next_maintenance_date
            $this->next_maintenance_date->ViewValue = $this->next_maintenance_date->CurrentValue;
            $this->next_maintenance_date->ViewValue = FormatDateTime($this->next_maintenance_date->ViewValue, $this->next_maintenance_date->formatPattern());

            // created_by
            $this->created_by->ViewValue = $this->created_by->CurrentValue;
            $this->created_by->ViewValue = FormatNumber($this->created_by->ViewValue, $this->created_by->formatPattern());

            // created_at
            $this->created_at->ViewValue = $this->created_at->CurrentValue;
            $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, $this->created_at->formatPattern());

            // updated_by
            $this->updated_by->ViewValue = $this->updated_by->CurrentValue;
            $this->updated_by->ViewValue = FormatNumber($this->updated_by->ViewValue, $this->updated_by->formatPattern());

            // updated_at
            $this->updated_at->ViewValue = $this->updated_at->CurrentValue;
            $this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, $this->updated_at->formatPattern());

            // notes
            $this->notes->ViewValue = $this->notes->CurrentValue;

            // schedule_id
            $this->schedule_id->HrefValue = "";

            // start_time
            $this->start_time->HrefValue = "";

            // end_time
            $this->end_time->HrefValue = "";

            // performed_by
            $this->performed_by->HrefValue = "";

            // verified_by
            $this->verified_by->HrefValue = "";

            // status_id
            $this->status_id->HrefValue = "";

            // next_maintenance_date
            $this->next_maintenance_date->HrefValue = "";

            // created_by
            $this->created_by->HrefValue = "";

            // created_at
            $this->created_at->HrefValue = "";

            // updated_by
            $this->updated_by->HrefValue = "";

            // updated_at
            $this->updated_at->HrefValue = "";

            // notes
            $this->notes->HrefValue = "";
        } elseif ($this->RowType == RowType::ADD) {
            // schedule_id
            $this->schedule_id->setupEditAttributes();
            $this->schedule_id->EditValue = $this->schedule_id->CurrentValue;
            $this->schedule_id->PlaceHolder = RemoveHtml($this->schedule_id->caption());
            if (strval($this->schedule_id->EditValue) != "" && is_numeric($this->schedule_id->EditValue)) {
                $this->schedule_id->EditValue = FormatNumber($this->schedule_id->EditValue, null);
            }

            // start_time
            $this->start_time->setupEditAttributes();
            $this->start_time->EditValue = HtmlEncode(FormatDateTime($this->start_time->CurrentValue, $this->start_time->formatPattern()));
            $this->start_time->PlaceHolder = RemoveHtml($this->start_time->caption());

            // end_time
            $this->end_time->setupEditAttributes();
            $this->end_time->EditValue = HtmlEncode(FormatDateTime($this->end_time->CurrentValue, $this->end_time->formatPattern()));
            $this->end_time->PlaceHolder = RemoveHtml($this->end_time->caption());

            // performed_by
            $this->performed_by->setupEditAttributes();
            $this->performed_by->EditValue = $this->performed_by->CurrentValue;
            $this->performed_by->PlaceHolder = RemoveHtml($this->performed_by->caption());
            if (strval($this->performed_by->EditValue) != "" && is_numeric($this->performed_by->EditValue)) {
                $this->performed_by->EditValue = FormatNumber($this->performed_by->EditValue, null);
            }

            // verified_by
            $this->verified_by->setupEditAttributes();
            $this->verified_by->EditValue = $this->verified_by->CurrentValue;
            $this->verified_by->PlaceHolder = RemoveHtml($this->verified_by->caption());
            if (strval($this->verified_by->EditValue) != "" && is_numeric($this->verified_by->EditValue)) {
                $this->verified_by->EditValue = FormatNumber($this->verified_by->EditValue, null);
            }

            // status_id
            $this->status_id->setupEditAttributes();
            $this->status_id->EditValue = $this->status_id->CurrentValue;
            $this->status_id->PlaceHolder = RemoveHtml($this->status_id->caption());
            if (strval($this->status_id->EditValue) != "" && is_numeric($this->status_id->EditValue)) {
                $this->status_id->EditValue = FormatNumber($this->status_id->EditValue, null);
            }

            // next_maintenance_date
            $this->next_maintenance_date->setupEditAttributes();
            $this->next_maintenance_date->EditValue = HtmlEncode(FormatDateTime($this->next_maintenance_date->CurrentValue, $this->next_maintenance_date->formatPattern()));
            $this->next_maintenance_date->PlaceHolder = RemoveHtml($this->next_maintenance_date->caption());

            // created_by
            $this->created_by->setupEditAttributes();
            $this->created_by->EditValue = $this->created_by->CurrentValue;
            $this->created_by->PlaceHolder = RemoveHtml($this->created_by->caption());
            if (strval($this->created_by->EditValue) != "" && is_numeric($this->created_by->EditValue)) {
                $this->created_by->EditValue = FormatNumber($this->created_by->EditValue, null);
            }

            // created_at
            $this->created_at->setupEditAttributes();
            $this->created_at->EditValue = HtmlEncode(FormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern()));
            $this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

            // updated_by
            $this->updated_by->setupEditAttributes();
            $this->updated_by->EditValue = $this->updated_by->CurrentValue;
            $this->updated_by->PlaceHolder = RemoveHtml($this->updated_by->caption());
            if (strval($this->updated_by->EditValue) != "" && is_numeric($this->updated_by->EditValue)) {
                $this->updated_by->EditValue = FormatNumber($this->updated_by->EditValue, null);
            }

            // updated_at
            $this->updated_at->setupEditAttributes();
            $this->updated_at->EditValue = HtmlEncode(FormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern()));
            $this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

            // notes
            $this->notes->setupEditAttributes();
            $this->notes->EditValue = HtmlEncode($this->notes->CurrentValue);
            $this->notes->PlaceHolder = RemoveHtml($this->notes->caption());

            // Add refer script

            // schedule_id
            $this->schedule_id->HrefValue = "";

            // start_time
            $this->start_time->HrefValue = "";

            // end_time
            $this->end_time->HrefValue = "";

            // performed_by
            $this->performed_by->HrefValue = "";

            // verified_by
            $this->verified_by->HrefValue = "";

            // status_id
            $this->status_id->HrefValue = "";

            // next_maintenance_date
            $this->next_maintenance_date->HrefValue = "";

            // created_by
            $this->created_by->HrefValue = "";

            // created_at
            $this->created_at->HrefValue = "";

            // updated_by
            $this->updated_by->HrefValue = "";

            // updated_at
            $this->updated_at->HrefValue = "";

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
            if ($this->schedule_id->Visible && $this->schedule_id->Required) {
                if (!$this->schedule_id->IsDetailKey && EmptyValue($this->schedule_id->FormValue)) {
                    $this->schedule_id->addErrorMessage(str_replace("%s", $this->schedule_id->caption(), $this->schedule_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->schedule_id->FormValue)) {
                $this->schedule_id->addErrorMessage($this->schedule_id->getErrorMessage(false));
            }
            if ($this->start_time->Visible && $this->start_time->Required) {
                if (!$this->start_time->IsDetailKey && EmptyValue($this->start_time->FormValue)) {
                    $this->start_time->addErrorMessage(str_replace("%s", $this->start_time->caption(), $this->start_time->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->start_time->FormValue, $this->start_time->formatPattern())) {
                $this->start_time->addErrorMessage($this->start_time->getErrorMessage(false));
            }
            if ($this->end_time->Visible && $this->end_time->Required) {
                if (!$this->end_time->IsDetailKey && EmptyValue($this->end_time->FormValue)) {
                    $this->end_time->addErrorMessage(str_replace("%s", $this->end_time->caption(), $this->end_time->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->end_time->FormValue, $this->end_time->formatPattern())) {
                $this->end_time->addErrorMessage($this->end_time->getErrorMessage(false));
            }
            if ($this->performed_by->Visible && $this->performed_by->Required) {
                if (!$this->performed_by->IsDetailKey && EmptyValue($this->performed_by->FormValue)) {
                    $this->performed_by->addErrorMessage(str_replace("%s", $this->performed_by->caption(), $this->performed_by->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->performed_by->FormValue)) {
                $this->performed_by->addErrorMessage($this->performed_by->getErrorMessage(false));
            }
            if ($this->verified_by->Visible && $this->verified_by->Required) {
                if (!$this->verified_by->IsDetailKey && EmptyValue($this->verified_by->FormValue)) {
                    $this->verified_by->addErrorMessage(str_replace("%s", $this->verified_by->caption(), $this->verified_by->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->verified_by->FormValue)) {
                $this->verified_by->addErrorMessage($this->verified_by->getErrorMessage(false));
            }
            if ($this->status_id->Visible && $this->status_id->Required) {
                if (!$this->status_id->IsDetailKey && EmptyValue($this->status_id->FormValue)) {
                    $this->status_id->addErrorMessage(str_replace("%s", $this->status_id->caption(), $this->status_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->status_id->FormValue)) {
                $this->status_id->addErrorMessage($this->status_id->getErrorMessage(false));
            }
            if ($this->next_maintenance_date->Visible && $this->next_maintenance_date->Required) {
                if (!$this->next_maintenance_date->IsDetailKey && EmptyValue($this->next_maintenance_date->FormValue)) {
                    $this->next_maintenance_date->addErrorMessage(str_replace("%s", $this->next_maintenance_date->caption(), $this->next_maintenance_date->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->next_maintenance_date->FormValue, $this->next_maintenance_date->formatPattern())) {
                $this->next_maintenance_date->addErrorMessage($this->next_maintenance_date->getErrorMessage(false));
            }
            if ($this->created_by->Visible && $this->created_by->Required) {
                if (!$this->created_by->IsDetailKey && EmptyValue($this->created_by->FormValue)) {
                    $this->created_by->addErrorMessage(str_replace("%s", $this->created_by->caption(), $this->created_by->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->created_by->FormValue)) {
                $this->created_by->addErrorMessage($this->created_by->getErrorMessage(false));
            }
            if ($this->created_at->Visible && $this->created_at->Required) {
                if (!$this->created_at->IsDetailKey && EmptyValue($this->created_at->FormValue)) {
                    $this->created_at->addErrorMessage(str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->created_at->FormValue, $this->created_at->formatPattern())) {
                $this->created_at->addErrorMessage($this->created_at->getErrorMessage(false));
            }
            if ($this->updated_by->Visible && $this->updated_by->Required) {
                if (!$this->updated_by->IsDetailKey && EmptyValue($this->updated_by->FormValue)) {
                    $this->updated_by->addErrorMessage(str_replace("%s", $this->updated_by->caption(), $this->updated_by->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->updated_by->FormValue)) {
                $this->updated_by->addErrorMessage($this->updated_by->getErrorMessage(false));
            }
            if ($this->updated_at->Visible && $this->updated_at->Required) {
                if (!$this->updated_at->IsDetailKey && EmptyValue($this->updated_at->FormValue)) {
                    $this->updated_at->addErrorMessage(str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->updated_at->FormValue, $this->updated_at->formatPattern())) {
                $this->updated_at->addErrorMessage($this->updated_at->getErrorMessage(false));
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Get new row
        $rsnew = $this->getAddRow();

        // Update current values
        $this->setCurrentValues($rsnew);
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            } elseif (!EmptyValue($this->DbErrorMessage)) { // Show database error
                $this->setFailureMessage($this->DbErrorMessage);
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_ADD_ACTION"), $table => $row]);
        }
        return $addRow;
    }

    /**
     * Get add row
     *
     * @return array
     */
    protected function getAddRow()
    {
        global $Security;
        $rsnew = [];

        // schedule_id
        $this->schedule_id->setDbValueDef($rsnew, $this->schedule_id->CurrentValue, false);

        // start_time
        $this->start_time->setDbValueDef($rsnew, UnFormatDateTime($this->start_time->CurrentValue, $this->start_time->formatPattern()), false);

        // end_time
        $this->end_time->setDbValueDef($rsnew, UnFormatDateTime($this->end_time->CurrentValue, $this->end_time->formatPattern()), false);

        // performed_by
        $this->performed_by->setDbValueDef($rsnew, $this->performed_by->CurrentValue, false);

        // verified_by
        $this->verified_by->setDbValueDef($rsnew, $this->verified_by->CurrentValue, false);

        // status_id
        $this->status_id->setDbValueDef($rsnew, $this->status_id->CurrentValue, false);

        // next_maintenance_date
        $this->next_maintenance_date->setDbValueDef($rsnew, UnFormatDateTime($this->next_maintenance_date->CurrentValue, $this->next_maintenance_date->formatPattern()), false);

        // created_by
        $this->created_by->setDbValueDef($rsnew, $this->created_by->CurrentValue, false);

        // created_at
        $this->created_at->setDbValueDef($rsnew, UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern()), false);

        // updated_by
        $this->updated_by->setDbValueDef($rsnew, $this->updated_by->CurrentValue, false);

        // updated_at
        $this->updated_at->setDbValueDef($rsnew, UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern()), false);

        // notes
        $this->notes->setDbValueDef($rsnew, $this->notes->CurrentValue, false);
        return $rsnew;
    }

    /**
     * Restore add form from row
     * @param array $row Row
     */
    protected function restoreAddFormFromRow($row)
    {
        if (isset($row['schedule_id'])) { // schedule_id
            $this->schedule_id->setFormValue($row['schedule_id']);
        }
        if (isset($row['start_time'])) { // start_time
            $this->start_time->setFormValue($row['start_time']);
        }
        if (isset($row['end_time'])) { // end_time
            $this->end_time->setFormValue($row['end_time']);
        }
        if (isset($row['performed_by'])) { // performed_by
            $this->performed_by->setFormValue($row['performed_by']);
        }
        if (isset($row['verified_by'])) { // verified_by
            $this->verified_by->setFormValue($row['verified_by']);
        }
        if (isset($row['status_id'])) { // status_id
            $this->status_id->setFormValue($row['status_id']);
        }
        if (isset($row['next_maintenance_date'])) { // next_maintenance_date
            $this->next_maintenance_date->setFormValue($row['next_maintenance_date']);
        }
        if (isset($row['created_by'])) { // created_by
            $this->created_by->setFormValue($row['created_by']);
        }
        if (isset($row['created_at'])) { // created_at
            $this->created_at->setFormValue($row['created_at']);
        }
        if (isset($row['updated_by'])) { // updated_by
            $this->updated_by->setFormValue($row['updated_by']);
        }
        if (isset($row['updated_at'])) { // updated_at
            $this->updated_at->setFormValue($row['updated_at']);
        }
        if (isset($row['notes'])) { // notes
            $this->notes->setFormValue($row['notes']);
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("MaintenanceLogsList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
