<?php

class Order {
    const STATUS_PROCESSING = 12;

    public function setStatus(int $status)
    {

    }

}

class ProcessedOrderFilter {

}

class Invoice {

}

class InvoicingService {
    public function sendInvoice(string $email, Invoice $invoice)
    {
    }
}

class OrderProcessor {
    /**
     * @var Order[]
     */
    private $orderList = [];

    /**
     * @var InvoicingService
     */
    private $invoicingService;

    /**
     * @param $orders Order[]
     */
    public function __construct($orders)
    {
        $this->orderList = $orders;
        $this->invoicingService = new InvoicingService();
    }

    private function addToProcessing(array $orders) {
        foreach($orders as $order) {
            $order->setStatus(Order::STATUS_PROCESSING);
        }

        array_merge($this->orderList, $orders);
    }

    public function addOrders($orders) : void {
        $this->log($orders);
        $this->addToProcessing($orders);
    }

    public function processOrders()
    {
        $order = array_shift($this->orderList);

        if (!$order) {
            return;
        }

        $this->invoicingService->sendInvoice(
            $order->getUser()->getEmail(),
            $order->getInvoice()
        );
    }

    private function log(array $orders)
    {
    }
}


class LoggedOrderProcessor extends OrderProcessor {
    private function log(array $orders)
    {
    }

    public function addOrders($orders) : void {
        $this->log($orders);
        parent::addOrders($orders);
    }
}

interface ProcessorInterface {
    public function addOrders($orders) : void;
}

class LoggingProcessorDecorator implements ProcessorInterface {
    private $processor;

    private function log(array $orders) {}

    public function __construct(ProcessorInterface $processor)
    {
        $this->processor = $processor;
    }

    public function addOrders($orders) : void {
        $this->log($orders);
        $this->processor->addOrders($orders);
    }
}

