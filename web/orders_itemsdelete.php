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
$orders_items_delete = new orders_items_delete();

// Run the page
$orders_items_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_items_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var forders_itemsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	forders_itemsdelete = currentForm = new ew.Form("forders_itemsdelete", "delete");
	loadjs.done("forders_itemsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $orders_items_delete->showPageHeader(); ?>
<?php
$orders_items_delete->showMessage();
?>
<form name="forders_itemsdelete" id="forders_itemsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders_items">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($orders_items_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($orders_items_delete->order_id->Visible) { // order_id ?>
		<th class="<?php echo $orders_items_delete->order_id->headerCellClass() ?>"><span id="elh_orders_items_order_id" class="orders_items_order_id"><?php echo $orders_items_delete->order_id->caption() ?></span></th>
<?php } ?>
<?php if ($orders_items_delete->product_id->Visible) { // product_id ?>
		<th class="<?php echo $orders_items_delete->product_id->headerCellClass() ?>"><span id="elh_orders_items_product_id" class="orders_items_product_id"><?php echo $orders_items_delete->product_id->caption() ?></span></th>
<?php } ?>
<?php if ($orders_items_delete->quantity->Visible) { // quantity ?>
		<th class="<?php echo $orders_items_delete->quantity->headerCellClass() ?>"><span id="elh_orders_items_quantity" class="orders_items_quantity"><?php echo $orders_items_delete->quantity->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$orders_items_delete->RecordCount = 0;
$i = 0;
while (!$orders_items_delete->Recordset->EOF) {
	$orders_items_delete->RecordCount++;
	$orders_items_delete->RowCount++;

	// Set row properties
	$orders_items->resetAttributes();
	$orders_items->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$orders_items_delete->loadRowValues($orders_items_delete->Recordset);

	// Render row
	$orders_items_delete->renderRow();
?>
	<tr <?php echo $orders_items->rowAttributes() ?>>
<?php if ($orders_items_delete->order_id->Visible) { // order_id ?>
		<td <?php echo $orders_items_delete->order_id->cellAttributes() ?>>
<span id="el<?php echo $orders_items_delete->RowCount ?>_orders_items_order_id" class="orders_items_order_id">
<span<?php echo $orders_items_delete->order_id->viewAttributes() ?>><?php echo $orders_items_delete->order_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_items_delete->product_id->Visible) { // product_id ?>
		<td <?php echo $orders_items_delete->product_id->cellAttributes() ?>>
<span id="el<?php echo $orders_items_delete->RowCount ?>_orders_items_product_id" class="orders_items_product_id">
<span<?php echo $orders_items_delete->product_id->viewAttributes() ?>><?php echo $orders_items_delete->product_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_items_delete->quantity->Visible) { // quantity ?>
		<td <?php echo $orders_items_delete->quantity->cellAttributes() ?>>
<span id="el<?php echo $orders_items_delete->RowCount ?>_orders_items_quantity" class="orders_items_quantity">
<span<?php echo $orders_items_delete->quantity->viewAttributes() ?>><?php echo $orders_items_delete->quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$orders_items_delete->Recordset->moveNext();
}
$orders_items_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orders_items_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$orders_items_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$orders_items_delete->terminate();
?>