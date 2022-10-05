<?php
namespace Mage4\StoreLocator\Model;

/**
 * Class Store
 */
class Store extends \Magento\Framework\Model\AbstractModel implements
    \Mage4\StoreLocator\Api\Data\StoreInterface,
    \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'jahazaib_test_store';

    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(\Mage4\StoreLocator\Model\ResourceModel\Store::class);
    }

    /**
     * @inheritDoc
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}

