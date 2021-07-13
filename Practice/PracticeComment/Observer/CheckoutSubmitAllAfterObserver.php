<?php
namespace Practice\PracticeComment\Observer;

class CheckoutSubmitAllAfterObserver implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
        if (empty($order) || empty($quote)) {
            return $this;
        }

        $shippingAddressComment = $quote->getShippingAddress();
        if ($shippingAddressComment->getDeliveryComment()) {
            $orderShippingAddress = $order->getShippingAddress();
            $orderShippingAddress->setDeliveryComment(
                $shippingAddressComment->getDeliveryComment()
            )->save();
        }

        $shippingAddressDate = $quote->getShippingAddress();
        if ($shippingAddressDate->getDeliveryDate()) {
            $orderShippingAddress = $order->getShippingAddress();
            $orderShippingAddress->setDeliveryDate(
                $shippingAddressDate->getDeliveryDate()
            )->save();
        }

        return $this;
    }
}