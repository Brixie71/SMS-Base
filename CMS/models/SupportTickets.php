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
 * Table class for support_tickets
 */
class SupportTickets extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $DbErrorMessage = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Ajax / Modal
    public $UseAjaxActions = false;
    public $ModalSearch = false;
    public $ModalView = false;
    public $ModalAdd = false;
    public $ModalEdit = false;
    public $ModalUpdate = false;
    public $InlineDelete = false;
    public $ModalGridAdd = false;
    public $ModalGridEdit = false;
    public $ModalMultiEdit = false;

    // Fields
    public $ticket_id;
    public $client_id;
    public $equipment_id;
    public $subject;
    public $description;
    public $priority;
    public $category;
    public $submitted_by;
    public $assigned_to;
    public $created_at;
    public $status;
    public $resolution;
    public $closed_at;
    public $response_time_minutes;
    public $resolution_time_minutes;
    public $sla_compliant;
    public $closed_by;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("app.language");
        $this->TableVar = "support_tickets";
        $this->TableName = 'support_tickets';
        $this->TableType = "LINKTABLE";

        // Update Table
        $this->UpdateTable = "support_tickets";
        $this->Dbid = 'philtower_cms';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)

        // PDF
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)

        // PhpSpreadsheet
        $this->ExportExcelPageOrientation = null; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = null; // Page size (PhpSpreadsheet only)

        // PHPWord
        $this->ExportWordPageOrientation = ""; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = ""; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UseAjaxActions = $this->UseAjaxActions || Config("USE_AJAX_ACTIONS");
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this);

        // ticket_id
        $this->ticket_id = new DbField(
            $this, // Table
            'x_ticket_id', // Variable name
            'ticket_id', // Name
            '"ticket_id"', // Expression
            'CAST("ticket_id" AS varchar(255))', // Basic search expression
            3, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"ticket_id"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'NO' // Edit Tag
        );
        $this->ticket_id->InputTextType = "text";
        $this->ticket_id->Raw = true;
        $this->ticket_id->IsAutoIncrement = true; // Autoincrement field
        $this->ticket_id->IsPrimaryKey = true; // Primary key field
        $this->ticket_id->Nullable = false; // NOT NULL field
        $this->ticket_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ticket_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['ticket_id'] = &$this->ticket_id;

        // client_id
        $this->client_id = new DbField(
            $this, // Table
            'x_client_id', // Variable name
            'client_id', // Name
            '"client_id"', // Expression
            'CAST("client_id" AS varchar(255))', // Basic search expression
            3, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"client_id"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->client_id->InputTextType = "text";
        $this->client_id->Raw = true;
        $this->client_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->client_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['client_id'] = &$this->client_id;

        // equipment_id
        $this->equipment_id = new DbField(
            $this, // Table
            'x_equipment_id', // Variable name
            'equipment_id', // Name
            '"equipment_id"', // Expression
            'CAST("equipment_id" AS varchar(255))', // Basic search expression
            3, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"equipment_id"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->equipment_id->InputTextType = "text";
        $this->equipment_id->Raw = true;
        $this->equipment_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->equipment_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['equipment_id'] = &$this->equipment_id;

        // subject
        $this->subject = new DbField(
            $this, // Table
            'x_subject', // Variable name
            'subject', // Name
            '"subject"', // Expression
            '"subject"', // Basic search expression
            200, // Type
            200, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"subject"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->subject->InputTextType = "text";
        $this->subject->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['subject'] = &$this->subject;

        // description
        $this->description = new DbField(
            $this, // Table
            'x_description', // Variable name
            'description', // Name
            '"description"', // Expression
            '"description"', // Basic search expression
            201, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"description"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->description->InputTextType = "text";
        $this->description->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['description'] = &$this->description;

        // priority
        $this->priority = new DbField(
            $this, // Table
            'x_priority', // Variable name
            'priority', // Name
            '"priority"', // Expression
            '"priority"', // Basic search expression
            200, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"priority"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->priority->InputTextType = "text";
        $this->priority->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['priority'] = &$this->priority;

        // category
        $this->category = new DbField(
            $this, // Table
            'x_category', // Variable name
            'category', // Name
            '"category"', // Expression
            '"category"', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"category"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->category->InputTextType = "text";
        $this->category->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['category'] = &$this->category;

        // submitted_by
        $this->submitted_by = new DbField(
            $this, // Table
            'x_submitted_by', // Variable name
            'submitted_by', // Name
            '"submitted_by"', // Expression
            'CAST("submitted_by" AS varchar(255))', // Basic search expression
            3, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"submitted_by"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->submitted_by->InputTextType = "text";
        $this->submitted_by->Raw = true;
        $this->submitted_by->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->submitted_by->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['submitted_by'] = &$this->submitted_by;

        // assigned_to
        $this->assigned_to = new DbField(
            $this, // Table
            'x_assigned_to', // Variable name
            'assigned_to', // Name
            '"assigned_to"', // Expression
            'CAST("assigned_to" AS varchar(255))', // Basic search expression
            3, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"assigned_to"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->assigned_to->InputTextType = "text";
        $this->assigned_to->Raw = true;
        $this->assigned_to->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->assigned_to->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['assigned_to'] = &$this->assigned_to;

        // created_at
        $this->created_at = new DbField(
            $this, // Table
            'x_created_at', // Variable name
            'created_at', // Name
            '"created_at"', // Expression
            CastDateFieldForLike("\"created_at\"", 0, "philtower_cms"), // Basic search expression
            135, // Type
            0, // Size
            0, // Date/Time format
            false, // Is upload field
            '"created_at"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->created_at->InputTextType = "text";
        $this->created_at->Raw = true;
        $this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->created_at->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['created_at'] = &$this->created_at;

        // status
        $this->status = new DbField(
            $this, // Table
            'x_status', // Variable name
            'status', // Name
            '"status"', // Expression
            '"status"', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"status"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->status->InputTextType = "text";
        $this->status->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['status'] = &$this->status;

        // resolution
        $this->resolution = new DbField(
            $this, // Table
            'x_resolution', // Variable name
            'resolution', // Name
            '"resolution"', // Expression
            '"resolution"', // Basic search expression
            201, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"resolution"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->resolution->InputTextType = "text";
        $this->resolution->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['resolution'] = &$this->resolution;

        // closed_at
        $this->closed_at = new DbField(
            $this, // Table
            'x_closed_at', // Variable name
            'closed_at', // Name
            '"closed_at"', // Expression
            CastDateFieldForLike("\"closed_at\"", 0, "philtower_cms"), // Basic search expression
            135, // Type
            0, // Size
            0, // Date/Time format
            false, // Is upload field
            '"closed_at"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->closed_at->InputTextType = "text";
        $this->closed_at->Raw = true;
        $this->closed_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->closed_at->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['closed_at'] = &$this->closed_at;

        // response_time_minutes
        $this->response_time_minutes = new DbField(
            $this, // Table
            'x_response_time_minutes', // Variable name
            'response_time_minutes', // Name
            '"response_time_minutes"', // Expression
            'CAST("response_time_minutes" AS varchar(255))', // Basic search expression
            3, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"response_time_minutes"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->response_time_minutes->InputTextType = "text";
        $this->response_time_minutes->Raw = true;
        $this->response_time_minutes->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->response_time_minutes->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['response_time_minutes'] = &$this->response_time_minutes;

        // resolution_time_minutes
        $this->resolution_time_minutes = new DbField(
            $this, // Table
            'x_resolution_time_minutes', // Variable name
            'resolution_time_minutes', // Name
            '"resolution_time_minutes"', // Expression
            'CAST("resolution_time_minutes" AS varchar(255))', // Basic search expression
            3, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"resolution_time_minutes"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->resolution_time_minutes->InputTextType = "text";
        $this->resolution_time_minutes->Raw = true;
        $this->resolution_time_minutes->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->resolution_time_minutes->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['resolution_time_minutes'] = &$this->resolution_time_minutes;

        // sla_compliant
        $this->sla_compliant = new DbField(
            $this, // Table
            'x_sla_compliant', // Variable name
            'sla_compliant', // Name
            '"sla_compliant"', // Expression
            'CAST("sla_compliant" AS varchar(255))', // Basic search expression
            11, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"sla_compliant"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'CHECKBOX' // Edit Tag
        );
        $this->sla_compliant->InputTextType = "text";
        $this->sla_compliant->Raw = true;
        $this->sla_compliant->setDataType(DataType::BOOLEAN);
        $this->sla_compliant->Lookup = new Lookup($this->sla_compliant, 'support_tickets', false, '', ["","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->sla_compliant->OptionCount = 2;
        $this->sla_compliant->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['sla_compliant'] = &$this->sla_compliant;

        // closed_by
        $this->closed_by = new DbField(
            $this, // Table
            'x_closed_by', // Variable name
            'closed_by', // Name
            '"closed_by"', // Expression
            'CAST("closed_by" AS varchar(255))', // Basic search expression
            3, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"closed_by"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->closed_by->InputTextType = "text";
        $this->closed_by->Raw = true;
        $this->closed_by->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->closed_by->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['closed_by'] = &$this->closed_by;

        // Add Doctrine Cache
        $this->Cache = new \Symfony\Component\Cache\Adapter\ArrayAdapter();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);

        // Call Table Load event
        $this->tableLoad();
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        }
    }

    // Update field sort
    public function updateFieldSort()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        $flds = GetSortFields($orderBy);
        foreach ($this->Fields as $field) {
            $fldSort = "";
            foreach ($flds as $fld) {
                if ($fld[0] == $field->Expression || $fld[0] == $field->VirtualExpression) {
                    $fldSort = $fld[1];
                }
            }
            $field->setSort($fldSort);
        }
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
    }

    // Get FROM clause
    public function getSqlFrom()
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "support_tickets";
    }

    // Get FROM clause (for backward compatibility)
    public function sqlFrom()
    {
        return $this->getSqlFrom();
    }

    // Set FROM clause
    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    // Get SELECT clause
    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select($this->sqlSelectFields());
    }

    // Get list of fields
    private function sqlSelectFields()
    {
        $useFieldNames = false;
        $fieldNames = [];
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($this->Fields as $field) {
            $expr = $field->Expression;
            $customExpr = $field->CustomDataType?->convertToPHPValueSQL($expr, $platform) ?? $expr;
            if ($customExpr != $expr) {
                $fieldNames[] = $customExpr . " AS " . QuotedName($field->Name, $this->Dbid);
                $useFieldNames = true;
            } else {
                $fieldNames[] = $expr;
            }
        }
        return $useFieldNames ? implode(", ", $fieldNames) : "*";
    }

    // Get SELECT clause (for backward compatibility)
    public function sqlSelect()
    {
        return $this->getSqlSelect();
    }

    // Set SELECT clause
    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    // Get WHERE clause
    public function getSqlWhere()
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    // Get WHERE clause (for backward compatibility)
    public function sqlWhere()
    {
        return $this->getSqlWhere();
    }

    // Set WHERE clause
    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    // Get GROUP BY clause
    public function getSqlGroupBy()
    {
        return $this->SqlGroupBy != "" ? $this->SqlGroupBy : "";
    }

    // Get GROUP BY clause (for backward compatibility)
    public function sqlGroupBy()
    {
        return $this->getSqlGroupBy();
    }

    // set GROUP BY clause
    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    // Get HAVING clause
    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    // Get HAVING clause (for backward compatibility)
    public function sqlHaving()
    {
        return $this->getSqlHaving();
    }

    // Set HAVING clause
    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    // Get ORDER BY clause
    public function getSqlOrderBy()
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
    }

    // Get ORDER BY clause (for backward compatibility)
    public function sqlOrderBy()
    {
        return $this->getSqlOrderBy();
    }

    // set ORDER BY clause
    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return ($allow & Allow::ADD->value) == Allow::ADD->value;
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return ($allow & Allow::EDIT->value) == Allow::EDIT->value;
            case "delete":
                return ($allow & Allow::DELETE->value) == Allow::DELETE->value;
            case "view":
                return ($allow & Allow::VIEW->value) == Allow::VIEW->value;
            case "search":
                return ($allow & Allow::SEARCH->value) == Allow::SEARCH->value;
            case "lookup":
                return ($allow & Allow::LOOKUP->value) == Allow::LOOKUP->value;
            default:
                return ($allow & Allow::LIST->value) == Allow::LIST->value;
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $sqlwrk = $sql instanceof QueryBuilder // Query builder
            ? (clone $sql)->resetQueryPart("orderBy")->getSQL()
            : $sql;
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            in_array($this->TableType, ["TABLE", "VIEW", "LINKTABLE"]) &&
            preg_match($pattern, $sqlwrk) &&
            !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*SELECT\s+DISTINCT\s+/i', $sqlwrk) &&
            !preg_match('/\s+ORDER\s+BY\s+/i', $sqlwrk)
        ) {
            $sqlcnt = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlcnt = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlcnt);
        if ($cnt !== false) {
            return (int)$cnt;
        }
        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        $result = $conn->executeQuery($sqlwrk);
        $cnt = $result->rowCount();
        if ($cnt == 0) { // Unable to get record count, count directly
            while ($result->fetch()) {
                $cnt++;
            }
        }
        return $cnt;
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->getSqlAsQueryBuilder($where, $orderBy)->getSQL();
    }

    // Get QueryBuilder
    public function getSqlAsQueryBuilder($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        );
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $isCustomView = $this->TableType == "CUSTOMVIEW";
        $select = $isCustomView ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $isCustomView ? $this->getSqlGroupBy() : "";
        $having = $isCustomView ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $isCustomView = $this->TableType == "CUSTOMVIEW";
        $select = $isCustomView ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $isCustomView ? $this->getSqlGroupBy() : "";
        $having = $isCustomView ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $field = $this->Fields[$name];
            $parm = $queryBuilder->createPositionalParameter($value, $field->getParameterType());
            $parm = $field->CustomDataType?->convertToDatabaseValueSQL($parm, $platform) ?? $parm; // Convert database SQL
            $queryBuilder->setValue($field->Expression, $parm);
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        try {
            $queryBuilder = $this->insertSql($rs);
            $result = $conn->executeQuery(
                $queryBuilder->getSQL() . " RETURNING ticket_id",
                $queryBuilder->getParameters(),
                $queryBuilder->getParameterTypes()
            )->fetchOne();
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $result = false;
            $this->DbErrorMessage = $e->getMessage();
        }
        if ($result) {
            $this->ticket_id->setDbValue($result);
            $rs['ticket_id'] = $this->ticket_id->DbValue;
        }
        return $result !== false ? 1 : false;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $field = $this->Fields[$name];
            $parm = $queryBuilder->createPositionalParameter($value, $field->getParameterType());
            $parm = $field->CustomDataType?->convertToDatabaseValueSQL($parm, $platform) ?? $parm; // Convert database SQL
            $queryBuilder->set($field->Expression, $parm);
        }
        $filter = $curfilter ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        try {
            $success = $this->updateSql($rs, $where, $curfilter)->executeStatement();
            $success = $success > 0 ? $success : true;
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $success = false;
            $this->DbErrorMessage = $e->getMessage();
        }

        // Return auto increment field
        if ($success) {
            if (!isset($rs['ticket_id']) && !EmptyValue($this->ticket_id->CurrentValue)) {
                $rs['ticket_id'] = $this->ticket_id->CurrentValue;
            }
        }
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('ticket_id', $rs)) {
                AddFilter($where, QuotedName('ticket_id', $this->Dbid) . '=' . QuotedValue($rs['ticket_id'], $this->ticket_id->DataType, $this->Dbid));
            }
        }
        $filter = $curfilter ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            try {
                $success = $this->deleteSql($rs, $where, $curfilter)->executeStatement();
                $this->DbErrorMessage = "";
            } catch (\Exception $e) {
                $success = false;
                $this->DbErrorMessage = $e->getMessage();
            }
        }
        return $success;
    }

    // Load DbValue from result set or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->ticket_id->DbValue = $row['ticket_id'];
        $this->client_id->DbValue = $row['client_id'];
        $this->equipment_id->DbValue = $row['equipment_id'];
        $this->subject->DbValue = $row['subject'];
        $this->description->DbValue = $row['description'];
        $this->priority->DbValue = $row['priority'];
        $this->category->DbValue = $row['category'];
        $this->submitted_by->DbValue = $row['submitted_by'];
        $this->assigned_to->DbValue = $row['assigned_to'];
        $this->created_at->DbValue = $row['created_at'];
        $this->status->DbValue = $row['status'];
        $this->resolution->DbValue = $row['resolution'];
        $this->closed_at->DbValue = $row['closed_at'];
        $this->response_time_minutes->DbValue = $row['response_time_minutes'];
        $this->resolution_time_minutes->DbValue = $row['resolution_time_minutes'];
        $this->sla_compliant->DbValue = (ConvertToBool($row['sla_compliant']) ? "1" : "0");
        $this->closed_by->DbValue = $row['closed_by'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "\"ticket_id\" = @ticket_id@";
    }

    // Get Key
    public function getKey($current = false, $keySeparator = null)
    {
        $keys = [];
        $val = $current ? $this->ticket_id->CurrentValue : $this->ticket_id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $keySeparator ??= Config("COMPOSITE_KEY_SEPARATOR");
        return implode($keySeparator, $keys);
    }

    // Set Key
    public function setKey($key, $current = false, $keySeparator = null)
    {
        $keySeparator ??= Config("COMPOSITE_KEY_SEPARATOR");
        $this->OldKey = strval($key);
        $keys = explode($keySeparator, $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->ticket_id->CurrentValue = $keys[0];
            } else {
                $this->ticket_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null, $current = false)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('ticket_id', $row) ? $row['ticket_id'] : null;
        } else {
            $val = !EmptyValue($this->ticket_id->OldValue) && !$current ? $this->ticket_id->OldValue : $this->ticket_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@ticket_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("SupportTicketsList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        return match ($pageName) {
            "SupportTicketsView" => $Language->phrase("View"),
            "SupportTicketsEdit" => $Language->phrase("Edit"),
            "SupportTicketsAdd" => $Language->phrase("Add"),
            default => ""
        };
    }

    // Default route URL
    public function getDefaultRouteUrl()
    {
        return "SupportTicketsList";
    }

    // API page name
    public function getApiPageName($action)
    {
        return match (strtolower($action)) {
            Config("API_VIEW_ACTION") => "SupportTicketsView",
            Config("API_ADD_ACTION") => "SupportTicketsAdd",
            Config("API_EDIT_ACTION") => "SupportTicketsEdit",
            Config("API_DELETE_ACTION") => "SupportTicketsDelete",
            Config("API_LIST_ACTION") => "SupportTicketsList",
            default => ""
        };
    }

    // Current URL
    public function getCurrentUrl($parm = "")
    {
        $url = CurrentPageUrl(false);
        if ($parm != "") {
            $url = $this->keyUrl($url, $parm);
        } else {
            $url = $this->keyUrl($url, Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // List URL
    public function getListUrl()
    {
        return "SupportTicketsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("SupportTicketsView", $parm);
        } else {
            $url = $this->keyUrl("SupportTicketsView", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "SupportTicketsAdd?" . $parm;
        } else {
            $url = "SupportTicketsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("SupportTicketsEdit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("SupportTicketsList", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("SupportTicketsAdd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("SupportTicketsList", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl($parm = "")
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("SupportTicketsDelete", $parm);
        }
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"ticket_id\":" . VarToJson($this->ticket_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->ticket_id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->ticket_id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($this->PageID != "grid" && $fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-ew-action="sort" data-ajax="' . ($this->UseAjaxActions ? "true" : "false") . '" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
            if ($this->ContextClass) { // Add context
                $attrs .= ' data-context="' . HtmlEncode($this->ContextClass) . '"';
            }
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($this->PageID != "grid" && !$this->isExport() && $fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") .
                (is_array($fld->EditValue) ? str_replace("%c", count($fld->EditValue), $Language->phrase("FilterCount")) : '') .
                '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        global $DashboardReport;
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = "order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort();
            if ($DashboardReport) {
                $urlParm .= "&amp;" . Config("PAGE_DASHBOARD") . "=" . $DashboardReport;
            }
            return $this->addMasterUrl($this->CurrentPageName . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            $isApi = IsApi();
            $keyValues = $isApi
                ? (Route(0) == "export"
                    ? array_map(fn ($i) => Route($i + 3), range(0, 0))  // Export API
                    : array_map(fn ($i) => Route($i + 2), range(0, 0))) // Other API
                : []; // Non-API
            if (($keyValue = Param("ticket_id") ?? Route("ticket_id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif ($isApi && (($keyValue = Key(0) ?? $keyValues[0] ?? null) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from records
    public function getFilterFromRecords($rows)
    {
        return implode(" OR ", array_map(fn($row) => "(" . $this->getRecordFilter($row) . ")", $rows));
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->ticket_id->CurrentValue = $key;
            } else {
                $this->ticket_id->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load result set based on filter/sort
    public function loadRs($filter, $sort = "")
    {
        $sql = $this->getSql($filter, $sort); // Set up filter (WHERE Clause) / sort (ORDER BY Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
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
        $this->sla_compliant->setDbValue(ConvertToBool($row['sla_compliant']) ? "1" : "0");
        $this->closed_by->setDbValue($row['closed_by']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "SupportTicketsList";
        $listClass = PROJECT_NAMESPACE . $listPage;
        $page = new $listClass();
        $page->loadRecordsetFromFilter($filter);
        $view = Container("app.view");
        $template = $listPage . ".php"; // View
        $GLOBALS["Title"] ??= $page->Title; // Title
        try {
            $Response = $view->render($Response, $template, $GLOBALS);
        } finally {
            $page->terminate(); // Terminate page and clean up
        }
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ticket_id

        // client_id

        // equipment_id

        // subject

        // description

        // priority

        // category

        // submitted_by

        // assigned_to

        // created_at

        // status

        // resolution

        // closed_at

        // response_time_minutes

        // resolution_time_minutes

        // sla_compliant

        // closed_by

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

        // ticket_id
        $this->ticket_id->HrefValue = "";
        $this->ticket_id->TooltipValue = "";

        // client_id
        $this->client_id->HrefValue = "";
        $this->client_id->TooltipValue = "";

        // equipment_id
        $this->equipment_id->HrefValue = "";
        $this->equipment_id->TooltipValue = "";

        // subject
        $this->subject->HrefValue = "";
        $this->subject->TooltipValue = "";

        // description
        $this->description->HrefValue = "";
        $this->description->TooltipValue = "";

        // priority
        $this->priority->HrefValue = "";
        $this->priority->TooltipValue = "";

        // category
        $this->category->HrefValue = "";
        $this->category->TooltipValue = "";

        // submitted_by
        $this->submitted_by->HrefValue = "";
        $this->submitted_by->TooltipValue = "";

        // assigned_to
        $this->assigned_to->HrefValue = "";
        $this->assigned_to->TooltipValue = "";

        // created_at
        $this->created_at->HrefValue = "";
        $this->created_at->TooltipValue = "";

        // status
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // resolution
        $this->resolution->HrefValue = "";
        $this->resolution->TooltipValue = "";

        // closed_at
        $this->closed_at->HrefValue = "";
        $this->closed_at->TooltipValue = "";

        // response_time_minutes
        $this->response_time_minutes->HrefValue = "";
        $this->response_time_minutes->TooltipValue = "";

        // resolution_time_minutes
        $this->resolution_time_minutes->HrefValue = "";
        $this->resolution_time_minutes->TooltipValue = "";

        // sla_compliant
        $this->sla_compliant->HrefValue = "";
        $this->sla_compliant->TooltipValue = "";

        // closed_by
        $this->closed_by->HrefValue = "";
        $this->closed_by->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // ticket_id
        $this->ticket_id->setupEditAttributes();
        $this->ticket_id->EditValue = $this->ticket_id->CurrentValue;

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
        $this->subject->EditValue = $this->subject->CurrentValue;
        $this->subject->PlaceHolder = RemoveHtml($this->subject->caption());

        // description
        $this->description->setupEditAttributes();
        $this->description->EditValue = $this->description->CurrentValue;
        $this->description->PlaceHolder = RemoveHtml($this->description->caption());

        // priority
        $this->priority->setupEditAttributes();
        if (!$this->priority->Raw) {
            $this->priority->CurrentValue = HtmlDecode($this->priority->CurrentValue);
        }
        $this->priority->EditValue = $this->priority->CurrentValue;
        $this->priority->PlaceHolder = RemoveHtml($this->priority->caption());

        // category
        $this->category->setupEditAttributes();
        if (!$this->category->Raw) {
            $this->category->CurrentValue = HtmlDecode($this->category->CurrentValue);
        }
        $this->category->EditValue = $this->category->CurrentValue;
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
        $this->created_at->EditValue = FormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        $this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

        // status
        $this->status->setupEditAttributes();
        if (!$this->status->Raw) {
            $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
        }
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // resolution
        $this->resolution->setupEditAttributes();
        $this->resolution->EditValue = $this->resolution->CurrentValue;
        $this->resolution->PlaceHolder = RemoveHtml($this->resolution->caption());

        // closed_at
        $this->closed_at->setupEditAttributes();
        $this->closed_at->EditValue = FormatDateTime($this->closed_at->CurrentValue, $this->closed_at->formatPattern());
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

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $result, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$result || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->ticket_id);
                    $doc->exportCaption($this->client_id);
                    $doc->exportCaption($this->equipment_id);
                    $doc->exportCaption($this->subject);
                    $doc->exportCaption($this->description);
                    $doc->exportCaption($this->priority);
                    $doc->exportCaption($this->category);
                    $doc->exportCaption($this->submitted_by);
                    $doc->exportCaption($this->assigned_to);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->resolution);
                    $doc->exportCaption($this->closed_at);
                    $doc->exportCaption($this->response_time_minutes);
                    $doc->exportCaption($this->resolution_time_minutes);
                    $doc->exportCaption($this->sla_compliant);
                    $doc->exportCaption($this->closed_by);
                } else {
                    $doc->exportCaption($this->ticket_id);
                    $doc->exportCaption($this->client_id);
                    $doc->exportCaption($this->equipment_id);
                    $doc->exportCaption($this->subject);
                    $doc->exportCaption($this->priority);
                    $doc->exportCaption($this->category);
                    $doc->exportCaption($this->submitted_by);
                    $doc->exportCaption($this->assigned_to);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->closed_at);
                    $doc->exportCaption($this->response_time_minutes);
                    $doc->exportCaption($this->resolution_time_minutes);
                    $doc->exportCaption($this->sla_compliant);
                    $doc->exportCaption($this->closed_by);
                }
                $doc->endExportRow();
            }
        }
        $recCnt = $startRec - 1;
        $stopRec = $stopRec > 0 ? $stopRec : PHP_INT_MAX;
        while (($row = $result->fetch()) && $recCnt < $stopRec) {
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = RowType::VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->ticket_id);
                        $doc->exportField($this->client_id);
                        $doc->exportField($this->equipment_id);
                        $doc->exportField($this->subject);
                        $doc->exportField($this->description);
                        $doc->exportField($this->priority);
                        $doc->exportField($this->category);
                        $doc->exportField($this->submitted_by);
                        $doc->exportField($this->assigned_to);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->status);
                        $doc->exportField($this->resolution);
                        $doc->exportField($this->closed_at);
                        $doc->exportField($this->response_time_minutes);
                        $doc->exportField($this->resolution_time_minutes);
                        $doc->exportField($this->sla_compliant);
                        $doc->exportField($this->closed_by);
                    } else {
                        $doc->exportField($this->ticket_id);
                        $doc->exportField($this->client_id);
                        $doc->exportField($this->equipment_id);
                        $doc->exportField($this->subject);
                        $doc->exportField($this->priority);
                        $doc->exportField($this->category);
                        $doc->exportField($this->submitted_by);
                        $doc->exportField($this->assigned_to);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->status);
                        $doc->exportField($this->closed_at);
                        $doc->exportField($this->response_time_minutes);
                        $doc->exportField($this->resolution_time_minutes);
                        $doc->exportField($this->sla_compliant);
                        $doc->exportField($this->closed_by);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($doc, $row);
            }
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;

        // No binary fields
        return false;
    }

    // Table level events

    // Table Load event
    public function tableLoad()
    {
        // Enter your code here
    }

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected($rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, $rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, $rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted($rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, $args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
