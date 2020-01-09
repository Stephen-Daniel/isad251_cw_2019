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
$orders_items_edit = new orders_items_edit();

// Run the page
$orders_items_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_items_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var forders_itemsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	forders_itemsedit = currentForm = new ew.Form("forders_itemsedit", "edit");

	// Validate form
	forders_itemsedit.validate = function() {
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
			<?php if ($orders_items_edit->order_id->Required) { ?>
				elm = this.getElements("x" + infix + "_order_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_items_edit->order_id->caption(), $orders_items_edit->order_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_order_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_items_edit->order_id->errorMessage()) ?>");
			<?php if ($orders_items_edit->product_id->Required) { ?>
				elm = this.getElements("x" + infix + "_product_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_items_edit->product_id->caption(), $orders_items_edit->product_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_product_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_items_edit->product_id->errorMessage()) ?>");
			<?php if ($orders_items_edit->quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_items_edit->quantity->caption(), $orders_items_edit->quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_quantity");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_items_edit->quantity->errorMessage()) ?>");

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
	forders_itemsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	forders_itemsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("forders_itemsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $orders_items_edit->showPageHeader(); ?>
<?php
$orders_items_edit->showMessage();
?>
<form name="forders_itemsedit" id="forders_itemsedit" class="<?php echo $orders_items_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders_items">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$orders_items_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($orders_items_edit->order_id->Visible) { // order_id ?>
	<div id="r_order_id" class="form-group row">
		<label id="elh_orders_items_order_id" for="x_order_id" class="<?php echo $orders_items_edit->LeftColumnClass ?>"><?php echo $orders_items_edit->order_id->caption() ?><?php echo $orders_items_edit->order_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_items_edit->RightColumnClass ?>"><div <?php echo $orders_items_edit->order_id->cellAttributes() ?>>
<input type="text" data-table="orders_items" data-field="x_order_id" name="x_order_id" id="x_order_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($orders_items_edit->order_id->getPlaceHolder()) ?>" value="<?php echo $orders_items_edit->order_id->EditValue ?>"<?php echo $orders_items_edit->order_id->editAttributes() ?>>
<input type="hidden" data-table="orders_items" data-field="x_order_id" name="o_order_id" id="o_order_id" value="<?php echo HtmlEncode($orders_items_edit->order_id->OldValue != null ? $orders_items_edit->order_id->OldValue : $orders_items_edit->order_id->CurrentValue) ?>">
<?php echo $orders_items_edit->order_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_items_edit->product_id->Visible) { // product_id ?>
	<div id="r_product_id" class="form-group row">
		<label id="elh_orders_items_product_id" for="x_product_id" class="<?php echo $orders_items_edit->LeftColumnClass ?>"><?php echo $orders_items_edit->product_id->caption() ?><?php echo $orders_items_edit->product_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_items_edit->RightColumnClass ?>"><div <?php echo $orders_items_edit->product_id->cellAttributes() ?>>
<input type="text" data-table="orders_items" data-field="x_product_id" name="x_product_id" id="x_product_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($orders_items_edit->product_id->getPlaceHolder()) ?>" value="<?php echo $orders_items_edit->product_id->EditValue ?>"<?php echo $orders_items_edit->product_id->editAttributes() ?>>
<input type="hidden" data-table="orders_items" data-field="x_product_id" name="o_product_id" id="o_product_id" value="<?php echo HtmlEncode($orders_items_edit->product_id->OldValue != null ? $orders_items_edit->product_id->OldValue : $orders_items_edit->product_id->CurrentValue) ?>">
<?php echo $orders_items_edit->product_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_items_edit->quantity->Visible) { // quantity ?>
	<div id="r_quantity" class="form-group row">
		<label id="elh_orders_items_quantity" for="x_quantity" class="<?php echo $orders_items_edit->LeftColumnClass ?>"><?php echo $orders_items_edit->quantity->caption() ?><?php echo $orders_items_edit->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_items_edit->RightColumnClass ?>"><div <?php echo $orders_items_edit->quantity->cellAttributes() ?>>
<span id="el_orders_items_quantity">
<input type="text" data-table="orders_items" data-field="x_quantity" name="x_quantity" id="x_quantity" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($orders_items_edit->quantity->getPlaceHolder()) ?>" value="<?php echo $orders_items_edit->quantity->EditValue ?>"<?php echo $orders_items_edit->quantity->editAttributes() ?>>
</span>
<?php echo $orders_items_edit->quantity->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$orders_items_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $orders_items_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orders_items_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$orders_items_edit->showPageFooter();
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
$orders_items_edit->terminate();
?>