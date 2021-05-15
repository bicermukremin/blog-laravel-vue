<template>
  <section class="body-sign">
    <div class="center-sign">
      <router-link :to="{name:'frontend'}" class="logo float-left">
        <img :src="'/storage/'+getSetting.logo2" height="54" alt="MB" />
      </router-link>

      <div class="panel card-sign">
        <div class="card-title-sign mt-3 text-right">
          <h2 class="title text-uppercase font-weight-bold m-0">
            <i class="bx bx-user-circle mr-1 text-6 position-relative top-5"></i> Giriş
          </h2>
        </div>
        <div class="card-body">
          <form method="post">
            <div class="form-group mb-3">
              <label>Mail Adresi</label>
              <div class="input-group">
                <input
                  name="email"
                  type="text"
                  class="form-control form-control-lg"
                  @blur="$v.email.$touch()"
                  v-model="email"
                  :class="[{ 'is-invalid': errorFor('email') || $v.email.$error }]"
                />

                <span class="input-group-append">
                  <span class="input-group-text">
                    <i class="bx bx-user text-4"></i>
                  </span>
                </span>
              </div>
              <!--   <small v-if="!$v.email.required" class="form-text text-danger"
                >Bu alan zorunludur...</small
              > -->
              <small v-if="!$v.email.email" class="form-text text-danger"
                >Lütfen geçerli bir e-posta adresi giriniz...
              </small>
              <v-errors :errors="errorFor('email')"></v-errors>
            </div>
            <div class="form-group mb-3">
              <div class="clearfix">
                <label class="float-left">Şifre</label>
                <a href="pages-recover-password.html" class="float-right"
                  >Şifremi Unuttum?</a
                >
              </div>
              <div class="input-group">
                <input
                  name="pwd"
                  type="password"
                  class="form-control form-control-lg"
                  @blur="$v.password.$touch()"
                  v-model="password"
                  :class="[{ 'is-invalid': errorFor('password') }]"
                />
                <span class="input-group-append">
                  <span class="input-group-text">
                    <i class="bx bx-lock text-4"></i>
                  </span>
                </span>
              </div>

              <!--   <small v-if="!$v.password.required" class="form-text text-danger"
                >Bu alan zorunludur...</small
              > -->
              <small v-if="!$v.password.minLength" class="form-text text-danger"
                >Lütfen şifreniz en az {{ $v.password.$params.minLength.min }} karakterden
                oluşmalıdır...
              </small>
              <small v-if="!$v.password.maxLength" class="form-text text-danger"
                >Lütfen şifreniz en fazla
                {{ $v.password.$params.maxLength.max }} karakterden oluşmalıdır...
              </small>
              <v-errors :errors="errorFor('password')"></v-errors>
            </div>

            <div class="row">
              <div class="col-sm-8">
                <div class="checkbox-custom checkbox-default">
                  <input id="RememberMe" name="rememberme" type="checkbox" />
                  <label for="RememberMe">Beni Hatırla</label>
                </div>
              </div>
              <div class="col-sm-4 text-right">
                <button
                  type="submit"
                  class="btn btn-primary mt-2"
                  :disabled="$v.$invalid"
                  @click.prevent="login"
                >
                 Giriş Yap
                </button>
              </div>
            </div>

           <!--  <span class="mt-3 mb-3 line-thru text-center text-uppercase">
              <span>or</span>
            </span>

            <div class="mb-1 text-center">
              <a class="btn btn-facebook mb-3 ml-1 mr-1" href="#"
                >Connect with <i class="fab fa-facebook-f"></i
              ></a>
              <a class="btn btn-twitter mb-3 ml-1 mr-1" href="#"
                >Connect with <i class="fab fa-twitter"></i
              ></a>
            </div> -->

            <p class="text-center">
              Hesabın Yoksa?
              <router-link :to="{ name: 'register' }">Kayıt Ol!</router-link>
            </p>
          </form>
        </div>
      </div>

      <p class="text-center text-muted mt-3 mb-3">
        &copy; Copyright 2017. All Rights Reserved.
      </p>
    </div>
  </section>
