function viewProduct(id) {
    $.ajax({
        type: "GET",
        url: "/product/view/modal/" + id,
        dataType: "json",
        success: function (data) {
            const options = {
                style: "decimal",
                maximumFractionDigits: 2,
            };

            function formatAmount(amount) {
                return amount.toLocaleString("en-IQ", options) + " IQD";
            }
            $("#product_name").text(data.product.product_name);
            $("#price").text(formatAmount(data.product.selling_price));
            $("#product_category").text(data.product.category.category_name);
            $("#product_brand").text(data.product.brand.brand_name);
            $("#product_id").val(id);
            $("#quantity").attr("max", data.product.product_qty);
            $("#quantity").val(1);
            $("#pvendor_id").text(data.product.vendor_id);
            $("#product_subcategory").text(
                data.product.subcategory.subcategory_name
            );
            $("#product_image").attr(
                "src",
                "/" + data.product.product_thambnail
            );

            if (data.product.discount_price == null) {
                $("#price").text("");
                $("#old_price").text("");
                $("#old_priceC").text("");
                $("#price").text(formatAmount(data.product.selling_price));
            } else {
                $("#price").text(formatAmount(data.product.discount_price));
                $("#old_price").text(formatAmount(data.product.selling_price));
            }
            // stock area
            if (data.product.product_qty > 0) {
                $("#available").text("");
                $("#stockout").text("");
                $("#available").text("available");
            } else {
                $("#available").text("");
                $("#stockout").text("");
                $("#stockout").text("stockout");
            }
            // Reset quantity input value when closing the modal
            $("#quickViewModal").on("hidden.bs.modal", function () {
                $("#quantity").val(1);
                $("#quantity").attr("max", "");
                $("#product_image").attr("src", "");
            });

            //size
            $('select[name="size"]').empty();
            $.each(data.size, function (key, value) {
                $('select[name="size"]').append(
                    '<option value="' + value + '">' + value + "</option>"
                );
                if (data.size == "") {
                    $("#sizeArea").hide();
                } else {
                    $("#sizeArea").show();
                }
            });
            //color
            $('select[name="color"]').empty();
            $.each(data.color, function (key, value) {
                $('select[name="color"]').append(
                    '<option value="' + value + '">' + value + "</option>"
                );
                if (data.color == "") {
                    $("#colorArea").hide();
                } else {
                    $("#colorArea").show();
                }
            });
        },
    });
}
// shopping cart
function addToCart() {
    let product_id = $("#product_id").val();
    let product_name = $("#product_name").text();
    let quantity = $("#quantity").val();
    let size = $("#size option:selected").text();
    let color = $("#color option:selected").text();
    let vendor = $("#pvendor_id").text();
    $("#closeModal").click();

    $.ajax({
        type: "POST",
        url: "/cart/store/" + product_id, // Corrected URL

        data: {
            product_name: product_name,
            quantity: quantity,
            size: size,
            color: color,
            vendor: vendor,
        },
        dataType: "json",
        success: function (data) {
            //calling minicart function to show cart items after adding to cart without reloading the page
            miniCart();
            // console.log(data);
            // Handle the success response as needed
            const toast = swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", swal.stopTimer);
                    toast.addEventListener("mouseleave", swal.resumeTimer);
                },
            });
            if ($.isEmptyObject(data.error)) {
                toast.fire({
                    icon: "success",
                    title: data.success,
                });
            } else {
                toast.fire({
                    icon: "error",
                    title: data.error,
                });
            }
            // End Message
        },
    });
}
// shopping detail cart
function addInDetails() {
    let product_id = $("#id").val();
    let product_name = $("#dproduct_name").text();
    let quantity = $("#dquantity").val();
    var vendor = $("#vproduct_id").val();
    let size = $("#dsize option:selected").text();
    let color = $("#dcolor option:selected").text();

    $.ajax({
        type: "POST",
        url: "/mini/cart/detail/" + product_id, // Corrected URL
        data: {
            product_name: product_name,
            quantity: quantity,
            size: size,
            color: color,
            vendor: vendor,
        },
        dataType: "json",
        success: function (data) {
            //calling minicart function to show cart items after adding to cart without reloading the page
            miniCart();
            // console.log(data);
            // Handle the success response as needed
            const toast = swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                icon: "success",
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", swal.stopTimer);
                    toast.addEventListener("mouseleave", swal.resumeTimer);
                },
            });
            if ($.isEmptyObject(data.error)) {
                toast.fire({
                    icon: "success",
                    title: data.success,
                });
            } else {
                toast.fire({
                    icon: "error",
                    title: data.error,
                });
            }
            // End Message
        },
    });
}

