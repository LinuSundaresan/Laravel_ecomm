@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Product Variant Items</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Product Variant Items</a></div>
        <div class="breadcrumb-item">Table</div>
      </div>
    </div>

    <div class="section-body">
        <a href="{{ route('admin.products-variant.index', ['product'=>$product->id]) }}" class="btn btn-primary mb-3">Back</a>
      <div class="row">

        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Product Variant: {{ $variant->name }} </h4>
              <div class="card-header-action">
                <a href="{{ route('admin.products-variant-item.create', ['productId'=>$product->id, 'variantId'=>$variant->id] ) }}" class="btn btn-primary">+ Create New</a>
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
                let product_variant_id = $(this).data('id');

                $.ajax({
                    'url': "{{ route('admin.products-variant.update-status') }}",
                    'method': 'PUT',
                    'data': {
                        'status' : isChecked,
                        'id' : product_variant_id
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
