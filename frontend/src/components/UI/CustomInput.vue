<template>
  <div class="flex mb-3">
    <div class="col-sm-3 text-center">
      <h6 class="mt-2">{{ title }}</h6>
    </div>

    <input
      :type="type"
      :id="id"
      :placeholder="placeholder"
      class="form-control py-2"
      :value="modelValue"
      :name="name"
      @input="$emit('update:modelValue', $event.target.value.trim())"
    />
  </div>
</template>
<script>
export default {
  props: {
    title: {
      type: String,
      required: true,
    },
    name: {
      type: String,
      required: true,
    },
    id: {
      type: String,
      required: false,
    },
    placeholder: {
      type: String,
      required: false,
    },
    type: {
      type: String,
      required: true,
    },
    value: {
      type: String,
      required: false,
    },
    modelValue: {
      type: String,
      required: false,
    },
  },
};
</script>
