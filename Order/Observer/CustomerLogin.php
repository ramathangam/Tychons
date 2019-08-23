<?php

   namespace Tychons\Order\Observer;

   use Magento\Framework\Event\ObserverInterface;

   class Customerlogin implements ObserverInterface
   {        

   public function execute(\Magento\Framework\Event\Observer $observer)
   {   
    $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/customerdata.log');
    $logger = new \Zend\Log\Logger();
    $logger->addWriter($writer);
    $customer = $observer->getEvent()->getCustomer();
    $logger->info(print_r($customer->getEmail(),true));
    }
  }