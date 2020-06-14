<template>
  <div>
    <button
      class="bg-teal-400 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded"
      @click="followUser"
      v-text="buttonText"
    ></button>
  </div>
</template>

<script>
export default {
  props: ['userId','follows'],

    data: function(){
        return{
            status: this.follows,
        }
    },

  methods: {
    followUser() {
      axios.post('/api/follow/' + this.userId)
      .then(response => {
          this.status = ! this.status;

          console.log(response.data);
        });
    }
  },

  computed:{
      buttonText(){
          return (this.status) ? 'Unfollow' : 'Follow'
      }
  }
};
</script>

<style scoped>
</style>