<div class="tab-pane fade " id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.stripe-setting.index' , 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Stripe Status</label>
                    <select class="form-control"  data-height="100%" name="status" value={{ old('status') }}>
                      <option value="1" {{ $stripeSettings->status==1?'selected': '' }}>Enable</option>
                      <option value="0" {{ $stripeSettings->status==0?'selected': '' }}>Disable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Account Mode</label>
                    <select class="form-control"  data-height="100%" name="mode" value={{ old('mode') }}>
                      <option value="0" {{ $stripeSettings->mode==0?'selected': '' }}>Sandbox</option>
                      <option value="1" {{ $stripeSettings->mode==1?'selected': '' }}>Live</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Country</label>
                    <select class="form-control select2"  data-height="100%" name="country_name" >
                        @foreach (config('settings.country_list') as $country)
                            <option {{ $stripeSettings->country_name==$country ?'selected': '' }} value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency</label>
                    <select class="form-control select2"  data-height="100%" name="currency_name" >
                        @foreach (config('settings.currency_list') as $key => $currency)
                            <option value="{{ $currency }}" {{ $stripeSettings->currency_name==$currency ?'selected': '' }}>{{ $key }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Rate (Per INR)</label>
                    <input type="text" class="form-control" name="currency_rate" value="{{ $stripeSettings->currency_rate }}">
                </div>

                <div class="form-group">
                    <label>Stripe Client ID</label>
                    <input type="text" class="form-control" name="client_id"  value="{{ $stripeSettings->client_id }}">
                </div>

                <div class="form-group">
                    <label>Stripe Secret Key</label>
                    <input type="text" class="form-control" name="secret_key" value="{{ $stripeSettings->secret_key }}">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
  </div>
