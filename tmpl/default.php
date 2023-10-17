<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die;
use Joomla\CMS\Language\Text;


// Alternative View in e.g. position 22
/*
//$item 		= '<span class="'.$s['i']['globe'].'"></span>';// globe icon
$item 		= Text::_('COM_PHOCACART_CURRENCY');// currency string
$item		= '';
$count 		= count($currArray);// count of currencies

$currList 	= array();

$currList[] = '<ul class="ph-currency-list-box">';
if (!empty($currArray)) {
	foreach($currArray as $k => $v) {
		$image = '';
		if (isset($v->image) && $v->image != '') {
			$image = '<img class="ph-currency-image-list" src="'.URI::base(true). '/' . $v->image.'" alt="'.$v->code.'" />';
		}

		if ($v->active == 1) {
			//$item .= ' <span class="ph-currency-list-suffix">('.$image .' ' . $v->code.')</span>';
			$item .= ' <span class="ph-currency-list-suffix">'.$image .' ' . $v->code.'</span>';
		}
		$currList[] = '<li class="ph-currency-list">'.$image . ' <a href="javascript:void(0);" onclick="jQuery(\'<input>\').attr({type: \'hidden\', id: \'id\', name: \'id\', value: \''.(int)$v->id.'\'}).appendTo(\'#phItemCurrencyBoxForm\');jQuery(\'#phItemCurrencyBoxForm\').submit()">'. $v->text.'</a></li>';
	}
}
$curList[] = '</ul>';
?>
<div class="ph-cart-module-box <?php echo $moduleclass_sfx ;?>">
	<div class="dropdown parent">
		<div class="dropdown-toggle toplevel ph-cart-dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="500" data-close-others="true"><?php echo $item ?> <sup class="ph-cart-count-sup phItemCurrencyBoxCount" id="phItemCurrencyBoxCount"><?php echo $count ?></sup></div>

		<div class="dropdown-menu child ph-cart-dropdown">
			<div id="phItemCurrencyBox" class="ph-currency-module-box phItemCurrencyBox"><?php

			echo implode('', $currList);

			?></div>
		</div>
	</div>
<?php
echo '<form action="'.$linkCheckout.'" method="post" id="phItemCurrencyBoxForm">';
echo '<input type="hidden" name="task" value="checkout.currency">';
echo '<input type="hidden" name="tmpl" value="component" />';
echo '<input type="hidden" name="option" value="com_phocacart" />';
echo '<input type="hidden" name="return" value="'.$actionBase64.'" />';
echo Joomla\CMS\HTML\HTMLHelper::_('form.token');
echo '</form>';
?>
</div>
<?php



*/

echo '<div class="ph-currency-select-box'.$moduleclass_sfx .'">';
echo '<form action="'.$linkCheckout.'" method="post" id="phItemCurrencyBoxForm">';
echo $selectBox;
echo '<input type="hidden" name="task" value="checkout.currency">';
echo '<input type="hidden" name="tmpl" value="component" />';
echo '<input type="hidden" name="option" value="com_phocacart" />';
echo '<input type="hidden" name="return" value="'.$actionBase64.'" />';
echo '<div class="'.$s['c']['pull-right'].' ph-input-select-currencies-button">';
if ($params->get('show_button', true)) {
  echo '<button class="btn btn-primary btn-sm ph-btn"><span class="' . $s['i']['refresh'] . '"></span> ' . Text::_('COM_PHOCACART_CHANGE_CURRENCY') . '</button>';
}
echo '</div>';
echo Joomla\CMS\HTML\HTMLHelper::_('form.token');
echo '</form>';
echo '</div>';
echo '<div class="ph-cb"></div>';

?>


