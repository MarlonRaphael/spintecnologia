@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')

  <!-- Custom styles for this page -->
  <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endpush

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('Products') }}</h1>
  </div>

  <!-- Content Row -->
  <div class="row">
    <!--div-->
    <div class="col-xl-12">
      <div class="card mg-b-20">
        <div class="card-header py-0">
          <div class="d-flex justify-content-between align-items-center py-3">
            <h5 class="card-title mg-b-0 mb-0">{{ __('Products') }}</h5>
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
              <i class="fas fa-plus mx-2"></i> Add New
            </a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            {!! $dataTable->table(['class' => 'table key-buttons text-md-nowrap table-hover table-sm'], true) !!}
          </div>
        </div>
      </div>
    </div>
    <!--/div-->
@endsection

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

  {!! $dataTable->scripts() !!}

@endpush
