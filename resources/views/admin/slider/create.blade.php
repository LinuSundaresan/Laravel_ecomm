@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Slider</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Slider</a></div>
        <div class="breadcrumb-item">Create Slider</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">

        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Slider</h4>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Banner</label>
                        <input type="file" class="form-control" name="banner">
                      </div>
                    <div class="form-group">
                        <label>Type</label>
                        <input type="text" class="form-control" name="type"  value={{ old('type') }}>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title"  value={{ old('title') }}>
                    </div>
                    <div class="form-group">
                        <label>Starting price</label>
                        <input type="text" class="form-control" name="starting_price" value={{ old('starting_price') }}>
                    </div>
                    <div class="form-group">
                        <label>Button URL</label>
                        <input type="text" class="form-control" name="btn_url" value={{ old('btn_url') }}>
                    </div>
                    {{-- <div class="form-group">
                        <label>Serial</label>
                        <input type="text" class="form-control">
                    </div> --}}
                    <div class="form-group">
                        <label>Serial</label>
                        <input type="text" class="form-control" name="serial" value={{ old('serial') }}>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control"  data-height="100%" name="status" value={{ old('status') }}>
                          <option value="1">Active</option>
                          <option value="1">Inactive</option>
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
  </section>

@endsection
