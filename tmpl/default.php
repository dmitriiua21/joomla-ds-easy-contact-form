<?php
/**
 * @version 1.0.0
 * @copyright Copyright (C) 2017.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author Dmitriy Smirnov
 * @author email dmitriiua21@gmail.com
 */

defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.modal');

// check recipient
if ($recipient === "") {
    echo '<span class="error-ds-simple-contact-form">' . JText::_('MOD_DS_EASYCONTACT_NO_RECIPIENT') . '</span>';
    return true;
}
?>
<div id="modal-ds-easy-contact-box" class="modal  hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        	<span>&nbsp;</span>
        </button>
        <h3 id="myModalLabel"><?php echo JText::_('MOD_DS_EASYCONTACT_MODAL_HEADER'); ?></h3>
    </div>
    <div class="modal-body">
    	<div class="modal-ds-easy-contact-message"></div>
	    <div class="ds-simple-contact-form style <?php echo $mod_class_suffix ?>">
	    	<form class="easy-contact-form form-validate" id="ds-easy-contact-form-<?php echo $moduleId ?>" 
	    		action="index.php?option=com_ajax&module=ds_easy_contact&format=json" method="post">
	    		<span class="ds-simple-contact-form-introtext"><?php echo $introtext ?></span>
	    		<div class="ds-simple-contact-form">

					<!-- print name input -->
	    			<?php if ($name_required == 1) { ?>
	    				<div class="ds-simple-contact-form-row name">
	    					<input class="ds-simple-contact-form inputbox required <?php echo $mod_class_suffix ?>" type="text" name="ds_name" id="ds_name-<?php echo $moduleId ?>"
	    					value="" required="required" />
	    					<span class="highlight"></span>
	    					<span class="bar"></span>
	    					<label for="ds_name-<?php echo $moduleId ?>" style="display: none;"><?php echo JText::_('MOD_DS_EASYCONTACT_NAME_LABEL') ?></label>
	    				</div>
	    			<?php } ?>

	    			<!-- print email input -->
	    			<?php if ($email_required == 1) { ?>
	    				<div class="ds-simple-contact-form-row email">
	    					<input class="ds-simple-contact-form inputbox required <?php echo $mod_class_suffix ?>" type="text" name="ds_email" id="ds_email-<?php echo $moduleId ?>" value="" required="required" />
	    					<span class="highlight"></span>
	    					<span class="bar"></span>
							<label for="ds_email-<?php echo $moduleId ?>" style="display: none;"><?php echo JText::_('MOD_DS_EASYCONTACT_EMAIL_LABEL') ?></label>
	    				</div>
	    			<?php } ?>

	    			<!-- print phone input -->
	    			<?php if ($phone_required == 1) { ?>
						<div class="ds-simple-contact-form-row phone">
							<input class="ds-simple-contact-form inputbox required validate-phone <?php echo $mod_class_suffix ?>" type="tel" name="ds_phone" id="ds_phone-<?php echo $moduleId ?>" value="" required="required" />
							<span class="highlight"></span>
							<span class="bar"></span>
							<label for="ds_phone-<?php echo $moduleId ?>" style="display: none;"><?php echo JText::_('MOD_DS_EASYCONTACT_PHONE_LABEL') ?></label>
						</div>
	    			<?php } ?>

	    			<!-- print message textarea -->
	    			<?php if ($message_enabled == 1) { ?>
    					<div class="ds-simple-contact-form-row message">
    						<textarea class="ds-simple-contact-form textarea required <?php echo $mod_class_suffix ?>" name="ds_message" id="ds_message-<?php echo $moduleId ?>" cols="4" rows="4" required="required"></textarea>
    						<span class="highlight"></span>
							<span class="bar"></span>
							<label for="ds_message-<?php echo $moduleId ?>" style="display: none;"></label>
    					</div>
	    			<?php } ?>

	    			<!-- buttons -->
	    			<input type="hidden" name="ds-easy-contact-send-<?php echo $moduleId ?>" value="true">
	    			<div class="button-box">
	    				<button id="ds-easy-contact-send-<?php echo $moduleId ?>" class="ds-simple-contact-form button validate <?php echo $mod_class_suffix ?>">
	    					<span><?php echo JText::_('MOD_DS_EASYCONTACT_BUTTON_LABEL') ?></span>
	    				</button>
	    			</div>
	    		</div>
	    	</form>
	    </div>
    </div>
</div>
<a href="#modal-ds-easy-contact-box" role="button" class="btn btn-primary button" data-toggle="modal">
	<span><?php echo JText::_('MOD_DS_EASYCONTACT_SEND_BUTTON') ?></span>
</a>