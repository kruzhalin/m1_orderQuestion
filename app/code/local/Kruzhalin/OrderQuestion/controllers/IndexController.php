<?php

/**
 * Class Kruzhalin_OrderQuestion_IndexController
 */
class Kruzhalin_OrderQuestion_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function postAction()
    {
        if (!$this->_validateFormKey()) {
            $this->_getSession()->addError(
                Mage::helper('adminhtml')->__('Invalid Form Key. Please refresh the page.')
            );
            $this->_redirect('*/*/');
            return;
        }

        $request = $this->getRequest();

        $collection = Mage::getModel('sales/order')
            ->getCollection()
            ->addAttributeTofilter('increment_id', $request->getPost('order_number'))
            ->addAttributeTofilter('customer_email', $request->getPost('email'));
        /** @var Mage_Sales_Model_Order $order */
        $order      = $collection->getFirstItem();

        if ($order && $order->getId()) {
            $questionData = array(
                'order_id' => $order->getId(),
                'question' => Mage::helper('orderquestion')->escapeHtml($request->getPost('question')),
                'store_id' => $order->getStoreId()

            );

            Mage::getModel('orderquestion/question')
                ->setData($questionData)
                ->save();

            $this->_getSession()->addSuccess(
                $this->__('Question was sent successfully.')
            );
            $this->_redirect('*/*/');
            return;
        } else {
            $this->_getSession()->addError(
                $this->__('Order ID or Email is invalid. Please check fields.')
            );
            $this->_redirect('*/*/');
            return;
        }
    }

    /**
     * @return Mage_Core_Model_Abstract|null
     */
    protected function _getSession()
    {
        return Mage::getSingleton('core/session');
    }
}
