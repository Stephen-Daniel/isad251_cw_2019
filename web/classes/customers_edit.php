<?php
namespace PHPMaker2020\project1;

/**
 * Page class
 */
class customers_edit extends customers
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{B0D90454-D781-4E44-832A-8439DCD087B1}";

	// Table name
	public $TableName = 'customers';

	// Page object name
	public $PageObjName = "customers_edit";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (customers)
		if (!isset($GLOBALS["customers"]) || get_class($GLOBALS["customers"]) == PROJECT_NAMESPACE . "customers") {
			$GLOBALS["customers"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["customers"];
		}

		// Table object (admin)
		if (!isset($GLOBALS['admin']))
			$GLOBALS['admin'] = new admin();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'customers');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (admin)
		$UserTable = $UserTable ?: new admin();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $customers;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($customers);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "customersview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
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
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
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
			$key .= @$ar['customer_Id'];
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
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->customer_Id->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!$this->setupApiRequest())
			return FALSE;

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API request
	public function setupApiRequest()
	{
		global $Security;

		// Check security for API request
		If (ValidApiRequest()) {
			if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
			if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
			return TRUE;
		}
		return FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (!$this->setupApiRequest()) {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("customerslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->customer_Id->setVisibility();
		$this->customer_firstname->setVisibility();
		$this->customer_lastname->setVisibility();
		$this->customer_addresslineone->setVisibility();
		$this->customer_addresslinetwo->setVisibility();
		$this->customer_city->setVisibility();
		$this->customer_postcode->setVisibility();
		$this->customer_email->setVisibility();
		$this->customer_username->setVisibility();
		$this->customer_password->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_customer_Id")) {
				$this->customer_Id->setFormValue($CurrentForm->getValue("x_customer_Id"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("customer_Id") !== NULL) {
				$this->customer_Id->setQueryStringValue(Get("customer_Id"));
				$loadByQuery = TRUE;
			} else {
				$this->customer_Id->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->loadRow();

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
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
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("customerslist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "customerslist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
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

		// Check field name 'customer_Id' first before field var 'x_customer_Id'
		$val = $CurrentForm->hasValue("customer_Id") ? $CurrentForm->getValue("customer_Id") : $CurrentForm->getValue("x_customer_Id");
		if (!$this->customer_Id->IsDetailKey)
			$this->customer_Id->setFormValue($val);

		// Check field name 'customer_firstname' first before field var 'x_customer_firstname'
		$val = $CurrentForm->hasValue("customer_firstname") ? $CurrentForm->getValue("customer_firstname") : $CurrentForm->getValue("x_customer_firstname");
		if (!$this->customer_firstname->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->customer_firstname->Visible = FALSE; // Disable update for API request
			else
				$this->customer_firstname->setFormValue($val);
		}

		// Check field name 'customer_lastname' first before field var 'x_customer_lastname'
		$val = $CurrentForm->hasValue("customer_lastname") ? $CurrentForm->getValue("customer_lastname") : $CurrentForm->getValue("x_customer_lastname");
		if (!$this->customer_lastname->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->customer_lastname->Visible = FALSE; // Disable update for API request
			else
				$this->customer_lastname->setFormValue($val);
		}

		// Check field name 'customer_addresslineone' first before field var 'x_customer_addresslineone'
		$val = $CurrentForm->hasValue("customer_addresslineone") ? $CurrentForm->getValue("customer_addresslineone") : $CurrentForm->getValue("x_customer_addresslineone");
		if (!$this->customer_addresslineone->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->customer_addresslineone->Visible = FALSE; // Disable update for API request
			else
				$this->customer_addresslineone->setFormValue($val);
		}

		// Check field name 'customer_addresslinetwo' first before field var 'x_customer_addresslinetwo'
		$val = $CurrentForm->hasValue("customer_addresslinetwo") ? $CurrentForm->getValue("customer_addresslinetwo") : $CurrentForm->getValue("x_customer_addresslinetwo");
		if (!$this->customer_addresslinetwo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->customer_addresslinetwo->Visible = FALSE; // Disable update for API request
			else
				$this->customer_addresslinetwo->setFormValue($val);
		}

		// Check field name 'customer_city' first before field var 'x_customer_city'
		$val = $CurrentForm->hasValue("customer_city") ? $CurrentForm->getValue("customer_city") : $CurrentForm->getValue("x_customer_city");
		if (!$this->customer_city->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->customer_city->Visible = FALSE; // Disable update for API request
			else
				$this->customer_city->setFormValue($val);
		}

		// Check field name 'customer_postcode' first before field var 'x_customer_postcode'
		$val = $CurrentForm->hasValue("customer_postcode") ? $CurrentForm->getValue("customer_postcode") : $CurrentForm->getValue("x_customer_postcode");
		if (!$this->customer_postcode->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->customer_postcode->Visible = FALSE; // Disable update for API request
			else
				$this->customer_postcode->setFormValue($val);
		}

		// Check field name 'customer_email' first before field var 'x_customer_email'
		$val = $CurrentForm->hasValue("customer_email") ? $CurrentForm->getValue("customer_email") : $CurrentForm->getValue("x_customer_email");
		if (!$this->customer_email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->customer_email->Visible = FALSE; // Disable update for API request
			else
				$this->customer_email->setFormValue($val);
		}

		// Check field name 'customer_username' first before field var 'x_customer_username'
		$val = $CurrentForm->hasValue("customer_username") ? $CurrentForm->getValue("customer_username") : $CurrentForm->getValue("x_customer_username");
		if (!$this->customer_username->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->customer_username->Visible = FALSE; // Disable update for API request
			else
				$this->customer_username->setFormValue($val);
		}

		// Check field name 'customer_password' first before field var 'x_customer_password'
		$val = $CurrentForm->hasValue("customer_password") ? $CurrentForm->getValue("customer_password") : $CurrentForm->getValue("x_customer_password");
		if (!$this->customer_password->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->customer_password->Visible = FALSE; // Disable update for API request
			else
				$this->customer_password->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->customer_Id->CurrentValue = $this->customer_Id->FormValue;
		$this->customer_firstname->CurrentValue = $this->customer_firstname->FormValue;
		$this->customer_lastname->CurrentValue = $this->customer_lastname->FormValue;
		$this->customer_addresslineone->CurrentValue = $this->customer_addresslineone->FormValue;
		$this->customer_addresslinetwo->CurrentValue = $this->customer_addresslinetwo->FormValue;
		$this->customer_city->CurrentValue = $this->customer_city->FormValue;
		$this->customer_postcode->CurrentValue = $this->customer_postcode->FormValue;
		$this->customer_email->CurrentValue = $this->customer_email->FormValue;
		$this->customer_username->CurrentValue = $this->customer_username->FormValue;
		$this->customer_password->CurrentValue = $this->customer_password->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->customer_Id->setDbValue($row['customer_Id']);
		$this->customer_firstname->setDbValue($row['customer_firstname']);
		$this->customer_lastname->setDbValue($row['customer_lastname']);
		$this->customer_addresslineone->setDbValue($row['customer_addresslineone']);
		$this->customer_addresslinetwo->setDbValue($row['customer_addresslinetwo']);
		$this->customer_city->setDbValue($row['customer_city']);
		$this->customer_postcode->setDbValue($row['customer_postcode']);
		$this->customer_email->setDbValue($row['customer_email']);
		$this->customer_username->setDbValue($row['customer_username']);
		$this->customer_password->setDbValue($row['customer_password']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['customer_Id'] = NULL;
		$row['customer_firstname'] = NULL;
		$row['customer_lastname'] = NULL;
		$row['customer_addresslineone'] = NULL;
		$row['customer_addresslinetwo'] = NULL;
		$row['customer_city'] = NULL;
		$row['customer_postcode'] = NULL;
		$row['customer_email'] = NULL;
		$row['customer_username'] = NULL;
		$row['customer_password'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("customer_Id")) != "")
			$this->customer_Id->OldValue = $this->getKey("customer_Id"); // customer_Id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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
			$this->customer_firstname->EditValue = HtmlEncode($this->customer_firstname->CurrentValue);
			$this->customer_firstname->PlaceHolder = RemoveHtml($this->customer_firstname->caption());

			// customer_lastname
			$this->customer_lastname->EditAttrs["class"] = "form-control";
			$this->customer_lastname->EditCustomAttributes = "";
			if (!$this->customer_lastname->Raw)
				$this->customer_lastname->CurrentValue = HtmlDecode($this->customer_lastname->CurrentValue);
			$this->customer_lastname->EditValue = HtmlEncode($this->customer_lastname->CurrentValue);
			$this->customer_lastname->PlaceHolder = RemoveHtml($this->customer_lastname->caption());

			// customer_addresslineone
			$this->customer_addresslineone->EditAttrs["class"] = "form-control";
			$this->customer_addresslineone->EditCustomAttributes = "";
			if (!$this->customer_addresslineone->Raw)
				$this->customer_addresslineone->CurrentValue = HtmlDecode($this->customer_addresslineone->CurrentValue);
			$this->customer_addresslineone->EditValue = HtmlEncode($this->customer_addresslineone->CurrentValue);
			$this->customer_addresslineone->PlaceHolder = RemoveHtml($this->customer_addresslineone->caption());

			// customer_addresslinetwo
			$this->customer_addresslinetwo->EditAttrs["class"] = "form-control";
			$this->customer_addresslinetwo->EditCustomAttributes = "";
			if (!$this->customer_addresslinetwo->Raw)
				$this->customer_addresslinetwo->CurrentValue = HtmlDecode($this->customer_addresslinetwo->CurrentValue);
			$this->customer_addresslinetwo->EditValue = HtmlEncode($this->customer_addresslinetwo->CurrentValue);
			$this->customer_addresslinetwo->PlaceHolder = RemoveHtml($this->customer_addresslinetwo->caption());

			// customer_city
			$this->customer_city->EditAttrs["class"] = "form-control";
			$this->customer_city->EditCustomAttributes = "";
			if (!$this->customer_city->Raw)
				$this->customer_city->CurrentValue = HtmlDecode($this->customer_city->CurrentValue);
			$this->customer_city->EditValue = HtmlEncode($this->customer_city->CurrentValue);
			$this->customer_city->PlaceHolder = RemoveHtml($this->customer_city->caption());

			// customer_postcode
			$this->customer_postcode->EditAttrs["class"] = "form-control";
			$this->customer_postcode->EditCustomAttributes = "";
			if (!$this->customer_postcode->Raw)
				$this->customer_postcode->CurrentValue = HtmlDecode($this->customer_postcode->CurrentValue);
			$this->customer_postcode->EditValue = HtmlEncode($this->customer_postcode->CurrentValue);
			$this->customer_postcode->PlaceHolder = RemoveHtml($this->customer_postcode->caption());

			// customer_email
			$this->customer_email->EditAttrs["class"] = "form-control";
			$this->customer_email->EditCustomAttributes = "";
			if (!$this->customer_email->Raw)
				$this->customer_email->CurrentValue = HtmlDecode($this->customer_email->CurrentValue);
			$this->customer_email->EditValue = HtmlEncode($this->customer_email->CurrentValue);
			$this->customer_email->PlaceHolder = RemoveHtml($this->customer_email->caption());

			// customer_username
			$this->customer_username->EditAttrs["class"] = "form-control";
			$this->customer_username->EditCustomAttributes = "";
			if (!$this->customer_username->Raw)
				$this->customer_username->CurrentValue = HtmlDecode($this->customer_username->CurrentValue);
			$this->customer_username->EditValue = HtmlEncode($this->customer_username->CurrentValue);
			$this->customer_username->PlaceHolder = RemoveHtml($this->customer_username->caption());

			// customer_password
			$this->customer_password->EditAttrs["class"] = "form-control";
			$this->customer_password->EditCustomAttributes = "";
			if (!$this->customer_password->Raw)
				$this->customer_password->CurrentValue = HtmlDecode($this->customer_password->CurrentValue);
			$this->customer_password->EditValue = HtmlEncode($this->customer_password->CurrentValue);
			$this->customer_password->PlaceHolder = RemoveHtml($this->customer_password->caption());

			// Edit refer script
			// customer_Id

			$this->customer_Id->LinkCustomAttributes = "";
			$this->customer_Id->HrefValue = "";

			// customer_firstname
			$this->customer_firstname->LinkCustomAttributes = "";
			$this->customer_firstname->HrefValue = "";

			// customer_lastname
			$this->customer_lastname->LinkCustomAttributes = "";
			$this->customer_lastname->HrefValue = "";

			// customer_addresslineone
			$this->customer_addresslineone->LinkCustomAttributes = "";
			$this->customer_addresslineone->HrefValue = "";

			// customer_addresslinetwo
			$this->customer_addresslinetwo->LinkCustomAttributes = "";
			$this->customer_addresslinetwo->HrefValue = "";

			// customer_city
			$this->customer_city->LinkCustomAttributes = "";
			$this->customer_city->HrefValue = "";

			// customer_postcode
			$this->customer_postcode->LinkCustomAttributes = "";
			$this->customer_postcode->HrefValue = "";

			// customer_email
			$this->customer_email->LinkCustomAttributes = "";
			$this->customer_email->HrefValue = "";

			// customer_username
			$this->customer_username->LinkCustomAttributes = "";
			$this->customer_username->HrefValue = "";

			// customer_password
			$this->customer_password->LinkCustomAttributes = "";
			$this->customer_password->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->customer_Id->Required) {
			if (!$this->customer_Id->IsDetailKey && $this->customer_Id->FormValue != NULL && $this->customer_Id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->customer_Id->caption(), $this->customer_Id->RequiredErrorMessage));
			}
		}
		if ($this->customer_firstname->Required) {
			if (!$this->customer_firstname->IsDetailKey && $this->customer_firstname->FormValue != NULL && $this->customer_firstname->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->customer_firstname->caption(), $this->customer_firstname->RequiredErrorMessage));
			}
		}
		if ($this->customer_lastname->Required) {
			if (!$this->customer_lastname->IsDetailKey && $this->customer_lastname->FormValue != NULL && $this->customer_lastname->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->customer_lastname->caption(), $this->customer_lastname->RequiredErrorMessage));
			}
		}
		if ($this->customer_addresslineone->Required) {
			if (!$this->customer_addresslineone->IsDetailKey && $this->customer_addresslineone->FormValue != NULL && $this->customer_addresslineone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->customer_addresslineone->caption(), $this->customer_addresslineone->RequiredErrorMessage));
			}
		}
		if ($this->customer_addresslinetwo->Required) {
			if (!$this->customer_addresslinetwo->IsDetailKey && $this->customer_addresslinetwo->FormValue != NULL && $this->customer_addresslinetwo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->customer_addresslinetwo->caption(), $this->customer_addresslinetwo->RequiredErrorMessage));
			}
		}
		if ($this->customer_city->Required) {
			if (!$this->customer_city->IsDetailKey && $this->customer_city->FormValue != NULL && $this->customer_city->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->customer_city->caption(), $this->customer_city->RequiredErrorMessage));
			}
		}
		if ($this->customer_postcode->Required) {
			if (!$this->customer_postcode->IsDetailKey && $this->customer_postcode->FormValue != NULL && $this->customer_postcode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->customer_postcode->caption(), $this->customer_postcode->RequiredErrorMessage));
			}
		}
		if ($this->customer_email->Required) {
			if (!$this->customer_email->IsDetailKey && $this->customer_email->FormValue != NULL && $this->customer_email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->customer_email->caption(), $this->customer_email->RequiredErrorMessage));
			}
		}
		if ($this->customer_username->Required) {
			if (!$this->customer_username->IsDetailKey && $this->customer_username->FormValue != NULL && $this->customer_username->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->customer_username->caption(), $this->customer_username->RequiredErrorMessage));
			}
		}
		if ($this->customer_password->Required) {
			if (!$this->customer_password->IsDetailKey && $this->customer_password->FormValue != NULL && $this->customer_password->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->customer_password->caption(), $this->customer_password->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
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
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// customer_firstname
			$this->customer_firstname->setDbValueDef($rsnew, $this->customer_firstname->CurrentValue, "", $this->customer_firstname->ReadOnly);

			// customer_lastname
			$this->customer_lastname->setDbValueDef($rsnew, $this->customer_lastname->CurrentValue, "", $this->customer_lastname->ReadOnly);

			// customer_addresslineone
			$this->customer_addresslineone->setDbValueDef($rsnew, $this->customer_addresslineone->CurrentValue, "", $this->customer_addresslineone->ReadOnly);

			// customer_addresslinetwo
			$this->customer_addresslinetwo->setDbValueDef($rsnew, $this->customer_addresslinetwo->CurrentValue, NULL, $this->customer_addresslinetwo->ReadOnly);

			// customer_city
			$this->customer_city->setDbValueDef($rsnew, $this->customer_city->CurrentValue, "", $this->customer_city->ReadOnly);

			// customer_postcode
			$this->customer_postcode->setDbValueDef($rsnew, $this->customer_postcode->CurrentValue, "", $this->customer_postcode->ReadOnly);

			// customer_email
			$this->customer_email->setDbValueDef($rsnew, $this->customer_email->CurrentValue, "", $this->customer_email->ReadOnly);

			// customer_username
			$this->customer_username->setDbValueDef($rsnew, $this->customer_username->CurrentValue, "", $this->customer_username->ReadOnly);

			// customer_password
			$this->customer_password->setDbValueDef($rsnew, $this->customer_password->CurrentValue, "", $this->customer_password->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew); 
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
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
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("customerslist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

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
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			} elseif ($pageNo !== NULL) {
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>