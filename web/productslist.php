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
$products_list = new products_list();

// Run the page
$products_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$products_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$products_list->isExport()) { ?>
<script>
var fproductslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproductslist = currentForm = new ew.Form("fproductslist", "list");
	fproductslist.formKeyCountName = '<?php echo $products_list->FormKeyCountName ?>';
	loadjs.done("fproductslist");
});
var fproductslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproductslistsrch = currentSearchForm = new ew.Form("fproductslistsrch");

	// Dynamic selection lists
	// Filters

	fproductslistsrch.filterList = <?php echo $products_list->getFilterList() ?>;
	loadjs.done("fproductslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$products_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($products_list->TotalRecords > 0 && $products_list->ExportOptions->visible()) { ?>
<?php $products_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($products_list->ImportOptions->visible()) { ?>
<?php $products_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($products_list->SearchOptions->visible()) { ?>
<?php $products_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($products_list->FilterOptions->visible()) { ?>
<?php $products_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$products_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$products_list->isExport() && !$products->CurrentAction) { ?>
<form name="fproductslistsrch" id="fproductslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproductslistsrch-search-panel" class="<?php echo $products_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="products">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $products_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($products_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($products_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $products_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($products_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($products_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($products_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($products_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $products_list->showPageHeader(); ?>
<?php
$products_list->showMessage();
?>
<?php if ($products_list->TotalRecords > 0 || $products->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($products_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> products">
<form name="fproductslist" id="fproductslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="products">
<div id="gmp_products" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($products_list->TotalRecords > 0 || $products_list->isGridEdit()) { ?>
<table id="tbl_productslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$products->RowType = ROWTYPE_HEADER;

// Render list options
$products_list->renderListOptions();

// Render list options (header, left)
$products_list->ListOptions->render("header", "left");
?>
<?php if ($products_list->product_id->Visible) { // product_id ?>
	<?php if ($products_list->SortUrl($products_list->product_id) == "") { ?>
		<th data-name="product_id" class="<?php echo $products_list->product_id->headerCellClass() ?>"><div id="elh_products_product_id" class="products_product_id"><div class="ew-table-header-caption"><?php echo $products_list->product_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_id" class="<?php echo $products_list->product_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $products_list->SortUrl($products_list->product_id) ?>', 1);"><div id="elh_products_product_id" class="products_product_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products_list->product_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($products_list->product_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($products_list->product_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products_list->product_name->Visible) { // product_name ?>
	<?php if ($products_list->SortUrl($products_list->product_name) == "") { ?>
		<th data-name="product_name" class="<?php echo $products_list->product_name->headerCellClass() ?>"><div id="elh_products_product_name" class="products_product_name"><div class="ew-table-header-caption"><?php echo $products_list->product_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_name" class="<?php echo $products_list->product_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $products_list->SortUrl($products_list->product_name) ?>', 1);"><div id="elh_products_product_name" class="products_product_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products_list->product_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($products_list->product_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($products_list->product_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products_list->product_image->Visible) { // product_image ?>
	<?php if ($products_list->SortUrl($products_list->product_image) == "") { ?>
		<th data-name="product_image" class="<?php echo $products_list->product_image->headerCellClass() ?>"><div id="elh_products_product_image" class="products_product_image"><div class="ew-table-header-caption"><?php echo $products_list->product_image->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_image" class="<?php echo $products_list->product_image->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $products_list->SortUrl($products_list->product_image) ?>', 1);"><div id="elh_products_product_image" class="products_product_image">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products_list->product_image->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($products_list->product_image->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($products_list->product_image->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($products_list->product_price->Visible) { // product_price ?>
	<?php if ($products_list->SortUrl($products_list->product_price) == "") { ?>
		<th data-name="product_price" class="<?php echo $products_list->product_price->headerCellClass() ?>"><div id="elh_products_product_price" class="products_product_price"><div class="ew-table-header-caption"><?php echo $products_list->product_price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_price" class="<?php echo $products_list->product_price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $products_list->SortUrl($products_list->product_price) ?>', 1);"><div id="elh_products_product_price" class="products_product_price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $products_list->product_price->caption() ?></span><span class="ew-table-header-sort"><?php if ($products_list->product_price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($products_list->product_price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$products_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($products_list->ExportAll && $products_list->isExport()) {
	$products_list->StopRecord = $products_list->TotalRecords;
} else {

	// Set the last record to display
	if ($products_list->TotalRecords > $products_list->StartRecord + $products_list->DisplayRecords - 1)
		$products_list->StopRecord = $products_list->StartRecord + $products_list->DisplayRecords - 1;
	else
		$products_list->StopRecord = $products_list->TotalRecords;
}
$products_list->RecordCount = $products_list->StartRecord - 1;
if ($products_list->Recordset && !$products_list->Recordset->EOF) {
	$products_list->Recordset->moveFirst();
	$selectLimit = $products_list->UseSelectLimit;
	if (!$selectLimit && $products_list->StartRecord > 1)
		$products_list->Recordset->move($products_list->StartRecord - 1);
} elseif (!$products->AllowAddDeleteRow && $products_list->StopRecord == 0) {
	$products_list->StopRecord = $products->GridAddRowCount;
}

// Initialize aggregate
$products->RowType = ROWTYPE_AGGREGATEINIT;
$products->resetAttributes();
$products_list->renderRow();
while ($products_list->RecordCount < $products_list->StopRecord) {
	$products_list->RecordCount++;
	if ($products_list->RecordCount >= $products_list->StartRecord) {
		$products_list->RowCount++;

		// Set up key count
		$products_list->KeyCount = $products_list->RowIndex;

		// Init row class and style
		$products->resetAttributes();
		$products->CssClass = "";
		if ($products_list->isGridAdd()) {
		} else {
			$products_list->loadRowValues($products_list->Recordset); // Load row values
		}
		$products->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$products->RowAttrs->merge(["data-rowindex" => $products_list->RowCount, "id" => "r" . $products_list->RowCount . "_products", "data-rowtype" => $products->RowType]);

		// Render row
		$products_list->renderRow();

		// Render list options
		$products_list->renderListOptions();
?>
	<tr <?php echo $products->rowAttributes() ?>>
<?php

// Render list options (body, left)
$products_list->ListOptions->render("body", "left", $products_list->RowCount);
?>
	<?php if ($products_list->product_id->Visible) { // product_id ?>
		<td data-name="product_id" <?php echo $products_list->product_id->cellAttributes() ?>>
<span id="el<?php echo $products_list->RowCount ?>_products_product_id">
<span<?php echo $products_list->product_id->viewAttributes() ?>><?php echo $products_list->product_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products_list->product_name->Visible) { // product_name ?>
		<td data-name="product_name" <?php echo $products_list->product_name->cellAttributes() ?>>
<span id="el<?php echo $products_list->RowCount ?>_products_product_name">
<span<?php echo $products_list->product_name->viewAttributes() ?>><?php echo $products_list->product_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products_list->product_image->Visible) { // product_image ?>
		<td data-name="product_image" <?php echo $products_list->product_image->cellAttributes() ?>>
<span id="el<?php echo $products_list->RowCount ?>_products_product_image">
<span<?php echo $products_list->product_image->viewAttributes() ?>><?php echo $products_list->product_image->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($products_list->product_price->Visible) { // product_price ?>
		<td data-name="product_price" <?php echo $products_list->product_price->cellAttributes() ?>>
<span id="el<?php echo $products_list->RowCount ?>_products_product_price">
<span<?php echo $products_list->product_price->viewAttributes() ?>><?php echo $products_list->product_price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$products_list->ListOptions->render("body", "right", $products_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$products_list->isGridAdd())
		$products_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$products->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($products_list->Recordset)
	$products_list->Recordset->Close();
?>
<?php if (!$products_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$products_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $products_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $products_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($products_list->TotalRecords == 0 && !$products->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $products_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$products_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$products_list->isExport()) { ?>
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
$products_list->terminate();
?>