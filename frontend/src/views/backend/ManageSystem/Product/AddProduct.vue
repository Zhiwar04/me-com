<template>
  <pre-loader v-if="isLoading"></pre-loader>
  <page-titles>
    <template #title> Add Products </template>
    <template #desc> Add Products </template>
  </page-titles>
  <div class="card">
    <div class="col-12">
      <form
        id="myForm"
        @submit.prevent="storeOrUpdateProduct"
        enctype="multipart/form-data"
      >
        <div class="form-body mt-4">
          <div class="row">
            <div class="col-lg-8">
              <div class="border border-3 p-4 rounded">
                <div class="form-group mb-3">
                  <label for="inputProductTitle" class="form-label"
                    >Product Name</label
                  >
                  <input
                    type="text"
                    name="product_name"
                    class="form-control"
                    id="inputProductTitle"
                    placeholder="Enter product name"
                    v-model="form.product_name"
                  />
                </div>

                <div class="mb-3">
                  <label for="inputProductTitle" class="form-label"
                    >Product Tags</label
                  >
                  <input
                    type="text"
                    name="product_tags"
                    class="form-control visually.hidden"
                    data-role="tagsinput"
                    placeholder="something,something,"
                    v-model="form.product_tags"
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
                    v-model="form.product_size"
                    placeholder="something,something,"
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
                    v-model="form.product_color"
                    placeholder="something,something,"
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
                    v-model="form.short_descp"
                  ></textarea>
                </div>

                <div class="mb-3">
                  <label for="inputProductDescription" class="form-label"
                    >Long Description</label
                  >
                  <editor
                    api-key="no-api-key"
                    id="mytextarea"
                    name="long_descp"
                    v-model="form.long_descp"
                    :init="{
                      menubar: false,

                      skin: 'oxide-dark',
                      content_css: 'dark',
                      plugins: 'lists link image emoticons',
                      toolbar:
                        'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image emoticons',
                    }"
                  />
                </div>
                <div class="form-group mb-3" v-show="!isUpdate">
                  <label for="inputProductTitle" class="form-label"
                    >Main Thambnail</label
                  >
                  <input
                    name="product_thambnail"
                    class="form-control"
                    type="file"
                    id="formFile"
                    @change="mainThumbnail($event)"
                  />
                  <img
                    :src="form.mainThumbnailSrc"
                    class="pic rounded-2xl"
                    id="mainThmb"
                    alt="Preview Image"
                  />
                </div>
                <div class="form-group mb-3" v-show="!isUpdate">
                  <label for="inputProductTitle" class="form-label"
                    >Multiple Image</label
                  >
                  <input
                    type="file"
                    name="multi_img[]"
                    class="form-control"
                    id="multi_img[]"
                    multiple
                    style="width: 20"
                    @change="multipleImages($event)"
                  />

                  <div class="row">
                    <img
                      v-for="(image, index) in form.previewImages"
                      :key="index"
                      :src="image"
                      alt="Preview Image"
                      id="preview_img"
                      class="pic rounded-2xl"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="border border-3 p-4 rounded">
                <div class="row g-3">
                  <div class="form-group col-md-6">
                    <label for="inputPrice" class="form-label"
                      >Product Price</label
                    >
                    <input
                      type="text"
                      name="selling_price"
                      class="form-control"
                      id="inputPrice"
                      placeholder="00.00"
                      v-model="form.selling_price"
                    />
                  </div>

                  <div class="col-md-6">
                    <label for="inputCompareatprice" class="form-label"
                      >Discount Price</label
                    >
                    <input
                      type="text"
                      name="discount_price"
                      class="form-control"
                      id="inputCompareatprice"
                      placeholder="00.00"
                      v-model="form.discount_price"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputCostPerPrice" class="form-label"
                      >Product Code</label
                    >
                    <input
                      type="text"
                      name="product_code"
                      class="form-control"
                      id="inputCostPerPrice"
                      placeholder="00.00"
                      v-model="form.product_code"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputStarPoints" class="form-label"
                      >Product Quantity</label
                    >
                    <input
                      type="text"
                      name="product_qty"
                      class="form-control"
                      id="inputStarPoints"
                      placeholder="00.00"
                      v-model="form.product_qty"
                    />

                    <!-- end row -->
                  </div>

                  <div class="form-group col-12">
                    <label for="inputProductType" class="form-label"
                      >Product Brand</label
                    >
                    <select
                      name="brand_id"
                      class="form-select"
                      id="inputProductType"
                      v-model="form.brand_id"
                    >
                      <option
                        v-for="(brand, index) in brands"
                        :key="index"
                        :value="brand.id"
                      >
                        {{ brand.brand_name }}
                      </option>
                    </select>
                  </div>
                  <div class="form-group col-12">
                    <label for="inputVendor" class="form-label"
                      >Product Category</label
                    >
                    <select
                      name="category_id"
                      class="form-select"
                      id="inputVendor"
                      v-model="form.category_id"
                      @change="getSubcategory"
                    >
                      <option
                        v-for="(category, index) in categories"
                        :key="index"
                        :value="category.id"
                      >
                        {{ category.category_name }}
                      </option>
                    </select>
                  </div>

                  <div class="form-group col-12">
                    <label for="inputCollection" class="form-label"
                      >Product SubCategory</label
                    >
                    <select
                      name="subcategory_id"
                      class="form-select"
                      id="inputCollection"
                      v-model="form.subcategory_id"
                    >
                      <option
                        v-for="(subcategory, index) in subcategories"
                        :key="index"
                        :value="subcategory.id"
                      >
                        {{ subcategory.subcategory_name }}
                      </option>
                    </select>
                  </div>

                  <div class="col-12">
                    <label for="inputCollection" class="form-label"
                      >Select Vendor</label
                    >
                    <select
                      name="vendor_id"
                      class="form-select"
                      id="inputCollection"
                      v-model="form.vendor_id"
                    >
                      <option
                        v-for="(vendor, index) in vendors"
                        :key="index"
                        :value="vendor.id"
                      >
                        {{ vendor.name }}
                      </option>
                    </select>
                  </div>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          name="deals"
                          type="checkbox"
                          id="flexCheckDefault"
                          v-model="form.hot_deals"
                          value="true"
                        />
                        <label class="from-check-label" for="flexCheckDefault"
                          >Hot Deals</label
                        >
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          name="deals"
                          type="checkbox"
                          id="flexCheckDefault"
                          v-model="form.featured"
                          value="true"
                        />
                        <label class="from-check-label" for="flexCheckDefault"
                          >Featured</label
                        >
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          name="deals"
                          type="checkbox"
                          id="flexCheckDefault"
                          v-model="form.special_offer"
                          value="true"
                        />
                        <label class="from-check-label" for="flexCheckDefault"
                          >Special Offer</label
                        >
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          name="deals"
                          type="checkbox"
                          id="flexCheckDefault"
                          v-model="form.special_deals"
                          value="true"
                        />
                        <label class="from-check-label" for="flexCheckDefault"
                          >Special Deals</label
                        >
                      </div>
                    </div>
                  </div>
                  <hr />

                  <div class="col-12">
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary px-4">
                        <span v-if="!isUpdate"> Add Product </span>
                        <span v-else> Update Product </span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--end row-->
        </div>
        <!-- Display error messages -->
        <div v-if="form.errors.any()" class="alert alert-danger mt-3">
          <ul>
            <li v-for="(error, key) in form.errors.all()" :key="key">
              {{ error }}
            </li>
          </ul>
        </div>
      </form>
    </div>
  </div>
  <!-- Main image thambnail update -->
  <div class="page-content" v-show="isUpdate">
    <h6 class="mb-0 text-uppercase">Update Main Image Thambnail</h6>
    <hr />
    <div class="card">
      <form
        method="post"
        @submit.prevent="updateImage"
        enctype="multipart/form-data"
      >
        <div class="card-body">
          <div class="mb-3">
            <label for="formFile" class="form-label">
              Choose Thambnail Image
            </label>
            <input
              name="product_thambnail"
              class="form-control"
              type="file"
              id="formFile"
              @change="mainThumbnail($event)"
            />
          </div>
          <div class="mb-3">
            <label for="formFile" class="form-label"> </label>
            <img
              :src="form.mainThumbnailSrc"
              alt="image"
              class="pic rounded-2xl"
            />
          </div>
          <button class="btn">Update Thambnail</button>
        </div>
      </form>
    </div>
  </div>

  <!-- End Main image thambnail update -->

  <!-- Update multi image -->

  <div class="page-content" v-show="isUpdate">
    <h6 class="mb-0 text-uppercase">Update Multi Image</h6>
    <hr />
    <div class="card">
      <div class="card-body">
        <form method="post" @submit.prevent="updateMultiImage">
          <table class="table mb-0 table-striped">
            <thead>
              <tr>
                <th scope="col">#Sl</th>
                <th scope="col">Image</th>
                <th scope="col">Change Image</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in form.previewImages" :key="item.id">
                <!-- <tr> -->

                <th scope="row">{{ item.id }}</th>
                <td>
                  <img
                    :src="`http://127.0.0.1:8000/${item.photo_name}`"
                    alt="Preview Image"
                    id="preview_img"
                    class="rounded-2xl"
                    width="40"
                    height="40"
                  />
                </td>
                <td>
                  <input
                    type="file"
                    class="form-group"
                    :name="`multi_img[${item.id}]`"
                    @change="selectedImage($event)"
                  />
                </td>
                <!-- :name="`multi_img[${item.id}]`" -->
                <td>
                  <input
                    type="submit"
                    class="btn btn-primary px-4"
                    value="Update Image"
                  />
                  <a class="btn btn-danger" id="delete"> Delete </a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
  <!-- End Update multi image -->
