<?php

namespace Mage4\StoreLocator\Controller\Adminhtml\Import;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Backend\App\Action
{
    private $coreRegistry;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {

        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
    }

    public function execute()
    {
        $rowData = $this->_objectManager->create('Mage4\StoreLocator\Model\Store');
        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Import Locator Data'));
        return $resultPage;
    }
}
