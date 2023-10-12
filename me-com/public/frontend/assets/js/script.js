const site_url = "http://127.0.0.1:8000/";

$("body").on("keyup", ["#search", "#searchmb"], function () {
    let text = $("#search").val();
    let text2 = $("#searchmb").val();
    // console.log(text2);

    if (text.length > 0 || text2.length > 0) {
        $.ajax({
            data: { search: text, searchmb: text2 },
            url: site_url + "search-product",
            method: "post",
            beforSend: function (request) {
                return request.setRequestHeader(
                    "X-CSRF-TOKEN",
                    "meta[name='csrf-token']"
                );
            },

            success: function (result) {
                $("#searchProductsmb").html(result);
                $("#searchProducts").html(result);
                console.log("success");
            },
        }); //End Ajax
    } // end if

    if (text.length < 1) $("#searchProducts").html("");
    if (text2.length < 1) $("#searchProductsmb").html("");
});
