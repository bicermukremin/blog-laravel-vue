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
        beforeCreate(){
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

       var jQueryAppearB = document.createElement("script");
    jQueryAppearB.setAttribute("src", "admin/master/style-switcher/style.switcher.js");
    document.body.appendChild(jQueryAppearB);

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

        var jQueryAppearH = document.createElement("script");
    jQueryAppearH.setAttribute("src", "admin/vendor/common/common.js");
    document.body.appendChild(jQueryAppearH);

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

        }
    }
</script>

<style lang="scss" scoped>

</style>