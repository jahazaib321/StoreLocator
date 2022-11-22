<?php

namespace Mage4\StoreLocator\Block\Adminhtml\Import;

use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    protected $_coreRegistry = null;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_objectId = 'import_id';
        $this->_blockGroup = 'Mage4_StoreLocator';
        $this->_controller = 'adminhtml_import';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Import'));
        $this->buttonList->remove('reset');
    }


    public function getHeaderText()
    {
        return __('Import Location Data');
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }


    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }
        return $this->getUrl('storelocator/import/import');
    }

    public function getBackUrl()
    {
        return $this->getUrl('storelocator/index/index');
    }
}
