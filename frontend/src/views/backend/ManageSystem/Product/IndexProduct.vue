<template>
  <div class="page-content">
    <pre-loader v-if="isLoading"></pre-loader>
    <!--breadcrumb-->
    <page-titles>
      <template #title> All Products </template>
      <template #desc>
        All Products

        <span class="badge rounded-pill bg-danger mb-2">{{
          products.length
        }}</span>
      </template>
    </page-titles>
    <hr />
    <div class="card">
      <view-table>
        <template #th>
          <tr>
            <th>Sl</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product QTY</th>
            <th>Product Discount</th>
            <th>Product Status</th>
            <th>Action</th>
          </tr>
        </template>
        <template #td>
          <tr v-for="(item, index) in products" :key="index">
            <td>{{ index + 1 }}</td>
            <td>
              <img
                :src="'http://127.0.0.1:8000/' + item.product_thambnail"
                alt="product Image"
                class="rounded-circle"
                style="width: 70px; height: 40px"
              />
            </td>
            <td>{{ item.product_name }}</td>
            <td>{{ item.selling_price }}</td>
            <td>{{ item.product_qty }}</td>
            <td>
              <span
                class="badge rounded-pill bg-info"
                v-if="item.discount_price == null"
                >No Discount</span
              >
              <span class="badge rounded-pill bg-danger" v-else
                >{{ calculateDiscount(item) }}%</span
              >
            </td>
            <td>
              <span
                class="badge rounded-pill bg-success"
                v-if="item.status == 1"
                >Active</span
              >
              <span class="badge rounded-pill bg-danger" v-else>Inactive</span>
            </td>
            <td>
              <router-link
                :to="{ name: 'product.edit', params: { id: item.id } }"
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
                @submit.prevent="deleteProduct(item.id)"
              >
                <button class="mx-3">
                  <font-awesome-icon
                    icon="fa-solid  fa-trash"
                    class="bg-red-600 px-2 py-1 rounded-full text-slate-200 hover:bg-red-800"
                    size="2x"
                  />
                </button>

                <router-link
                  to="/"
                  v-if="item.status == 1"
                  href="{{ route('product.inactive', $item->id) }}"
                  title="Inactive"
                  ><font-awesome-icon
                    icon="fa-solid fa-thumbs-up"
                    size="2x"
                    class="bg-green-600 px-2 py-1 rounded-full text-slate-200 hover:bg-green-800"
                /></router-link>

                <router-link
                  to="/"
                  v-else
                  href="{{ route('product.active', $item->id) }}"
                  title="Active"
                  ><font-awesome-icon
                    icon="fa-solid fa-thumbs-down"
                    class="bg-indigo-500 px-2 py-1 rounded-full text-slate-200 hover:bg-indigo-800"
                    size="2x"
                /></router-link>
              </form>
            </td>
          </tr>
        </template>
        <template #tf>
          <tr>
            <th>Sl</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product QTY</th>
            <th>Product Discount</th>
            <th>Product Status</th>
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
      products: [],
      isLoading: false,
    };
  },

  computed: {
    // Calculate discount for a product
    calculateDiscount() {
      return (product) => {
        if (product.selling_price && product.discount_price) {
          let amount = Number(product.selling_price - product.discount_price);
          let discount = Number((amount / product.selling_price) * 100);
          return Math.round(discount);
        } else {
          return 0;
        }
      };
    },
  },

  methods: {
    deleteProduct(id) {
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
              .get("http://127.0.0.1:8000/api/delete/product/" + id)
              .then((response) => {
                this.isLoading = false;
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
    this.$axios
      .get("http://127.0.0.1:8000/api/all/product")
      .then((response) => {
        this.products = response.data;
        setTimeout(() => {
          this.isLoading = false;
        }, 2000);
      });
  },
};
</script>
