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
$admin_view = new admin_view();

// Run the page
$admin_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$admin_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$admin_view->isExport()) { ?>
<script>
var fadminview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fadminview = currentForm = new ew.Form("fadminview", "view");
	loadjs.done("fadminview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$admin_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $admin_view->ExportOptions->render("body") ?>
<?php $admin_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $admin_view->showPageHeader(); ?>
<?php
$admin_view->showMessage();
?>
<form name="fadminview" id="fadminview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="admin">
<input type="hidden" name="modal" value="<?php echo (int)$admin_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($admin_view->admin_Id->Visible) { // admin_Id ?>
	<tr id="r_admin_Id">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_admin_Id"><?php echo $admin_view->admin_Id->caption() ?></span></td>
		<td data-name="admin_Id" <?php echo $admin_view->admin_Id->cellAttributes() ?>>
<span id="el_admin_admin_Id">
<span<?php echo $admin_view->admin_Id->viewAttributes() ?>><?php echo $admin_view->admin_Id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin_view->admin_firstname->Visible) { // admin_firstname ?>
	<tr id="r_admin_firstname">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_admin_firstname"><?php echo $admin_view->admin_firstname->caption() ?></span></td>
		<td data-name="admin_firstname" <?php echo $admin_view->admin_firstname->cellAttributes() ?>>
<span id="el_admin_admin_firstname">
<span<?php echo $admin_view->admin_firstname->viewAttributes() ?>><?php echo $admin_view->admin_firstname->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin_view->admin_lastname->Visible) { // admin_lastname ?>
	<tr id="r_admin_lastname">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_admin_lastname"><?php echo $admin_view->admin_lastname->caption() ?></span></td>
		<td data-name="admin_lastname" <?php echo $admin_view->admin_lastname->cellAttributes() ?>>
<span id="el_admin_admin_lastname">
<span<?php echo $admin_view->admin_lastname->viewAttributes() ?>><?php echo $admin_view->admin_lastname->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin_view->admin_email->Visible) { // admin_email ?>
	<tr id="r_admin_email">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_admin_email"><?php echo $admin_view->admin_email->caption() ?></span></td>
		<td data-name="admin_email" <?php echo $admin_view->admin_email->cellAttributes() ?>>
<span id="el_admin_admin_email">
<span<?php echo $admin_view->admin_email->viewAttributes() ?>><?php echo $admin_view->admin_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin_view->admin_username->Visible) { // admin_username ?>
	<tr id="r_admin_username">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_admin_username"><?php echo $admin_view->admin_username->caption() ?></span></td>
		<td data-name="admin_username" <?php echo $admin_view->admin_username->cellAttributes() ?>>
<span id="el_admin_admin_username">
<span<?php echo $admin_view->admin_username->viewAttributes() ?>><?php echo $admin_view->admin_username->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin_view->admin_password->Visible) { // admin_password ?>
	<tr id="r_admin_password">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_admin_password"><?php echo $admin_view->admin_password->caption() ?></span></td>
		<td data-name="admin_password" <?php echo $admin_view->admin_password->cellAttributes() ?>>
<span id="el_admin_admin_password">
<span<?php echo $admin_view->admin_password->viewAttributes() ?>><?php echo $admin_view->admin_password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$admin_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$admin_view->isExport()) { ?>
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
$admin_view->terminate();
?>