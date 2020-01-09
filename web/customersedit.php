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
$customers_edit = new customers_edit();

// Run the page
$customers_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcustomersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcustomersedit = currentForm = new ew.Form("fcustomersedit", "edit");

	// Validate form
	fcustomersedit.validate = function() {
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
			<?php if ($customers_edit->customer_Id->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_Id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->customer_Id->caption(), $customers_edit->customer_Id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->customer_firstname->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_firstname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->customer_firstname->caption(), $customers_edit->customer_firstname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->customer_lastname->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_lastname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->customer_lastname->caption(), $customers_edit->customer_lastname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->customer_addresslineone->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_addresslineone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->customer_addresslineone->caption(), $customers_edit->customer_addresslineone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->customer_addresslinetwo->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_addresslinetwo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->customer_addresslinetwo->caption(), $customers_edit->customer_addresslinetwo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->customer_city->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_city");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->customer_city->caption(), $customers_edit->customer_city->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->customer_postcode->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_postcode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->customer_postcode->caption(), $customers_edit->customer_postcode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->customer_email->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->customer_email->caption(), $customers_edit->customer_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->customer_username->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->customer_username->caption(), $customers_edit->customer_username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->customer_password->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->customer_password->caption(), $customers_edit->customer_password->RequiredErrorMessage)) ?>");
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
	fcustomersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcustomersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcustomersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $customers_edit->showPageHeader(); ?>
<?php
$customers_edit->showMessage();
?>
<form name="fcustomersedit" id="fcustomersedit" class="<?php echo $customers_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$customers_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($customers_edit->customer_Id->Visible) { // customer_Id ?>
	<div id="r_customer_Id" class="form-group row">
		<label id="elh_customers_customer_Id" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->customer_Id->caption() ?><?php echo $customers_edit->customer_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->customer_Id->cellAttributes() ?>>
<span id="el_customers_customer_Id">
<span<?php echo $customers_edit->customer_Id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($customers_edit->customer_Id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="customers" data-field="x_customer_Id" name="x_customer_Id" id="x_customer_Id" value="<?php echo HtmlEncode($customers_edit->customer_Id->CurrentValue) ?>">
<?php echo $customers_edit->customer_Id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->customer_firstname->Visible) { // customer_firstname ?>
	<div id="r_customer_firstname" class="form-group row">
		<label id="elh_customers_customer_firstname" for="x_customer_firstname" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->customer_firstname->caption() ?><?php echo $customers_edit->customer_firstname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->customer_firstname->cellAttributes() ?>>
<span id="el_customers_customer_firstname">
<input type="text" data-table="customers" data-field="x_customer_firstname" name="x_customer_firstname" id="x_customer_firstname" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($customers_edit->customer_firstname->getPlaceHolder()) ?>" value="<?php echo $customers_edit->customer_firstname->EditValue ?>"<?php echo $customers_edit->customer_firstname->editAttributes() ?>>
</span>
<?php echo $customers_edit->customer_firstname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->customer_lastname->Visible) { // customer_lastname ?>
	<div id="r_customer_lastname" class="form-group row">
		<label id="elh_customers_customer_lastname" for="x_customer_lastname" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->customer_lastname->caption() ?><?php echo $customers_edit->customer_lastname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->customer_lastname->cellAttributes() ?>>
<span id="el_customers_customer_lastname">
<input type="text" data-table="customers" data-field="x_customer_lastname" name="x_customer_lastname" id="x_customer_lastname" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($customers_edit->customer_lastname->getPlaceHolder()) ?>" value="<?php echo $customers_edit->customer_lastname->EditValue ?>"<?php echo $customers_edit->customer_lastname->editAttributes() ?>>
</span>
<?php echo $customers_edit->customer_lastname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->customer_addresslineone->Visible) { // customer_addresslineone ?>
	<div id="r_customer_addresslineone" class="form-group row">
		<label id="elh_customers_customer_addresslineone" for="x_customer_addresslineone" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->customer_addresslineone->caption() ?><?php echo $customers_edit->customer_addresslineone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->customer_addresslineone->cellAttributes() ?>>
<span id="el_customers_customer_addresslineone">
<input type="text" data-table="customers" data-field="x_customer_addresslineone" name="x_customer_addresslineone" id="x_customer_addresslineone" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($customers_edit->customer_addresslineone->getPlaceHolder()) ?>" value="<?php echo $customers_edit->customer_addresslineone->EditValue ?>"<?php echo $customers_edit->customer_addresslineone->editAttributes() ?>>
</span>
<?php echo $customers_edit->customer_addresslineone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->customer_addresslinetwo->Visible) { // customer_addresslinetwo ?>
	<div id="r_customer_addresslinetwo" class="form-group row">
		<label id="elh_customers_customer_addresslinetwo" for="x_customer_addresslinetwo" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->customer_addresslinetwo->caption() ?><?php echo $customers_edit->customer_addresslinetwo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->customer_addresslinetwo->cellAttributes() ?>>
<span id="el_customers_customer_addresslinetwo">
<input type="text" data-table="customers" data-field="x_customer_addresslinetwo" name="x_customer_addresslinetwo" id="x_customer_addresslinetwo" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($customers_edit->customer_addresslinetwo->getPlaceHolder()) ?>" value="<?php echo $customers_edit->customer_addresslinetwo->EditValue ?>"<?php echo $customers_edit->customer_addresslinetwo->editAttributes() ?>>
</span>
<?php echo $customers_edit->customer_addresslinetwo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->customer_city->Visible) { // customer_city ?>
	<div id="r_customer_city" class="form-group row">
		<label id="elh_customers_customer_city" for="x_customer_city" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->customer_city->caption() ?><?php echo $customers_edit->customer_city->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->customer_city->cellAttributes() ?>>
<span id="el_customers_customer_city">
<input type="text" data-table="customers" data-field="x_customer_city" name="x_customer_city" id="x_customer_city" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($customers_edit->customer_city->getPlaceHolder()) ?>" value="<?php echo $customers_edit->customer_city->EditValue ?>"<?php echo $customers_edit->customer_city->editAttributes() ?>>
</span>
<?php echo $customers_edit->customer_city->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->customer_postcode->Visible) { // customer_postcode ?>
	<div id="r_customer_postcode" class="form-group row">
		<label id="elh_customers_customer_postcode" for="x_customer_postcode" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->customer_postcode->caption() ?><?php echo $customers_edit->customer_postcode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->customer_postcode->cellAttributes() ?>>
<span id="el_customers_customer_postcode">
<input type="text" data-table="customers" data-field="x_customer_postcode" name="x_customer_postcode" id="x_customer_postcode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($customers_edit->customer_postcode->getPlaceHolder()) ?>" value="<?php echo $customers_edit->customer_postcode->EditValue ?>"<?php echo $customers_edit->customer_postcode->editAttributes() ?>>
</span>
<?php echo $customers_edit->customer_postcode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->customer_email->Visible) { // customer_email ?>
	<div id="r_customer_email" class="form-group row">
		<label id="elh_customers_customer_email" for="x_customer_email" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->customer_email->caption() ?><?php echo $customers_edit->customer_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->customer_email->cellAttributes() ?>>
<span id="el_customers_customer_email">
<input type="text" data-table="customers" data-field="x_customer_email" name="x_customer_email" id="x_customer_email" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($customers_edit->customer_email->getPlaceHolder()) ?>" value="<?php echo $customers_edit->customer_email->EditValue ?>"<?php echo $customers_edit->customer_email->editAttributes() ?>>
</span>
<?php echo $customers_edit->customer_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->customer_username->Visible) { // customer_username ?>
	<div id="r_customer_username" class="form-group row">
		<label id="elh_customers_customer_username" for="x_customer_username" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->customer_username->caption() ?><?php echo $customers_edit->customer_username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->customer_username->cellAttributes() ?>>
<span id="el_customers_customer_username">
<input type="text" data-table="customers" data-field="x_customer_username" name="x_customer_username" id="x_customer_username" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($customers_edit->customer_username->getPlaceHolder()) ?>" value="<?php echo $customers_edit->customer_username->EditValue ?>"<?php echo $customers_edit->customer_username->editAttributes() ?>>
</span>
<?php echo $customers_edit->customer_username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->customer_password->Visible) { // customer_password ?>
	<div id="r_customer_password" class="form-group row">
		<label id="elh_customers_customer_password" for="x_customer_password" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->customer_password->caption() ?><?php echo $customers_edit->customer_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->customer_password->cellAttributes() ?>>
<span id="el_customers_customer_password">
<input type="text" data-table="customers" data-field="x_customer_password" name="x_customer_password" id="x_customer_password" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($customers_edit->customer_password->getPlaceHolder()) ?>" value="<?php echo $customers_edit->customer_password->EditValue ?>"<?php echo $customers_edit->customer_password->editAttributes() ?>>
</span>
<?php echo $customers_edit->customer_password->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$customers_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $customers_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $customers_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$customers_edit->showPageFooter();
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
$customers_edit->terminate();
?>