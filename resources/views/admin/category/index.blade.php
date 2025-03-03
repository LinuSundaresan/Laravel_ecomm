@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Categories</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Components</a></div>
        <div class="breadcrumb-item">Categories</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">

        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>List Categories</h4>
              <div class="card-header-action">
                <a href="{{ route('admin.category.create') }}" class="btn btn-primary">+ Create New</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                {{ $dataTable->table() }}
              </div>
            </div>

          </div>
        </div>

      </div>

    </div>
  </section>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $('document').ready(function(){
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let category_id = $(this).data('id');
            })
        });
    </script>


@endpush
