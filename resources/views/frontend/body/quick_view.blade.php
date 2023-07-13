<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel"
    aria-hidden="true">
    {{-- am basha labar away ka la regay ajaxawa datakanman peshan adaynawa la tabekda ka ba sheway popup dar dakawe awa pewistman ba id aw datayanaya ka peshan adretawa boya dabe id yan bo dabnen --}}
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">



                            <div><img src="" alt="product image" id="product_image" /></div>

                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                            {{-- <span class="stock-status out-stock"> Sale Off </span> --}}
                            <h3 class="title-detail"><a href="" id="product_name"
                                    class="text-4xl uppercase text-wrap font-bold ">
                                </a></h3>
                            <br>
                            {{-- <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                </div>
                            </div> --}}
                            {{-- @if ($product->product_size == null)
                            @else --}}
                            <div class="attr-detail attr-size mb-30" id="sizeArea">
                                <strong class="mr-10" style="width:60px;">Size: </strong>
                                <select class="form-control unicase-form-control" name="size" id="size">
                                    {{-- <option selected="" disabled="">--Choose Size--</option> --}}
                                    {{-- @foreach ($product_size as $size) --}}

                                    {{-- @endforeach --}}
                                </select>
                            </div>
                            {{-- @endif --}}

                            {{-- @if ($product->product_color == null)
                            @else --}}
                            <div class="attr-detail attr-size mb-30" id="colorArea">
                                <strong class="mr-10" style="width:50px;">Color: </strong>
                                <select class="form-control unicase-form-control" name="color" id="color">
                                    {{-- <option selected="" disabled="">--Choose Color--</option> --}}
                                    {{-- @foreach ($product_color as $color) --}}
                                    {{-- @endforeach --}}
                                </select>
                            </div>
                            {{-- @endif --}}

                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    <div class="flex flex-col">
                                        <span>
                                            <span class="current-price font-md text-brand" id="price"></span>
                                            <span class="current-price  text-brand">IQD</span>

                                        </span>
                                        {{-- <span class="save-price font-md color3 ml-15">26% Off</span> --}}
                                        <span class="ml-20">

                                            <span class="old-price font-sm d-inline-block  mt-20" id="old_price"></span>
                                            <span id="old_priceC"
                                                class="old-price font-sm d-inline-block ml-0 mt-20 "></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="detail-extralink mb-30">
                                <div class="detail-qty border radius">

                                    <input type="number" name="product_qty" id="quantity" class="qty-val"
                                        value="1" min="1" max="">
                                </div>
                                <div class="product-extra-link2">
                                    <input type="hidden" name="" id="product_id">
                                    <button type="submit" onclick="addToCart()" class="button button-add-to-cart"><i
                                            class="fi-rs-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">Brand: <span id="product_brand"
                                                    class="text-brand"></span></li>
                                            <li class="mb-5">category:<span id="product_category" class="text-brand">
                                                </span></li>

                                        </ul>

                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">subcategory: <span class="text-brand"
                                                    id="product_subcategory"></span></li>
                                            <li class="mb-5">Stock:<span class="badge badge-pill badge-success"
                                                    id="available" style="background: green;color:white;"> </span>
                                                <span class="badge badge-pill badge-danger" id="stockout"
                                                    style="background: red;color:white;"> </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
