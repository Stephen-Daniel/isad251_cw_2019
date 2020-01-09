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
$products_view = new products_view();

// Run the page
$products_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$products_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$products_view->isExport()) { ?>
<script>
var fproductsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproductsview = currentForm = new ew.Form("fproductsview", "view");
	loadjs.done("fproductsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$products_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $products_view->ExportOptions->render("body") ?>
<?php $products_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $products_view->showPageHeader(); ?>
<?php
$products_view->showMessage();
?>
<form name="fproductsview" id="fproductsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="products">
<input type="hidden" name="modal" value="<?php echo (int)$products_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($products_view->product_id->Visible) { // product_id ?>
	<tr id="r_product_id">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_product_id"><?php echo $products_view->product_id->caption() ?></span></td>
		<td data-name="product_id" <?php echo $products_view->product_id->cellAttributes() ?>>
<span id="el_products_product_id">
<span<?php echo $products_view->product_id->viewAttributes() ?>><?php echo $products_view->product_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products_view->product_name->Visible) { // product_name ?>
	<tr id="r_product_name">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_product_name"><?php echo $products_view->product_name->caption() ?></span></td>
		<td data-name="product_name" <?php echo $products_view->product_name->cellAttributes() ?>>
<span id="el_products_product_name">
<span<?php echo $products_view->product_name->viewAttributes() ?>><?php echo $products_view->product_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products_view->product_image->Visible) { // product_image ?>
	<tr id="r_product_image">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_product_image"><?php echo $products_view->product_image->caption() ?></span></td>
		<td data-name="product_image" <?php echo $products_view->product_image->cellAttributes() ?>>
<span id="el_products_product_image">
<span<?php echo $products_view->product_image->viewAttributes() ?>><?php echo $products_view->product_image->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products_view->product_description->Visible) { // product_description ?>
	<tr id="r_product_description">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_product_description"><?php echo $products_view->product_description->caption() ?></span></td>
		<td data-name="product_description" <?php echo $products_view->product_description->cellAttributes() ?>>
<span id="el_products_product_description">
<span<?php echo $products_view->product_description->viewAttributes() ?>><?php echo $products_view->product_description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($products_view->product_price->Visible) { // product_price ?>
	<tr id="r_product_price">
		<td class="<?php echo $products_view->TableLeftColumnClass ?>"><span id="elh_products_product_price"><?php echo $products_view->product_price->caption() ?></span></td>
		<td data-name="product_price" <?php echo $products_view->product_price->cellAttributes() ?>>
<span id="el_products_product_price">
<span<?php echo $products_view->product_price->viewAttributes() ?>><?php echo $products_view->product_price->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$products_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$products_view->isExport()) { ?>
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
$products_view->terminate();
?>