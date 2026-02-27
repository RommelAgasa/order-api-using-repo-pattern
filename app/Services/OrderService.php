<?php

namespace App\Services;

use App\Interfaces\OrderServiceInterface;
use App\Interfaces\OrderRepositoryInterface;

class OrderService implements OrderServiceInterface{

    protected OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAllOrders()
    {
        return $this->orderRepository->getAllOrders();
    }

    public function getOrderById($orderId)
    {
        return $this->orderRepository->getOrderById($orderId);
    }

    public function deleteOrder($orderId){
        return $this->orderRepository->deleteOrder($orderId);
    }

    public function createOrder(array $orderDetails){
        return $this->orderRepository->createOrder($orderDetails);
    }

    public function updateOrder($orderId, array $orderDetails){
        return $this->orderRepository->updateOrder($orderId, $orderDetails);
    }

    public function getFulfilledOrders(){
        return $this->orderRepository->getFulfilledOrders();
    }

    public function markAsFullFilled($id){
        $order = $this->getOrderById($id);
        return $order->update(['is_fullfilled' => true]);
    }

}