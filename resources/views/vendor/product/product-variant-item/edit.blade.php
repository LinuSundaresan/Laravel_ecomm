@extends('vendor.layouts.master')

@section('content')

<section id="wsus__dashboard">
    <div class="container-fluid">

      @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Update Product Variant Item</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <div class="table-responsive">
                    {{-- <a href="{{ route('vendor.products-variant-item.index', ['productId'=>$product->id , 'variantId'=>$variant->id]) }}" class="btn btn-primary mb-3">Back</a> --}}

                    <form action="{{ route('vendor.products-variant-item.update' , $variantData->id) }}" method="POST" >
                        @csrf
                        @method('PUT')
                        <div class="form-group wsus_input">
                            <label>Variant Name</label>
                            <input type="text" class="form-control" name="variant_name"  value="{{ $variantData->productVariant->name }}" readonly>
                        </div>
                        <div class="form-group wsus_input">
                            <label>Item Name</label>
                            <input type="text" class="form-control" name="name"  value="{{ $variantData->name }}">
                        </div>

                        <div class="form-group wsus_input" >
                            <label>Price <code>(Set 0 for make it free)</code></label>
                            <input type="text" class="form-control" name="price" value="{{ $variantData->price }}">
                        </div>

                        <div class="form-group wsus_input">
                            <label>Is Default</label>
                            <select class="form-control"  data-height="100%" name="is_default">
                              <option value="">--Select--</option>
                              <option value="1" {{ $variantData->is_default==1 ? 'selected' : '' }}>Yes</option>
                              <option value="0" {{ $variantData->is_default==0 ? 'selected' : '' }} >No</option>
                            </select>
                        </div>
                        <div class="form-group wsus_input">
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
    </div>
  </section>

@endsection
