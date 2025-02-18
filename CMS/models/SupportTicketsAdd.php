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
class SupportTicketsAdd extends SupportTickets
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "SupportTicketsAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "SupportTicketsAdd";

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
        $this->ticket_id->Visible = false;
        $this->client_id->setVisibility();
        $this->equipment_id->setVisibility();
        $this->subject->setVisibility();
        $this->description->setVisibility();
        $this->priority->setVisibility();
        $this->category->setVisibility();
        $this->submitted_by->setVisibility();
        $this->assigned_to->setVisibility();
        $this->created_at->setVisibility();
        $this->status->setVisibility();
        $this->resolution->setVisibility();
        $this->closed_at->setVisibility();
        $this->response_time_minutes->setVisibility();
        $this->resolution_time_minutes->setVisibility();
        $this->sla_compliant->setVisibility();
        $this->closed_by->setVisibility();
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'support_tickets';
        $this->TableName = 'support_tickets';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (support_tickets)
        if (!isset($GLOBALS["support_tickets"]) || $GLOBALS["support_tickets"]::class == PROJECT_NAMESPACE . "support_tickets") {
            $GLOBALS["support_tickets"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'support_tickets');
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
                        $result["view"] = SameString($pageName, "SupportTicketsView"); // If View page, no primary button
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
            $key .= @$ar['ticket_id'];
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
            $this->ticket_id->Visible = false;
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

        // Set up lookup cache
        $this->setupLookupOptions($this->sla_compliant);

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
            if (($keyValue = Get("ticket_id") ?? Route("ticket_id")) !== null) {
                $this->ticket_id->setQueryStringValue($keyValue);
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
                    $this->terminate("SupportTicketsList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "SupportTicketsList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "SupportTicketsView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "SupportTicketsList") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "SupportTicketsList"; // Return list page content
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

        // Check field name 'subject' first before field var 'x_subject'
        $val = $CurrentForm->hasValue("subject") ? $CurrentForm->getValue("subject") : $CurrentForm->getValue("x_subject");
        if (!$this->subject->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->subject->Visible = false; // Disable update for API request
            } else {
                $this->subject->setFormValue($val);
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

        // Check field name 'priority' first before field var 'x_priority'
        $val = $CurrentForm->hasValue("priority") ? $CurrentForm->getValue("priority") : $CurrentForm->getValue("x_priority");
        if (!$this->priority->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->priority->Visible = false; // Disable update for API request
            } else {
                $this->priority->setFormValue($val);
            }
        }

        // Check field name 'category' first before field var 'x_category'
        $val = $CurrentForm->hasValue("category") ? $CurrentForm->getValue("category") : $CurrentForm->getValue("x_category");
        if (!$this->category->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->category->Visible = false; // Disable update for API request
            } else {
                $this->category->setFormValue($val);
            }
        }

        // Check field name 'submitted_by' first before field var 'x_submitted_by'
        $val = $CurrentForm->hasValue("submitted_by") ? $CurrentForm->getValue("submitted_by") : $CurrentForm->getValue("x_submitted_by");
        if (!$this->submitted_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->submitted_by->Visible = false; // Disable update for API request
            } else {
                $this->submitted_by->setFormValue($val, true, $validate);
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

        // Check field name 'status' first before field var 'x_status'
        $val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
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

        // Check field name 'closed_at' first before field var 'x_closed_at'
        $val = $CurrentForm->hasValue("closed_at") ? $CurrentForm->getValue("closed_at") : $CurrentForm->getValue("x_closed_at");
        if (!$this->closed_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->closed_at->Visible = false; // Disable update for API request
            } else {
                $this->closed_at->setFormValue($val, true, $validate);
            }
            $this->closed_at->CurrentValue = UnFormatDateTime($this->closed_at->CurrentValue, $this->closed_at->formatPattern());
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

        // Check field name 'resolution_time_minutes' first before field var 'x_resolution_time_minutes'
        $val = $CurrentForm->hasValue("resolution_time_minutes") ? $CurrentForm->getValue("resolution_time_minutes") : $CurrentForm->getValue("x_resolution_time_minutes");
        if (!$this->resolution_time_minutes->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->resolution_time_minutes->Visible = false; // Disable update for API request
            } else {
                $this->resolution_time_minutes->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'sla_compliant' first before field var 'x_sla_compliant'
        $val = $CurrentForm->hasValue("sla_compliant") ? $CurrentForm->getValue("sla_compliant") : $CurrentForm->getValue("x_sla_compliant");
        if (!$this->sla_compliant->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sla_compliant->Visible = false; // Disable update for API request
            } else {
                $this->sla_compliant->setFormValue($val);
            }
        }

        // Check field name 'closed_by' first before field var 'x_closed_by'
        $val = $CurrentForm->hasValue("closed_by") ? $CurrentForm->getValue("closed_by") : $CurrentForm->getValue("x_closed_by");
        if (!$this->closed_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->closed_by->Visible = false; // Disable update for API request
            } else {
                $this->closed_by->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'ticket_id' first before field var 'x_ticket_id'
        $val = $CurrentForm->hasValue("ticket_id") ? $CurrentForm->getValue("ticket_id") : $CurrentForm->getValue("x_ticket_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->client_id->CurrentValue = $this->client_id->FormValue;
        $this->equipment_id->CurrentValue = $this->equipment_id->FormValue;
        $this->subject->CurrentValue = $this->subject->FormValue;
        $this->description->CurrentValue = $this->description->FormValue;
        $this->priority->CurrentValue = $this->priority->FormValue;
        $this->category->CurrentValue = $this->category->FormValue;
        $this->submitted_by->CurrentValue = $this->submitted_by->FormValue;
        $this->assigned_to->CurrentValue = $this->assigned_to->FormValue;
        $this->created_at->CurrentValue = $this->created_at->FormValue;
        $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        $this->status->CurrentValue = $this->status->FormValue;
        $this->resolution->CurrentValue = $this->resolution->FormValue;
        $this->closed_at->CurrentValue = $this->closed_at->FormValue;
        $this->closed_at->CurrentValue = UnFormatDateTime($this->closed_at->CurrentValue, $this->closed_at->formatPattern());
        $this->response_time_minutes->CurrentValue = $this->response_time_minutes->FormValue;
        $this->resolution_time_minutes->CurrentValue = $this->resolution_time_minutes->FormValue;
        $this->sla_compliant->CurrentValue = $this->sla_compliant->FormValue;
        $this->closed_by->CurrentValue = $this->closed_by->FormValue;
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
        $this->ticket_id->setDbValue($row['ticket_id']);
        $this->client_id->setDbValue($row['client_id']);
        $this->equipment_id->setDbValue($row['equipment_id']);
        $this->subject->setDbValue($row['subject']);
        $this->description->setDbValue($row['description']);
        $this->priority->setDbValue($row['priority']);
        $this->category->setDbValue($row['category']);
        $this->submitted_by->setDbValue($row['submitted_by']);
        $this->assigned_to->setDbValue($row['assigned_to']);
        $this->created_at->setDbValue($row['created_at']);
        $this->status->setDbValue($row['status']);
        $this->resolution->setDbValue($row['resolution']);
        $this->closed_at->setDbValue($row['closed_at']);
        $this->response_time_minutes->setDbValue($row['response_time_minutes']);
        $this->resolution_time_minutes->setDbValue($row['resolution_time_minutes']);
        $this->sla_compliant->setDbValue((ConvertToBool($row['sla_compliant']) ? "1" : "0"));
        $this->closed_by->setDbValue($row['closed_by']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['ticket_id'] = $this->ticket_id->DefaultValue;
        $row['client_id'] = $this->client_id->DefaultValue;
        $row['equipment_id'] = $this->equipment_id->DefaultValue;
        $row['subject'] = $this->subject->DefaultValue;
        $row['description'] = $this->description->DefaultValue;
        $row['priority'] = $this->priority->DefaultValue;
        $row['category'] = $this->category->DefaultValue;
        $row['submitted_by'] = $this->submitted_by->DefaultValue;
        $row['assigned_to'] = $this->assigned_to->DefaultValue;
        $row['created_at'] = $this->created_at->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        $row['resolution'] = $this->resolution->DefaultValue;
        $row['closed_at'] = $this->closed_at->DefaultValue;
        $row['response_time_minutes'] = $this->response_time_minutes->DefaultValue;
        $row['resolution_time_minutes'] = $this->resolution_time_minutes->DefaultValue;
        $row['sla_compliant'] = $this->sla_compliant->DefaultValue;
        $row['closed_by'] = $this->closed_by->DefaultValue;
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

        // ticket_id
        $this->ticket_id->RowCssClass = "row";

        // client_id
        $this->client_id->RowCssClass = "row";

        // equipment_id
        $this->equipment_id->RowCssClass = "row";

        // subject
        $this->subject->RowCssClass = "row";

        // description
        $this->description->RowCssClass = "row";

        // priority
        $this->priority->RowCssClass = "row";

        // category
        $this->category->RowCssClass = "row";

        // submitted_by
        $this->submitted_by->RowCssClass = "row";

        // assigned_to
        $this->assigned_to->RowCssClass = "row";

        // created_at
        $this->created_at->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // resolution
        $this->resolution->RowCssClass = "row";

        // closed_at
        $this->closed_at->RowCssClass = "row";

        // response_time_minutes
        $this->response_time_minutes->RowCssClass = "row";

        // resolution_time_minutes
        $this->resolution_time_minutes->RowCssClass = "row";

        // sla_compliant
        $this->sla_compliant->RowCssClass = "row";

        // closed_by
        $this->closed_by->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // ticket_id
            $this->ticket_id->ViewValue = $this->ticket_id->CurrentValue;

            // client_id
            $this->client_id->ViewValue = $this->client_id->CurrentValue;
            $this->client_id->ViewValue = FormatNumber($this->client_id->ViewValue, $this->client_id->formatPattern());

            // equipment_id
            $this->equipment_id->ViewValue = $this->equipment_id->CurrentValue;
            $this->equipment_id->ViewValue = FormatNumber($this->equipment_id->ViewValue, $this->equipment_id->formatPattern());

            // subject
            $this->subject->ViewValue = $this->subject->CurrentValue;

            // description
            $this->description->ViewValue = $this->description->CurrentValue;

            // priority
            $this->priority->ViewValue = $this->priority->CurrentValue;

            // category
            $this->category->ViewValue = $this->category->CurrentValue;

            // submitted_by
            $this->submitted_by->ViewValue = $this->submitted_by->CurrentValue;
            $this->submitted_by->ViewValue = FormatNumber($this->submitted_by->ViewValue, $this->submitted_by->formatPattern());

            // assigned_to
            $this->assigned_to->ViewValue = $this->assigned_to->CurrentValue;
            $this->assigned_to->ViewValue = FormatNumber($this->assigned_to->ViewValue, $this->assigned_to->formatPattern());

            // created_at
            $this->created_at->ViewValue = $this->created_at->CurrentValue;
            $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, $this->created_at->formatPattern());

            // status
            $this->status->ViewValue = $this->status->CurrentValue;

            // resolution
            $this->resolution->ViewValue = $this->resolution->CurrentValue;

            // closed_at
            $this->closed_at->ViewValue = $this->closed_at->CurrentValue;
            $this->closed_at->ViewValue = FormatDateTime($this->closed_at->ViewValue, $this->closed_at->formatPattern());

            // response_time_minutes
            $this->response_time_minutes->ViewValue = $this->response_time_minutes->CurrentValue;
            $this->response_time_minutes->ViewValue = FormatNumber($this->response_time_minutes->ViewValue, $this->response_time_minutes->formatPattern());

            // resolution_time_minutes
            $this->resolution_time_minutes->ViewValue = $this->resolution_time_minutes->CurrentValue;
            $this->resolution_time_minutes->ViewValue = FormatNumber($this->resolution_time_minutes->ViewValue, $this->resolution_time_minutes->formatPattern());

            // sla_compliant
            if (ConvertToBool($this->sla_compliant->CurrentValue)) {
                $this->sla_compliant->ViewValue = $this->sla_compliant->tagCaption(1) != "" ? $this->sla_compliant->tagCaption(1) : "Yes";
            } else {
                $this->sla_compliant->ViewValue = $this->sla_compliant->tagCaption(2) != "" ? $this->sla_compliant->tagCaption(2) : "No";
            }

            // closed_by
            $this->closed_by->ViewValue = $this->closed_by->CurrentValue;
            $this->closed_by->ViewValue = FormatNumber($this->closed_by->ViewValue, $this->closed_by->formatPattern());

            // client_id
            $this->client_id->HrefValue = "";

            // equipment_id
            $this->equipment_id->HrefValue = "";

            // subject
            $this->subject->HrefValue = "";

            // description
            $this->description->HrefValue = "";

            // priority
            $this->priority->HrefValue = "";

            // category
            $this->category->HrefValue = "";

            // submitted_by
            $this->submitted_by->HrefValue = "";

            // assigned_to
            $this->assigned_to->HrefValue = "";

            // created_at
            $this->created_at->HrefValue = "";

            // status
            $this->status->HrefValue = "";

            // resolution
            $this->resolution->HrefValue = "";

            // closed_at
            $this->closed_at->HrefValue = "";

            // response_time_minutes
            $this->response_time_minutes->HrefValue = "";

            // resolution_time_minutes
            $this->resolution_time_minutes->HrefValue = "";

            // sla_compliant
            $this->sla_compliant->HrefValue = "";

            // closed_by
            $this->closed_by->HrefValue = "";
        } elseif ($this->RowType == RowType::ADD) {
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

            // subject
            $this->subject->setupEditAttributes();
            if (!$this->subject->Raw) {
                $this->subject->CurrentValue = HtmlDecode($this->subject->CurrentValue);
            }
            $this->subject->EditValue = HtmlEncode($this->subject->CurrentValue);
            $this->subject->PlaceHolder = RemoveHtml($this->subject->caption());

            // description
            $this->description->setupEditAttributes();
            $this->description->EditValue = HtmlEncode($this->description->CurrentValue);
            $this->description->PlaceHolder = RemoveHtml($this->description->caption());

            // priority
            $this->priority->setupEditAttributes();
            if (!$this->priority->Raw) {
                $this->priority->CurrentValue = HtmlDecode($this->priority->CurrentValue);
            }
            $this->priority->EditValue = HtmlEncode($this->priority->CurrentValue);
            $this->priority->PlaceHolder = RemoveHtml($this->priority->caption());

            // category
            $this->category->setupEditAttributes();
            if (!$this->category->Raw) {
                $this->category->CurrentValue = HtmlDecode($this->category->CurrentValue);
            }
            $this->category->EditValue = HtmlEncode($this->category->CurrentValue);
            $this->category->PlaceHolder = RemoveHtml($this->category->caption());

            // submitted_by
            $this->submitted_by->setupEditAttributes();
            $this->submitted_by->EditValue = $this->submitted_by->CurrentValue;
            $this->submitted_by->PlaceHolder = RemoveHtml($this->submitted_by->caption());
            if (strval($this->submitted_by->EditValue) != "" && is_numeric($this->submitted_by->EditValue)) {
                $this->submitted_by->EditValue = FormatNumber($this->submitted_by->EditValue, null);
            }

            // assigned_to
            $this->assigned_to->setupEditAttributes();
            $this->assigned_to->EditValue = $this->assigned_to->CurrentValue;
            $this->assigned_to->PlaceHolder = RemoveHtml($this->assigned_to->caption());
            if (strval($this->assigned_to->EditValue) != "" && is_numeric($this->assigned_to->EditValue)) {
                $this->assigned_to->EditValue = FormatNumber($this->assigned_to->EditValue, null);
            }

            // created_at
            $this->created_at->setupEditAttributes();
            $this->created_at->EditValue = HtmlEncode(FormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern()));
            $this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

            // status
            $this->status->setupEditAttributes();
            if (!$this->status->Raw) {
                $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->CurrentValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // resolution
            $this->resolution->setupEditAttributes();
            $this->resolution->EditValue = HtmlEncode($this->resolution->CurrentValue);
            $this->resolution->PlaceHolder = RemoveHtml($this->resolution->caption());

            // closed_at
            $this->closed_at->setupEditAttributes();
            $this->closed_at->EditValue = HtmlEncode(FormatDateTime($this->closed_at->CurrentValue, $this->closed_at->formatPattern()));
            $this->closed_at->PlaceHolder = RemoveHtml($this->closed_at->caption());

            // response_time_minutes
            $this->response_time_minutes->setupEditAttributes();
            $this->response_time_minutes->EditValue = $this->response_time_minutes->CurrentValue;
            $this->response_time_minutes->PlaceHolder = RemoveHtml($this->response_time_minutes->caption());
            if (strval($this->response_time_minutes->EditValue) != "" && is_numeric($this->response_time_minutes->EditValue)) {
                $this->response_time_minutes->EditValue = FormatNumber($this->response_time_minutes->EditValue, null);
            }

            // resolution_time_minutes
            $this->resolution_time_minutes->setupEditAttributes();
            $this->resolution_time_minutes->EditValue = $this->resolution_time_minutes->CurrentValue;
            $this->resolution_time_minutes->PlaceHolder = RemoveHtml($this->resolution_time_minutes->caption());
            if (strval($this->resolution_time_minutes->EditValue) != "" && is_numeric($this->resolution_time_minutes->EditValue)) {
                $this->resolution_time_minutes->EditValue = FormatNumber($this->resolution_time_minutes->EditValue, null);
            }

            // sla_compliant
            $this->sla_compliant->EditValue = $this->sla_compliant->options(false);
            $this->sla_compliant->PlaceHolder = RemoveHtml($this->sla_compliant->caption());

            // closed_by
            $this->closed_by->setupEditAttributes();
            $this->closed_by->EditValue = $this->closed_by->CurrentValue;
            $this->closed_by->PlaceHolder = RemoveHtml($this->closed_by->caption());
            if (strval($this->closed_by->EditValue) != "" && is_numeric($this->closed_by->EditValue)) {
                $this->closed_by->EditValue = FormatNumber($this->closed_by->EditValue, null);
            }

            // Add refer script

            // client_id
            $this->client_id->HrefValue = "";

            // equipment_id
            $this->equipment_id->HrefValue = "";

            // subject
            $this->subject->HrefValue = "";

            // description
            $this->description->HrefValue = "";

            // priority
            $this->priority->HrefValue = "";

            // category
            $this->category->HrefValue = "";

            // submitted_by
            $this->submitted_by->HrefValue = "";

            // assigned_to
            $this->assigned_to->HrefValue = "";

            // created_at
            $this->created_at->HrefValue = "";

            // status
            $this->status->HrefValue = "";

            // resolution
            $this->resolution->HrefValue = "";

            // closed_at
            $this->closed_at->HrefValue = "";

            // response_time_minutes
            $this->response_time_minutes->HrefValue = "";

            // resolution_time_minutes
            $this->resolution_time_minutes->HrefValue = "";

            // sla_compliant
            $this->sla_compliant->HrefValue = "";

            // closed_by
            $this->closed_by->HrefValue = "";
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
            if ($this->subject->Visible && $this->subject->Required) {
                if (!$this->subject->IsDetailKey && EmptyValue($this->subject->FormValue)) {
                    $this->subject->addErrorMessage(str_replace("%s", $this->subject->caption(), $this->subject->RequiredErrorMessage));
                }
            }
            if ($this->description->Visible && $this->description->Required) {
                if (!$this->description->IsDetailKey && EmptyValue($this->description->FormValue)) {
                    $this->description->addErrorMessage(str_replace("%s", $this->description->caption(), $this->description->RequiredErrorMessage));
                }
            }
            if ($this->priority->Visible && $this->priority->Required) {
                if (!$this->priority->IsDetailKey && EmptyValue($this->priority->FormValue)) {
                    $this->priority->addErrorMessage(str_replace("%s", $this->priority->caption(), $this->priority->RequiredErrorMessage));
                }
            }
            if ($this->category->Visible && $this->category->Required) {
                if (!$this->category->IsDetailKey && EmptyValue($this->category->FormValue)) {
                    $this->category->addErrorMessage(str_replace("%s", $this->category->caption(), $this->category->RequiredErrorMessage));
                }
            }
            if ($this->submitted_by->Visible && $this->submitted_by->Required) {
                if (!$this->submitted_by->IsDetailKey && EmptyValue($this->submitted_by->FormValue)) {
                    $this->submitted_by->addErrorMessage(str_replace("%s", $this->submitted_by->caption(), $this->submitted_by->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->submitted_by->FormValue)) {
                $this->submitted_by->addErrorMessage($this->submitted_by->getErrorMessage(false));
            }
            if ($this->assigned_to->Visible && $this->assigned_to->Required) {
                if (!$this->assigned_to->IsDetailKey && EmptyValue($this->assigned_to->FormValue)) {
                    $this->assigned_to->addErrorMessage(str_replace("%s", $this->assigned_to->caption(), $this->assigned_to->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->assigned_to->FormValue)) {
                $this->assigned_to->addErrorMessage($this->assigned_to->getErrorMessage(false));
            }
            if ($this->created_at->Visible && $this->created_at->Required) {
                if (!$this->created_at->IsDetailKey && EmptyValue($this->created_at->FormValue)) {
                    $this->created_at->addErrorMessage(str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->created_at->FormValue, $this->created_at->formatPattern())) {
                $this->created_at->addErrorMessage($this->created_at->getErrorMessage(false));
            }
            if ($this->status->Visible && $this->status->Required) {
                if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                    $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
                }
            }
            if ($this->resolution->Visible && $this->resolution->Required) {
                if (!$this->resolution->IsDetailKey && EmptyValue($this->resolution->FormValue)) {
                    $this->resolution->addErrorMessage(str_replace("%s", $this->resolution->caption(), $this->resolution->RequiredErrorMessage));
                }
            }
            if ($this->closed_at->Visible && $this->closed_at->Required) {
                if (!$this->closed_at->IsDetailKey && EmptyValue($this->closed_at->FormValue)) {
                    $this->closed_at->addErrorMessage(str_replace("%s", $this->closed_at->caption(), $this->closed_at->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->closed_at->FormValue, $this->closed_at->formatPattern())) {
                $this->closed_at->addErrorMessage($this->closed_at->getErrorMessage(false));
            }
            if ($this->response_time_minutes->Visible && $this->response_time_minutes->Required) {
                if (!$this->response_time_minutes->IsDetailKey && EmptyValue($this->response_time_minutes->FormValue)) {
                    $this->response_time_minutes->addErrorMessage(str_replace("%s", $this->response_time_minutes->caption(), $this->response_time_minutes->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->response_time_minutes->FormValue)) {
                $this->response_time_minutes->addErrorMessage($this->response_time_minutes->getErrorMessage(false));
            }
            if ($this->resolution_time_minutes->Visible && $this->resolution_time_minutes->Required) {
                if (!$this->resolution_time_minutes->IsDetailKey && EmptyValue($this->resolution_time_minutes->FormValue)) {
                    $this->resolution_time_minutes->addErrorMessage(str_replace("%s", $this->resolution_time_minutes->caption(), $this->resolution_time_minutes->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->resolution_time_minutes->FormValue)) {
                $this->resolution_time_minutes->addErrorMessage($this->resolution_time_minutes->getErrorMessage(false));
            }
            if ($this->sla_compliant->Visible && $this->sla_compliant->Required) {
                if ($this->sla_compliant->FormValue == "") {
                    $this->sla_compliant->addErrorMessage(str_replace("%s", $this->sla_compliant->caption(), $this->sla_compliant->RequiredErrorMessage));
                }
            }
            if ($this->closed_by->Visible && $this->closed_by->Required) {
                if (!$this->closed_by->IsDetailKey && EmptyValue($this->closed_by->FormValue)) {
                    $this->closed_by->addErrorMessage(str_replace("%s", $this->closed_by->caption(), $this->closed_by->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->closed_by->FormValue)) {
                $this->closed_by->addErrorMessage($this->closed_by->getErrorMessage(false));
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

        // client_id
        $this->client_id->setDbValueDef($rsnew, $this->client_id->CurrentValue, false);

        // equipment_id
        $this->equipment_id->setDbValueDef($rsnew, $this->equipment_id->CurrentValue, false);

        // subject
        $this->subject->setDbValueDef($rsnew, $this->subject->CurrentValue, false);

        // description
        $this->description->setDbValueDef($rsnew, $this->description->CurrentValue, false);

        // priority
        $this->priority->setDbValueDef($rsnew, $this->priority->CurrentValue, false);

        // category
        $this->category->setDbValueDef($rsnew, $this->category->CurrentValue, false);

        // submitted_by
        $this->submitted_by->setDbValueDef($rsnew, $this->submitted_by->CurrentValue, false);

        // assigned_to
        $this->assigned_to->setDbValueDef($rsnew, $this->assigned_to->CurrentValue, false);

        // created_at
        $this->created_at->setDbValueDef($rsnew, UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern()), false);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, false);

        // resolution
        $this->resolution->setDbValueDef($rsnew, $this->resolution->CurrentValue, false);

        // closed_at
        $this->closed_at->setDbValueDef($rsnew, UnFormatDateTime($this->closed_at->CurrentValue, $this->closed_at->formatPattern()), false);

        // response_time_minutes
        $this->response_time_minutes->setDbValueDef($rsnew, $this->response_time_minutes->CurrentValue, false);

        // resolution_time_minutes
        $this->resolution_time_minutes->setDbValueDef($rsnew, $this->resolution_time_minutes->CurrentValue, false);

        // sla_compliant
        $tmpBool = $this->sla_compliant->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->sla_compliant->setDbValueDef($rsnew, $tmpBool, false);

        // closed_by
        $this->closed_by->setDbValueDef($rsnew, $this->closed_by->CurrentValue, false);
        return $rsnew;
    }

    /**
     * Restore add form from row
     * @param array $row Row
     */
    protected function restoreAddFormFromRow($row)
    {
        if (isset($row['client_id'])) { // client_id
            $this->client_id->setFormValue($row['client_id']);
        }
        if (isset($row['equipment_id'])) { // equipment_id
            $this->equipment_id->setFormValue($row['equipment_id']);
        }
        if (isset($row['subject'])) { // subject
            $this->subject->setFormValue($row['subject']);
        }
        if (isset($row['description'])) { // description
            $this->description->setFormValue($row['description']);
        }
        if (isset($row['priority'])) { // priority
            $this->priority->setFormValue($row['priority']);
        }
        if (isset($row['category'])) { // category
            $this->category->setFormValue($row['category']);
        }
        if (isset($row['submitted_by'])) { // submitted_by
            $this->submitted_by->setFormValue($row['submitted_by']);
        }
        if (isset($row['assigned_to'])) { // assigned_to
            $this->assigned_to->setFormValue($row['assigned_to']);
        }
        if (isset($row['created_at'])) { // created_at
            $this->created_at->setFormValue($row['created_at']);
        }
        if (isset($row['status'])) { // status
            $this->status->setFormValue($row['status']);
        }
        if (isset($row['resolution'])) { // resolution
            $this->resolution->setFormValue($row['resolution']);
        }
        if (isset($row['closed_at'])) { // closed_at
            $this->closed_at->setFormValue($row['closed_at']);
        }
        if (isset($row['response_time_minutes'])) { // response_time_minutes
            $this->response_time_minutes->setFormValue($row['response_time_minutes']);
        }
        if (isset($row['resolution_time_minutes'])) { // resolution_time_minutes
            $this->resolution_time_minutes->setFormValue($row['resolution_time_minutes']);
        }
        if (isset($row['sla_compliant'])) { // sla_compliant
            $this->sla_compliant->setFormValue($row['sla_compliant']);
        }
        if (isset($row['closed_by'])) { // closed_by
            $this->closed_by->setFormValue($row['closed_by']);
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("SupportTicketsList"), "", $this->TableVar, true);
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
                case "x_sla_compliant":
                    break;
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
