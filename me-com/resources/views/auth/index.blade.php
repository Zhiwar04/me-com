@extends('dashboard')
@section('user')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard"
                                            role="tab" aria-controls="dashboard" aria-selected="false"><i
                                                class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                            role="tab" aria-controls="orders" aria-selected="false"><i
                                                class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="return-tab" data-bs-toggle="tab" href="#return"
                                            role="tab" aria-controls="return" aria-selected="false"><i
                                                class="fi-rs-shopping-bag mr-10"></i>Return Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders"
                                            role="tab" aria-controls="track-orders" aria-selected="false"><i
                                                class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address"
                                            role="tab" aria-controls="address" aria-selected="true"><i
                                                class="fi-rs-marker mr-10"></i>My Address</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab"
                                            href="#account-detail" role="tab" aria-controls="account-detail"
                                            aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="change-password-tab" data-bs-toggle="tab"
                                            href="#change-password" role="tab" aria-controls="change-password"
                                            aria-selected="true"><i class="fi-rs-user mr-10"></i>Change Password</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.logout') }}"><i
                                                class="fi-rs-sign-out mr-10"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">


                                    <div class="card">
                                        <div class="card-header d-flex align-items-center">

                                            @php
                                                $users = App\Models\User::select('id', 'provider', 'photo')
                                                    ->where('id', $UserData->id)
                                                    ->first();
                                            @endphp

                                            @if ($users->provider === 'facebook' || $users->provider === 'google' || $users->provider === 'github')
                                                <img src="{{ !empty($UserData->photo) ? $UserData->photo : url('upload/no_image.jpg') }}"
                                                    alt="User" class="rounded-circle p-1 bg-primary" width="110">
                                            @else
                                                <img src="{{ !empty($UserData->photo) ? url('upload/user_images/' . $UserData->photo) : url('upload/no_image.jpg') }}"
                                                    alt="User" class="rounded-circle p-1 bg-primary" width="110">
                                            @endif




                                        </div>


                                        <div class="card-body">
                                            <p>
                                                From your account dashboard. you can easily check &amp; view your <a
                                                    href="#">recent orders</a>,<br />
                                                manage your <a href="#">shipping and billing addresses</a> and <a
                                                    href="#">edit your password and account details.</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>

                                                            <th>Sl</th>
                                                            <th>Date</th>
                                                            <th>Totaly</th>
                                                            <th>Payment</th>
                                                            <th>Invoice</th>
                                                            <th>Status</th>

                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orders as $key => $order)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td> {{ $order->order_date }}</td>
                                                                <td> {{ number_format($order->amount, 0) }} IQD</td>
                                                                <td> {{ $order->payment_method }}</td>
                                                                <td> {{ $order->invoice_no }}</td>
                                                                <td>
                                                                    @if ($order->status == 'pending')
                                                                        <span
                                                                            class="badge rounded-pill bg-warning">Pending</span>
                                                                    @elseif($order->status == 'confirm')
                                                                        <span
                                                                            class="badge rounded-pill bg-info">Confirm</span>
                                                                    @elseif($order->status == 'processing')
                                                                        <span
                                                                            class="badge rounded-pill bg-dark">Processing</span>
                                                                    @elseif($order->status == 'delivered')
                                                                        <span
                                                                            class="badge rounded-pill bg-success">Delivered</span>

                                                                        @if ($order->return_order == 1)
                                                                            <span class="badge rounded-pill"
                                                                                style="background:red;">Return</span>
                                                                        @endif
                                                                    @endif


                                                                </td>


                                                                <td><a href="{{ url('user/order_details/' . $order->id) }}"
                                                                        class="btn-sm btn-success"><i
                                                                            class="fa fa-eye"></i> View</a>
                                                                    <a href="{{ url('user/invoice_download/' . $order->id) }}"
                                                                        class="btn-sm btn-danger"><i
                                                                            class="fa fa-download"></i> Invoice</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- return orders --}}

                                <div class="tab-pane fade" id="return" role="tabpanel">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Returned Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>

                                                            <th>Sl</th>
                                                            <th>Date</th>
                                                            <th>Totaly</th>
                                                            <th>Payment</th>
                                                            <th>Invoice</th>
                                                            <th>Status</th>

                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($returns as $key => $order)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td> {{ $order->order_date }}</td>
                                                                <td> {{ number_format($order->amount, 0) }} IQD</td>
                                                                <td> {{ $order->payment_method }}</td>
                                                                <td> {{ $order->invoice_no }}</td>
                                                                <td>
                                                                    @if ($order->return_order == 0)
                                                                        <span class="badge rounded-pill bg-warning">No
                                                                            Retrun Request</span>
                                                                    @elseif($order->return_order == 1)
                                                                        <span
                                                                            class="badge rounded-pill bg-danger">Pedding</span>
                                                                    @elseif($order->return_order == 2)
                                                                        <span
                                                                            class="badge rounded-pill bg-success">Success</span>
                                                                    @endif



                                                                </td>


                                                                <td><a href="{{ url('user/order_details/' . $order->id) }}"
                                                                        class="btn-sm btn-success"><i
                                                                            class="fa fa-eye"></i> View</a>
                                                                    <a href="{{ url('user/invoice_download/' . $order->id) }}"
                                                                        class="btn-sm btn-danger"><i
                                                                            class="fa fa-download"></i> Invoice</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end return orders --}}

                                <div class="tab-pane fade" id="track-orders" role="tabpanel"
                                    aria-labelledby="track-orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Orders tracking</h3>
                                        </div>
                                        <div class="card-body contact-from-area">
                                            <p>To track your order please enter your OrderID in the box
                                                below and press
                                                "Track" button. This was given to you on your receipt
                                                and in the
                                                confirmation email you should have received.</p>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <form class="contact-form-style mt-30 mb-50"
                                                        action="{{ route('track.order') }}" method="post">
                                                        @csrf
                                                        <div class="input-style mb-20">
                                                            <label>Order ID</label>
                                                            <input name="invoice_no"
                                                                placeholder="Found in your order confirmation email"
                                                                type="text" />
                                                        </div>
                                                        <button class="submit submit-auto-width" type="submit">
                                                            Track Your Order</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h3 class="mb-0">Billing Address</h3>
                                                </div>
                                                <div class="card-body">
                                                    <address>
                                                        3522 Interstate<br />
                                                        75 Business Spur,<br />
                                                        Sault Ste. <br />Marie, MI 49783
                                                    </address>
                                                    <p>New York</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Shipping Address</h5>
                                                </div>
                                                <div class="card-body">
                                                    <address>
                                                        4299 Express Lane<br />
                                                        Sarasota, <br />FL 34249 USA <br />Phone:
                                                        1.941.227.4444
                                                    </address>
                                                    <p>Sarasota</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- /// Change Password  -->

                                <div class="tab-pane fade" id="change-password" role="tabpanel"
                                    aria-labelledby="change-password-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Change Password</h5>
                                        </div>
                                        <div class="card-body">



                                            <form method="post" action="{{ route('user.update.password') }}"> @csrf

                                                @if (session('status'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ session('status') }}
                                                    </div>
                                                @elseif(session('error'))
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif


                                                <div class="row">

                                                    <div class="form-group col-md-12">
                                                        <label>Current Password <span class="required">*</span></label>
                                                        <input
                                                            class="form-control @error('old_password') is-invalid @enderror"
                                                            name="old_password" type="password" id="current_password"
                                                            placeholder="Old Password" />

                                                        @error('old_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>New Password <span class="required">*</span></label>
                                                        <input
                                                            class="form-control @error('new_password') is-invalid @enderror"
                                                            name="new_password" type="password" id="new_password"
                                                            placeholder="New Password" />

                                                        @error('new_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>


                                                    <div class="form-group col-md-12">
                                                        <label>Confirm New Password <span class="required">*</span></label>
                                                        <input class="form-control" name="new_password_confirmation"
                                                            type="password" id="new_password_confirmation"
                                                            placeholder="Confirm New Password" />

                                                    </div>



                                                    <div class="col-md-12">
                                                        <button type="submit"
                                                            class="btn btn-fill-out submit font-weight-bold"
                                                            name="submit" value="Submit">Save
                                                            Change</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>











                                <div class="tab-pane fade" id="account-detail" role="tabpanel"
                                    aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">

                                            <form method="post" action="{{ route('user.profile.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>User Name <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="username"
                                                            type="text" value="{{ $UserData->username }}" />
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Full Name <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="name"
                                                            value="{{ $UserData->name }}" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Email <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="email"
                                                            type="text" value="{{ $UserData->email }}" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Phone <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="phone"
                                                            type="text" value="{{ $UserData->phone }}" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Address <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="address"
                                                            type="text" value="{{ $UserData->address }}" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>User Photo <span class="required">*</span></label>
                                                        <input type="file" id="image" name="photo"
                                                            class="form-control" />
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label> <span class="required">*</span></label>
                                                        @php
                                                            $users = App\Models\User::select('id', 'provider', 'photo')
                                                                ->where('id', $UserData->id)
                                                                ->first();
                                                        @endphp

                                                        @if ($users->provider === 'facebook' || $users->provider === 'google' || $users->provider === 'github')
                                                            <img src="{{ !empty($UserData->photo) ? $UserData->photo : url('upload/no_image.jpg') }}"
                                                                id="showImage" alt="User"
                                                                class="rounded-circle p-1 bg-primary" width="110">
                                                        @else
                                                            <img src="{{ !empty($UserData->photo) ? url('upload/user_images/' . $UserData->photo) : url('upload/no_image.jpg') }}"
                                                                id="showImage" alt="User"
                                                                class="rounded-circle p-1 bg-primary" width="110">
                                                        @endif


                                                        <div class="col-md-12">
                                                            <button type="submit"
                                                                class="btn btn-fill-out submit font-weight-bold"
                                                                name="submit" value="Submit">Save
                                                                Change</button>
                                                        </div>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
