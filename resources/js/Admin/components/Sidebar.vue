<template>
  <aside id="sidebar-left" class="sidebar-left">
    <div class="sidebar-header">
      <div class="sidebar-title">Navigation</div>
      <div
        class="sidebar-toggle d-none d-md-block"
        data-toggle-class="sidebar-left-collapsed"
        data-target="html"
        data-fire-event="sidebar-left-toggle"
      >
        <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
      </div>
    </div>

    <div class="nano">
      <div class="nano-content">
        <nav id="menu" class="nav-main" role="navigation">
          <ul class="nav nav-main">
            <li>
              <router-link class="nav-link" :to="{ name: 'admin' }">
                <i class="bx bx-home-alt my-dash" aria-hidden="true"></i>
                <span>Anasayfa</span>
              </router-link>
            </li>
            <li class="pointer">
              <a class="nav-link" @click.prevent="toFrontPage">
                <i class="bx bx-layout my-web" aria-hidden="true"></i>
                <span>Web Sitem</span>
              </a>
            </li>

            <li>
              <router-link
                :to="{ name: 'ayarlar' }"
                class="nav-link"
                
              >
                <i class="bx bx-loader-circle my-serve" aria-hidden="true"></i>
                <span>Ayarlar</span>
              </router-link>
            </li>
            <li>
              <router-link
                :to="{ name: 'services' }"
                class="nav-link"
               
              >
                <i class="bx bx-loader-circle my-serve" aria-hidden="true"></i>
                <span>Hizmetlerimiz</span>
              </router-link>
            </li>
            <li>
              <router-link
                :to="{ name: 'slider' }"
                class="nav-link"
               
              >
                <i class="bx bx-loader-circle my-serve" aria-hidden="true"></i>
                <span>Slaytlar</span>
              </router-link>
            </li>

            <li>
              <router-link :to="{ name: 'about' }" class="nav-link">
                <i class="bx bx-loader-circle my-serve" aria-hidden="true"></i>
                Hakkımızda
              </router-link>
            </li>

            <li>
              <router-link :to="{ name: 'blog' }" class="nav-link">
                <i class="bx bx-loader-circle my-serve" aria-hidden="true"></i>
                <span>Blog</span>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'project' }" class="nav-link">
                <i class="bx bx-loader-circle my-serve" aria-hidden="true"></i>
                <span>Projelerimiz</span>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'banner' }" class="nav-link">
                <i class="bx bx-loader-circle my-serve" aria-hidden="true"></i>
                <span>Bannerlar</span>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'mail' }" class="nav-link">
                <i class="bx bx-loader-circle my-serve" aria-hidden="true"></i>
                <span>Mailler</span>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'abone' }" class="nav-link">
                <i class="bx bx-loader-circle my-serve" aria-hidden="true"></i>
                <span>Aboneler</span>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'category' }" class="nav-link">
                <i class="bx bx-loader-circle my-serve" aria-hidden="true"></i>
                <span>Blog Kategorileri</span>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'comment' }" class="nav-link">
                <i class="bx bx-loader-circle my-serve" aria-hidden="true"></i>
                <span>Blog Yorumlar</span>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'reply' }" class="nav-link">
                <i class="bx bx-loader-circle my-serve" aria-hidden="true"></i>
                <span>Blog Yorum Cevapları</span>
              </router-link>
            </li>
          </ul>
        </nav>

        <hr class="separator" />

        <!--         <div class="sidebar-widget widget-tasks">
          <div class="widget-header">
            <h6>Projects</h6>
            <div class="widget-toggle">+</div>
          </div>
          <div class="widget-content">
            <ul class="list-unstyled m-0">
              <li><a href="#">Porto HTML5 Template</a></li>
              <li><a href="#">Tucson Template</a></li>
              <li><a href="#">Porto Admin</a></li>
            </ul>
          </div>
        </div> -->

        <hr class="separator" />

        <!--  <div class="sidebar-widget widget-stats">
          <div class="widget-header">
            <h6>Company Stats</h6>
            <div class="widget-toggle">+</div>
          </div>
          <div class="widget-content">
            <ul>
              <li>
                <span class="stats-title">Stat 1</span>
                <span class="stats-complete">85%</span>
                <div class="progress">
                  <div
                    class="progress-bar progress-bar-primary progress-without-number"
                    role="progressbar"
                    aria-valuenow="85"
                    aria-valuemin="0"
                    aria-valuemax="100"
                    style="width: 85%"
                  >
                    <span class="sr-only">85% Complete</span>
                  </div>
                </div>
              </li>
              <li>
                <span class="stats-title">Stat 2</span>
                <span class="stats-complete">70%</span>
                <div class="progress">
                  <div
                    class="progress-bar progress-bar-primary progress-without-number"
                    role="progressbar"
                    aria-valuenow="70"
                    aria-valuemin="0"
                    aria-valuemax="100"
                    style="width: 70%"
                  >
                    <span class="sr-only">70% Complete</span>
                  </div>
                </div>
              </li>
              <li>
                <span class="stats-title">Stat 3</span>
                <span class="stats-complete">2%</span>
                <div class="progress">
                  <div
                    class="progress-bar progress-bar-primary progress-without-number"
                    role="progressbar"
                    aria-valuenow="2"
                    aria-valuemin="0"
                    aria-valuemax="100"
                    style="width: 2%"
                  >
                    <span class="sr-only">2% Complete</span>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div> -->
      </div>
    </div>
  </aside>
</template>

<script>
export default {
  mounted() {
    if (typeof localStorage !== "undefined") {
      if (localStorage.getItem("sidebar-left-position") !== null) {
        var initialPosition = localStorage.getItem("sidebar-left-position"),
          sidebarLeft = document.querySelector("#sidebar-left .nano-content");

        sidebarLeft.scrollTop = initialPosition;
      }
    }
  },
  methods: {
    toFrontPage() {
      window.location.href = "http://mukreminbicer.com/";
    },
  },
};
</script>

<style lang="scss" scoped>
.my-dash {
  color: #2d83da;
}
.my-web {
  color: #f06c20;
}
.my-serve {
  color: #50f020;
}
.pointer {
  cursor: pointer;
}
</style>
