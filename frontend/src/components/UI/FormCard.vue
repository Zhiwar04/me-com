<template>
  <div class="container">
    <div class="main-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <slot name="default"></slot>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "FormCard",
};
</script>
