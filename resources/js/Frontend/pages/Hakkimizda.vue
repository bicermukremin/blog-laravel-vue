<template>
  <div class="body">
    <Header></Header>
    <div role="main" class="main">
      <section class="section section-tertiary secPart section-no-border pb-3 mt-0">
        <div class="container">
          <div class="row justify-content-end mt-4">
            <div class="col-lg-10 pt-4 mt-4 text-right">
              <h1 class="text-uppercase font-weight-light mt-4 pt-3 text-color-primary">
                {{ getFrontend.title }}
              </h1>
            </div>
          </div>
        </div>
      </section>

      <div class="container">
        <div class="row pt-2">
          <div class="col-lg-3">
            <aside
              class="sidebar"
              id="sidebar"
              data-plugin-sticky
              data-plugin-options="{'minWidth': 991, 'containerSelector': '.container', 'padding': {'top': 110}}"
            >
              <ul class="nav nav-list flex-column mb-4 show-bg-active">
                <li class="nav-item">
                  <a class="nav-link" data-hash data-hash-offset="110" href="#who-we-are"
                    >Biz Kimiz</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-hash data-hash-offset="110" href="#history"
                    >Tarihçe</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    data-hash
                    data-hash-offset="110"
                    href="#mission-vision"
                    >Misyon &amp; Vizyon</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-hash data-hash-offset="110" href="#leadership"
                    >Bendeniz</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-hash data-hash-offset="110" href="#partners"
                    >Programlama Dil ve Araçları</a
                  >
                </li>
              </ul>
            </aside>
          </div>
          <div class="col-lg-9">
            <section id="who-we-are" class="mb-4">
              <div
                class="owl-carousel nav-inside show-nav-hover dots-inside mt-3 mb-4"
                data-plugin-options="{'items': 1, 'loop': true, 'autoplay': true, 'autoplayTimeout': 5000, 'autoplayHoverPause': true, 'nav': true, 'dots': true, 'animateOut': 'fadeOut'}"
              >
                <div v-for="(image, i) in getFrontendImages" :key="i">
                  <img :src="`storage/${image}`" alt="" />
                </div>
              </div>

              <h2 class="mb-0 text-color-dark">{{ getFrontend.title }}</h2>
              <p class="lead mb-4 mt-4" v-html="getFrontend.description"></p>

              <p>
                Gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
                Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi
                accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare
                odio. Sed non mauris vitae erat consequat.
              </p>
            </section>

            <hr class="solid my-5" />

            <section id="history" class="mb-4">
              <h2 class="mb-0 text-color-dark">Tarihçe</h2>

              <div class="row">
                <div class="col-lg-7">
                  <img
                    class="float-left img-fluid mr-4 mb-3 mt-4 appear-animation"
                    data-appear-animation="fadeInUp"
                    data-appear-animation-delay="0"
                    width="200"
                    src="img/demos/construction/office/office-1.jpg"
                    alt=""
                  />
                  <p class="mt-4" v-html="getFrontend.history_content"></p>
                  <p class="mt-4">
                    Gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                    bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id
                    elit. Gravida nibh vel velit auctor aliquet. Aenean sollicitudin,
                    lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis
                    sem nibh id elit.
                  </p>
                </div>
                <div class="col-lg-4">
                  <ul class="list list-unstyled list-primary list-borders">
                    <li
                      v-for="(item, i) in getFrontendHistory"
                      :key="i"
                      class="pt-2 pb-2 appear-animation"
                      data-appear-animation="fadeInUp"
                      data-appear-animation-delay="0"
                    >
                      <strong class="text-color-primary text-4"
                        >{{ item.year }} -
                      </strong>
                      {{ item.value }}
                    </li>
                  </ul>
                </div>
              </div>
            </section>

            <hr class="solid my-5" />

            <section id="mission-vision" class="mb-4">
              <div class="row mt-4">
                <div class="col-sm-6 text-center">
                  <div
                    class="feature-box feature-box-style-4 justify-content-center mt-4 appear-animation"
                    data-appear-animation="fadeInUp"
                    data-appear-animation-delay="0"
                  >
                    <span class="featured-boxes featured-boxes-style-4 p-0 m-0">
                      <span
                        class="featured-box featured-box-primary featured-box-effect-6 p-0 m-0"
                      >
                        <span class="box-content p-0 m-0">
                          <i class="icon-featured icon-target icons"></i>
                        </span>
                      </span>
                    </span>
                    <div class="feature-box-info">
                      <h2 class="mb-3 text-color-dark">Misyon</h2>
                      <p class="mb-4" v-html="getFrontend.mission"></p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 text-center">
                  <div
                    class="feature-box feature-box-style-4 justify-content-center mt-4 appear-animation"
                    data-appear-animation="fadeInUp"
                    data-appear-animation-delay="300"
                  >
                    <span class="featured-boxes featured-boxes-style-4 p-0 m-0">
                      <span
                        class="featured-box featured-box-primary featured-box-effect-6 p-0 m-0"
                      >
                        <span class="box-content p-0 m-0">
                          <i class="icon-featured icon-eye icons"></i>
                        </span>
                      </span>
                    </span>
                    <div class="feature-box-info">
                      <h2 class="mb-3 text-color-dark">Vizyon</h2>
                      <p class="mb-4" v-html="getFrontend.vision"></p>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <hr class="solid my-5" />

            <section id="leadership" class="mb-4">
              <h2 class="mb-0 text-color-dark">Bendeniz</h2>

              <div class="row mt-4">
                <div class="col-md-6">
                  <span
                    class="thumb-info thumb-info-side-image thumb-info-no-zoom no-borders mb-4"
                  >
                    <span class="thumb-info-side-image-wrapper p-0">
                      <img
                        src="img/team/team-22.jpg"
                        class="img-fluid"
                        alt=""
                        style="width: 160px"
                      />
                    </span>
                    <span class="thumb-info-caption">
                      <span class="thumb-info-caption-text">
                        <h5 class="text-uppercase mb-1">
                          John Doe - <small class="font-weight-light">Founder</small>
                        </h5>
                        <p class="mb-0">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
                          rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.
                        </p>
                      </span>
                    </span>
                  </span>
                </div>
                <div class="col-md-6">
                  <span
                    class="thumb-info thumb-info-side-image thumb-info-no-zoom no-borders mb-4"
                  >
                    <span class="thumb-info-side-image-wrapper p-0">
                      <img
                        src="img/team/team-23.jpg"
                        class="img-fluid"
                        alt=""
                        style="width: 160px"
                      />
                    </span>
                    <span class="thumb-info-caption">
                      <span class="thumb-info-caption-text">
                        <h5 class="text-uppercase mb-1">
                          Jeremy Doe - <small class="font-weight-light">President</small>
                        </h5>
                        <p class="mb-0">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
                          rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.
                        </p>
                      </span>
                    </span>
                  </span>
                </div>
              </div>
            </section>

            <hr class="solid my-5" />

            <section id="partners" class="mb-4">
              <h2 class="mb-0 text-color-dark">Programlama Dil ve Araçları</h2>

              <div class="row mt-4">
                <div class="content-grid content-grid-dashed col mt-4 mb-4">
                  <div class="row content-grid-row">
                    <div
                      class="content-grid-item col-sm-4 text-center"
                      v-for="(software, index) in getFrontendSoftware"
                      :key="'first' + index"
                    >
                      <div class="p-4">
                        <img class="img-fluid" :src="`storage/${software}`" alt="" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>

    <Footer></Footer>
  </div>
