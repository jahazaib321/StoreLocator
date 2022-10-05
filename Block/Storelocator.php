<?php

namespace Mage4\StoreLocator\Block;

use Mage4\StoreLocator\Model\ResourceModel\Store\CollectionFactory;
use Magento\Framework\View\Element\Template;

class Storelocator extends Template
{
    /**
     * @var \Magento\Framework\View\Element\Template
     */
    protected $collectionFactory;

    public function __construct(
        Template\Context                         $context,
        CollectionFactory                        $collectionFactory,
        array $data  = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function getStores()
    {
        return $this->collectionFactory->create();
    }
}
