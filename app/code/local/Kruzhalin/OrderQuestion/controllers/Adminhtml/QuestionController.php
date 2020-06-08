<?php

/**
 * Class Kruzhalin_OrderQuestion_Adminhtml_QuestionController
 */
class Kruzhalin_OrderQuestion_Adminhtml_QuestionController
    extends Mage_Adminhtml_Controller_Action
{
    /**
     * Init actions
     *
     * @return Mage_Adminhtml_Cms_PageController
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('sales')
            ->_addBreadcrumb(Mage::helper('sales')->__('Sales'), Mage::helper('sales')->__('Sales'))
            ->_addBreadcrumb($this->__('Order Questions'), $this->__('Order Questions'));
        return $this;
    }

    public function indexAction()
    {
        $this->_initAction();
        $this->_title($this->__('Order Questions'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('orderquestion/adminhtml_question'));
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('orderquestion/adminhtml_question_grid')->toHtml()
        );
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')
            ->isAllowed('admin/sales/orderquestion');
    }
}
