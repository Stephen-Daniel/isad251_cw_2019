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
$customers_view = new customers_view();

// Run the page
$customers_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$customers_view->isExport()) { ?>
<script>
var fcustomersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcustomersview = currentForm = new ew.Form("fcustomersview", "view");
	loadjs.done("fcustomersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$customers_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $customers_view->ExportOptions->render("body") ?>
<?php $customers_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $customers_view->showPageHeader(); ?>
<?php
$customers_view->showMessage();
?>
<form name="fcustomersview" id="fcustomersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<input type="hidden" name="modal" value="<?php echo (int)$customers_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($customers_view->customer_Id->Visible) { // customer_Id ?>
	<tr id="r_customer_Id">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_customer_Id"><?php echo $customers_view->customer_Id->caption() ?></span></td>
		<td data-name="customer_Id" <?php echo $customers_view->customer_Id->cellAttributes() ?>>
<span id="el_customers_customer_Id">
<span<?php echo $customers_view->customer_Id->viewAttributes() ?>><?php echo $customers_view->customer_Id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->customer_firstname->Visible) { // customer_firstname ?>
	<tr id="r_customer_firstname">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_customer_firstname"><?php echo $customers_view->customer_firstname->caption() ?></span></td>
		<td data-name="customer_firstname" <?php echo $customers_view->customer_firstname->cellAttributes() ?>>
<span id="el_customers_customer_firstname">
<span<?php echo $customers_view->customer_firstname->viewAttributes() ?>><?php echo $customers_view->customer_firstname->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->customer_lastname->Visible) { // customer_lastname ?>
	<tr id="r_customer_lastname">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_customer_lastname"><?php echo $customers_view->customer_lastname->caption() ?></span></td>
		<td data-name="customer_lastname" <?php echo $customers_view->customer_lastname->cellAttributes() ?>>
<span id="el_customers_customer_lastname">
<span<?php echo $customers_view->customer_lastname->viewAttributes() ?>><?php echo $customers_view->customer_lastname->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->customer_addresslineone->Visible) { // customer_addresslineone ?>
	<tr id="r_customer_addresslineone">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_customer_addresslineone"><?php echo $customers_view->customer_addresslineone->caption() ?></span></td>
		<td data-name="customer_addresslineone" <?php echo $customers_view->customer_addresslineone->cellAttributes() ?>>
<span id="el_customers_customer_addresslineone">
<span<?php echo $customers_view->customer_addresslineone->viewAttributes() ?>><?php echo $customers_view->customer_addresslineone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->customer_addresslinetwo->Visible) { // customer_addresslinetwo ?>
	<tr id="r_customer_addresslinetwo">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_customer_addresslinetwo"><?php echo $customers_view->customer_addresslinetwo->caption() ?></span></td>
		<td data-name="customer_addresslinetwo" <?php echo $customers_view->customer_addresslinetwo->cellAttributes() ?>>
<span id="el_customers_customer_addresslinetwo">
<span<?php echo $customers_view->customer_addresslinetwo->viewAttributes() ?>><?php echo $customers_view->customer_addresslinetwo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->customer_city->Visible) { // customer_city ?>
	<tr id="r_customer_city">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_customer_city"><?php echo $customers_view->customer_city->caption() ?></span></td>
		<td data-name="customer_city" <?php echo $customers_view->customer_city->cellAttributes() ?>>
<span id="el_customers_customer_city">
<span<?php echo $customers_view->customer_city->viewAttributes() ?>><?php echo $customers_view->customer_city->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->customer_postcode->Visible) { // customer_postcode ?>
	<tr id="r_customer_postcode">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_customer_postcode"><?php echo $customers_view->customer_postcode->caption() ?></span></td>
		<td data-name="customer_postcode" <?php echo $customers_view->customer_postcode->cellAttributes() ?>>
<span id="el_customers_customer_postcode">
<span<?php echo $customers_view->customer_postcode->viewAttributes() ?>><?php echo $customers_view->customer_postcode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->customer_email->Visible) { // customer_email ?>
	<tr id="r_customer_email">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_customer_email"><?php echo $customers_view->customer_email->caption() ?></span></td>
		<td data-name="customer_email" <?php echo $customers_view->customer_email->cellAttributes() ?>>
<span id="el_customers_customer_email">
<span<?php echo $customers_view->customer_email->viewAttributes() ?>><?php echo $customers_view->customer_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->customer_username->Visible) { // customer_username ?>
	<tr id="r_customer_username">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_customer_username"><?php echo $customers_view->customer_username->caption() ?></span></td>
		<td data-name="customer_username" <?php echo $customers_view->customer_username->cellAttributes() ?>>
<span id="el_customers_customer_username">
<span<?php echo $customers_view->customer_username->viewAttributes() ?>><?php echo $customers_view->customer_username->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->customer_password->Visible) { // customer_password ?>
	<tr id="r_customer_password">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_customer_password"><?php echo $customers_view->customer_password->caption() ?></span></td>
		<td data-name="customer_password" <?php echo $customers_view->customer_password->cellAttributes() ?>>
<span id="el_customers_customer_password">
<span<?php echo $customers_view->customer_password->viewAttributes() ?>><?php echo $customers_view->customer_password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$customers_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$customers_view->isExport()) { ?>
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
$customers_view->terminate();
?>