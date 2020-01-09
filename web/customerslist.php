<?php
namespace PHPMaker2020\project1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$customers_list = new customers_list();

// Run the page
$customers_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$customers_list->isExport()) { ?>
<script>
var fcustomerslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcustomerslist = currentForm = new ew.Form("fcustomerslist", "list");
	fcustomerslist.formKeyCountName = '<?php echo $customers_list->FormKeyCountName ?>';
	loadjs.done("fcustomerslist");
});
var fcustomerslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcustomerslistsrch = currentSearchForm = new ew.Form("fcustomerslistsrch");

	// Dynamic selection lists
	// Filters

	fcustomerslistsrch.filterList = <?php echo $customers_list->getFilterList() ?>;
	loadjs.done("fcustomerslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$customers_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($customers_list->TotalRecords > 0 && $customers_list->ExportOptions->visible()) { ?>
<?php $customers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($customers_list->ImportOptions->visible()) { ?>
<?php $customers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($customers_list->SearchOptions->visible()) { ?>
<?php $customers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($customers_list->FilterOptions->visible()) { ?>
<?php $customers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$customers_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$customers_list->isExport() && !$customers->CurrentAction) { ?>
<form name="fcustomerslistsrch" id="fcustomerslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcustomerslistsrch-search-panel" class="<?php echo $customers_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="customers">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $customers_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($customers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($customers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $customers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $customers_list->showPageHeader(); ?>
<?php
$customers_list->showMessage();
?>
<?php if ($customers_list->TotalRecords > 0 || $customers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($customers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> customers">
<form name="fcustomerslist" id="fcustomerslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<div id="gmp_customers" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($customers_list->TotalRecords > 0 || $customers_list->isGridEdit()) { ?>
<table id="tbl_customerslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$customers->RowType = ROWTYPE_HEADER;

// Render list options
$customers_list->renderListOptions();

// Render list options (header, left)
$customers_list->ListOptions->render("header", "left");
?>
<?php if ($customers_list->customer_Id->Visible) { // customer_Id ?>
	<?php if ($customers_list->SortUrl($customers_list->customer_Id) == "") { ?>
		<th data-name="customer_Id" class="<?php echo $customers_list->customer_Id->headerCellClass() ?>"><div id="elh_customers_customer_Id" class="customers_customer_Id"><div class="ew-table-header-caption"><?php echo $customers_list->customer_Id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_Id" class="<?php echo $customers_list->customer_Id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->customer_Id) ?>', 1);"><div id="elh_customers_customer_Id" class="customers_customer_Id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->customer_Id->caption() ?></span><span class="ew-table-header-sort"><?php if ($customers_list->customer_Id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->customer_Id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->customer_firstname->Visible) { // customer_firstname ?>
	<?php if ($customers_list->SortUrl($customers_list->customer_firstname) == "") { ?>
		<th data-name="customer_firstname" class="<?php echo $customers_list->customer_firstname->headerCellClass() ?>"><div id="elh_customers_customer_firstname" class="customers_customer_firstname"><div class="ew-table-header-caption"><?php echo $customers_list->customer_firstname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_firstname" class="<?php echo $customers_list->customer_firstname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->customer_firstname) ?>', 1);"><div id="elh_customers_customer_firstname" class="customers_customer_firstname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->customer_firstname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->customer_firstname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->customer_firstname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->customer_lastname->Visible) { // customer_lastname ?>
	<?php if ($customers_list->SortUrl($customers_list->customer_lastname) == "") { ?>
		<th data-name="customer_lastname" class="<?php echo $customers_list->customer_lastname->headerCellClass() ?>"><div id="elh_customers_customer_lastname" class="customers_customer_lastname"><div class="ew-table-header-caption"><?php echo $customers_list->customer_lastname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_lastname" class="<?php echo $customers_list->customer_lastname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->customer_lastname) ?>', 1);"><div id="elh_customers_customer_lastname" class="customers_customer_lastname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->customer_lastname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->customer_lastname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->customer_lastname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->customer_addresslineone->Visible) { // customer_addresslineone ?>
	<?php if ($customers_list->SortUrl($customers_list->customer_addresslineone) == "") { ?>
		<th data-name="customer_addresslineone" class="<?php echo $customers_list->customer_addresslineone->headerCellClass() ?>"><div id="elh_customers_customer_addresslineone" class="customers_customer_addresslineone"><div class="ew-table-header-caption"><?php echo $customers_list->customer_addresslineone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_addresslineone" class="<?php echo $customers_list->customer_addresslineone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->customer_addresslineone) ?>', 1);"><div id="elh_customers_customer_addresslineone" class="customers_customer_addresslineone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->customer_addresslineone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->customer_addresslineone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->customer_addresslineone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->customer_addresslinetwo->Visible) { // customer_addresslinetwo ?>
	<?php if ($customers_list->SortUrl($customers_list->customer_addresslinetwo) == "") { ?>
		<th data-name="customer_addresslinetwo" class="<?php echo $customers_list->customer_addresslinetwo->headerCellClass() ?>"><div id="elh_customers_customer_addresslinetwo" class="customers_customer_addresslinetwo"><div class="ew-table-header-caption"><?php echo $customers_list->customer_addresslinetwo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_addresslinetwo" class="<?php echo $customers_list->customer_addresslinetwo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->customer_addresslinetwo) ?>', 1);"><div id="elh_customers_customer_addresslinetwo" class="customers_customer_addresslinetwo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->customer_addresslinetwo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->customer_addresslinetwo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->customer_addresslinetwo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->customer_city->Visible) { // customer_city ?>
	<?php if ($customers_list->SortUrl($customers_list->customer_city) == "") { ?>
		<th data-name="customer_city" class="<?php echo $customers_list->customer_city->headerCellClass() ?>"><div id="elh_customers_customer_city" class="customers_customer_city"><div class="ew-table-header-caption"><?php echo $customers_list->customer_city->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_city" class="<?php echo $customers_list->customer_city->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->customer_city) ?>', 1);"><div id="elh_customers_customer_city" class="customers_customer_city">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->customer_city->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->customer_city->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->customer_city->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->customer_postcode->Visible) { // customer_postcode ?>
	<?php if ($customers_list->SortUrl($customers_list->customer_postcode) == "") { ?>
		<th data-name="customer_postcode" class="<?php echo $customers_list->customer_postcode->headerCellClass() ?>"><div id="elh_customers_customer_postcode" class="customers_customer_postcode"><div class="ew-table-header-caption"><?php echo $customers_list->customer_postcode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_postcode" class="<?php echo $customers_list->customer_postcode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->customer_postcode) ?>', 1);"><div id="elh_customers_customer_postcode" class="customers_customer_postcode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->customer_postcode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->customer_postcode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->customer_postcode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->customer_email->Visible) { // customer_email ?>
	<?php if ($customers_list->SortUrl($customers_list->customer_email) == "") { ?>
		<th data-name="customer_email" class="<?php echo $customers_list->customer_email->headerCellClass() ?>"><div id="elh_customers_customer_email" class="customers_customer_email"><div class="ew-table-header-caption"><?php echo $customers_list->customer_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_email" class="<?php echo $customers_list->customer_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->customer_email) ?>', 1);"><div id="elh_customers_customer_email" class="customers_customer_email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->customer_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->customer_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->customer_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->customer_username->Visible) { // customer_username ?>
	<?php if ($customers_list->SortUrl($customers_list->customer_username) == "") { ?>
		<th data-name="customer_username" class="<?php echo $customers_list->customer_username->headerCellClass() ?>"><div id="elh_customers_customer_username" class="customers_customer_username"><div class="ew-table-header-caption"><?php echo $customers_list->customer_username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_username" class="<?php echo $customers_list->customer_username->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->customer_username) ?>', 1);"><div id="elh_customers_customer_username" class="customers_customer_username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->customer_username->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->customer_username->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->customer_username->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->customer_password->Visible) { // customer_password ?>
	<?php if ($customers_list->SortUrl($customers_list->customer_password) == "") { ?>
		<th data-name="customer_password" class="<?php echo $customers_list->customer_password->headerCellClass() ?>"><div id="elh_customers_customer_password" class="customers_customer_password"><div class="ew-table-header-caption"><?php echo $customers_list->customer_password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_password" class="<?php echo $customers_list->customer_password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->customer_password) ?>', 1);"><div id="elh_customers_customer_password" class="customers_customer_password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->customer_password->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->customer_password->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->customer_password->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$customers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($customers_list->ExportAll && $customers_list->isExport()) {
	$customers_list->StopRecord = $customers_list->TotalRecords;
} else {

	// Set the last record to display
	if ($customers_list->TotalRecords > $customers_list->StartRecord + $customers_list->DisplayRecords - 1)
		$customers_list->StopRecord = $customers_list->StartRecord + $customers_list->DisplayRecords - 1;
	else
		$customers_list->StopRecord = $customers_list->TotalRecords;
}
$customers_list->RecordCount = $customers_list->StartRecord - 1;
if ($customers_list->Recordset && !$customers_list->Recordset->EOF) {
	$customers_list->Recordset->moveFirst();
	$selectLimit = $customers_list->UseSelectLimit;
	if (!$selectLimit && $customers_list->StartRecord > 1)
		$customers_list->Recordset->move($customers_list->StartRecord - 1);
} elseif (!$customers->AllowAddDeleteRow && $customers_list->StopRecord == 0) {
	$customers_list->StopRecord = $customers->GridAddRowCount;
}

// Initialize aggregate
$customers->RowType = ROWTYPE_AGGREGATEINIT;
$customers->resetAttributes();
$customers_list->renderRow();
while ($customers_list->RecordCount < $customers_list->StopRecord) {
	$customers_list->RecordCount++;
	if ($customers_list->RecordCount >= $customers_list->StartRecord) {
		$customers_list->RowCount++;

		// Set up key count
		$customers_list->KeyCount = $customers_list->RowIndex;

		// Init row class and style
		$customers->resetAttributes();
		$customers->CssClass = "";
		if ($customers_list->isGridAdd()) {
		} else {
			$customers_list->loadRowValues($customers_list->Recordset); // Load row values
		}
		$customers->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$customers->RowAttrs->merge(["data-rowindex" => $customers_list->RowCount, "id" => "r" . $customers_list->RowCount . "_customers", "data-rowtype" => $customers->RowType]);

		// Render row
		$customers_list->renderRow();

		// Render list options
		$customers_list->renderListOptions();
?>
	<tr <?php echo $customers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$customers_list->ListOptions->render("body", "left", $customers_list->RowCount);
?>
	<?php if ($customers_list->customer_Id->Visible) { // customer_Id ?>
		<td data-name="customer_Id" <?php echo $customers_list->customer_Id->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_customer_Id">
<span<?php echo $customers_list->customer_Id->viewAttributes() ?>><?php echo $customers_list->customer_Id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->customer_firstname->Visible) { // customer_firstname ?>
		<td data-name="customer_firstname" <?php echo $customers_list->customer_firstname->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_customer_firstname">
<span<?php echo $customers_list->customer_firstname->viewAttributes() ?>><?php echo $customers_list->customer_firstname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->customer_lastname->Visible) { // customer_lastname ?>
		<td data-name="customer_lastname" <?php echo $customers_list->customer_lastname->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_customer_lastname">
<span<?php echo $customers_list->customer_lastname->viewAttributes() ?>><?php echo $customers_list->customer_lastname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->customer_addresslineone->Visible) { // customer_addresslineone ?>
		<td data-name="customer_addresslineone" <?php echo $customers_list->customer_addresslineone->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_customer_addresslineone">
<span<?php echo $customers_list->customer_addresslineone->viewAttributes() ?>><?php echo $customers_list->customer_addresslineone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->customer_addresslinetwo->Visible) { // customer_addresslinetwo ?>
		<td data-name="customer_addresslinetwo" <?php echo $customers_list->customer_addresslinetwo->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_customer_addresslinetwo">
<span<?php echo $customers_list->customer_addresslinetwo->viewAttributes() ?>><?php echo $customers_list->customer_addresslinetwo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->customer_city->Visible) { // customer_city ?>
		<td data-name="customer_city" <?php echo $customers_list->customer_city->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_customer_city">
<span<?php echo $customers_list->customer_city->viewAttributes() ?>><?php echo $customers_list->customer_city->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->customer_postcode->Visible) { // customer_postcode ?>
		<td data-name="customer_postcode" <?php echo $customers_list->customer_postcode->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_customer_postcode">
<span<?php echo $customers_list->customer_postcode->viewAttributes() ?>><?php echo $customers_list->customer_postcode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->customer_email->Visible) { // customer_email ?>
		<td data-name="customer_email" <?php echo $customers_list->customer_email->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_customer_email">
<span<?php echo $customers_list->customer_email->viewAttributes() ?>><?php echo $customers_list->customer_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->customer_username->Visible) { // customer_username ?>
		<td data-name="customer_username" <?php echo $customers_list->customer_username->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_customer_username">
<span<?php echo $customers_list->customer_username->viewAttributes() ?>><?php echo $customers_list->customer_username->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->customer_password->Visible) { // customer_password ?>
		<td data-name="customer_password" <?php echo $customers_list->customer_password->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_customer_password">
<span<?php echo $customers_list->customer_password->viewAttributes() ?>><?php echo $customers_list->customer_password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$customers_list->ListOptions->render("body", "right", $customers_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$customers_list->isGridAdd())
		$customers_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$customers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($customers_list->Recordset)
	$customers_list->Recordset->Close();
?>
<?php if (!$customers_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$customers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $customers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $customers_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($customers_list->TotalRecords == 0 && !$customers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $customers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$customers_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$customers_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$customers_list->terminate();
?>