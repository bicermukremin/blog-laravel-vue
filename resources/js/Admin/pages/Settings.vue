<template>
  <div class="row">
    <div class="col">
      <div class="loading" v-if="!completed">
        <div class="lds-ripple">
          <div></div>
          <div></div>
        </div>
      </div>
      <section class="card">
        <header class="card-header">
          <div class="card-actions mb-2">
            <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
            <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
          </div>

          <h2 class="card-title">Ayarlar</h2>
        </header>
        <div class="card-body">
          <div class="soft">
            <div class="form-group row">
              <div class="col-md-3"></div>
              <div class="col-md-6"></div>
              <div class="col-md-3"></div>
            </div>
            <div class="form-group row mb-3">
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <label for="image" class="form-label">Logo1</label><br />
                <img
                  :src="
                    settingImage1.length > 0 ? settingImage1 : '/storage/' + setting.logo1
                  "
                />
                <button @click.prevent="onSearchFile1" class="btn btn-outline-primary">
                  Logo1 Resim Seç
                </button>
                <input
                  type="file"
                  class="form-control stat-val"
                  id="image"
                  name="image"
                  @change="uploadImage1"
                  ref="file1"
                  placeholder="Another input placeholder"
                  multiple
                />
              </div>
              <div class="col-md-4"></div>
            </div>
            <div class="form-group row mb-3">
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <label for="image" class="form-label">Logo2</label><br />
                <img
                  :src="
                    settingImage2.length > 0 ? settingImage2 : '/storage/' + setting.logo2
                  "
                />
                <button @click.prevent="onSearchFile2" class="btn btn-outline-primary">
                  Logo2 Resim Seç
                </button>
                <input
                  type="file"
                  class="form-control stat-val"
                  id="image"
                  name="image"
                  @change="uploadImage2"
                  ref="file2"
                  placeholder="Another input placeholder"
                />
              </div>
              <div class="col-md-4"></div>
            </div>
            <div class="form-group row">
              <div class="col-md-3"></div>
              <div class="col-md-6"></div>
              <div class="col-md-3"></div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >Telefon Numarası</label
              >
              <div class="col-lg-6">
                <the-mask
                  @blur="$v.setting.tel.$touch()"
                  v-model="setting.tel"
                  mask="### ### ## ##"
                  type="tel"
                  class="form-control"
                  :masked="telMask"
                  placeholder="539 000 00 00"
                  :class="[{ 'is-invalid': errorFor('tel') || $v.setting.tel.$error }]"
                ></the-mask>
                <small v-if="!$v.setting.tel.minLength" class="form-text text-danger"
                  >Lütfen telefon kısmı en az
                  {{ $v.setting.tel.$params.minLength.min }} 10 adet rakamdan
                  oluşmalıdır...
                </small>

                <v-errors :errors="errorFor('tel')"></v-errors>
              </div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >Mail Adresi</label
              >
              <div class="col-lg-6">
                <input
                  @blur="$v.setting.email.$touch()"
                  v-model="setting.email"
                  type="email"
                  class="form-control"
                  placeholder="Mail Adresi"
                  :class="[
                    { 'is-invalid': errorFor('email') || $v.setting.email.$error },
                  ]"
                />
                <small v-if="!$v.setting.email.email" class="form-text text-danger"
                  >Lütfen geçerli bir e-posta adresi giriniz...
                </small>

                <v-errors :errors="errorFor('email')"></v-errors>
              </div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >Adres</label
              >
              <div class="col-lg-6">
                <textarea
                  @blur="$v.setting.adres.$touch()"
                  v-model="setting.adres"
                  placeholder="Adres"
                  class="form-control"
                ></textarea>
                <small v-if="!$v.setting.adres.minLength" class="form-text text-danger"
                  >Lütfen adres kısmı en az
                  {{ $v.setting.adres.$params.minLength.min }} karakterden oluşmalıdır...
                </small>
                <small v-if="!$v.setting.adres.maxLength" class="form-text text-danger"
                  >Lütfen adres kısmı en fazla
                  {{ $v.setting.adres.$params.maxLength.min }} karakterden oluşmalıdır...
                </small>

                <v-errors :errors="errorFor('adres')"></v-errors>
              </div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >Google Maps</label
              >
              <div class="col-lg-6">
                <input
                  @blur="$v.setting.map.$touch()"
                  v-model="setting.map"
                  type="text"
                  class="form-control"
                  placeholder="Google Maps"
                  :class="[{ 'is-invalid': errorFor('map') || $v.setting.map.$error }]"
                />
                <small v-if="!$v.setting.map.minLength" class="form-text text-danger"
                  >Lütfen Google Maps kısmı en az
                  {{ $v.setting.map.$params.minLength.min }} karakterden oluşmalıdır...
                </small>
                <small v-if="!$v.setting.map.maxLength" class="form-text text-danger"
                  >Lütfen Google Maps kısmı en fazla
                  {{ $v.setting.map.$params.maxLength.max }} karakterden oluşmalıdır...
                </small>

                <v-errors :errors="errorFor('map')"></v-errors>
              </div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >Twitter</label
              >
              <div class="col-lg-6">
                <input
                  @blur="$v.setting.twitter.$touch()"
                  v-model="setting.twitter"
                  type="text"
                  class="form-control"
                  placeholder="Twitter"
                  :class="[
                    { 'is-invalid': errorFor('twitter') || $v.setting.twitter.$error },
                  ]"
                />
                <small v-if="!$v.setting.twitter.minLength" class="form-text text-danger"
                  >Lütfen twitter kısmı en az
                  {{ $v.setting.twitter.$params.minLength.min }} karakterden
                  oluşmalıdır...
                </small>
                <small v-if="!$v.setting.twitter.maxLength" class="form-text text-danger"
                  >Lütfen twitter kısmı en fazla
                  {{ $v.setting.twitter.$params.maxLength.max }} karakterden
                  oluşmalıdır...
                </small>

                <v-errors :errors="errorFor('twitter')"></v-errors>
              </div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >Facebook</label
              >
              <div class="col-lg-6">
                <input
                  @blur="$v.setting.facebook.$touch()"
                  v-model="setting.facebook"
                  type="text"
                  class="form-control"
                  placeholder="Facebook"
                  :class="[
                    { 'is-invalid': errorFor('facebook') || $v.setting.facebook.$error },
                  ]"
                />
                <small v-if="!$v.setting.facebook.minLength" class="form-text text-danger"
                  >Lütfen facebook kısmı en az
                  {{ $v.setting.facebook.$params.minLength.min }} karakterden
                  oluşmalıdır...
                </small>
                <small v-if="!$v.setting.facebook.maxLength" class="form-text text-danger"
                  >Lütfen facebook kısmı en fazla
                  {{ $v.setting.facebook.$params.maxLength.max }} karakterden
                  oluşmalıdır...
                </small>

                <v-errors :errors="errorFor('facebook')"></v-errors>
              </div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >İnstagram</label
              >
              <div class="col-lg-6">
                <input
                  @blur="$v.setting.instagram.$touch()"
                  v-model="setting.instagram"
                  type="text"
                  class="form-control"
                  placeholder="İnstagram"
                  :class="[
                    {
                      'is-invalid': errorFor('instagram') || $v.setting.instagram.$error,
                    },
                  ]"
                />
                <small
                  v-if="!$v.setting.instagram.minLength"
                  class="form-text text-danger"
                  >Lütfen instagram kısmı en az
                  {{ $v.setting.instagram.$params.minLength.min }} karakterden
                  oluşmalıdır...
                </small>
                <small
                  v-if="!$v.setting.instagram.maxLength"
                  class="form-text text-danger"
                  >Lütfen instagram kısmı en fazla
                  {{ $v.setting.instagram.$params.maxLength.max }} karakterden
                  oluşmalıdır...
                </small>

                <v-errors :errors="errorFor('instagram')"></v-errors>
              </div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >LinkedIn</label
              >
              <div class="col-lg-6">
                <input
                  @blur="$v.setting.linkedIn.$touch()"
                  v-model="setting.linkedIn"
                  type="text"
                  class="form-control"
                  placeholder="LinkedIn"
                  :class="[
                    { 'is-invalid': errorFor('linkedIn') || $v.setting.linkedIn.$error },
                  ]"
                />
                <small v-if="!$v.setting.linkedIn.minLength" class="form-text text-danger"
                  >Lütfen linkedin kısmı en az
                  {{ $v.setting.linkedIn.$params.minLength.min }} karakterden
                  oluşmalıdır...
                </small>
                <small v-if="!$v.setting.linkedIn.maxLength" class="form-text text-danger"
                  >Lütfen linkedin kısmı en fazla
                  {{ $v.setting.linkedIn.$params.maxLength.max }} karakterden
                  oluşmalıdır...
                </small>

                <v-errors :errors="errorFor('linkedIn')"></v-errors>
              </div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >Github</label
              >
              <div class="col-lg-6">
                <input
                  @blur="$v.setting.github.$touch()"
                  v-model="setting.github"
                  type="text"
                  class="form-control"
                  placeholder="LinkedIn"
                  :class="[
                    { 'is-invalid': errorFor('github') || $v.setting.github.$error },
                  ]"
                />
                <small v-if="!$v.setting.github.minLength" class="form-text text-danger"
                  >Lütfen github kısmı en az
                  {{ $v.setting.github.$params.minLength.min }} karakterden oluşmalıdır...
                </small>
                <small v-if="!$v.setting.github.maxLength" class="form-text text-danger"
                  >Lütfen github kısmı en fazla
                  {{ $v.setting.github.$params.maxLength.max }} karakterden oluşmalıdır...
                </small>

                <v-errors :errors="errorFor('github')"></v-errors>
              </div>
            </div>
          </div>
          <button
            :disabled="$v.$invalid"
            @click.prevent="updateSetting"
            class="btn btn-primary btn-lg"
          >
            Güncelle
          </button>

          <hr />
          <hr />
          <br />
        </div>
      </section>
    </div>
  </div>
