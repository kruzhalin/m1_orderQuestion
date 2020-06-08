<?php

/**
 * Class Kruzhalin_OrderQuestion_Block_Form
 */
class Kruzhalin_OrderQuestion_Block_Form extends Mage_Core_Block_Template
{
    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('*/*/post');
    }

    /**
     * @return array|mixed|null
     * @throws Exception
     */
    public function getEmail()
    {
        return $this->getRequest()->getPost('email', false);
    }

    /**
     * @return array|mixed|null
     * @throws Exception
     */
    public function getOrderNumber()
    {
        return $this->getRequest()->getPost('order_number', false);
    }

    /**
     * @return array|mixed|null
     * @throws Exception
     */
    public function getQuestion()
    {
        return $this->getRequest()->getPost('question', false);
    }
}
