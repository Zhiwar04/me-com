<template>
  <h1>index page</h1>
  <h1><router-link to="/login">login</router-link></h1>
  <div class="flex mx-auto mt-40">
    <h1 class="3xl mx-auto">{{ title }}</h1>
  </div>
</template>
<script>
// import { toast } from "vue3-toastify";
export default {
  data() {
    return {
      title: "welcome to our website",
    };
  },
};
</script>