</template>
<script>
import Form from "vform";
import Editor from "@tinymce/tinymce-vue";
import PageTitles from "@/components/UI/PageTitles.vue";
import PreLoader from "@/components/UI/PreLoader.vue";
import { toast } from "vue3-toastify";
export default {
  components: {
    Editor,
    PageTitles,
    PreLoader,
  },
  data() {
    return {
      brands: [],
      categories: [],
      subcategories: [],
      vendors: [],
      isLoading: false,
      isUpdate: false,
      form: new Form({
        mainThumbnailSrc: "assets/images/no_image.jpg",
        product_thambnail: "",
        selectedImage: "",
        product_name: "",
        multi_img: [],
        previewImages: [],
        short_descp: "",
        product_tags: [],
        product_color: [],
        product_size: [],
        selling_price: "",
        discount_price: "",
        product_code: "",
        product_qty: "",
        brand_id: "",
        category_id: "",
        subcategory_id: "",
        vendor_id: "",
        long_descp: "",
        special_offer: null,
        special_deals: null,
        hot_deals: null,
        featured: null,
      }),
    };
  },

  methods: {
    mainThumbnail(event) {
      this.form.product_thambnail = event.target.files[0];
      // console.log(
      //   "File selected for main thumbnail:",
      //   this.form.product_thambnail
      // );
      if (this.form.product_thambnail) {
        const reader = new FileReader();
        reader.onload = () => {
          this.form.mainThumbnailSrc = reader.result;
        };
        reader.readAsDataURL(this.form.product_thambnail);
      }
    },
    async multipleImages(event) {
      if (!this.$route.params.id) {
        this.form.previewImages = [];
      } // Clear previous preview images
      this.form.multi_img = event.target.files || []; // Initialize as an array

      // console.log("Files selected for preview:", this.form.multi_img);

      for (let i = 0; i < this.form.multi_img.length; i++) {
        const file = this.form.multi_img[i];
        // console.log("File selected for preview:", file);
        if (file) {
          const reader = new FileReader();
          reader.onload = async () => {
            const imageData = reader.result;
            // console.log("Image data:", imageData);
            this.form.previewImages.push(imageData);
          };
          reader.readAsDataURL(file);
        }
      }
    },
    selectedImage(event, id) {
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();

        reader.onload = () => {
          const imageData = reader.result;

          // Push the new image data along with the id to the previewImages array
          this.form.previewImages.push({ id, imageData });
          console.log("Preview Images:", this.form.previewImages);
        };
      }
    },

    getSubcategory() {
      const selectedCategoryId = this.form.category_id;
      const selectedCategory = this.categories.find(
        (category) => category.id === selectedCategoryId
      );

      if (selectedCategory) {
        this.subcategories = selectedCategory.subcategories;
      } else {
        this.subcategories = [];
      }
    },
    async storeOrUpdateProduct() {
      // Convert boolean values to integers (0 or 1)
      const booleanFields = [
        "hot_deals",
        "featured",
        "special_offer",
        "special_deals",
      ];
      for (const field of booleanFields) {
        this.form[field] = this.form[field] ? 1 : null;
      }
      const formData = new FormData(document.getElementById("myForm"));
      this.isLoading = true;
      let url = this.isUpdate
        ? "http://127.0.0.1:8000/api/update/product/" + this.$route.params.id
        : "http://127.0.0.1:8000/api/store/product";
      if (!this.isUpdate) {
        try {
          const response = await this.form.post(url, formData);
          setTimeout(() => {
            this.isLoading = false;
          }, 1000);
          this.$router.replace({ name: "product.index" });
        } catch (error) {
          console.error("Error storing product:", error);
          // Handle error and display a toast
          toast.error("Error storing product.");
        }
      } else {
        try {
          const response = await this.form.post(url, formData);
          console.log(response);
          toast.success(response.data.msg);
          setTimeout(() => {
            this.isLoading = false;
            this.$router.replace({ name: "product.index" });
          }, 1000);
        } catch (error) {
          console.error("Error updating product:", error);
          // Handle error and display a toast
          toast.error("Error updating product.");
        }
      }
    },
    async updateImage() {
      let url = await this.form.post(
        "http://127.0.0.1:8000/api/update/product/thambnail/" +
          this.$route.params.id
      );
      toast.success(url.data.msg);
      setTimeout(() => {
        this.isLoading = false;
        this.$router.replace({ name: "product.index" });
      }, 1000);
    },
    updateMultiImage() {
      let url = this.form.post(
        "http://127.0.0.1:8000/api/update/product/multiimage/" +
          this.$route.params.id
      );
    },
  },
  watch: {
    // Watch for changes in the selected category ID
    // and update the subcategories array accordingly (if needed)
    // watches for changes in the form.category_id
    "form.category_id": function () {
      this.getSubcategory();
    },
  },
  created() {
    let id = this.$route.params.id;
    if (id) {
      this.isLoading = true;
      this.isUpdate = true;
      this.$axios
        .get(`http://127.0.0.1:8000/api/edit/product/${id}`)
        .then(({ data }) => {
          this.form.fill(data.products);
          this.form.hot_deals = data.products.hot_deals == 1 ? true : false;
          this.form.featured = data.products.featured == 1 ? true : false;
          this.form.special_offer =
            data.products.special_offer == 1 ? true : false;
          this.form.special_deals =
            data.products.special_deals == 1 ? true : false;

          this.form.mainThumbnailSrc = `http://127.0.0.1:8000/${data.products.product_thambnail}`;

          // this.form.previewImages = data.multiImgs.map((img) => {
          //   return `http://127.0.0.1:8000/${img.photo_name}`;
          // });
          this.form.previewImages = data.multiImgs;

          console.log(this.form.previewImages);
          setTimeout(() => {
            this.isLoading = false;
          }, 1000);
        });
    }
    this.form.get("http://127.0.0.1:8000/api/add/product").then((response) => {
      this.brands = response.data.brands;
      this.categories = response.data.categories;
      this.vendors = response.data.activeVendor;
    });
  },
  updated() {
    this.isUpdate != this.isUpdate;
  },
};
</script>
<style scoped>
.pic {
  width: 150px;
  height: 150px;
}
</style>
