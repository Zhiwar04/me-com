<template>
  <div class="page-content">
    <page-titles>
      <template #title> Add Brand </template>
      <template #desc> Add Brand </template>
    </page-titles>

    <form-card>
      <template #default>
        <form
          id="myForm"
          @submit.prevent="storeOrUpdateBrand"
          enctype="multipart/form-data"
        >
          <custom-input
            name="brand_name"
            type="text"
            id="brand_name"
            title="Brand Name"
            v-model="form.brand_name"
          ></custom-input>
          <custom-image
            :imageSrc="form.imageSrc"
            label="brand Image"
            altText="brand"
            @update:imageSrc="updateImageSrc"
            @update:imageFile="updateImageFile"
          ></custom-image>
          <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9 text-secondary">
              <button type="submit" class="btn-primary px-4">
                <span v-if="!isUpdate"> Add Brand </span>
                <span v-else> Update Brand </span>
              </button>
            </div>
          </div>
          <pre-loader v-if="isLoading"></pre-loader>
          <!-- Display error messages -->
          <div v-if="form.errors.any()" class="alert alert-danger mt-3">
            <ul>
              <li v-for="(error, key) in form.errors.all()" :key="key">
                {{ error }}
              </li>
            </ul>
          </div>
        </form>
      </template>
    </form-card>
  </div>
</template>

<script>
import Form from "vform";
import { toast } from "vue3-toastify";
import PageTitles from "@/components/UI/PageTitles.vue";
import FormCard from "@/components/UI/FormCard.vue";
import CustomInput from "@/components/UI/CustomInput.vue";
import CustomImage from "@/components/UI/CustomImage.vue";
import PreLoader from "@/components/UI/PreLoader.vue";
import router from "../../../../router";

export default {
  components: {
    PageTitles,
    FormCard,
    CustomInput,
    CustomImage,
    PreLoader,
  },
  data() {
    return {
      form: new Form({
        brand_name: "", // Initialize brand_name property
        brand_image: "", // Initialize brand_image property
        imageSrc: "assets/images/no_image.jpg", // Initialize imageSrc property
      }),
      isUpdate: false,
      isLoading: false,
    };
  },
  methods: {
    updateImageSrc(newImageSrc) {
      this.form.imageSrc = newImageSrc;
    },

    updateImageFile(newImageFile) {
      this.form.brand_image = newImageFile;
    },
    async storeOrUpdateBrand() {
      let url = this.isUpdate
        ? "http://127.0.0.1:8000/api/brands/" +
          this.$route.params.id +
          "?_method=PUT"
        : "http://127.0.0.1:8000/api/brands";
      if (!this.isUpdate) {
        try {
          const response = await this.form.post(url);
          toast.success("Brand stored successfully.");
          this.isLoading = true;

          setTimeout(() => {
            this.isLoading = false;
            this.$router.replace({ name: "brand.index" });
          }, 1000);
        } catch (error) {
          console.error("Error storing brand:", error);
          // Handle error and display a toast
          toast.error("Error storing brand.");
        }
      } else {
        try {
          const response = await this.form.post(url);

          this.$router.replace({ name: "brand.index" });
        } catch (error) {
          console.error("Error updating brand:", error);
          // Handle error and display a toast
          toast.error("Error updating brand.");
        }
      }
    },
  },
  created() {
    let id = this.$route.params.id;
    if (id) {
      this.isLoading = true;
      this.isUpdate = true;
      setTimeout(() => {
        this.$axios
          .get(`http://127.0.0.1:8000/api/brands/${id}/edit`)
          .then(({ data }) => {
            this.form.fill(data.Brand);
            this.form.imageSrc = `http://127.0.0.1:8000/${data.Brand.brand_image}`;
            this.isLoading = false;
          });
      }, 1000);
    }
  },
};
</script>
