<!DOCTYPE html>
<html class="no-js light-theme" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Online Shop 🏪</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/dark-theme.css?v=1.0') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')


</head>

<body>

    <!-- Quick view -->
    @include('frontend.body.quick_view')
    <!-- Header  -->

    <!-- End Header  -->

    @include('frontend.body.header')
    <!--End header-->

    <main class="main">
        @yield('main')

    </main>
    @include('frontend.body.footer')
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('frontend/assets/imgs/theme/loading.gif') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js?v=5.4') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets/js/main.js?v=5.4') }}"></script>
    <script src="{{ asset('frontend/assets/js/shop.js?v=5.4') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        })
    </script>
    <script>
        function viewProduct(id) {
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json',
                success: function(data) {
                    $("#product_name").text(data.product.product_name);
                    $("#price").text(data.product.selling_price);
                    $("#product_category").text(data.product.category.category_name);
                    $("#product_brand").text(data.product.brand.brand_name);
                    $("#product_id").val(id);
                    $('#quantity').attr('max', data.product.product_qty);
                    $('#quantity').val(1);
                    $("#product_subcategory").text(data.product.subcategory.subcategory_name);
                    $("#product_image").attr("src", "/" + data.product.product_thambnail);

                    if (data.product.discount_price == null) {
                        $("#price").text('');
                        $("#old_price").text('');
                        $("#old_priceC").text('');
                        $("#price").text(data.product.selling_price);
                    } else {
                        $("#price").text(data.product.discount_price);
                        $("#old_price").text(data.product.selling_price);
                        $("#old_priceC").text('IQD');

                    }
                    // stock area
                    if (data.product.product_qty > 0) {
                        $("#available").text('');
                        $("#stockout").text('');
                        $("#available").text('available');
                    } else {
                        $("#available").text('');
                        $("#stockout").text('');
                        $("#stockout").text('stockout');
                    }
                    // Reset quantity input value when closing the modal
                    $('#quickViewModal').on('hidden.bs.modal', function() {
                        $('#quantity').val(1);
                        $('#quantity').attr('max', "");

                    });






                    //size
                    $('select[name="size"]').empty();
                    $.each(data.size, function(key, value) {
                        $('select[name="size"]').append('<option value="' + value + '">' + value +
                            '</option>');
                        if (data.size == "") {
                            $("#sizeArea").hide();
                        } else {
                            $("#sizeArea").show();
                        }
                    });
                    //color
                    $('select[name="color"]').empty();
                    $.each(data.color, function(key, value) {
                        $('select[name="color"]').append('<option value="' + value + '">' + value +
                            '</option>');
                        if (data.color == "") {
                            $("#colorArea").hide();
                        } else {
                            $("#colorArea").show();
                        }
                    });

                }

            })
        }
        // shopping cart
        function addToCart() {
            let product_id = $("#product_id").val();
            let product_name = $("#product_name").text();
            let quantity = $("#quantity").val();
            let size = $("#size option:selected").text();
            let color = $("#color option:selected").text();
            $('#closeModal').click();

            $.ajax({
                type: 'POST',
                url: '/cart/store/' + product_id, // Corrected URL


                data: {
                    product_name: product_name,
                    quantity: quantity,
                    size: size,
                    color: color,
                },
                dataType: 'json',
                success: function(data) {
                    //calling minicart function to show cart items after adding to cart without reloading the page
                    miniCart();
                    // console.log(data);
                    // Handle the success response as needed
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', swal.stopTimer)
                            toast.addEventListener('mouseleave', swal.resumeTimer)
                        }
                    })
                    if ($.isEmptyObject(data.error)) {
                        toast.fire({
                            title: data.success,
                        })
                    } else {
                        toast.fire({
                            title: data.success,
                        })
                    }




                }
            });
        }
        // shopping detail cart
        function addInDetails() {
            let product_id = $("#id").val();
            let product_name = $("#dproduct_name").text();
            let quantity = $("#dquantity").val();
            let size = $("#dsize option:selected").text();
            let color = $("#dcolor option:selected").text();

            $.ajax({
                type: 'POST',
                url: '/mini/cart/detail/' + product_id, // Corrected URL
                data: {
                    product_name: product_name,
                    quantity: quantity,
                    size: size,
                    color: color,
                },
                dataType: 'json',
                success: function(data) {
                    //calling minicart function to show cart items after adding to cart without reloading the page
                    miniCart();
                    // console.log(data);
                    // Handle the success response as needed
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', swal.stopTimer)
                            toast.addEventListener('mouseleave', swal.resumeTimer)
                        }
                    })
                    if ($.isEmptyObject(data.error)) {
                        toast.fire({
                            title: data.success,
                        })
                    } else {
                        toast.fire({
                            title: data.success,
                        })
                    }
                }
            });
        }
    </script>
    <script>
        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/mini/cart',
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    $('#itemNumber').text(response.quantity);
                    $('#totalPrice').text(response.total);
                    let miniCart = "";
                    //response.cartCollection is the cart data in json format that we have passed from the controller and loop through it
                    $.each(response.cartCollection, function(key, value) {
                        miniCart += ` <ul>
            <li>
                <div class="shopping-cart-img mt-4">
                    <a href="shop-product-right.html"><img alt="Nest" src="/${value.attributes.product_thumbnail} " class='rounded-full mb-3' style="width:50px;height:50px;" /></a>
                </div>
                <div class="shopping-cart-title" style="margin: -60px 74px 14px; width" 146px;>
                    <h4><a href="shop-product-right.html"> ${value.name} </a></h4>
                    <h4><span>${value.quantity} × </span>${value.price}</h4>
                </div>
                <div class="shopping-cart-delete" style="margin: -70px 1px 0px;">
                    <a type='submit' id='${value.id}' onclick='removeCartItem(this.id)'><i class="fi-rs-cross-small base-button bg-red-500"></i></a>
                </div>
            </li>
        </ul>
        <hr><br>
               `
                    });
                    $("#miniCart").html(miniCart);

                }
            })
        }
        //end mini cart
        miniCart();
        //start remove cart item
        function removeCartItem(id) {
            $.ajax({
                type: 'GET',
                url: '/cart/product/remove/' + id,
                dataType: 'json',
                success: function(data) {
                    miniCart();
                    // console.log(data);
                    // Handle the success response as needed
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', swal.stopTimer)
                            toast.addEventListener('mouseleave', swal.resumeTimer)
                        }
                    })
                    if ($.isEmptyObject(data.error)) {
                        toast.fire({
                            title: data.success,
                        })
                    } else {
                        toast.fire({
                            title: data.success,
                        })
                    }
                }
            });
        }
        //end remove cart item
    </script>

</body>

</html>
