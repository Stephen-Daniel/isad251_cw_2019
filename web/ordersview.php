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
$orders_view = new orders_view();

// Run the page
$orders_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$orders_view->isExport()) { ?>
<script>
var fordersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fordersview = currentForm = new ew.Form("fordersview", "view");
	loadjs.done("fordersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$orders_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $orders_view->ExportOptions->render("body") ?>
<?php $orders_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $orders_view->showPageHeader(); ?>
<?php
$orders_view->showMessage();
?>
<form name="fordersview" id="fordersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<input type="hidden" name="modal" value="<?php echo (int)$orders_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($orders_view->order_id->Visible) { // order_id ?>
	<tr id="r_order_id">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_order_id"><?php echo $orders_view->order_id->caption() ?></span></td>
		<td data-name="order_id" <?php echo $orders_view->order_id->cellAttributes() ?>>
<span id="el_orders_order_id">
<span<?php echo $orders_view->order_id->viewAttributes() ?>><?php echo $orders_view->order_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->order_date->Visible) { // order_date ?>
	<tr id="r_order_date">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_order_date"><?php echo $orders_view->order_date->caption() ?></span></td>
		<td data-name="order_date" <?php echo $orders_view->order_date->cellAttributes() ?>>
<span id="el_orders_order_date">
<span<?php echo $orders_view->order_date->viewAttributes() ?>><?php echo $orders_view->order_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->order_name->Visible) { // order_name ?>
	<tr id="r_order_name">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_order_name"><?php echo $orders_view->order_name->caption() ?></span></td>
		<td data-name="order_name" <?php echo $orders_view->order_name->cellAttributes() ?>>
<span id="el_orders_order_name">
<span<?php echo $orders_view->order_name->viewAttributes() ?>><?php echo $orders_view->order_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders_view->order_email->Visible) { // order_email ?>
	<tr id="r_order_email">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_order_email"><?php echo $orders_view->order_email->caption() ?></span></td>
		<td data-name="order_email" <?php echo $orders_view->order_email->cellAttributes() ?>>
<span id="el_orders_order_email">
<span<?php echo $orders_view->order_email->viewAttributes() ?>><?php echo $orders_view->order_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$orders_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$orders_view->isExport()) { ?>
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
$orders_view->terminate();
?>