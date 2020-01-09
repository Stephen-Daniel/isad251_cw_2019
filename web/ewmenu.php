<?php
namespace PHPMaker2020\project1;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_admin", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "adminlist.php", -1, "", IsLoggedIn() || AllowListMenu('{B0D90454-D781-4E44-832A-8439DCD087B1}admin'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_customers", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "customerslist.php", -1, "", IsLoggedIn() || AllowListMenu('{B0D90454-D781-4E44-832A-8439DCD087B1}customers'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_orders", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "orderslist.php", -1, "", IsLoggedIn() || AllowListMenu('{B0D90454-D781-4E44-832A-8439DCD087B1}orders'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_orders_items", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "orders_itemslist.php", -1, "", IsLoggedIn() || AllowListMenu('{B0D90454-D781-4E44-832A-8439DCD087B1}orders_items'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_products", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "productslist.php", -1, "", IsLoggedIn() || AllowListMenu('{B0D90454-D781-4E44-832A-8439DCD087B1}products'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>