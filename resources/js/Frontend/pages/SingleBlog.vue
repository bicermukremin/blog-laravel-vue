<template>
  <div class="body">
    <Header></Header>
    <section class="section section-tertiary secPart section-no-border pb-3 mt-0">
      <div class="container">
        <div class="row justify-content-end mt-4">
          <div class="col-lg-10 pt-4 mt-4 text-right">
            <h1 class="text-uppercase font-weight-light mt-4 pt-3 text-color-primary">
              Blog-{{ getBlog.title }}
            </h1>
          </div>
        </div>
      </div>
    </section>

    <div class="container">
      <div class="row pt-2">
        <div class="col">
          <div class="blog-posts single-post mt-4">
            <article class="post post-large blog-single-post">
              <div class="post-date">
                <span class="day">{{ getBlog.created_at | day }}</span>
                <span class="month">{{ getBlog.created_at | month }}</span>
              </div>

              <div class="post-content">
                <h1 class="mb-3 font-weight-bold text-7">{{ getBlog.title }}</h1>

                <div class="post-meta">
                  <span
                    ><i class="far fa-user"></i> By
                    <a href="#">{{ getBlog.author.name }}</a>
                  </span>
                  <span
                    ><i class="far fa-folder"></i>
                    <a
                      href="#"
                      v-for="category in getBlog.categories"
                      :key="category.id"
                      >{{ category.name }}</a
                    >,
                  </span>
                  <span
                    ><i class="far fa-comments"></i>
                    <a href="#">{{ getBlog.comments.length }} Yorum</a></span
                  >
                </div>

                <img
                  :src="`storage/${getBlog.image}`"
                  class="img-fluid float-right mb-3 mb-1 ml-sm-4 ml-lg-5"
                  :alt="getBlog.title"
                  style="width: 360px"
                />

                <p class="lead" v-html="getBlog.description"></p>

                <div class="pt-2 pb-1">
                  <!-- AddThis Button BEGIN -->
                  <div class="addthis_toolbox addthis_default_style">
                    <a
                      class="addthis_button_facebook_like"
                      fb:like:layout="button_count"
                    ></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_pinterest_pinit"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                  </div>
                  <!-- <script
                    type="text/javascript"
                    src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50faf75173aadc53"
                  ></script> -->
                  <!-- AddThis Button END -->
                </div>

                <div class="post-block post-author mt-4 clearfix">
                  <h4 class="mt-4 mb-3">Yazar</h4>
                  <div class="img-thumbnail d-block">
                    <a href="#">
                      <img :src="'storage/'+getBlog.author.profile.avatar" :alt="getBlog.author.name" />
                    </a>
                  </div>
                  <p>
                    <strong class="name mb-3">{{ getBlog.author.name }}</strong>
                  </p>
                  <p class="mt-1" v-html="getBlog.author_description"></p>
                </div>

                <div class="post-block post-comments clearfix">
                  <h4 class="mt-4 mb-3">Yorumlar</h4>

                  <ul class="comments" v-if="getBlog.comments.length">
                    <li v-for="comment in getBlog.comments" :key="comment.id">
                      <div class="comment">
                        <div class="img-thumbnail d-none d-sm-block">
                          <img class="avatar" :alt="comment.user.name" :src="'storage/'+comment.user.profile.avatar" />
                        </div>
                        <div class="comment-block">
                          <div class="comment-arrow"></div>
                          <span class="comment-by">
                            <strong>{{ comment.user.name }}</strong>
                            <span class="float-right">
                              <span
                                v-if="
                                  !comRep &&
                                  isLoggedIn &&
                                  canComReply.includes(comment.user.id)
                                "
                              >
                                <a
                                  :name="'@' + comment.user.name + ''"
                                  :id="comment.id"
                                  :userId="comment.user.id"
                                  href="#"
                                  @click.prevent="comYanitla"
                                  ><i class="fas fa-reply"></i> Yanıtla</a
                                ></span
                              >
                              <span v-if="!comRep && !isLoggedIn">
                                Yanıtlamak için
                                <router-link
                                  tag="button"
                                  :to="{ name: 'auth', params: { user: true } }"
                                  class="btn btn-primary btn-xs"
                                  >Oturum Aç</router-link
                                >

                                <router-link
                                  tag="button"
                                  :to="{
                                    name: 'auth-register',
                                    params: { user: false },
                                  }"
                                  class="btn btn-default btn-xs"
                                  >Üye Ol</router-link
                                >
                              </span>
                              <span v-if="comRep && comId == comment.id">
                                <a
                                  :name="'@' + comment.user.name + ''"
                                  :id="comment.id"
                                  :userId="comment.user.id"
                                  href="#"
                                  @click.prevent="comYanitla"
                                  ><i class="fas fa-reply"></i> İptal</a
                                ></span
                              >
                            </span>
                          </span>
                          <p v-html="comment.description"></p>

                          <span class="date float-right">{{ comment.fromNow }}</span>
                        </div>
                      </div>
                      <ul class="comments reply">
                        <li>
                          <div class="comment" v-if="comRep && comId == comment.id">
                            <textarea
                              v-model="commentReply"
                              maxlength="5000"
                              rows="2"
                              class="form-control bord"
                              name="comment"
                              id="comment"
                            ></textarea>
                            <button
                              @click.prevent="commReply(comment.id)"
                              class="btn btn-lg btn-primary mt-2 float-right bord"
                            >
                              <span v-if="loading">
                            <i class="fas fa-circle-notch fa-spin"></i> Gönderiliyor...
                          </span>
                              <span v-else>Cevapla</span>
                            </button>
                          </div>
                        </li>
                      </ul>
                      <ul class="comments reply" v-if="comment.replies.length">
                        <li v-for="reply in comment.replies" :key="reply.id">
                          <div class="comment">
                            <div class="img-thumbnail d-none d-sm-block">
                              <img class="avatar" :alt="reply.reply_user.name" :src="'storage/'+reply.reply_user.profile.avatar" />
                            </div>
                            <div class="comment-block">
                              <div class="comment-arrow"></div>
                              <span class="comment-by">
                                <strong>{{ reply.reply_user.name }}</strong>
                                <span class="float-right">
                                  <span
                                    v-if="
                                      !repRep &&
                                      isLoggedIn &&
                                      canReply.includes(reply.reply_user.id)
                                    "
                                  >
                                    <a
                                      :name="'@' + reply.reply_user.name + ''"
                                      :id="reply.id"
                                      :userId="reply.reply_user.id"
                                      href="#"
                                      @click.prevent="repYanitla"
                                      ><i class="fas fa-reply"></i>Yanıtla</a
                                    ></span
                                  >
                                  <span v-if="!repRep && !isLoggedIn">
                                    Yanıtlamak için
                                    <router-link
                                      tag="button"
                                      :to="{ name: 'auth', params: { user: true } }"
                                      class="btn btn-primary btn-xs"
                                      >Oturum Aç</router-link
                                    >

                                    <router-link
                                      tag="button"
                                      :to="{
                                        name: 'auth-register',
                                        params: { user: false },
                                      }"
                                      class="btn btn-default btn-xs"
                                      >Üye Ol</router-link
                                    >
                                  </span>
                                  <span v-if="repRep && repId == reply.id">
                                    <a
                                      :name="'@' + reply.reply_user.name + ''"
                                      :id="reply.id"
                                      :userId="reply.reply_user.id"
                                      href="#"
                                      @click.prevent="repYanitla"
                                      ><i class="fas fa-reply"></i> İptal</a
                                    ></span
                                  >
                                </span>
                              </span>
                              <p v-html="reply.description"></p>

                              <span class="date float-right">{{ reply.fromNow }}</span>
                            </div>
                          </div>
                          <ul class="comments reply">
                            <li>
                              <div class="comment" v-if="repRep && repId == reply.id">
                                <textarea
                                  v-model="replyReply"
                                  maxlength="5000"
                                  rows="2"
                                  class="form-control bord"
                                  name="comment"
                                  id="comment"
                                ></textarea>
                                <button
                                  @click.prevent="repReply(reply.id)"
                                  class="btn btn-lg btn-primary mt-2 float-right"
                                >
                                  <span v-if="loading">
                            <i class="fas fa-circle-notch fa-spin"></i> Gönderiliyor...
                          </span>
                              <span v-else>Cevapla</span>
                            </button>
                               
                              </div>
                            </li>
                          </ul>
                          <ul class="comments reply" v-if="reply.reply_replies.length > 0">
                            <li v-for="reply in reply.reply_replies" :key="reply.id">
                              <div class="comment">
                                <div class="img-thumbnail d-none d-sm-block">
                                  <img class="avatar" :alt="reply.reply_reply_user.name" :src="'storage/'+reply.reply_reply_user.profile.avatar" />
                                </div>
                                <div class="comment-block">
                                  <div class="comment-arrow"></div>
                                  <span class="comment-by">
                                    <strong>{{ reply.reply_reply_user.name }}</strong>
                                  </span>
                                  <p v-html="reply.description"></p>

                                  <span class="date float-right">{{
                                    reply.fromNow
                                  }}</span>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <div v-else>
                    <p class="mt-1">Henüz yorum yapılmamıştır. İlk yorum yapan sen ol!</p>
                  </div>
                </div>

                  <div v-if="getUser.id!=getBlog.author.id">
                    <div v-if="canComment" class="post-block post-leave-comment mb-4">
                  <h4 class="mb-3">Yorum Yap</h4>

                  <form>
                    <div class="form-row">
                      <div class="form-group col-lg-6">
                        <label>İsminiz *</label>
                        <input
                          v-model="form.ad_soyad"
                          @blur="$v.form.ad_soyad.$touch()"
                          type="text"
                          value=""
                          maxlength="100"
                          class="form-control"
                          name="name"
                          id="name"
                          :class="{ 'is-invalid': $v.form.ad_soyad.$error }"
                        />
                        <small
                          v-if="!$v.form.ad_soyad.minLength"
                          class="form-text text-danger"
                          >Lütfen isminiz en az
                          {{ $v.form.ad_soyad.$params.minLength.min }} karakterden
                          oluşmalıdır...
                        </small>
                        <small
                          v-if="!$v.form.ad_soyad.maxLength"
                          class="form-text text-danger"
                          >Lütfen isminiz en fazla
                          {{ $v.form.ad_soyad.$params.maxLength.max }} karakterden
                          oluşmalıdır...
                        </small>
                      </div>
                      <div class="form-group col-lg-6">
                        <label>Mail Adresiniz *</label>
                        <input
                          v-model="form.email"
                          @blur="$v.form.email.$touch()"
                          type="email"
                          value=""
                          maxlength="100"
                          class="form-control"
                          name="email"
                          :class="{ 'is-invalid': $v.form.email.$error }"
                        />
                        <small v-if="!$v.form.email.email" class="form-text text-danger"
                          >Lütfen geçerli bir e-posta adresi giriniz...
                        </small>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col">
                        <label>Yorum *</label>
                        <textarea
                          v-model="form.description"
                          @blur="$v.form.description.$touch()"
                          maxlength="5000"
                          rows="10"
                          class="form-control"
                          name="comment"
                          id="comment"
                          :class="{ 'is-invalid': $v.form.description.$error }"
                        ></textarea>
                        <small
                          v-if="!$v.form.description.minLength"
                          class="form-text text-danger"
                          >Lütfen mesaj kısmı en az
                          {{ $v.form.description.$params.minLength.min }} karakterden
                          oluşmalıdır...
                        </small>
                        <small
                          v-if="!$v.form.description.maxLength"
                          class="form-text text-danger"
                          >Lütfen mesaj kısmı en fazla
                          {{ $v.form.description.$params.maxLength.max }} karakterden
                          oluşmalıdır...
                        </small>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col">
                        <button
                          @click.prevent="sendMail"
                          :disabled="$v.$invalid"
                          class="btn btn-lg btn-primary mb-4"
                        >
                          <span v-if="deleting">
                            <i class="fas fa-circle-notch fa-spin"></i> Gönderiliyor...
                          </span>
                          <span v-else>Mesaj Gönder</span>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
                <div v-else class="post-block post-leave-comment mb-4">
                  <div class="col-md-12">
                    <div class="alert alert-warning">
                      <strong>Yorum yapabilmek</strong> için öncelikle üye olmanız
                      gerekmekedir.
                      <router-link
                        tag="button"
                        :to="{ name: 'auth', params: { user: true } }"
                        class="btn btn-success"
                        >Oturum Aç</router-link
                      >
                      <router-link
                        tag="button"
                        :to="{ name: 'auth-register', params: { user: false } }"
                        class="btn btn-secondary"
                        >Üye Ol</router-link
                      >
                    </div>
                  </div>
                </div>
                  </div>
              </div>
            </article>
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
import {
  required,
  email,
  numeric,
  minLength,
  maxLength,
  sameAs,
  between,
} from "vuelidate/lib/validators";
export default {
  components: {
    Header,
    Footer,
  },
  validations: {
    form: {
      ad_soyad: {
        required,
        minLength: minLength(5),
        maxLength: maxLength(70),
      },
      description: {
        required,
        minLength: minLength(15),
        maxLength: maxLength(400),
      },
      email: {
        required,
        email,
      },
    },
  },
  data() {
    return {
      loading:false,
      commentUser: "",
      comRep: false,
      repRep: false,
      comId: "",
      repId: "",
      comUserId: "",
      repUserId: "",
      commentReply: "",
      replyReply: "",
      form: {
        ad_soyad: this.$store.state.user.user.name,
        email: this.$store.state.user.user.email,
        description: "",
      },
      successAlert: false,
      errorAlert: false,
      deleting: false,
    };
  },
  computed: {
    ...mapGetters(["isLoggedIn", "getUser", "getBlogs"]),
    canComment() {
      return this.isLoggedIn && this.getUser.id != this.getBlog.author.id;
    },
  
    canComReply() {
      let commentsUsersIds = this.getBlog.comments.map((el) => el.user.id);

      return commentsUsersIds.filter((el) => el != this.getUser.id);
    },
    canReply() {
      let replies = this.getBlog.comments.map((el) => el.replies);
      let repies = [];

      for (let i = 0; i < replies.length; i++) {
        for (let x = 0; x < replies[i].length; x++) {
          repies.push(replies[i][x]);
        }
      }
      let repiesUsers = repies.map((el) => el.reply_user.id);
      return repiesUsers.filter((el) => el != this.getUser.id);
    },
    getBlog() {
      return this.$store.getters["getBlog"](this.$route.params.slug)[0];
    },
 /*    getDay() {
      return this.getBlog.createdAt.substring(0, 2);
    },
    getMonth() {
      return this.getBlog.createdAt.substring(6, 3);
    }, */
  },
  methods: {
    async sendMail() {
      this.deleting = true;
      this.form.from = "bicermukremin86@gmail.com";
      this.form.blog_id = this.getBlog.id;
      this.form.user_id = this.getUser.id;
      await axios
        .post("/api/make-com", this.form)
        .then((res) => {
          this.deleting = false;
          this.successAlert = true;
          this.form = {};
          this.getBlog.comments = res.data;
          let index = this.getBlogs.findIndex((blog) => {
            blog.id = this.form.blog_id;
          });
       
          let blogUpdate = this.getBlog;
          this.$store.commit("updateBlog", { blogUpdate, index })
          this.$toast.success("Mesajınız başarıyla gönderilmiştir.");
        })
        .catch((e) => {
          this.deleting = false;
          this.errorAlert = true;
          this.$toast.error("Mesajınız gönderilemedi");
        
        });
    },
    comYanitla(e) {
      this.comRep = !this.comRep;
      this.comId = e.currentTarget.id;
      this.comUserId = e.currentTarget.userId;
      this.commentReply = e.currentTarget.name;
    },
    repYanitla(e) {
      this.repRep = !this.repRep;
      this.repId = e.currentTarget.id;
      this.repUserId = e.currentTarget.userId;
      this.replyReply = e.currentTarget.name;
    },
    async commReply(id) {
      this.loading=true;
      const formData = new FormData();
      formData.append("user_id", this.getUser.id);
      formData.append("comment_id", id);
      formData.append("description", this.commentReply);
      this.$store.dispatch("saveReply", formData).then(() => {
        let blogUpdate = this.$store.state.reply.blogReply;
        let index = this.$store.state.reply.blogIndex;
        this.$store.commit("updateBlog", { blogUpdate, index });
        this.comRep = false;
        this.loading=false;
        this.commentReply = "";
        this.$toast.info("Yanıtınız başarıyla eklenmiştir.");
      });
    },
    async repReply(repid) {
      this.loading=true;
      const formData = new FormData();
      formData.append("user_id", this.getUser.id);
      formData.append("reply_id", repid);
      formData.append("description", this.replyReply);
     
      this.$store.dispatch("saveReplyReply", formData).then(() => {
        let blogUpdate = this.$store.state.reply.blogReply;
        let index = this.$store.state.reply.blogIndex;
        this.$store.commit("updateBlog", { blogUpdate, index });
        
        this.repRep = false;
        this.loading=false;
        this.replyReply = "";
        this.$toast.info("Yanıtınız başarıyla eklenmiştir.");
      });
    },
  },
  created() {},
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
.bord {
  border: 3px solid #e04622;
  padding: 10px !important;
  border-radius: 25px !important;
}
</style>
