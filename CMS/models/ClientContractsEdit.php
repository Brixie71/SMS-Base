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
class ClientContractsEdit extends ClientContracts
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "ClientContractsEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "ClientContractsEdit";

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
        $this->contract_id->setVisibility();
        $this->client_id->setVisibility();
        $this->contract_code->setVisibility();
        $this->start_date->setVisibility();
        $this->end_date->setVisibility();
        $this->status->setVisibility();
        $this->contract_type->setVisibility();
        $this->service_level->setVisibility();
        $this->auto_renewal->setVisibility();
        $this->renewal_notice_days->setVisibility();
        $this->created_by->setVisibility();
        $this->created_at->setVisibility();
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'client_contracts';
        $this->TableName = 'client_contracts';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-edit-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (client_contracts)
        if (!isset($GLOBALS["client_contracts"]) || $GLOBALS["client_contracts"]::class == PROJECT_NAMESPACE . "client_contracts") {
            $GLOBALS["client_contracts"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'client_contracts');
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
                        $result["view"] = SameString($pageName, "ClientContractsView"); // If View page, no primary button
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
            $key .= @$ar['contract_id'];
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
            $this->contract_id->Visible = false;
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

        // Set up lookup cache
        $this->setupLookupOptions($this->auto_renewal);

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
            if (($keyValue = Get("contract_id") ?? Key(0) ?? Route(2)) !== null) {
                $this->contract_id->setQueryStringValue($keyValue);
                $this->contract_id->setOldValue($this->contract_id->QueryStringValue);
            } elseif (Post("contract_id") !== null) {
                $this->contract_id->setFormValue(Post("contract_id"));
                $this->contract_id->setOldValue($this->contract_id->FormValue);
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
                if (($keyValue = Get("contract_id") ?? Route("contract_id")) !== null) {
                    $this->contract_id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->contract_id->CurrentValue = null;
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
                        $this->terminate("ClientContractsList"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "ClientContractsList") {
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
                        if (GetPageName($returnUrl) != "ClientContractsList") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "ClientContractsList"; // Return list page content
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

        // Check field name 'contract_id' first before field var 'x_contract_id'
        $val = $CurrentForm->hasValue("contract_id") ? $CurrentForm->getValue("contract_id") : $CurrentForm->getValue("x_contract_id");
        if (!$this->contract_id->IsDetailKey) {
            $this->contract_id->setFormValue($val);
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

        // Check field name 'contract_code' first before field var 'x_contract_code'
        $val = $CurrentForm->hasValue("contract_code") ? $CurrentForm->getValue("contract_code") : $CurrentForm->getValue("x_contract_code");
        if (!$this->contract_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contract_code->Visible = false; // Disable update for API request
            } else {
                $this->contract_code->setFormValue($val);
            }
        }

        // Check field name 'start_date' first before field var 'x_start_date'
        $val = $CurrentForm->hasValue("start_date") ? $CurrentForm->getValue("start_date") : $CurrentForm->getValue("x_start_date");
        if (!$this->start_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->start_date->Visible = false; // Disable update for API request
            } else {
                $this->start_date->setFormValue($val, true, $validate);
            }
            $this->start_date->CurrentValue = UnFormatDateTime($this->start_date->CurrentValue, $this->start_date->formatPattern());
        }

        // Check field name 'end_date' first before field var 'x_end_date'
        $val = $CurrentForm->hasValue("end_date") ? $CurrentForm->getValue("end_date") : $CurrentForm->getValue("x_end_date");
        if (!$this->end_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->end_date->Visible = false; // Disable update for API request
            } else {
                $this->end_date->setFormValue($val, true, $validate);
            }
            $this->end_date->CurrentValue = UnFormatDateTime($this->end_date->CurrentValue, $this->end_date->formatPattern());
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

        // Check field name 'contract_type' first before field var 'x_contract_type'
        $val = $CurrentForm->hasValue("contract_type") ? $CurrentForm->getValue("contract_type") : $CurrentForm->getValue("x_contract_type");
        if (!$this->contract_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contract_type->Visible = false; // Disable update for API request
            } else {
                $this->contract_type->setFormValue($val);
            }
        }

        // Check field name 'service_level' first before field var 'x_service_level'
        $val = $CurrentForm->hasValue("service_level") ? $CurrentForm->getValue("service_level") : $CurrentForm->getValue("x_service_level");
        if (!$this->service_level->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->service_level->Visible = false; // Disable update for API request
            } else {
                $this->service_level->setFormValue($val);
            }
        }

        // Check field name 'auto_renewal' first before field var 'x_auto_renewal'
        $val = $CurrentForm->hasValue("auto_renewal") ? $CurrentForm->getValue("auto_renewal") : $CurrentForm->getValue("x_auto_renewal");
        if (!$this->auto_renewal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->auto_renewal->Visible = false; // Disable update for API request
            } else {
                $this->auto_renewal->setFormValue($val);
            }
        }

        // Check field name 'renewal_notice_days' first before field var 'x_renewal_notice_days'
        $val = $CurrentForm->hasValue("renewal_notice_days") ? $CurrentForm->getValue("renewal_notice_days") : $CurrentForm->getValue("x_renewal_notice_days");
        if (!$this->renewal_notice_days->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->renewal_notice_days->Visible = false; // Disable update for API request
            } else {
                $this->renewal_notice_days->setFormValue($val, true, $validate);
            }
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
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->contract_id->CurrentValue = $this->contract_id->FormValue;
        $this->client_id->CurrentValue = $this->client_id->FormValue;
        $this->contract_code->CurrentValue = $this->contract_code->FormValue;
        $this->start_date->CurrentValue = $this->start_date->FormValue;
        $this->start_date->CurrentValue = UnFormatDateTime($this->start_date->CurrentValue, $this->start_date->formatPattern());
        $this->end_date->CurrentValue = $this->end_date->FormValue;
        $this->end_date->CurrentValue = UnFormatDateTime($this->end_date->CurrentValue, $this->end_date->formatPattern());
        $this->status->CurrentValue = $this->status->FormValue;
        $this->contract_type->CurrentValue = $this->contract_type->FormValue;
        $this->service_level->CurrentValue = $this->service_level->FormValue;
        $this->auto_renewal->CurrentValue = $this->auto_renewal->FormValue;
        $this->renewal_notice_days->CurrentValue = $this->renewal_notice_days->FormValue;
        $this->created_by->CurrentValue = $this->created_by->FormValue;
        $this->created_at->CurrentValue = $this->created_at->FormValue;
        $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
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
        $this->contract_id->setDbValue($row['contract_id']);
        $this->client_id->setDbValue($row['client_id']);
        $this->contract_code->setDbValue($row['contract_code']);
        $this->start_date->setDbValue($row['start_date']);
        $this->end_date->setDbValue($row['end_date']);
        $this->status->setDbValue($row['status']);
        $this->contract_type->setDbValue($row['contract_type']);
        $this->service_level->setDbValue($row['service_level']);
        $this->auto_renewal->setDbValue((ConvertToBool($row['auto_renewal']) ? "1" : "0"));
        $this->renewal_notice_days->setDbValue($row['renewal_notice_days']);
        $this->created_by->setDbValue($row['created_by']);
        $this->created_at->setDbValue($row['created_at']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['contract_id'] = $this->contract_id->DefaultValue;
        $row['client_id'] = $this->client_id->DefaultValue;
        $row['contract_code'] = $this->contract_code->DefaultValue;
        $row['start_date'] = $this->start_date->DefaultValue;
        $row['end_date'] = $this->end_date->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        $row['contract_type'] = $this->contract_type->DefaultValue;
        $row['service_level'] = $this->service_level->DefaultValue;
        $row['auto_renewal'] = $this->auto_renewal->DefaultValue;
        $row['renewal_notice_days'] = $this->renewal_notice_days->DefaultValue;
        $row['created_by'] = $this->created_by->DefaultValue;
        $row['created_at'] = $this->created_at->DefaultValue;
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

        // contract_id
        $this->contract_id->RowCssClass = "row";

        // client_id
        $this->client_id->RowCssClass = "row";

        // contract_code
        $this->contract_code->RowCssClass = "row";

        // start_date
        $this->start_date->RowCssClass = "row";

        // end_date
        $this->end_date->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // contract_type
        $this->contract_type->RowCssClass = "row";

        // service_level
        $this->service_level->RowCssClass = "row";

        // auto_renewal
        $this->auto_renewal->RowCssClass = "row";

        // renewal_notice_days
        $this->renewal_notice_days->RowCssClass = "row";

        // created_by
        $this->created_by->RowCssClass = "row";

        // created_at
        $this->created_at->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // contract_id
            $this->contract_id->ViewValue = $this->contract_id->CurrentValue;

            // client_id
            $this->client_id->ViewValue = $this->client_id->CurrentValue;
            $this->client_id->ViewValue = FormatNumber($this->client_id->ViewValue, $this->client_id->formatPattern());

            // contract_code
            $this->contract_code->ViewValue = $this->contract_code->CurrentValue;

            // start_date
            $this->start_date->ViewValue = $this->start_date->CurrentValue;
            $this->start_date->ViewValue = FormatDateTime($this->start_date->ViewValue, $this->start_date->formatPattern());

            // end_date
            $this->end_date->ViewValue = $this->end_date->CurrentValue;
            $this->end_date->ViewValue = FormatDateTime($this->end_date->ViewValue, $this->end_date->formatPattern());

            // status
            $this->status->ViewValue = $this->status->CurrentValue;

            // contract_type
            $this->contract_type->ViewValue = $this->contract_type->CurrentValue;

            // service_level
            $this->service_level->ViewValue = $this->service_level->CurrentValue;

            // auto_renewal
            if (ConvertToBool($this->auto_renewal->CurrentValue)) {
                $this->auto_renewal->ViewValue = $this->auto_renewal->tagCaption(1) != "" ? $this->auto_renewal->tagCaption(1) : "Yes";
            } else {
                $this->auto_renewal->ViewValue = $this->auto_renewal->tagCaption(2) != "" ? $this->auto_renewal->tagCaption(2) : "No";
            }

            // renewal_notice_days
            $this->renewal_notice_days->ViewValue = $this->renewal_notice_days->CurrentValue;
            $this->renewal_notice_days->ViewValue = FormatNumber($this->renewal_notice_days->ViewValue, $this->renewal_notice_days->formatPattern());

            // created_by
            $this->created_by->ViewValue = $this->created_by->CurrentValue;
            $this->created_by->ViewValue = FormatNumber($this->created_by->ViewValue, $this->created_by->formatPattern());

            // created_at
            $this->created_at->ViewValue = $this->created_at->CurrentValue;
            $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, $this->created_at->formatPattern());

            // contract_id
            $this->contract_id->HrefValue = "";

            // client_id
            $this->client_id->HrefValue = "";

            // contract_code
            $this->contract_code->HrefValue = "";

            // start_date
            $this->start_date->HrefValue = "";

            // end_date
            $this->end_date->HrefValue = "";

            // status
            $this->status->HrefValue = "";

            // contract_type
            $this->contract_type->HrefValue = "";

            // service_level
            $this->service_level->HrefValue = "";

            // auto_renewal
            $this->auto_renewal->HrefValue = "";

            // renewal_notice_days
            $this->renewal_notice_days->HrefValue = "";

            // created_by
            $this->created_by->HrefValue = "";

            // created_at
            $this->created_at->HrefValue = "";
        } elseif ($this->RowType == RowType::EDIT) {
            // contract_id
            $this->contract_id->setupEditAttributes();
            $this->contract_id->EditValue = $this->contract_id->CurrentValue;

            // client_id
            $this->client_id->setupEditAttributes();
            $this->client_id->EditValue = $this->client_id->CurrentValue;
            $this->client_id->PlaceHolder = RemoveHtml($this->client_id->caption());
            if (strval($this->client_id->EditValue) != "" && is_numeric($this->client_id->EditValue)) {
                $this->client_id->EditValue = FormatNumber($this->client_id->EditValue, null);
            }

            // contract_code
            $this->contract_code->setupEditAttributes();
            if (!$this->contract_code->Raw) {
                $this->contract_code->CurrentValue = HtmlDecode($this->contract_code->CurrentValue);
            }
            $this->contract_code->EditValue = HtmlEncode($this->contract_code->CurrentValue);
            $this->contract_code->PlaceHolder = RemoveHtml($this->contract_code->caption());

            // start_date
            $this->start_date->setupEditAttributes();
            $this->start_date->EditValue = HtmlEncode(FormatDateTime($this->start_date->CurrentValue, $this->start_date->formatPattern()));
            $this->start_date->PlaceHolder = RemoveHtml($this->start_date->caption());

            // end_date
            $this->end_date->setupEditAttributes();
            $this->end_date->EditValue = HtmlEncode(FormatDateTime($this->end_date->CurrentValue, $this->end_date->formatPattern()));
            $this->end_date->PlaceHolder = RemoveHtml($this->end_date->caption());

            // status
            $this->status->setupEditAttributes();
            if (!$this->status->Raw) {
                $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->CurrentValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // contract_type
            $this->contract_type->setupEditAttributes();
            if (!$this->contract_type->Raw) {
                $this->contract_type->CurrentValue = HtmlDecode($this->contract_type->CurrentValue);
            }
            $this->contract_type->EditValue = HtmlEncode($this->contract_type->CurrentValue);
            $this->contract_type->PlaceHolder = RemoveHtml($this->contract_type->caption());

            // service_level
            $this->service_level->setupEditAttributes();
            if (!$this->service_level->Raw) {
                $this->service_level->CurrentValue = HtmlDecode($this->service_level->CurrentValue);
            }
            $this->service_level->EditValue = HtmlEncode($this->service_level->CurrentValue);
            $this->service_level->PlaceHolder = RemoveHtml($this->service_level->caption());

            // auto_renewal
            $this->auto_renewal->EditValue = $this->auto_renewal->options(false);
            $this->auto_renewal->PlaceHolder = RemoveHtml($this->auto_renewal->caption());

            // renewal_notice_days
            $this->renewal_notice_days->setupEditAttributes();
            $this->renewal_notice_days->EditValue = $this->renewal_notice_days->CurrentValue;
            $this->renewal_notice_days->PlaceHolder = RemoveHtml($this->renewal_notice_days->caption());
            if (strval($this->renewal_notice_days->EditValue) != "" && is_numeric($this->renewal_notice_days->EditValue)) {
                $this->renewal_notice_days->EditValue = FormatNumber($this->renewal_notice_days->EditValue, null);
            }

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

            // Edit refer script

            // contract_id
            $this->contract_id->HrefValue = "";

            // client_id
            $this->client_id->HrefValue = "";

            // contract_code
            $this->contract_code->HrefValue = "";

            // start_date
            $this->start_date->HrefValue = "";

            // end_date
            $this->end_date->HrefValue = "";

            // status
            $this->status->HrefValue = "";

            // contract_type
            $this->contract_type->HrefValue = "";

            // service_level
            $this->service_level->HrefValue = "";

            // auto_renewal
            $this->auto_renewal->HrefValue = "";

            // renewal_notice_days
            $this->renewal_notice_days->HrefValue = "";

            // created_by
            $this->created_by->HrefValue = "";

            // created_at
            $this->created_at->HrefValue = "";
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
            if ($this->contract_id->Visible && $this->contract_id->Required) {
                if (!$this->contract_id->IsDetailKey && EmptyValue($this->contract_id->FormValue)) {
                    $this->contract_id->addErrorMessage(str_replace("%s", $this->contract_id->caption(), $this->contract_id->RequiredErrorMessage));
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
            if ($this->contract_code->Visible && $this->contract_code->Required) {
                if (!$this->contract_code->IsDetailKey && EmptyValue($this->contract_code->FormValue)) {
                    $this->contract_code->addErrorMessage(str_replace("%s", $this->contract_code->caption(), $this->contract_code->RequiredErrorMessage));
                }
            }
            if ($this->start_date->Visible && $this->start_date->Required) {
                if (!$this->start_date->IsDetailKey && EmptyValue($this->start_date->FormValue)) {
                    $this->start_date->addErrorMessage(str_replace("%s", $this->start_date->caption(), $this->start_date->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->start_date->FormValue, $this->start_date->formatPattern())) {
                $this->start_date->addErrorMessage($this->start_date->getErrorMessage(false));
            }
            if ($this->end_date->Visible && $this->end_date->Required) {
                if (!$this->end_date->IsDetailKey && EmptyValue($this->end_date->FormValue)) {
                    $this->end_date->addErrorMessage(str_replace("%s", $this->end_date->caption(), $this->end_date->RequiredErrorMessage));
                }
            }
            if (!CheckDate($this->end_date->FormValue, $this->end_date->formatPattern())) {
                $this->end_date->addErrorMessage($this->end_date->getErrorMessage(false));
            }
            if ($this->status->Visible && $this->status->Required) {
                if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                    $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
                }
            }
            if ($this->contract_type->Visible && $this->contract_type->Required) {
                if (!$this->contract_type->IsDetailKey && EmptyValue($this->contract_type->FormValue)) {
                    $this->contract_type->addErrorMessage(str_replace("%s", $this->contract_type->caption(), $this->contract_type->RequiredErrorMessage));
                }
            }
            if ($this->service_level->Visible && $this->service_level->Required) {
                if (!$this->service_level->IsDetailKey && EmptyValue($this->service_level->FormValue)) {
                    $this->service_level->addErrorMessage(str_replace("%s", $this->service_level->caption(), $this->service_level->RequiredErrorMessage));
                }
            }
            if ($this->auto_renewal->Visible && $this->auto_renewal->Required) {
                if ($this->auto_renewal->FormValue == "") {
                    $this->auto_renewal->addErrorMessage(str_replace("%s", $this->auto_renewal->caption(), $this->auto_renewal->RequiredErrorMessage));
                }
            }
            if ($this->renewal_notice_days->Visible && $this->renewal_notice_days->Required) {
                if (!$this->renewal_notice_days->IsDetailKey && EmptyValue($this->renewal_notice_days->FormValue)) {
                    $this->renewal_notice_days->addErrorMessage(str_replace("%s", $this->renewal_notice_days->caption(), $this->renewal_notice_days->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->renewal_notice_days->FormValue)) {
                $this->renewal_notice_days->addErrorMessage($this->renewal_notice_days->getErrorMessage(false));
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

        // Check field with unique index (contract_code)
        if ($this->contract_code->CurrentValue != "") {
            $filterChk = "(\"contract_code\" = '" . AdjustSql($this->contract_code->CurrentValue, $this->Dbid) . "')";
            $filterChk .= " AND NOT (" . $filter . ")";
            $this->CurrentFilter = $filterChk;
            $sqlChk = $this->getCurrentSql();
            $rsChk = $conn->executeQuery($sqlChk);
            if (!$rsChk) {
                return false;
            }
            if ($rsChk->fetch()) {
                $idxErrMsg = str_replace("%f", $this->contract_code->caption(), $Language->phrase("DupIndex"));
                $idxErrMsg = str_replace("%v", $this->contract_code->CurrentValue, $idxErrMsg);
                $this->setFailureMessage($idxErrMsg);
                return false;
            }
        }

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

        // contract_code
        $this->contract_code->setDbValueDef($rsnew, $this->contract_code->CurrentValue, $this->contract_code->ReadOnly);

        // start_date
        $this->start_date->setDbValueDef($rsnew, UnFormatDateTime($this->start_date->CurrentValue, $this->start_date->formatPattern()), $this->start_date->ReadOnly);

        // end_date
        $this->end_date->setDbValueDef($rsnew, UnFormatDateTime($this->end_date->CurrentValue, $this->end_date->formatPattern()), $this->end_date->ReadOnly);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, $this->status->ReadOnly);

        // contract_type
        $this->contract_type->setDbValueDef($rsnew, $this->contract_type->CurrentValue, $this->contract_type->ReadOnly);

        // service_level
        $this->service_level->setDbValueDef($rsnew, $this->service_level->CurrentValue, $this->service_level->ReadOnly);

        // auto_renewal
        $tmpBool = $this->auto_renewal->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->auto_renewal->setDbValueDef($rsnew, $tmpBool, $this->auto_renewal->ReadOnly);

        // renewal_notice_days
        $this->renewal_notice_days->setDbValueDef($rsnew, $this->renewal_notice_days->CurrentValue, $this->renewal_notice_days->ReadOnly);

        // created_by
        $this->created_by->setDbValueDef($rsnew, $this->created_by->CurrentValue, $this->created_by->ReadOnly);

        // created_at
        $this->created_at->setDbValueDef($rsnew, UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern()), $this->created_at->ReadOnly);
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
        if (isset($row['contract_code'])) { // contract_code
            $this->contract_code->CurrentValue = $row['contract_code'];
        }
        if (isset($row['start_date'])) { // start_date
            $this->start_date->CurrentValue = $row['start_date'];
        }
        if (isset($row['end_date'])) { // end_date
            $this->end_date->CurrentValue = $row['end_date'];
        }
        if (isset($row['status'])) { // status
            $this->status->CurrentValue = $row['status'];
        }
        if (isset($row['contract_type'])) { // contract_type
            $this->contract_type->CurrentValue = $row['contract_type'];
        }
        if (isset($row['service_level'])) { // service_level
            $this->service_level->CurrentValue = $row['service_level'];
        }
        if (isset($row['auto_renewal'])) { // auto_renewal
            $this->auto_renewal->CurrentValue = $row['auto_renewal'];
        }
        if (isset($row['renewal_notice_days'])) { // renewal_notice_days
            $this->renewal_notice_days->CurrentValue = $row['renewal_notice_days'];
        }
        if (isset($row['created_by'])) { // created_by
            $this->created_by->CurrentValue = $row['created_by'];
        }
        if (isset($row['created_at'])) { // created_at
            $this->created_at->CurrentValue = $row['created_at'];
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ClientContractsList"), "", $this->TableVar, true);
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
                case "x_auto_renewal":
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
