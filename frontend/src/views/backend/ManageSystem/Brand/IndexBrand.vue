<template>
  <div class="page-content">
    <pre-loader v-if="isLoading"></pre-loader>
    <!--breadcrumb-->
    <page-titles>
      <template #title> All Brand </template>
      <template #desc> All Brand </template>
    </page-titles>
    <hr />
    <div class="card">
      <view-table>
        <template #th>
          <tr>
            <th>Sl</th>
            <th>Brand Name</th>
            <th>Brand Image</th>
            <th>Action</th>
          </tr>
        </template>
        <template #td>
          <tr v-for="(item, index) in brands" :key="index">
            <td>{{ index + 1 }}</td>
            <td>{{ item.brand_name }}</td>
            <td>
              <img
                :src="'http://127.0.0.1:8000/' + item.brand_image"
                alt="Brand Image"
                style="width: 70px; height: 40px"
              />
            </td>

            <td>
              <router-link
                :to="{ name: 'brand.edit', params: { id: item.id } }"
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
                @submit.prevent="deleteBrand(item.id)"
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
            <th>Brand Name</th>
            <th>Brand Image</th>
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
      isLoading: false,
      brands: [],
    };
  },
  methods: {
    deleteBrand(id) {
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
            this.$axios
              .delete("http://127.0.0.1:8000/api/brands/" + id)
              .then((response) => {
                this.$router.go();
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
    this.$axios.get("http://127.0.0.1:8000/api/brands").then((response) => {
      this.brands = response.data;
      setTimeout(() => {
        this.isLoading = false;
      }, 1000);
    });
  },
};
</script>
