<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <form @submit.prevent="name ? update() : create()">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ editTitle }}</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="title" class="form-label">Ad Soyad</label>
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
                >Lütfen isminiz en az
                {{ $v.form.ad_soyad.$params.minLength.min }} karakterden oluşmalıdır...
              </small>
              <small v-if="!$v.form.ad_soyad.maxLength" class="form-text text-danger"
                >Lütfen isminiz en fazla
                {{ $v.form.ad_soyad.$params.maxLength.max }} karakterden oluşmalıdır...
              </small>
            </div>
            <div class="mb-3">
              <label for="title" class="form-label">Mail Adresi</label>
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
            <div class="mb-3">
              <label for="title" class="form-label">Kimden</label>
              <input
                v-model="form.from"
                @blur="$v.form.from.$touch()"
                type="email"
                placeholder="Mail Adresiniz"
                value=""
                maxlength="100"
                class="form-control"
                name="email"
                :class="{ 'is-invalid': $v.form.from.$error }"
              />
              <small v-if="!$v.form.from.email" class="form-text text-danger"
                >Lütfen geçerli bir e-posta adresi giriniz...
              </small>
            </div>
            <div class="mb-3">
              <label for="title" class="form-label">Konu</label>
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
                >Lütfen konu kısmı en az
                {{ $v.form.konu.$params.minLength.min }} karakterden oluşmalıdır...
              </small>
              <small v-if="!$v.form.konu.maxLength" class="form-text text-danger"
                >Lütfen konu kısmı en fazla
                {{ $v.form.konu.$params.maxLength.max }} karakterden oluşmalıdır...
              </small>
            </div>
            <div class="mb-3">
              <label for="title" class="form-label">İçerik</label>
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
            <div class="mb-3">
              <label for="title" class="form-label">Mail Türü</label>
              <select
                class="form-control"
                v-model="form.type"
                @blur="$v.form.type.$touch()"
                :class="{ 'is-invalid': $v.form.type.$error }"
              >
                <option value="yorum">Yorum</option>
                <option value="contact">Contact</option>
                <option value="reply">Reply</option>
                <option value="abone">Abone</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              @click="close"
            >
              İptal
            </button>
            <button
              type="submit"
              class="btn btn-primary"
              :disabled="$v.$invalid"
              v-if="name"
            >
              Güncelle
            </button>
            <button type="submit" class="btn btn-success" :disabled="$v.$invalid" v-else>
              Ekle
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
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
export default {
  mixins: [validationErrors],
  props: {
    name: {
      required: true,
      type: Boolean,
    },
    form: {
      required: false,
      type: Object,
    },
  },

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
      from: {
        required,
        email,
      },
      type: {
        required,
      },
    },
  },

  methods: {
    create() {
      this.$emit("createMail", { mail: this.form });
      this.close();
    },
    update() {
      this.$emit("updateMail", { mail: this.form });
      this.close();
    },

    close() {
      this.$emit("close");
    },
  },

  computed: {
    editTitle() {
      return this.name ? "Mail Güncelle" : "Mail Ekle";
    },
  },
};
</script>

<style lang="scss" scoped>
.stat-val {
  display: none;
}
</style>
