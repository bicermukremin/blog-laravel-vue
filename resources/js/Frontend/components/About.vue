<template>
  <div class="container">
    <div class="row mt-4 mt-lg-5 mb-4 py-4">
      <div class="col-lg-4">
        <h2 class="mb-0 text-color-dark">{{ getBaseAbout.title }}</h2>
        <p class="lead" v-html="getBaseAbout.description"></p>
      </div>
      <div class="col-lg-2 text-center d-none d-lg-block">
        <img src="frontend/img/dotted-line-angle.png" class="img-fluid" alt="" />
      </div>
      <div class="col-lg-6">
        <p v-html="getBaseAbout.history_content"></p>
        <router-link class="mt-3" :to="{ name: 'hakkimizda' }"
          >Devamını Oku<i class="fas fa-long-arrow-alt-right"></i
        ></router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["getBaseAbout"]),
  },
  beforeCreate() {
    this.$store.dispatch("indexAbout", { filter: null });
  },
};
</script>

<style lang="scss" scoped></style>
