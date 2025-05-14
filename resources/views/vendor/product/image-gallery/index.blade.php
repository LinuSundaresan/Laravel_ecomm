@extends('vendor.layouts.master')

@section('content')

<section id="wsus__dashboard">
    <div class="container-fluid">

      @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Product Image Gallery</h3>

            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <div class="table-responsive">

                    <form action="{{ route('admin.products-image-gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group wsus_input">
                            <label for="image">Image <code>(Multiple image supported!)</code></label>
                            <input type="file" class="form-control" name="image[]" multiple />
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>

                  </div>
              </div>




            </div>
          </div>
        </div>
      </div>



      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Product Images</h3>

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
@endpush



