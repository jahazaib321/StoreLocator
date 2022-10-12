<?php

namespace Mage4\StoreLocator\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    /**
     * @return string|null
     */
    public function getGoogleApiKeyFrontend()
    {
        return $this->scopeConfig->getValue('storelocator/google_api_key/frontend', ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
    }

    /**
     * @return string|null
     */
    public function getGoogleApiKeyBackend()
    {
        return $this->scopeConfig->getValue('storelocator/google_api_key/backend');
    }

    /**
     * @return int|null
     */
    public function getGroupStoresBy()
    {
        return $this->scopeConfig->getValue('storelocator/configuration/group_by', ScopeInterface::SCOPE_STORE);
    }
    public function getDefaultZoom()
    {
        return $this->scopeConfig->getValue('storelocator/style/zoom', ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
    }
    public function getGoogleMapJson()
    {
        return $this->scopeConfig->getValue('storelocator/style/json', ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
    }
    public function getMarkerIcon()
    {
        return $this->scopeConfig->getValue('storelocator/style/markericon', ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
    }
    public function getSelectedMarkerIcon()
    {
        return $this->scopeConfig->getValue('storelocator/style/selected_markericon', ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
    }

    public function getStoreMediaPathUrl()
    {
        // get media Base Url
        $media = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $media = $media . 'mage4/storelocator/image/' ;
        return $media;
    }

}