</template>

<script>
import Header from "./../components/Header";
import Footer from "./../components/Footer";
import { mapGetters } from "vuex";
export default {
  components: {
    Header,
    Footer,
  },

  computed: {
    ...mapGetters([
      "getFrontend",
      "getFrontendImages",
      "getFrontendHistory",
      "getFrontendSoftware",
    ]),
  },
  async beforeCreate() {
    this.$store.dispatch("getFrontSoftware");
    this.$store.dispatch("getFrontendAbout");
  },
  /*  props: ["blogId"], */
  mounted() {
    var jQueryAppearA = document.createElement("script");
    jQueryAppearA.setAttribute("src", "frontend/vendor/jquery/jquery.min.js");
    document.body.appendChild(jQueryAppearA);

    var jQueryAppearB = document.createElement("script");
    jQueryAppearB.setAttribute(
      "src",
      "frontend/vendor/jquery.appear/jquery.appear.min.js"
    );
    document.body.appendChild(jQueryAppearB);

    var jQueryAppearC = document.createElement("script");
    jQueryAppearC.setAttribute(
      "src",
      "frontend/vendor/jquery.easing/jquery.easing.min.js"
    );
    document.body.appendChild(jQueryAppearC);

    var jQueryAppearD = document.createElement("script");
    jQueryAppearD.setAttribute(
      "src",
      "frontend/vendor/jquery.cookie/jquery.cookie.min.js"
    );
    document.body.appendChild(jQueryAppearD);

    var jQueryAppearE = document.createElement("script");
    jQueryAppearE.setAttribute("src", "frontend/vendor/popper/umd/popper.min.js");
    document.body.appendChild(jQueryAppearE);

    var jQueryAppearF = document.createElement("script");
    jQueryAppearF.setAttribute("src", "frontend/vendor/bootstrap/js/bootstrap.min.js");
    document.body.appendChild(jQueryAppearF);

    var jQueryAppearG = document.createElement("script");
    jQueryAppearG.setAttribute(
      "src",
      "frontend/vendor/jquery.validation/jquery.validate.min.js"
    );
    document.body.appendChild(jQueryAppearG);

    var jQueryAppearH = document.createElement("script");
    jQueryAppearH.setAttribute(
      "src",
      "frontend/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"
    );
    document.body.appendChild(jQueryAppearH);

    var jQueryAppearI = document.createElement("script");
    jQueryAppearI.setAttribute("src", "frontend/vendor/jquery.gmap/jquery.gmap.min.js");
    document.body.appendChild(jQueryAppearI);

    var jQueryAppearK = document.createElement("script");
    jQueryAppearK.setAttribute("src", "frontend/vendor/lazysizes/lazysizes.min.js");
    document.body.appendChild(jQueryAppearK);

    var jQueryAppearL = document.createElement("script");
    jQueryAppearL.setAttribute("src", "frontend/vendor/isotope/jquery.isotope.min.js");
    document.body.appendChild(jQueryAppearL);

    var jQueryAppearM = document.createElement("script");
    jQueryAppearM.setAttribute("src", "frontend/vendor/owl.carousel/owl.carousel.min.js");
    document.body.appendChild(jQueryAppearM);

    var jQueryAppearN = document.createElement("script");
    jQueryAppearN.setAttribute(
      "src",
      "frontend/vendor/magnific-popup/jquery.magnific-popup.min.js"
    );
    document.body.appendChild(jQueryAppearN);

    var jQueryAppearO = document.createElement("script");
    jQueryAppearO.setAttribute("src", "frontend/vendor/vide/jquery.vide.min.js");
    document.body.appendChild(jQueryAppearO);

    var jQueryAppearP = document.createElement("script");
    jQueryAppearP.setAttribute("src", "frontend/vendor/vivus/vivus.min.js");
    document.body.appendChild(jQueryAppearP);

    var jQueryAppearR = document.createElement("script");
    jQueryAppearR.setAttribute("src", "frontend/js/theme.js");
    document.body.appendChild(jQueryAppearR);

    var jQueryAppearY = document.createElement("script");
    jQueryAppearY.setAttribute("src", "frontend/js/demos/demo-construction.js");
    document.body.appendChild(jQueryAppearY);

    /*  var jQueryAppearS = document.createElement("script");
    jQueryAppearS.setAttribute("src", "frontend/js/views/view.contact.js");
    document.body.appendChild(jQueryAppearS); */

    var jQueryAppearT = document.createElement("script");
    jQueryAppearT.setAttribute("src", "frontend/js/custom.js");
    document.body.appendChild(jQueryAppearT);

    /*     var jQueryAppearU = document.createElement("script");
    jQueryAppearU.setAttribute("src", "frontend/js/theme.init.js");
    document.body.appendChild(jQueryAppearU); */

    var jQueryAppearV = document.createElement("script");
    jQueryAppearV.setAttribute("src", "frontend/vendor/modernizr/modernizr.min.js");
    document.head.appendChild(jQueryAppearV);
  },
};
</script>

<style lang="scss" scoped>
.secPart {
  background-color: #220c3c !important;
}
</style>
