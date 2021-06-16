@extends('layouts.app')

@section('title', 'New Order')

{{--@dd($errors)--}}

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('New Order') }}</h1>
    <a href="{{ route('orders.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
      <i class="fas fa-long-arrow-alt-left fa-sm text-white-50 mx-2"></i> Back
    </a>
  </div>
  <!-- Content Row -->
  <div class="row my-4">
    <!--div-->
    <div class="col-xl-12">
      <div class="card mg-b-20">
        <div class="card-body">
          <h5 class="my-4">Create New Order</h5>
          <form action="{{ route('orders.store') }}" method="post">
            @csrf
            <div class="container-fluid" id="listItems">
              <div class="form-row mb-4">
                <div class="col-12">
                  <button type="button" id="addItem" class="btn btn-success btn-sm">Add Item</button>
                </div>
              </div>
              <div class="form-row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label for="select-customer">Customer</label>
                    <select name="customer_id" id="select-customer" class="custom-select" required>
                      <option disabled selected>Select an customer...</option>
                      @forelse($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                      @empty
                        <option disabled>No registered customer</option>
                      @endforelse
                    </select>
                  </div>
                </div>
                <div class="col-3 col-sm-3 col-md-2 col-lg-2">
                  <div class="form-group">
                    <label for="inputDiscount">Discount</label>
                    <input type="text" name="discount" id="inputDiscount"
                           class="form-control money @error('discount') is-invalid @enderror"
                           value="{{ old('discount', '') }}" placeholder="0,00">
                    @error('discount')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="form-row align-items-center item" id="item-0">
                <div class="col-9 col-sm-9 col-md-4 col-lg-4">
                  <div class="form-group">
                    <label for="selectItem-0">Product</label>
                    <select name="items[0][product_id]" id="selectItem-0" class="custom-select" required>
                      <option disabled selected>Select an item...</option>
                      @forelse($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                      @empty
                      @endforelse
                    </select>
                  </div>
                </div>
                <div class="col-3 col-sm-3 col-md-2 col-lg-2">
                  <div class="form-group">
                    <label for="inputQuantityItem-0">Quantity</label>
                    <input type="number" name="items[0][quantity]" id="inputQuantityItem-0" class="form-control"
                           required>
                  </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-6"></div>
                <div class="clearfix"></div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-12 text-right">
                <button type="submit" class="btn btn-primary btn-sm">
                  <i class="far fa-save mx-2"></i> Save
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--/div-->
    @endsection

    @push('scripts')
      <script>

        let products = @json($products);

        let lstItems = $("#listItems");

        let btnAddItem = $("#addItem");

        btnAddItem.on('click', lstItems, function (e) {

          e.preventDefault();

          let counter = lstItems.find('.item').length;

          let rowItem = `
          <div class="form-row align-items-center item" id="item-${counter}">
            <div class="col-9 col-sm-9 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="selectItem-${counter}">Product</label>
                <select name="items[${counter}][product_id]" id="selectItem-${counter}"
                        class="custom-select" required>
                  <option disabled selected>Select an item...</option>
                </select>
              </div>
            </div>
            <div class="col-3 col-sm-3 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="inputQuantityItem-${counter}">Quantity</label>
                <input type="number" name="items[${counter}][quantity]" id="inputQuantityItem-${counter}"
                       class="form-control" required>
              </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
              <button type="button" class="btn btn-secondary btn-remove mt-2" data-value="${counter}">Delete</button>
            </div>
            <div class="clearfix"></div>
          </div>`;

          lstItems.append(rowItem);

          if (products.length > 0) {

            let newListItem = lstItems.find(`#selectItem-${counter}`);

            products.forEach(function (product) {
              newListItem.append(`<option value="${product.id}">${product.name}</option>`);
            });

          }

        });

        lstItems.on("click", ".btn-remove", function (e) {

          e.preventDefault();

          $(this).closest('.item').remove();

          refreshInputs();


        });

        function refreshInputs() {
          let items = lstItems.find('.item');

          let count = 0;

          items.each(function (index, element) {

            let elItem = $(`#${element.id}`);

            elItem.attr('id', `item-${count}`);

            let idSelect = `selectItem-${count}`;
            let idInput = `inputQuantityItem-${count}`;

            let nameSelect = `items[${count}][product_id]`;
            let nameInput = `items[${count}][quantity]`;

            let elSelectItem = elItem.find('select');
            let elInputItem = elItem.find('input');

            elSelectItem.attr('id', idSelect);
            elSelectItem.attr('name', nameSelect);

            elInputItem.attr('id', idInput);
            elInputItem.attr('name', nameInput);

            count++;

            // console.log(element.id);

          });
        }


      </script>
  @endpush
