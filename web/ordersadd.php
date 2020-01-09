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
$orders_add = new orders_add();

// Run the page
$orders_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fordersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fordersadd = currentForm = new ew.Form("fordersadd", "add");

	// Validate form
	fordersadd.validate = function() {
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
			<?php if ($orders_add->order_date->Required) { ?>
				elm = this.getElements("x" + infix + "_order_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->order_date->caption(), $orders_add->order_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_order_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_add->order_date->errorMessage()) ?>");
			<?php if ($orders_add->order_name->Required) { ?>
				elm = this.getElements("x" + infix + "_order_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->order_name->caption(), $orders_add->order_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($orders_add->order_email->Required) { ?>
				elm = this.getElements("x" + infix + "_order_email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_add->order_email->caption(), $orders_add->order_email->RequiredErrorMessage)) ?>");
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
	fordersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fordersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fordersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $orders_add->showPageHeader(); ?>
<?php
$orders_add->showMessage();
?>
<form name="fordersadd" id="fordersadd" class="<?php echo $orders_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$orders_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($orders_add->order_date->Visible) { // order_date ?>
	<div id="r_order_date" class="form-group row">
		<label id="elh_orders_order_date" for="x_order_date" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->order_date->caption() ?><?php echo $orders_add->order_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->order_date->cellAttributes() ?>>
<span id="el_orders_order_date">
<input type="text" data-table="orders" data-field="x_order_date" name="x_order_date" id="x_order_date" maxlength="19" placeholder="<?php echo HtmlEncode($orders_add->order_date->getPlaceHolder()) ?>" value="<?php echo $orders_add->order_date->EditValue ?>"<?php echo $orders_add->order_date->editAttributes() ?>>
<?php if (!$orders_add->order_date->ReadOnly && !$orders_add->order_date->Disabled && !isset($orders_add->order_date->EditAttrs["readonly"]) && !isset($orders_add->order_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fordersadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fordersadd", "x_order_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $orders_add->order_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_add->order_name->Visible) { // order_name ?>
	<div id="r_order_name" class="form-group row">
		<label id="elh_orders_order_name" for="x_order_name" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->order_name->caption() ?><?php echo $orders_add->order_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->order_name->cellAttributes() ?>>
<span id="el_orders_order_name">
<input type="text" data-table="orders" data-field="x_order_name" name="x_order_name" id="x_order_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($orders_add->order_name->getPlaceHolder()) ?>" value="<?php echo $orders_add->order_name->EditValue ?>"<?php echo $orders_add->order_name->editAttributes() ?>>
</span>
<?php echo $orders_add->order_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_add->order_email->Visible) { // order_email ?>
	<div id="r_order_email" class="form-group row">
		<label id="elh_orders_order_email" for="x_order_email" class="<?php echo $orders_add->LeftColumnClass ?>"><?php echo $orders_add->order_email->caption() ?><?php echo $orders_add->order_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_add->RightColumnClass ?>"><div <?php echo $orders_add->order_email->cellAttributes() ?>>
<span id="el_orders_order_email">
<input type="text" data-table="orders" data-field="x_order_email" name="x_order_email" id="x_order_email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($orders_add->order_email->getPlaceHolder()) ?>" value="<?php echo $orders_add->order_email->EditValue ?>"<?php echo $orders_add->order_email->editAttributes() ?>>
</span>
<?php echo $orders_add->order_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$orders_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $orders_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orders_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$orders_add->showPageFooter();
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
$orders_add->terminate();
?>