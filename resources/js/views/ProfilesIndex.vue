<template>
  <div>
    <div v-if="loading">Loading...</div>
    <div v-else>
      <div v-for="profile in profiles" :key="profile.id">
        <router-link
          class="flex items-center border-b border-gray-400 p-4 text-teal-400 hover:bg-gray-100 hover:text-gray-600 font-bold"
          style="text-decoration : none"
          :to="'/profiles/' + profile.id"
        >
          <div>
            <p>{{ profile.name }}</p>
            <p class="text-gray-600">{{ profile.description }}</p>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import UserCircle from "../components/UserCircle";

export default {
  name: "ProfilesIndex",

  components: {
    UserCircle
  },

  mounted() {
    axios
      .get("/api/profiles")
      .then(response => {
        this.profiles = response.data;

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
      profiles: null
    };
  }
};
</script>

<style scoped>
</style>