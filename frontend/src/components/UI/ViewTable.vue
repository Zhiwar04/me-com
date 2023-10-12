<script>
import DataTable from "datatables.net-dt";
export default {
  updated() {
    // Initialize DataTables on the table
    let table = new DataTable("#example");
  },
};
</script>
<template>
  <div class="card-body">
    <div class="table-responsive">
      <table
        id="example"
        class="table table-striped table-bordered display"
        style="width: 100%"
      >
        <thead>
          <slot name="th"></slot>
        </thead>
        <tbody>
          <slot name="td"></slot>
        </tbody>
        <tfoot>
          <slot name="tf"></slot>
        </tfoot>
      </table>
    </div>
  </div>
</template>
