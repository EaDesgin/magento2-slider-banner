<?php

namespace Eadesigndev\Slider\Block\Adminhtml\SliderItem\Edit;
use Eadesigndev\Slider\Model\Slider;
use Eadesigndev\Slider\Ui\Component\Listing\DataProvider\SliderItemGridDataProvider;

/**
 * Adminhtml blog post edit form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Eadesigndev\Slider\Model\SliderFactory
     */
    protected $_sliderFactory;

    /**
     * @var \Magento\Framework\Session\SessionManagerInterface
     */
    protected $_sessionManager;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param \Eadesigndev\Slider\Model\ResourceModel\Slider\Collection
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Eadesigndev\Slider\Model\SliderFactory $sliderFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Framework\Session\SessionManagerInterface $sessionManager,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_sliderFactory = $sliderFactory;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_sessionManager = $sessionManager;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('slideritem_form');
        $this->setTitle(__('Slider Item Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Eadesigndev\Slider\Model\Slider $model */
        $model = $this->_coreRegistry->registry('ctslider_slideritem');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post', 'enctype' => 'multipart/form-data']]
        );

        $form->setHtmlIdPrefix('slideritem_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getSliderItemId()) {
            $fieldset->addField('slider_item_id', 'hidden', ['name' => 'slider_item_id']);
        }

        $fieldset->addField(
            'title',
            'text',
            ['name' => 'title', 'label' => __('Slider Item Title'), 'title' => __('Slider Item Title'), 'required' => true]
        );

        /*$fieldset->addField(
            'slider_id',
            'select',
            [
                'label' => __('Slider'),
                'title' => __('Slider'),
                'name' => 'slider_id',
                'required' => true,
                'options' => $this->_sliderCollection->getOptions()
            ]
        );*/
        $sliderId = $this->_sessionManager->getData(SliderItemGridDataProvider::SESSION_KEY_SLIDER_ID);

        $slider = $this->_sliderFactory->create()->load($sliderId);

        $fieldset->addField(
            'slider_id',
            'hidden',
            [
                'name' => 'slider_id'
            ]
        );

        if($slider->getContentType() == Slider::CONTENT_TYPE_IMAGE){
            $fieldset->addField('image_url', 'imagefile', [
                'label' => __('Image'),
                'title' => __('Image'),
                'name' => 'image_url',
                'required' => true
            ]);
        }elseif($slider->getContentType() == Slider::CONTENT_TYPE_CUSTOM){
            $fieldset->addField(
                'content',
                'editor',
                [
                    'name' => 'content',
                    'label' => __('Content'),
                    'title' => __('Content'),
                    'style' => 'height:36em',
                    'required' => true,
                    'config' => $this->_wysiwygConfig->getConfig()
                ]
            );
        }


        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'is_active',
                'required' => true,
                'options' => ['1' => __('Enabled'), '0' => __('Disabled')]
            ]
        );
        if (!$model->getId()) {
            $model->setData('is_active', '1');
        }


        $form->setValues(array_merge($model->getData(), ['slider_id' => $sliderId]));
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}