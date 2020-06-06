<template>
  <div class>
    <form @submit.prevent="submitForm">
      <InputField
        name="caption"
        label="Post Caption"
        :errors="errors"
        placeholder="Post Caption"
        @update:field="form.caption = $event"
      />
      <InputField
        name="image"
        label="Post Image"
        :errors="errors"
        placeholder="Image Url"
        @update:field="form.image = $event"
      />
      <div class="flex justify-end">
        <button class="py-2 px-4 text-red-700 border rounded mr-4 hover:bg-gray-100">Cancel</button>
        <button class="bg-teal-400 py-2 px-4 text-white rounded hover:bg-teal-500">Add New Post</button>
      </div>
    </form>
  </div>
</template>

<script>
import InputField from "../components/InputField";

export default {
  name: "PostsCreate",

  components: {
    InputField
  },

  data: function() {
    return {
      form: {
        caption: "",
        image: ""
      },

      errors: null,
    };
  },

  methods: {
    submitForm: function() {
      axios
        .post("/api/posts", this.form)
        .then(response => {})
        .catch(errors => {
          this.errors = errors.response.data.errors;
        });
    }
  }
};
</script>
