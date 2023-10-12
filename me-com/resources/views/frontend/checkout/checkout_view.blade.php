@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Checkout Page
@endsection
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Checkout
        </div>
    </div>
</div>
<div class="container mb-80 mt-50">
    <div class="row">
        <div class="col-lg-8 mb-40">
            <h3 class="heading-2 mb-10">Checkout</h3>
            <div class="d-flex justify-content-between">
                <h6 class="text-body">There are products in your cart</h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7 shadow-md rounded-md py-1 ">

            <div class="row">
                <h4 class="mb-30">Billing Details</h4>
                <form method="post" action="{{ route('checkout.store') }}">
                    @csrf


                    <div class="row">
                        <div class="form-group col-lg-6">
                            <input type="text"
                                required=""class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="shipping_name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <input type="email" required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="shipping_email" placeholder="enter your email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>



                    <div class="row shipping_calculator">
                        <div class="form-group col-lg-6">
                            <div class="custom_select">
                                <select name="division_id" required class="form-control ">
                                    <option value="">choose your city</option>
                                    @foreach ($divisions as $item)
                                        <option value="{{ $item->id }}">{{ $item->division_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <input required="" type="text" name="shipping_phone"
                                placeholder="enter your phone number"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ Auth::user()->phone }}">
                        </div>
                    </div>

                    <div class="row shipping_calculator">

                        <div class="form-group col-lg-6">
                            <input required="" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="shipping_address" placeholder="enter your address"
                                value="{{ Auth::user()->address }}">
                        </div>
                    </div>
                    <div class="form-group mb-30">
                        <textarea id="message" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="additional information ......" name="notes"></textarea>
                    </div>




            </div>
        </div>


        <div class="col-lg-5 shadow-md rounded-md py-1">
            <div class="border p-40 cart-totals ml-30 mb-50">
                <div class="d-flex align-items-end justify-content-between mb-30">
                    <h4>Your Order</h4>

                </div>
                <div class="divider-2 mb-30"></div>
                <div class="table-responsive order_table checkout">
                    <table class="table no-border">
                        <tbody>
                            @foreach ($carts as $item)
                                <tr>
                                    <td class="image product-thumbnail"><img
                                            src="{{ asset($item->attributes->product_thumbnail) }}" alt="#"></td>
                                    <td>
                                        <h6 class="w-160 mb-5"><a href="shop-product-full.html"
                                                class="text-heading">{{ $item->name }}</a></h6></span>
                                        <div class="product-rate-cover">
                                            <strong>
                                                @if ($item->attributes->color || $item->attributes->size)
                                                    @if ($item->attributes->color && $item->attributes->size)
                                                        Color: {{ $item->attributes->color }}
                                                        <br>
                                                        Size: {{ $item->attributes->size }}
                                                    @else
                                                        {{ $item->attributes->color ? 'Color: ' . $item->attributes->color : '' }}
                                                        {{ $item->attributes->size ? 'Size: ' . $item->attributes->size : '' }}
                                                    @endif
                                                @endif
                                            </strong>

                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="text-muted pl-20 pr-20">{{ $item->quantity }}x</h6>
                                    </td>
                                    <td>
                                        <h4 class="text-brand">{{ number_format($item->price, 0) }} IQD</h4>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>



                    <table class="table no-border">
                        <tbody>
                            @if (Session::has('coupon'))
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">SUBTOTAL</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">{{ number_format($cartTotal, 0) }} IQD</h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">coupon_name</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h6 class="text-brand text-end">{{ session()->get('coupon')['coupon_name'] }}

                                        </h6>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Coupon Discount</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">
                                            {{ session()->get('coupon')['coupon_discount'] }}%
                                        </h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Grand Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">
                                            {{ number_format(session()->get('coupon')['total_amount'], 0) }} IQD
                                        </h4>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Grand Total </h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">{{ number_format($cartTotal, 0) }} IQD</h4>
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>




                </div>
            </div>
            <div class="payment ml-30">
                <h4 class="mb-30">Payment</h4>
                <div class="payment_option">
                    {{-- <div class="custome-radio">

                            <input class="form-check-input" required="" type="radio" name="payment_option"
                                value="stripe" id="exampleRadios3" checked="">

                            <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse"
                                data-target="#bankTranfer" aria-controls="bankTranfer">Stripe</label>
                        </div> --}}
                    <div class="custome-radio">

                        <input class="form-check-input" required="" type="radio" name="payment_option"
                            value="cash" id="exampleRadios4" checked="">

                        <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                            data-target="#checkPayment" aria-controls="checkPayment">Cash on delivery</label>
                    </div>

                </div>
                {{-- <div class="payment-logo d-flex">
                        <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-paypal.svg') }}"
                            alt="">
                        <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-visa.svg') }}"
                            alt="">
                        <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-master.svg') }}"
                            alt="">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/payment-zapper.svg') }}" alt="">
                    </div> --}}
                <button type="submit" class="btn btn-fill-out btn-block mt-30">Place an Order<i
                        class="fi-rs-sign-out ml-15"></i></button>
            </div>
        </div>
    </div>
</div>
</form>
{{-- <script>
        $(document).ready(function() {
            $('select[name="division_id"]').on('change', function() {
                var division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        url: "{{ url('/district-get/ajax') }}/" + division_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="district_id"]').html('');
                            var d = $('select[name="district_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="district_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .district_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script> --}}
@endsection
