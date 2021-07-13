<?php
namespace Learning\ClothingMaterial\Model\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;


class Wearing extends AbstractSource
{
    public function getAllOptions()
    {
        if (!$this->_options){
        $this->_options[] = ['label' => __('Casual'), 'value' => 'Casual'];
        $this->_options[] = ['label' => __('Formal'), 'value' => 'Formal'];
        $this->_options[] = ['label' => __('Party'), 'value' => 'Party'];
        $this->_options[] = ['label' => __('Sports'), 'value' => 'Sports'];
        }
        return $this->_options;

    }
}