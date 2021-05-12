<template>
  <div class="owl-stage-outer">
    <div class="owl-stage">
  

      <div class="owl-item position-relative"
				 v-for="slider in getSliders"
        :key="slider.id"
        :style="{
          'background-image': ` url(${slider.image})`,
        }"
        style="background-size: cover; background-position: center">

							<div class="position-absolute bottom-10 w-100pct w-sm-75pct w-lg-50pct appear-animation"
								data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="500"
								data-plugin-options="{'minWindowWidth': 0}" style="right: -50px;">
								<div class="bg-primary custom-skew-1 mb-5" style="height: 70px;"></div>
							</div>
							<div class="container position-relative z-index-1 h-100">
								<div class="row align-items-end h-100">
									<div class="col-10 col-sm-8 col-lg-5 ml-auto">
										<h1 class="text-color-light font-weight-light mb-0 text-5 text-md-6 position-relative bottom-7 mb-5 pb-3 appear-animation"
											data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="850"
											data-plugin-options="{'minWindowWidth': 0}">{{ slider.title }}</h1>
									</div>
								</div>
							</div>
						</div>
      <!-- Carousel Slide 2 -->
      <!--  <div
        class="owl-item position-relative"
        style="
          background-image: url(frontend/img/demos/construction/slides/slide-construction-2.jpg);
          background-size: cover;
          background-position: center;
        "
      >
        <div
          class="position-absolute bottom-10 w-100pct w-sm-75pct w-lg-50pct appear-animation"
          data-appear-animation="fadeInLeftShorter"
          data-appear-animation-delay="500"
          data-plugin-options="{'minWindowWidth': 0}"
          style="right: -50px"
        >
          <div class="bg-primary custom-skew-1 mb-5" style="height: 70px"></div>
        </div>
        <div class="container position-relative z-index-1 h-100">
          <div class="row align-items-end h-100">
            <div class="col-10 col-sm-8 col-lg-5 ml-auto">
              <h2
                class="text-color-light font-weight-light mb-0 text-5 text-md-6 position-relative bottom-7 mb-5 pb-3 appear-animation"
                data-appear-animation="fadeInLeftShorter"
                data-appear-animation-delay="850"
                data-plugin-options="{'minWindowWidth': 0}"
              >
                MODERN OFFICES DESIGN
              </h2>
            </div>
          </div>
        </div>
      </div> -->
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      filter: {},
    };
  },
  computed: {
    ...mapGetters(["getSliders"]),
  },
  created() {
    this.$store.dispatch("initSlider", { filter: this.filter });
  },
};
</script>

<style lang="scss" scoped></style>