function miniCart() {
    $.ajax({
        type: "GET",
        url: "/mini/cart",
        dataType: "json",
        success: function (response) {
            // console.log(response);
            const options = {
                style: "decimal",
                maximumFractionDigits: 2,
            };

            function formatAmount(amount) {
                return amount.toLocaleString("en-IQ", options) + " IQD";
            }
            $("#m-itemNumber").text(response.quantity);
            $("#itemNumber").text(response.quantity);
            $("#m-totalPrice").text(formatAmount(response.total));
            $("#totalPrice").text(formatAmount(response.total));
            let miniCart = "";

            //response.cartCollection is the cart data in json format that we have passed from the controller and loop through it
            $.each(response.cartCollection, function (key, value) {
                miniCart += ` <ul>
            <li>
                <div class="shopping-cart-img mt-4">
                    <a href="shop-product-right.html"><img alt="Nest" src="/${
                        value.attributes.product_thumbnail
                    } " class='rounded-full shadow-lg mb-3' style="width:50px;height:50px;" /></a>
                </div>
                <div class="shopping-cart-title" style="margin: -60px 74px 14px; width" 146px;>
                    <h4><a href="shop-product-right.html"> ${
                        value.name
                    } </a></h4>
                    <h4><span>${value.quantity} × </span>${formatAmount(
                    value.price
                )}</h4>
                </div>
                <div class="shopping-cart-delete" style="margin: -55px 1px 0px; ">
                    <a type='submit' id='${
                        value.id
                    }' onclick='removeCartItem(this.id)'><i class="fi-rs-cross-small pt-1 px-1 rounded-full  text-white bg-red-500" style="width:50px; height:50px;"></i></a>
                </div>
            </li>
        </ul>
        <hr><br>
               `;
            });
            $("#m-miniCart").html(miniCart);
            $("#miniCart").html(miniCart);
        },
    });
}
//end mini cart
miniCart();
//start remove cart item
function removeCartItem(id) {
    $.ajax({
        type: "GET",
        url: "/cart/product/remove/" + id,
        dataType: "json",
        success: function (data) {
            miniCart();
            // console.log(data);
            // Handle the success response as needed
            const toast = swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                icon: "success",
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", swal.stopTimer);
                    toast.addEventListener("mouseleave", swal.resumeTimer);
                },
            });
            if ($.isEmptyObject(data.error)) {
                toast.fire({
                    title: data.success,
                });
            } else {
                toast.fire({
                    title: data.success,
                });
            }
        },
    });
}
//end remove cart item

// <!--  /// Start Wishlist Add -->

function addToWishList(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "/add-to-wishlist/" + id,
        success: function (data) {
            wishlist();
            // Start Message
            const toast = swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,

                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", swal.stopTimer);
                    toast.addEventListener("mouseleave", swal.resumeTimer);
                },
            });
            if ($.isEmptyObject(data.error)) {
                toast.fire({
                    icon: "success",
                    title: data.success,
                });
            } else {
                toast.fire({
                    icon: "error",
                    title: data.error,
                });
            }
            // End Message
        },
        // End Success
    });
    // End Ajax
}

// <!--  /// Start Load Wishlist Data -->

function wishlist() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/get-wishlist-product/",
        success: function (response) {
            // console.log(response);
            const options = {
                style: "decimal",
                maximumFractionDigits: 2,
            };

            function formatAmount(amount) {
                return amount.toLocaleString("en-IQ", options) + " IQD";
            }
            $("#m-wishQty").text(response.wishQty);
            $("#wishQty").text(response.wishQty);
            let rows = "";
            $.each(response.wishlist, function (key, value) {
                let price = value.product.selling_price;
                let discount = value.product.discount_price;
                rows += `<tr class="pt-30">
                        <td class="custome-checkbox pl-30">

                        </td>
                        <td class="image product-thumbnail  pt-40"><img src="/${
                            value.product.product_thambnail
                        }"  alt="#" /></td>
                        <td class="product-des product-name">
                            <h6><a class="product-name mb-10" href="shop-product-right.html">${
                                value.product.product_name
                            } </a></h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                        </td>
                        <td class="price" data-title="Price">
                        ${
                            discount == null
                                ? `<h3 class="text-brand">${formatAmount(
                                      price
                                  )}</h3>`
                                : `<h3 class="text-brand">${formatAmount(
                                      discount
                                  )}</h3>`
                        }

                        </td>
                        <td class="text-center detail-info" data-title="Stock">
                            ${
                                value.product.product_qty > 0
                                    ? `<span class="stock-status in-stock mb-0"> In Stock </span>`
                                    : `<span class="stock-status out-stock mb-0">Stock Out </span>`
                            }

                        </td>

                        <td class="action text-center" data-title="Remove">
                            <a type="submit" class="text-white base-button " id="${
                                value.id
                            }" onclick="wishlistRemove(this.id)">
    <i class="fi-rs-trash"></i>
  </a>
                        </td>
                    </tr> `;
            });

            $("#wishlist").html(rows);
        },
    });
}
wishlist();

