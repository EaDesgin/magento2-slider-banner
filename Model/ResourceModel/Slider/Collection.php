<?php

namespace Eadesigndev\Slider\Model\ResourceModel\Slider;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'slider_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Eadesigndev\Slider\Model\Slider', 'Eadesigndev\Slider\Model\ResourceModel\Slider');
    }

    public function getOptions(){
        $this->addFieldToSelect('slider_id')->addFieldToSelect('title');
        $options = $this->getConnection()->fetchPairs($this->getSelect());
        return $options;
    }
}