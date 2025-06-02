@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Shipping Rule</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Shipping Rule</a></div>
        <div class="breadcrumb-item">Create Shipping Rule</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">

        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Shipping Rule</h4>

            </div>
            <div class="card-body">
              <div>
                <form action="{{ route('admin.shipping-rule.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name"  value={{ old('name') }}>
                    </div>

                    <div class="form-group">
                      <label>Type</label>
                      <select class="form-control shipping_type"  data-height="100%" name="type" value={{ old('type') }}>
                        <option value="flat_cost">Flat Cost</option>
                        <option value="min_cost">Minimum Order Amount</option>
                      </select>
                    </div>

                    <div class="form-group min_cost d-none">
                      <label>Minimum Amount</label>
                      <input type="text" class="form-control" name="min_cost"  value={{ old('min_cost') }}>
                    </div>

                    <div class="form-group">
                      <label>Cost</label>
                      <input type="text" class="form-control" name="cost"  value={{ old('cost') }}>
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

@push('scripts')

<script>
    $('document').ready(function(){
        $('body').on('change', '.shipping_type', function(){
          if($(this).val() == 'flat_cost'){
            $('.min_cost').addClass('d-none');
          } else {
            $('.min_cost').removeClass('d-none');
          }
        })

    });
</script>
@endpush

