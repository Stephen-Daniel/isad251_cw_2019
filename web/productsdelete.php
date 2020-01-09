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
$products_delete = new products_delete();

// Run the page
$products_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$products_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproductsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproductsdelete = currentForm = new ew.Form("fproductsdelete", "delete");
	loadjs.done("fproductsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $products_delete->showPageHeader(); ?>
<?php
$products_delete->showMessage();
?>
<form name="fproductsdelete" id="fproductsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="products">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($products_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($products_delete->product_id->Visible) { // product_id ?>
		<th class="<?php echo $products_delete->product_id->headerCellClass() ?>"><span id="elh_products_product_id" class="products_product_id"><?php echo $products_delete->product_id->caption() ?></span></th>
<?php } ?>
<?php if ($products_delete->product_name->Visible) { // product_name ?>
		<th class="<?php echo $products_delete->product_name->headerCellClass() ?>"><span id="elh_products_product_name" class="products_product_name"><?php echo $products_delete->product_name->caption() ?></span></th>
<?php } ?>
<?php if ($products_delete->product_image->Visible) { // product_image ?>
		<th class="<?php echo $products_delete->product_image->headerCellClass() ?>"><span id="elh_products_product_image" class="products_product_image"><?php echo $products_delete->product_image->caption() ?></span></th>
<?php } ?>
<?php if ($products_delete->product_price->Visible) { // product_price ?>
		<th class="<?php echo $products_delete->product_price->headerCellClass() ?>"><span id="elh_products_product_price" class="products_product_price"><?php echo $products_delete->product_price->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$products_delete->RecordCount = 0;
$i = 0;
while (!$products_delete->Recordset->EOF) {
	$products_delete->RecordCount++;
	$products_delete->RowCount++;

	// Set row properties
	$products->resetAttributes();
	$products->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$products_delete->loadRowValues($products_delete->Recordset);

	// Render row
	$products_delete->renderRow();
?>
	<tr <?php echo $products->rowAttributes() ?>>
<?php if ($products_delete->product_id->Visible) { // product_id ?>
		<td <?php echo $products_delete->product_id->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCount ?>_products_product_id" class="products_product_id">
<span<?php echo $products_delete->product_id->viewAttributes() ?>><?php echo $products_delete->product_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products_delete->product_name->Visible) { // product_name ?>
		<td <?php echo $products_delete->product_name->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCount ?>_products_product_name" class="products_product_name">
<span<?php echo $products_delete->product_name->viewAttributes() ?>><?php echo $products_delete->product_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products_delete->product_image->Visible) { // product_image ?>
		<td <?php echo $products_delete->product_image->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCount ?>_products_product_image" class="products_product_image">
<span<?php echo $products_delete->product_image->viewAttributes() ?>><?php echo $products_delete->product_image->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($products_delete->product_price->Visible) { // product_price ?>
		<td <?php echo $products_delete->product_price->cellAttributes() ?>>
<span id="el<?php echo $products_delete->RowCount ?>_products_product_price" class="products_product_price">
<span<?php echo $products_delete->product_price->viewAttributes() ?>><?php echo $products_delete->product_price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$products_delete->Recordset->moveNext();
}
$products_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $products_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$products_delete->showPageFooter();
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
$products_delete->terminate();
?>