{
    /* <!--  /// End Load Wishlist Data --> */
}
{
    /* <!--  /// Start Wishlist Remove --> */
}

function wishlistRemove(id) {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/remove-wishlist/" + id,
        success: function (data) {
            wishlist();
            // Start Message
            const toast = swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,

                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", swal.stopTimer);
                    toast.addEventListener("mouseleave", swal.resumeTimer);
                },
            });
            if ($.isEmptyObject(data.error)) {
                toast.fire({
                    icon: "success",
                    title: data.success,
                });
            } else {
                toast.fire({
                    icon: "error",
                    title: data.error,
                });
            }
            // End Message
        },
    });
}

// <!--  /// End Wishlist Remove -->
// <!--  /// compare Add -->
// <!--  /// Start Compare Add -->

function addToCompare(product_id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "/add-to-compare/" + product_id,
        success: function (data) {
            // Start Message
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",

                showConfirmButton: false,
                timer: 3000,
            });
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: "success",
                    icon: "success",
                    title: data.success,
                });
            } else {
                Toast.fire({
                    type: "error",
                    icon: "error",
                    title: data.error,
                });
            }
            // End Message
        },
    });
}

// <!--  /// End Compare Add -->
// <!--  /// Start Load Compare Data -->
{
    /* <script type="text/javascript"> */
}
function compare() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/get-compare-product/",
        success: function (response) {
            var rows = "";
            const options = {
                style: "currency",
                currency: "IQD",
            };
            function formatAmount(amount) {
                return amount.toLocaleString("en-US", options);
            }

            // Example usage:

            function formatAmount(amount) {
                return amount.toLocaleString("en-IQ", options) + " IQD";
            }
            $.each(response, function (key, value) {
                const selling_price = value.product.selling_price;
                const discount_price = value.product.discount_price;
                rows += ` <tr class="pr_image">
                                    <td class="text-muted font-sm fw-600 font-heading mw-200">Preview</td>
    <td class="row_img"><img src="/${
        value.product.product_thambnail
    } " style="width:300px; height:300px;"  alt="compare-img" /></td>

                                </tr>
                                <tr class="pr_title">
                                    <td class="text-muted font-sm fw-600 font-heading">Name</td>
                                    <td class="product_name">
                                        <h6><a href="shop-product-full.html" class="text-heading">${
                                            value.product.product_name
                                        } </a></h6>
                                    </td>

                                </tr>
                                <tr class="pr_price">
                                    <td class="text-muted font-sm fw-600 font-heading">Price</td>
                                    <td class="product_price">
                      ${
                          value.product.discount_price == null
                              ? `<h4 class="price text-brand">${formatAmount(
                                    selling_price
                                )}</h4>`
                              : `<h4 class="price text-brand">${formatAmount(
                                    discount_price
                                )}</h4>`
                      }
                                    </td>

                                </tr>

                                <tr class="description">
                                    <td class="text-muted font-sm fw-600 font-heading">Description</td>
                                    <td class="row_text font-xs">
                                        <p class="font-sm text-muted"> ${
                                            value.product.short_descp
                                        }</p>
                                    </td>

                                </tr>
                                <tr class="pr_stock">
                                    <td class="text-muted font-sm fw-600 font-heading">Stock status</td>
                                    <td class="row_stock">
                                ${
                                    value.product.product_qty > 0
                                        ? `<span class="stock-status in-stock mb-0"> In Stock </span>`
                                        : `<span class="stock-status out-stock mb-0">Stock Out </span>`
                                }
                              </td>

                                </tr>

            <tr class="pr_remove text-muted">
                <td class="text-muted font-md fw-600"></td>
                <td class="row_remove">
                    <a type="submit" class="text-muted"  id="${
                        value.id
                    }" onclick="compareRemove(this.id)"><i class="fi-rs-trash mr-5"></i><span>Remove</span> </a>
                </td>

            </tr> `;
            });
            $("#compare").html(rows);
        },
    });
}
compare();

