<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('_JEXEC') or die;// no direct access

if (!JComponentHelper::isEnabled('com_phocacart', true)) {
	$app = JFactory::getApplication();
	$app->enqueueMessage(JText::_('Phoca Cart Error'), JText::_('Phoca Cart is not installed on your system'), 'error');
	return;
}

JLoader::registerPrefix('Phocacart', JPATH_ADMINISTRATOR . '/components/com_phocacart/libraries/phocacart');
/*
if (! class_exists('PhocacartLoader')) {
    require_once( JPATH_ADMINISTRATOR.'/components/com_phocacart/libraries/loader.php');
}

phocacartimport('phocacart.utils.settings');
phocacartimport('phocacart.utils.utils');
phocacartimport('phocacart.path.path');
phocacartimport('phocacart.path.route');
phocacartimport('phocacart.currency.currency');
phocacartimport('phocacart.price.price');*/

$moduleclass_sfx 					= htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

$lang = JFactory::getLanguage();
//$lang->load('com_phocacart.sys');
$lang->load('com_phocacart');

$media = new PhocacartRenderMedia();
$media->loadBase();
$media->loadBootstrap();
$s = PhocacartRenderStyle::getStyles();

$document				= JFactory::getDocument();

$paramsC 			= JComponentHelper::getParams('com_phocacart') ;
$load_chosen 		= $paramsC->get( 'load_chosen', 1 );

$media->loadChosen($load_chosen);

$media->loadSpec();


$uri 			= \Joomla\CMS\Uri\Uri::getInstance();
$action			= $uri->toString();
$actionBase64	= base64_encode($action);
$linkCheckout	= JRoute::_(PhocacartRoute::getCheckoutRoute());
//$currency 		= new PhocacartCurrency();
//$selectBox 		= $currency->getCurrenciesSelectBox();
$selectBox 		= PhocacartCurrency::getCurrenciesSelectBox();
$currArray		= PhocacartCurrency::getCurrenciesArray();
//$selectBox 		= PhocacartCurrency::getCurrenciesArray();
//$selectBox 		= PhocacartCurrency::getCurrenciesListBox();

require(JModuleHelper::getLayoutPath('mod_phocacart_currency'));
?>
