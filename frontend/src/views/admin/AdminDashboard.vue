<template>
  <div class="page-content mt-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
      <div class="col">
        <report-manage class="bg-gradient-deepblue"></report-manage>
      </div>
      <div class="col">
        <report-manage class="bg-gradient-ohhappiness"></report-manage>
      </div>

      <div class="col">
        <report-manage class="bg-gradient-ibiza"></report-manage>
      </div>
      <div class="col">
        <report-manage class="bg-gradient-orange"></report-manage>
      </div>
    </div>
    <!--end row-->

    <div class="card radius-10">
      <div class="card-body">
        <order-summary></order-summary>
      </div>
    </div>
  </div>
</template>
<script>
import ReportManage from "@/components/UI/ReportManage.vue";
import OrderSummary from "@/components/UI/OrderSummary.vue";
export default {
  components: {
    ReportManage,
    OrderSummary,
  },
  data() {
    return {};
  },
};
</script>
