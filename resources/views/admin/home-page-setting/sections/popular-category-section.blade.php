@php
    $popularCategorySection = json_decode($popularCategories->value ?? '[]');
    dd($popularCategorySection);

@endphp

<div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.popular-category-section') }}" method="POST">
                @csrf
                @method('PUT')

                <h5>Category 1</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control main-category"  data-height="100%" name="cat_one" >
                            <option value="">--Select--</option>
                            @foreach ($categories as $category)
                                <option {{ $category->id==$popularCategorySection[0]->category ? 'selected': ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sub Category</label>
                            <select class="form-control sub-category"  data-height="100%" name="sub_cat_one" >

                                @php
                                    $subcategories = \App\Models\SubCategory::where('category_id', $popularCategorySection[0]->category)->get();

                                @endphp
                                <option >--Select--</option>

                                @foreach ($subcategories as $subcategory)
                                <option {{ $subcategory->id==$popularCategorySection[0]->sub_category ? 'selected': ''}} value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Child Category</label>
                            <select class="form-control child-category"  data-height="100%" name="child_cat_one" >
                                <option >--Select--</option>
                                @php
                                    $childcategories = \App\Models\ChildCategory::where('sub_category_id', $popularCategorySection[0]->sub_category)->get();

                                @endphp
                                @foreach ($childcategories as $childcategory)
                                    <option {{ $childcategory->id==$popularCategorySection[0]->child_category ? 'selected': ''}} value="{{ $childcategory->id }}">{{ $childcategory->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>

                <h5>Category 2</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control main-category"  data-height="100%" name="cat_two" >
                            <option value="">--Select--</option>
                            @foreach ($categories as $category)
                                <option {{ $category->id==$popularCategorySection[1]->category ? 'selected': ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sub Category</label>
                            <select class="form-control sub-category"  data-height="100%" name="sub_cat_two" >

                            @php
                                    $subcategories = \App\Models\SubCategory::where('category_id', $popularCategorySection[1]->category)->get();

                                @endphp
                                <option >--Select--</option>

                                @foreach ($subcategories as $subcategory)
                                <option {{ $subcategory->id==$popularCategorySection[1]->sub_category ? 'selected': ''}} value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Child Category</label>
                            <select class="form-control child-category"  data-height="100%" name="child_cat_two" >

                            @php
                                    $childcategories = \App\Models\ChildCategory::where('sub_category_id', $popularCategorySection[1]->sub_category)->get();

                                @endphp
                                @foreach ($childcategories as $childcategory)
                                    <option {{ $childcategory->id==$popularCategorySection[1]->child_category ? 'selected': ''}} value="{{ $childcategory->id }}">{{ $childcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h5>Category 3</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control main-category"  data-height="100%" name="cat_three" >
                            <option value="">--Select--</option>
                            @foreach ($categories as $category)
                                <option {{ $category->id==$popularCategorySection[2]->category ? 'selected': ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sub Category</label>
                            <select class="form-control sub-category"  data-height="100%" name="sub_cat_three" >

                            @php
                                    $subcategories = \App\Models\SubCategory::where('category_id', $popularCategorySection[2]->category)->get();

                                @endphp
                                <option >--Select--</option>

                                @foreach ($subcategories as $subcategory)
                                <option {{ $subcategory->id==$popularCategorySection[2]->sub_category ? 'selected': ''}} value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Child Category</label>
                            <select class="form-control child-category"  data-height="100%" name="child_cat_three" >

                            @php
                                    $childcategories = \App\Models\ChildCategory::where('sub_category_id', $popularCategorySection[2]->sub_category)->get();

                                @endphp
                                @foreach ($childcategories as $childcategory)
                                    <option {{ $childcategory->id==$popularCategorySection[2]->child_category ? 'selected': ''}} value="{{ $childcategory->id }}">{{ $childcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h5>Category 4</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control main-category"  data-height="100%" name="cat_four">
                            <option value="">--Select--</option>
                            @foreach ($categories as $category)
                                <option {{ $category->id==$popularCategorySection[3]->category ? 'selected': ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sub Category</label>
                            <select class="form-control sub-category"  data-height="100%" name="sub_cat_four" >

                            @php
                                    $subcategories = \App\Models\SubCategory::where('category_id', $popularCategorySection[3]->category)->get();

                                @endphp
                                <option >--Select--</option>

                                @foreach ($subcategories as $subcategory)
                                <option {{ $subcategory->id==$popularCategorySection[3]->sub_category ? 'selected': ''}} value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Child Category</label>
                            <select class="form-control child-category"  data-height="100%" name="child_cat_four" >

                            @php
                                    $childcategories = \App\Models\ChildCategory::where('sub_category_id', $popularCategorySection[3]->sub_category)->get();

                                @endphp
                                @foreach ($childcategories as $childcategory)
                                    <option {{ $childcategory->id==$popularCategorySection[3]->child_category ? 'selected': ''}} value="{{ $childcategory->id }}">{{ $childcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
  <script>
    $(document).ready(function(e){

        $('body').on('change', '.main-category', function(){

            let id = $(this).val();
            let row = $(this).closest('.row');

            $.ajax({
                method: 'GET',
                url   : "{{ route('admin.get-subcategories') }}",
                data : {
                    'id' : id
                },
                success : function(data){
                    let selector = row.find('.sub-category');
                    selector.html('<option >--Select--</option>');
                    $.each(data, function(i, item){
                        selector.append(`<option value="${item.id}">${item.name}</option>`);
                    });
                },
                error : function(xhr , status, error){
                    console.log(error);
                }
            });

        });

        $('body').on('change', '.sub-category', function(){

            let id = $(this).val();
            let row = $(this).closest('.row');

            $.ajax({
                method: 'GET',
                url   : "{{ route('admin.product.get-child-categories') }}",
                data : {
                    'id' : id
                },
                success : function(data){
                    let selector = row.find('.child-category');
                    selector.html('<option >--Select--</option>');
                    $.each(data, function(i, item){
                        selector.append(`<option value="${item.id}">${item.name}</option>`);
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
