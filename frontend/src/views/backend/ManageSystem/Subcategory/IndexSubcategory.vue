<template>
  <div class="page-content">
    <pre-loader v-if="isLoading"></pre-loader>
    <!--breadcrumb-->
    <page-titles>
      <template #title> All SubCategory </template>
      <template #desc> All SubCategory </template>
    </page-titles>
    <hr />
    <div class="card">
      <view-table>
        <template #th>
          <tr>
            <th>Sl</th>
            <th>Category Name</th>
            <th>Subcategory Name</th>
            <th>Action</th>
          </tr>
        </template>
        <template #td>
          <tr v-for="(item, index) in subcategories" :key="index">
            <td>{{ index + 1 }}</td>
            <td>{{ item.category.category_name }}</td>
            <td>
              {{ item.subcategory_name }}
            </td>

            <td>
              <router-link
                :to="{ name: 'subcategory.edit', params: { id: item.id } }"
                class=""
              >
                <font-awesome-icon
                  icon="fa-solid fa-pen-to-square"
                  class="bg-blue-600 px-2 py-1 rounded-full text-slate-200 hover:bg-blue-800"
                  size="2x"
                />
              </router-link>
              <form
                style="display: inline-block"
                @submit.prevent="deleteSubCategory(item.id)"
              >
                <button class="mx-3">
                  <font-awesome-icon
                    icon="fa-solid fa-trash"
                    size="2x"
                    class="bg-red-600 px-2 py-1 rounded-full text-slate-200 hover:bg-red-800"
                  />
                </button>
              </form>
            </td>
          </tr>
        </template>
        <template #tf>
          <tr>
            <th>Sl</th>
            <th>Category Name</th>
            <th>Subcategory Name</th>
            <th>Action</th>
          </tr>
        </template>
      </view-table>
    </div>
  </div>
</template>
<script>
import Form from "vform";
import { toast } from "vue3-toastify";
import PageTitles from "@/components/UI/PageTitles.vue";
import FormCard from "@/components/UI/FormCard.vue";
import PreLoader from "@/components/UI/PreLoader.vue";

import ViewTable from "@/components/UI/ViewTable.vue";
export default {
  components: {
    PageTitles,
    FormCard,
    ViewTable,
    PreLoader,
  },
  data() {
    return {
      subcategories: [],
      isLoading: false,
    };
  },
  methods: {
    deleteSubCategory(id) {
      this.$swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            this.isLoading = true;
            this.$axios
              .delete("http://127.0.0.1:8000/api/subcategories/" + id)
              .then((response) => {
                setTimeout(() => {
                  this.isLoading = false;
                  this.$router.go();
                }, 1000);
              });
            this.$swal.fire(
              "Deleted!",
              "Your file has been deleted.",
              "success"
            );
          }
        });
    },
  },
  created() {
    this.isLoading = true;
    this.$axios
      .get("http://127.0.0.1:8000/api/subcategories")
      .then((response) => {
        this.subcategories = response.data;
        setTimeout(() => {
          this.isLoading = false;
        }, 1000);
      });
  },
};
</script>
