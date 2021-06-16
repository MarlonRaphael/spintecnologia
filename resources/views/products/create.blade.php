@extends('layouts.app')

@section('title', 'New Product')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('New Product') }}</h1>
    <a href="{{ route('products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
      <i class="fas fa-long-arrow-alt-left fa-sm text-white-50 mx-2"></i> Back
    </a>
  </div>
  <!-- Content Row -->
  <div class="row my-4">
    <!--div-->
    <div class="col-xl-12">
      <div class="card mg-b-20">
        <div class="card-body">
          <form action="{{ route('products.store') }}" method="post">
            @csrf
            <div class="form-row">
              <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label for="input-name">Product Name</label>
                  <input type="text" name="name" id="input-name"
                         class="form-control @error('name') is-invalid @enderror"
                         value="{{ old('name', '') }}" placeholder="Product Name" required autofocus>
                  @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label for="input-description">Description</label>
                  <input type="text" name="description" id="input-description"
                         class="form-control @error('description') is-invalid @enderror"
                         value="{{ old('description', '') }}" placeholder="Description" required>
                  @error('description')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label for="input-price">Price</label>
                  <input type="text" name="price" id="input-price"
                         class="form-control money @error('price') is-invalid @enderror"
                         value="{{ old('price', '') }}" placeholder="0,00" required>
                  @error('price')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label for="input-barcode">Barcode</label>
                  <input type="text" name="barcode" id="input-barcode"
                         class="form-control @error('barcode') is-invalid @enderror"
                         value="{{ old('barcode', '') }}" placeholder="Barcode" min="10" max="15" maxlength="15" required>
                  @error('barcode')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
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
