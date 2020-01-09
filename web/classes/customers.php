<?php namespace PHPMaker2020\project1; ?>
<?php

/**
 * Table class for customers
 */
class customers extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $customer_Id;
	public $customer_firstname;
	public $customer_lastname;
	public $customer_addresslineone;
	public $customer_addresslinetwo;
	public $customer_city;
	public $customer_postcode;
	public $customer_email;
	public $customer_username;
	public $customer_password;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'customers';
		$this->TableName = 'customers';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`customers`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// customer_Id
		$this->customer_Id = new DbField('customers', 'customers', 'x_customer_Id', 'customer_Id', '`customer_Id`', '`customer_Id`', 3, 8, -1, FALSE, '`customer_Id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->customer_Id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->customer_Id->IsPrimaryKey = TRUE; // Primary key field
		$this->customer_Id->Sortable = TRUE; // Allow sort
		$this->customer_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['customer_Id'] = &$this->customer_Id;

		// customer_firstname
		$this->customer_firstname = new DbField('customers', 'customers', 'x_customer_firstname', 'customer_firstname', '`customer_firstname`', '`customer_firstname`', 200, 40, -1, FALSE, '`customer_firstname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_firstname->Nullable = FALSE; // NOT NULL field
		$this->customer_firstname->Required = TRUE; // Required field
		$this->customer_firstname->Sortable = TRUE; // Allow sort
		$this->fields['customer_firstname'] = &$this->customer_firstname;

		// customer_lastname
		$this->customer_lastname = new DbField('customers', 'customers', 'x_customer_lastname', 'customer_lastname', '`customer_lastname`', '`customer_lastname`', 200, 40, -1, FALSE, '`customer_lastname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_lastname->Nullable = FALSE; // NOT NULL field
		$this->customer_lastname->Required = TRUE; // Required field
		$this->customer_lastname->Sortable = TRUE; // Allow sort
		$this->fields['customer_lastname'] = &$this->customer_lastname;

		// customer_addresslineone
		$this->customer_addresslineone = new DbField('customers', 'customers', 'x_customer_addresslineone', 'customer_addresslineone', '`customer_addresslineone`', '`customer_addresslineone`', 200, 80, -1, FALSE, '`customer_addresslineone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_addresslineone->Nullable = FALSE; // NOT NULL field
		$this->customer_addresslineone->Required = TRUE; // Required field
		$this->customer_addresslineone->Sortable = TRUE; // Allow sort
		$this->fields['customer_addresslineone'] = &$this->customer_addresslineone;

		// customer_addresslinetwo
		$this->customer_addresslinetwo = new DbField('customers', 'customers', 'x_customer_addresslinetwo', 'customer_addresslinetwo', '`customer_addresslinetwo`', '`customer_addresslinetwo`', 200, 80, -1, FALSE, '`customer_addresslinetwo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_addresslinetwo->Sortable = TRUE; // Allow sort
		$this->fields['customer_addresslinetwo'] = &$this->customer_addresslinetwo;

		// customer_city
		$this->customer_city = new DbField('customers', 'customers', 'x_customer_city', 'customer_city', '`customer_city`', '`customer_city`', 200, 30, -1, FALSE, '`customer_city`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_city->Nullable = FALSE; // NOT NULL field
		$this->customer_city->Required = TRUE; // Required field
		$this->customer_city->Sortable = TRUE; // Allow sort
		$this->fields['customer_city'] = &$this->customer_city;

		// customer_postcode
		$this->customer_postcode = new DbField('customers', 'customers', 'x_customer_postcode', 'customer_postcode', '`customer_postcode`', '`customer_postcode`', 200, 10, -1, FALSE, '`customer_postcode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_postcode->Nullable = FALSE; // NOT NULL field
		$this->customer_postcode->Required = TRUE; // Required field
		$this->customer_postcode->Sortable = TRUE; // Allow sort
		$this->fields['customer_postcode'] = &$this->customer_postcode;

		// customer_email
		$this->customer_email = new DbField('customers', 'customers', 'x_customer_email', 'customer_email', '`customer_email`', '`customer_email`', 200, 80, -1, FALSE, '`customer_email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_email->Nullable = FALSE; // NOT NULL field
		$this->customer_email->Required = TRUE; // Required field
		$this->customer_email->Sortable = TRUE; // Allow sort
		$this->fields['customer_email'] = &$this->customer_email;

		// customer_username
		$this->customer_username = new DbField('customers', 'customers', 'x_customer_username', 'customer_username', '`customer_username`', '`customer_username`', 200, 20, -1, FALSE, '`customer_username`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_username->Nullable = FALSE; // NOT NULL field
		$this->customer_username->Required = TRUE; // Required field
		$this->customer_username->Sortable = TRUE; // Allow sort
		$this->fields['customer_username'] = &$this->customer_username;

		// customer_password
		$this->customer_password = new DbField('customers', 'customers', 'x_customer_password', 'customer_password', '`customer_password`', '`customer_password`', 200, 20, -1, FALSE, '`customer_password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->customer_password->Nullable = FALSE; // NOT NULL field
		$this->customer_password->Required = TRUE; // Required field
		$this->customer_password->Sortable = TRUE; // Allow sort
		$this->fields['customer_password'] = &$this->customer_password;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
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
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`customers`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = Config("USER_ID_ALLOW");
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
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
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->customer_Id->setDbValue($conn->insert_ID());
			$rs['customer_Id'] = $this->customer_Id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('customer_Id', $rs))
				AddFilter($where, QuotedName('customer_Id', $this->Dbid) . '=' . QuotedValue($rs['customer_Id'], $this->customer_Id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->customer_Id->DbValue = $row['customer_Id'];
		$this->customer_firstname->DbValue = $row['customer_firstname'];
		$this->customer_lastname->DbValue = $row['customer_lastname'];
		$this->customer_addresslineone->DbValue = $row['customer_addresslineone'];
		$this->customer_addresslinetwo->DbValue = $row['customer_addresslinetwo'];
		$this->customer_city->DbValue = $row['customer_city'];
		$this->customer_postcode->DbValue = $row['customer_postcode'];
		$this->customer_email->DbValue = $row['customer_email'];
		$this->customer_username->DbValue = $row['customer_username'];
		$this->customer_password->DbValue = $row['customer_password'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`customer_Id` = @customer_Id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('customer_Id', $row) ? $row['customer_Id'] : NULL;
		else
			$val = $this->customer_Id->OldValue !== NULL ? $this->customer_Id->OldValue : $this->customer_Id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@customer_Id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "customerslist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "customersview.php")
			return $Language->phrase("View");
		elseif ($pageName == "customersedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "customersadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "customerslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("customersview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("customersview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "customersadd.php?" . $this->getUrlParm($parm);
		else
			$url = "customersadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("customersedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("customersadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("customersdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "customer_Id:" . JsonEncode($this->customer_Id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->customer_Id->CurrentValue != NULL) {
			$url .= "customer_Id=" . urlencode($this->customer_Id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("customer_Id") !== NULL)
				$arKeys[] = Param("customer_Id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->customer_Id->CurrentValue = $key;
			else
				$this->customer_Id->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->customer_Id->setDbValue($rs->fields('customer_Id'));
		$this->customer_firstname->setDbValue($rs->fields('customer_firstname'));
		$this->customer_lastname->setDbValue($rs->fields('customer_lastname'));
		$this->customer_addresslineone->setDbValue($rs->fields('customer_addresslineone'));
		$this->customer_addresslinetwo->setDbValue($rs->fields('customer_addresslinetwo'));
		$this->customer_city->setDbValue($rs->fields('customer_city'));
		$this->customer_postcode->setDbValue($rs->fields('customer_postcode'));
		$this->customer_email->setDbValue($rs->fields('customer_email'));
		$this->customer_username->setDbValue($rs->fields('customer_username'));
		$this->customer_password->setDbValue($rs->fields('customer_password'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// customer_Id
		// customer_firstname
		// customer_lastname
		// customer_addresslineone
		// customer_addresslinetwo
		// customer_city
		// customer_postcode
		// customer_email
		// customer_username
		// customer_password
		// customer_Id

		$this->customer_Id->ViewValue = $this->customer_Id->CurrentValue;
		$this->customer_Id->ViewCustomAttributes = "";

		// customer_firstname
		$this->customer_firstname->ViewValue = $this->customer_firstname->CurrentValue;
		$this->customer_firstname->ViewCustomAttributes = "";

		// customer_lastname
		$this->customer_lastname->ViewValue = $this->customer_lastname->CurrentValue;
		$this->customer_lastname->ViewCustomAttributes = "";

		// customer_addresslineone
		$this->customer_addresslineone->ViewValue = $this->customer_addresslineone->CurrentValue;
		$this->customer_addresslineone->ViewCustomAttributes = "";

		// customer_addresslinetwo
		$this->customer_addresslinetwo->ViewValue = $this->customer_addresslinetwo->CurrentValue;
		$this->customer_addresslinetwo->ViewCustomAttributes = "";

		// customer_city
		$this->customer_city->ViewValue = $this->customer_city->CurrentValue;
		$this->customer_city->ViewCustomAttributes = "";

		// customer_postcode
		$this->customer_postcode->ViewValue = $this->customer_postcode->CurrentValue;
		$this->customer_postcode->ViewCustomAttributes = "";

		// customer_email
		$this->customer_email->ViewValue = $this->customer_email->CurrentValue;
		$this->customer_email->ViewCustomAttributes = "";

		// customer_username
		$this->customer_username->ViewValue = $this->customer_username->CurrentValue;
		$this->customer_username->ViewCustomAttributes = "";

		// customer_password
		$this->customer_password->ViewValue = $this->customer_password->CurrentValue;
		$this->customer_password->ViewCustomAttributes = "";

		// customer_Id
		$this->customer_Id->LinkCustomAttributes = "";
		$this->customer_Id->HrefValue = "";
		$this->customer_Id->TooltipValue = "";

		// customer_firstname
		$this->customer_firstname->LinkCustomAttributes = "";
		$this->customer_firstname->HrefValue = "";
		$this->customer_firstname->TooltipValue = "";

		// customer_lastname
		$this->customer_lastname->LinkCustomAttributes = "";
		$this->customer_lastname->HrefValue = "";
		$this->customer_lastname->TooltipValue = "";

		// customer_addresslineone
		$this->customer_addresslineone->LinkCustomAttributes = "";
		$this->customer_addresslineone->HrefValue = "";
		$this->customer_addresslineone->TooltipValue = "";

		// customer_addresslinetwo
		$this->customer_addresslinetwo->LinkCustomAttributes = "";
		$this->customer_addresslinetwo->HrefValue = "";
		$this->customer_addresslinetwo->TooltipValue = "";

		// customer_city
		$this->customer_city->LinkCustomAttributes = "";
		$this->customer_city->HrefValue = "";
		$this->customer_city->TooltipValue = "";

		// customer_postcode
		$this->customer_postcode->LinkCustomAttributes = "";
		$this->customer_postcode->HrefValue = "";
		$this->customer_postcode->TooltipValue = "";

		// customer_email
		$this->customer_email->LinkCustomAttributes = "";
		$this->customer_email->HrefValue = "";
		$this->customer_email->TooltipValue = "";

		// customer_username
		$this->customer_username->LinkCustomAttributes = "";
		$this->customer_username->HrefValue = "";
		$this->customer_username->TooltipValue = "";

		// customer_password
		$this->customer_password->LinkCustomAttributes = "";
		$this->customer_password->HrefValue = "";
		$this->customer_password->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// customer_Id
		$this->customer_Id->EditAttrs["class"] = "form-control";
		$this->customer_Id->EditCustomAttributes = "";
		$this->customer_Id->EditValue = $this->customer_Id->CurrentValue;
		$this->customer_Id->ViewCustomAttributes = "";

		// customer_firstname
		$this->customer_firstname->EditAttrs["class"] = "form-control";
		$this->customer_firstname->EditCustomAttributes = "";
		if (!$this->customer_firstname->Raw)
			$this->customer_firstname->CurrentValue = HtmlDecode($this->customer_firstname->CurrentValue);
		$this->customer_firstname->EditValue = $this->customer_firstname->CurrentValue;
		$this->customer_firstname->PlaceHolder = RemoveHtml($this->customer_firstname->caption());

		// customer_lastname
		$this->customer_lastname->EditAttrs["class"] = "form-control";
		$this->customer_lastname->EditCustomAttributes = "";
		if (!$this->customer_lastname->Raw)
			$this->customer_lastname->CurrentValue = HtmlDecode($this->customer_lastname->CurrentValue);
		$this->customer_lastname->EditValue = $this->customer_lastname->CurrentValue;
		$this->customer_lastname->PlaceHolder = RemoveHtml($this->customer_lastname->caption());

		// customer_addresslineone
		$this->customer_addresslineone->EditAttrs["class"] = "form-control";
		$this->customer_addresslineone->EditCustomAttributes = "";
		if (!$this->customer_addresslineone->Raw)
			$this->customer_addresslineone->CurrentValue = HtmlDecode($this->customer_addresslineone->CurrentValue);
		$this->customer_addresslineone->EditValue = $this->customer_addresslineone->CurrentValue;
		$this->customer_addresslineone->PlaceHolder = RemoveHtml($this->customer_addresslineone->caption());

		// customer_addresslinetwo
		$this->customer_addresslinetwo->EditAttrs["class"] = "form-control";
		$this->customer_addresslinetwo->EditCustomAttributes = "";
		if (!$this->customer_addresslinetwo->Raw)
			$this->customer_addresslinetwo->CurrentValue = HtmlDecode($this->customer_addresslinetwo->CurrentValue);
		$this->customer_addresslinetwo->EditValue = $this->customer_addresslinetwo->CurrentValue;
		$this->customer_addresslinetwo->PlaceHolder = RemoveHtml($this->customer_addresslinetwo->caption());

		// customer_city
		$this->customer_city->EditAttrs["class"] = "form-control";
		$this->customer_city->EditCustomAttributes = "";
		if (!$this->customer_city->Raw)
			$this->customer_city->CurrentValue = HtmlDecode($this->customer_city->CurrentValue);
		$this->customer_city->EditValue = $this->customer_city->CurrentValue;
		$this->customer_city->PlaceHolder = RemoveHtml($this->customer_city->caption());

		// customer_postcode
		$this->customer_postcode->EditAttrs["class"] = "form-control";
		$this->customer_postcode->EditCustomAttributes = "";
		if (!$this->customer_postcode->Raw)
			$this->customer_postcode->CurrentValue = HtmlDecode($this->customer_postcode->CurrentValue);
		$this->customer_postcode->EditValue = $this->customer_postcode->CurrentValue;
		$this->customer_postcode->PlaceHolder = RemoveHtml($this->customer_postcode->caption());

		// customer_email
		$this->customer_email->EditAttrs["class"] = "form-control";
		$this->customer_email->EditCustomAttributes = "";
		if (!$this->customer_email->Raw)
			$this->customer_email->CurrentValue = HtmlDecode($this->customer_email->CurrentValue);
		$this->customer_email->EditValue = $this->customer_email->CurrentValue;
		$this->customer_email->PlaceHolder = RemoveHtml($this->customer_email->caption());

		// customer_username
		$this->customer_username->EditAttrs["class"] = "form-control";
		$this->customer_username->EditCustomAttributes = "";
		if (!$this->customer_username->Raw)
			$this->customer_username->CurrentValue = HtmlDecode($this->customer_username->CurrentValue);
		$this->customer_username->EditValue = $this->customer_username->CurrentValue;
		$this->customer_username->PlaceHolder = RemoveHtml($this->customer_username->caption());

		// customer_password
		$this->customer_password->EditAttrs["class"] = "form-control";
		$this->customer_password->EditCustomAttributes = "";
		if (!$this->customer_password->Raw)
			$this->customer_password->CurrentValue = HtmlDecode($this->customer_password->CurrentValue);
		$this->customer_password->EditValue = $this->customer_password->CurrentValue;
		$this->customer_password->PlaceHolder = RemoveHtml($this->customer_password->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->customer_Id);
					$doc->exportCaption($this->customer_firstname);
					$doc->exportCaption($this->customer_lastname);
					$doc->exportCaption($this->customer_addresslineone);
					$doc->exportCaption($this->customer_addresslinetwo);
					$doc->exportCaption($this->customer_city);
					$doc->exportCaption($this->customer_postcode);
					$doc->exportCaption($this->customer_email);
					$doc->exportCaption($this->customer_username);
					$doc->exportCaption($this->customer_password);
				} else {
					$doc->exportCaption($this->customer_Id);
					$doc->exportCaption($this->customer_firstname);
					$doc->exportCaption($this->customer_lastname);
					$doc->exportCaption($this->customer_addresslineone);
					$doc->exportCaption($this->customer_addresslinetwo);
					$doc->exportCaption($this->customer_city);
					$doc->exportCaption($this->customer_postcode);
					$doc->exportCaption($this->customer_email);
					$doc->exportCaption($this->customer_username);
					$doc->exportCaption($this->customer_password);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->customer_Id);
						$doc->exportField($this->customer_firstname);
						$doc->exportField($this->customer_lastname);
						$doc->exportField($this->customer_addresslineone);
						$doc->exportField($this->customer_addresslinetwo);
						$doc->exportField($this->customer_city);
						$doc->exportField($this->customer_postcode);
						$doc->exportField($this->customer_email);
						$doc->exportField($this->customer_username);
						$doc->exportField($this->customer_password);
					} else {
						$doc->exportField($this->customer_Id);
						$doc->exportField($this->customer_firstname);
						$doc->exportField($this->customer_lastname);
						$doc->exportField($this->customer_addresslineone);
						$doc->exportField($this->customer_addresslinetwo);
						$doc->exportField($this->customer_city);
						$doc->exportField($this->customer_postcode);
						$doc->exportField($this->customer_email);
						$doc->exportField($this->customer_username);
						$doc->exportField($this->customer_password);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>