<template>
  <div>
    <div v-if="loading" class="text-teal-400">Loading...</div>
    <div v-else>
      <section class="bg-white">
        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
          <nav id="store" class="w-full z-30 top-0 px-6 py-1">
            <div class="w-full container mx-auto flex flex-wrap items-center mt-0 px-2 py-3">
              <UserCircle :name="user.name" class="mr-2" />
              <p class="txt-gray-700 font-bold text-2xl">{{ user.name }}</p>
              <div class="pl-6">
                <FollowButton :user-id="user.id" :follows="follows" />
              </div>
            </div>
          </nav>
          <div class="d-flex w-full pl-10">
            <div class="pr-5">
              <strong>{{ posts.length }}</strong> posts
            </div>
            <div class="pr-5">
              <strong>{{ user.profile.followers.length }}</strong> followers
            </div>
            <div class="pr-5">
              <strong>{{ user.following.length }}</strong> following 
            </div>
          </div>
          <div v-for="post in posts" :key="post.post_id">
            <div class="pt-5">
              <img class="h-64 w-64 pr-16" :src="post.image" alt width="350" height="350" />
              <div class="pt-3 flex items-center justify-between">
                <p class="font-bold text-teal-400">{{post.title}}</p>
              </div>
              <p class="text-gray-600 font-bold">{{post.caption}}</p>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
import UserCircle from "../components/UserCircle";
import FollowButton from "../components/FollowButton";

export default {
  name: "ProfilesShow",

  components: { UserCircle, FollowButton },

  mounted() {
    axios
      .get("/api/profiles/" + this.$route.params.id)
      .then(response => {
        this.user = response.data[0];
        this.posts = response.data[1];
        this.follows = response.data[2];

        this.loading = false;
      })
      .catch(error => {
        this.loading = false;
      });
  },

  data: function() {
    return {
      loading: true,
      user: null,
      posts: null,
      follows: null
    };
  },

  methods: {}
};
</script>

<style scoped>
</style>