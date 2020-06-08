<?php

/**
 * Class Kruzhalin_OrderQuestion_Model_Observer
 */
class Kruzhalin_OrderQuestion_Model_Observer
{
    /**
     * @return $this
     */
    public function sendQuestionNotification()
    {
        $storeViews = Mage::getSingleton('adminhtml/system_store')->getStoreOptionHash();
        foreach ($storeViews as $storeViewId => $storeViewName) {
            $this->_processQuestionsByStore($storeViewId);
        }

        return $this;
    }

    /**
     * @param $storeId
     */
    protected function _processQuestionsByStore($storeId)
    {
        $collection = Mage::getModel('orderquestion/question')
            ->getCollection()
            ->addFieldToFilter('store_id', $storeId)
            ->addFieldToFilter('sent_to_manager', 0);

        if (!$collection->getSize()) {
            return;
        }

        if (!$this->_sendEmailToManager($storeId)) {
            return;
        }
        foreach ($collection as $_item) {
            $_item->setSentToManager(true);
            $_item->save();
        }

        return;

    }

    /**
     * @param $storeId
     * @return bool
     */
    protected function _sendEmailToManager($storeId)
    {
        $helper     = Mage::helper('orderquestion');
        $templateId = 'order_question_manager_notification';
        $emailTo    = $helper->getManagerEmail($storeId);
        /** @var Mage_Core_Model_Email_Template $emailTemplate */
        $emailTemplate = Mage::getModel('core/email_template')->loadDefault($templateId);
        $senderName    = Mage::getStoreConfig(Mage_Core_Model_Store::XML_PATH_STORE_STORE_NAME, $storeId);

        $senderEmail = Mage::getStoreConfig('trans_email/ident_general/email');
        $emailTemplate->setTemplateSubject($helper->__('You have new Questions'));
        $emailTemplate->setSenderName($senderName);
        $emailTemplate->setSenderEmail($senderEmail);

        try {
            if (!$emailTemplate->send($emailTo)) {
                Mage::throwException('This letter cannot be sent.');
            }
            Mage::log('Email was sent to Manager ' . $emailTo);
            return true;
        } catch (Exception $e) {
            Mage::logException($e);
            return false;
        }
    }

}
