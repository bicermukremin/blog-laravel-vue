<template>
  <div class="body">
    <Header></Header>
    <div role="main" class="main">
      <section class="section section-tertiary secPart section-no-border pb-3 mt-0">
        <div class="container">
          <div class="row justify-content-end mt-4">
            <div class="col-lg-10 pt-4 mt-4 text-right">
              <h1 class="text-uppercase font-weight-light mt-4 pt-3 text-color-primary">
                Profilim
              </h1>
            </div>
          </div>
        </div>
      </section>

      <div class="container pt-3 pb-2">
        <div class="row pt-2">
          <div class="col-lg-3 mt-4 mt-lg-0">
            <div class="d-flex justify-content-center mb-4">
              <div class="profile-image-outer-container">
                <div class="profile-image-inner-container bg-color-primary">
                  <img src="img/avatars/avatar.jpg" />
                  <span class="profile-image-button bg-color-dark">
                    <i class="fas fa-camera text-light"></i>
                  </span>
                </div>
                <input type="file" id="file" class="form-control profile-image-input" />
              </div>
            </div>

            <aside class="sidebar mt-2" id="sidebar">
              <ul class="nav nav-list flex-column mb-5">
                <li class="nav-item">
                  <a
                    class="nav-link text-3 text-dark"
                    :class="{ active: profile }"
                    href="#"
                    name="profile"
                    @click.prevent="menu"
                    >Profilim</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link text-3"
                    :class="{ active: sifre }"
                    href="#"
                    name="sifre"
                    @click.prevent="menu"
                    >Şifre Değiştirme</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link text-3"
                    href="#"
                    :class="{ active: bloglarim }"
                    name="bloglarim"
                    @click.prevent="menu"
                    >Bloglarım</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link text-3"
                    href="#"
                    name="yorumlarim"
                    :class="{ active: yorumlarim }"
                    @click.prevent="menu"
                    >Yorumlarım</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link text-3"
                    href="#"
                    name="yanitlarim"
                    :class="{ active: yanitlarim }"
                    @click.prevent="menu"
                    >Yanıtlarım</a
                  >
                </li>
              </ul>
            </aside>
          </div>
          <div class="col-lg-9">
            <ProfileMain v-if="profile"></ProfileMain>
            <ProfileBlog v-if="bloglarim"></ProfileBlog>
            <ProfileComment v-if="yorumlarim"></ProfileComment>
            <ProfileReply v-if="yanitlarim"></ProfileReply>
            <ProfilePassword v-if="sifre"></ProfilePassword>
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
import ProfileMain from "./../components/ProfileMain";
import ProfileBlog from "./../components/ProfileBlog";
import ProfileComment from "./../components/ProfileComment";
import ProfileReply from "./../components/ProfileReply";
import ProfilePassword from "./../components/ProfilePassword";
export default {
  components: {
    Header,
    Footer,
    ProfileBlog,
    ProfileMain,
    ProfileComment,
    ProfileReply,
    ProfilePassword,
  },
  data() {
    return {
      profile: true,
      sifre: false,
      yorumlarim: false,
      bloglarim: false,
      yanitlarim: false,
    };
  },
  methods: {
    menu(e) {
      if (e.currentTarget.name == "profile") {
        this.profile = true;
        this.sifre = false;
        this.bloglarim = false;
        this.yanitlarim = false;
        this.yorumlarim = false;
      } else if (e.currentTarget.name == "bloglarim") {
        this.profile = false;
        this.sifre = false;
        this.bloglarim = true;
        this.yanitlarim = false;
        this.yorumlarim = false;
      } else if (e.currentTarget.name == "sifre") {
        this.profile = false;
        this.sifre = true;
        this.bloglarim = false;
        this.yanitlarim = false;
        this.yorumlarim = false;
      } else if (e.currentTarget.name == "yorumlarim") {
        this.profile = false;
        this.sifre = false;
        this.bloglarim = false;
        this.yanitlarim = false;
        this.yorumlarim = true;
      } else if (e.currentTarget.name == "yanitlarim") {
        this.profile = false;
        this.sifre = false;
        this.bloglarim = false;
        this.yanitlarim = true;
        this.yorumlarim = false;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.secPart {
  background-color: #220c3c !important;
}
</style>
