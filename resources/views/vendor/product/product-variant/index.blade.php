@extends('vendor.layouts.master')

@section('content')

<section id="wsus__dashboard">
    <div class="container-fluid">

      @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <a href="{{ route('vendor.products.index',['product'=>$product->id]) }}" class="btn btn-primary my-3"> <i class="fas fa-long-arrow-alt-left"></i> Back</a>
            <h3><i class="far fa-user"></i>Product : {{ $product->name }}</h3>
            <div class="create-button"><a class="btn btn-primary" href="{{ route('vendor.products-variant.create', ['product'=>$product->id]) }}"><i class="fa fa-plus"></i> Create Product Variant</a></div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <div class="table-responsive">

                    {{ $dataTable->table() }}

                  </div>
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

