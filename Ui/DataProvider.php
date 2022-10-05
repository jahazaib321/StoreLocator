<?php

namespace Mage4\StoreLocator\Ui;

use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
    public function getData()
    {
        $result = [];
        foreach ($this->collection->getItems() as $item) {
            $data = $item->getData();
            if (isset($data['image'])) {
                $name = $data['image'];
                unset($data['image']);
                $data['image'][0] = [
                    'name' => $name,
                    'url' => 'http://jahazaib.local/pub/media/' . 'mage4/storelocator/image/' . $name
                ];
            }
            $result[$item->getId()]['general'] = $data;
        }
        return $result;
    }
}