function compareRemove(id) {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/compare-remove/" + id,
        success: function (data) {
            compare();
            // Start Message
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",

                showConfirmButton: false,
                timer: 3000,
            });
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: "success",
                    icon: "success",
                    title: data.success,
                });
            } else {
                Toast.fire({
                    type: "error",
                    icon: "error",
                    title: data.error,
                });
            }
            // End Message
        },
    });
}
// / End Load Compare Data -->
// Compare Remove Start

// Compare Remove End

// <!--  // Start Load MY Cart // -->
{
    /* <script type="text/javascript"> */
}
function cart() {
    $.ajax({
        type: "GET",
        url: "/get-cart-product",
        dataType: "json",
        success: function (response) {
            // console.log(response);
            const options = {
                style: "decimal",
                maximumFractionDigits: 2,
            };
            function formatAmount(amount) {
                return amount.toLocaleString("en-IQ", options) + " IQD";
            }
            let rows = "";
            $.each(response.cartCollection, function (key, value) {
                let subtotoal = value.quantity * value.price;
                rows += `<tr class="pt-30">
           <td class="custome-checkbox pl-30">

           </td>
           <td class="image product-thumbnail pt-40"><img class="shadow-lg" style="border-radius:99999px;border:none" src="/${
               value.attributes.product_thumbnail
           } " alt="#"></td>
           <td class="product-des product-name">
               <h6 class="mb-5 text-xl font-bold"><a class="product-name mb-10 text-heading" href="shop-product-right.html">${
                   value.name
               } </a></h6>

           </td>
           <td class="price" data-title="Price">
               <h4 class="text-body text-xl font-bold">${formatAmount(
                   value.price
               )} </h4>
           </td>
             <td class="price" data-title="Price">
             ${
                 value.attributes.color == null
                     ? `<span>.... </span>`
                     : `<h6 class="text-body text-xl font-bold">${value.attributes.color} </h6>`
             }
           </td>
              <td class="price" data-title="Price">
             ${
                 value.attributes.size == null
                     ? `<span>.... </span>`
                     : `<h6 class="text-body text-xl font-bold">${value.attributes.size} </h6>`
             }
           </td>
           <td class="text-left detail-info" data-title="Stock">
               <div class="detail-extralink mr-15">
                   <div class="detail-qty border radius">
                    <a type="submit" class="qty-down" id="${
                        value.id
                    }" onclick="cartDecrement(this.id)"><i class="fi-rs-angle-small-down"></i></a>

     <input type="text" name="quantity" class="qty-val" value="${
         value.quantity
     }" min="1" max="${value.quantity}">
     <a  type="submit" class="qty-up" id="${
         value.id
     }" onclick="cartIncrement(this.id)"><i class="fi-rs-angle-small-up"></i></a>
                   </div>
               </div>
           </td>

           <td class="price" data-title="Price">
               <h4 class="text-brand text-xl font-bold">${formatAmount(
                   subtotoal
               )} </h4>
           </td>
           <td class="action text-left ml-2" data-title="Remove">
            <a type="submit" class="text-body"  id="${
                value.id
            }" onclick="cartRemove(this.id)"><i class="fi-rs-trash bg-red-500 pt-3 pb-2 px-3 rounded-full  text-white text-xl"></i></a></td>
       </tr>`;
            });
            $("#cartPage").html(rows);
            // Check if the cart is empty
            if (response.cartCollection.length === 0) {
                // If cart is empty, hide the div with id "cartTotalsDiv"
                $("#couponFieldContainer").hide();
            } else {
                // If cart is not empty, show the div with id "cartTotalsDiv"
                $("#couponFieldContainer").show();
            }
        },
    });
}
cart();
// Cart Remove Start
function cartRemove(id) {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/cart-remove/" + id,
        success: function (data) {
            cart();
            miniCart();
            couponCalculation();
            // Start Message
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",

                showConfirmButton: false,
                timer: 3000,
            });
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: "success",
                    icon: "success",
                    title: data.success,
                });
            } else {
                Toast.fire({
                    type: "error",
                    icon: "error",
                    title: data.error,
                });
            }
            // End Message
        },
    });
}
// Cart INCREMENT
function cartIncrement(id) {
    $.ajax({
        type: "GET",
        url: "/cart-increment/" + id,
        dataType: "json",
        success: function (data) {
            cart();
            miniCart();
            couponCalculation();
        },
    });
}
// Cart INCREMENT End
// Cart Decrement Start
function cartDecrement(id) {
    $.ajax({
        type: "GET",
        url: "/cart-decrement/" + id,
        dataType: "json",
        success: function (data) {
            cart();
            miniCart();
            couponCalculation();
        },
    });
}
// Cart Decrement End
// Cart Remove End

