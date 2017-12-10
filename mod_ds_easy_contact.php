<?php
/**
 * @version 1.0.0
 * @copyright Copyright (C) 2017.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author Dmitriy Smirnov
 * @author email dmitriiua21@gmail.com
 */

defined('_JEXEC') or die('Restricted access');

// include helper
require_once __DIR__ . '/helper.php';

// get Joomla version
$version = new JVersion;
$jversion = '3';
if (version_compare($version->getShortVersion(), '3.0.0', '<')) {
    $jversion = '2.5';
}
$moduleId = $module->id;

JHtml::stylesheet(JUri::base() . 'modules/mod_ds_easy_contact/assets/css/style.css', array(), true);
// add scripts
$doc = JFactory::getDocument();
$jquery = $params->get('jquery', '');
if ($jquery == 1) {
    if ($jversion == '3') {
        JHtml::_('jquery.framework', true);
    } else {
        $doc->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js');
    }
}

$doc->addScript(JURI::base() . 'modules/mod_ds_easy_contact/assets/js/ajax.js');
$doc->addScriptDeclaration('
  ;(function($){
    $(function(){
      var EFO = new ModDSEC.easyFormObject(' . $moduleId . ', ' . json_encode($params) . ');
      EFO.init();
    });
  })(jQuery)
');


$email_required = $params->get('email_required', 1);
$phone_required = $params->get('phone_required', 1);
$name_required = $params->get('name_required', 1);
$message_enabled = $params->get('message_enabled', 1);
$recipient = $params->get('email_recipient', '');
$introtext = $params->get('introtext', '');
$mod_class_suffix = $params->get('moduleclass_sfx', '');

require JModuleHelper::getLayoutPath('mod_ds_easy_contact', $params->get('layout', 'default'));
?>