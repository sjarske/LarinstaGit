<template>
  <div>
    <div v-if="loading">Loading...</div>
    <div v-else>
      <div class="flex justify-between">
        <button
          style="text-decoration : none"
          class="px-4 py-2 rounded text-sm text-teal-400 border font-bold mr-2 hover:bg-teal-200 hover:text-gray-700"
          @click="$router.back()"
        >Back</button>
        <div class="relative">
          <router-link
            :to="'/posts/' + post.post_id + '/edit'"
            class="px-4 py-2 rounded text-sm text-teal-400 border font-bold mr-2 hover:bg-teal-200 hover:text-gray-700"
            style="text-decoration : none"
          >Edit</router-link>
          <button
            style="text-decoration : none"
            class="px-4 py-2 border border-red-500 rounded test-sm font-bold text-red-500 hover:bg-red-200 hover:text-gray-700"
            @click="modal = ! modal"
          >Delete</button>

          <div
            v-if="modal"
            class="absolute bg-teal-400 text-white rounded-lg z-20 p-8 w-64 right-0 mt-3 mr-6"
          >
            <p>Are you sure you want to delete this photo?</p>

            <div class="flex items-center mt-6">
              <button
                style="text-decoration : none"
                class="px-4 py-2 rounded text-sm font-bold pr-2 text-white hover:bg-teal-500"
                @click="modal = ! modal"
              >Cancel</button>
              <button
                style="text-decoration : none"
                class="px-4 py-2 bg-red-600 rounded text-sm font-bold text-white hover:bg-red-700"
                @click="destroy"
              >Delete</button>
            </div>
          </div>
        </div>
        <div
          v-if="modal"
          class="bg-black opacity-25 absolute right-0 left-0 top-0 bottom-0 z-10"
          @click="modal = ! modal"
        ></div>
      </div>

      <div class="pt-4">
        <p class="pt-2 text-teal-400 font-bold text-xl">{{ post.title }}</p>
      </div>
      <div class="flex items-center pt-6">
        <div>
          <img :src="post.image" alt width="350" height="350" />
        </div>
      </div>
      <div>
        <p class="pt-2 text-gray-600 font-bold">{{ post.caption }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import UserCircle from "../components/UserCircle";

export default {
  name: "PostsShow",

  components: { UserCircle },

  mounted() {
    axios
      .get("/api/posts/" + this.$route.params.id)
      .then(response => {
        this.post = response.data.data;

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
      loading: true,
      modal: false,
      post: null
    };
  },

  methods: {
    destroy: function() {
      axios
        .delete("/api/posts/" + this.$route.params.id)
        .then(response => {
          this.$router.push("/posts");
        })
        .catch(error => {
          alert("Internal Error.");
        });
    }
  }
};
</script>

<style scoped>
</style>