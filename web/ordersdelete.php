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
$orders_delete = new orders_delete();

// Run the page
$orders_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fordersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fordersdelete = currentForm = new ew.Form("fordersdelete", "delete");
	loadjs.done("fordersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $orders_delete->showPageHeader(); ?>
<?php
$orders_delete->showMessage();
?>
<form name="fordersdelete" id="fordersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($orders_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($orders_delete->order_id->Visible) { // order_id ?>
		<th class="<?php echo $orders_delete->order_id->headerCellClass() ?>"><span id="elh_orders_order_id" class="orders_order_id"><?php echo $orders_delete->order_id->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->order_date->Visible) { // order_date ?>
		<th class="<?php echo $orders_delete->order_date->headerCellClass() ?>"><span id="elh_orders_order_date" class="orders_order_date"><?php echo $orders_delete->order_date->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->order_name->Visible) { // order_name ?>
		<th class="<?php echo $orders_delete->order_name->headerCellClass() ?>"><span id="elh_orders_order_name" class="orders_order_name"><?php echo $orders_delete->order_name->caption() ?></span></th>
<?php } ?>
<?php if ($orders_delete->order_email->Visible) { // order_email ?>
		<th class="<?php echo $orders_delete->order_email->headerCellClass() ?>"><span id="elh_orders_order_email" class="orders_order_email"><?php echo $orders_delete->order_email->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$orders_delete->RecordCount = 0;
$i = 0;
while (!$orders_delete->Recordset->EOF) {
	$orders_delete->RecordCount++;
	$orders_delete->RowCount++;

	// Set row properties
	$orders->resetAttributes();
	$orders->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$orders_delete->loadRowValues($orders_delete->Recordset);

	// Render row
	$orders_delete->renderRow();
?>
	<tr <?php echo $orders->rowAttributes() ?>>
<?php if ($orders_delete->order_id->Visible) { // order_id ?>
		<td <?php echo $orders_delete->order_id->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_order_id" class="orders_order_id">
<span<?php echo $orders_delete->order_id->viewAttributes() ?>><?php echo $orders_delete->order_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->order_date->Visible) { // order_date ?>
		<td <?php echo $orders_delete->order_date->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_order_date" class="orders_order_date">
<span<?php echo $orders_delete->order_date->viewAttributes() ?>><?php echo $orders_delete->order_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->order_name->Visible) { // order_name ?>
		<td <?php echo $orders_delete->order_name->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_order_name" class="orders_order_name">
<span<?php echo $orders_delete->order_name->viewAttributes() ?>><?php echo $orders_delete->order_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders_delete->order_email->Visible) { // order_email ?>
		<td <?php echo $orders_delete->order_email->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCount ?>_orders_order_email" class="orders_order_email">
<span<?php echo $orders_delete->order_email->viewAttributes() ?>><?php echo $orders_delete->order_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$orders_delete->Recordset->moveNext();
}
$orders_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orders_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$orders_delete->showPageFooter();
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
$orders_delete->terminate();
?>