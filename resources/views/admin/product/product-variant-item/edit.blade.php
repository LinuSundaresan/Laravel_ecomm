@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Product Variants</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Product Variant Item</a></div>
        <div class="breadcrumb-item">Edit Product Variant item</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">

        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Product Variant Item</h4>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form action="{{ route('admin.products-variant-item.update' , $variantData->id) }}" method="POST" >
                    @csrf
                    @method('PUT');
                    <div class="form-group">
                        <label>Variant Name</label>
                        <input type="text" class="form-control" name="variant_name"  value="{{ $variantData->productVariant->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Item Name</label>
                        <input type="text" class="form-control" name="name"  value="{{ $variantData->name }}">
                    </div>

                    <div class="form-group">
                        <label>Price <code>(Set 0 for make it free)</code></label>
                        <input type="text" class="form-control" name="price" value="{{ $variantData->price }}">
                    </div>

                    <div class="form-group">
                        <label>Is Default</label>
                        <select class="form-control"  data-height="100%" name="is_default">
                          <option value="">--Select--</option>
                          <option value="1" {{ $variantData->is_default==1 ? 'selected' : '' }}>Yes</option>
                          <option value="0" {{ $variantData->is_default==0 ? 'selected' : '' }} >No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control"  data-height="100%" name="status" value={{ old('status') }}>
                          <option value="1" {{ $variantData->status==1 ? 'selected' : '' }}>Active</option>
                          <option value="0" {{ $variantData->status==0 ? 'selected' : '' }}>Inactive</option>
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
