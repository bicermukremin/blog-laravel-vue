<template>
  <div class="body">
    <Header></Header>
    <div role="main" class="main">
      <section class="section section-tertiary secPart section-no-border pb-3 mt-0">
        <div class="container">
          <div class="row justify-content-end mt-4">
            <div class="col-lg-10 pt-4 mt-4 text-right">
              <h1 class="text-uppercase font-weight-light mt-4 pt-3 text-color-primary">
                Projelerimiz
              </h1>
            </div>
          </div>
        </div>
      </section>

      <div class="container">
        <div class="row pt-2">
          <div class="col">
            <ul class="nav nav-pills mb-3 pb-2">
              <li class="nav-item">
                <a class="nav-link active pointer" @click.prevent="showThemAll"
                  >Hepsini Göster</a
                >
              </li>
              <li class="nav-item" v-for="service in getServices" :key="service.id">
                <a
                  class="nav-link pointer"
                  :class="{ active: isActive == service.id }"
                  @click.prevent="showServiceProjects(service)"
                >
                  {{ service.title }}
                </a>
              </li>
            </ul>

            <div class="sort-destination-loader">
              <div class="row mb-4 pt-1 portfolio-list">
                <div
                  class="col-md-6 col-lg-4 isotope-item mb-4 pre-construction"
                  v-for="project in getProjects"
                  :key="project.id"
                >
                  <a href="#">
                    <span
                      class="thumb-info thumb-info-centered-info thumb-info-no-borders"
                    >
                      <span class="thumb-info-wrapper">
                        <img
                          :src="`storage/${project.image}`"
                          class="img-fluid"
                          :alt="project.company_name"
                        />
                        <span class="thumb-info-title">
                          <span class="thumb-info-inner">Projemizi İncele</span>
                        </span>
                      </span>
                    </span>
                  </a>
                  <h4 class="mt-3 mb-0">{{ project.company_name }}</h4>
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
import { mapGetters } from "vuex";
export default {
  components: {
    Header,
    Footer,
  },
  data() {
    return {
      isActive: 0,
      filter: [],
    };
  },
  /*  props: ["blogId"], */
  computed: {
    ...mapGetters(["getProjects", "getServices"]),
  },
  methods: {
    showThemAll() {
      this.$store.dispatch("initProject", { filter: null });
    },
    showServiceProjects(service) {
      this.filter["service"] = service.id;

      this.$store.dispatch("getServiceProject", { filter: this.filter });
    },
  },

  beforeCreate() {
    this.$store.dispatch("initProject", { filter: null });
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
  /*     beforeDestroy() {
        var scripts = $("script[src^='frontend/']");
        var filteredScripts = [];
        for (let i = 1; i < 21; i++) {
          filteredScripts.push(scripts[i]);
        }
        for (let i = 0; i < filteredScripts.length; i++) {
          document.body.removeChild(filteredScripts[i]);
        }
      }, */
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
