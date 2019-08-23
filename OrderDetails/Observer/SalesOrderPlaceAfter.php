<?php
namespace Tychons\OrderDetails\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;

class SalesOrderPlaceAfter implements ObserverInterface
{
    protected $_order;

    protected $resourceConnection;

    public function __construct(
        \Magento\Sales\Api\Data\OrderInterface $order,
        \Magento\Framework\App\ResourceConnection $resourceConnection
    ) {
         $this->_order = $order;    
         $this->resourceConnection = $resourceConnection;    
    }

    /**
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        $order = $observer->getEvent()->getOrder();
        $orderTable = $this->resourceConnection->getTableName('tychons_order_details');
        $sql = "INSERT INTO " . $orderTable . "(entity_id, firstname, email, status, customer_id, created_at, updated_at) VALUES ('" . $order->getId() . "', '" . $order->getCustomerFirstname() . "', '" . $order->getCustomerEmail() . "', '" . $order->getStatus() . "', '" . $order->getCustomerId() . "', '" . $order->getCreatedAt() . "',  '" . $order->getUpdatedAt() . "')";
        $connection = $this->resourceConnection->getConnection()->query($sql);
    }

}

