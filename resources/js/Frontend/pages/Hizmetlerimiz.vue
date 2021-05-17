<template>
  <div class="body">
    <Header></Header>
    <div role="main" class="main">
      <section class="section section-tertiary secPart section-no-border pb-3 mt-0">
        <div class="container">
          <div class="row justify-content-end mt-4">
            <div class="col-lg-10 pt-4 mt-4 text-right">
              <h1 class="text-uppercase font-weight-light mt-4 pt-3 text-color-primary">
                Hizmetlerimiz
              </h1>
            </div>
          </div>
        </div>
      </section>

      <div class="container">
        <div class="row pt-2">
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
                  <router-link
                    class="nav-link"
                    :to="{
                      name: 'singleService',
                      params: { slugService: service.slug, service: service },
                    }"
                  >
                    {{ service.title }}
                  </router-link>
                </li>
              </ul>

              <h4 class="pt-4 mb-3 text-color-dark">Bize Yaz</h4>
              <p>Mesaj atarak ya da telefonla bize ulaşın, size yardımcı olalım!</p>

              <Contact></Contact>
            </aside>
          </div>
          <div class="col-lg-9">
            <div class="row mt-4" v-for="service in getServices" :key="service.id">
              <div class="col">
                <div
                  class="feature-box feature-box-style-2 align-items-start mb-4 ml-lg-5 appear-animation"
                  data-appear-animation="fadeInUp"
                  data-appear-animation-delay="0"
                >
                  <div class="feature-box-icon w-auto h-auto top-0">
                    <img
                      :src="`storage/${service.images[0]}`"
                      alt=""
                      width="63px"
                      height="80px"
                      class="img-fluid"
                    />
                  </div>
                  <div class="feature-box-info ml-2">
                    <h4 class="mb-2">{{ service.title }}</h4>
                    <p v-html="service.content.substring(0,350)"></p>
                    <router-link
                      class="mt-3"
                      :to="{
                        name: 'singleService',
                        params: {
                          slugService: service.slug,
                          service: service,
                        },
                      }"
                      >Devamını Oku <i class="fas fa-long-arrow-alt-right"></i
                    ></router-link>
                  </div>
                </div>
              </div>
            </div>
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

  computed: {
    ...mapGetters(["getServices"]),
  },

  beforeCreate() {
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
