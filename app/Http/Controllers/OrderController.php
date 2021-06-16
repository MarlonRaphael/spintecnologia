<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;
use App\Enums\OrderStatus;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(OrdersDataTable $dataTable)
  {
    return $dataTable->render('orders.index');
  }

  public function create()
  {
    return view('orders.create', [
      'customers' => Customer::all(),
      'products' => Product::all(),
    ]);
  }

  public function store(CreateOrderRequest $request)
  {
    $validated = $request->validated();

    if ($validated) {

      if ($order = Order::create($validated)) {

        if (count($validated['items'])) {
          $order->products()->sync($validated['items']);
        }

        $total = $order->products->sum(function ($product) {
          return $product->pivot->quantity * $product->price;
        });

        $amount = $total - $validated['discount'];

        $order->total = $amount;

        $order->save();

      }

      return redirect()
        ->route('orders.index');

    }

    return redirect()
      ->route('orders.index');

  }

  public function edit(Order $order)
  {
    $order->load(['customer', 'products']);

    return view('orders.edit', [
      'order' => $order,
      'products' => Product::all()
    ]);
  }

  public function update(UpdateOrderRequest $request, Order $order)
  {
    $validated = $request->validated();

    if ($validated) {

      $order->discount = $validated['discount'];

      if (count($validated['items'])) {

        $order->products()->detach();

        $order->products()->sync($validated['items']);
      }

      $total = $order->products->sum(function ($product) {
        return $product->pivot->quantity * $product->price;
      });

      $amount = $total - $validated['discount'];

      $order->total = $amount;

      $order->save();

      return redirect()
        ->route('orders.index');

    }

    return redirect()
      ->route('orders.index');
  }

  public function destroy(Order $order)
  {
    $order->load(['customer', 'products']);

    $order->products()->detach();

    $order->delete();

    return redirect()
      ->route('orders.index');
  }

  public function payOrder(Order $order)
  {
    if (!$order->isPaid()) {
      $order->payOrder();
    }

    return redirect()
      ->route('orders.index');
  }

  public function cancelOrder(Order $order)
  {
    if (!$order->isCanceled()) {
      $order->cancelOrder();
    }

    return redirect()
      ->route('orders.index');
  }
}
