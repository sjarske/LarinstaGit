<template>
  <div>
    <div v-if="loading">Loading...</div>
    <div v-else>
      <div v-if="posts.lenth ===0">
        <p>
          No posts on your account yet!
          <router-link to="/post/create">Why not create one?</router-link>
        </p>
      </div>

      <div v-for="post in posts">
        <router-link
          :to="'/posts/' + post.data.post_id"
          class="flex items-center border-b border-gray-400 p-4 text-teal-400 hover:bg-gray-100 hover:text-gray-600 font-bold"
          style="text-decoration : none"
        >
          <div>
            <p>{{ post.data.title }}</p>
            <p class="text-gray-600">{{ post.data.caption }}</p>           
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import UserCircle from "../components/UserCircle";

export default {
  name: "ContactsIndex",

  components: {
    UserCircle
  },

  mounted() {
    axios
      .get("/api/posts")
      .then(response => {
        this.posts = response.data.data;

        this.loading = false;
      })
      .catch(error => {
        this.loading = false;

        alert("Unable to fetch");
      });
  },

  data: function() {
    return {
      loading: true,
      posts: null
    };
  }
};
</script>

<style scoped>
</style>