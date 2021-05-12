<template>

    <section
     
      class="section section-background mb-4"
     
      v-bind:style="{
          'background-image': ` url(${bannerImage})`,
        }"
      style="background-position: 50% 100%; min-height: 540px; background-size: cover"
    >
      <div class="container">
        <div class="row justify-content-end">
          <div class="col-lg-6" >
            <div
           
              class="owl-carousel owl-theme nav-bottom rounded-nav mt-4 pt-4 mb-4 pb-4"
              data-plugin-options="{'items': 1, 'loop': false}"
            >
              <div  v-for="banner in getBanners"
              :key="banner.id">
                <div class="col">
                  <div
                 
                    class="testimonial testimonial-style-2 testimonial-with-quotes mb-0"
                  >
                    <blockquote>
                      <p>
                        {{ banner.content }}
                      </p>
                    </blockquote>
                  </div>
                </div>
              </div>
              <div></div>
            </div>
          </div>
        </div>
      </div>
    </section>

</template>

<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["getBanners"]),
    bannerImage(){
      return this.$store.state.banner.banners.length>0 ? 'storage/'+this.$store.state.banner.banners[1].image : null;
    }
  },
  mounted() {
    this.$store.dispatch("indexBanner", { filter: this.filter });
  },
};
</script>

<style lang="scss" scoped>

</style>

