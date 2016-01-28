<?
// get baskets
if (!\Bitrix\Main\Loader::includeModule("sale")) {
	ShowError('Module sale is not loaded');
	return;
}
$rsBaskets = CSaleBasket::GetList(
	array(),
	array(
		'FUSER_ID' => CSaleBasket::GetBasketUserID(),
		"LID" => SITE_ID,
		"ORDER_ID" => false
	),
	false,
	false,
	array(
		'PRODUCT_ID',
		'DELAY'
	)
);
$arBaskets = array();
while ($arBasket = $rsBaskets->Fetch()) {
	$arBaskets[] = $arBasket;
}
?>
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:catalog.element",
	"",
	array(
		// ...
		'CUSTOM_BASKETS' => $arBaskets,

	),
	$component
);?>