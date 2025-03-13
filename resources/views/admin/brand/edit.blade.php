@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Brand</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Brand</a></div>
        <div class="breadcrumb-item">Edit Brand</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">

        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Brand</h4>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form action="{{ route('admin.brand.update' , $brand->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">

                        <label>Logo</label><br/>
                        <img src="{{ asset($brand->logo) }}" alt="" width="100px">
                        <input type="file" class="form-control" name="logo">
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $brand->name }}">
                    </div>
                    <div class="form-group">
                        <label>Is Featuted</label>
                        <select class="form-control"  data-height="100%" name="is_featured" value={{ old('is_featured') }}>
                          <option value="">--Select--</option>
                          <option {{ $brand->is_featured==1 ?'selected':'' }} value="1">Yes</option>
                          <option {{ $brand->is_featured==1 ?'selected':'' }} value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control"  data-height="100%" name="status" >
                          <option {{ $brand->status==1 ?'selected':'' }} value="1">Active</option>
                          <option {{ $brand->status==0 ?'selected':'' }} value="0">Inactive</option>
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
