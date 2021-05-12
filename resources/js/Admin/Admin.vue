<template>
  <section class="body">
    <!-- start: header -->
    <Header @search="search"></Header>
    <!-- end: header -->

    <div class="inner-wrapper">
      <!-- start: sidebar -->
      <Sidebar></Sidebar>
      <!-- end: sidebar -->

      <section role="main" class="content-body">
        <PageHeader></PageHeader>
        <!-- start: page -->
        <transition name="fade" mode="out-in">
          <router-view :searched="searched"></router-view>
        </transition>
        <!-- end: page -->
      </section>
    </div>

    <aside id="sidebar-right" class="sidebar-right">
      <RightBar></RightBar>
    </aside>
  </section>
</template>

<script>
import Header from "./components/Header";
import Sidebar from "./components/Sidebar";
import PageHeader from "./components/PageHeader";
import RightBar from "./components/RightBar";
export default {
  data() {
    return {
      searched: "",
    };
  },
  components: {
    Header,
    Sidebar,
    PageHeader,
    RightBar,
  },

  methods: {
    search(payload) {
      this.searched = payload;
    },
  },


  async beforeCreate() {
    this.$store.dispatch("loadUser");
   
    /* $("head").append(
      $('<link rel="stylesheet">').attr(
        "href",
        "admin/vendor/bootstrap/css/bootstrap.css"
      )
    );
    $("head").append(
      $('<link rel="stylesheet">').attr("href", "admin/vendor/animate/animate.compat.css")
    );
    $("head").append(
      $('<link rel="stylesheet">').attr(
        "href",
        "admin/vendor/font-awesome/css/all.min.css"
      )
    );
    $("head").append(
      $('<link rel="stylesheet">').attr(
        "href",
        "admin/vendor/boxicons/css/boxicons.min.css"
      )
    );
    $("head").append(
      $('<link rel="stylesheet">').attr(
        "href",
        "admin/vendor/magnific-popup/magnific-popup.css"
      )
    );
    $("head").append(
      $('<link rel="stylesheet">').attr(
        "href",
        "admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css"
      )
    ); */
    /*   $("head").append(
      $('<link rel="stylesheet">').attr(
        "href",
        "http://127.0.0.1:8000/admin/css/theme.css"
      )
    ); */

    var jQueryAppearA = document.createElement("script");
    jQueryAppearA.setAttribute("src", "admin/vendor/jquery/jquery.js");
    document.body.appendChild(jQueryAppearA);

    var jQueryAppearC = document.createElement("script");
    jQueryAppearC.setAttribute(
      "src",
      "admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js"
    );
    document.body.appendChild(jQueryAppearC);

    var jQueryAppearD = document.createElement("script");
    jQueryAppearD.setAttribute("src", "admin/vendor/jquery-cookie/jquery.cookie.js");
    document.body.appendChild(jQueryAppearD);

    /*    var jQueryAppearB = document.createElement("script");
    jQueryAppearB.setAttribute("src", "admin/master/style-switcher/style.switcher.js");
    document.body.appendChild(jQueryAppearB); */

    var jQueryAppearE = document.createElement("script");
    jQueryAppearE.setAttribute("src", "admin/vendor/popper/umd/popper.min.js");
    document.body.appendChild(jQueryAppearE);

    var jQueryAppearF = document.createElement("script");
    jQueryAppearF.setAttribute("src", "admin/vendor/bootstrap/js/bootstrap.js");
    document.body.appendChild(jQueryAppearF);

    var jQueryAppearG = document.createElement("script");
    jQueryAppearG.setAttribute(
      "src",
      "admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"
    );
    document.body.appendChild(jQueryAppearG);

    /*     var jQueryAppearH = document.createElement("script");
    jQueryAppearH.setAttribute("src", "admin/vendor/common/common.js");
    document.body.appendChild(jQueryAppearH); */

    var jQueryAppearI = document.createElement("script");
    jQueryAppearI.setAttribute("src", "admin/vendor/nanoscroller/nanoscroller.js");
    document.body.appendChild(jQueryAppearI);

    var jQueryAppearK = document.createElement("script");
    jQueryAppearK.setAttribute(
      "src",
      "admin/vendor/magnific-popup/jquery.magnific-popup.js"
    );
    document.body.appendChild(jQueryAppearK);

    var jQueryAppearL = document.createElement("script");
    jQueryAppearL.setAttribute(
      "src",
      "admin/vendor/jquery-placeholder/jquery.placeholder.js"
    );
    document.body.appendChild(jQueryAppearL);

    var jQueryAppearN = document.createElement("script");
    jQueryAppearN.setAttribute("src", "admin/js/theme.js");
    document.body.appendChild(jQueryAppearN);

    var jQueryAppearM = document.createElement("script");
    jQueryAppearM.setAttribute("src", "admin/vendor/modernizr/modernizr.js");
    document.head.appendChild(jQueryAppearM);

    /*     var jQueryAppearO = document.createElement("script");
    jQueryAppearO.setAttribute("src", "admin/js/theme.init.js");
    document.body.appendChild(jQueryAppearO); */

    var jQueryAppearP = document.createElement("script");
    jQueryAppearP.setAttribute(
      "src",
      "admin/master/style-switcher/style.switcher.localstorage.js"
    );
    document.head.appendChild(jQueryAppearP);

    // Maintain Scroll Position
  },
  /* beforeDestroy() {
    var scripts = $("script[src^='admin/']");
    var filteredScripts = [];
    for (let i = 1; i < 10; i++) {
      filteredScripts.push(scripts[i]);
    }
    for (let i = 0; i < filteredScripts.length; i++) {
      document.body.removeChild(filteredScripts[i]);
    }
  }, */
};
</script>
<style>
.fade-enter {
  opacity: 0;
}
.fade-enter-active {
  transition: opacity 0.5s ease-out;
}
.fade-leave {
}
.fade-leave-active {
  transition: opacity 0.5s ease-out;
  opacity: 0;
}
</style>
