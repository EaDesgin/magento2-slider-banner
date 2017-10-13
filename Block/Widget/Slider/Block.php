<?php
/**
 * Created by PhpStorm.
 * User: ashish
 * Date: 2/9/16
 * Time: 6:25 PM
 */

namespace Eadesigndev\Slider\Block\Widget\Slider;

use Eadesigndev\Slider\Model\Slider;
use Eadesigndev\Slider\Model\SliderFactory;
use Magento\Framework\View\Element\Template;

class Block extends Template implements \Magento\Widget\Block\BlockInterface
{

    protected $sliderFactory;

    /**
     * @var \Eadesigndev\Slider\Model\ResourceModel\SliderItem\CollectionFactory
     */
    protected $_sliderItemCollectionFactory;

    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $_filterProvider;

    protected $_template = 'Eadesigndev_Slider::slider/block.phtml';
    /**
     * Constructor
     *
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(Template\Context $context,
                                SliderFactory $sliderFactory,
                                \Eadesigndev\Slider\Model\ResourceModel\SliderItem\CollectionFactory
                                $sliderItemCollectionFactory,
                                \Magento\Cms\Model\Template\FilterProvider $filterProvider,
                                array $data = [])
    {
        $this->_filterProvider = $filterProvider;
        $this->_sliderItemCollectionFactory = $sliderItemCollectionFactory;
        $this->sliderFactory = $sliderFactory;
        parent::__construct($context, $data);
    }

    public function getContentType(){
        $sliderId = $this->getData('slider_id');
        $slider = $this->sliderFactory->create()->load($sliderId);
        return $slider->getContentType();
    }



    /**
     * @return \Magento\Cms\Model\Template\FilterProvider
     */
    public function getFilterProvider(){
        return $this->_filterProvider;
    }

    /**
     * @return \Eadesigndev\Slider\Model\SliderItem[]
     */
    public function getSliderItems(){
        $sliderId = $this->getData('slider_id');
        $collection = $this->_sliderItemCollectionFactory->create()
            ->addFieldToFilter('slider_id', $sliderId)
        ;
        $items = $collection->load();
        return $items;
    }
}