<?php

namespace Mage4\StoreLocator\Block;

use Mage4\StoreLocator\Helper\Config;
use Mage4\StoreLocator\Model\ResourceModel\Store\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;

class Storelocator extends Template
{
    /**
     * @var \Magento\Framework\View\Element\Template
     */
    protected $collectionFactory;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
        Template\Context     $context,
        CollectionFactory    $collectionFactory,
        ScopeConfigInterface $scopeConfig,
        Config               $config,
        StoreManagerInterface         $storeManager,
        array                $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->config = $config;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    public function getStores()
    {
        return $this->collectionFactory->create();
    }

    public function getStoresJsonData()
    {
        return json_encode($this->collectionFactory->create()->getData());
    }

    public function renderConfig()
    {
        return $this->config;
    }
    public function getSelectedMarkerIcon()
    {
        // get media Base Url
        $media = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $media = $media . 'mage4/storelocator/selected_markericon/' . $this->config->getSelectedMarkerIcon();
        return $media;
    }
    public function getMarkerIcon()
    {
        // get media Base Url
        $media = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $media = $media . 'mage4/storelocator/markericon/' . $this->config->getMarkerIcon();
        return $media;
    }

    public function getStoreMediaPathUrl()
    {
        // get media Base Url
        $media = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $media = $media . 'mage4/storelocator/image/' . $this->config->getMarkerIcon();
        return $media;
    }

}
