@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Coupens</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Coupens</a></div>
        <div class="breadcrumb-item">Create Coupens</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">

        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Coupens</h4>

            </div>
            <div class="card-body">
              <div>
                <form action="{{ route('admin.coupens.update', $coupen->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name"  value={{ $coupen->name }}>
                    </div>

                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" class="form-control" name="code"  value={{ $coupen->code }}>
                    </div>

                    <div class="form-group">
                        <label>Qty</label>
                        <input type="text" class="form-control" name="quantity"  value={{ $coupen->quantity }}>
                    </div>

                    <div class="form-group">
                      <label>Max use per person</label>
                      <input type="text" class="form-control" name="max_use"  value={{ $coupen->max_use }}>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Start Date</label>
                            <input type="text" class="form-control datepicker" name="start_date"  value={{ $coupen->start_date }}>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>End Date</label>
                            <input type="text" class="form-control datepicker" name="end_date"  value={{ $coupen->end_date }}>
                        </div>
                    </div>

                    <div class="row mb-5">

                      <div class="col-md-4">
                        <label>Discount Type</label>
                        <select class="form-control" name="discount_type" >
                            <option >--Select--</option>
                            <option value="percent" {{ $coupen->discount_type=='percent'?'selected':'' }}>Percantage %</option>
                            <option value="amount" {{ $coupen->discount_type=='amount' ?'selected':'' }}>Amount</option>

                        </select>
                      </div>
                      <div class="col-md-8">
                          <label>Discount Value</label>
                          <input type="text" class="form-control" name="discount"  value={{ $coupen->discount }}>
                      </div>

                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control"  data-height="100%" name="status" value={{ old('status') }}>
                          <option value="1" {{ $coupen->status==1 ?'selected':'' }}>Active</option>
                          <option value="0" {{ $coupen->status==0 ?'selected':'' }}>Inactive</option>
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


