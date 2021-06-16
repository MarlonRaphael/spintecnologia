<?php

namespace App\Http\Controllers;

use App\DataTables\CustomersDataTable;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(CustomersDataTable $dataTable)
  {
//    $customer = Customer::first();
//
//    dd(resource_url($customer, 'create'));

    return $dataTable->render('customers.index');
  }

  public function create()
  {
    return view('customers.create');
  }

  public function show(Customer $customer)
  {
    return view('customers.show', [
      'customer' => $customer
    ]);
  }

  public function store(CreateCustomerRequest $request)
  {
    $validated = $request->validated();

    if ($validated) {

      Customer::create($validated);

    }

    return redirect()
      ->route('customers.index');
  }

  public function edit(Customer $customer)
  {
    return view('customers.edit', [
      'customer' => $customer
    ]);
  }

  public function update(UpdateCustomerRequest $request, Customer $customer)
  {
    $validated = $request->validated();

    if ($validated) {

      $customer->update($validated);

    }

    return redirect()
      ->route('customers.index');
  }

  public function destroy(Customer $customer)
  {
    $customer->delete();

    return redirect()
      ->route('customers.index');

  }
}
