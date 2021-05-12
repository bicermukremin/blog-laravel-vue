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
              <label for="title" class="form-label">Başlık</label>
              <input
                type="text"
                class="form-control"
                id="title"
                @blur="$v.slider.title.$touch()"
                v-model="slider.title"
                placeholder="Example input placeholder"
                :class="[{ 'is-invalid': errorFor('title') || $v.slider.title.$error }]"
              />
              <!-- <small v-if="!$v.slider.title.required" class="form-text text-danger"
                >Bu alan zorunludur...</small
              > -->
              <small v-if="!$v.slider.title.minLength" class="form-text text-danger"
                >Lütfen şifreniz en az
                {{ $v.slider.title.$params.minLength.min }} karakterden oluşmalıdır...
              </small>

              <v-errors :errors="errorFor('title')"></v-errors>
            </div>
            <img
              :src="
                sliderImage
                  ? sliderImage
                  : `http://127.0.0.1:8000/storage/${slider.image}`
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
    slider: {
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
      sliderImage: "",
      showPreview: false,
      image: "",
    };
  },
  validations: {
    slider: {
      title: {
        required,
        minLength: minLength(5),
      },
    },
  },

  methods: {
    onSearchFile() {
      this.$refs.file.click();
    },
    create() {
      this.$emit("createSlider", { slider: this.slider, image: this.image });
      this.close();
    },
    update() {
      this.$emit("updateSlider", { slider: this.slider, image: this.image });
      this.close();
    },
    uploadImage(e) {
      const file = e.target.files[0];
      /* this.slider.image = ""; */

      const mimes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
      if (!mimes.includes(file.type)) {
        this.$toast.error("Yüklediğiniz resim jpeg, jpg, png ve gif tipinde olmalı!.");
      } else if (file.size > 2 * 1024 * 1024) {
        this.$toast.error("Yüklediğiniz resim 2 MB boyutunu geçmemeli!");
      } else {
        /*  debugger; */
        this.image = file;
        this.sliderImage = URL.createObjectURL(file);

        this.showPreview = true;
      }
    },
    close() {
      this.$emit("close");
      this.sliderImage = "";
      this.showPreview = false;
    },
  },

  computed: {
    editTitle() {
      return this.name ? "Slider Güncelle" : "Slider Ekle";
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
