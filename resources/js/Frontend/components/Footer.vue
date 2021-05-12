<template>
  <footer id="footer">
    <div class="container">
      <div class="row pt-4 pb-5 text-center text-md-left">
        <div class="col-md-3">
          <router-link :to="{ name: 'frontend' }">
            <img
              alt="Porto"
              class="img-fluid logo"
              width="110"
              :src="'/storage/' + getSetting.logo2"
            />
          </router-link>
        </div>
        <div class="col-md-4">
          <div class="row">
            <div class="col-lg-6 mb-2">
              <h4>Menu</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-6 mb-0">
              <ul class="list list-footer-nav">
                <li>
                  <router-link :to="{ name: 'frontend' }"> Anasayfa </router-link>
                </li>
                <li>
                  <router-link :to="{ name: 'hakkimizda' }"> Hakkımızda </router-link>
                </li>
                <li>
                  <router-link :to="{ name: 'hizmet' }"> Hizmetlerimiz </router-link>
                </li>
              </ul>
            </div>
            <div class="col-6">
              <ul class="list list-footer-nav">
                <li>
                  <router-link :to="{ name: 'projelerimiz' }"> Projelerimiz </router-link>
                </li>
                <li>
                  <router-link :to="{ name: 'haber' }"> Blog </router-link>
                </li>
                <li>
                  <router-link :to="{ name: 'bizeulasin' }"> Bize Ulaşın </router-link>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <h4>Abone Ol!</h4>

          <div class="newsletter">
            <div v-if="successAlert" class="alert alert-success" id="newsletterSuccess">
              <strong>Başarılı!</strong> Mail listemize eklendiniz.
            </div>

            <div v-if="errorAlert" class="alert alert-danger" id="newsletterError">
              <strong>Hata!</strong> Abone İşemi başarısız.
            </div>

            <form id="newsletterForm">
              <div class="input-group">
                <input
                  v-model="email"
                  @blur="$v.email.$touch()"
                  class="form-control form-control-sm"
                  placeholder="Mail Adresi"
                  name="newsletterEmail"
                  id="newsletterEmail"
                  type="text"
                  :class="{ 'is-invalid': $v.email.$error }"
                />

                <span class="input-group-append">
                  <button class="btn btn-light" @click.prevent="makeAbone">
                    <i class="icon-paper-plane icons"></i>
                  </button>
                </span>
                <small v-if="!$v.email.email" class="form-text text-danger"
                  >Lütfen geçerli bir e-posta adresi giriniz...
                </small>
              </div>
            </form>
          </div>

          <p>
            <i class="fas fa-phone"></i> {{ getSetting.tel }}
            <i class="far fa-envelope ml-2"></i>
            <a href="mailto:getSetting.email">{{ getSetting.email }}</a>
          </p>
        </div>
      </div>

      <div class="footer-copyright">
        <div class="row">
          <div class="col-lg-12 text-center">
            <p>© Copyright 2021. All Rights Reserved. Created by Mükremin BİÇER</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
import { mapGetters } from "vuex";
import { required, email } from "vuelidate/lib/validators";
export default {
  computed: {
    ...mapGetters(["getSetting"]),
  },
  validations: {
    email: {
      required,
      email,
    },
  },
  data() {
    return {
      successAlert: false,
      errorAlert: false,
      deleting: false,
      email: "",
    };
  },
  methods: {
    async makeAbone() {
      this.deleting = true;
      debugger;
      await axios
        .post("/api/make-abone", { email: this.email })
        .then((res) => {
          this.deleting = false;
          this.successAlert = true;
          this.email = res.data.data;
        })
        .then(() =>
          this.$toast.success("Abone işleminiz başarılı bir şekilde gerçekleşmiştir.")
        )
        .catch((e) => {
          this.deleting = false;
          this.errorAlert = true;
          this.$toast.danger("İşlem başarısız.");
          console.log(e.res.data.data.errors);
        });
    },
  },
};
</script>

<style lang="scss" scoped></style>
