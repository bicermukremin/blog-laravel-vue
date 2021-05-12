<template>
  <div>
    <section
      v-for="banner in getBanners"
      :key="banner.id"
      class="section section-background mb-4"
      :style="{
        'background-image': ` url(storage/${banner.image})`,
      }"
      style="background-position: 50% 100%; min-height: 540px; background-size: cover"
    >
      <div class="container">
        <div class="row justify-content-end">
          <div class="col-lg-6">
            <div
              class="owl-carousel owl-theme nav-bottom rounded-nav mt-4 pt-4 mb-4 pb-4"
              data-plugin-options="{'items': 1, 'loop': false}"
            >
              <div>
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
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["getBanners"]),
  },
  created() {
    this.$store.dispatch("indexBanner", { filter: this.filter });
  },
};
</script>

<style lang="scss" scoped></style>
