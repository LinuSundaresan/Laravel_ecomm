@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Sub Category</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Sub Category</a></div>
        <div class="breadcrumb-item">Edit Sub Category</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">

        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Edit Sub Category</h4>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form action="{{ route('admin.sub-category.update' , $subcategory->id ) }}" method="POST" >
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control"  data-height="100%" name="category_id" value={{ old('category') }}>
                          <option >--Select--</option>
                          @foreach ($categories as $category)
                            <option {{ $subcategory->category_id==$category->id ? 'selected' : '' }} value={{ $category->id }}>{{ $category->name }}</option>
                          @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name"  value="{{ $subcategory->name }}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control"  data-height="100%" name="status" >
                          <option value="1" {{ $subcategory->status==1 ? 'selected' : '' }}>Active</option>
                          <option value="0" {{ $subcategory->status==0 ? 'selected' : '' }}>Inactive</option>
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
