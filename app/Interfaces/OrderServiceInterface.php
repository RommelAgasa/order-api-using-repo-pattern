<?php

namespace App\Interfaces;

interface OrderServiceInterface{
    public function getAllOrders();
    public function getOrderById($id);
    public function deleteOrder($id);
    public function createOrder(array $orderDetails);
    public function updateOrder($id, array $orderDetails);
    public function getFulfilledOrders();
    public function markAsFullFilled($id);
}