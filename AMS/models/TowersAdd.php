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
class TowersAdd extends Towers
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "TowersAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "TowersAdd";

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
        $this->tower_id->Visible = false;
        $this->name->setVisibility();
        $this->code->setVisibility();
        $this->type_id->setVisibility();
        $this->status_id->setVisibility();
        $this->height->setVisibility();
        $this->latitude->setVisibility();
        $this->longitude->setVisibility();
        $this->address->setVisibility();
        $this->city->setVisibility();
        $this->region->setVisibility();
        $this->installation_date->setVisibility();
        $this->last_maintenance->setVisibility();
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
        $this->TableVar = 'towers';
        $this->TableName = 'towers';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (towers)
        if (!isset($GLOBALS["towers"]) || $GLOBALS["towers"]::class == PROJECT_NAMESPACE . "towers") {
            $GLOBALS["towers"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'towers');
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
                        $result["view"] = SameString($pageName, "TowersView"); // If View page, no primary button
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
            $key .= @$ar['tower_id'];
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
            $this->tower_id->Visible = false;
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
            if (($keyValue = Get("tower_id") ?? Route("tower_id")) !== null) {
                $this->tower_id->setQueryStringValue($keyValue);
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
                    $this->terminate("TowersList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "TowersList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "TowersView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "TowersList") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "TowersList"; // Return list page content
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

        // Check field name 'name' first before field var 'x_name'
        $val = $CurrentForm->hasValue("name") ? $CurrentForm->getValue("name") : $CurrentForm->getValue("x_name");
        if (!$this->name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->name->Visible = false; // Disable update for API request
            } else {
                $this->name->setFormValue($val);
            }
        }

        // Check field name 'code' first before field var 'x_code'
        $val = $CurrentForm->hasValue("code") ? $CurrentForm->getValue("code") : $CurrentForm->getValue("x_code");
        if (!$this->code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->code->Visible = false; // Disable update for API request
            } else {
                $this->code->setFormValue($val);
            }
        }

        // Check field name 'type_id' first before field var 'x_type_id'
        $val = $CurrentForm->hasValue("type_id") ? $CurrentForm->getValue("type_id") : $CurrentForm->getValue("x_type_id");
        if (!$this->type_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->type_id->Visible = false; // Disable update for API request
            } else {
                $this->type_id->setFormValue($val, true, $validate);
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

        // Check field name 'height' first before field var 'x_height'
        $val = $CurrentForm->hasValue("height") ? $CurrentForm->getValue("height") : $CurrentForm->getValue("x_height");
        if (!$this->height->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->height->Visible = false; // Disable update for API request
            } else {
                $this->height->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'latitude' first before field var 'x_latitude'
        $val = $CurrentForm->hasValue("latitude") ? $CurrentForm->getValue("latitude") : $CurrentForm->getValue("x_latitude");
        if (!$this->latitude->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->latitude->Visible = false; // Disable update for API request
            } else {
                $this->latitude->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'longitude' first before field var 'x_longitude'
        $val = $CurrentForm->hasValue("longitude") ? $CurrentForm->getValue("longitude") : $CurrentForm->getValue("x_longitude");
        if (!$this->longitude->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->longitude->Visible = false; // Disable update for API request
            } else {
                $this->longitude->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'address' first before field var 'x_address'
        $val = $CurrentForm->hasValue("address") ? $CurrentForm->getValue("address") : $CurrentForm->getValue("x_address");
        if (!$this->address->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->address->Visible = false; // Disable update for API request
            } else {
                $this->address->setFormValue($val);
            }
        }

        // Check field name 'city' first before field var 'x_city'
        $val = $CurrentForm->hasValue("city") ? $CurrentForm->getValue("city") : $CurrentForm->getValue("x_city");
        if (!$this->city->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->city->Visible = false; // Disable update for API request
            } else {
                $this->city->setFormValue($val);
            }
        }

        // Check field name 'region' first before field var 'x_region'
        $val = $CurrentForm->hasValue("region") ? $CurrentForm->getValue("region") : $CurrentForm->getValue("x_region");
        if (!$this->region->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->region->Visible = false; // Disable update for API request
            } else {
                $this->region->setFormValue($val);
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

        // Check field name 'last_maintenance' first before field var 'x_last_maintenance'
        $val = $CurrentForm->hasValue("last_maintenance") ? $CurrentForm->getValue("last_maintenance") : $CurrentForm->getValue("x_last_maintenance");
        if (!$this->last_maintenance->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->last_maintenance->Visible = false; // Disable update for API request
            } else {
                $this->last_maintenance->setFormValue($val, true, $validate);
            }
            $this->last_maintenance->CurrentValue = UnFormatDateTime($this->last_maintenance->CurrentValue, $this->last_maintenance->formatPattern());
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

        // Check field name 'tower_id' first before field var 'x_tower_id'
        $val = $CurrentForm->hasValue("tower_id") ? $CurrentForm->getValue("tower_id") : $CurrentForm->getValue("x_tower_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->name->CurrentValue = $this->name->FormValue;
        $this->code->CurrentValue = $this->code->FormValue;
        $this->type_id->CurrentValue = $this->type_id->FormValue;
        $this->status_id->CurrentValue = $this->status_id->FormValue;
        $this->height->CurrentValue = $this->height->FormValue;
        $this->latitude->CurrentValue = $this->latitude->FormValue;
        $this->longitude->CurrentValue = $this->longitude->FormValue;
        $this->address->CurrentValue = $this->address->FormValue;
        $this->city->CurrentValue = $this->city->FormValue;
        $this->region->CurrentValue = $this->region->FormValue;
        $this->installation_date->CurrentValue = $this->installation_date->FormValue;
        $this->installation_date->CurrentValue = UnFormatDateTime($this->installation_date->CurrentValue, $this->installation_date->formatPattern());
        $this->last_maintenance->CurrentValue = $this->last_maintenance->FormValue;
        $this->last_maintenance->CurrentValue = UnFormatDateTime($this->last_maintenance->CurrentValue, $this->last_maintenance->formatPattern());
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
        $this->tower_id->setDbValue($row['tower_id']);
        $this->name->setDbValue($row['name']);
        $this->code->setDbValue($row['code']);
        $this->type_id->setDbValue($row['type_id']);
        $this->status_id->setDbValue($row['status_id']);
        $this->height->setDbValue($row['height']);
        $this->latitude->setDbValue($row['latitude']);
        $this->longitude->setDbValue($row['longitude']);
        $this->address->setDbValue($row['address']);
        $this->city->setDbValue($row['city']);
        $this->region->setDbValue($row['region']);
        $this->installation_date->setDbValue($row['installation_date']);
        $this->last_maintenance->setDbValue($row['last_maintenance']);
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
        $row['tower_id'] = $this->tower_id->DefaultValue;
        $row['name'] = $this->name->DefaultValue;
        $row['code'] = $this->code->DefaultValue;
        $row['type_id'] = $this->type_id->DefaultValue;
        $row['status_id'] = $this->status_id->DefaultValue;
        $row['height'] = $this->height->DefaultValue;
        $row['latitude'] = $this->latitude->DefaultValue;
        $row['longitude'] = $this->longitude->DefaultValue;
        $row['address'] = $this->address->DefaultValue;
        $row['city'] = $this->city->DefaultValue;
        $row['region'] = $this->region->DefaultValue;
        $row['installation_date'] = $this->installation_date->DefaultValue;
        $row['last_maintenance'] = $this->last_maintenance->DefaultValue;
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

        // tower_id
        $this->tower_id->RowCssClass = "row";

        // name
        $this->name->RowCssClass = "row";

        // code
        $this->code->RowCssClass = "row";

        // type_id
        $this->type_id->RowCssClass = "row";

        // status_id
        $this->status_id->RowCssClass = "row";

        // height
        $this->height->RowCssClass = "row";

        // latitude
        $this->latitude->RowCssClass = "row";

        // longitude
        $this->longitude->RowCssClass = "row";

        // address
        $this->address->RowCssClass = "row";

        // city
        $this->city->RowCssClass = "row";

        // region
        $this->region->RowCssClass = "row";

        // installation_date
        $this->installation_date->RowCssClass = "row";

        // last_maintenance
        $this->last_maintenance->RowCssClass = "row";

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
            // tower_id
            $this->tower_id->ViewValue = $this->tower_id->CurrentValue;

            // name
            $this->name->ViewValue = $this->name->CurrentValue;

            // code
            $this->code->ViewValue = $this->code->CurrentValue;

            // type_id
            $this->type_id->ViewValue = $this->type_id->CurrentValue;
            $this->type_id->ViewValue = FormatNumber($this->type_id->ViewValue, $this->type_id->formatPattern());

            // status_id
            $this->status_id->ViewValue = $this->status_id->CurrentValue;
            $this->status_id->ViewValue = FormatNumber($this->status_id->ViewValue, $this->status_id->formatPattern());

            // height
            $this->height->ViewValue = $this->height->CurrentValue;
            $this->height->ViewValue = FormatNumber($this->height->ViewValue, $this->height->formatPattern());

            // latitude
            $this->latitude->ViewValue = $this->latitude->CurrentValue;
            $this->latitude->ViewValue = FormatNumber($this->latitude->ViewValue, $this->latitude->formatPattern());

            // longitude
            $this->longitude->ViewValue = $this->longitude->CurrentValue;
            $this->longitude->ViewValue = FormatNumber($this->longitude->ViewValue, $this->longitude->formatPattern());

            // address
            $this->address->ViewValue = $this->address->CurrentValue;

            // city
            $this->city->ViewValue = $this->city->CurrentValue;

            // region
            $this->region->ViewValue = $this->region->CurrentValue;

            // installation_date
            $this->installation_date->ViewValue = $this->installation_date->CurrentValue;
            $this->installation_date->ViewValue = FormatDateTime($this->installation_date->ViewValue, $this->installation_date->formatPattern());

            // last_maintenance
            $this->last_maintenance->ViewValue = $this->last_maintenance->CurrentValue;
            $this->last_maintenance->ViewValue = FormatDateTime($this->last_maintenance->ViewValue, $this->last_maintenance->formatPattern());

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

            // name
            $this->name->HrefValue = "";

            // code
            $this->code->HrefValue = "";

            // type_id
            $this->type_id->HrefValue = "";

            // status_id
            $this->status_id->HrefValue = "";

            // height
            $this->height->HrefValue = "";

            // latitude
            $this->latitude->HrefValue = "";

            // longitude
            $this->longitude->HrefValue = "";

            // address
            $this->address->HrefValue = "";

            // city
            $this->city->HrefValue = "";

            // region
            $this->region->HrefValue = "";

            // installation_date
            $this->installation_date->HrefValue = "";

            // last_maintenance
            $this->last_maintenance->HrefValue = "";

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
            // name
            $this->name->setupEditAttributes();
            if (!$this->name->Raw) {
                $this->name->CurrentValue = HtmlDecode($this->name->CurrentValue);
            }
            $this->name->EditValue = HtmlEncode($this->name->CurrentValue);
            $this->name->PlaceHolder = RemoveHtml($this->name->caption());

            // code
            $this->code->setupEditAttributes();
            if (!$this->code->Raw) {
                $this->code->CurrentValue = HtmlDecode($this->code->CurrentValue);
            }
            $this->code->EditValue = HtmlEncode($this->code->CurrentValue);
            $this->code->PlaceHolder = RemoveHtml($this->code->caption());

            // type_id
            $this->type_id->setupEditAttributes();
            $this->type_id->EditValue = $this->type_id->CurrentValue;
            $this->type_id->PlaceHolder = RemoveHtml($this->type_id->caption());
            if (strval($this->type_id->EditValue) != "" && is_numeric($this->type_id->EditValue)) {
                $this->type_id->EditValue = FormatNumber($this->type_id->EditValue, null);
            }

            // status_id
            $this->status_id->setupEditAttributes();
            $this->status_id->EditValue = $this->status_id->CurrentValue;
            $this->status_id->PlaceHolder = RemoveHtml($this->status_id->caption());
            if (strval($this->status_id->EditValue) != "" && is_numeric($this->status_id->EditValue)) {
                $this->status_id->EditValue = FormatNumber($this->status_id->EditValue, null);
            }

            // height
            $this->height->setupEditAttributes();
            $this->height->EditValue = $this->height->CurrentValue;
            $this->height->PlaceHolder = RemoveHtml($this->height->caption());
            if (strval($this->height->EditValue) != "" && is_numeric($this->height->EditValue)) {
                $this->height->EditValue = FormatNumber($this->height->EditValue, null);
            }

            // latitude
            $this->latitude->setupEditAttributes();
            $this->latitude->EditValue = $this->latitude->CurrentValue;
            $this->latitude->PlaceHolder = RemoveHtml($this->latitude->caption());
            if (strval($this->latitude->EditValue) != "" && is_numeric($this->latitude->EditValue)) {
                $this->latitude->EditValue = FormatNumber($this->latitude->EditValue, null);
            }

            // longitude
            $this->longitude->setupEditAttributes();
            $this->longitude->EditValue = $this->longitude->CurrentValue;
            $this->longitude->PlaceHolder = RemoveHtml($this->longitude->caption());
            if (strval($this->longitude->EditValue) != "" && is_numeric($this->longitude->EditValue)) {
                $this->longitude->EditValue = FormatNumber($this->longitude->EditValue, null);
            }

            // address
            $this->address->setupEditAttributes();
            $this->address->EditValue = HtmlEncode($this->address->CurrentValue);
            $this->address->PlaceHolder = RemoveHtml($this->address->caption());

            // city
            $this->city->setupEditAttributes();
            if (!$this->city->Raw) {
                $this->city->CurrentValue = HtmlDecode($this->city->CurrentValue);
            }
            $this->city->EditValue = HtmlEncode($this->city->CurrentValue);
            $this->city->PlaceHolder = RemoveHtml($this->city->caption());

            // region
            $this->region->setupEditAttributes();
            if (!$this->region->Raw) {
                $this->region->CurrentValue = HtmlDecode($this->region->CurrentValue);
            }
            $this->region->EditValue = HtmlEncode($this->region->CurrentValue);
            $this->region->PlaceHolder = RemoveHtml($this->region->caption());

            // installation_date
            $this->installation_date->setupEditAttributes();
            $this->installation_date->EditValue = HtmlEncode(FormatDateTime($this->installation_date->CurrentValue, $this->installation_date->formatPattern()));
            $this->installation_date->PlaceHolder = RemoveHtml($this->installation_date->caption());

            // last_maintenance
            $this->last_maintenance->setupEditAttributes();
            $this->last_maintenance->EditValue = HtmlEncode(FormatDateTime($this->last_maintenance->CurrentValue, $this->last_maintenance->formatPattern()));
            $this->last_maintenance->PlaceHolder = RemoveHtml($this->last_maintenance->caption());

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

            // name
            $this->name->HrefValue = "";

            // code
            $this->code->HrefValue = "";

            // type_id
            $this->type_id->HrefValue = "";

            // status_id
            $this->status_id->HrefValue = "";

            // height
            $this->height->HrefValue = "";

            // latitude
            $this->latitude->HrefValue = "";

            // longitude
            $this->longitude->HrefValue = "";

            // address
            $this->address->HrefValue = "";

            // city
            $this->city->HrefValue = "";

            // region
            $this->region->HrefValue = "";

            // installation_date
            $this->installation_date->HrefValue = "";

            // last_maintenance
            $this->last_maintenance->HrefValue = "";

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
            if ($this->name->Visible && $this->name->Required) {
                if (!$this->name->IsDetailKey && EmptyValue($this->name->FormValue)) {
                    $this->name->addErrorMessage(str_replace("%s", $this->name->caption(), $this->name->RequiredErrorMessage));
                }
            }
            if ($this->code->Visible && $this->code->Required) {
                if (!$this->code->IsDetailKey && EmptyValue($this->code->FormValue)) {
                    $this->code->addErrorMessage(str_replace("%s", $this->code->caption(), $this->code->RequiredErrorMessage));
                }
            }
            if ($this->type_id->Visible && $this->type_id->Required) {
                if (!$this->type_id->IsDetailKey && EmptyValue($this->type_id->FormValue)) {
                    $this->type_id->addErrorMessage(str_replace("%s", $this->type_id->caption(), $this->type_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->type_id->FormValue)) {
                $this->type_id->addErrorMessage($this->type_id->getErrorMessage(false));
            }
            if ($this->status_id->Visible && $this->status_id->Required) {
                if (!$this->status_id->IsDetailKey && EmptyValue($this->status_id->FormValue)) {
                    $this->status_id->addErrorMessage(str_replace("%s", $this->status_id->caption(), $this->status_id->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->status_id->FormValue)) {
                $this->status_id->addErrorMessage($this->status_id->getErrorMessage(false));
            }
            if ($this->height->Visible && $this->height->Required) {
                if (!$this->height->IsDetailKey && EmptyValue($this->height->FormValue)) {
                    $this->height->addErrorMessage(str_replace("%s", $this->height->caption(), $this->height->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->height->FormValue)) {
                $this->height->addErrorMessage($this->height->getErrorMessage(false));
            }
            if ($this->latitude->Visible && $this->latitude->Required) {
                if (!$this->latitude->IsDetailKey && EmptyValue($this->latitude->FormValue)) {
                    $this->latitude->addErrorMessage(str_replace("%s", $this->latitude->caption(), $this->latitude->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->latitude->FormValue)) {
                $this->latitude->addErrorMessage($this->latitude->getErrorMessage(false));
            }
            if ($this->longitude->Visible && $this->longitude->Required) {
                if (!$this->longitude->IsDetailKey && EmptyValue($this->longitude->FormValue)) {
                    $this->longitude->addErrorMessage(str_replace("%s", $this->longitude->caption(), $this->longitude->RequiredErrorMessage));
                }
            }
            if (!CheckNumber($this->longitude->FormValue)) {
                $this->longitude->addErrorMessage($this->longitude->getErrorMessage(false));
            }
            if ($this->address->Visible && $this->address->Required) {
                if (!$this->address->IsDetailKey && EmptyValue($this->address->FormValue)) {
                    $this->address->addErrorMessage(str_replace("%s", $this->address->caption(), $this->address->RequiredErrorMessage));
                }
            }
            if ($this->city->Visible && $this->city->Required) {
                if (!$this->city->IsDetailKey && EmptyValue($this->city->FormValue)) {
                    $this->city->addErrorMessage(str_replace("%s", $this->city->caption(), $this->city->RequiredErrorMessage));
                }
            }
            if ($this->region->Visible && $this->region->Required) {
                if (!$this->region->IsDetailKey && EmptyValue($this->region->FormValue)) {
                    $this->region->addErrorMessage(str_replace("%s", $this->region->caption(), $this->region->RequiredErrorMessage));
                }
            }
            if ($this->installation_date->Visible && $this->installation_date->Required) {
                if (!$this->installation_date->IsDetailKey && EmptyValue($this->installation_date->FormValue)) {
                    $this->installation_date->addErrorMessage(str_replace("%s", $this->installation_date->caption(), $this->installation_date->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->installation_date->FormValue, $this->installation_date->formatPattern())) {
                $this->installation_date->addErrorMessage($this->installation_date->getErrorMessage(false));
            }
            if ($this->last_maintenance->Visible && $this->last_maintenance->Required) {
                if (!$this->last_maintenance->IsDetailKey && EmptyValue($this->last_maintenance->FormValue)) {
                    $this->last_maintenance->addErrorMessage(str_replace("%s", $this->last_maintenance->caption(), $this->last_maintenance->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->last_maintenance->FormValue, $this->last_maintenance->formatPattern())) {
                $this->last_maintenance->addErrorMessage($this->last_maintenance->getErrorMessage(false));
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
        if ($this->code->CurrentValue != "") { // Check field with unique index
            $filter = "(\"code\" = '" . AdjustSql($this->code->CurrentValue, $this->Dbid) . "')";
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $idxErrMsg = str_replace("%f", $this->code->caption(), $Language->phrase("DupIndex"));
                $idxErrMsg = str_replace("%v", $this->code->CurrentValue, $idxErrMsg);
                $this->setFailureMessage($idxErrMsg);
                return false;
            }
        }
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

        // name
        $this->name->setDbValueDef($rsnew, $this->name->CurrentValue, false);

        // code
        $this->code->setDbValueDef($rsnew, $this->code->CurrentValue, false);

        // type_id
        $this->type_id->setDbValueDef($rsnew, $this->type_id->CurrentValue, false);

        // status_id
        $this->status_id->setDbValueDef($rsnew, $this->status_id->CurrentValue, false);

        // height
        $this->height->setDbValueDef($rsnew, $this->height->CurrentValue, false);

        // latitude
        $this->latitude->setDbValueDef($rsnew, $this->latitude->CurrentValue, false);

        // longitude
        $this->longitude->setDbValueDef($rsnew, $this->longitude->CurrentValue, false);

        // address
        $this->address->setDbValueDef($rsnew, $this->address->CurrentValue, false);

        // city
        $this->city->setDbValueDef($rsnew, $this->city->CurrentValue, false);

        // region
        $this->region->setDbValueDef($rsnew, $this->region->CurrentValue, false);

        // installation_date
        $this->installation_date->setDbValueDef($rsnew, UnFormatDateTime($this->installation_date->CurrentValue, $this->installation_date->formatPattern()), false);

        // last_maintenance
        $this->last_maintenance->setDbValueDef($rsnew, UnFormatDateTime($this->last_maintenance->CurrentValue, $this->last_maintenance->formatPattern()), false);

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
        if (isset($row['name'])) { // name
            $this->name->setFormValue($row['name']);
        }
        if (isset($row['code'])) { // code
            $this->code->setFormValue($row['code']);
        }
        if (isset($row['type_id'])) { // type_id
            $this->type_id->setFormValue($row['type_id']);
        }
        if (isset($row['status_id'])) { // status_id
            $this->status_id->setFormValue($row['status_id']);
        }
        if (isset($row['height'])) { // height
            $this->height->setFormValue($row['height']);
        }
        if (isset($row['latitude'])) { // latitude
            $this->latitude->setFormValue($row['latitude']);
        }
        if (isset($row['longitude'])) { // longitude
            $this->longitude->setFormValue($row['longitude']);
        }
        if (isset($row['address'])) { // address
            $this->address->setFormValue($row['address']);
        }
        if (isset($row['city'])) { // city
            $this->city->setFormValue($row['city']);
        }
        if (isset($row['region'])) { // region
            $this->region->setFormValue($row['region']);
        }
        if (isset($row['installation_date'])) { // installation_date
            $this->installation_date->setFormValue($row['installation_date']);
        }
        if (isset($row['last_maintenance'])) { // last_maintenance
            $this->last_maintenance->setFormValue($row['last_maintenance']);
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("TowersList"), "", $this->TableVar, true);
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
