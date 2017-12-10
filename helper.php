<?php
/**
 * @version 1.0.0
 * @copyright Copyright (C) 2017.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author Dmitriy Smirnov
 * @author email dmitriiua21@gmail.com
 */

defined('_JEXEC') or die('Restricted access');

class modDsEasyContactHelper
{

    public static function getAjax()
    {
        $data = JFactory::getApplication()->input->getArray(array());

        $ds_moduleId = $data['moduleId'];
        $ds_name = $data['ds_name'];
        $ds_message = $data['ds_message'];
        $ds_email = $data['ds_email'];
        $ds_phone = $data['ds_phone'];
        $recipient = $data['recipient'];
        $fromEmail = $data['fromEmail'];
        $sendersname = $data['sendersname'];
        $mySubject = $data['mySubject'];

        if (isset($ds_email) || isset($ds_phone)) {
            $message_text = JText::_('MOD_DS_EASYCONTACT_MESSAGE_INFO') . ' - ' . $ds_name . "\n"
                . JText::_('MOD_DS_EASYCONTACT_PHONE_INFO') . ' - ' . $ds_phone . "\n"
                . JText::_('MOD_DS_EASYCONTACT_EMAIL_LABEL') . ' - ' . $ds_email . "\n"
                . $ds_message;
        } else {
            $message_text = $ds_message;
        }

        $result = self::sendEmail($fromEmail, $ds_name, $recipient, $mySubject, $message_text);

        if ($result) {
            echo 'OK';
            jexit();
        }
        echo 'Error';
        jexit();
    }

    private static function sendEmail($from, $fromname, $recipient, $subject, $body, $mode = 0, $cc = NULL,
                                      $bcc = NULL, $attachment = NULL, $replyto = NULL, $replytoname = NULL)
    {

        $mailer = JFactory::getMailer();

        $mailer->setSender(array($from, $fromname));
        $mailer->setSubject($subject);
        $mailer->setBody($body);

        // Are we sending the email as HTML?
        if ($mode) {
            $mailer->isHTML(true);
        }

        if (!is_array($recipient)) {
            $recipient = explode(',', $recipient);
        }

        $mailer->addRecipient($recipient);
        $mailer->addCC($cc);
        $mailer->addBCC($bcc);
        $mailer->addAttachment($attachment);

        // Take care of reply email addresses
        if (is_array($replyto)) {
            $numReplyTo = count($replyto);
            for ($i = 0; $i < $numReplyTo; $i++) {
                $mailer->addReplyTo(array($replyto[$i], $replytoname[$i]));
            }
        } elseif (isset($replyto)) {
            $mailer->addReplyTo(array($replyto, $replytoname));
        }

        return $mailer->Send();
    }
}
