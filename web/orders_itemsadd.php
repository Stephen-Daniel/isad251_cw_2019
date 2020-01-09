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
$orders_items_add = new orders_items_add();

// Run the page
$orders_items_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_items_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var forders_itemsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	forders_itemsadd = currentForm = new ew.Form("forders_itemsadd", "add");

	// Validate form
	forders_itemsadd.validate = function() {
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
			<?php if ($orders_items_add->order_id->Required) { ?>
				elm = this.getElements("x" + infix + "_order_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_items_add->order_id->caption(), $orders_items_add->order_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_order_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_items_add->order_id->errorMessage()) ?>");
			<?php if ($orders_items_add->product_id->Required) { ?>
				elm = this.getElements("x" + infix + "_product_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_items_add->product_id->caption(), $orders_items_add->product_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_product_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_items_add->product_id->errorMessage()) ?>");
			<?php if ($orders_items_add->quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders_items_add->quantity->caption(), $orders_items_add->quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_quantity");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($orders_items_add->quantity->errorMessage()) ?>");

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
	forders_itemsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	forders_itemsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("forders_itemsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $orders_items_add->showPageHeader(); ?>
<?php
$orders_items_add->showMessage();
?>
<form name="forders_itemsadd" id="forders_itemsadd" class="<?php echo $orders_items_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders_items">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$orders_items_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($orders_items_add->order_id->Visible) { // order_id ?>
	<div id="r_order_id" class="form-group row">
		<label id="elh_orders_items_order_id" for="x_order_id" class="<?php echo $orders_items_add->LeftColumnClass ?>"><?php echo $orders_items_add->order_id->caption() ?><?php echo $orders_items_add->order_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_items_add->RightColumnClass ?>"><div <?php echo $orders_items_add->order_id->cellAttributes() ?>>
<span id="el_orders_items_order_id">
<input type="text" data-table="orders_items" data-field="x_order_id" name="x_order_id" id="x_order_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($orders_items_add->order_id->getPlaceHolder()) ?>" value="<?php echo $orders_items_add->order_id->EditValue ?>"<?php echo $orders_items_add->order_id->editAttributes() ?>>
</span>
<?php echo $orders_items_add->order_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_items_add->product_id->Visible) { // product_id ?>
	<div id="r_product_id" class="form-group row">
		<label id="elh_orders_items_product_id" for="x_product_id" class="<?php echo $orders_items_add->LeftColumnClass ?>"><?php echo $orders_items_add->product_id->caption() ?><?php echo $orders_items_add->product_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_items_add->RightColumnClass ?>"><div <?php echo $orders_items_add->product_id->cellAttributes() ?>>
<span id="el_orders_items_product_id">
<input type="text" data-table="orders_items" data-field="x_product_id" name="x_product_id" id="x_product_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($orders_items_add->product_id->getPlaceHolder()) ?>" value="<?php echo $orders_items_add->product_id->EditValue ?>"<?php echo $orders_items_add->product_id->editAttributes() ?>>
</span>
<?php echo $orders_items_add->product_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders_items_add->quantity->Visible) { // quantity ?>
	<div id="r_quantity" class="form-group row">
		<label id="elh_orders_items_quantity" for="x_quantity" class="<?php echo $orders_items_add->LeftColumnClass ?>"><?php echo $orders_items_add->quantity->caption() ?><?php echo $orders_items_add->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_items_add->RightColumnClass ?>"><div <?php echo $orders_items_add->quantity->cellAttributes() ?>>
<span id="el_orders_items_quantity">
<input type="text" data-table="orders_items" data-field="x_quantity" name="x_quantity" id="x_quantity" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($orders_items_add->quantity->getPlaceHolder()) ?>" value="<?php echo $orders_items_add->quantity->EditValue ?>"<?php echo $orders_items_add->quantity->editAttributes() ?>>
</span>
<?php echo $orders_items_add->quantity->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$orders_items_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $orders_items_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orders_items_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$orders_items_add->showPageFooter();
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
$orders_items_add->terminate();
?>