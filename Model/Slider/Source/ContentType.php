<?php

namespace Eadesigndev\Slider\Model\Slider\Source;

use Magento\Framework\Data\OptionSourceInterface;

class ContentType implements OptionSourceInterface
{

    /**
     * @var \Eadesigndev\Slider\Model\Slider
     */
    protected $slider;

    /**
     * Constructor
     *
     * @param \Eadesigndev\Slider\Model\Slider $slider
     */
    public function __construct(\Eadesigndev\Slider\Model\Slider $slider)
    {
        $this->slider = $slider;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->slider->getAvailableContentTypes();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}