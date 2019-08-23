<?php
namespace Tychons\Order\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class OrderComplete implements ObserverInterface
{
/**
 * @var ObjectManagerInterface
 */
protected $_objectManager;
protected $order;
protected $scopeConfig;

/**
 * @param \Magento\Framework\ObjectManagerInterface $objectManager
 */
public function __construct(
    \Magento\Framework\ObjectManagerInterface $objectManager,
    \Magento\Quote\Model\QuoteFactory $quoteFactory,
    \Magento\Sales\Model\Order $order,
    ScopeConfigInterface $scopeConfig
) {
    $this->_objectManager = $objectManager;
    $this->order = $order;
    $this->scopeConfig = $scopeConfig;
    
}

/**
 *
 * @param \Magento\Framework\Event\Observer $observer
 * @return void
 */
public function execute(\Magento\Framework\Event\Observer $observer)
{
    $order = $observer->getEvent()->getOrder();   
    $orderId = $order->getId();
    $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/order.log');
    $logger = new \Zend\Log\Logger();
    $logger->addWriter($writer);
    $logger->info( $orderId );
}
}