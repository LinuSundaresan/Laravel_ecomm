@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Product Image Gallery</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Product Image Gallery</a></div>
        <div class="breadcrumb-item">Table</div>
      </div>
    </div>

    <div class="section-body">

        <a href="{{ route('admin.products.index') }}" class="btn btn-primary mb-3">Back</a>
        <div class="row">

            <div class="col-12 col-md-6 col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Product : {{ $product->name }}</h4>

                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products-image-gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
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

      <div class="row">

        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>All Images</h4>

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
@endpush
