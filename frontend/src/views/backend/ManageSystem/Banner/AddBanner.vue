<template>
  <div class="page-content">
    <!--breadcrumb-->
    <page-titles>
      <template #title> Add Banner </template>
      <template #desc> Add Banner </template>
    </page-titles>
    <!--end breadcrumb-->
    <form-card>
      <template #default>
        <form
          id="myForm"
          method="post"
          action="{{ route('store.banner') }}"
          enctype="multipart/form-data"
        >
          <div class="form-group">
            <custom-input
              type="text"
              name="banner_name"
              title="banner name"
              placeholder="Enter Banner Name"
              id="banner_name"
            ></custom-input>

            <custom-input
              type="text"
              name="banner_url"
              title="banner url"
              placeholder="Enter Banner url"
              id="banner_url"
            ></custom-input>

            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Banner Image</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input
                  type="file"
                  name="banner_image"
                  @change="handleImageChange"
                  ref="imageInput"
                  id="image"
                  accept="image/*"
                  class="form-control"
                />
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0"></h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <img
                  id="showImage"
                  :src="imageSrc"
                  alt="Admin"
                  style="width: 100px; height: 100px"
                />
              </div>
            </div>

            <div class="row">
              <div class="col-sm-3"></div>
              <div class="col-sm-9 text-secondary">
                <input
                  type="submit"
                  class="btn btn-primary px-4"
                  value="Save Changes"
                />
              </div>
            </div>
          </div>
        </form>
      </template>
    </form-card>
  </div>
</template>
<script>
import PageTitles from "@/components/UI/PageTitles.vue";
import FormCard from "@/components/UI/FormCard.vue";
import CustomInput from "@/components/UI/CustomInput.vue";
export default {
  components: {
    PageTitles,
    FormCard,
    CustomInput,
  },
  data() {
    return {
      imageSrc: null,
    };
  },
  methods: {
    handleImageChange(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = () => {
          this.imageSrc = reader.result;
        };
        reader.readAsDataURL(file);
      } else {
        this.imageSrc = null;
      }
    },
  },
};
</script>

<!-- 

    


    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    banner_title: {
                        required: true,
                    },
                    banner_url: {
                        required: true,
                    },
                },
                messages: {
                    banner_title: {
                        required: 'Please Enter Banner Title',
                    },
                    banner_url: {
                        required: 'Please Enter Banner Url',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
 -->
<!-- 
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script> -->
