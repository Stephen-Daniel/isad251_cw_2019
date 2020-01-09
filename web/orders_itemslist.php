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
$orders_items_list = new orders_items_list();

// Run the page
$orders_items_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_items_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$orders_items_list->isExport()) { ?>
<script>
var forders_itemslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	forders_itemslist = currentForm = new ew.Form("forders_itemslist", "list");
	forders_itemslist.formKeyCountName = '<?php echo $orders_items_list->FormKeyCountName ?>';
	loadjs.done("forders_itemslist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$orders_items_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($orders_items_list->TotalRecords > 0 && $orders_items_list->ExportOptions->visible()) { ?>
<?php $orders_items_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($orders_items_list->ImportOptions->visible()) { ?>
<?php $orders_items_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$orders_items_list->renderOtherOptions();
?>
<?php $orders_items_list->showPageHeader(); ?>
<?php
$orders_items_list->showMessage();
?>
<?php if ($orders_items_list->TotalRecords > 0 || $orders_items->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($orders_items_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> orders_items">
<form name="forders_itemslist" id="forders_itemslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders_items">
<div id="gmp_orders_items" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($orders_items_list->TotalRecords > 0 || $orders_items_list->isGridEdit()) { ?>
<table id="tbl_orders_itemslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$orders_items->RowType = ROWTYPE_HEADER;

// Render list options
$orders_items_list->renderListOptions();

// Render list options (header, left)
$orders_items_list->ListOptions->render("header", "left");
?>
<?php if ($orders_items_list->order_id->Visible) { // order_id ?>
	<?php if ($orders_items_list->SortUrl($orders_items_list->order_id) == "") { ?>
		<th data-name="order_id" class="<?php echo $orders_items_list->order_id->headerCellClass() ?>"><div id="elh_orders_items_order_id" class="orders_items_order_id"><div class="ew-table-header-caption"><?php echo $orders_items_list->order_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="order_id" class="<?php echo $orders_items_list->order_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_items_list->SortUrl($orders_items_list->order_id) ?>', 1);"><div id="elh_orders_items_order_id" class="orders_items_order_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_items_list->order_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders_items_list->order_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_items_list->order_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_items_list->product_id->Visible) { // product_id ?>
	<?php if ($orders_items_list->SortUrl($orders_items_list->product_id) == "") { ?>
		<th data-name="product_id" class="<?php echo $orders_items_list->product_id->headerCellClass() ?>"><div id="elh_orders_items_product_id" class="orders_items_product_id"><div class="ew-table-header-caption"><?php echo $orders_items_list->product_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_id" class="<?php echo $orders_items_list->product_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_items_list->SortUrl($orders_items_list->product_id) ?>', 1);"><div id="elh_orders_items_product_id" class="orders_items_product_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_items_list->product_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders_items_list->product_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_items_list->product_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders_items_list->quantity->Visible) { // quantity ?>
	<?php if ($orders_items_list->SortUrl($orders_items_list->quantity) == "") { ?>
		<th data-name="quantity" class="<?php echo $orders_items_list->quantity->headerCellClass() ?>"><div id="elh_orders_items_quantity" class="orders_items_quantity"><div class="ew-table-header-caption"><?php echo $orders_items_list->quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="quantity" class="<?php echo $orders_items_list->quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orders_items_list->SortUrl($orders_items_list->quantity) ?>', 1);"><div id="elh_orders_items_quantity" class="orders_items_quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders_items_list->quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders_items_list->quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orders_items_list->quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$orders_items_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($orders_items_list->ExportAll && $orders_items_list->isExport()) {
	$orders_items_list->StopRecord = $orders_items_list->TotalRecords;
} else {

	// Set the last record to display
	if ($orders_items_list->TotalRecords > $orders_items_list->StartRecord + $orders_items_list->DisplayRecords - 1)
		$orders_items_list->StopRecord = $orders_items_list->StartRecord + $orders_items_list->DisplayRecords - 1;
	else
		$orders_items_list->StopRecord = $orders_items_list->TotalRecords;
}
$orders_items_list->RecordCount = $orders_items_list->StartRecord - 1;
if ($orders_items_list->Recordset && !$orders_items_list->Recordset->EOF) {
	$orders_items_list->Recordset->moveFirst();
	$selectLimit = $orders_items_list->UseSelectLimit;
	if (!$selectLimit && $orders_items_list->StartRecord > 1)
		$orders_items_list->Recordset->move($orders_items_list->StartRecord - 1);
} elseif (!$orders_items->AllowAddDeleteRow && $orders_items_list->StopRecord == 0) {
	$orders_items_list->StopRecord = $orders_items->GridAddRowCount;
}

// Initialize aggregate
$orders_items->RowType = ROWTYPE_AGGREGATEINIT;
$orders_items->resetAttributes();
$orders_items_list->renderRow();
while ($orders_items_list->RecordCount < $orders_items_list->StopRecord) {
	$orders_items_list->RecordCount++;
	if ($orders_items_list->RecordCount >= $orders_items_list->StartRecord) {
		$orders_items_list->RowCount++;

		// Set up key count
		$orders_items_list->KeyCount = $orders_items_list->RowIndex;

		// Init row class and style
		$orders_items->resetAttributes();
		$orders_items->CssClass = "";
		if ($orders_items_list->isGridAdd()) {
		} else {
			$orders_items_list->loadRowValues($orders_items_list->Recordset); // Load row values
		}
		$orders_items->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$orders_items->RowAttrs->merge(["data-rowindex" => $orders_items_list->RowCount, "id" => "r" . $orders_items_list->RowCount . "_orders_items", "data-rowtype" => $orders_items->RowType]);

		// Render row
		$orders_items_list->renderRow();

		// Render list options
		$orders_items_list->renderListOptions();
?>
	<tr <?php echo $orders_items->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orders_items_list->ListOptions->render("body", "left", $orders_items_list->RowCount);
?>
	<?php if ($orders_items_list->order_id->Visible) { // order_id ?>
		<td data-name="order_id" <?php echo $orders_items_list->order_id->cellAttributes() ?>>
<span id="el<?php echo $orders_items_list->RowCount ?>_orders_items_order_id">
<span<?php echo $orders_items_list->order_id->viewAttributes() ?>><?php echo $orders_items_list->order_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_items_list->product_id->Visible) { // product_id ?>
		<td data-name="product_id" <?php echo $orders_items_list->product_id->cellAttributes() ?>>
<span id="el<?php echo $orders_items_list->RowCount ?>_orders_items_product_id">
<span<?php echo $orders_items_list->product_id->viewAttributes() ?>><?php echo $orders_items_list->product_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orders_items_list->quantity->Visible) { // quantity ?>
		<td data-name="quantity" <?php echo $orders_items_list->quantity->cellAttributes() ?>>
<span id="el<?php echo $orders_items_list->RowCount ?>_orders_items_quantity">
<span<?php echo $orders_items_list->quantity->viewAttributes() ?>><?php echo $orders_items_list->quantity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orders_items_list->ListOptions->render("body", "right", $orders_items_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$orders_items_list->isGridAdd())
		$orders_items_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$orders_items->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($orders_items_list->Recordset)
	$orders_items_list->Recordset->Close();
?>
<?php if (!$orders_items_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$orders_items_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $orders_items_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $orders_items_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($orders_items_list->TotalRecords == 0 && !$orders_items->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $orders_items_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$orders_items_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$orders_items_list->isExport()) { ?>
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
$orders_items_list->terminate();
?>