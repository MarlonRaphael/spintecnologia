@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('Edit Customer') }}</h1>
    <a href="{{ route('customers.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
      <i class="fas fa-long-arrow-alt-left fa-sm text-white-50 mx-2"></i> Back
    </a>
  </div>
  <!-- Content Row -->
  <div class="row my-4">
    <!--div-->
    <div class="col-xl-12">
      <div class="card mg-b-20">
        <div class="card-body">
          <form action="{{ route('customers.update', $customer->id) }}" method="post">
            @csrf
            @method('put')
            <div class="form-row">
              <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="input-name">Customer Name</label>
                  <input type="text" name="name" id="input-name"
                         class="form-control @error('name') is-invalid @enderror"
                         value="{{ old('name', $customer->name) }}" placeholder="Customer Name" required autofocus>
                  @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="input-cpf">Customer CPF</label>
                  <input type="text" name="cpf" id="input-cpf"
                         class="form-control cpf @error('cpf') is-invalid @enderror"
                         value="{{ old('cpf', $customer->cpf) }}" placeholder="Customer CPF"
                         max="14" maxlength="14" required>
                  @error('cpf')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="input-email">Customer Email</label>
                  <input type="email" name="email" id="input-email"
                         class="form-control @error('email') is-invalid @enderror"
                         value="{{ old('email', $customer->email) }}" placeholder="Customer Email" required>
                  @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-12 text-right">
                <button type="submit" class="btn btn-primary btn-sm">
                  <i class="fas fa-sync mx-2"></i> Update
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--/div-->
@endsection
