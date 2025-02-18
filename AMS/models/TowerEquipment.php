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
 * Table class for tower_equipment
 */
class TowerEquipment extends DbTable
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
    public $equipment_id;
    public $tower_id;
    public $model_id;
    public $serial_number;
    public $installation_date;
    public $warranty_expiry;
    public $status_id;
    public $last_maintenance;
    public $next_maintenance;
    public $client_id;
    public $installed_by;
    public $created_by;
    public $created_at;
    public $updated_by;
    public $updated_at;
    public $is_active;
    public $notes;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("app.language");
        $this->TableVar = "tower_equipment";
        $this->TableName = 'tower_equipment';
        $this->TableType = "LINKTABLE";

        // Update Table
        $this->UpdateTable = "tower_equipment";
        $this->Dbid = 'philtower_ams';
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
            'NO' // Edit Tag
        );
        $this->equipment_id->InputTextType = "text";
        $this->equipment_id->Raw = true;
        $this->equipment_id->IsAutoIncrement = true; // Autoincrement field
        $this->equipment_id->IsPrimaryKey = true; // Primary key field
        $this->equipment_id->Nullable = false; // NOT NULL field
        $this->equipment_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->equipment_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['equipment_id'] = &$this->equipment_id;

        // tower_id
        $this->tower_id = new DbField(
            $this, // Table
            'x_tower_id', // Variable name
            'tower_id', // Name
            '"tower_id"', // Expression
            'CAST("tower_id" AS varchar(255))', // Basic search expression
            3, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"tower_id"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->tower_id->InputTextType = "text";
        $this->tower_id->Raw = true;
        $this->tower_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->tower_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['tower_id'] = &$this->tower_id;

        // model_id
        $this->model_id = new DbField(
            $this, // Table
            'x_model_id', // Variable name
            'model_id', // Name
            '"model_id"', // Expression
            'CAST("model_id" AS varchar(255))', // Basic search expression
            3, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"model_id"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->model_id->InputTextType = "text";
        $this->model_id->Raw = true;
        $this->model_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->model_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['model_id'] = &$this->model_id;

        // serial_number
        $this->serial_number = new DbField(
            $this, // Table
            'x_serial_number', // Variable name
            'serial_number', // Name
            '"serial_number"', // Expression
            '"serial_number"', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"serial_number"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->serial_number->InputTextType = "text";
        $this->serial_number->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['serial_number'] = &$this->serial_number;

        // installation_date
        $this->installation_date = new DbField(
            $this, // Table
            'x_installation_date', // Variable name
            'installation_date', // Name
            '"installation_date"', // Expression
            CastDateFieldForLike("\"installation_date\"", 0, "philtower_ams"), // Basic search expression
            133, // Type
            0, // Size
            0, // Date/Time format
            false, // Is upload field
            '"installation_date"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->installation_date->InputTextType = "text";
        $this->installation_date->Raw = true;
        $this->installation_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->installation_date->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['installation_date'] = &$this->installation_date;

        // warranty_expiry
        $this->warranty_expiry = new DbField(
            $this, // Table
            'x_warranty_expiry', // Variable name
            'warranty_expiry', // Name
            '"warranty_expiry"', // Expression
            CastDateFieldForLike("\"warranty_expiry\"", 0, "philtower_ams"), // Basic search expression
            133, // Type
            0, // Size
            0, // Date/Time format
            false, // Is upload field
            '"warranty_expiry"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->warranty_expiry->InputTextType = "text";
        $this->warranty_expiry->Raw = true;
        $this->warranty_expiry->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->warranty_expiry->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['warranty_expiry'] = &$this->warranty_expiry;

        // status_id
        $this->status_id = new DbField(
            $this, // Table
            'x_status_id', // Variable name
            'status_id', // Name
            '"status_id"', // Expression
            'CAST("status_id" AS varchar(255))', // Basic search expression
            3, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"status_id"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->status_id->InputTextType = "text";
        $this->status_id->Raw = true;
        $this->status_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->status_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['status_id'] = &$this->status_id;

        // last_maintenance
        $this->last_maintenance = new DbField(
            $this, // Table
            'x_last_maintenance', // Variable name
            'last_maintenance', // Name
            '"last_maintenance"', // Expression
            CastDateFieldForLike("\"last_maintenance\"", 0, "philtower_ams"), // Basic search expression
            133, // Type
            0, // Size
            0, // Date/Time format
            false, // Is upload field
            '"last_maintenance"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->last_maintenance->InputTextType = "text";
        $this->last_maintenance->Raw = true;
        $this->last_maintenance->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->last_maintenance->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['last_maintenance'] = &$this->last_maintenance;

        // next_maintenance
        $this->next_maintenance = new DbField(
            $this, // Table
            'x_next_maintenance', // Variable name
            'next_maintenance', // Name
            '"next_maintenance"', // Expression
            CastDateFieldForLike("\"next_maintenance\"", 0, "philtower_ams"), // Basic search expression
            133, // Type
            0, // Size
            0, // Date/Time format
            false, // Is upload field
            '"next_maintenance"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->next_maintenance->InputTextType = "text";
        $this->next_maintenance->Raw = true;
        $this->next_maintenance->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->next_maintenance->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['next_maintenance'] = &$this->next_maintenance;

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

        // installed_by
        $this->installed_by = new DbField(
            $this, // Table
            'x_installed_by', // Variable name
            'installed_by', // Name
            '"installed_by"', // Expression
            'CAST("installed_by" AS varchar(255))', // Basic search expression
            3, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"installed_by"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->installed_by->InputTextType = "text";
        $this->installed_by->Raw = true;
        $this->installed_by->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->installed_by->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['installed_by'] = &$this->installed_by;

        // created_by
        $this->created_by = new DbField(
            $this, // Table
            'x_created_by', // Variable name
            'created_by', // Name
            '"created_by"', // Expression
            'CAST("created_by" AS varchar(255))', // Basic search expression
            3, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"created_by"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->created_by->InputTextType = "text";
        $this->created_by->Raw = true;
        $this->created_by->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->created_by->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['created_by'] = &$this->created_by;

        // created_at
        $this->created_at = new DbField(
            $this, // Table
            'x_created_at', // Variable name
            'created_at', // Name
            '"created_at"', // Expression
            CastDateFieldForLike("\"created_at\"", 0, "philtower_ams"), // Basic search expression
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

        // updated_by
        $this->updated_by = new DbField(
            $this, // Table
            'x_updated_by', // Variable name
            'updated_by', // Name
            '"updated_by"', // Expression
            'CAST("updated_by" AS varchar(255))', // Basic search expression
            3, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"updated_by"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->updated_by->InputTextType = "text";
        $this->updated_by->Raw = true;
        $this->updated_by->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->updated_by->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['updated_by'] = &$this->updated_by;

        // updated_at
        $this->updated_at = new DbField(
            $this, // Table
            'x_updated_at', // Variable name
            'updated_at', // Name
            '"updated_at"', // Expression
            CastDateFieldForLike("\"updated_at\"", 0, "philtower_ams"), // Basic search expression
            135, // Type
            0, // Size
            0, // Date/Time format
            false, // Is upload field
            '"updated_at"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->updated_at->InputTextType = "text";
        $this->updated_at->Raw = true;
        $this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->updated_at->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['updated_at'] = &$this->updated_at;

        // is_active
        $this->is_active = new DbField(
            $this, // Table
            'x_is_active', // Variable name
            'is_active', // Name
            '"is_active"', // Expression
            'CAST("is_active" AS varchar(255))', // Basic search expression
            11, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"is_active"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'CHECKBOX' // Edit Tag
        );
        $this->is_active->InputTextType = "text";
        $this->is_active->Raw = true;
        $this->is_active->setDataType(DataType::BOOLEAN);
        $this->is_active->Lookup = new Lookup($this->is_active, 'tower_equipment', false, '', ["","","",""], '', '', [], [], [], [], [], [], false, '', '', "");
        $this->is_active->OptionCount = 2;
        $this->is_active->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['is_active'] = &$this->is_active;

        // notes
        $this->notes = new DbField(
            $this, // Table
            'x_notes', // Variable name
            'notes', // Name
            '"notes"', // Expression
            '"notes"', // Basic search expression
            201, // Type
            0, // Size
            -1, // Date/Time format
            false, // Is upload field
            '"notes"', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->notes->InputTextType = "text";
        $this->notes->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['notes'] = &$this->notes;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "tower_equipment";
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
                $queryBuilder->getSQL() . " RETURNING equipment_id",
                $queryBuilder->getParameters(),
                $queryBuilder->getParameterTypes()
            )->fetchOne();
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $result = false;
            $this->DbErrorMessage = $e->getMessage();
        }
        if ($result) {
            $this->equipment_id->setDbValue($result);
            $rs['equipment_id'] = $this->equipment_id->DbValue;
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
            if (!isset($rs['equipment_id']) && !EmptyValue($this->equipment_id->CurrentValue)) {
                $rs['equipment_id'] = $this->equipment_id->CurrentValue;
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
            if (array_key_exists('equipment_id', $rs)) {
                AddFilter($where, QuotedName('equipment_id', $this->Dbid) . '=' . QuotedValue($rs['equipment_id'], $this->equipment_id->DataType, $this->Dbid));
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
        $this->equipment_id->DbValue = $row['equipment_id'];
        $this->tower_id->DbValue = $row['tower_id'];
        $this->model_id->DbValue = $row['model_id'];
        $this->serial_number->DbValue = $row['serial_number'];
        $this->installation_date->DbValue = $row['installation_date'];
        $this->warranty_expiry->DbValue = $row['warranty_expiry'];
        $this->status_id->DbValue = $row['status_id'];
        $this->last_maintenance->DbValue = $row['last_maintenance'];
        $this->next_maintenance->DbValue = $row['next_maintenance'];
        $this->client_id->DbValue = $row['client_id'];
        $this->installed_by->DbValue = $row['installed_by'];
        $this->created_by->DbValue = $row['created_by'];
        $this->created_at->DbValue = $row['created_at'];
        $this->updated_by->DbValue = $row['updated_by'];
        $this->updated_at->DbValue = $row['updated_at'];
        $this->is_active->DbValue = (ConvertToBool($row['is_active']) ? "1" : "0");
        $this->notes->DbValue = $row['notes'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "\"equipment_id\" = @equipment_id@";
    }

    // Get Key
    public function getKey($current = false, $keySeparator = null)
    {
        $keys = [];
        $val = $current ? $this->equipment_id->CurrentValue : $this->equipment_id->OldValue;
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
                $this->equipment_id->CurrentValue = $keys[0];
            } else {
                $this->equipment_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null, $current = false)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('equipment_id', $row) ? $row['equipment_id'] : null;
        } else {
            $val = !EmptyValue($this->equipment_id->OldValue) && !$current ? $this->equipment_id->OldValue : $this->equipment_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@equipment_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("TowerEquipmentList");
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
            "TowerEquipmentView" => $Language->phrase("View"),
            "TowerEquipmentEdit" => $Language->phrase("Edit"),
            "TowerEquipmentAdd" => $Language->phrase("Add"),
            default => ""
        };
    }

    // Default route URL
    public function getDefaultRouteUrl()
    {
        return "TowerEquipmentList";
    }

    // API page name
    public function getApiPageName($action)
    {
        return match (strtolower($action)) {
            Config("API_VIEW_ACTION") => "TowerEquipmentView",
            Config("API_ADD_ACTION") => "TowerEquipmentAdd",
            Config("API_EDIT_ACTION") => "TowerEquipmentEdit",
            Config("API_DELETE_ACTION") => "TowerEquipmentDelete",
            Config("API_LIST_ACTION") => "TowerEquipmentList",
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
        return "TowerEquipmentList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("TowerEquipmentView", $parm);
        } else {
            $url = $this->keyUrl("TowerEquipmentView", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "TowerEquipmentAdd?" . $parm;
        } else {
            $url = "TowerEquipmentAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("TowerEquipmentEdit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("TowerEquipmentList", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("TowerEquipmentAdd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("TowerEquipmentList", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl($parm = "")
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("TowerEquipmentDelete", $parm);
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
        $json .= "\"equipment_id\":" . VarToJson($this->equipment_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->equipment_id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->equipment_id->CurrentValue);
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
            if (($keyValue = Param("equipment_id") ?? Route("equipment_id")) !== null) {
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
                $this->equipment_id->CurrentValue = $key;
            } else {
                $this->equipment_id->OldValue = $key;
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
        $this->equipment_id->setDbValue($row['equipment_id']);
        $this->tower_id->setDbValue($row['tower_id']);
        $this->model_id->setDbValue($row['model_id']);
        $this->serial_number->setDbValue($row['serial_number']);
        $this->installation_date->setDbValue($row['installation_date']);
        $this->warranty_expiry->setDbValue($row['warranty_expiry']);
        $this->status_id->setDbValue($row['status_id']);
        $this->last_maintenance->setDbValue($row['last_maintenance']);
        $this->next_maintenance->setDbValue($row['next_maintenance']);
        $this->client_id->setDbValue($row['client_id']);
        $this->installed_by->setDbValue($row['installed_by']);
        $this->created_by->setDbValue($row['created_by']);
        $this->created_at->setDbValue($row['created_at']);
        $this->updated_by->setDbValue($row['updated_by']);
        $this->updated_at->setDbValue($row['updated_at']);
        $this->is_active->setDbValue(ConvertToBool($row['is_active']) ? "1" : "0");
        $this->notes->setDbValue($row['notes']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "TowerEquipmentList";
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

        // equipment_id

        // tower_id

        // model_id

        // serial_number

        // installation_date

        // warranty_expiry

        // status_id

        // last_maintenance

        // next_maintenance

        // client_id

        // installed_by

        // created_by

        // created_at

        // updated_by

        // updated_at

        // is_active

        // notes

        // equipment_id
        $this->equipment_id->ViewValue = $this->equipment_id->CurrentValue;

        // tower_id
        $this->tower_id->ViewValue = $this->tower_id->CurrentValue;
        $this->tower_id->ViewValue = FormatNumber($this->tower_id->ViewValue, $this->tower_id->formatPattern());

        // model_id
        $this->model_id->ViewValue = $this->model_id->CurrentValue;
        $this->model_id->ViewValue = FormatNumber($this->model_id->ViewValue, $this->model_id->formatPattern());

        // serial_number
        $this->serial_number->ViewValue = $this->serial_number->CurrentValue;

        // installation_date
        $this->installation_date->ViewValue = $this->installation_date->CurrentValue;
        $this->installation_date->ViewValue = FormatDateTime($this->installation_date->ViewValue, $this->installation_date->formatPattern());

        // warranty_expiry
        $this->warranty_expiry->ViewValue = $this->warranty_expiry->CurrentValue;
        $this->warranty_expiry->ViewValue = FormatDateTime($this->warranty_expiry->ViewValue, $this->warranty_expiry->formatPattern());

        // status_id
        $this->status_id->ViewValue = $this->status_id->CurrentValue;
        $this->status_id->ViewValue = FormatNumber($this->status_id->ViewValue, $this->status_id->formatPattern());

        // last_maintenance
        $this->last_maintenance->ViewValue = $this->last_maintenance->CurrentValue;
        $this->last_maintenance->ViewValue = FormatDateTime($this->last_maintenance->ViewValue, $this->last_maintenance->formatPattern());

        // next_maintenance
        $this->next_maintenance->ViewValue = $this->next_maintenance->CurrentValue;
        $this->next_maintenance->ViewValue = FormatDateTime($this->next_maintenance->ViewValue, $this->next_maintenance->formatPattern());

        // client_id
        $this->client_id->ViewValue = $this->client_id->CurrentValue;
        $this->client_id->ViewValue = FormatNumber($this->client_id->ViewValue, $this->client_id->formatPattern());

        // installed_by
        $this->installed_by->ViewValue = $this->installed_by->CurrentValue;
        $this->installed_by->ViewValue = FormatNumber($this->installed_by->ViewValue, $this->installed_by->formatPattern());

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

        // is_active
        if (ConvertToBool($this->is_active->CurrentValue)) {
            $this->is_active->ViewValue = $this->is_active->tagCaption(1) != "" ? $this->is_active->tagCaption(1) : "Yes";
        } else {
            $this->is_active->ViewValue = $this->is_active->tagCaption(2) != "" ? $this->is_active->tagCaption(2) : "No";
        }

        // notes
        $this->notes->ViewValue = $this->notes->CurrentValue;

        // equipment_id
        $this->equipment_id->HrefValue = "";
        $this->equipment_id->TooltipValue = "";

        // tower_id
        $this->tower_id->HrefValue = "";
        $this->tower_id->TooltipValue = "";

        // model_id
        $this->model_id->HrefValue = "";
        $this->model_id->TooltipValue = "";

        // serial_number
        $this->serial_number->HrefValue = "";
        $this->serial_number->TooltipValue = "";

        // installation_date
        $this->installation_date->HrefValue = "";
        $this->installation_date->TooltipValue = "";

        // warranty_expiry
        $this->warranty_expiry->HrefValue = "";
        $this->warranty_expiry->TooltipValue = "";

        // status_id
        $this->status_id->HrefValue = "";
        $this->status_id->TooltipValue = "";

        // last_maintenance
        $this->last_maintenance->HrefValue = "";
        $this->last_maintenance->TooltipValue = "";

        // next_maintenance
        $this->next_maintenance->HrefValue = "";
        $this->next_maintenance->TooltipValue = "";

        // client_id
        $this->client_id->HrefValue = "";
        $this->client_id->TooltipValue = "";

        // installed_by
        $this->installed_by->HrefValue = "";
        $this->installed_by->TooltipValue = "";

        // created_by
        $this->created_by->HrefValue = "";
        $this->created_by->TooltipValue = "";

        // created_at
        $this->created_at->HrefValue = "";
        $this->created_at->TooltipValue = "";

        // updated_by
        $this->updated_by->HrefValue = "";
        $this->updated_by->TooltipValue = "";

        // updated_at
        $this->updated_at->HrefValue = "";
        $this->updated_at->TooltipValue = "";

        // is_active
        $this->is_active->HrefValue = "";
        $this->is_active->TooltipValue = "";

        // notes
        $this->notes->HrefValue = "";
        $this->notes->TooltipValue = "";

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

        // equipment_id
        $this->equipment_id->setupEditAttributes();
        $this->equipment_id->EditValue = $this->equipment_id->CurrentValue;

        // tower_id
        $this->tower_id->setupEditAttributes();
        $this->tower_id->EditValue = $this->tower_id->CurrentValue;
        $this->tower_id->PlaceHolder = RemoveHtml($this->tower_id->caption());
        if (strval($this->tower_id->EditValue) != "" && is_numeric($this->tower_id->EditValue)) {
            $this->tower_id->EditValue = FormatNumber($this->tower_id->EditValue, null);
        }

        // model_id
        $this->model_id->setupEditAttributes();
        $this->model_id->EditValue = $this->model_id->CurrentValue;
        $this->model_id->PlaceHolder = RemoveHtml($this->model_id->caption());
        if (strval($this->model_id->EditValue) != "" && is_numeric($this->model_id->EditValue)) {
            $this->model_id->EditValue = FormatNumber($this->model_id->EditValue, null);
        }

        // serial_number
        $this->serial_number->setupEditAttributes();
        if (!$this->serial_number->Raw) {
            $this->serial_number->CurrentValue = HtmlDecode($this->serial_number->CurrentValue);
        }
        $this->serial_number->EditValue = $this->serial_number->CurrentValue;
        $this->serial_number->PlaceHolder = RemoveHtml($this->serial_number->caption());

        // installation_date
        $this->installation_date->setupEditAttributes();
        $this->installation_date->EditValue = FormatDateTime($this->installation_date->CurrentValue, $this->installation_date->formatPattern());
        $this->installation_date->PlaceHolder = RemoveHtml($this->installation_date->caption());

        // warranty_expiry
        $this->warranty_expiry->setupEditAttributes();
        $this->warranty_expiry->EditValue = FormatDateTime($this->warranty_expiry->CurrentValue, $this->warranty_expiry->formatPattern());
        $this->warranty_expiry->PlaceHolder = RemoveHtml($this->warranty_expiry->caption());

        // status_id
        $this->status_id->setupEditAttributes();
        $this->status_id->EditValue = $this->status_id->CurrentValue;
        $this->status_id->PlaceHolder = RemoveHtml($this->status_id->caption());
        if (strval($this->status_id->EditValue) != "" && is_numeric($this->status_id->EditValue)) {
            $this->status_id->EditValue = FormatNumber($this->status_id->EditValue, null);
        }

        // last_maintenance
        $this->last_maintenance->setupEditAttributes();
        $this->last_maintenance->EditValue = FormatDateTime($this->last_maintenance->CurrentValue, $this->last_maintenance->formatPattern());
        $this->last_maintenance->PlaceHolder = RemoveHtml($this->last_maintenance->caption());

        // next_maintenance
        $this->next_maintenance->setupEditAttributes();
        $this->next_maintenance->EditValue = FormatDateTime($this->next_maintenance->CurrentValue, $this->next_maintenance->formatPattern());
        $this->next_maintenance->PlaceHolder = RemoveHtml($this->next_maintenance->caption());

        // client_id
        $this->client_id->setupEditAttributes();
        $this->client_id->EditValue = $this->client_id->CurrentValue;
        $this->client_id->PlaceHolder = RemoveHtml($this->client_id->caption());
        if (strval($this->client_id->EditValue) != "" && is_numeric($this->client_id->EditValue)) {
            $this->client_id->EditValue = FormatNumber($this->client_id->EditValue, null);
        }

        // installed_by
        $this->installed_by->setupEditAttributes();
        $this->installed_by->EditValue = $this->installed_by->CurrentValue;
        $this->installed_by->PlaceHolder = RemoveHtml($this->installed_by->caption());
        if (strval($this->installed_by->EditValue) != "" && is_numeric($this->installed_by->EditValue)) {
            $this->installed_by->EditValue = FormatNumber($this->installed_by->EditValue, null);
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
        $this->created_at->EditValue = FormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
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
        $this->updated_at->EditValue = FormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
        $this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

        // is_active
        $this->is_active->EditValue = $this->is_active->options(false);
        $this->is_active->PlaceHolder = RemoveHtml($this->is_active->caption());

        // notes
        $this->notes->setupEditAttributes();
        $this->notes->EditValue = $this->notes->CurrentValue;
        $this->notes->PlaceHolder = RemoveHtml($this->notes->caption());

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
                    $doc->exportCaption($this->equipment_id);
                    $doc->exportCaption($this->tower_id);
                    $doc->exportCaption($this->model_id);
                    $doc->exportCaption($this->serial_number);
                    $doc->exportCaption($this->installation_date);
                    $doc->exportCaption($this->warranty_expiry);
                    $doc->exportCaption($this->status_id);
                    $doc->exportCaption($this->last_maintenance);
                    $doc->exportCaption($this->next_maintenance);
                    $doc->exportCaption($this->client_id);
                    $doc->exportCaption($this->installed_by);
                    $doc->exportCaption($this->created_by);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_by);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->is_active);
                    $doc->exportCaption($this->notes);
                } else {
                    $doc->exportCaption($this->equipment_id);
                    $doc->exportCaption($this->tower_id);
                    $doc->exportCaption($this->model_id);
                    $doc->exportCaption($this->serial_number);
                    $doc->exportCaption($this->installation_date);
                    $doc->exportCaption($this->warranty_expiry);
                    $doc->exportCaption($this->status_id);
                    $doc->exportCaption($this->last_maintenance);
                    $doc->exportCaption($this->next_maintenance);
                    $doc->exportCaption($this->client_id);
                    $doc->exportCaption($this->installed_by);
                    $doc->exportCaption($this->created_by);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_by);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->is_active);
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
                        $doc->exportField($this->equipment_id);
                        $doc->exportField($this->tower_id);
                        $doc->exportField($this->model_id);
                        $doc->exportField($this->serial_number);
                        $doc->exportField($this->installation_date);
                        $doc->exportField($this->warranty_expiry);
                        $doc->exportField($this->status_id);
                        $doc->exportField($this->last_maintenance);
                        $doc->exportField($this->next_maintenance);
                        $doc->exportField($this->client_id);
                        $doc->exportField($this->installed_by);
                        $doc->exportField($this->created_by);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_by);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->is_active);
                        $doc->exportField($this->notes);
                    } else {
                        $doc->exportField($this->equipment_id);
                        $doc->exportField($this->tower_id);
                        $doc->exportField($this->model_id);
                        $doc->exportField($this->serial_number);
                        $doc->exportField($this->installation_date);
                        $doc->exportField($this->warranty_expiry);
                        $doc->exportField($this->status_id);
                        $doc->exportField($this->last_maintenance);
                        $doc->exportField($this->next_maintenance);
                        $doc->exportField($this->client_id);
                        $doc->exportField($this->installed_by);
                        $doc->exportField($this->created_by);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_by);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->is_active);
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
