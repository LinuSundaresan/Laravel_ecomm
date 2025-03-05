@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Childcategory</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Category</a></div>
        <div class="breadcrumb-item">Create Childcategory</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">

        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Childcategory</h4>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form action="{{ route('admin.child-category.update' , $childCategory->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control main-category"  data-height="100%" name="category_id" value={{ old('category') }}>
                          <option >--Select--</option>
                          @foreach ($categories as $category)
                            <option {{ $childCategory->category_id == $category->id ? 'selected' : '' }} value={{ $category->id }}>{{ $category->name }}</option>
                          @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Sub Category</label>
                        <select class="form-control sub-category"  data-height="100%" name="sub_category_id" >
                          <option >--Select--</option>
                          @foreach ($subcategories as $subcategory)
                            <option {{ $childCategory->category_id == $subcategory->id ? 'selected' : '' }} value={{ $subcategory->id }}>{{ $subcategory->name }}</option>
                          @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name"  value="{{ $childCategory->name }}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control"  data-height="100%" name="status" value={{ old('status') }}>
                          <option {{ $childCategory->status==1?'selected':'' }} value="1">Active</option>
                          <option {{ $childCategory->status==0?'selected':'' }} value="0">Inactive</option>
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

@push('scripts')
  <script>
    $(document).ready(function(e){

        $('body').on('change', '.main-category', function(){

            let id = $(this).val();

            $.ajax({
                method: 'GET',
                url   : "{{ route('admin.get-subcategories') }}",
                data : {
                    'id' : id
                },
                success : function(data){
                    $('.sub-category').html('<option >--Select--</option>');
                    $.each(data, function(i, item){
                        $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`);
                    });
                },
                error : function(xhr , status, error){
                    console.log(error);
                }
            });

        });

    });

  </script>
@endpush
