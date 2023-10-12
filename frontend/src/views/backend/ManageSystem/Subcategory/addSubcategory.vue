<template>
  <div class="page-content">
    <pre-loader v-if="isLoading"></pre-loader>
    <page-titles>
      <template #title> Add Subcategoty </template>
      <template #desc> Add Subcategory </template>
    </page-titles>

    <form-card>
      <template #default>
        <form id="myForm" @submit.prevent="storeOrUpdateSubcategory">
          <div class="row mb-3">
            <div class="col-sm-3">
              <h6 class="mb-0">Category Name</h6>
            </div>
            <div class="form-group col-sm-9 text-secondary">
              <select
                name="category_id"
                v-model.trim="form.category_id"
                class="form-control"
              >
                <option value="" selected disabled>Select Category</option>
                <option
                  v-for="(category, index) in subcategories"
                  :key="index"
                  :value="category.id"
                >
                  {{ category.category_name }}
                </option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-3">
              <h6 class="mb-0">Subcategory Name</h6>
            </div>
            <div class="form-group col-sm-9 text-secondary">
              <input
                type="text"
                name="subcategory_name"
                v-model.trim="form.subcategory_name"
                class="form-control"
              />
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9 text-secondary">
              <button type="submit" class="btn btn-primary px-4">
                <span v-if="!isUpdate"> Add Subcategory </span>
                <span v-else> Update Subcategory </span>
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
import PreLoader from "@/components/UI/PreLoader.vue";
import router from "../../../../router";
export default {
  components: {
    PageTitles,
    FormCard,
    PreLoader,
  },
  data() {
    return {
      isLoading: false,
      subcategories: [],
      form: new Form({
        category_id: null, // Initialize category_id property with null
        subcategory_name: "",
      }),
      isUpdate: false, // Initialize isUpdate property
    };
  },
  methods: {
    async storeOrUpdateSubcategory() {
      this.isLoading = true;
      const url = this.isUpdate
        ? `http://127.0.0.1:8000/api/subcategories/${this.$route.params.id}?_method=PUT`
        : "http://127.0.0.1:8000/api/subcategories";

      try {
        this.isLoading = true;
        console.log(this.isLoading);
        const response = await this.form.post(url);
        setTimeout(() => {
          this.isLoading = false;
          this.$router.push({ name: "subcategory.index" });
        }, 1000);
      } catch (error) {
        console.error(
          `Error ${this.isUpdate ? "updating" : "storing"} subcategory:`,
          error
        );
        toast.error(
          `Error ${this.isUpdate ? "updating" : "storing"} subcategory.`
        );
      }
    },
    // ... Other methods ...
  },
  created() {
    const id = this.$route.params.id;
    if (id) {
      this.isUpdate = true;
      this.isLoading = true;
      this.$axios
        .get(`http://127.0.0.1:8000/api/subcategories/${id}/edit`)
        .then(({ data }) => {
          this.form.fill(data);
          this.isLoading = false;
        });
    }
    this.$axios
      .get("http://127.0.0.1:8000/api/subcategories/create")
      .then(({ data }) => {
        this.subcategories = data;
      });
  },
};
</script>
