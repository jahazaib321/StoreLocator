<?php
namespace Mage4\StoreLocator\Model\ResourceModel;

/**
 * Class Store
 */
class Store extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init('mage4_storelocator_managestores', 'id');
    }
}

