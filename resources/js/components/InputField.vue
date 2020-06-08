<template>
  <div class="relative pb-4">
    <label
      :for="name"
      class="text-teal-400 pt-2 uppercase text-xs font-bold absolute"
    >{{ label }}</label>
    <input
      :id="name"
      type="text"
      class="pt-8 w-full border-b pb-2 focus:outline-none focus:border-teal-400 text-gray-700"
      :class="errorClassObject()"
      :placeholder="placeholder"
      v-model="value"
      @input="updateField()"
    />

    <p class="text-pink-700 text-sm" v-text="errorMessage()">Error here</p>
  </div>
</template>

<script>
export default {
  name: "InputField",

  props: ["name", "label", "placeholder", "errors", "data"],

  data: function() {
    return {
      value: ""
    };
  },

  computed: {
    hasError: function() {
      return (
        this.errors &&
        this.errors[this.name] &&
        this.errors[this.name].length > 0
      );
    }
  },

  methods: {
    updateField: function() {
      this.clearErrors(this.name);

      this.$emit("update:field", this.value);
    },

    errorMessage: function() {
      if (this.hasError) {
        return this.errors[this.name][0];
      }
    },

    clearErrors: function() {
      if (this.hasError) {
        this.errors[this.name] = null;
      }
    },

    errorClassObject: function() {
      return {
        "error-field": this.hasError
      };
    }
  },

  watch: {
    data: function(val) {
      this.value = val;
    }
  }
};
</script>

<style scoped>
</style>