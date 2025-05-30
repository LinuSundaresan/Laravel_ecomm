<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.general-settings-update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Site Name</label>
                    <input type="text" class="form-control" name="site_name"  value="{{ $generalSetting->site_name }}">
                </div>
                <div class="form-group">
                    <label>Layout</label>
                    <select class="form-control"  data-height="100%" name="layout" value={{ old('layout') }}>
                      <option value="LTR">LTR</option>
                      <option value="RTL">RTL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Contact Email</label>
                    <input type="text" class="form-control" name="contact_email" value="{{ $generalSetting->contact_email }}">
                </div>
                <div class="form-group">
                    <label>Default Currency</label>
                    <select class="form-control select2"  data-height="100%" name="currency_name" value={{ old('currency_name') }}>
                        <option value="$">--Select--</option>
                        @foreach ( config('settings.currency_list') as $currency)
                            <option value="{{ $currency }}">{{ $currency }}</option>
                        @endforeach


                    </select>
                </div>
                <div class="form-group">
                    <label>Currency Icon</label>
                    <input type="text" class="form-control" name="currency_icon" value="{{ $generalSetting->currency_icon }}">
                </div>

                <div class="form-group">
                    <label>Timezone</label>
                    <select class="form-control select2"  data-height="100%" name="time_zone" value={{ old('time_zone') }}>
                        <option value="$">--Select--</option>
                        @foreach ( config('settings.time_zone') as $key=>$timezone)
                            <option value="{{ $key }}">{{ $key }}</option>
                        @endforeach


                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
  </div>
