@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} | Update Product Variants
@endsection

@section('content')

<section id="wsus__dashboard">
    <div class="container-fluid">

      @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Update Product Variant</h3>

            <a href="{{ route('vendor.products-variant.index',['product'=>$varient->product_id]) }}" class="btn btn-primary my-3"> <i class="fas fa-long-arrow-alt-left"></i> Back</a>

            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <div class="table-responsive">

                    <form action="{{ route('vendor.products-variant.update' , $varient->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group wsus_input">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name"  value="{{ $varient->name }}">
                        </div>
                        <div class="form-group wsus_input">
                            <label>Status</label>
                            <select class="form-control"  data-height="100%" name="status" value="">
                              <option value="1" {{ $varient->status==1 ? 'selected' : '' }}>Active</option>
                              <option value="0" {{ $varient->status==0 ? 'selected' : '' }}>Inactive</option>
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
