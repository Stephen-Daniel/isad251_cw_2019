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
$orders_list = new orders_list();

// Run the page
$orders_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$orders_list->isExport()) { ?>
<script>
var forderslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	forderslist = currentForm = new ew.Form("forderslist", "list");
	forderslist.formKeyCountName = '<?php echo $orders_list->FormKeyCountName ?>';
	loadjs.done("forderslist");
});
var forderslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	forderslistsrch = currentSearchForm = new ew.Form("forderslistsrch");

	// Dynamic selection lists
	// Filters

	forderslistsrch.filterList = <?php echo $orders_list->getFilterList() ?>;
	loadjs.done("forderslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$orders_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($orders_list->TotalRecords > 0 && $orders_list->ExportOptions->visible()) { ?>
<?php $orders_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($orders_list->ImportOptions->visible()) { ?>
<?php $orders_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($orders_list->SearchOptions->visible()) { ?>
<?php $orders_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($orders_list->FilterOptions->visible()) { ?>
<?php $orders_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$orders_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$orders_list->isExport() && !$orders->CurrentAction) { ?>
<form name="forderslistsrch" id="forderslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="forderslistsrch-search-panel" class="<?php echo $orders_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="orders">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $orders_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($orders_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($orders_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $orders_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $orders_list->showPageHeader(); ?>
<?php
$orders_list->showMessage();
?>
<?php if ($orders_list->TotalRecords > 0 || $orders->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($orders_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> orders">
<form name="forderslist" id="forderslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<div id="gmp_orders" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($orders_list->TotalRecords > 0 || $orders_list->isGridEdit()) { ?>
<table id="tbl_orderslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$orders->RowType = ROWTYPE_HEADER;

// Render list options
$orders_list->renderListOptions();

// Render list options (header, left)
$orders_list->ListOptions->render("header", "left");
?>
<?php if ($orders_list->order_id->Visible) { // order_id ?>
	<?php if ($orders_list->SortUrl($orders_list->order_id) == "") { ?>
		<th data-name="order_id" class="<?php echo $orders_list->order_id->headerCellClass() ?>"><div id="elh_orders_order_id" class="orders_order_id"><div class="ew-table-header-caption"><?php echo $orders_list->order_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="order_id" class="<?php echo $orders_list->order_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->order_id) ?>', 1);"><div id="elh_orders_order_id" class="orders_order_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->order_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders_list->order_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->order_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->order_date->Visible) { // order_date ?>
	<?php if ($orders_list->SortUrl($orders_list->order_date) == "") { ?>
		<th data-name="order_date" class="<?php echo $orders_list->order_date->headerCellClass() ?>"><div id="elh_orders_order_date" class="orders_order_date"><div class="ew-table-header-caption"><?php echo $orders_list->order_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="order_date" class="<?php echo $orders_list->order_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->order_date) ?>', 1);"><div id="elh_orders_order_date" class="orders_order_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->order_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders_list->order_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->order_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->order_name->Visible) { // order_name ?>
	<?php if ($orders_list->SortUrl($orders_list->order_name) == "") { ?>
		<th data-name="order_name" class="<?php echo $orders_list->order_name->headerCellClass() ?>"><div id="elh_orders_order_name" class="orders_order_name"><div class="ew-table-header-caption"><?php echo $orders_list->order_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="order_name" class="<?php echo $orders_list->order_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->order_name) ?>', 1);"><div id="elh_orders_order_name" class="orders_order_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->order_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders_list->order_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->order_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_list->order_email->Visible) { // order_email ?>
	<?php if ($orders_list->SortUrl($orders_list->order_email) == "") { ?>
		<th data-name="order_email" class="<?php echo $orders_list->order_email->headerCellClass() ?>"><div id="elh_orders_order_email" class="orders_order_email"><div class="ew-table-header-caption"><?php echo $orders_list->order_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="order_email" class="<?php echo $orders_list->order_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_list->SortUrl($orders_list->order_email) ?>', 1);"><div id="elh_orders_order_email" class="orders_order_email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_list->order_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders_list->order_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_list->order_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$orders_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($orders_list->ExportAll && $orders_list->isExport()) {
	$orders_list->StopRecord = $orders_list->TotalRecords;
} else {

	// Set the last record to display
	if ($orders_list->TotalRecords > $orders_list->StartRecord + $orders_list->DisplayRecords - 1)
		$orders_list->StopRecord = $orders_list->StartRecord + $orders_list->DisplayRecords - 1;
	else
		$orders_list->StopRecord = $orders_list->TotalRecords;
}
$orders_list->RecordCount = $orders_list->StartRecord - 1;
if ($orders_list->Recordset && !$orders_list->Recordset->EOF) {
	$orders_list->Recordset->moveFirst();
	$selectLimit = $orders_list->UseSelectLimit;
	if (!$selectLimit && $orders_list->StartRecord > 1)
		$orders_list->Recordset->move($orders_list->StartRecord - 1);
} elseif (!$orders->AllowAddDeleteRow && $orders_list->StopRecord == 0) {
	$orders_list->StopRecord = $orders->GridAddRowCount;
}

// Initialize aggregate
$orders->RowType = ROWTYPE_AGGREGATEINIT;
$orders->resetAttributes();
$orders_list->renderRow();
while ($orders_list->RecordCount < $orders_list->StopRecord) {
	$orders_list->RecordCount++;
	if ($orders_list->RecordCount >= $orders_list->StartRecord) {
		$orders_list->RowCount++;

		// Set up key count
		$orders_list->KeyCount = $orders_list->RowIndex;

		// Init row class and style
		$orders->resetAttributes();
		$orders->CssClass = "";
		if ($orders_list->isGridAdd()) {
		} else {
			$orders_list->loadRowValues($orders_list->Recordset); // Load row values
		}
		$orders->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$orders->RowAttrs->merge(["data-rowindex" => $orders_list->RowCount, "id" => "r" . $orders_list->RowCount . "_orders", "data-rowtype" => $orders->RowType]);

		// Render row
		$orders_list->renderRow();

		// Render list options
		$orders_list->renderListOptions();
?>
	<tr <?php echo $orders->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orders_list->ListOptions->render("body", "left", $orders_list->RowCount);
?>
	<?php if ($orders_list->order_id->Visible) { // order_id ?>
		<td data-name="order_id" <?php echo $orders_list->order_id->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_order_id">
<span<?php echo $orders_list->order_id->viewAttributes() ?>><?php echo $orders_list->order_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->order_date->Visible) { // order_date ?>
		<td data-name="order_date" <?php echo $orders_list->order_date->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_order_date">
<span<?php echo $orders_list->order_date->viewAttributes() ?>><?php echo $orders_list->order_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->order_name->Visible) { // order_name ?>
		<td data-name="order_name" <?php echo $orders_list->order_name->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_order_name">
<span<?php echo $orders_list->order_name->viewAttributes() ?>><?php echo $orders_list->order_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_list->order_email->Visible) { // order_email ?>
		<td data-name="order_email" <?php echo $orders_list->order_email->cellAttributes() ?>>
<span id="el<?php echo $orders_list->RowCount ?>_orders_order_email">
<span<?php echo $orders_list->order_email->viewAttributes() ?>><?php echo $orders_list->order_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orders_list->ListOptions->render("body", "right", $orders_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$orders_list->isGridAdd())
		$orders_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$orders->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($orders_list->Recordset)
	$orders_list->Recordset->Close();
?>
<?php if (!$orders_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$orders_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $orders_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $orders_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($orders_list->TotalRecords == 0 && !$orders->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $orders_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$orders_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$orders_list->isExport()) { ?>
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
$orders_list->terminate();
?>