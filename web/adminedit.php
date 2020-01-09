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
$admin_edit = new admin_edit();

// Run the page
$admin_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$admin_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fadminedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fadminedit = currentForm = new ew.Form("fadminedit", "edit");

	// Validate form
	fadminedit.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "F")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($admin_edit->admin_Id->Required) { ?>
				elm = this.getElements("x" + infix + "_admin_Id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_edit->admin_Id->caption(), $admin_edit->admin_Id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($admin_edit->admin_firstname->Required) { ?>
				elm = this.getElements("x" + infix + "_admin_firstname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_edit->admin_firstname->caption(), $admin_edit->admin_firstname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($admin_edit->admin_lastname->Required) { ?>
				elm = this.getElements("x" + infix + "_admin_lastname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_edit->admin_lastname->caption(), $admin_edit->admin_lastname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($admin_edit->admin_email->Required) { ?>
				elm = this.getElements("x" + infix + "_admin_email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_edit->admin_email->caption(), $admin_edit->admin_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($admin_edit->admin_username->Required) { ?>
				elm = this.getElements("x" + infix + "_admin_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_edit->admin_username->caption(), $admin_edit->admin_username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($admin_edit->admin_password->Required) { ?>
				elm = this.getElements("x" + infix + "_admin_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_edit->admin_password->caption(), $admin_edit->admin_password->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fadminedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fadminedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fadminedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $admin_edit->showPageHeader(); ?>
<?php
$admin_edit->showMessage();
?>
<form name="fadminedit" id="fadminedit" class="<?php echo $admin_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="admin">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$admin_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($admin_edit->admin_Id->Visible) { // admin_Id ?>
	<div id="r_admin_Id" class="form-group row">
		<label id="elh_admin_admin_Id" class="<?php echo $admin_edit->LeftColumnClass ?>"><?php echo $admin_edit->admin_Id->caption() ?><?php echo $admin_edit->admin_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_edit->RightColumnClass ?>"><div <?php echo $admin_edit->admin_Id->cellAttributes() ?>>
<span id="el_admin_admin_Id">
<span<?php echo $admin_edit->admin_Id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($admin_edit->admin_Id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="admin" data-field="x_admin_Id" name="x_admin_Id" id="x_admin_Id" value="<?php echo HtmlEncode($admin_edit->admin_Id->CurrentValue) ?>">
<?php echo $admin_edit->admin_Id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin_edit->admin_firstname->Visible) { // admin_firstname ?>
	<div id="r_admin_firstname" class="form-group row">
		<label id="elh_admin_admin_firstname" for="x_admin_firstname" class="<?php echo $admin_edit->LeftColumnClass ?>"><?php echo $admin_edit->admin_firstname->caption() ?><?php echo $admin_edit->admin_firstname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_edit->RightColumnClass ?>"><div <?php echo $admin_edit->admin_firstname->cellAttributes() ?>>
<span id="el_admin_admin_firstname">
<input type="text" data-table="admin" data-field="x_admin_firstname" name="x_admin_firstname" id="x_admin_firstname" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($admin_edit->admin_firstname->getPlaceHolder()) ?>" value="<?php echo $admin_edit->admin_firstname->EditValue ?>"<?php echo $admin_edit->admin_firstname->editAttributes() ?>>
</span>
<?php echo $admin_edit->admin_firstname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin_edit->admin_lastname->Visible) { // admin_lastname ?>
	<div id="r_admin_lastname" class="form-group row">
		<label id="elh_admin_admin_lastname" for="x_admin_lastname" class="<?php echo $admin_edit->LeftColumnClass ?>"><?php echo $admin_edit->admin_lastname->caption() ?><?php echo $admin_edit->admin_lastname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_edit->RightColumnClass ?>"><div <?php echo $admin_edit->admin_lastname->cellAttributes() ?>>
<span id="el_admin_admin_lastname">
<input type="text" data-table="admin" data-field="x_admin_lastname" name="x_admin_lastname" id="x_admin_lastname" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($admin_edit->admin_lastname->getPlaceHolder()) ?>" value="<?php echo $admin_edit->admin_lastname->EditValue ?>"<?php echo $admin_edit->admin_lastname->editAttributes() ?>>
</span>
<?php echo $admin_edit->admin_lastname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin_edit->admin_email->Visible) { // admin_email ?>
	<div id="r_admin_email" class="form-group row">
		<label id="elh_admin_admin_email" for="x_admin_email" class="<?php echo $admin_edit->LeftColumnClass ?>"><?php echo $admin_edit->admin_email->caption() ?><?php echo $admin_edit->admin_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_edit->RightColumnClass ?>"><div <?php echo $admin_edit->admin_email->cellAttributes() ?>>
<span id="el_admin_admin_email">
<input type="text" data-table="admin" data-field="x_admin_email" name="x_admin_email" id="x_admin_email" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($admin_edit->admin_email->getPlaceHolder()) ?>" value="<?php echo $admin_edit->admin_email->EditValue ?>"<?php echo $admin_edit->admin_email->editAttributes() ?>>
</span>
<?php echo $admin_edit->admin_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin_edit->admin_username->Visible) { // admin_username ?>
	<div id="r_admin_username" class="form-group row">
		<label id="elh_admin_admin_username" for="x_admin_username" class="<?php echo $admin_edit->LeftColumnClass ?>"><?php echo $admin_edit->admin_username->caption() ?><?php echo $admin_edit->admin_username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_edit->RightColumnClass ?>"><div <?php echo $admin_edit->admin_username->cellAttributes() ?>>
<span id="el_admin_admin_username">
<input type="text" data-table="admin" data-field="x_admin_username" name="x_admin_username" id="x_admin_username" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($admin_edit->admin_username->getPlaceHolder()) ?>" value="<?php echo $admin_edit->admin_username->EditValue ?>"<?php echo $admin_edit->admin_username->editAttributes() ?>>
</span>
<?php echo $admin_edit->admin_username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin_edit->admin_password->Visible) { // admin_password ?>
	<div id="r_admin_password" class="form-group row">
		<label id="elh_admin_admin_password" for="x_admin_password" class="<?php echo $admin_edit->LeftColumnClass ?>"><?php echo $admin_edit->admin_password->caption() ?><?php echo $admin_edit->admin_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_edit->RightColumnClass ?>"><div <?php echo $admin_edit->admin_password->cellAttributes() ?>>
<span id="el_admin_admin_password">
<input type="text" data-table="admin" data-field="x_admin_password" name="x_admin_password" id="x_admin_password" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($admin_edit->admin_password->getPlaceHolder()) ?>" value="<?php echo $admin_edit->admin_password->EditValue ?>"<?php echo $admin_edit->admin_password->editAttributes() ?>>
</span>
<?php echo $admin_edit->admin_password->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$admin_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $admin_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $admin_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$admin_edit->showPageFooter();
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
$admin_edit->terminate();
?>