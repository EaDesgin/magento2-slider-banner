<?php

namespace Eadesigndev\Slider\Model\SliderItem\Source;

use Magento\Framework\Data\OptionSourceInterface;

class IsActive implements OptionSourceInterface
{

    /**
     * @var \Eadesigndev\Slider\Model\SliderItem
     */
    protected $slideritem;

    /**
     * Constructor
     *
     * @param \Eadesigndev\Slider\Model\SliderItem $slideritem
     */
    public function __construct(\Eadesigndev\Slider\Model\SliderItem $slideritem)
    {
        $this->slideritem = $slideritem;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->slideritem->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}