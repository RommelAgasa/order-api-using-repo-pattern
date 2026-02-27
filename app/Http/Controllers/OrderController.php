<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Interfaces\OrderServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    private OrderServiceInterface $orderService;

    public function __construct(OrderServiceInterface $orderService){
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->orderService->getAllOrders();
        return response()->json(data: [
            'success' => true,
            'order_count' => count($data),
            'orders' => $data
        ], status: Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {

        $request->validated();

        $orderDetails = $request->only([
            'customer_id',
            'details'
        ]);

        $order = $this->orderService->createOrder($orderDetails);

        return response()->json(
            data:[
                'success' => true,
                'order' => new OrderResource($order)
            ],
            status: Response::HTTP_CREATED
        );

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json(
            data:[
                'success' => true,
                'order' => new OrderResource($order)
            ],
            status: Response::HTTP_OK
        );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $request->validated();

        $orderDetails =$request->only([
            'customer_id',
            'details'
        ]);

        $this->orderService->updateOrder($order->id, $orderDetails);

        return response()->json(
            data:[
                'success' => true,
                'order' => new OrderResource($order->fresh())
            ],
            status: Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        return response()->json(
            data:[
                'success' => $this->orderService->deleteOrder($order->id) > 0
            ],
            status: Response::HTTP_OK
        );
    }
}
