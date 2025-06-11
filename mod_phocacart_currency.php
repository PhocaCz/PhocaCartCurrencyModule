<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('_JEXEC') or die;// no direct access
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Router\Route;

/** @var \Joomla\Registry\Registry $params */

$app = Factory::getApplication();

if (!ComponentHelper::isEnabled('com_phocacart', true)) {

	$app->enqueueMessage(Text::_('Phoca Cart Error'), Text::_('Phoca Cart is not installed on your system'), 'error');
	return;
}
if (file_exists(JPATH_ADMINISTRATOR . '/components/com_phocacart/libraries/bootstrap.php')) {
	// Joomla 5 and newer
	require_once(JPATH_ADMINISTRATOR . '/components/com_phocacart/libraries/bootstrap.php');
} else {
	// Joomla 4
	JLoader::registerPrefix('Phocacart', JPATH_ADMINISTRATOR . '/components/com_phocacart/libraries/phocacart');
}
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

$moduleclass_sfx 					= htmlspecialchars((string)$params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

//$document			= Factory::getDocument();
// 			= ComponentHelper::getParams('com_phocacart') ;

$lang = Factory::getLanguage();
//$lang->load('com_phocacart.sys');
$lang->load('com_phocacart');

$media = PhocacartRenderMedia::getInstance('main');
$media->loadBase();
$media->loadBootstrap();
$media->loadChosen();
$media->loadSpec();
$s = PhocacartRenderStyle::getStyles();

$uri 			= \Joomla\CMS\Uri\Uri::getInstance();
$action			= $uri->toString();
$actionBase64	= base64_encode($action);
$linkCheckout	= Route::_(PhocacartRoute::getCheckoutRoute());

$session 	= Factory::getApplication()->getSession();
$activeCurrency	= (int)$session->get('currency', PhocacartCurrency::getDefaultCurrency(), 'phocaCart');
$cacheid = md5($module->id . '-' . $activeCurrency);

$cacheparams               = new \stdClass();
$cacheparams->cachemode    = 'id';
$cacheparams->class        = '\PhocacartCurrency';
$cacheparams->method       = 'getCurrenciesSelectBox';
$cacheparams->methodparams = [
	$params->get('show_button', true) ? '' : 'onchange="this.form.submit();"'
];
$cacheparams->modeparams   = $cacheid;

$selectBox     = ModuleHelper::moduleCache($module, $params, $cacheparams);
//$selectBox 		= PhocacartCurrency::getCurrenciesSelectBox($params->get('show_button', true) ? '' : 'onchange="this.form.submit();"');

$currArray		= PhocacartCurrency::getCurrenciesArray();
//$selectBox 		= PhocacartCurrency::getCurrenciesArray();
//$selectBox 		= PhocacartCurrency::getCurrenciesListBox();

require(ModuleHelper::getLayoutPath('mod_phocacart_currency', $params->get('layout', 'default')));
?>
