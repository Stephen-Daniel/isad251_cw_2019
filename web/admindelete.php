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
$admin_delete = new admin_delete();

// Run the page
$admin_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$admin_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fadmindelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fadmindelete = currentForm = new ew.Form("fadmindelete", "delete");
	loadjs.done("fadmindelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $admin_delete->showPageHeader(); ?>
<?php
$admin_delete->showMessage();
?>
<form name="fadmindelete" id="fadmindelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="admin">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($admin_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($admin_delete->admin_Id->Visible) { // admin_Id ?>
		<th class="<?php echo $admin_delete->admin_Id->headerCellClass() ?>"><span id="elh_admin_admin_Id" class="admin_admin_Id"><?php echo $admin_delete->admin_Id->caption() ?></span></th>
<?php } ?>
<?php if ($admin_delete->admin_firstname->Visible) { // admin_firstname ?>
		<th class="<?php echo $admin_delete->admin_firstname->headerCellClass() ?>"><span id="elh_admin_admin_firstname" class="admin_admin_firstname"><?php echo $admin_delete->admin_firstname->caption() ?></span></th>
<?php } ?>
<?php if ($admin_delete->admin_lastname->Visible) { // admin_lastname ?>
		<th class="<?php echo $admin_delete->admin_lastname->headerCellClass() ?>"><span id="elh_admin_admin_lastname" class="admin_admin_lastname"><?php echo $admin_delete->admin_lastname->caption() ?></span></th>
<?php } ?>
<?php if ($admin_delete->admin_email->Visible) { // admin_email ?>
		<th class="<?php echo $admin_delete->admin_email->headerCellClass() ?>"><span id="elh_admin_admin_email" class="admin_admin_email"><?php echo $admin_delete->admin_email->caption() ?></span></th>
<?php } ?>
<?php if ($admin_delete->admin_username->Visible) { // admin_username ?>
		<th class="<?php echo $admin_delete->admin_username->headerCellClass() ?>"><span id="elh_admin_admin_username" class="admin_admin_username"><?php echo $admin_delete->admin_username->caption() ?></span></th>
<?php } ?>
<?php if ($admin_delete->admin_password->Visible) { // admin_password ?>
		<th class="<?php echo $admin_delete->admin_password->headerCellClass() ?>"><span id="elh_admin_admin_password" class="admin_admin_password"><?php echo $admin_delete->admin_password->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$admin_delete->RecordCount = 0;
$i = 0;
while (!$admin_delete->Recordset->EOF) {
	$admin_delete->RecordCount++;
	$admin_delete->RowCount++;

	// Set row properties
	$admin->resetAttributes();
	$admin->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$admin_delete->loadRowValues($admin_delete->Recordset);

	// Render row
	$admin_delete->renderRow();
?>
	<tr <?php echo $admin->rowAttributes() ?>>
<?php if ($admin_delete->admin_Id->Visible) { // admin_Id ?>
		<td <?php echo $admin_delete->admin_Id->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCount ?>_admin_admin_Id" class="admin_admin_Id">
<span<?php echo $admin_delete->admin_Id->viewAttributes() ?>><?php echo $admin_delete->admin_Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin_delete->admin_firstname->Visible) { // admin_firstname ?>
		<td <?php echo $admin_delete->admin_firstname->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCount ?>_admin_admin_firstname" class="admin_admin_firstname">
<span<?php echo $admin_delete->admin_firstname->viewAttributes() ?>><?php echo $admin_delete->admin_firstname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin_delete->admin_lastname->Visible) { // admin_lastname ?>
		<td <?php echo $admin_delete->admin_lastname->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCount ?>_admin_admin_lastname" class="admin_admin_lastname">
<span<?php echo $admin_delete->admin_lastname->viewAttributes() ?>><?php echo $admin_delete->admin_lastname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin_delete->admin_email->Visible) { // admin_email ?>
		<td <?php echo $admin_delete->admin_email->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCount ?>_admin_admin_email" class="admin_admin_email">
<span<?php echo $admin_delete->admin_email->viewAttributes() ?>><?php echo $admin_delete->admin_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin_delete->admin_username->Visible) { // admin_username ?>
		<td <?php echo $admin_delete->admin_username->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCount ?>_admin_admin_username" class="admin_admin_username">
<span<?php echo $admin_delete->admin_username->viewAttributes() ?>><?php echo $admin_delete->admin_username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin_delete->admin_password->Visible) { // admin_password ?>
		<td <?php echo $admin_delete->admin_password->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCount ?>_admin_admin_password" class="admin_admin_password">
<span<?php echo $admin_delete->admin_password->viewAttributes() ?>><?php echo $admin_delete->admin_password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$admin_delete->Recordset->moveNext();
}
$admin_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $admin_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$admin_delete->showPageFooter();
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
$admin_delete->terminate();
?>