// <!--  // End Load MY Cart // -->

// Start Apply Coupon //
function applyCoupon() {
    // Check if the cart is empty
    //cart page tr mabastman la table kay sarawaya agar hich tr nabw awa aw erroraman bate
    if ($("#cartPage tr").length === 0) {
        // Cart is empty, show error message and return
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
        });

        Toast.fire({
            type: "error",
            icon: "error",
            title: "Cannot apply coupon. Cart is empty.",
        });

        return;
    }

    // If cart is not empty, proceed with applying the coupon
    var coupon_name = $("#coupon_name").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { coupon_name: coupon_name },
        url: "/coupon-apply",
        success: function (data) {
            couponCalculation();

            //agar couponaka bakar hat aw sectionay ka couponakay tyaya dyar namenet
            // Start Message
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",

                showConfirmButton: false,
                timer: 3000,
            });
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: "success",
                    icon: "success",
                    title: data.success,
                });
            } else {
                Toast.fire({
                    type: "error",
                    icon: "error",
                    title: data.error,
                });
            }
            // End Message
        },
    });
}
// End Apply Coupon //
// Start CouponCalculation Method
function couponCalculation() {
    $.ajax({
        type: "GET",
        url: "/coupon-calculation",
        dataType: "json",
        success: function (data) {
            const options = {
                style: "decimal",
                maximumFractionDigits: 2,
            };

            function formatAmount(amount) {
                return amount.toLocaleString("en-IQ", options) + " IQD";
            }

            if (data.total) {
                $("#couponCalField").html(
                    ` <tr>
                        <td class="cart_total_label ">
                            <h6 class="text-muted">Subtotal</h6>
                        </td>
                        <td class="cart_total_amount py-2">
                            <h4 class="text-brand text-end">${formatAmount(
                                data.total
                            )}</h4>
                        </td>
                    </tr>

                    <tr>
                        <td class="cart_total_label py-2">
                            <h6 class="text-muted">Grand Total</h6>
                        </td>
                        <td class="cart_total_amount py-2">
                            <h4 class="text-brand text-end">${formatAmount(
                                data.total
                            )}</h4>
                        </td>
                    </tr>
                    `
                );
            } else {
                $("#couponCalField").html(
                    `<tr>
                        <td class="cart_total_label py-2">
                            <h6 class="text-muted font-bold">Subtotal</h6>
                        </td>
                        <td class="cart_total_amount py-2">
                            <h4 class="text-brand text-end font-bold">${formatAmount(
                                data.subtotal
                            )}</h4>
                        </td>
                    </tr>

                    <tr>
                        <td class="cart_total_label py-2">
                            <h6 class="text-muted font-bold">Coupon </h6>
                        </td>
                        <td class="cart_total_amount py-2">
                            <h6 class="text-brand text-end font-bold">${
                                data.coupon_name
                            } <a type="submit" onclick="couponRemove()"><i class="fi-rs-trash  bg-red-500 pt-2  px-2 pb-1 rounded-full  text-white text-md"></i> </a> </h6>
                        </td>
                    </tr>
                    <tr>
                        <td class="cart_total_label py-2">
                            <h6 class="text-muted font-bold">Discount Amount  </h6>
                        </td>
                        <td class="cart_total_amount py-2">
                            <h4 class="text-brand text-end font-bold">${formatAmount(
                                data.discount_amount
                            )}</h4>
                        </td>
                    </tr>
                    <tr>
                        <td class="cart_total_label py-2">
                            <h6 class="text-muted font-bold">Grand Total </h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end  font-bold">${formatAmount(
                                data.total_amount
                            )}</h4>
                        </td>
                    </tr> `
                );
            }
        },
    });
}
couponCalculation();
// end CouponCalculation Method
// Coupon Remove Start
function couponRemove() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/coupon-remove",
        success: function (data) {
            couponCalculation();
            // Start Message
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",

                showConfirmButton: false,
                timer: 3000,
            });
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: "success",
                    icon: "success",
                    title: data.success,
                });
            } else {
                Toast.fire({
                    type: "error",
                    icon: "error",
                    title: data.error,
                });
            }
            // End Message
        },
    });
}
// Coupon Remove End
