<?php
namespace Customprice\Checkoutprice\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class Discountprice implements ObserverInterface
{
    protected $_customerSession;    // don't name this `$_session` since it is already used in \Magento\Customer\Model\Session and your override would cause problems

    public function __construct(
    \Magento\Customer\Model\Session $session
    ){
        $this->_customerSession = $session;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {
        $item = $observer->getEvent()->getData('quote_item');
        $item = ( $item->getParentItem() ? $item->getParentItem() : $item );
        
        $product = $observer->getProduct();
        $price = $product->getFinalPrice();

        if ($this->_customerSession->isLoggedIn()){
            $price = ($price*95)/100; //set your price here
        }
        $item->setCustomPrice($price);
        $item->setOriginalCustomPrice($price);
        $item->getProduct()->setIsSuperMode(true);
    }
 
}

