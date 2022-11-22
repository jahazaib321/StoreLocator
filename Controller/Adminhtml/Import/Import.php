<?php

namespace Mage4\StoreLocator\Controller\Adminhtml\Import;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Filesystem;
use Magento\Framework\Image\AdapterFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Setup\Exception;

class Import extends Action
{
    const TABLE = 'mage4_storelocator_managestores';
    const REQUIRED_COLUMNS = ['name', 'country', 'state', 'city', 'zip', 'street', 'lat', 'lng'];
    protected $fileSystem;
    protected $uploaderFactory;
    protected $request;
    protected $adapterFactory;
    protected $connection;
    protected $_importModel;
    private $resource;

    public function __construct(
        Context            $context,
        Filesystem         $fileSystem,
        UploaderFactory    $uploaderFactory,
        RequestInterface   $request,
        AdapterFactory     $adapterFactory,
        ResourceConnection $resource
    ) {
        parent::__construct($context);
        $this->fileSystem = $fileSystem;
        $this->request = $request;
        $this->connection = $resource->getConnection();
        $this->adapterFactory = $adapterFactory;
        $this->uploaderFactory = $uploaderFactory;
    }

    public function execute()
    {
        $postValues = $this->getRequest()->getPost();
        $delimiter = $postValues['delimiter'] ? ',' : ',';
        $enclosure = $postValues['enclosure'] ? '"' : '"';
        $headers = [];
        $importData = [];
        $importErrors = [];
        if (!empty($this->uploaderFactory->create(['fileId' => 'import']))) {
            try {
                if (($handle = fopen($_FILES['import']['tmp_name'], "r")) !== false) {
                    $row = -1;
                    while (($data = fgetcsv($handle, 8192, $delimiter, $enclosure)) !== false) {
                        $num = count($data);
                        if ($row === -1) {
                            if (!empty(array_diff(self::REQUIRED_COLUMNS, $data))) {
                                throw new Exception("Required Columns are missing.");
                            }
                            for ($c = 0; $c < $num; $c++) {
                                $headers[] = $data[$c];
                            }
                        } else {
                            for ($c = 0; $c < $num; $c++) {
                                if ($data[$c]) {
                                    $importData[$row][$headers[$c]] = $data[$c];
                                }
                            }
                            $diff = array_diff(self::REQUIRED_COLUMNS, array_keys($importData[$row]));
                            if (!empty($diff)) {
                                $importErrors[] = $row;
                                unset($importData[$row]);
                            }
                        }
                        $row++;
                    }
                    if ($importErrors) {
                        if ((count($importErrors) !== 1)) {
                            $cou = end($importErrors);
                            $count = count($importErrors)-1;
                            array_splice($importErrors, $count, $count, "and {$cou}");

                            $importErrors = implode(', ', $importErrors);
                            $importErrors = str_replace(', and', ' and', $importErrors);
                            $this->getMessageManager()->addErrorMessage("name, country, state, city, zip, street, lat, lng are required fields. We are unable to import data of row(s) {$importErrors} because of missing required fields.");
                        } else {
                            $importErrors = implode(',', $importErrors);
                            $this->getMessageManager()->addErrorMessage("name, country, state, city, zip, street, lat, lng are required fields. We are unable to import data of row(s) {$importErrors} because of missing required fields.");
                        }
                    }
                    foreach ($importData as $rowData) {
                        $this->connection->insertOnDuplicate(
                            static::TABLE,
                            $rowData
                        );
                    }
                    $importData = count($importData);
                }
                $this->messageManager->addSuccessMessage(
                    __('Successfully Imported ' . $importData . ' row(s)')
                );
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $this->messageManager->addErrorMessage(__("Required Columns : name, country, state, city, zip, street, lat, lng"));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        return $this->_redirect('storelocator/import/index');
    }
}
