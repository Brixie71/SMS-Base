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
class ServiceRequestsEdit extends ServiceRequests
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "ServiceRequestsEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "ServiceRequestsEdit";

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
        $this->request_id->setVisibility();
        $this->client_id->setVisibility();
        $this->equipment_id->setVisibility();
        $this->request_type->setVisibility();
        $this->priority->setVisibility();
        $this->description->setVisibility();
        $this->requested_by->setVisibility();
        $this->requested_date->setVisibility();
        $this->scheduled_date->setVisibility();
        $this->completion_date->setVisibility();
        $this->status->setVisibility();
        $this->assigned_to->setVisibility();
        $this->resolution->setVisibility();
        $this->response_time_minutes->setVisibility();
        $this->notes->setVisibility();
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'service_requests';
        $this->TableName = 'service_requests';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-edit-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (service_requests)
        if (!isset($GLOBALS["service_requests"]) || $GLOBALS["service_requests"]::class == PROJECT_NAMESPACE . "service_requests") {
            $GLOBALS["service_requests"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'service_requests');
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
                        $result["view"] = SameString($pageName, "ServiceRequestsView"); // If View page, no primary button
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
            $key .= @$ar['request_id'];
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
            $this->request_id->Visible = false;
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
            if (($keyValue = Get("request_id") ?? Key(0) ?? Route(2)) !== null) {
                $this->request_id->setQueryStringValue($keyValue);
                $this->request_id->setOldValue($this->request_id->QueryStringValue);
            } elseif (Post("request_id") !== null) {
                $this->request_id->setFormValue(Post("request_id"));
                $this->request_id->setOldValue($this->request_id->FormValue);
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
                if (($keyValue = Get("request_id") ?? Route("request_id")) !== null) {
                    $this->request_id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->request_id->CurrentValue = null;
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
                        $this->terminate("ServiceRequestsList"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "ServiceRequestsList") {
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
                        if (GetPageName($returnUrl) != "ServiceRequestsList") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "ServiceRequestsList"; // Return list page content
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

        // Check field name 'request_id' first before field var 'x_request_id'
        $val = $CurrentForm->hasValue("request_id") ? $CurrentForm->getValue("request_id") : $CurrentForm->getValue("x_request_id");
        if (!$this->request_id->IsDetailKey) {
            $this->request_id->setFormValue($val);
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

        // Check field name 'equipment_id' first before field var 'x_equipment_id'
        $val = $CurrentForm->hasValue("equipment_id") ? $CurrentForm->getValue("equipment_id") : $CurrentForm->getValue("x_equipment_id");
        if (!$this->equipment_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->equipment_id->Visible = false; // Disable update for API request
            } else {
                $this->equipment_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'request_type' first before field var 'x_request_type'
        $val = $CurrentForm->hasValue("request_type") ? $CurrentForm->getValue("request_type") : $CurrentForm->getValue("x_request_type");
        if (!$this->request_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->request_type->Visible = false; // Disable update for API request
            } else {
                $this->request_type->setFormValue($val);
            }
        }

        // Check field name 'priority' first before field var 'x_priority'
        $val = $CurrentForm->hasValue("priority") ? $CurrentForm->getValue("priority") : $CurrentForm->getValue("x_priority");
        if (!$this->priority->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->priority->Visible = false; // Disable update for API request
            } else {
                $this->priority->setFormValue($val);
            }
        }

        // Check field name 'description' first before field var 'x_description'
        $val = $CurrentForm->hasValue("description") ? $CurrentForm->getValue("description") : $CurrentForm->getValue("x_description");
        if (!$this->description->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->description->Visible = false; // Disable update for API request
            } else {
                $this->description->setFormValue($val);
            }
        }

        // Check field name 'requested_by' first before field var 'x_requested_by'
        $val = $CurrentForm->hasValue("requested_by") ? $CurrentForm->getValue("requested_by") : $CurrentForm->getValue("x_requested_by");
        if (!$this->requested_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->requested_by->Visible = false; // Disable update for API request
            } else {
                $this->requested_by->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'requested_date' first before field var 'x_requested_date'
        $val = $CurrentForm->hasValue("requested_date") ? $CurrentForm->getValue("requested_date") : $CurrentForm->getValue("x_requested_date");
        if (!$this->requested_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->requested_date->Visible = false; // Disable update for API request
            } else {
                $this->requested_date->setFormValue($val, true, $validate);
            }
            $this->requested_date->CurrentValue = UnFormatDateTime($this->requested_date->CurrentValue, $this->requested_date->formatPattern());
        }

        // Check field name 'scheduled_date' first before field var 'x_scheduled_date'
        $val = $CurrentForm->hasValue("scheduled_date") ? $CurrentForm->getValue("scheduled_date") : $CurrentForm->getValue("x_scheduled_date");
        if (!$this->scheduled_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->scheduled_date->Visible = false; // Disable update for API request
            } else {
                $this->scheduled_date->setFormValue($val, true, $validate);
            }
            $this->scheduled_date->CurrentValue = UnFormatDateTime($this->scheduled_date->CurrentValue, $this->scheduled_date->formatPattern());
        }

        // Check field name 'completion_date' first before field var 'x_completion_date'
        $val = $CurrentForm->hasValue("completion_date") ? $CurrentForm->getValue("completion_date") : $CurrentForm->getValue("x_completion_date");
        if (!$this->completion_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->completion_date->Visible = false; // Disable update for API request
            } else {
                $this->completion_date->setFormValue($val, true, $validate);
            }
            $this->completion_date->CurrentValue = UnFormatDateTime($this->completion_date->CurrentValue, $this->completion_date->formatPattern());
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

        // Check field name 'assigned_to' first before field var 'x_assigned_to'
        $val = $CurrentForm->hasValue("assigned_to") ? $CurrentForm->getValue("assigned_to") : $CurrentForm->getValue("x_assigned_to");
        if (!$this->assigned_to->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->assigned_to->Visible = false; // Disable update for API request
            } else {
                $this->assigned_to->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'resolution' first before field var 'x_resolution'
        $val = $CurrentForm->hasValue("resolution") ? $CurrentForm->getValue("resolution") : $CurrentForm->getValue("x_resolution");
        if (!$this->resolution->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->resolution->Visible = false; // Disable update for API request
            } else {
                $this->resolution->setFormValue($val);
            }
        }

        // Check field name 'response_time_minutes' first before field var 'x_response_time_minutes'
        $val = $CurrentForm->hasValue("response_time_minutes") ? $CurrentForm->getValue("response_time_minutes") : $CurrentForm->getValue("x_response_time_minutes");
        if (!$this->response_time_minutes->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->response_time_minutes->Visible = false; // Disable update for API request
            } else {
                $this->response_time_minutes->setFormValue($val, true, $validate);
            }
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
        $this->request_id->CurrentValue = $this->request_id->FormValue;
        $this->client_id->CurrentValue = $this->client_id->FormValue;
        $this->equipment_id->CurrentValue = $this->equipment_id->FormValue;
        $this->request_type->CurrentValue = $this->request_type->FormValue;
        $this->priority->CurrentValue = $this->priority->FormValue;
        $this->description->CurrentValue = $this->description->FormValue;
        $this->requested_by->CurrentValue = $this->requested_by->FormValue;
        $this->requested_date->CurrentValue = $this->requested_date->FormValue;
        $this->requested_date->CurrentValue = UnFormatDateTime($this->requested_date->CurrentValue, $this->requested_date->formatPattern());
        $this->scheduled_date->CurrentValue = $this->scheduled_date->FormValue;
        $this->scheduled_date->CurrentValue = UnFormatDateTime($this->scheduled_date->CurrentValue, $this->scheduled_date->formatPattern());
        $this->completion_date->CurrentValue = $this->completion_date->FormValue;
        $this->completion_date->CurrentValue = UnFormatDateTime($this->completion_date->CurrentValue, $this->completion_date->formatPattern());
        $this->status->CurrentValue = $this->status->FormValue;
        $this->assigned_to->CurrentValue = $this->assigned_to->FormValue;
        $this->resolution->CurrentValue = $this->resolution->FormValue;
        $this->response_time_minutes->CurrentValue = $this->response_time_minutes->FormValue;
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
        $this->request_id->setDbValue($row['request_id']);
        $this->client_id->setDbValue($row['client_id']);
        $this->equipment_id->setDbValue($row['equipment_id']);
        $this->request_type->setDbValue($row['request_type']);
        $this->priority->setDbValue($row['priority']);
        $this->description->setDbValue($row['description']);
        $this->requested_by->setDbValue($row['requested_by']);
        $this->requested_date->setDbValue($row['requested_date']);
        $this->scheduled_date->setDbValue($row['scheduled_date']);
        $this->completion_date->setDbValue($row['completion_date']);
        $this->status->setDbValue($row['status']);
        $this->assigned_to->setDbValue($row['assigned_to']);
        $this->resolution->setDbValue($row['resolution']);
        $this->response_time_minutes->setDbValue($row['response_time_minutes']);
        $this->notes->setDbValue($row['notes']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['request_id'] = $this->request_id->DefaultValue;
        $row['client_id'] = $this->client_id->DefaultValue;
        $row['equipment_id'] = $this->equipment_id->DefaultValue;
        $row['request_type'] = $this->request_type->DefaultValue;
        $row['priority'] = $this->priority->DefaultValue;
        $row['description'] = $this->description->DefaultValue;
        $row['requested_by'] = $this->requested_by->DefaultValue;
        $row['requested_date'] = $this->requested_date->DefaultValue;
        $row['scheduled_date'] = $this->scheduled_date->DefaultValue;
        $row['completion_date'] = $this->completion_date->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        $row['assigned_to'] = $this->assigned_to->DefaultValue;
        $row['resolution'] = $this->resolution->DefaultValue;
        $row['response_time_minutes'] = $this->response_time_minutes->DefaultValue;
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

        // request_id
        $this->request_id->RowCssClass = "row";

        // client_id
        $this->client_id->RowCssClass = "row";

        // equipment_id
        $this->equipment_id->RowCssClass = "row";

        // request_type
        $this->request_type->RowCssClass = "row";

        // priority
        $this->priority->RowCssClass = "row";

        // description
        $this->description->RowCssClass = "row";

        // requested_by
        $this->requested_by->RowCssClass = "row";

        // requested_date
        $this->requested_date->RowCssClass = "row";

        // scheduled_date
        $this->scheduled_date->RowCssClass = "row";

        // completion_date
        $this->completion_date->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // assigned_to
        $this->assigned_to->RowCssClass = "row";

        // resolution
        $this->resolution->RowCssClass = "row";

        // response_time_minutes
        $this->response_time_minutes->RowCssClass = "row";

        // notes
        $this->notes->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // request_id
            $this->request_id->ViewValue = $this->request_id->CurrentValue;

            // client_id
            $this->client_id->ViewValue = $this->client_id->CurrentValue;
            $this->client_id->ViewValue = FormatNumber($this->client_id->ViewValue, $this->client_id->formatPattern());

            // equipment_id
            $this->equipment_id->ViewValue = $this->equipment_id->CurrentValue;
            $this->equipment_id->ViewValue = FormatNumber($this->equipment_id->ViewValue, $this->equipment_id->formatPattern());

            // request_type
            $this->request_type->ViewValue = $this->request_type->CurrentValue;

            // priority
            $this->priority->ViewValue = $this->priority->CurrentValue;

            // description
            $this->description->ViewValue = $this->description->CurrentValue;

            // requested_by
            $this->requested_by->ViewValue = $this->requested_by->CurrentValue;
            $this->requested_by->ViewValue = FormatNumber($this->requested_by->ViewValue, $this->requested_by->formatPattern());

            // requested_date
            $this->requested_date->ViewValue = $this->requested_date->CurrentValue;
            $this->requested_date->ViewValue = FormatDateTime($this->requested_date->ViewValue, $this->requested_date->formatPattern());

            // scheduled_date
            $this->scheduled_date->ViewValue = $this->scheduled_date->CurrentValue;
            $this->scheduled_date->ViewValue = FormatDateTime($this->scheduled_date->ViewValue, $this->scheduled_date->formatPattern());

            // completion_date
            $this->completion_date->ViewValue = $this->completion_date->CurrentValue;
            $this->completion_date->ViewValue = FormatDateTime($this->completion_date->ViewValue, $this->completion_date->formatPattern());

            // status
            $this->status->ViewValue = $this->status->CurrentValue;

            // assigned_to
            $this->assigned_to->ViewValue = $this->assigned_to->CurrentValue;
            $this->assigned_to->ViewValue = FormatNumber($this->assigned_to->ViewValue, $this->assigned_to->formatPattern());

            // resolution
            $this->resolution->ViewValue = $this->resolution->CurrentValue;

            // response_time_minutes
            $this->response_time_minutes->ViewValue = $this->response_time_minutes->CurrentValue;
            $this->response_time_minutes->ViewValue = FormatNumber($this->response_time_minutes->ViewValue, $this->response_time_minutes->formatPattern());

            // notes
            $this->notes->ViewValue = $this->notes->CurrentValue;

            // request_id
            $this->request_id->HrefValue = "";

            // client_id
            $this->client_id->HrefValue = "";

            // equipment_id
            $this->equipment_id->HrefValue = "";

            // request_type
            $this->request_type->HrefValue = "";

            // priority
            $this->priority->HrefValue = "";

            // description
            $this->description->HrefValue = "";

            // requested_by
            $this->requested_by->HrefValue = "";

            // requested_date
            $this->requested_date->HrefValue = "";

            // scheduled_date
            $this->scheduled_date->HrefValue = "";

            // completion_date
            $this->completion_date->HrefValue = "";

            // status
            $this->status->HrefValue = "";

            // assigned_to
            $this->assigned_to->HrefValue = "";

            // resolution
            $this->resolution->HrefValue = "";

            // response_time_minutes
            $this->response_time_minutes->HrefValue = "";

            // notes
            $this->notes->HrefValue = "";
        } elseif ($this->RowType == RowType::EDIT) {
            // request_id
            $this->request_id->setupEditAttributes();
            $this->request_id->EditValue = $this->request_id->CurrentValue;

            // client_id
            $this->client_id->setupEditAttributes();
            $this->client_id->EditValue = $this->client_id->CurrentValue;
            $this->client_id->PlaceHolder = RemoveHtml($this->client_id->caption());
            if (strval($this->client_id->EditValue) != "" && is_numeric($this->client_id->EditValue)) {
                $this->client_id->EditValue = FormatNumber($this->client_id->EditValue, null);
            }

            // equipment_id
            $this->equipment_id->setupEditAttributes();
            $this->equipment_id->EditValue = $this->equipment_id->CurrentValue;
            $this->equipment_id->PlaceHolder = RemoveHtml($this->equipment_id->caption());
            if (strval($this->equipment_id->EditValue) != "" && is_numeric($this->equipment_id->EditValue)) {
                $this->equipment_id->EditValue = FormatNumber($this->equipment_id->EditValue, null);
            }

            // request_type
            $this->request_type->setupEditAttributes();
            if (!$this->request_type->Raw) {
                $this->request_type->CurrentValue = HtmlDecode($this->request_type->CurrentValue);
            }
            $this->request_type->EditValue = HtmlEncode($this->request_type->CurrentValue);
            $this->request_type->PlaceHolder = RemoveHtml($this->request_type->caption());

            // priority
            $this->priority->setupEditAttributes();
            if (!$this->priority->Raw) {
                $this->priority->CurrentValue = HtmlDecode($this->priority->CurrentValue);
            }
            $this->priority->EditValue = HtmlEncode($this->priority->CurrentValue);
            $this->priority->PlaceHolder = RemoveHtml($this->priority->caption());

            // description
            $this->description->setupEditAttributes();
            $this->description->EditValue = HtmlEncode($this->description->CurrentValue);
            $this->description->PlaceHolder = RemoveHtml($this->description->caption());

            // requested_by
            $this->requested_by->setupEditAttributes();
            $this->requested_by->EditValue = $this->requested_by->CurrentValue;
            $this->requested_by->PlaceHolder = RemoveHtml($this->requested_by->caption());
            if (strval($this->requested_by->EditValue) != "" && is_numeric($this->requested_by->EditValue)) {
                $this->requested_by->EditValue = FormatNumber($this->requested_by->EditValue, null);
            }

            // requested_date
            $this->requested_date->setupEditAttributes();
            $this->requested_date->EditValue = HtmlEncode(FormatDateTime($this->requested_date->CurrentValue, $this->requested_date->formatPattern()));
            $this->requested_date->PlaceHolder = RemoveHtml($this->requested_date->caption());

            // scheduled_date
            $this->scheduled_date->setupEditAttributes();
            $this->scheduled_date->EditValue = HtmlEncode(FormatDateTime($this->scheduled_date->CurrentValue, $this->scheduled_date->formatPattern()));
            $this->scheduled_date->PlaceHolder = RemoveHtml($this->scheduled_date->caption());

            // completion_date
            $this->completion_date->setupEditAttributes();
            $this->completion_date->EditValue = HtmlEncode(FormatDateTime($this->completion_date->CurrentValue, $this->completion_date->formatPattern()));
            $this->completion_date->PlaceHolder = RemoveHtml($this->completion_date->caption());

            // status
            $this->status->setupEditAttributes();
            if (!$this->status->Raw) {
                $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->CurrentValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // assigned_to
            $this->assigned_to->setupEditAttributes();
            $this->assigned_to->EditValue = $this->assigned_to->CurrentValue;
            $this->assigned_to->PlaceHolder = RemoveHtml($this->assigned_to->caption());
            if (strval($this->assigned_to->EditValue) != "" && is_numeric($this->assigned_to->EditValue)) {
                $this->assigned_to->EditValue = FormatNumber($this->assigned_to->EditValue, null);
            }

            // resolution
            $this->resolution->setupEditAttributes();
            $this->resolution->EditValue = HtmlEncode($this->resolution->CurrentValue);
            $this->resolution->PlaceHolder = RemoveHtml($this->resolution->caption());

            // response_time_minutes
            $this->response_time_minutes->setupEditAttributes();
            $this->response_time_minutes->EditValue = $this->response_time_minutes->CurrentValue;
            $this->response_time_minutes->PlaceHolder = RemoveHtml($this->response_time_minutes->caption());
            if (strval($this->response_time_minutes->EditValue) != "" && is_numeric($this->response_time_minutes->EditValue)) {
                $this->response_time_minutes->EditValue = FormatNumber($this->response_time_minutes->EditValue, null);
            }

            // notes
            $this->notes->setupEditAttributes();
            $this->notes->EditValue = HtmlEncode($this->notes->CurrentValue);
            $this->notes->PlaceHolder = RemoveHtml($this->notes->caption());

            // Edit refer script

            // request_id
            $this->request_id->HrefValue = "";

            // client_id
            $this->client_id->HrefValue = "";

            // equipment_id
            $this->equipment_id->HrefValue = "";

            // request_type
            $this->request_type->HrefValue = "";

            // priority
            $this->priority->HrefValue = "";

            // description
            $this->description->HrefValue = "";

            // requested_by
            $this->requested_by->HrefValue = "";

            // requested_date
            $this->requested_date->HrefValue = "";

            // scheduled_date
            $this->scheduled_date->HrefValue = "";

            // completion_date
            $this->completion_date->HrefValue = "";

            // status
            $this->status->HrefValue = "";

            // assigned_to
            $this->assigned_to->HrefValue = "";

            // resolution
            $this->resolution->HrefValue = "";

            // response_time_minutes
            $this->response_time_minutes->HrefValue = "";

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
            if ($this->request_id->Visible && $this->request_id->Required) {
                if (!$this->request_id->IsDetailKey && EmptyValue($this->request_id->FormValue)) {
                    $this->request_id->addErrorMessage(str_replace("%s", $this->request_id->caption(), $this->request_id->RequiredErrorMessage));
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
            if ($this->equipment_id->Visible && $this->equipment_id->Required) {
                if (!$this->equipment_id->IsDetailKey && EmptyValue($this->equipment_id->FormValue)) {
                    $this->equipment_id->addErrorMessage(str_replace("%s", $this->equipment_id->caption(), $this->equipment_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->equipment_id->FormValue)) {
                $this->equipment_id->addErrorMessage($this->equipment_id->getErrorMessage(false));
            }
            if ($this->request_type->Visible && $this->request_type->Required) {
                if (!$this->request_type->IsDetailKey && EmptyValue($this->request_type->FormValue)) {
                    $this->request_type->addErrorMessage(str_replace("%s", $this->request_type->caption(), $this->request_type->RequiredErrorMessage));
                }
            }
            if ($this->priority->Visible && $this->priority->Required) {
                if (!$this->priority->IsDetailKey && EmptyValue($this->priority->FormValue)) {
                    $this->priority->addErrorMessage(str_replace("%s", $this->priority->caption(), $this->priority->RequiredErrorMessage));
                }
            }
            if ($this->description->Visible && $this->description->Required) {
                if (!$this->description->IsDetailKey && EmptyValue($this->description->FormValue)) {
                    $this->description->addErrorMessage(str_replace("%s", $this->description->caption(), $this->description->RequiredErrorMessage));
                }
            }
            if ($this->requested_by->Visible && $this->requested_by->Required) {
                if (!$this->requested_by->IsDetailKey && EmptyValue($this->requested_by->FormValue)) {
                    $this->requested_by->addErrorMessage(str_replace("%s", $this->requested_by->caption(), $this->requested_by->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->requested_by->FormValue)) {
                $this->requested_by->addErrorMessage($this->requested_by->getErrorMessage(false));
            }
            if ($this->requested_date->Visible && $this->requested_date->Required) {
                if (!$this->requested_date->IsDetailKey && EmptyValue($this->requested_date->FormValue)) {
                    $this->requested_date->addErrorMessage(str_replace("%s", $this->requested_date->caption(), $this->requested_date->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->requested_date->FormValue, $this->requested_date->formatPattern())) {
                $this->requested_date->addErrorMessage($this->requested_date->getErrorMessage(false));
            }
            if ($this->scheduled_date->Visible && $this->scheduled_date->Required) {
                if (!$this->scheduled_date->IsDetailKey && EmptyValue($this->scheduled_date->FormValue)) {
                    $this->scheduled_date->addErrorMessage(str_replace("%s", $this->scheduled_date->caption(), $this->scheduled_date->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->scheduled_date->FormValue, $this->scheduled_date->formatPattern())) {
                $this->scheduled_date->addErrorMessage($this->scheduled_date->getErrorMessage(false));
            }
            if ($this->completion_date->Visible && $this->completion_date->Required) {
                if (!$this->completion_date->IsDetailKey && EmptyValue($this->completion_date->FormValue)) {
                    $this->completion_date->addErrorMessage(str_replace("%s", $this->completion_date->caption(), $this->completion_date->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->completion_date->FormValue, $this->completion_date->formatPattern())) {
                $this->completion_date->addErrorMessage($this->completion_date->getErrorMessage(false));
            }
            if ($this->status->Visible && $this->status->Required) {
                if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                    $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
                }
            }
            if ($this->assigned_to->Visible && $this->assigned_to->Required) {
                if (!$this->assigned_to->IsDetailKey && EmptyValue($this->assigned_to->FormValue)) {
                    $this->assigned_to->addErrorMessage(str_replace("%s", $this->assigned_to->caption(), $this->assigned_to->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->assigned_to->FormValue)) {
                $this->assigned_to->addErrorMessage($this->assigned_to->getErrorMessage(false));
            }
            if ($this->resolution->Visible && $this->resolution->Required) {
                if (!$this->resolution->IsDetailKey && EmptyValue($this->resolution->FormValue)) {
                    $this->resolution->addErrorMessage(str_replace("%s", $this->resolution->caption(), $this->resolution->RequiredErrorMessage));
                }
            }
            if ($this->response_time_minutes->Visible && $this->response_time_minutes->Required) {
                if (!$this->response_time_minutes->IsDetailKey && EmptyValue($this->response_time_minutes->FormValue)) {
                    $this->response_time_minutes->addErrorMessage(str_replace("%s", $this->response_time_minutes->caption(), $this->response_time_minutes->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->response_time_minutes->FormValue)) {
                $this->response_time_minutes->addErrorMessage($this->response_time_minutes->getErrorMessage(false));
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

        // equipment_id
        $this->equipment_id->setDbValueDef($rsnew, $this->equipment_id->CurrentValue, $this->equipment_id->ReadOnly);

        // request_type
        $this->request_type->setDbValueDef($rsnew, $this->request_type->CurrentValue, $this->request_type->ReadOnly);

        // priority
        $this->priority->setDbValueDef($rsnew, $this->priority->CurrentValue, $this->priority->ReadOnly);

        // description
        $this->description->setDbValueDef($rsnew, $this->description->CurrentValue, $this->description->ReadOnly);

        // requested_by
        $this->requested_by->setDbValueDef($rsnew, $this->requested_by->CurrentValue, $this->requested_by->ReadOnly);

        // requested_date
        $this->requested_date->setDbValueDef($rsnew, UnFormatDateTime($this->requested_date->CurrentValue, $this->requested_date->formatPattern()), $this->requested_date->ReadOnly);

        // scheduled_date
        $this->scheduled_date->setDbValueDef($rsnew, UnFormatDateTime($this->scheduled_date->CurrentValue, $this->scheduled_date->formatPattern()), $this->scheduled_date->ReadOnly);

        // completion_date
        $this->completion_date->setDbValueDef($rsnew, UnFormatDateTime($this->completion_date->CurrentValue, $this->completion_date->formatPattern()), $this->completion_date->ReadOnly);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, $this->status->ReadOnly);

        // assigned_to
        $this->assigned_to->setDbValueDef($rsnew, $this->assigned_to->CurrentValue, $this->assigned_to->ReadOnly);

        // resolution
        $this->resolution->setDbValueDef($rsnew, $this->resolution->CurrentValue, $this->resolution->ReadOnly);

        // response_time_minutes
        $this->response_time_minutes->setDbValueDef($rsnew, $this->response_time_minutes->CurrentValue, $this->response_time_minutes->ReadOnly);

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
        if (isset($row['equipment_id'])) { // equipment_id
            $this->equipment_id->CurrentValue = $row['equipment_id'];
        }
        if (isset($row['request_type'])) { // request_type
            $this->request_type->CurrentValue = $row['request_type'];
        }
        if (isset($row['priority'])) { // priority
            $this->priority->CurrentValue = $row['priority'];
        }
        if (isset($row['description'])) { // description
            $this->description->CurrentValue = $row['description'];
        }
        if (isset($row['requested_by'])) { // requested_by
            $this->requested_by->CurrentValue = $row['requested_by'];
        }
        if (isset($row['requested_date'])) { // requested_date
            $this->requested_date->CurrentValue = $row['requested_date'];
        }
        if (isset($row['scheduled_date'])) { // scheduled_date
            $this->scheduled_date->CurrentValue = $row['scheduled_date'];
        }
        if (isset($row['completion_date'])) { // completion_date
            $this->completion_date->CurrentValue = $row['completion_date'];
        }
        if (isset($row['status'])) { // status
            $this->status->CurrentValue = $row['status'];
        }
        if (isset($row['assigned_to'])) { // assigned_to
            $this->assigned_to->CurrentValue = $row['assigned_to'];
        }
        if (isset($row['resolution'])) { // resolution
            $this->resolution->CurrentValue = $row['resolution'];
        }
        if (isset($row['response_time_minutes'])) { // response_time_minutes
            $this->response_time_minutes->CurrentValue = $row['response_time_minutes'];
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ServiceRequestsList"), "", $this->TableVar, true);
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
