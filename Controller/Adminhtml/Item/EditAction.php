<?php

namespace Mage4\StoreLocator\Controller\Adminhtml\Item;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Edit form controller
 */
class EditAction extends \Magento\Backend\App\Action
{

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Backend\Model\Session
     */
    protected $adminSession;

    /**
     * @var \Mage4\StoreLocator\Model\StoreFactory
     */
    protected $storeFactory;

    /**
     * @param Action\Context                 $context
     * @param \Magento\Framework\Registry    $registry
     * @param \Magento\Backend\Model\Session $adminSession
     * @param \Mage4\StoreLocator\Model\StoreFactory     $storeFactory
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Model\Session $adminSession,
        \Mage4\StoreLocator\Model\StoreFactory $storeFactory
    ) {
        $this->_coreRegistry = $registry;
        $this->adminSession = $adminSession;
        $this->storeFactory = $storeFactory;
        parent::__construct($context);
    }

    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return true;
    }

    /**
     * Add form breadcrumbs
     *
     * @return $this
     */
    protected function _initAction()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Mage4_StoreLocator::storelocator')->addBreadcrumb(__('Form'), __('Form'))->addBreadcrumb(__('Manage Form'), __('Manage Form'));
        return $resultPage;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->storeFactory->create();


        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('Sorry'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $data = $this->adminSession->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('mage4_storelocator', $model);

        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb($id ? __('Edit Form') : __('New Form'), $id ? __('Edit Form') : __('New Form'));
        $resultPage->getConfig()->getTitle()->prepend(__('Grids'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Form'));

        return $resultPage;
    }
}
