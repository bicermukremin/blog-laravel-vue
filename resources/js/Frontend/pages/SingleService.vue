<template>
  <div class="body">
    <Header></Header>
    <div role="main" class="main">
      <section class="section section-tertiary secPart section-no-border pb-3 mt-0">
        <div class="container">
          <div class="row justify-content-end mt-4">
            <div class="col-lg-10 pt-4 mt-4 text-right">
              <h1 class="text-uppercase font-weight-light mt-4 pt-3 text-color-primary">
                Hizmet-{{ service.title }}
              </h1>
            </div>
          </div>
        </div>
      </section>

      <div class="container">
        <div class="row pt-2 mb-4">
          <div class="col-lg-3">
            <aside class="sidebar">
              <ul class="nav nav-list flex-column mb-4 show-bg-active">
                <li class="nav-item">
                  <a class="nav-link active">Hizmetler</a>
                </li>
                <li
                  class="nav-item pointer"
                  v-for="service in getServices"
                  :key="service.id"
                >
                  <a class="nav-link" @click="changeService(service)">
                    {{ service.title }}
                  </a>
                </li>
              </ul>

              <h4 class="pt-4 mb-3 text-color-dark">Bize Ulaşın</h4>
              <p>Mesaj atarak ya da telefonla bize ulaşın, size yardımcı olalım!</p>
              <Contact></Contact>
            </aside>
          </div>
          <div class="col-lg-9">
            <h2 class="mb-2">{{ service.title }}</h2>
              
            <img
              class="img-fluid float-right ml-5 mb-4 mt-4"
              width="150px"
              height="150px"
              :src="`storage/${service.images[1]}`"
              alt=""
            />
             <p class="lead pb-4">
                  Lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem
                  nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet
                  mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt
                  auctor a ornare odio. Sed non mauris vitae erat consequat. Lorem quis
                  bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id
                  elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.
                  Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a
                  ornare.
                </p>

            <p class="lead mb-4 mt-4" v-html="service.content"></p>

            <div class="row">
              <div class="col-lg-5">
                <p class="pb-4">
                  Lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem
                  nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet
                  mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt
                  auctor a ornare odio. Sed non mauris vitae erat consequat. Lorem quis
                  bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id
                  elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.
                  Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a
                  ornare.
                </p>
              </div>
              <div class="col-lg-7">
                <div
                  class="owl-carousel nav-inside show-nav-hover dots-inside mb-5"
                  data-plugin-options="{'items': 1, 'loop': true, 'autoplay': true, 'autoplayTimeout': 5000, 'autoplayHoverPause': true, 'nav': true, 'dots': true, 'animateOut': 'fadeOut'}"
                >
                  <div v-for="(image, i) in service.images" :key="i">
                    <img :src="`storage/${image}`" :alt="service.title" />
                  </div>
                </div>
              </div>
            </div>

            <p>
              Gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis
              bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
              Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Gravida nibh
              vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor,
              nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit
              amet nibh vulputate cursus a sit amet mauris.
            </p>

            <h4 class="mt-4 mb-3">Our Process</h4>

            <ul class="list list-icons list-primary mt-4 mb-4">
              <li
                v-for="(item, i) in service.items"
                :key="i"
                class="appear-animation"
                data-appear-animation="fadeInUp"
                data-appear-animation-delay="0"
              >
                <i class="fas fa-check"></i> {{ item.value }}
              </li>
            </ul>
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
import Contact from "./../components/Contact";

import { mapGetters } from "vuex";
export default {
  components: {
    Header,
    Footer,
    Contact,
  },

  data() {
    return {
      service: this.$store.state.service.service,
      filter: [],
      id: "",
    };
  },
  computed: {
    ...mapGetters(["getServices"]),
  },
  methods: {
    changeService(service) {
      this.service = service;
    },
  },

  beforeCreate() {
    this.$store.dispatch("getService", this.$route.params.service);

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
.pointer {
  cursor: pointer;
}
</style>
