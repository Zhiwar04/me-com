 @extends('frontend.master_dashboard')
 @section('main')
 @section('title')
     Home Easy Multi Vendor Shop
 @endsection
 @include('frontend.home.home_slider_list')
 <!--End hero slider-->
 @include('frontend.home.home_featured_category')
 <!--End category slider-->
 @include('frontend.home.home_banner')
 <!--End banners-->
 @include('frontend.home.home_new_product')
 <!--Products Tabs-->
 @include('frontend.home.home_featured_product')
 <!--End Best Sales-->
 <!-- TV Category -->
 <section class="product-tabs section-padding position-relative">
     <div class="container">
         <div class="section-title style-2 wow animate__animated animate__fadeIn">
             <h3>Fashion Category </h3>

         </div>
         <!--End nav-tabs-->
         <div class="tab-content" id="myTabContent">
             <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                 <div class="row product-grid-4">
                     @foreach ($product as $item)
                         <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                             <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                 data-wow-delay=".1s">
                                 <div class="product-img-action-wrap">
                                     <div class="product-img product-img-zoom">
                                         <a
                                             href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">
                                             <img class="default-img" src="{{ asset($item->product_thambnail) }}"
                                                 alt="" />
                                             <img class="hover-img" src="{{ asset($item->product_thambnail) }}"
                                                 alt="" />
                                         </a>
                                     </div>
                                     <div class="product-action-1">
                                         <a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}"
                                             onclick="addToWishList(this.id)">
                                             <i class="fi-rs-heart"></i></a>

                                         <a aria-label="Compare" class="action-btn" id="{{ $item->id }}"
                                             onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                         <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                             data-bs-target="#quickViewModal" id="{{ $item->id }}"
                                             onclick="viewProduct(this.id)"><i class="fi-rs-eye"></i></a>
                                     </div>
                                     @php
                                         $amount = $item->selling_price - $item->discount_price;
                                         $discount = ($amount / $item->selling_price) * 100;
                                     @endphp
                                     <div class="product-badges product-badges-position product-badges-mrg">
                                         @if ($item->discount_price == null)
                                             <span class="new">New</span>
                                         @else
                                             <span class="hot"> {{ round($discount) }} %</span>
                                         @endif
                                     </div>
                                 </div>
                                 <div class="product-content-wrap">
                                     <div class="product-category">
                                         <a href="shop-grid-right.html">{{ $item['category']['category_name'] }}</a>
                                     </div>
                                     <h2><a
                                             href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                     </h2>
                                     @php

                                         $reviewcount = App\Models\Review::where('product_id', $item->id)
                                             ->where('status', 1)
                                             ->latest()
                                             ->get();

                                         $avarage = App\Models\Review::where('product_id', $item->id)
                                             ->where('status', 1)
                                             ->avg('rating');

                                     @endphp
                                     <div class="product-rate-cover">



                                         <div class="product-rate d-inline-block">
                                             @if ($avarage == 0)
                                             @elseif($avarage == 1 || $avarage < 2)
                                                 <div class="product-rating" style="width: 20%">
                                                 </div>
                                             @elseif($avarage == 2 || $avarage < 3)
                                                 <div class="product-rating" style="width: 40%">
                                                 </div>
                                             @elseif($avarage == 3 || $avarage < 4)
                                                 <div class="product-rating" style="width: 60%">
                                                 </div>
                                             @elseif($avarage == 4 || $avarage < 5)
                                                 <div class="product-rating" style="width: 80%">
                                                 </div>
                                             @elseif($avarage == 5 || $avarage < 5)
                                                 <div class="product-rating" style="width: 100%">
                                                 </div>
                                             @endif
                                         </div>
                                         <span class="font-small ml-5 text-muted">({{ count($reviewcount) }})</span>
                                     </div>

                                     <div>
                                         @if ($item->vendor_id == null)
                                             <span class="font-small text-muted">By <a
                                                     href="vendor-details-1.html">Owner</a></span>
                                         @else
                                             <span class="font-small text-muted">By <a
                                                     href="vendor-details-1.html">{{ $item['vendor']['name'] }}</a></span>
                                         @endif
                                     </div>
                                     <div class="product-card-bottom">

                                         @if ($item->discount_price == null)
                                             <div class="product-price">
                                                 <span>{{ number_format($item->selling_price, 0) }} IQD</span>
                                             </div>
                                         @else
                                             <div class="product-price">
                                                 <span>{{ number_format($item->discount_price, 0) }} IQD</span>
                                                 <span
                                                     class="old-price block absolute bottom-1">{{ number_format($item->selling_price, 0) }}
                                                     IQD</span>
                                             </div>
                                         @endif
                                         <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}"
                                             class="Addbtn Addbtn-2">Add</a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <!--end product card-->
                     @endforeach

                     <!--end product card-->




                 </div>
                 <!--End product-grid-4-->
             </div>


         </div>
         <!--End tab-content-->
     </div>


 </section>
 <!--End TV Category -->
 <section class="product-tabs section-padding position-relative">
     <div class="container">
         <div class="section-title style-2 wow animate__animated animate__fadeIn">
             <h3>Electronic Category </h3>

         </div>
         <!--End nav-tabs-->
         <div class="tab-content" id="myTabContent">
             <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                 <div class="row product-grid-4">
                     @foreach ($product2 as $item)
                         <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                             <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                 data-wow-delay=".1s">
                                 <div class="product-img-action-wrap">
                                     <div class="product-img product-img-zoom">
                                         <a
                                             href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">
                                             <img class="default-img" src="{{ asset($item->product_thambnail) }}"
                                                 alt="" />
                                             <img class="hover-img" src="{{ asset($item->product_thambnail) }}"
                                                 alt="" />
                                         </a>
                                     </div>
                                     <div class="product-action-1">
                                         <a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}"
                                             onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>

                                         <a aria-label="Compare" class="action-btn" id="{{ $item->id }}"
                                             onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                         <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                             data-bs-target="#quickViewModal" id="{{ $item->id }}"
                                             onclick="viewProduct(this.id)"><i class="fi-rs-eye"></i></a>
                                     </div>
                                     @php
                                         $amount = $item->selling_price - $item->discount_price;
                                         $discount = ($amount / $item->selling_price) * 100;
                                     @endphp
                                     <div class="product-badges product-badges-position product-badges-mrg">
                                         @if ($item->discount_price == null)
                                             <span class="new">New</span>
                                         @else
                                             <span class="hot"> {{ round($discount) }} %</span>
                                         @endif
                                     </div>
                                 </div>
                                 <div class="product-content-wrap">
                                     <div class="product-category">
                                         <a href="shop-grid-right.html">{{ $item['category']['category_name'] }}</a>
                                     </div>
                                     <h2><a
                                             href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                     </h2>
                                     <div class="product-rate-cover">
                                         <div class="product-rate d-inline-block">
                                             <div class="product-rating" style="width: 90%"></div>
                                         </div>
                                         <span class="font-small ml-5 text-muted"> (4.0)</span>
                                     </div>
                                     <div>
                                         @if ($item->vendor_id == null)
                                             <span class="font-small text-muted">By <a
                                                     href="vendor-details-1.html">Owner</a></span>
                                         @else
                                             <span class="font-small text-muted">By <a
                                                     href="vendor-details-1.html">{{ $item['vendor']['name'] }}</a></span>
                                         @endif
                                     </div>
                                     <div class="product-card-bottom">

                                         @if ($item->discount_price == null)
                                             <div class="product-price">
                                                 <span>{{ number_format($item->selling_price, 0) }} IQD</span>
                                             </div>
                                         @else
                                             <div class="product-price">
                                                 <span>{{ number_format($item->discount_price, 0) }} IQD</span>
                                                 <span
                                                     class="old-price block absolute bottom-1">{{ number_format($item->selling_price, 0) }}
                                                     IQD</span>
                                             </div>
                                         @endif
                                         <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}"
                                             class="Addbtn Addbtn-2">Add</a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <!--end product card-->
                     @endforeach

                     <!--end product card-->




                 </div>
                 <!--End product-grid-4-->
             </div>


         </div>
         <!--End tab-content-->
     </div>


 </section>

 <!--End Fashion Category -->
 <section class="product-tabs section-padding position-relative">
     <div class="container">
         <div class="section-title style-2 wow animate__animated animate__fadeIn">
             <h3>Beauty Category </h3>

         </div>
         <!--End nav-tabs-->
         <div class="tab-content" id="myTabContent">
             <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                 <div class="row product-grid-4">
                     @foreach ($product4 as $item)
                         <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                             <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                 data-wow-delay=".1s">
                                 <div class="product-img-action-wrap">
                                     <div class="product-img product-img-zoom">
                                         <a
                                             href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">
                                             <img class="default-img" src="{{ asset($item->product_thambnail) }}"
                                                 alt="" />
                                             <img class="hover-img" src="{{ asset($item->product_thambnail) }}"
                                                 alt="" />
                                         </a>
                                     </div>
                                     <div class="product-action-1">
                                         <a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}"
                                             onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>

                                         <a aria-label="Compare" class="action-btn" id="{{ $item->id }}"
                                             onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                         <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                             data-bs-target="#quickViewModal" id="{{ $item->id }}"
                                             onclick="viewProduct(this.id)"><i class="fi-rs-eye"></i></a>
                                     </div>
                                     @php
                                         $amount = $item->selling_price - $item->discount_price;
                                         $discount = ($amount / $item->selling_price) * 100;
                                     @endphp
                                     <div class="product-badges product-badges-position product-badges-mrg">
                                         @if ($item->discount_price == null)
                                             <span class="new">New</span>
                                         @else
                                             <span class="hot"> {{ round($discount) }} %</span>
                                         @endif
                                     </div>
                                 </div>
                                 <div class="product-content-wrap">
                                     <div class="product-category">
                                         <a href="shop-grid-right.html">{{ $item['category']['category_name'] }}</a>
                                     </div>
                                     <h2><a
                                             href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                     </h2>
                                     <div class="product-rate-cover">
                                         <div class="product-rate d-inline-block">
                                             <div class="product-rating" style="width: 90%"></div>
                                         </div>
                                         <span class="font-small ml-5 text-muted"> (4.0)</span>
                                     </div>
                                     <div>
                                         @if ($item->vendor_id == null)
                                             <span class="font-small text-muted">By <a
                                                     href="vendor-details-1.html">Owner</a></span>
                                         @else
                                             <span class="font-small text-muted">By <a
                                                     href="vendor-details-1.html">{{ $item['vendor']['name'] }}</a></span>
                                         @endif
                                     </div>
                                     <div class="product-card-bottom">

                                         @if ($item->discount_price == null)
                                             <div class="product-price">
                                                 <span>{{ number_format($item->selling_price, 0) }} IQD</span>
                                             </div>
                                         @else
                                             <div class="product-price">
                                                 <span>{{ number_format($item->discount_price, 0) }} IQD</span>
                                                 <span
                                                     class="old-price block absolute bottom-1">{{ number_format($item->selling_price, 0) }}
                                                     IQD</span>
                                             </div>
                                         @endif
                                         <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}"
                                             class="Addbtn Addbtn-2">Add</a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <!--end product card-->
                     @endforeach

                     <!--end product card-->




                 </div>
                 <!--End product-grid-4-->
             </div>


         </div>
         <!--End tab-content-->
     </div>


 </section>
 <!--End Fashion Category -->
 <section class="section-padding mb-30">
     <div class="container">
         <div class="row">
             <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp"
                 data-wow-delay="0">
                 <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                 <div class="product-list-small animated animated">

                     @foreach ($hot_deals as $hot_deal)
                         <article class="row align-items-center hover-up">
                             <figure class="col-md-4 mb-0">
                                 <a
                                     href="{{ url('product/details/' . $hot_deal->id . '/' . $hot_deal->product_slug) }} "><img
                                         src="{{ asset($hot_deal->product_thambnail) }}" alt="" /></a>
                             </figure>
                             <div class="col-md-8 mb-0">
                                 <h6>
                                     <a
                                         href="{{ url('product/details/' . $hot_deal->id . '/' . $hot_deal->product_slug) }} ">{{ $hot_deal->product_name }}</a>
                                 </h6>
                                 <div class="product-rate-cover">
                                     <div class="product-rate d-inline-block">
                                         <div class="product-rating" style="width: 90%"></div>
                                     </div>
                                     <span class="font-small ml-5 text-muted"> (4.0)</span>
                                 </div>
                                 @php
                                     $amount = $hot_deal->selling_price - $hot_deal->discount_price;
                                     $discount = ($amount / $hot_deal->selling_price) * 100;
                                 @endphp
                                 @if ($hot_deal->discount_price == null)
                                     <div class="product-price">
                                         <span>{{ number_format($hot_deal->selling_price, 0) }} IQD </span>

                                     </div>
                                 @else
                                     <div class="product-price">
                                         <span>{{ number_format($hot_deal->discount_price, 0) }} IQD</span>
                                         <span class="old-price">{{ number_format($hot_deal->selling_price, 0) }}
                                             IQD</span>
                                     </div>
                                 @endif
                             </div>
                         </article>
                     @endforeach
                 </div>
             </div>
             <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp"
                 data-wow-delay=".1s">
                 <h4 class="section-title style-1 mb-30 animated animated"> Special Offer </h4>
                 <div class="product-list-small animated animated">
                     @foreach ($special_offers as $special_offer)
                         <article class="row align-items-center hover-up">
                             <figure class="col-md-4 mb-0">
                                 <a
                                     href="{{ url('product/details/' . $special_offer->id . '/' . $special_offer->product_slug) }} "><img
                                         src="{{ asset($special_offer->product_thambnail) }}" alt="" /></a>
                             </figure>
                             <div class="col-md-8 mb-0">
                                 <h6>
                                     <a
                                         href="{{ url('product/details/' . $special_offer->id . '/' . $special_offer->product_slug) }}">{{ $special_offer->product_name }}</a>
                                 </h6>
                                 <div class="product-rate-cover">
                                     <div class="product-rate d-inline-block">
                                         <div class="product-rating" style="width: 90%"></div>
                                     </div>
                                     <span class="font-small ml-5 text-muted"> (4.0)</span>
                                 </div>
                                 @php
                                     $amount = $special_offer->selling_price - $special_offer->discount_price;
                                     $discount = ($amount / $special_offer->selling_price) * 100;
                                 @endphp @if ($special_offer->discount_price == null)
                                     <div class="product-price">
                                         <span>{{ number_format($special_offer->selling_price, 0) }} IQD</span>

                                     </div>
                                 @else
                                     <div class="product-price">
                                         <span>{{ number_format($special_offer->discount_price, 0) }} IQD</span>
                                         <span class="old-price">{{ number_format($special_offer->selling_price, 0) }}
                                             IQD</span>
                                     </div>
                                 @endif
                             </div>
                         </article>
                     @endforeach
                 </div>
             </div>
             <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp"
                 data-wow-delay=".2s">
                 <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                 <div class="product-list-small animated animated">
                     @foreach ($news as $new)
                         <article class="row align-items-center hover-up">
                             <figure class="col-md-4 mb-0">
                                 <a href="{{ url('product/details/' . $new->id . '/' . $new->product_slug) }}"><img
                                         src="{{ asset($new->product_thambnail) }}" alt="" /></a>
                             </figure>
                             <div class="col-md-8 mb-0">
                                 <h6>
                                     <a
                                         href="{{ url('product/details/' . $new->id . '/' . $new->product_slug) }}">{{ $new->product_name }}</a>
                                 </h6>
                                 <div class="product-rate-cover">
                                     <div class="product-rate d-inline-block">
                                         <div class="product-rating" style="width: 90%"></div>
                                     </div>
                                     <span class="font-small ml-5 text-muted"> (4.0)</span>
                                 </div>
                                 @php
                                     $amount = $new->selling_price - $new->discount_price;
                                     $discount = ($amount / $new->selling_price) * 100;
                                 @endphp
                                 @if ($new->discount_price == null)
                                     <div class="product-price">
                                         <span>{{ number_format($new->selling_price, 0) }} IQD</span>

                                     </div>
                                 @else
                                     <div class="product-price">
                                         <span>{{ number_format($new->discount_price, 0) }} IQD</span>
                                         <span class="old-price">{{ number_format($new->selling_price, 0) }}
                                             IQD</span>
                                     </div>
                                 @endif
                             </div>
                         </article>
                     @endforeach
                 </div>
             </div>
             <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp"
                 data-wow-delay=".3s">
                 <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                 <div class="product-list-small animated animated">
                     @foreach ($special_deals as $special_deal)
                         <article class="row align-items-center hover-up">
                             <figure class="col-md-4 mb-0">
                                 <a
                                     href="{{ url('product/details/' . $special_deal->id . '/' . $special_deal->product_slug) }}"><img
                                         src="{{ asset($special_deal->product_thambnail) }}" alt="" /></a>
                             </figure>
                             <div class="col-md-8 mb-0">
                                 <h6>
                                     <a
                                         href="{{ url('product/details/' . $special_deal->id . '/' . $special_deal->product_slug) }}">{{ $special_deal->product_name }}</a>
                                 </h6>
                                 <div class="product-rate-cover">
                                     <div class="product-rate d-inline-block">
                                         <div class="product-rating" style="width: 90%"></div>
                                     </div>
                                     <span class="font-small ml-5 text-muted"> (4.0)</span>
                                 </div>
                                 @php
                                     $amount = $special_deal->selling_price - $special_deal->discount_price;
                                     $discount = ($amount / $special_deal->selling_price) * 100;
                                 @endphp
                                 @if ($special_deal->discount_price == null)
                                     <div class="product-price">
                                         <span>{{ number_format($special_deal->selling_price, 0) }} IQD</span>

                                     </div>
                                 @else
                                     <div class="product-price">
                                         <span>{{ number_format($special_deal->discount_price, 0) }} IQD</span>
                                         <span class="old-price">{{ number_format($special_deal->selling_price, 0) }}
                                             IQD</span>
                                     </div>
                                 @endif
                             </div>
                         </article>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!--End 4 columns-->
 <!--Vendor List -->

 @include('frontend.home.home_vendor_list')


 <!--End Vendor List -->
@endsection
