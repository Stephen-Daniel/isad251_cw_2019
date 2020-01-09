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
$orders_items_view = new orders_items_view();

// Run the page
$orders_items_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_items_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$orders_items_view->isExport()) { ?>
<script>
var forders_itemsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	forders_itemsview = currentForm = new ew.Form("forders_itemsview", "view");
	loadjs.done("forders_itemsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$orders_items_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $orders_items_view->ExportOptions->render("body") ?>
<?php $orders_items_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $orders_items_view->showPageHeader(); ?>
<?php
$orders_items_view->showMessage();
?>
<form name="forders_itemsview" id="forders_itemsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders_items">
<input type="hidden" name="modal" value="<?php echo (int)$orders_items_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($orders_items_view->order_id->Visible) { // order_id ?>
	<tr id="r_order_id">
		<td class="<?php echo $orders_items_view->TableLeftColumnClass ?>"><span id="elh_orders_items_order_id"><?php echo $orders_items_view->order_id->caption() ?></span></td>
		<td data-name="order_id" <?php echo $orders_items_view->order_id->cellAttributes() ?>>
<span id="el_orders_items_order_id">
<span<?php echo $orders_items_view->order_id->viewAttributes() ?>><?php echo $orders_items_view->order_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_items_view->product_id->Visible) { // product_id ?>
	<tr id="r_product_id">
		<td class="<?php echo $orders_items_view->TableLeftColumnClass ?>"><span id="elh_orders_items_product_id"><?php echo $orders_items_view->product_id->caption() ?></span></td>
		<td data-name="product_id" <?php echo $orders_items_view->product_id->cellAttributes() ?>>
<span id="el_orders_items_product_id">
<span<?php echo $orders_items_view->product_id->viewAttributes() ?>><?php echo $orders_items_view->product_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_items_view->quantity->Visible) { // quantity ?>
	<tr id="r_quantity">
		<td class="<?php echo $orders_items_view->TableLeftColumnClass ?>"><span id="elh_orders_items_quantity"><?php echo $orders_items_view->quantity->caption() ?></span></td>
		<td data-name="quantity" <?php echo $orders_items_view->quantity->cellAttributes() ?>>
<span id="el_orders_items_quantity">
<span<?php echo $orders_items_view->quantity->viewAttributes() ?>><?php echo $orders_items_view->quantity->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$orders_items_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$orders_items_view->isExport()) { ?>
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
$orders_items_view->terminate();
?>