<?php

namespace Mage4\StoreLocator\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Mage4\StoreLocator\Model\ResourceModel\Store\CollectionFactory;


class Getstores extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\App\Action\Context
     */
    private $context;
    private $collectionFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
    \Magento\Framework\App\Action\Context $context,
    CollectionFactory $collectionFactory
) {
    parent::__construct($context);
    $this->collectionFactory = $collectionFactory;
    $this->context           = $context;
}

    /**
     * @return json
     */
    public function execute()
{
    $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
    $collection = $this->collectionFactory->create();
    $resultJson->setData(
        [
            'total_count' => $collection->count(),
            'items' => $collection->getData()
        ]
    );
    return $resultJson;
}
}
