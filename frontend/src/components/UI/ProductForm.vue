<template>
  <div class="card">
    <div class="card-body p-4">
      <h5 class="card-title">Add New Product</h5>
      <hr />
      <form
        id="myForm"
        action="{{ route('store.product') }}"
        method="post"
        enctype="multipart/form-data"
      >
        <div class="form-body mt-4">
          <div class="row">
            <div class="col-lg-8"></div>
          </div>
        </div>
        <!-- Form contents go here -->
        <product-details>
          <label for="inputProductTitle" class="form-label">ProductName </label>
          <input
            type="text"
            name="product_name"
            class="form-control"
            id="inputProductTitle"
            placeholder="enter product name"
          />
          <div class="mb-3">
            <label for="inputProductTitle" class="form-label"
              >Product Tags</label
            >
            <input
              type="text"
              name="product_tags"
              class="form-control visually.hidden"
              data-role="tagsinput"
              value="new product,top product"
            />
          </div>
          <div class="mb-3">
            <label for="inputProductTitle" class="form-label"
              >Product Size</label
            >
            <input
              type="text"
              name="product_size"
              class="form-control visually.hidden"
              data-role="tagsinput"
              value="Small,Midium,Large"
            />
          </div>
          <div class="mb-3">
            <label for="inputProductTitle" class="form-label"
              >Product Color</label
            >
            <input
              type="text"
              name="product_color"
              class="form-control visually.hidden"
              data-role="tagsinput"
              value="Red,Blue,Black"
            />
          </div>

          <div class="form-group mb-3">
            <label for="inputProductDescription" class="form-label"
              >Short Description</label
            >
            <textarea
              name="short_descp"
              class="form-control"
              id="inputProductDescription"
              rows="3"
            ></textarea>
          </div>

          <div class="mb-3">
            <label for="inputProductDescription" class="form-label"
              >Long Description</label
            >
            <textarea id="mytextarea" name="long_descp">Hello, World!</textarea>
          </div>
        </product-details>
      </form>
    </div>
  </div>
</template>
<script>
import ProductDetails from "@/components/UI/ProductDetails.vue";
export default {
  components: {
    ProductDetails,
  },
};
</script>
