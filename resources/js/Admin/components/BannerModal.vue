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
              <label for="title" class="form-label">İçerik</label>
              <textarea
                type="text"
                class="form-control"
                id="title"
                @blur="$v.banner.content.$touch()"
                v-model="banner.content"
                placeholder="Example input placeholder"
                :class="[
                  { 'is-invalid': errorFor('content') || $v.banner.content.$error },
                ]"
              ></textarea>
              <!-- <small v-if="!$v.banner.title.required" class="form-text text-danger"
                >Bu alan zorunludur...</small
              > -->
              <small v-if="!$v.banner.content.minLength" class="form-text text-danger"
                >Lütfen içerik en az
                {{ $v.banner.content.$params.minLength.min }} karakterden oluşmalıdır...
              </small>

              <v-errors :errors="errorFor('content')"></v-errors>
            </div>
            <img
              :src="
                bannerImage
                  ? bannerImage
                  : `/storage/${banner.image}`
              "
              v-show="showPreview || showImage"
              class="img-fluid"
              alt=""
            />
            <div class="mb-3">
              <label for="image" class="form-label">Resim</label><br />
              <button @click.prevent="onSearchFile" class="btn btn-outline-primary">
                {{ resimButton }}
              </button>
              <input
                type="file"
                class="form-control stat-val"
                id="image"
                name="image"
                @change="uploadImage"
                ref="file"
                placeholder="Another input placeholder"
              />
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
    banner: {
      required: false,
      type: Object,
    },
    showImage: {
      required: false,
      type: Boolean,
    },
  },
  data() {
    return {
      bannerImage: "",
      showPreview: false,
      image: "",
    };
  },
  validations: {
    banner: {
      content: {
        required,
        minLength: minLength(10),
      },
    },
  },

  methods: {
    onSearchFile() {
      this.$refs.file.click();
    },
    create() {
      this.$emit("createBanner", { banner: this.banner, image: this.image });
      this.close();
    },
    update() {
      this.$emit("updateBanner", { banner: this.banner, image: this.image });
      this.close();
    },
    uploadImage(e) {
      const file = e.target.files[0];
      /* this.banner.image = ""; */

      const mimes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
      if (!mimes.includes(file.type)) {
        this.$toast.error("Yüklediğiniz resim jpeg, jpg, png ve gif tipinde olmalı!.");
      } else if (file.size > 2 * 1024 * 1024) {
        this.$toast.error("Yüklediğiniz resim 2 MB boyutunu geçmemeli!");
      } else {
        /*  debugger; */
        this.image = file;
        this.bannerImage = URL.createObjectURL(file);

        this.showPreview = true;
      }
    },
    close() {
      this.$emit("close");
      this.bannerImage = "";
      this.showPreview = false;
    },
  },

  computed: {
    editTitle() {
      return this.name ? "Banner Güncelle" : "Banner Ekle";
    },
    resimButton() {
      return this.name ? "Resim Güncelle" : "Resim Ekle";
    },
  },
};
</script>

<style lang="scss" scoped>
.stat-val {
  display: none;
}
</style>
