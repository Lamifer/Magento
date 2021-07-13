<?php
namespace Practice\PracticeComment\Plugin\Block\Checkout;

class LayoutProcessor
{
    /**
     * Process js Layout of block
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $subject, $jsLayout)
    {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['delivery_comment'] = $this->processDeliveryCommentAddress('shippingAddress');
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['delivery_date'] = $this->processDeliveryDateAddress('shippingAddress');

        return $jsLayout;
    }

    /**
     * Process provided address.
     *
     * @param string $dataScopePrefix
     * @return array
     */
    private function processDeliveryCommentAddress($dataScopePrefix)
    {
        return [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => $dataScopePrefix.'.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
                'id' => 'delivery_comment',
                'options' => []
            ],
            'dataScope' => $dataScopePrefix.'.custom_attributes.delivery_comment',
            'label' => __('Delivery Comment'),
            'provider' => 'checkoutProvider',
            'validation' => [
               'required-entry' => true
            ],
            'sortOrder' => 201,
            'visible' => true,
            'imports' => [
                'initialOptions' => 'index = checkoutProvider:dictionaries.delivery_comment',
                'setOptions' => 'index = checkoutProvider:dictionaries.delivery_comment'
            ]
        ];
    }
    private function processDeliveryDateAddress($dataScopePrefix)
    {
        return [
            'component' => 'Magento_Ui/js/form/element/date',
            'config' => [
                'customScope' => $dataScopePrefix.'.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/date',
                'id' => 'delivery_date',
                'options' => [
                    'dateFormat' => 'y-MM-dd'
                ]
            ],
            'dataScope' => $dataScopePrefix.'.custom_attributes.delivery_date',
            'label' => __('Delivery Date'),
            'provider' => 'checkoutProvider',
            'validation' => [
               'required-entry' => true
            ],
            'sortOrder' => 202,
            'visible' => true,
            'imports' => [
                'initialOptions' => 'index = checkoutProvider:dictionaries.delivery_date',
                'setOptions' => 'index = checkoutProvider:dictionaries.delivery_date'
            ]
        ];
    }
}