</template>

<script>
import validationErrors from "./../../shared/mixins/validationErrors";
import { logIn,isAdmin } from "./../../shared/utils/auth";
import {
  required,
  email,
  numeric,
  minLength,
  maxLength,
  sameAs,
  between,
} from "vuelidate/lib/validators";
import {mapGetters} from 'vuex'
export default {
  mixins: [validationErrors],
  data() {
    return {
      email: null,
      password: null,
      loading: false,
    };
  },
  validations: {
    email: {
      required,
      email,
      // uniq  : value => {
      //     return value !== 'gokhan@gkandemir.com'
      // }
      // return axios.get("url")
      //     .then(response => {
      //         return false
      //     })
      // return value !== 'gokhan@gkandemir.com'
    },
    password: {
      required,

      minLength: minLength(8),
      maxLength: maxLength(18),
    },
  },
  computed:{
    ...mapGetters(["getSetting","isAdmin"])
  },
  methods: {
    async login() {
      this.loading = true;
      this.errors = null;

      await axios.get("/sanctum/csrf-cookie");
      await axios
        .post("/login", {
          email: this.email,
          password: this.password,
        })
        .then((res) => {
          if (res.status == 204) {
            logIn();
            this.$store.dispatch("loadUser").then(()=> this.$router.push({ name: "admin" }));
           
          }
        })
        .catch((error) => {
          this.errors = error.response && error.response.data.errors;
        });
      this.loading = false;
    },
  },

  mounted() {
    var jQueryAppearA = document.createElement("script");
    jQueryAppearA.setAttribute("src", "admin/vendor/jquery/jquery.js");
    document.body.appendChild(jQueryAppearA);

    var jQueryAppearB = document.createElement("script");
    jQueryAppearB.setAttribute("src", "admin/vendor/jquery/jquery.js");
    document.body.appendChild(jQueryAppearB);

    var jQueryAppearC = document.createElement("script");
    jQueryAppearC.setAttribute(
      "src",
      "admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js"
    );
    document.body.appendChild(jQueryAppearC);

    /*  var jQueryAppearD = document.createElement("script");
    jQueryAppearD.setAttribute("src", "admin/vendor/jquery-cookie/jquery.cookie.js");
    document.body.appendChild(jQueryAppearD); */

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
    /*
    var jQueryAppearH = document.createElement("script");
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

    /*    var jQueryAppearM = document.createElement("script");
    jQueryAppearM.setAttribute("src", "admin/vendor/modernizr/modernizr.js");
    document.head.appendChild(jQueryAppearM); */

    var jQueryAppearN = document.createElement("script");
    jQueryAppearN.setAttribute("src", "admin/js/theme.js");
    document.body.appendChild(jQueryAppearN);

    /*     var jQueryAppearO = document.createElement("script");
    jQueryAppearO.setAttribute("src", "admin/js/theme.init.js");
    document.body.appendChild(jQueryAppearO); */

    /*  var jQueryAppearP = document.createElement("script");
    jQueryAppearP.setAttribute(
      "src",
      "admin/master/style-switcher/style.switcher.localstorage.js"
    );
    document.body.appendChild(jQueryAppearP);

    var jQueryAppearR = document.createElement("script");
    jQueryAppearR.setAttribute("src", "admin/master/style-switcher/style.switcher.js");
    document.head.appendChild(jQueryAppearR);
 */
  },
  /* beforeDestroy() {
    var scripts = $("script[src^='admin/']");
    var filteredScripts = [];
    for (let i = 1; i < 15; i++) {
      filteredScripts.push(scripts[i]);
    }
    for (let i = 0; i < filteredScripts.length; i++) {
      document.body.removeChild(filteredScripts[i]);
    }
  }, */
};
</script>

<style lang="scss" scoped></style>
