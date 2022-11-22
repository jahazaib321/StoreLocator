<?php
namespace Mage4\StoreLocator\Block\Adminhtml\Import\Edit;

use Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{
    protected $_assetRepo;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\View\Asset\Repository $assetRepo,
        array $data = []
    ) {
        $this->_assetRepo = $assetRepo;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        $path = $this->_assetRepo->getUrl("Mage4_StoreLocator::sample/Mage4_StoreLocator_Sample_File.csv");

        $model = $this->_coreRegistry->registry('row_data');

        $form = $this->_formFactory->create(
            ['data' => [
                'id' => 'edit_form',
                'enctype' => 'multipart/form-data',
                'action' => $this->getData('action'),
                'method' => 'post'
            ]
            ]
        );

        $form->setHtmlIdPrefix('datalocation_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Import Location Data '), 'class' => 'fieldset-wide']
        );
        $sample_file_download = $fieldset->addField(
            'sample',
            'note',
            ['name' => 'sample', 'label' => __(' Sample File'), 'title' => __(' Download Sample File'),'after_element_html' => $this->getDownloadSampleFileHtml()]
        );

        $fieldset->addField(
            'delimiter',
            'select',
            ['name' => 'delimiter', 'label' => __(' Delimiter'), 'title' => __(' Delimiter'),'options' => [',' => ',',';' => ';'],'value'=>';']
        );

        $fieldset->addField(
            'enclosure',
            'select',
            ['name' => 'enclosure', 'label' => __(' Enclosure'), 'title' => __(' Enclosure'),'options' => ['"' => '"', ' ' => ' '], 'value'=>'"' ]
        );

        $import_file = $fieldset->addField(
            'import',
            'file',
            [
                'label'     => 'Upload File',
                'required'  => true,
                'name'      => 'import',
                'note' => 'Allow File type: .csv only',
            ]
        );

        $sample_file_download->setAfterElementHtml(
            " <span id='sample-file-span' ><a id='sample-file-link' href='" . $path . "'  >Download Sample File</a></span> "
        );
        $import_file->setAfterElementHtml(
            "
        <script type=\"text/javascript\">

            document.getElementById('datalocation_import').onchange = function () {

                var fileInput = document.getElementById('datalocation_import');

                var filePath = fileInput.value;

                var allowedExtensions = /(\.csv)$/i;

                if(!allowedExtensions.exec(filePath))
                {
                    alert('Please upload file having extensions .csv only.');
                    fileInput.value = '';
                }

            };

        </script>"
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
//    protected function getDownloadSampleFileHtml()
//    {
//        $html = '<button name="button_download" onclick="window.location.">' . __('Download') . '</button>';
//        return $html;
//    }
}

//use Magento\Backend\Block\Widget\Form\Generic;
//
//class Form extends Generic
//{
//
//    /**
//     * @var \Magento\Store\Model\System\Store
//     */
//    protected $_systemStore;
//
//    /**
//     * @param \Magento\Backend\Block\Template\Context $context
//     * @param \Magento\Framework\Registry $registry
//     * @param \Magento\Framework\Data\FormFactory $formFactory
//     * @param \Magento\Store\Model\System\Store $systemStore
//     * @param array $data
//     */
//    public function __construct(
//        \Magento\Backend\Block\Template\Context $context,
//        \Magento\Framework\Registry $registry,
//        \Magento\Framework\Data\FormFactory $formFactory,
//        \Magento\Store\Model\System\Store $systemStore,
//        array $data = []
//    ) {
//        $this->_systemStore = $systemStore;
//        parent::__construct($context, $registry, $formFactory, $data);
//    }
//
//    /**
//     * Init form
//     *
//     * @return void
//     */
//    protected function _construct()
//    {
//        parent::_construct();
//        $this->setId('import_form');
//        $this->setTitle(__('Import Settings'));
//    }
//
//    /**
//     * Prepare form
//     *
//     * @return $this
//     */
//    protected function _prepareForm()
//    {
//
//        /** @var \Magento\Framework\Data\Form $form */
//        $form = $this->_formFactory->create(
//            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
//        );
//
//        $form->setHtmlIdPrefix('storelocator_');
//
//        $fieldset = $form->addFieldset(
//            'import_fieldset',
//            ['legend' => __('Import Settings'), 'class' => 'fieldset-wide']
//        );
//
////        $fieldset->addField(
////            'sample',
////            'note',
////            ['name' => 'sample', 'label' => __(' Sample File'), 'title' => __(' Sample File'),'after_element_html' => $this->getDownloadSampleFileHtml()]
////        );
//
//        $fieldset->addField(
//            'delimiter',
//            'select',
//            ['name' => 'delimiter', 'label' => __(' Delimiter'), 'title' => __(' Delimiter'),'options' => [',' => ',',';' => ';'],'value'=>',']
//        );
//
//        $fieldset->addField(
//            'enclosure',
//            'select',
//            ['name' => 'enclosure', 'label' => __(' Enclosure'), 'title' => __(' Enclosure'),'options' => ['' => ' ','"' => '"'], 'value'=>'"' ]
//        );
//
//        $fieldset->addField(
//            'file',
//            'file',
//            ['name' => 'file', 'label' => __('Upload File'), 'title' => __('Upload File')]
//        );
//
//        $form->setValues($model->getData());
//        $form->setUseContainer(true);
//        $this->setForm($form);
//
//        return parent::_prepareForm();
//    }
//
////    protected function getDownloadSampleFileHtml()
////    {
////        $html = '<button name="button_download" onclick="window.location.">'.__('Download').'</button>';
////        return $html;
////    }
//}
