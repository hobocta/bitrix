<?
$isDelayed = false;
if (
	!empty($arParams['CUSTOM_BASKETS'])
	&& is_array($arParams['CUSTOM_BASKETS'])
) {
	foreach ($arParams['CUSTOM_BASKETS'] as $arBasket) {
		if ($arBasket['PRODUCT_ID'] == $arResult['ID']) {
			$isDelayed = true;
			break;
		}
	}
}
?>
<a class="catalog-element__delay<?
if ($isDelayed) {
	?> catalog-element__delay--hide<?
}
?>" href="<?= $templateFolder ?>/ajax.delay.php?productid=<?= $arResult['ID'] ?>">
	<i class="fa fa-heart"></i>
	<?= GetMessage('Otlozhit') ?>
</a>
<a class="catalog-element__delayed<?
if (!$isDelayed) {
	?> catalog-element__delayed--hide<?
}
?>" href="<?= $arParams['BASKET_URL'] ?>">
	<i class="fa fa-check"></i>
	<?= GetMessage('Otlozhen') ?>
</a>
