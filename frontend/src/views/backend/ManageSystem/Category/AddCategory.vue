<template>
  <div class="page-content">
    <pre-loader v-if="isLoading"></pre-loader>
    <page-titles>
      <template #title> Add Category </template>
      <template #desc> Add Category </template>
    </page-titles>

    <form-card>
      <template #default>
        <form
          id="myForm"
          @submit.prevent="storeOrUpdateCategory"
          enctype="multipart/form-data"
        >
          <custom-input
            title="add category"
            name="category_name"
            id="category_name"
            type="text"
            placeholder="enter a category name"
            v-model="form.category_name"
          ></custom-input>

          <custom-image
            :imageSrc="form.imageSrc"
            label="category Image"
            altText="category Image"
            @update:imageSrc="updateImageSrc"
            @update:imageFile="updateImageFile"
          ></custom-image>

          <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9 text-secondary">
              <button type="submit" class="btn btn-primary px-4">
                <span v-if="!isUpdate"> Add Category </span>
                <span v-else> Update Category </span>
              </button>
            </div>
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
        category_name: "", // Initialize brand_name property
        category_image: "", // Initialize brand_image property
        imageSrc: "assets/images/no_image.jpg", // Initialize imageSrc property
      }),
      isUpdate: false,
      isLoading: false,
    };
  },
  methods: {
    updateImageSrc(newImageSrc) {
      this.form.imageSrc = newImageSrc;
      console.log(this.form.imageSrc);
    },

    updateImageFile(newImageFile) {
      this.form.category_image = newImageFile;
      console.log(this.form.category_image);
    },
    async storeOrUpdateCategory() {
      this.isLoading = true;
      console.log(this.form.category_image);
      let url = this.isUpdate
        ? "http://127.0.0.1:8000/api/categories/" +
          this.$route.params.id +
          "?_method=PUT"
        : "http://127.0.0.1:8000/api/categories/";
      if (!this.isUpdate) {
        try {
          const response = await this.form.post(url);
          setTimeout(() => {
            this.isLoading = false;
          }, 1000);
          this.$router.replace({ name: "category.index" });
        } catch (error) {
          console.error("Error storing category:", error);
          // Handle error and display a toast
          toast.error("Error storing category.");
        }
      } else {
        try {
          const response = await this.form.post(url);
          console.log(response);
          this.$router.replace({ name: "category.index" });
        } catch (error) {
          console.error("Error updating category:", error);
          // Handle error and display a toast
          toast.error("Error updating category.");
        }
      }
    },
  },
  created() {
    let id = this.$route.params.id;
    if (id) {
      this.isUpdate = true;
      this.isLoading = true;

      this.$axios
        .get(`http://127.0.0.1:8000/api/categories/${id}/edit`)
        .then(({ data }) => {
          this.form.fill(data);

          this.form.imageSrc = `http://127.0.0.1:8000/${data.category_image}`;
        });
      setTimeout(() => {
        this.isLoading = false;
      }, 1000);
    }
  },
};
</script>
