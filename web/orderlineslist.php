<?php
namespace PHPMaker2020\isad251;

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
$orderlines_list = new orderlines_list();

// Run the page
$orderlines_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orderlines_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$orderlines_list->isExport()) { ?>
<script>
var forderlineslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	forderlineslist = currentForm = new ew.Form("forderlineslist", "list");
	forderlineslist.formKeyCountName = '<?php echo $orderlines_list->FormKeyCountName ?>';
	loadjs.done("forderlineslist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$orderlines_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($orderlines_list->TotalRecords > 0 && $orderlines_list->ExportOptions->visible()) { ?>
<?php $orderlines_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($orderlines_list->ImportOptions->visible()) { ?>
<?php $orderlines_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$orderlines_list->renderOtherOptions();
?>
<?php $orderlines_list->showPageHeader(); ?>
<?php
$orderlines_list->showMessage();
?>
<?php if ($orderlines_list->TotalRecords > 0 || $orderlines->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($orderlines_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> orderlines">
<form name="forderlineslist" id="forderlineslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orderlines">
<div id="gmp_orderlines" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($orderlines_list->TotalRecords > 0 || $orderlines_list->isGridEdit()) { ?>
<table id="tbl_orderlineslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$orderlines->RowType = ROWTYPE_HEADER;

// Render list options
$orderlines_list->renderListOptions();

// Render list options (header, left)
$orderlines_list->ListOptions->render("header", "left");
?>
<?php if ($orderlines_list->orderId->Visible) { // orderId ?>
	<?php if ($orderlines_list->SortUrl($orderlines_list->orderId) == "") { ?>
		<th data-name="orderId" class="<?php echo $orderlines_list->orderId->headerCellClass() ?>"><div id="elh_orderlines_orderId" class="orderlines_orderId"><div class="ew-table-header-caption"><?php echo $orderlines_list->orderId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="orderId" class="<?php echo $orderlines_list->orderId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orderlines_list->SortUrl($orderlines_list->orderId) ?>', 1);"><div id="elh_orderlines_orderId" class="orderlines_orderId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orderlines_list->orderId->caption() ?></span><span class="ew-table-header-sort"><?php if ($orderlines_list->orderId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orderlines_list->orderId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orderlines_list->foodId->Visible) { // foodId ?>
	<?php if ($orderlines_list->SortUrl($orderlines_list->foodId) == "") { ?>
		<th data-name="foodId" class="<?php echo $orderlines_list->foodId->headerCellClass() ?>"><div id="elh_orderlines_foodId" class="orderlines_foodId"><div class="ew-table-header-caption"><?php echo $orderlines_list->foodId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="foodId" class="<?php echo $orderlines_list->foodId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orderlines_list->SortUrl($orderlines_list->foodId) ?>', 1);"><div id="elh_orderlines_foodId" class="orderlines_foodId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orderlines_list->foodId->caption() ?></span><span class="ew-table-header-sort"><?php if ($orderlines_list->foodId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orderlines_list->foodId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orderlines_list->quantity->Visible) { // quantity ?>
	<?php if ($orderlines_list->SortUrl($orderlines_list->quantity) == "") { ?>
		<th data-name="quantity" class="<?php echo $orderlines_list->quantity->headerCellClass() ?>"><div id="elh_orderlines_quantity" class="orderlines_quantity"><div class="ew-table-header-caption"><?php echo $orderlines_list->quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="quantity" class="<?php echo $orderlines_list->quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orderlines_list->SortUrl($orderlines_list->quantity) ?>', 1);"><div id="elh_orderlines_quantity" class="orderlines_quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orderlines_list->quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($orderlines_list->quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orderlines_list->quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orderlines_list->price->Visible) { // price ?>
	<?php if ($orderlines_list->SortUrl($orderlines_list->price) == "") { ?>
		<th data-name="price" class="<?php echo $orderlines_list->price->headerCellClass() ?>"><div id="elh_orderlines_price" class="orderlines_price"><div class="ew-table-header-caption"><?php echo $orderlines_list->price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="price" class="<?php echo $orderlines_list->price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $orderlines_list->SortUrl($orderlines_list->price) ?>', 1);"><div id="elh_orderlines_price" class="orderlines_price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orderlines_list->price->caption() ?></span><span class="ew-table-header-sort"><?php if ($orderlines_list->price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($orderlines_list->price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$orderlines_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($orderlines_list->ExportAll && $orderlines_list->isExport()) {
	$orderlines_list->StopRecord = $orderlines_list->TotalRecords;
} else {

	// Set the last record to display
	if ($orderlines_list->TotalRecords > $orderlines_list->StartRecord + $orderlines_list->DisplayRecords - 1)
		$orderlines_list->StopRecord = $orderlines_list->StartRecord + $orderlines_list->DisplayRecords - 1;
	else
		$orderlines_list->StopRecord = $orderlines_list->TotalRecords;
}
$orderlines_list->RecordCount = $orderlines_list->StartRecord - 1;
if ($orderlines_list->Recordset && !$orderlines_list->Recordset->EOF) {
	$orderlines_list->Recordset->moveFirst();
	$selectLimit = $orderlines_list->UseSelectLimit;
	if (!$selectLimit && $orderlines_list->StartRecord > 1)
		$orderlines_list->Recordset->move($orderlines_list->StartRecord - 1);
} elseif (!$orderlines->AllowAddDeleteRow && $orderlines_list->StopRecord == 0) {
	$orderlines_list->StopRecord = $orderlines->GridAddRowCount;
}

// Initialize aggregate
$orderlines->RowType = ROWTYPE_AGGREGATEINIT;
$orderlines->resetAttributes();
$orderlines_list->renderRow();
while ($orderlines_list->RecordCount < $orderlines_list->StopRecord) {
	$orderlines_list->RecordCount++;
	if ($orderlines_list->RecordCount >= $orderlines_list->StartRecord) {
		$orderlines_list->RowCount++;

		// Set up key count
		$orderlines_list->KeyCount = $orderlines_list->RowIndex;

		// Init row class and style
		$orderlines->resetAttributes();
		$orderlines->CssClass = "";
		if ($orderlines_list->isGridAdd()) {
		} else {
			$orderlines_list->loadRowValues($orderlines_list->Recordset); // Load row values
		}
		$orderlines->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$orderlines->RowAttrs->merge(["data-rowindex" => $orderlines_list->RowCount, "id" => "r" . $orderlines_list->RowCount . "_orderlines", "data-rowtype" => $orderlines->RowType]);

		// Render row
		$orderlines_list->renderRow();

		// Render list options
		$orderlines_list->renderListOptions();
?>
	<tr <?php echo $orderlines->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orderlines_list->ListOptions->render("body", "left", $orderlines_list->RowCount);
?>
	<?php if ($orderlines_list->orderId->Visible) { // orderId ?>
		<td data-name="orderId" <?php echo $orderlines_list->orderId->cellAttributes() ?>>
<span id="el<?php echo $orderlines_list->RowCount ?>_orderlines_orderId" class="orderlines_orderId">
<span<?php echo $orderlines_list->orderId->viewAttributes() ?>><?php echo $orderlines_list->orderId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orderlines_list->foodId->Visible) { // foodId ?>
		<td data-name="foodId" <?php echo $orderlines_list->foodId->cellAttributes() ?>>
<span id="el<?php echo $orderlines_list->RowCount ?>_orderlines_foodId" class="orderlines_foodId">
<span<?php echo $orderlines_list->foodId->viewAttributes() ?>><?php echo $orderlines_list->foodId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orderlines_list->quantity->Visible) { // quantity ?>
		<td data-name="quantity" <?php echo $orderlines_list->quantity->cellAttributes() ?>>
<span id="el<?php echo $orderlines_list->RowCount ?>_orderlines_quantity" class="orderlines_quantity">
<span<?php echo $orderlines_list->quantity->viewAttributes() ?>><?php echo $orderlines_list->quantity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($orderlines_list->price->Visible) { // price ?>
		<td data-name="price" <?php echo $orderlines_list->price->cellAttributes() ?>>
<span id="el<?php echo $orderlines_list->RowCount ?>_orderlines_price" class="orderlines_price">
<span<?php echo $orderlines_list->price->viewAttributes() ?>><?php echo $orderlines_list->price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orderlines_list->ListOptions->render("body", "right", $orderlines_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$orderlines_list->isGridAdd())
		$orderlines_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$orderlines->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($orderlines_list->Recordset)
	$orderlines_list->Recordset->Close();
?>
<?php if (!$orderlines_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$orderlines_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $orderlines_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $orderlines_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($orderlines_list->TotalRecords == 0 && !$orderlines->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $orderlines_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$orderlines_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$orderlines_list->isExport()) { ?>
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
$orderlines_list->terminate();
?>