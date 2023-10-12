import { createRouter, createWebHistory } from "vue-router";
import TheIndex from "@/views/user/TheIndex.vue";
import { toast } from "vue3-toastify";
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: TheIndex,
      beforeEnter(to, from, next) {
        const id = toast.loading("Please wait...");
        setTimeout(() => {
          next();
          toast.update(id, {
            autoClose: true,
            closeOnClick: true,
            closeButton: true,
            type: "success",
            isLoading: false,
            icon: "🥳",
            render: "Welcome to our website",
          });
        }, 2000);
      },
    },
    {
      path: "/login",
      name: "login",
      component: () => import("@/views/AdminLogin.vue"),
    },
    {
      path: "/register",
      name: "register",
      component: () => import("@/views/UserRegister.vue"),
    },
    {
      path: "/admin",
      name: "admin",
      component: () => import("@/views/admin/TheHome.vue"),
      children: [
        {
          //admin dashboard
          path: "",
          name: "admin.dashboard",
          component: () => import("@/views/admin/AdminDashboard.vue"),
        },
        {
          path: "password",
          name: "admin.password",
          component: () => import("@/components/admin/AdminPassword.vue"),
        },
        {
          path: "profile",
          name: "admin.profile",
          component: () => import("@/components/admin/AdminProfile.vue"),
        },
        //admin banner
        {
          path: "/add/banner",
          name: "banner.add",
          component: () =>
            import("@/views/backend/ManageSystem/Banner/AddBanner.vue"),
        },
        //admin brand
        {
          path: "/add-brand",
          name: "brand.add",
          component: () =>
            import("@/views/backend/ManageSystem/Brand/AddBrand.vue"),
        },
        {
          path: "/index-brand",
          name: "brand.index",
          component: () =>
            import("@/views/backend/ManageSystem/Brand/IndexBrand.vue"),
        },
        {
          path: "/edit-brand/:id/edit",
          name: "brand.edit",
          component: () =>
            import("@/views/backend/ManageSystem/Brand/AddBrand.vue"),
        },
        //admin category
        {
          path: "/add-category",
          name: "category.add",
          component: () =>
            import("@/views/backend/ManageSystem/Category/AddCategory.vue"),
        },
        {
          path: "/index-category",
          name: "category.index",
          component: () =>
            import("@/views/backend/ManageSystem/Category/IndexCategory.vue"),
        },
        {
          path: "/edit-category/:id/edit",
          name: "category.edit",
          component: () =>
            import("@/views/backend/ManageSystem/Category/AddCategory.vue"),
        },
        //admin subcategory
        {
          path: "/add-subcategory",
          name: "subcategory.add",
          component: () =>
            import(
              "@/views/backend/ManageSystem/Subcategory/AddSubcategory.vue"
            ),
        },
        {
          path: "/index-subcategory",
          name: "subcategory.index",
          component: () =>
            import(
              "@/views/backend/ManageSystem/Subcategory/IndexSubcategory.vue"
            ),
        },
        {
          path: "/edit-subcategory/:id/edit",
          name: "subcategory.edit",
          component: () =>
            import(
              "@/views/backend/ManageSystem/Subcategory/AddSubcategory.vue"
            ),
        },
        //admin product
        {
          path: "/index-product",
          name: "product.index",
          component: () =>
            import("@/views/backend/ManageSystem/Product/IndexProduct.vue"),
        },
        {
          path: "/add-product",
          name: "product.add",
          component: () =>
            import("@/views/backend/ManageSystem/Product/AddProduct.vue"),
        },
        {
          path: "/edit-product/:id/edit",
          name: "product.edit",
          component: () =>
            import("@/views/backend/ManageSystem/Product/AddProduct.vue"),
        },
      ],
      beforeEnter(to, from, next) {
        //pesh away beta am route check bka bzane token haya yan na
        if (localStorage.getItem("token")) {
          next();
        } else {
          next("/login");
        }
      },
    },
  ],
});

export default router;
