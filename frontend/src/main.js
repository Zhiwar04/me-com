import $ from "jquery";
/* import the fontawesome core */
import { library } from "@fortawesome/fontawesome-svg-core";

/* import font awesome icon component */
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

/* import specific icons */
import {
  faUserSecret,
  faPenToSquare,
  faTrash,
  faThumbsUp,
  faThumbsDown,
} from "@fortawesome/free-solid-svg-icons";
library.add(faUserSecret, faPenToSquare, faTrash, faThumbsUp, faThumbsDown);
import "./assets/main.css";
import "./assets/plugins/metismenu/js/metisMenu.min";
import "./assets/plugins/metismenu/css/metisMenu.min.css";
import "./assets/css/app.css";
import "./assets/css/dark-theme.css";
import "./assets/css/header-colors.css";
import "./assets/css/icons.css";
import "./assets/css/pace.min.css";
import "./assets/css/semi-dark.css";

import { createApp } from "vue";
import * as bootstrap from "bootstrap";
import { Tooltip, Toast, Popover } from "bootstrap";
import DataTable from "datatables.net-dt";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
let table = new DataTable("#myTable");
import "./assets/js/app.js";
import Form from "vform";
import App from "./App.vue";
import Store from "./stores/index.js";
import Vue3Toasity from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import router from "./router";
import axios from "./axios";
const app = createApp(App);
app.use(Vue3Toasity, {
  position: "top-right",
  duration: 2000,
  closeOnClick: true,
});
app.component("font-awesome-icon", FontAwesomeIcon);
app.use(router);
app.use(Store);
app.use(VueSweetalert2);
app.config.globalProperties.$axios = { ...axios };
app.mount("#app");
