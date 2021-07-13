<?php
namespace Practice\PracticeComment\Plugin\Checkout\Model;

class ShippingInformationManagement
{
    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        $shippingAddressComment = $addressInformation->getShippingAddress();
        $shippingExtensionAttributes = $shippingAddressComment->getExtensionAttributes();
        if (!empty($shippingExtensionAttributes)) {
            $shippingExtensionAttributes = $shippingAddressComment->getExtensionAttributes();
            if (!empty($shippingExtensionAttributes)) {
                $shippingAddressComment->setDeliveryComment($shippingExtensionAttributes->getDeliveryComment());
            }
        }

        $shippingAddressDate = $addressInformation->getShippingAddress();
        $shippingExtensionAttributes = $shippingAddressDate->getExtensionAttributes();
        if (!empty($shippingExtensionAttributes)) {
            $shippingExtensionAttributes = $shippingAddressDate->getExtensionAttributes();
            if (!empty($shippingExtensionAttributes)) {
                $shippingAddressDate->setDeliveryDate($shippingExtensionAttributes->getDeliveryDate());
            }
        }
    }
}