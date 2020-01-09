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
$products_add = new products_add();

// Run the page
$products_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$products_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproductsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fproductsadd = currentForm = new ew.Form("fproductsadd", "add");

	// Validate form
	fproductsadd.validate = function() {
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
			<?php if ($products_add->product_name->Required) { ?>
				elm = this.getElements("x" + infix + "_product_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_add->product_name->caption(), $products_add->product_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($products_add->product_image->Required) { ?>
				elm = this.getElements("x" + infix + "_product_image");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_add->product_image->caption(), $products_add->product_image->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($products_add->product_description->Required) { ?>
				elm = this.getElements("x" + infix + "_product_description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_add->product_description->caption(), $products_add->product_description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($products_add->product_price->Required) { ?>
				elm = this.getElements("x" + infix + "_product_price");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $products_add->product_price->caption(), $products_add->product_price->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_product_price");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($products_add->product_price->errorMessage()) ?>");

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
	fproductsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproductsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproductsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $products_add->showPageHeader(); ?>
<?php
$products_add->showMessage();
?>
<form name="fproductsadd" id="fproductsadd" class="<?php echo $products_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="products">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$products_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($products_add->product_name->Visible) { // product_name ?>
	<div id="r_product_name" class="form-group row">
		<label id="elh_products_product_name" for="x_product_name" class="<?php echo $products_add->LeftColumnClass ?>"><?php echo $products_add->product_name->caption() ?><?php echo $products_add->product_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_add->RightColumnClass ?>"><div <?php echo $products_add->product_name->cellAttributes() ?>>
<span id="el_products_product_name">
<input type="text" data-table="products" data-field="x_product_name" name="x_product_name" id="x_product_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($products_add->product_name->getPlaceHolder()) ?>" value="<?php echo $products_add->product_name->EditValue ?>"<?php echo $products_add->product_name->editAttributes() ?>>
</span>
<?php echo $products_add->product_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_add->product_image->Visible) { // product_image ?>
	<div id="r_product_image" class="form-group row">
		<label id="elh_products_product_image" for="x_product_image" class="<?php echo $products_add->LeftColumnClass ?>"><?php echo $products_add->product_image->caption() ?><?php echo $products_add->product_image->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_add->RightColumnClass ?>"><div <?php echo $products_add->product_image->cellAttributes() ?>>
<span id="el_products_product_image">
<input type="text" data-table="products" data-field="x_product_image" name="x_product_image" id="x_product_image" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($products_add->product_image->getPlaceHolder()) ?>" value="<?php echo $products_add->product_image->EditValue ?>"<?php echo $products_add->product_image->editAttributes() ?>>
</span>
<?php echo $products_add->product_image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_add->product_description->Visible) { // product_description ?>
	<div id="r_product_description" class="form-group row">
		<label id="elh_products_product_description" for="x_product_description" class="<?php echo $products_add->LeftColumnClass ?>"><?php echo $products_add->product_description->caption() ?><?php echo $products_add->product_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_add->RightColumnClass ?>"><div <?php echo $products_add->product_description->cellAttributes() ?>>
<span id="el_products_product_description">
<textarea data-table="products" data-field="x_product_description" name="x_product_description" id="x_product_description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($products_add->product_description->getPlaceHolder()) ?>"<?php echo $products_add->product_description->editAttributes() ?>><?php echo $products_add->product_description->EditValue ?></textarea>
</span>
<?php echo $products_add->product_description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($products_add->product_price->Visible) { // product_price ?>
	<div id="r_product_price" class="form-group row">
		<label id="elh_products_product_price" for="x_product_price" class="<?php echo $products_add->LeftColumnClass ?>"><?php echo $products_add->product_price->caption() ?><?php echo $products_add->product_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $products_add->RightColumnClass ?>"><div <?php echo $products_add->product_price->cellAttributes() ?>>
<span id="el_products_product_price">
<input type="text" data-table="products" data-field="x_product_price" name="x_product_price" id="x_product_price" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($products_add->product_price->getPlaceHolder()) ?>" value="<?php echo $products_add->product_price->EditValue ?>"<?php echo $products_add->product_price->editAttributes() ?>>
</span>
<?php echo $products_add->product_price->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$products_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $products_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $products_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$products_add->showPageFooter();
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
$products_add->terminate();
?>