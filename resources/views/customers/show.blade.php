@extends('layouts.app')

@section('title', 'New Customer')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('New Customer') }}</h1>
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
          <form method="post">
            <div class="form-row">
              <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="input-name">Customer Name</label>
                  <input type="text" id="input-name" class="form-control" value="{{ $customer->name }}" readonly>
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="input-cpf">Customer CPF</label>
                  <input type="text" id="input-cpf" class="form-control cpf"
                         value="{{ $customer->cpf }}}" readonly>
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="form-group">
                  <label for="input-email">Customer Email</label>
                  <input type="email" id="input-email" class="form-control"
                         value="{{ $customer->email }}" readonly>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--/div-->
@endsection
