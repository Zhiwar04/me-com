<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('adminbackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon" />
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto">
            <i class="bx bx-arrow-to-left"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @if (Auth::user()->can('brand.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cookie'></i></div>
                    <div class="menu-title">Brand</div>
                </a>
                <ul>
                    @if (Auth::user()->can('brand.list'))
                        <li>
                            <a href="{{ route('brands.index') }}"><i class="bx bx-right-arrow-alt"></i>All Brand</a>
                        </li>
                    @endif
                    @if (Auth::user()->can('brand.add'))
                        <li>
                            <a href="{{ route('brands.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif
        @if (Auth::user()->can('category.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i></div>
                    <div class="menu-title">Category</div>
                </a>
                <ul>
                    @if (Auth::user()->can('category.list'))
                        <li>
                            <a href="{{ route('categories.index') }}"><i class="bx bx-right-arrow-alt"></i>All
                                Category</a>
                        </li>
                    @endif
                    @if (Auth::user()->can('category.add'))
                        <li>
                            <a href="{{ route('categories.create') }}"><i class="bx bx-right-arrow-alt"></i>Add
                                Category</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('subcategory.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-codepen"></i></div>
                    <div class="menu-title">SubCategory</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('subcategories.index') }}"><i class="bx bx-right-arrow-alt"></i>All
                            SubCategory</a>
                    </li>
                    <li>
                        <a href="{{ route('subcategories.create') }}"><i class="bx bx-right-arrow-alt"></i>Add
                            SubCategory</a>
                    </li>

                </ul>
            </li>
        @endif
        @if (Auth::user()->can('product.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-fresh-juice"></i></div>
                    <div class="menu-title">Product Manage</div>
                </a>
                <ul>
                    @if (Auth::user()->can('product.list'))
                        <li>
                            <a href="{{ route('all.product') }}"><i class="bx bx-right-arrow-alt">

                                </i>All Product</a>
                        </li>
                    @endif
                    @if (Auth::user()->can('product.add'))
                        <li>
                            <a href="{{ route('add.product') }}"><i class="bx bx-right-arrow-alt">

                                </i>Add Product</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('slider.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-gallery"></i></div>
                    <div class="menu-title">Slider Manage</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('sliders.index') }}"><i class="bx bx-right-arrow-alt">

                            </i>All Sliders</a>
                    </li>
                    <li>
                        <a href="{{ route('sliders.create') }}"><i class="bx bx-right-arrow-alt">

                            </i>Add Slider</a>
                    </li>

                </ul>
            </li>
        @endif
        @if (Auth::user()->can('ads.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-image"></i>
                    </div>
                    <div class="menu-title">Banner Manage</div>
                </a>
                <ul>
                    <li> <a href="{{ route('banners.index') }}"><i class="bx bx-right-arrow-alt"></i>All Banner</a>
                    </li>
                    <li> <a href="{{ route('banners.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>

                </ul>
            </li>
        @endif
        @if (Auth::user()->can('coupon.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-invention"></i>
                    </div>
                    <div class="menu-title">Coupon System</div>
                </a>
                <ul>
                    <li> <a href="{{ route('coupons.index') }}"><i class="bx bx-right-arrow-alt"></i>All Coupon</a>
                    </li>
                    <li> <a href="{{ route('coupons.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('area.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-map"></i>
                    </div>
                    <div class="menu-title">Shipping Area</div>
                </a>
                <ul>
                    <li> <a href="{{ route('divisions.index') }}"><i class="bx bx-right-arrow-alt"></i>All Division</a>
                    </li>

                </ul>
            </li>
        @endif

        @if (Auth::user()->can('vendor.menu'))
            <li class="menu-label">Vendor manage</li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='lni lni-network'></i></div>
                    <div class="menu-title">Vendor Manage</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('inactive.vendor') }}"><i class="bx bx-right-arrow-alt"></i>InActive
                            Vendors</a>
                    </li>
                    <li>
                        <a href="{{ route('active.vendor') }}"><i class="bx bx-right-arrow-alt"></i>
                            Active Vendors</a>
                    </li>
                    <li>
                        <a href="ecommerce-add-new-products.html"><i class="bx bx-right-arrow-alt"></i>Add New
                            Products</a>
                    </li>
                    <li>
                        <a href="ecommerce-orders.html"><i class="bx bx-right-arrow-alt"></i>Orders</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('order.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">Order Manage </div>
                </a>
                <ul>
                    <li> <a href="{{ route('pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Pending
                            Order</a>
                    </li>
                    <li> <a href="{{ route('admin.confirmed.order') }}"><i
                                class="bx bx-right-arrow-alt"></i>Confirmed
                            Order</a>
                    </li>
                    <li> <a href="{{ route('admin.processing.order') }}"><i
                                class="bx bx-right-arrow-alt"></i>Processing
                            Order</a>
                    </li>
                    <li> <a href="{{ route('admin.delivered.order') }}"><i
                                class="bx bx-right-arrow-alt"></i>Delivered
                            Order</a>
                    </li>


                </ul>
            </li>
        @endif
        @if (Auth::user()->can('return.order.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='lni lni-network'></i>
                    </div>
                    <div class="menu-title">Return Order </div>
                </a>
                <ul>
                    <li> <a href="{{ route('return.request') }}"><i class="bx bx-right-arrow-alt"></i>Return
                            Request</a>
                    </li>
                    <li> <a href="{{ route('complete.return.request') }}"><i
                                class="bx bx-right-arrow-alt"></i>Complete
                            Request
                        </a>
                    </li>

                </ul>
            </li>
        @endif
        @if (Auth::user()->can('report.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-stats-up"></i></div>
                    <div class="menu-title">Report Manage</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('report.view') }}"><i class="bx bx-right-arrow-alt">

                            </i>Report View</a>
                    </li>
                    <li>
                        <a href="{{ route('order.by.user') }}"><i class="bx bx-right-arrow-alt">

                            </i>Order By User</a>
                    </li>

                </ul>
            </li>
        @endif
        @if (Auth::user()->can('user.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-slideshare"></i></div>
                    <div class="menu-title">User Manage</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('all.user') }}"><i class="bx bx-right-arrow-alt">

                            </i>All User</a>
                    </li>
                    <li>
                        <a href="{{ route('all.vendor') }}"><i class="bx bx-right-arrow-alt">

                            </i>All Vendor</a>
                    </li>

                </ul>
            </li>
        @endif
        @if (Auth::user()->can('review.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-indent-increase"></i>
                    </div>
                    <div class="menu-title">Review Manage</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('pending.review') }}"><i class="bx bx-right-arrow-alt">

                            </i>Pending Review</a>
                    </li>
                    <li>
                        <a href="{{ route('review.publish') }}"><i class="bx bx-right-arrow-alt">

                            </i>Publish Review</a>
                    </li>

                </ul>
            </li>
        @endif
        @if (Auth::user()->can('site.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-cog"></i>
                    </div>
                    <div class="menu-title">Setting Manage</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('site.setting') }}"><i class="bx bx-right-arrow-alt">

                            </i>Site Setting</a>
                    </li>
                    <li>
                        <a href="{{ route('seo.setting') }}"><i class="bx bx-right-arrow-alt">

                            </i>Seo Setting</a>
                    </li>

                </ul>
            </li>
        @endif
        @if (Auth::user()->can('stock.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-cart-full"></i></div>
                    <div class="menu-title">Stock Manage</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('product.stock') }}"><i class="bx bx-right-arrow-alt">

                            </i>Product Stock</a>
                    </li>


                </ul>
            </li>
        @endif
        @if (Auth::user()->can('role.menu'))
            <li class="menu-label">Roles And Permission</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-users"></i>
                    </div>
                    <div class="menu-title">Role & Permission</div>
                </a>
                <ul>
                    <li> <a href="{{ route('permissions.create') }}"><i class="bx bx-right-arrow-alt"></i>Add
                            Permission</a>
                    </li>
                    <li> <a href="{{ route('permissions.index') }}" class="btn btn-primary"><i
                                class="bx bx-right-arrow-alt"></i>All Permission</a>
                    </li>
                    <li> <a href="{{ route('roles.index') }}"><i class="bx bx-right-arrow-alt"></i>All Roles</a>
                    </li>
                    <li> <a href="{{ route('rolePermissions.create') }}"><i class="bx bx-right-arrow-alt"></i>Add
                            Roles in
                            Permission</a>
                    </li>
                    <li> <a href="{{ route('rolePermissions.index') }}"><i class="bx bx-right-arrow-alt"></i>All
                            Roles
                            in
                            Permission</a>
                    </li>
                </ul>
        @endif
        @if (Auth::user()->can('admin.menu'))
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="lni lni-user"></i>
                    </div>
                    <div class="menu-title">Admin Manage </div>
                </a>
                <ul>
                    <li> <a href="{{ route('admins.index') }}"><i class="bx bx-right-arrow-alt"></i>All Admin</a>
                    </li>
                    <li> <a href="{{ route('admins.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Admin</a>


                </ul>
            </li>
        @endif



    </ul>
    <!--end navigation-->
</div>
