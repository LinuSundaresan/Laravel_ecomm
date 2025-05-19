@extends('vendor.layouts.master')

@section('content')

<section id="wsus__dashboard">
    <div class="container-fluid">

      @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Create Product Variant</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <div class="table-responsive">

                    <form action="{{ route('vendor.products-variant.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" class="form-control" name="product_id"  value={{ request()->product }}>

                        <div class="form-group wsus_input">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name"  value={{ old('name') }}>
                        </div>
                        <div class="form-group wsus_input">
                            <label>Status</label>
                            <select class="form-control"  data-height="100%" name="status" value={{ old('status') }}>
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                          </div>
                        <button type="submit" class="btn btn-primary">Create</button>
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
