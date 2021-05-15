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
                  <img :src="showImage ? showImage : 'storage/'+getUser.profile.avatar" />
                  <span class="profile-image-button bg-color-dark">
                    <i class="fas fa-camera text-light"></i>
                  </span>
                </div>
                <input @change="uploadImage" type="file" id="file" class="form-control profile-image-input" />
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
            <ProfileMain v-if="profile" @saveProfile='saveProfile' :form='getUser.profile' :user='getUser'></ProfileMain>
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
import { mapGetters} from 'vuex'
import { inputError } from "./../../shared/utils/response";
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
      image:'',
      showImage:'',
      
    };
  },
  computed:{
     ...mapGetters([
      "getUser",
    ]),
  },
  methods: {
    uploadImage(e){
        let file=e.target.files[0]
        this.image=file
        this.showImage=URL.createObjectURL(file);
      
    },
    async saveProfile(payload){
   
      let formData=new FormData();
      if (this.image) {
        formData.append('avatar',this.image)
         }
       
      formData.append('user_id',this.getUser.id),
        formData.append('about',payload.form.about),
        formData.append('facebook',payload.form.facebook),
        formData.append('instagram',payload.form.instagram),
        formData.append('twitter',payload.form.twitter),
        formData.append('youtube',payload.form.youtube),
        formData.append('web',payload.form.web),
        formData.append('linkedIn',payload.form.linkedIn),
        formData.append('name',payload.user.name),
        formData.append('email',payload.user.email),
        await axios.post('/api/profile',formData).then((res)=>{
          this.formProfile=res.data;
          this.getUser.profile = this.formProfile;
          this.$store.commit('setUser',this.getUser);
          
          Swal.fire("Kaydedildi!", "Profiliniz Başarılı bir şekilde kaydedildi.", "success");
        }).catch((err)=>{ 
              inputError(Object.values(err.response.data.errors));
             
           
    })
    },
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
