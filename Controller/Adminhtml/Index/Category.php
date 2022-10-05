<?php

namespace Mage4\StoreLocator\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class Category extends \Magento\Backend\App\Action
{
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}

