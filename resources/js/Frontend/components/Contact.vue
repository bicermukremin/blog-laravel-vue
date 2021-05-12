<template>
  <form class="contact-form">
    <div v-if="successAlert" class="contact-form-success alert alert-success mt-4">
      <strong>Başarılı!</strong> Mesajınız bize başarıyla ulaştı.
    </div>

    <div v-if="errorAlert" class="contact-form-error alert alert-danger mt-4">
      <strong>Hata!</strong> Mesajınız gönderilemedi daha sonra tekrar deneyiniz.
    </div>
    <div class="form-row">
      <div class="form-group col">
        <input
          v-model="form.ad_soyad"
          @blur="$v.form.ad_soyad.$touch()"
          type="text"
          placeholder="İsminiz"
          value=""
          maxlength="100"
          class="form-control"
          name="name"
          :class="{ 'is-invalid': $v.form.ad_soyad.$error }"
        />
        <small v-if="!$v.form.ad_soyad.minLength" class="form-text text-danger"
          >Lütfen isminiz en az {{ $v.form.ad_soyad.$params.minLength.min }} karakterden
          oluşmalıdır...
        </small>
        <small v-if="!$v.form.ad_soyad.maxLength" class="form-text text-danger"
          >Lütfen isminiz en fazla
          {{ $v.form.ad_soyad.$params.maxLength.max }} karakterden oluşmalıdır...
        </small>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col">
        <input
          v-model="form.email"
          @blur="$v.form.email.$touch()"
          type="email"
          placeholder="Mail Adresiniz"
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
        <input
          v-model="form.konu"
          @blur="$v.form.konu.$touch()"
          type="text"
          placeholder="Konu"
          value=""
          maxlength="100"
          class="form-control"
          name="subject"
          :class="{ 'is-invalid': $v.form.konu.$error }"
        />
        <small v-if="!$v.form.konu.minLength" class="form-text text-danger"
          >Lütfen konu kısmı en az {{ $v.form.konu.$params.minLength.min }} karakterden
          oluşmalıdır...
        </small>
        <small v-if="!$v.form.konu.maxLength" class="form-text text-danger"
          >Lütfen konu kısmı en fazla {{ $v.form.konu.$params.maxLength.max }} karakterden
          oluşmalıdır...
        </small>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col">
        <textarea
          v-model="form.content"
          @blur="$v.form.content.$touch()"
          maxlength="5000"
          placeholder="Mesajınız"
          rows="5"
          class="form-control"
          name="message"
          :class="{ 'is-invalid': $v.form.content.$error }"
        ></textarea>
        <small v-if="!$v.form.content.minLength" class="form-text text-danger"
          >Lütfen mesaj kısmı en az
          {{ $v.form.content.$params.minLength.min }} karakterden oluşmalıdır...
        </small>
        <small v-if="!$v.form.content.maxLength" class="form-text text-danger"
          >Lütfen mesaj kısmı en fazla
          {{ $v.form.content.$params.maxLength.max }} karakterden oluşmalıdır...
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
</template>

<script>
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
  validations: {
    form: {
      ad_soyad: {
        required,
        minLength: minLength(5),
        maxLength: maxLength(70),
      },
      content: {
        required,
        minLength: minLength(15),
        maxLength: maxLength(400),
      },
      konu: {
        required,
        minLength: minLength(5),
        maxLength: maxLength(70),
      },
      email: {
        required,
        email,
      },
    },
  },
  data() {
    return {
      form: {},
      successAlert: false,
      errorAlert: false,
      deleting: false,
    };
  },
  methods: {
    async sendMail() {
      this.deleting = true;
      this.form.from = "bicermukremin86@gmail.com";
      await axios
        .post("/api/send-mail", this.form)
        .then((res) => {
          this.deleting = false;
          this.successAlert = true;
          this.form = res.data.data;
        })
        .then(() => this.$toast.success("Mesajınız başarıyla gönderilmiştir."))
        .catch((e) => {
          this.deleting = false;
          this.errorAlert = true;
          this.$toast.danger("Mesajınız gönderilemedi");
          console.log(e.res.data.data.errors);
        });
    },
  },
};
</script>

<style lang="scss" scoped></style>
