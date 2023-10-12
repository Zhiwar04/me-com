<template>
  <the-header></the-header>
  <the-switcher></the-switcher>
  <the-sidebar></the-sidebar>
  <the-footer></the-footer>
  <div class="page-wrapper">
    <router-view></router-view>
  </div>
</template>
<script>
import TheHeader from "@/components/Nav/TheHeader.vue";
import TheSidebar from "@/components/Nav/TheSidebar.vue";
import TheFooter from "@/components/Nav/TheFooter.vue";
import TheSwitcher from "@/components/Nav/TheSwitcher.vue";
import AdminDashboard from "@/views/admin/AdminDashboard.vue";

export default {
  components: {
    TheHeader,
    TheSidebar,
    TheFooter,
    TheSwitcher,
    AdminDashboard,
  },
  created() {
    this.$axios
      .get("/getuser")
      .then((response) => {
        this.$store.dispatch("auth/setUser", response.data.user);
      })
      .catch(() => {
        localStorage.removeItem("token");
        this.$router.replace({ name: "login" });
      });
  },
};
</script>
