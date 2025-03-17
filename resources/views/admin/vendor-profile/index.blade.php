@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Vendor Profile</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Vendor Profile</a></div>
        <div class="breadcrumb-item">Create Slider</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">

        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Update Vendor</h4>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form action="{{ route('admin.vendor-profile.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Preview</label><br/>
                        <img width="100px" src="{{ asset($vendor->banner) }}" alt="vendor_banner">
                    </div>

                    <div class="form-group">
                        <label>Banner</label>
                        <input type="file" class="form-control" name="banner">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone"  value={{ $vendor->phone }}>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email"  value={{ $vendor->email }}>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" value="{{ $vendor->address }}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="summernote" name="description">
                            {{ $vendor->description }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Facebook</label>
                        <input type="text" class="form-control" name="fb_link" value={{ $vendor->fb_link }}>
                    </div>
                    <div class="form-group">
                        <label>Twitter</label>
                        <input type="text" class="form-control" name="tw_link" value={{ $vendor->tw_link }}>
                    </div>
                    <div class="form-group">
                        <label>Instagram</label>
                        <input type="text" class="form-control" name="insta_link" value={{ $vendor->insta_link }}>
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
