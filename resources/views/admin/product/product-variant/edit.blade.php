@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Edit Product Variants</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Product Variant</a></div>
        <div class="breadcrumb-item">Edit Product Variant</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">

        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Edit Product Variant</h4>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form action="{{ route('admin.products-variant.update' , $varient->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" class="form-control" name="product_id"  value="{{ $varient->id }}">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name"  value={{ $varient->name }}>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control"  data-height="100%" name="status" value={{ old('status') }}>
                          <option {{ $varient->status==1 ? 'selected' : '' }} value="1">Active</option>
                          <option {{ $varient->status==0 ? 'selected' : '' }} value="0">Inactive</option>
                        </select>
                      </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
              </div>
            </div>

          </div>
        </div>

      </div>

    </div>
  </section>

@endsection
