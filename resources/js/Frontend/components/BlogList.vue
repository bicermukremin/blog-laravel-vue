<template>
  <section class="pt-3 section-custom-construction-2">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div
            class="owl-carousel owl-theme stage-margin rounded-nav"
            data-plugin-options="{'margin': 10, 'loop': true, 'nav': true, 'dots': false, 'stagePadding': 40, 'items': 6, 'autoplay': true, 'autoplayTimeout': 3000}"
          >
            <div v-for="(image, i) in getFrontendSoftware" :key="i">
              <img class="img-fluid" :src="'/storage/' + image" alt="" />
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 text-center mt-4">
          <hr class="solid mt-0 mb-4" />
        </div>
      </div>
      <div class="row pt-4">
        <div class="col">
          <h2 class="mb-0 text-color-dark">Blog</h2>
          <p class="lead mb-2">Web Yazılımı ile ilgili aradığınız herşey.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4" v-for="blog in getBlogs" :key="blog.id">
          <div class="recent-posts mt-4">
            <router-link
              :to="{
                name: 'frontend',
            
              }"
            >
              <img class="img-fluid pb-3" :src="`storage/${blog.image}`" alt="Blog" />
            </router-link>
            <article class="post">
              <div class="post-date">
                <span class="day">{{ blog.created_at | day }}</span>
                <span class="month">{{ blog.created_at | month }}</span>
              </div>
              <h4 class="pt-2 pb-0 mb-0">
                <a class="text-color-dark" href="#">{{ blog.title }}</a>
              </h4>
              <p>By {{ blog.author.name }}</p>
              <p v-html="blog.description"></p>
              <router-link
                :to="{
                  name: 'frontend'
                
                }"
                class="mt-3"
                >Devamını Oku
                <i class="fas fa-long-arrow-alt-right position-relative top-1"></i
              ></router-link>
            </article>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      filter: [],
    };
  },
  computed: {
    ...mapGetters(["getBlogs", "getFrontendSoftware"]),
  },
  async created() {
    this.$store.dispatch("getFrontSoftware");
    this.$store.dispatch("initBlog",{filter:this.filter});
  },
};
</script>

<style lang="scss" scoped></style>
