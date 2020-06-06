<template>
  <div class="relative pb-4">
    <label
      :for="caption"
      class="text-teal-400 pt-2 uppercase text-xs font-bold absolute"
    >{{ label }}</label>
    <input
      :id="caption"
      type="text"
      class="pt-8 w-full border-b pb-2 focus:outline-none focus:border-teal-400 text-gray-700"
      :placeholder="placeholder"
      v-model="value"
      @input="updateField()"
    />

    <p class="text-pink-700 text-sm" v-text="errorMessage(caption)">Error here</p>
  </div>
</template>

<script>
export default {
  name: "InputField",

  props: [
    "caption", "label","placeholder",'errors',
    ],

  data: function(){
    return{
      value:''
    }
  },

  methods:{
    updateField: function(){
      this.$emit('update:field', this.value)
    },

    errorMessage: function(field){
      if(this.errors && this.errors[field] && this.errors[field].length > 0){
        return this.errors[field][0];
      }
    }
  }
};
</script>

<style scoped>
</style>