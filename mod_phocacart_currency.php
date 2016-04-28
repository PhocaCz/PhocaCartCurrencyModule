<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
 
defined('_JEXEC') or die('Restricted access');// no direct access

if (!JComponentHelper::isEnabled('com_phocacart', true)) {
	$app = JFactory::getApplication();
	$app->enqueueMessage(JText::_('Phoca Cart Error'), JText::_('Phoca Cart is not installed on your system'), 'error');
	return;
}
if (! class_exists('PhocaCartLoader')) {
    require_once( JPATH_ADMINISTRATOR.'/components/com_phocacart/libraries/loader.php');
}

phocacartimport('phocacart.utils.settings');
phocacartimport('phocacart.utils.utils');
phocacartimport('phocacart.path.path');
phocacartimport('phocacart.path.route');
phocacartimport('phocacart.currency.currency');
phocacartimport('phocacart.price.price');

$lang = JFactory::getLanguage();
//$lang->load('com_phocacart.sys');
$lang->load('com_phocacart');

JHTML::stylesheet('media/com_phocacart/css/main.css' );

$document				= JFactory::getDocument();

$paramsC 			= JComponentHelper::getParams('com_phocacart') ;
$load_chosen 		= $paramsC->get( 'load_chosen', 1 );
if ($load_chosen == 1) {
	JHtml::_('jquery.framework', false);
	$document->addScript(JURI::root(true).'/media/com_phocacart/bootstrap/js/bootstrap.min.js');
	$document->addScript(JURI::root(true).'/media/com_phocacart/js/chosen/chosen.jquery.min.js');
	$js = "\n". 'jQuery(document).ready(function(){';
	$js .= '   jQuery(".chosen-select").chosen({disable_search_threshold: 10});'."\n";	
	$js .= '});'."\n";
	$document->addScriptDeclaration($js);
	JHTML::stylesheet( 'media/com_phocacart/js/chosen/chosen.css' );
	JHTML::stylesheet( 'media/com_phocacart/js/chosen/chosen-bootstrap.css' );
}
$uri 			= JFactory::getURI();
$action			= $uri->toString();
$actionBase64	= base64_encode($action);
$linkCheckout	= JRoute::_(PhocaCartRoute::getCheckoutRoute());
//$currency 		= new PhocaCartCurrency();
//$selectBox 		= $currency->getCurrenciesSelectBox();
$selectBox 		= PhocaCartCurrency::getCurrenciesSelectBox();

require(JModuleHelper::getLayoutPath('mod_phocacart_currency'));
?>