<?php
namespace Mage4\StoreLocator\Model\ResourceModel\Store;

/**
 * Class Collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(\Mage4\StoreLocator\Model\Store::class, \Mage4\StoreLocator\Model\ResourceModel\Store::class);
    }
}

