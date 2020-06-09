<template>
  <div>
    <div class="flex justify-between mb-4">
      <a
        style="text-decoration : none"
        href="#"
        class="px-4 py-2 text-teal-400 border border-teal-500 rounded font-bold hover:bg-teal-200 hover:text-gray-700"
        @click="$router.back()"
      >Back</a>
    </div>
    <form @submit.prevent="submitForm">
      <InputField
        name="title"
        label="Post Title"
        :errors="errors"
        placeholder="Post Title"
        @update:field="form.title = $event"
        :data="form.title"
      />
      <InputField
        name="caption"
        label="Post Caption"
        :errors="errors"
        placeholder="Post Caption"
        @update:field="form.caption = $event"
        :data="form.caption"
      />
      <InputField
        name="image"
        label="Post Image"
        :errors="errors"
        placeholder="Image Url"
        @update:field="form.image = $event"
        :data="form.image"
      />
      <div class="flex justify-end">
        <button class="py-2 px-4 text-red-700 border rounded mr-4 hover:bg-gray-100">Cancel</button>
        <button class="bg-teal-400 py-2 px-4 text-white rounded hover:bg-teal-500">Save changes</button>
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

  mounted() {
    axios
      .get("/api/posts/" + this.$route.params.id)
      .then(response => {
        this.form = response.data.data;

        this.loading = false;
      })
      .catch(error => {
        this.loading = false;

        if (error.response.status === 404) {
          this.$router.push("/posts");
        }
      });
  },

  data: function() {
    return {
      form: {
        title:"",
        caption: "",
        image: ""
      },

      errors: null
    };
  },

  methods: {
    submitForm: function() {
      axios
        .patch("/api/posts/" + this.$route.params.id, this.form)
        .then(response => {
          this.$router.push(response.data.links.self);
        })
        .catch(errors => {
          this.errors = errors.response.data.errors;
        });
    }
  }
};
</script>