</template>

<script>
import CoolLightBox from "vue-cool-lightbox";
import "vue-cool-lightbox/dist/vue-cool-lightbox.min.css";
import validationErrors from "./../../shared/mixins/validationErrors";
import {
  required,
  email,
  numeric,
  minLength,
  maxLength,
  sameAs,
  between,
} from "vuelidate/lib/validators";
import { inputError } from "./../../shared/utils/response";
import { mapGetters } from "vuex";

export default {
  components: {
    CoolLightBox,
  },
  mixins: [validationErrors],
  validations: {
    setting: {
      tel: {
        required,
        minLength: minLength(10),
      },
      adres: {
        required,
        minLength: minLength(10),
        maxLength: maxLength(100),
      },
      twitter: {
        required,
        minLength: minLength(10),
        maxLength: maxLength(75),
      },
      instagram: {
        required,
        minLength: minLength(10),
        maxLength: maxLength(75),
      },
      facebook: {
        required,
        minLength: minLength(10),
        maxLength: maxLength(75),
      },
      linkedIn: {
        required,
        minLength: minLength(10),
        maxLength: maxLength(75),
      },
      github: {
        required,
        minLength: minLength(10),
        maxLength: maxLength(75),
      },
      map: {
        required,
        minLength: minLength(10),
        maxLength: maxLength(300),
      },
      email: {
        required,
        email,
      },
    },
  },
  data() {
    return {
      telMask: true,
      settingImage2: "",
      settingImage1: "",
      indeterminate: true,
      progress: 0,
      counterClockwise: false,
      hideBackground: false,
      completed: false,
      deleting: false,

      setting: {},
    };
  },
  computed: {
    ...mapGetters(["getSettingErrors"]),
  },
  methods: {
    uploadImage1(e) {
      let file = e.target.files[0];
      let mimes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
      if (!mimes.includes(file.type)) {
        this.$toast.error("Yüklediğiniz resim jpeg, jpg, png ve gif tipinde olmalı!.");
      } else if (file.size > 2 * 1024 * 1024) {
        this.$toast.error("Yüklediğiniz resim 2 MB boyutunu geçmemeli!");
      } else {
        /*  debugger; */
        this.setting.logo1 = file;
        this.settingImage1 = URL.createObjectURL(file);
      }
    },
    onSearchFile1() {
      this.$refs.file1.click();
    },
    uploadImage2(e) {
      let file = e.target.files[0];
      let mimes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
      if (!mimes.includes(file.type)) {
        this.$toast.error("Yüklediğiniz resim jpeg, jpg, png ve gif tipinde olmalı!.");
      } else if (file.size > 2 * 1024 * 1024) {
        this.$toast.error("Yüklediğiniz resim 2 MB boyutunu geçmemeli!");
      } else {
        /*  debugger; */
        this.setting.logo2 = file;
        this.settingImage2 = URL.createObjectURL(file);
      }
    },
    onSearchFile2() {
      this.$refs.file2.click();
    },
    updateSetting() {
      const formData = new FormData();

      formData.append("tel", this.setting.tel.trim());
      formData.append("map", this.setting.map);
      formData.append("adres", this.setting.adres);
      formData.append("email", this.setting.email);
      formData.append("logo1", this.setting.logo1);
      formData.append("logo2", this.setting.logo2);
      formData.append("twitter", this.setting.twitter);
      formData.append("facebook", this.setting.facebook);
      formData.append("instagram", this.setting.instagram);
      formData.append("linkedIn", this.setting.linkedIn);
      formData.append("github", this.setting.github);
      formData.append("id", this.setting.id);

      /* debugger; */
      this.$store.dispatch("updateSetting", formData).then(() => {
        if (this.getSettingErrors) {
          inputError(Object.values(this.getSettingErrors));
        } else {
          this.$toast.success(
            "Ayarlar güncelleme işlemi başarılı bir şekilde tamamlanmıştır."
          );
        }
      });
    },
  },
  async beforeCreate() {
    this.$store
      .dispatch("indexSetting")
      .then(() => (this.setting = this.$store.state.setting.setting))
      .then(() => (this.completed = true));
  },
};
</script>

<style lang="scss" scoped>
.stat-val {
  display: none;
}
.pointer {
  cursor: pointer;
}
.soft {
  background-color: rgb(245, 230, 212);
}
.about {
  background-color: rgb(219, 243, 240);
}
.shadow {
  border: 1px solid;
  padding: 10px;
  box-shadow: 5px 10px #888888;
}
</style>
