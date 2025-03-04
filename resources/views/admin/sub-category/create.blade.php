@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Subcategory</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Category</a></div>
        <div class="breadcrumb-item">Create Subcategory</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">

        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Subcategory</h4>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form action="{{ route('admin.sub-category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control"  data-height="100%" name="category_id" value={{ old('category') }}>
                          <option >--Select--</option>
                          @foreach ($categories as $category)
                            <option value={{ $category->id }}>{{ $category->name }}</option>
                          @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name"  value={{ old('name') }}>
                    </div>
                    <div class="form-group">
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
  </section>

@endsection
