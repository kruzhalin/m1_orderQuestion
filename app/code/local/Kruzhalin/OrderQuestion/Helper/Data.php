<?php

/**
 * Class Kruzhalin_OrderQuestion_Helper_Data
 */
class Kruzhalin_OrderQuestion_Helper_Data extends Mage_Core_Helper_Abstract
{
    const MANAGER_EMAIL_XML_PATH = 'orderquestion/general/manager_email';

    /**
     * @param $storeId
     * @return mixed
     */
    public function getManagerEmail($storeId)
    {
        return Mage::getStoreConfig(self::MANAGER_EMAIL_XML_PATH, $storeId);
    }
}
