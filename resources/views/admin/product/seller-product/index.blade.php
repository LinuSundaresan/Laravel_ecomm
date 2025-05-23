@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Seller Products</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Products</a></div>
        <div class="breadcrumb-item">Table</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">

        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>All Seller Products</h4>

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
                let product_id = $(this).data('id');

                $.ajax({
                    'url': "{{ route('admin.product.update-status') }}",
                    'method': 'PUT',
                    'data': {
                        'status' : isChecked,
                        'id' : product_id
                    },
                    'success': function (data) {
                        console.log(data);
                        toastr.success(data.message);
                    },
                    'error': function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })


        });
    </script>
@endpush
