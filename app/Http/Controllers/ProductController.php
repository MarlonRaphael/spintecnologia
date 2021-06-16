<?php

namespace App\Http\Controllers;

use App\DataTables\ProductsDataTable;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(ProductsDataTable $dataTable)
  {
    return $dataTable->render('products.index');
  }

  public function create()
  {
    return view('products.create');
  }

  public function store(CreateProductRequest $request)
  {
    $validated = $request->validated();

    if ($validated) {

      if ($product = Product::create($validated)) {

        return redirect()
          ->route('products.index');

      }

    }

    return redirect()
      ->route('products.index');
  }

  public function edit(Product $product)
  {
    return view('products.edit', [
      'product' => $product
    ]);
  }

  public function update(UpdateProductRequest $request, Product $product)
  {
    $validated = $request->validated();

    if ($validated) {

      $product->update($validated);

      return redirect()
        ->route('products.index');

    }

    return redirect()
      ->route('products.index');

  }

  public function destroy(Product $product)
  {
    $product->delete();

    return redirect()
      ->route('products.index');
  }
}
