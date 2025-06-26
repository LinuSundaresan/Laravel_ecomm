@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} | Order details
@endsection

@section('content')

@php
    $address = json_decode($order->order_address);
    $total = 0;
@endphp

<section id="wsus__dashboard">
    <div class="container-fluid">

    @include('vendor.layouts.sidebar')

    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Order Details</h3>

            <div>
                <div>
                    <section >
                        <div class="invoice-print">
                            <div class="wsus__invoice_area invoice-print">
                                <div class="wsus__invoice_header">
                                    <div class="wsus__invoice_content">
                                        <div class="row">
                                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                <div class="wsus__invoice_single">
                                                    <h5>Invoice To</h5>
                                                    <h6>{{ $address->name }}</h6>
                                                    <p>{{ $address->email }}</p>
                                                    <p>{{ $address->phone }}</p>
                                                    <p>{{ $address->address }} , {{ $address->city }} , {{ $address->state }}, {{ $address->zip }}</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                <div class="wsus__invoice_single text-md-center">
                                                    <h5>shipping information</h5>
                                                    <h6>{{ $address->name }}</h6>
                                                    <p>{{ $address->email }}</p>
                                                    <p>{{ $address->phone }}</p>
                                                    <p>{{ $address->address }} , {{ $address->city }} , {{ $address->state }}, {{ $address->zip }}</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-4">
                                                <div class="wsus__invoice_single text-md-end">
                                                    <h5>Order id : #{{ $order->invoice_id }}</h5>
                                                    <h6>Order status: {{ config('order_status.order_status_admin')[$order->order_status] ['status']}}</h6>
                                                    <p>Payment method: {{ $order->payment_method }}</p>
                                                    <p>Payment status: {{ $order->payment_status }}</p>
                                                    <p>Transaction_id: {{ $order->transaction->transaction_id }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wsus__invoice_description">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>

                                                    <th class="name">
                                                        product
                                                    </th>

                                                    <th class="amount">
                                                        shop name
                                                    </th>

                                                    <th class="amount">
                                                        amount
                                                    </th>

                                                    <th class="quentity">
                                                        quantity
                                                    </th>
                                                    <th class="total">
                                                        total
                                                    </th>
                                                </tr>

                                                @foreach ($order->orderProducts as $product)
                                                @if($product->vendor_id == Auth::user()->vendor->id)

                                                @php
                                                    $variants = json_decode($product->variants);

                                                    $total += $total+($product->unit_price * $product->qty);
                                                @endphp
                                                <tr>

                                                    <td class="name">
                                                        <p>{{ $product->product_name }}</p>
                                                        @foreach ($variants as $key=>$variant)
                                                            <span>{{ $key }} : {{ $variant->name }}</span>
                                                        @endforeach

                                                    </td>
                                                    <td class="amount">
                                                        <p>{{ $product->vendor->shop_name }}</p>


                                                    </td>
                                                    <td class="amount">
                                                        {{ $settings->currency_icon }} {{ $product->unit_price }}
                                                    </td>

                                                    <td class="quentity">
                                                        {{ $product->qty }}
                                                    </td>
                                                    <td class="total">
                                                        {{ $settings->currency_icon }} {{ $product->unit_price * $product->qty }}
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach


                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="wsus__invoice_footer">
                                    <p><span>Total Amount:</span> {{ $settings->currency_icon }} {{  $total }} </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="row ">
                        <div class="form-group mt-5 col-md-4">
                            <form action="{{ route('vendor.orders.status', $order->id) }}" method="POST">
                                @csrf
                                <label for="" class="mb-2">Order Status : </label>
                                <select name="order_status" id="order_status" data-id="{{ $order->id }}" class="form-control">
                                    <option value="">--select status--</option>
                                        @foreach (config('order_status.order_status_vendor') as $key => $orderStatus)
                                            <option {{ $order->order_status==$key ?'selected':'' }} value="{{ $key }}">{{ $orderStatus['status'] }}</option>
                                        @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary mt-2">Save</button>
                            </form>

                        </div>

                        <div class="col-md-8 ">
                            <div class=" float-end mt-5">
                                <button class="btn btn-warning print_invoice">Print</button>
                            </div>

                        </div>
                    </div>
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

        $('.print_invoice').on('click', function(){
            let print_body = $('.invoice-print');
            let originalContents = $('body').html();

            $('body').html(print_body.html());

            window.print();

            $('body').html(originalContents);
        });

    });

</script>

@endpush
