<?

/**
 * Окруляем сумму заказа до рублей
 */

AddEventHandler("sale", "OnBeforeOrderAdd", "roundOrderSumm");

if (!function_exists('roundOrderSumm')) {
	function roundOrderSumm(&$arFields) {
		$arFields['PRICE'] = round($arFields['PRICE']);
	}
}

?>