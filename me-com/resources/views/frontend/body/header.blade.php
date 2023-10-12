<x-ui.icon.modal />
<header class="header-area header-style-1 header-height-2">
    <div class="mobile-promotion">
        <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
    </div>
    <div class="header-top header-top-ptb-1  p-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li><a href="{{ url('/mycart') }}">My Cart</a></li>
                            <li><a href="{{ url('/checkout') }}">Checkout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>100% Secure delivery without contacting the courier</li>
                                <li>Supper Value Deals - Save more with coupons</li>
                                <li>Trendy 25silver jewelry, save up 35% off today</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            <li>
                                <a class="language-dropdown-active" href="#">Currency <i
                                        class="fi-rs-angle-small-down"></i></a>
                                <ul class="language-dropdown">
                                    <li>
                                        <a href="#"><img
                                                src="{{ asset('frontend/assets/imgs/theme/flags/us.png') }}"
                                                alt="" />USD</a>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <a class="language-dropdown-active" href="#">English <i
                                        class="fi-rs-angle-small-down"></i></a>
                                <ul class="language-dropdown">
                                    <li>
                                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            @php
                                                // Define an associative array to map locale codes to flag image URLs
                                                $flagImages = [
                                                    'en' => asset('frontend/assets/imgs/theme/flags/us.png'),
                                                    'ar' => asset('frontend/assets/imgs/theme/flags/ar.png'),
                                                    'ku' => asset('frontend/assets/imgs/theme/flags/ku.png'),
                                                    // Add more locales and their respective flag image URLs as needed
                                                ];
                                            @endphp
                                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                <img width="20" src="{{ $flagImages[$localeCode] }}"
                                                    alt="" />
                                                {{ $properties['native'] }}
                                            </a>
                                        @endforeach
                                    </li>
                                </ul>
                            </li>
                            <li>Need help? <a href="#"><strong class="text-brand"> Contact Us</strong></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="">
            <div class="header-wrap">
                <div class="logo ">
                    <a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}" alt="logo" /></a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="{{ route('product.search') }}" method="post">
                            @csrf
                            <select class="select-active">
                                <option selected>{{ __('lang.all_categories') }}</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                            <input onfocus="search_result_show()" onblur="search_result_hide()" type="search"
                                name="search" id="search" placeholder="Search for items..." />

                            <svg width="40" class=" mr-20" style="cursor:pointer ;" version="1"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                                enable-background="new 0 0 48 48">
                                <g fill="#616161">
                                    <rect x="34.6" y="28.1" transform="matrix(.707 -.707 .707 .707 -15.154 36.586)"
                                        width="4" height="17" />
                                    <circle cx="20" cy="20" r="16" />
                                </g>
                                <rect x="36.2" y="32.1" transform="matrix(.707 -.707 .707 .707 -15.839 38.239)"
                                    fill="#37474F" width="4" height="4" />
                                <circle fill="#64B5F6" cx="20" cy="20" r="13" />
                                <path fill="#BBDEFB"
                                    d="M26.9,14.2c-1.7-2-4.2-3.2-6.9-3.2s-5.2,1.2-6.9,3.2c-0.4,0.4-0.3,1.1,0.1,1.4c0.4,0.4,1.1,0.3,1.4-0.1 C16,13.9,17.9,13,20,13s4,0.9,5.4,2.5c0.2,0.2,0.5,0.4,0.8,0.4c0.2,0,0.5-0.1,0.6-0.2C27.2,15.3,27.2,14.6,26.9,14.2z" />
                            </svg>
                            {{-- search using ajax --}}
                            <div id="searchProducts"></div>
                            {{-- end --}}
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('mycart') }}">
                                    <img alt="cart"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                    {{-- increment itemNumber by adding products --}}
                                    <span class="pro-count blue" id="itemNumber">0</span>
                                    {{-- end --}}
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    {{-- mini cart ajax --}}
                                    <div id="miniCart"></div>
                                    {{-- end --}}
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            {{-- calculation of items that added --}}
                                            <h4>Total <span id="totalPrice"></span></h4>
                                            {{-- end --}}
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ url('/mycart') }}" class="outline">View cart</a>
                                            <a href="{{ url('/checkout') }}">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist') }}">
                                    <img class="svgInject" alt="icon"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                    {{-- wishlist increment --}}
                                    <span class="pro-count blue" id="wishQty">0</span>
                                    {{-- end --}}
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a href="{{ route('compare') }}">
                                    <img class="svgInject" alt="icon"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-compare.svg') }}" />
                                </a>
                            </div>
                            <div class="header-action-icon-2 mx-2">
                                {{-- agar user login bwbw awa ama peshan bdat --}}
                                @auth
                                    @php
                                        $users = App\Models\User::select('id', 'provider', 'photo')
                                            ->where('id', Auth::user()->id)
                                            ->first();
                                    @endphp
                                    @if ($users->provider === 'facebook' || $users->provider === 'google' || $users->provider === 'github')
                                        <img src="{{ !empty($UserData->photo) ? $UserData->photo : url('upload/no_image.jpg') }}"
                                            alt="User" class="rounded-circle  bg-primary" width="40">
                                    @else
                                        <img src="{{ !empty($UserData->photo) ? url('upload/user_images/' . $UserData->photo) : url('upload/no_image.jpg') }}"
                                            alt="User" class="rounded-circle  bg-primary" width="40">
                                    @endif
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="{{ route('dashboard') }}"><i class="fi fi-rs-user mr-10"></i>My
                                                    Account</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('user.logout') }}"><i
                                                        class="fi fi-rs-sign-out mr-10"></i>Sign
                                                    out</a>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                    <a>
                                        <img class="svgInject" alt="icon"
                                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
                                    </a>
                                    <a href="{{ route('login') }}"><span class="lable ml-0">Login</span></a>
                                    <span class="lable mr-2 ml-3">|</span>
                                    <a href="{{ route('register') }}"><span class="lable">Register</span></a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- mobile menu --}}
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="header-nav d-none d-lg-flex ml-80">
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>
                                <li>
                                    <a class="active" href="{{ '/' }}">{{ __('lang.home') }} </a>
                                <li>
                                    <a href="#">{{ __('lang.categories') }} <i
                                            class="fi-rs-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        @foreach ($categories as $category)
                                            <li>
                                                <a
                                                    href="{{ url('product/category/' . $category->id . '/' . $category->category_slug) }}">
                                                    {{ $category->category_name }}
                                                    <i class="fi-rs-angle-right"></i>
                                                </a>
                                                <ul class="level-menu">
                                                    @foreach ($subcategories as $subcategory)
                                                        @if ($category->id == $subcategory->category_id)
                                                            <li>
                                                                <a
                                                                    href="{{ url('product/subcategory/' . $subcategory->id . '/' . $subcategory->subcategory_slug) }}">
                                                                    {{ $subcategory->subcategory_name }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="">{{ __('lang.vendors') }}<i class="fi-rs-angle-down"></i></a>

                                    <ul class="sub-menu">
                                        @foreach ($vendors as $vendor)
                                            <li>
                                                <a href="{{ route('vendor.details', $vendor->id) }}">
                                                    {{ $vendor->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="">Brands<i class="fi-rs-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        @foreach ($brands as $brand)
                                            <li>
                                                <a
                                                    href="{{ url('/product/brand/' . $brand->id . '/' . $brand->brand_slug) }}">
                                                    {{ $brand->brand_name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{ route('shop.page') }}">shop</a></li>
                                <li><a href="">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="hotline d-none d-lg-flex mr-80">
                    <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-headphone.svg') }}" alt="hotline" />
                    <p>{{ $setting->support_phone }}<span>24/7 Support Center</span></p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">

                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="{{ route('mycart') }}">
                                <img alt="icon"
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                <span class="pro-count blue" id="m-itemNumber">0</span>
                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                {{-- mini cart ajax --}}
                                <div id="m-miniCart"></div>
                                {{-- mini cart ajax --}}
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span id="m-totalPrice"></span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="{{ url('/mycart') }}">View cart</a>
                                        <a href="{{ url('/checkout') }}">Checkout</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="header-action-icon-2">
                            <a href="{{ route('compare') }}">
                                <img class="svgInject" alt="icon"
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-compare.svg') }}" />
                            </a>

                        </div>
                        <div class="header-action-icon-2">
                            <a href="{{ route('wishlist') }}">
                                <img alt="icon"
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                <span class="pro-count blue" id="m-wishQty">0</span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">

                            {{-- agar user login bwbw awa ama peshan bdat --}}
                            @auth


                                <ul class="mt-1 mx-1">
                                    <li>
                                        <a href="{{ url('/dashboard') }}">
                                            @if ($users->provider === 'facebook' || $users->provider === 'google')
                                                <img src="{{ !empty($UserData->photo) ? $UserData->photo : url('upload/no_image.jpg') }}"
                                                    alt="User" class="rounded-circle p-1 bg-primary" width="40">
                                            @else
                                                <img src="{{ !empty($UserData->photo) ? url('upload/user_images/' . $UserData->photo) : url('upload/no_image.jpg') }}"
                                                    alt="User" class="rounded-circle p-1 bg-primary" width="40">
                                            @endif
                                        </a>
                                    </li>
                                </ul>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</header>
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="index.html"><img src="{{ asset('frontend/assets/imgs/theme/logo.svg') }}"
                        alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="{{ route('product.search') }}" method="post">
                    @csrf
                    <input type="text" id="searchmb" placeholder="Search for items…" />
                    <div id="searchProductsmb"></div>
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a class="active" href="{{ '/' }}">{{ __('lang.home') }} </a>

                        </li>


                        <li class="menu-item-has-children">
                            <a href="#">{{ __('lang.categories') }}</a>
                            <ul class="dropdown">
                                @foreach ($categories as $category)
                                    <li class="menu-item-has-children">
                                        <a
                                            href="{{ url('product/category/' . $category->id . '/' . $category->category_slug) }}">
                                            {{ $category->category_name }}

                                        </a>
                                        <ul class="dropdown">
                                            @foreach ($subcategories as $subcategory)
                                                @if ($category->id == $subcategory->category_id)
                                                    <li>
                                                        <a
                                                            href="{{ url('product/subcategory/' . $subcategory->id . '/' . $subcategory->subcategory_slug) }}">
                                                            {{ $subcategory->subcategory_name }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach

                            </ul>
                        </li>

                        <li class="menu-item-has-children">
                            <a href="">Vendors</a>
                            <ul class="dropdown">
                                @foreach ($vendors as $vendor)
                                    <li> <a href="{{ route('vendor.details', $vendor->id) }}">
                                            {{-- <img src="{{ asset($category->category_image) }}" alt="" /> --}}
                                            {{ $vendor->name }}

                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="">Brands</a>
                            <ul class="dropdown">

                                @foreach ($brands as $brand)
                                    <li>
                                        <a
                                            href="{{ url('/product/brand/' . $brand->id . '/' . $brand->brand_slug) }}">

                                            {{ $brand->brand_name }}

                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Language</a>
                            <ul class="dropdown">
                                <li><a href="#">English</a></li>
                                <li><a href="#">Kurdish</a></li>
                                <li><a href="#">Arabic</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Currency</a>
                            <ul class="dropdown">
                                <li><a href="#">USD</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="">Contact </a>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    @auth
                        <li style="list-style: none;">
                            <a href="{{ route('user.logout') }}"><i class="fi fi-rs-sign-out mr-10"></i>Sign
                                out</a>
                        </li>
                    @else
                        <span>
                            <a href="{{ route('login') }}" class="my-1">Sign in</a>
                            <a href="{{ route('register') }}">Sign up</a>
                        </span>

                    @endauth
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                        alt="" /></a>
            </div>
            <div class="site-copyright">Copyright 2023 © Shaida & Zhiwar rights reserved.</div>
        </div>
    </div>
</div>
<style>
    #searchProducts {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #ffffff;
        z-index: 999;
        border-radius: 8px;
        margin-top: 5px;
    }
</style>

<script>
    function search_result_show() {
        $("#searchProducts").slideDown();
    }

    function search_result_hide() {
        $("#searchProducts").slideUp();
    }
</script>
