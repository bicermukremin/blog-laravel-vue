<template>
  <header
    id="header"
    class="header-narrow header-semi-transparent-light"
    data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 1, 'stickySetTop': '1'}"
  >
    <div class="header-body">
      <div class="header-container container">
        <div class="header-row">
          <div class="header-column">
            <div class="header-row">
              <div class="header-logo">
                <router-link :to="{ name: 'frontend' }">
                  <img
                    class="logo-default"
                    alt="Porto"
                    width="324"
                    height="212"
                    :src="'/storage/' + getSetting.logo1"
                  />
                </router-link>
                <router-link :to="{ name: 'frontend' }">
                  <img
                    class="logo-small"
                    alt="Porto"
                    width="131"
                    height="48"
                    :src="'/storage/' + getSetting.logo2"
                  />
                </router-link>
              </div>
            </div>
          </div>
          <div class="header-column justify-content-end">
            <div class="header-row">
              <div class="header-nav header-nav-stripe order-2 order-lg-1">
                <div
                  class="header-nav-main header-nav-main-square header-nav-main-effect-1 header-nav-main-sub-effect-1"
                >
                  <nav class="collapse">
                    <ul class="nav nav-pills" id="mainNav">
                      <li>
                        <router-link
                          exact
                          class="nav-link active"
                          :to="{ name: 'frontend' }"
                        >
                          Anasayfa
                        </router-link>
                      </li>
                      <li>
                        <router-link class="nav-link" :to="{ name: 'hakkimizda' }">
                          Hakkımızda
                        </router-link>
                      </li>
                      <li class="dropdown">
                        <router-link
                          class="nav-link dropdown-toggle"
                          :to="{ name: 'hizmet' }"
                        >
                          Hizmetlerimiz
                        </router-link>
                        <ul class="dropdown-menu">
                          <li v-for="service in getServices" :key="service.id">
                            <router-link
                              :to="{
                                name: 'singleService',
                                params: { slugService: service.slug, service: service },
                              }"
                              class="dropdown-item"
                              >{{ service.title }}</router-link
                            >
                          </li>
                        </ul>
                      </li>
                      <li>
                        <router-link :to="{ name: 'projelerimiz' }" class="nav-link">
                          Projelerimiz
                        </router-link>
                      </li>
                     <!--  <li>
                        <router-link :to="{ name: 'haber' }" class="nav-link">
                          Blog
                        </router-link>
                      </li> -->
                      <li>
                        <router-link :to="{ name: 'bizeulasin' }" class="nav-link">
                          Bize Ulaşın
                        </router-link>
                      </li>
                      <li class="dropdown">
                        <a
                          href="#"
                          title="Kullanıcı Hesabım"
                          class="nav-link dropdown-toggle"
                          ><i class="far fa-user"></i
                        ></a>
                        <ul class="dropdown-menu">
                          <li v-if="!auth">
                            <router-link
                              class="dropdown-item"
                              :to="{
                                name: 'auth',
                                params: { user: true },
                              }"
                              >Giriş Yap</router-link
                            >
                          </li>
                          <li v-if="!auth">
                            <router-link
                              class="dropdown-item"
                              :to="{
                                name: 'auth-register',
                                params: { user: false },
                              }"
                              >Kayıt Ol</router-link
                            >
                          </li>
                          <li v-if="auth">
                            <a href="#" class="dropdown-item">{{ getUser.name }}</a>
                          </li>
                          <li v-if="auth">
                            <a href="#" class="dropdown-item" @click.prevent="logout"
                              >Çıkış Yap</a
                            >
                          </li>
                          <!--   <li v-if="auth">
                            <router-link
                              :to="{ name: 'profile', params: { user: getUser.id } }"
                              class="dropdown-item"
                              >Profilim</router-link
                            >
                          </li> -->
                        </ul>
                      </li>
                    </ul>
                  </nav>
                </div>
                <button
                  class="btn header-btn-collapse-nav"
                  data-toggle="collapse"
                  data-target=".header-nav-main nav"
                >
                  <i class="fas fa-bars"></i>
                </button>
              </div>
              <div
                class="header-nav-features header-nav-features-no-border d-none d-sm-block order-1 order-lg-2"
              >
                <ul
                  class="header-social-icons social-icons d-none d-sm-block social-icons-clean ml-0"
                >
                  <li class="social-icons-facebook">
                    <a :href="getSetting.facebook" target="_blank" title="Facebook"
                      ><i class="fab fa-facebook-f"></i
                    ></a>
                  </li>
                  <li class="social-icons-instagram">
                    <a :href="getSetting.instagram" target="_blank" title="İnstagram"
                      ><i class="fab fa-instagram"></i
                    ></a>
                  </li>
                  <li class="social-icons-twitter">
                    <a :href="getSetting.twitter" target="_blank" title="Twitter"
                      ><i class="fab fa-twitter"></i
                    ></a>
                  </li>
                  <li class="social-icons-linkedin">
                    <a :href="getSetting.linkedIn" target="_blank" title="Linkedin"
                      ><i class="fab fa-linkedin-in"></i
                    ></a>
                  </li>
                  <li class="social-icons-github">
                    <a :href="getSetting.github" target="_blank" title="Github"
                      ><i class="fab fa-github"></i
                    ></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["getServices", "getSetting", "isLoggedIn", "getUser"]),
    auth() {
      return this.isLoggedIn && localStorage.getItem("isLoggedIn");
    },
  },
  methods: {
    async logout() {
      await axios.post("/logout").then((res) => {
        this.$store
          .dispatch("logout")
          .then(() => this.$router.push("/"))
          .then(() => this.$toast.success("Başarılı bir şekilde çıkış yaptınız."))
          .catch(() => this.$toast.error("Sayfayı yenileyin ve tekrar deneyiniz."));
      });
    },
  },
  beforeCreate() {
    this.$store.dispatch("initService", { filter: null });
  },
};
</script>

<style lang="scss" scoped></style>
