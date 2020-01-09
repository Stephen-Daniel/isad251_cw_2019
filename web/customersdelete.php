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
$customers_delete = new customers_delete();

// Run the page
$customers_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcustomersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcustomersdelete = currentForm = new ew.Form("fcustomersdelete", "delete");
	loadjs.done("fcustomersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $customers_delete->showPageHeader(); ?>
<?php
$customers_delete->showMessage();
?>
<form name="fcustomersdelete" id="fcustomersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($customers_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($customers_delete->customer_Id->Visible) { // customer_Id ?>
		<th class="<?php echo $customers_delete->customer_Id->headerCellClass() ?>"><span id="elh_customers_customer_Id" class="customers_customer_Id"><?php echo $customers_delete->customer_Id->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->customer_firstname->Visible) { // customer_firstname ?>
		<th class="<?php echo $customers_delete->customer_firstname->headerCellClass() ?>"><span id="elh_customers_customer_firstname" class="customers_customer_firstname"><?php echo $customers_delete->customer_firstname->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->customer_lastname->Visible) { // customer_lastname ?>
		<th class="<?php echo $customers_delete->customer_lastname->headerCellClass() ?>"><span id="elh_customers_customer_lastname" class="customers_customer_lastname"><?php echo $customers_delete->customer_lastname->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->customer_addresslineone->Visible) { // customer_addresslineone ?>
		<th class="<?php echo $customers_delete->customer_addresslineone->headerCellClass() ?>"><span id="elh_customers_customer_addresslineone" class="customers_customer_addresslineone"><?php echo $customers_delete->customer_addresslineone->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->customer_addresslinetwo->Visible) { // customer_addresslinetwo ?>
		<th class="<?php echo $customers_delete->customer_addresslinetwo->headerCellClass() ?>"><span id="elh_customers_customer_addresslinetwo" class="customers_customer_addresslinetwo"><?php echo $customers_delete->customer_addresslinetwo->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->customer_city->Visible) { // customer_city ?>
		<th class="<?php echo $customers_delete->customer_city->headerCellClass() ?>"><span id="elh_customers_customer_city" class="customers_customer_city"><?php echo $customers_delete->customer_city->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->customer_postcode->Visible) { // customer_postcode ?>
		<th class="<?php echo $customers_delete->customer_postcode->headerCellClass() ?>"><span id="elh_customers_customer_postcode" class="customers_customer_postcode"><?php echo $customers_delete->customer_postcode->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->customer_email->Visible) { // customer_email ?>
		<th class="<?php echo $customers_delete->customer_email->headerCellClass() ?>"><span id="elh_customers_customer_email" class="customers_customer_email"><?php echo $customers_delete->customer_email->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->customer_username->Visible) { // customer_username ?>
		<th class="<?php echo $customers_delete->customer_username->headerCellClass() ?>"><span id="elh_customers_customer_username" class="customers_customer_username"><?php echo $customers_delete->customer_username->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->customer_password->Visible) { // customer_password ?>
		<th class="<?php echo $customers_delete->customer_password->headerCellClass() ?>"><span id="elh_customers_customer_password" class="customers_customer_password"><?php echo $customers_delete->customer_password->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$customers_delete->RecordCount = 0;
$i = 0;
while (!$customers_delete->Recordset->EOF) {
	$customers_delete->RecordCount++;
	$customers_delete->RowCount++;

	// Set row properties
	$customers->resetAttributes();
	$customers->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$customers_delete->loadRowValues($customers_delete->Recordset);

	// Render row
	$customers_delete->renderRow();
?>
	<tr <?php echo $customers->rowAttributes() ?>>
<?php if ($customers_delete->customer_Id->Visible) { // customer_Id ?>
		<td <?php echo $customers_delete->customer_Id->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_customer_Id" class="customers_customer_Id">
<span<?php echo $customers_delete->customer_Id->viewAttributes() ?>><?php echo $customers_delete->customer_Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->customer_firstname->Visible) { // customer_firstname ?>
		<td <?php echo $customers_delete->customer_firstname->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_customer_firstname" class="customers_customer_firstname">
<span<?php echo $customers_delete->customer_firstname->viewAttributes() ?>><?php echo $customers_delete->customer_firstname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->customer_lastname->Visible) { // customer_lastname ?>
		<td <?php echo $customers_delete->customer_lastname->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_customer_lastname" class="customers_customer_lastname">
<span<?php echo $customers_delete->customer_lastname->viewAttributes() ?>><?php echo $customers_delete->customer_lastname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->customer_addresslineone->Visible) { // customer_addresslineone ?>
		<td <?php echo $customers_delete->customer_addresslineone->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_customer_addresslineone" class="customers_customer_addresslineone">
<span<?php echo $customers_delete->customer_addresslineone->viewAttributes() ?>><?php echo $customers_delete->customer_addresslineone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->customer_addresslinetwo->Visible) { // customer_addresslinetwo ?>
		<td <?php echo $customers_delete->customer_addresslinetwo->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_customer_addresslinetwo" class="customers_customer_addresslinetwo">
<span<?php echo $customers_delete->customer_addresslinetwo->viewAttributes() ?>><?php echo $customers_delete->customer_addresslinetwo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->customer_city->Visible) { // customer_city ?>
		<td <?php echo $customers_delete->customer_city->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_customer_city" class="customers_customer_city">
<span<?php echo $customers_delete->customer_city->viewAttributes() ?>><?php echo $customers_delete->customer_city->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->customer_postcode->Visible) { // customer_postcode ?>
		<td <?php echo $customers_delete->customer_postcode->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_customer_postcode" class="customers_customer_postcode">
<span<?php echo $customers_delete->customer_postcode->viewAttributes() ?>><?php echo $customers_delete->customer_postcode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->customer_email->Visible) { // customer_email ?>
		<td <?php echo $customers_delete->customer_email->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_customer_email" class="customers_customer_email">
<span<?php echo $customers_delete->customer_email->viewAttributes() ?>><?php echo $customers_delete->customer_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->customer_username->Visible) { // customer_username ?>
		<td <?php echo $customers_delete->customer_username->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_customer_username" class="customers_customer_username">
<span<?php echo $customers_delete->customer_username->viewAttributes() ?>><?php echo $customers_delete->customer_username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->customer_password->Visible) { // customer_password ?>
		<td <?php echo $customers_delete->customer_password->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_customer_password" class="customers_customer_password">
<span<?php echo $customers_delete->customer_password->viewAttributes() ?>><?php echo $customers_delete->customer_password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$customers_delete->Recordset->moveNext();
}
$customers_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $customers_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$customers_delete->showPageFooter();
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
$customers_delete->terminate();
?>