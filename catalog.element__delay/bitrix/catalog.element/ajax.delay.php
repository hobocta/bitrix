<?
error_reporting(0);
ini_set("display_errors", FALSE);
ini_set("display_startup_errors", FALSE);
define("NO_KEEP_STATISTIC", true);
define("PUBLIC_AJAX_MODE", true);
define("STOP_STATISTICS", true);
define("NO_AGENT_STATISTIC", true);
define("NO_AGENT_CHECK", true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (!\Bitrix\Main\Loader::includeModule("iblock")) {
	ShowError('Module iblock is not loaded');
	return;
}
if (!\Bitrix\Main\Loader::includeModule("catalog")) {
	ShowError('Module catalog is not loaded');
	return;
}
if (!\Bitrix\Main\Loader::includeModule("sale")) {
	ShowError('Module sale is not loaded');
	return;
}

// check fields
if (!empty($_REQUEST['productid'])) {
	$productid = (int) $_REQUEST['productid'];
}
if (empty($productid)) {
	ShowError('$_REQUEST["productid"] is empty');
	return;
}

// get product name
$arProduct = CIBlockElement::GetById($productid)->Fetch();
if (!$arProduct) {
	ShowError('$arProduct is empty');
	true;
}

// get product price
$arPrice = CCatalogProduct::GetOptimalPrice(
	$arProduct['ID'],
	1,
	$USER->GetUserGroupArray() 
);
if (empty($arPrice['PRICE']['PRICE'])) {
	ShowError('$arPrice["PRICE"]["PRICE"] is empty');
}

// add product to basket
$arBasket = array(
	'PRODUCT_ID' => $arProduct['ID'],
	'PRODUCT_PRICE_ID' => $arPrice['PRICE']['ID'],
	'PRICE' => $arPrice['PRICE']['PRICE'],
	'CURRENCY' => $arPrice['PRICE']['CURRENCY'],
	'LID' => $arProduct['LID'],
	'DELAY' => 'Y',
	'NAME' => $arProduct['NAME'],
);
$result = CSaleBasket::Add($arBasket);

// answer to ajax
echo (int) $result;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>