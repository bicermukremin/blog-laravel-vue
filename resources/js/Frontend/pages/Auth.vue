<template>
  <div class="container">
    <div class="row mt-5">
      <div
        class="col-md-4 offset-4 card card-primary p-3 border"
        :class="{ 'border-primary': isUser, 'border-success': !isUser }"
      >
        <h3
          :class="{ 'text-primary': isUser, 'text-success': !isUser }"
          class="text-center mb-3 mt-3"
        >
          <img height="100px" :src="`storage/${getSetting.logo2}`" alt="" />|
          {{ isUser ? "Giriş" : "Kayıt" }}
        </h3>
        <hr />
        <form>
          <div class="form-group" v-if="!isUser">
            <label>İsim Soyisim</label>
            <input
              v-model="user.name"
              type="email"
              class="form-control"
              placeholder="E-posta adresinizi giriniz"
              @blur="$v.user.name.$touch()"
              :class="[{ 'is-invalid': errorFor('name') || $v.user.name.$error }]"
            />
            <small v-if="!$v.user.name.minLength" class="form-text text-danger"
              >Lütfen isim kısmı en az {{ $v.user.name.minLength.min }} karakterden
              oluşmalıdır...
            </small>
            <small v-if="!$v.user.name.maxLength" class="form-text text-danger"
              >Lütfen isim kısmı en fazla
              {{ $v.user.name.$params.maxLength.min }} karakterden oluşmalıdır...
            </small>

            <v-errors :errors="errorFor('name')"></v-errors>
          </div>
          <div class="form-group">
            <label>E-posta Adresiniz</label>
            <input
              v-model="user.email"
              type="email"
              class="form-control"
              placeholder="E-posta adresinizi giriniz"
              @blur="$v.user.email.$touch()"
              :class="[{ 'is-invalid': errorFor('email') || $v.user.email.$error }]"
            />
            <small v-if="!$v.user.email.email" class="form-text text-danger"
              >Lütfen geçerli bir e-posta adresi giriniz...
            </small>
            <v-errors :errors="errorFor('email')"></v-errors>
          </div>
          <div class="form-group">
            <label>Şifre</label>
            <input
              v-model="user.password"
              type="password"
              class="form-control"
              placeholder="Şifreniz..."
              @blur="$v.user.password.$touch()"
              :class="[{ 'is-invalid': errorFor('password') }]"
            />
            <small v-if="!$v.user.password.minLength" class="form-text text-danger"
              >Lütfen şifreniz en az
              {{ $v.user.password.$params.minLength.min }} karakterden oluşmalıdır...
            </small>
            <small v-if="!$v.user.password.maxLength" class="form-text text-danger"
              >Lütfen şifreniz en fazla
              {{ $v.user.password.$params.maxLength.max }} karakterden oluşmalıdır...
            </small>
            <v-errors :errors="errorFor('password')"></v-errors>
          </div>
          <div class="form-group" v-if="!isUser">
            <label>Şifre Tekrarı</label>
            <input
              v-model="user.password_confirmation"
              type="password"
              class="form-control"
              placeholder="Şifreniz..."
              @blur="$v.user.password_confirmation.$touch()"
              :class="[{ 'is-invalid': errorFor('password_confirmation') }]"
            />
            <small
              v-if="!$v.user.password_confirmation.minLength"
              class="form-text text-danger"
              >Lütfen şifreniz en az
              {{ $v.user.password_confirmation.$params.minLength.min }} karakterden
              oluşmalıdır...
            </small>
            <small
              v-if="!$v.user.password_confirmation.maxLength"
              class="form-text text-danger"
              >Lütfen şifreniz en fazla
              {{ $v.user.password_confirmation.$params.maxLength.max }} karakterden
              oluşmalıdır...
            </small>
            <small
              v-if="!$v.user.password_confirmation.sameAs"
              class="form-text text-danger"
              >Girdiğiniz şifreler birbirleriyle uyuşmuyor...
            </small>
            <v-errors :errors="errorFor('password_confirmation')"></v-errors>
          </div>
          <div class="button-container d-flex flex-column align-items-center">
            <button
              v-if="isUser"
              class="btn btn-primary btn-block mb-2"
              @click.prevent="login"
              
            >
               <span v-if="loading">
            <i class="fas fa-circle-notch fa-spin"></i> Gönderiliyor...
          </span> 
          <span  v-else>
            Giriş
          </span>
            </button>
            <button
              v-else
              class="btn btn-success btn-block mb-2"
              @click.prevent="register"
              
            >
            <span v-if="loading">
            <i class="fas fa-circle-notch fa-spin"></i> Gönderiliyor...
          </span> 
          <span  v-else>
            Kayıt Ol
          </span>
              
            </button>
            <a href="#" @click.prevent="isUser = !isUser" class="text-secondary">
              {{ isUser ? "Üye değilim" : "Üyeliğim var" }}
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import validationErrors from "./../../shared/mixins/validationErrors";
import { logIn } from "./../../shared/utils/auth";
import {
  required,
  email,
  numeric,
  minLength,
  maxLength,
  sameAs,
  between,
} from "vuelidate/lib/validators";
import { mapGetters } from "vuex";
export default {
  mixins: [validationErrors],
  data() {
    return {
      user: {
        email: null,
        password: null,
        password_confirmation: null,
        name: null,
      },
      isUser: this.$route.params.user ? this.$route.params.user : false,
      loading: false,
    };
  },
  validations: {
    user: {
      name: {
        required,
        minLength: minLength(3),
        maxLength: maxLength(15),
      },
      email: {
        email,
        required,
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
      password_confirmation: {
        required,
        minLength: minLength(8),
        maxLength: maxLength(18),
        // sameAs : sameAs('password'),
        sameAs: sameAs((vm) => {
          return vm.password;
        }),
      },
    },
  },
  computed: {
    ...mapGetters(["getSetting"]),
  },
  methods: {
    async login() {
     
      this.loading = true;
      this.errors = null;

      await axios.get("/sanctum/csrf-cookie");
      await axios
        .post("/login", {
          email: this.user.email,
          password: this.user.password,
        })
        .then((res) => {
          if (res.status == 204) {
            logIn();
            
            this.$store.dispatch("loadUser").then(()=>this.$router.go(-1));
          }
        })
        .then(() => this.$toast.success("Başarılı bir şekilde giriş yaptınız."))
        .catch((error) => {
          this.errors = error.response && error.response.data.errors;
        })
        .catch(() => this.$toast.error("Sayfayı yenileyin ve tekrar deneyiniz."));
      this.loading = false;
    },

    async register() {
      this.loading = true;
      this.errors = null;
      try {
        const response = await axios.post("/register", {
          name: this.user.name,
          email: this.user.email,
          password: this.user.password,
          password_confirmation: this.user.password_confirmation,
        });
        if (201 == response.status) {
          logIn();
          this.$store
            .dispatch("loadUser")
            .then(() => this.$router.go(-1))
            .then(() => this.$toast.success("Başarılı bir şekilde kayıt oldunuz."));
        }
      } catch (error) {
        this.errors = error.response && error.response.data.errors;
      }
      this.loading = false;
    },
  },
};
</script>
