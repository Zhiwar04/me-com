import { createStore } from "vuex";
import authStore from "./modules/auth";
import brandStore from "./modules/brand";
const Store = createStore({
  modules: {
    auth: authStore,
    brand: brandStore,
  },
});
export default Store;
