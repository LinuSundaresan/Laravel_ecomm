<div class="tab-pane  active" id="list-razorpay" role="tabpanel" aria-labelledby="list-razorpay-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.razorpay-setting.index' , 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Paypal Status</label>
                    <select class="form-control"  data-height="100%" name="status" value={{ old('status') }}>
                      <option value="1" {{ $razorpaySettings->status==1?'selected': '' }}>Enable</option>
                      <option value="0" {{ $razorpaySettings->status==0?'selected': '' }}>Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Country</label>
                    <select class="form-control select2"  data-height="100%" name="country_name" >
                        @foreach (config('settings.country_list') as $country)
                            <option {{ $razorpaySettings->country_name==$country ?'selected': '' }} value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency</label>
                    <select class="form-control select2"  data-height="100%" name="currency_name" >
                        @foreach (config('settings.currency_list') as $key => $currency)
                            <option value="{{ $currency }}" {{ $razorpaySettings->currency_name==$currency ?'selected': '' }}>{{ $key }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Rate (Per INR)</label>
                    <input type="text" class="form-control" name="currency_rate" value="{{ $razorpaySettings->currency_rate }}">
                </div>

                <div class="form-group">
                    <label>Razorpay Key</label>
                    <input type="text" class="form-control" name="razorpay_key"  value="{{ $razorpaySettings->razorpay_key }}">
                </div>

                <div class="form-group">
                    <label>Razorpay Secret Key</label>
                    <input type="text" class="form-control" name="razorpay_secret_key" value="{{ $razorpaySettings->razorpay_secret_key }}">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
  </div>
