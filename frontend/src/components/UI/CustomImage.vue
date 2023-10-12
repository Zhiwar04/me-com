<template>
  <div class="row mb-3">
    <div class="col-sm-3 text-center">
      <h6 class="mt-3">{{ label }}</h6>
    </div>
    <div class="form-group col-sm-9 text-secondary">
      <input
        type="file"
        @change="handleImageChange"
        class="form-control py-1"
      />
      <img
        id="showImage"
        :src="imageSrc"
        :alt="altText"
        class="rounded-circle p-1 bg-primary"
        :width="imageWidth"
      />
    </div>
  </div>
</template>

<script>
export default {
  props: {
    // Prop to receive the image source URL
    imageSrc: {
      type: String,
      default: "assets/images/no_image.jpg", // Default image source
    },
    // Prop to receive the label for the image input
    label: {
      type: String,
    },
    // Prop to receive the alt text for the image
    altText: {
      type: String,
    },
    // Prop to receive the desired image width
    imageWidth: {
      type: String,
      default: "110", // Default image width
    },
  },
  methods: {
    // Method to handle changes in the image input
    handleImageChange(event) {
      const file = event.target.files[0]; // Get the selected file
      if (file) {
        const reader = new FileReader(); // Create a file reader to read the file
        reader.onload = () => {
          // Emit the image source to the parent component
          this.$emit("update:imageSrc", reader.result);
        };
        reader.readAsDataURL(file); // Read the file as a data URL
        // Emit the image file to the parent component
        this.$emit("update:imageFile", file);
      } else {
        // If no file selected, emit null values for image source and file
        this.$emit("update:imageSrc", null);
        this.$emit("update:imageFile", null);
      }
    },
  },
};
</script>
