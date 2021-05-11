<template>
  <div class="vld-parent">
    <loading :active.sync="isLoading" :can-cancel="true"></loading>

    <!-- <label><input type="checkbox" v-model="fullPage" />Full page?</label> -->
  </div>
</template>

<script>
// Import component
import Loading from "vue-loading-overlay";
// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  props: ["isLoading"],

  components: {
    Loading,
  },

  methods: {},
};
</script>
