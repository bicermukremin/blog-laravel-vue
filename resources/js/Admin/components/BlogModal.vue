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
              <label for="title" class="form-label">Blog Başlığı</label>
              <input
                type="text"
                class="form-control"
                id="title"
                @blur="$v.blog.title.$touch()"
                v-model="blog.title"
                placeholder="Example input placeholder"
                :class="[{ 'is-invalid': errorFor('title') || $v.blog.title.$error }]"
              />
              <!-- <small v-if="!$v.blog.title.required" class="form-text text-danger"
                >Bu alan zorunludur...</small
              > -->
              <small v-if="!$v.blog.title.minLength" class="form-text text-danger"
                >Lütfen şifreniz en az
                {{ $v.blog.title.$params.minLength.min }} karakterden oluşmalıdır...
              </small>

              <v-errors :errors="errorFor('title')"></v-errors>
            </div>
            <img
              :src="blogImage ? blogImage : `storage/${blog.image}`"
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
            <div class="mb-3">
              <label for="description" class="form-label">Blog İçeriği</label>
              <ckeditor v-model="blog.description"></ckeditor>
              <small v-if="!$v.blog.description.minLength" class="form-text text-danger"
                >Lütfen şifreniz en az
                {{ $v.blog.description.$params.minLength.min }} karakterden oluşmalıdır...
              </small>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Yazar Görüşü</label>
              <ckeditor v-model="blog.author_description"></ckeditor>
              <small
                v-if="!$v.blog.author_description.minLength"
                class="form-text text-danger"
                >Lütfen şifreniz en az
                {{ $v.blog.author_description.$params.minLength.min }} karakterden
                oluşmalıdır...
              </small>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Kategoriler</label>
              <select v-model="categories" class="form-control mr-2" multiple>
                <option
                  v-for="category in getCategories"
                  :key="category.id"
                  :value="category.id"
                >
                  {{ category.name }}
                </option>
              </select>
              <small v-if="!$v.blog.description.minLength" class="form-text text-danger"
                >Lütfen şifreniz en az
                {{ $v.blog.description.$params.minLength.min }} karakterden oluşmalıdır...
              </small>
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
            <button type="submit" class="btn btn-primary" v-if="name">Güncelle</button>
            <button type="submit" class="btn btn-success" v-else>Ekle</button>
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
import { mapGetters } from "vuex";
export default {
  mixins: [validationErrors],
  props: {
    name: {
      required: true,
      type: Boolean,
    },
    blog: {
      required: false,
      type: Object,
    },
    cats: {
      required: false,
      type: Array,
    },
    showImage: {
      required: false,
      type: Boolean,
    },
  },
  data() {
    return {
      categories: [],
      blogImage: "",
      showPreview: false,
      image: "",
    };
  },
  validations: {
    blog: {
      title: {
        required,
        minLength: minLength(5),
      },
      description: {
        required,
        minLength: minLength(5),
      },
      author_description: {
        required,
        minLength: minLength(5),
      },
    },
  },
  watch: {
    cats: function () {
      this.categories = this.cats;
    },
  },
  methods: {
    onSearchFile() {
      this.$refs.file.click();
    },
    create() {
      this.$emit("createBlog", {
        blog: this.blog,
        image: this.image,
        categories: this.categories,
      });
      this.close();
    },
    update() {
      this.$emit("updateBlog", {
        blog: this.blog,
        image: this.image,
        categories: this.categories,
      });
      this.close();
    },
    uploadImage(e) {
      const file = e.target.files[0];
      /* this.blog.image = ""; */

      const mimes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
      if (!mimes.includes(file.type)) {
        this.$toast.error("Yüklediğiniz resim jpeg, jpg, png ve gif tipinde olmalı!.");
      } else if (file.size > 2 * 1024 * 1024) {
        this.$toast.error("Yüklediğiniz resim 2 MB boyutunu geçmemeli!");
      } else {
        /*  debugger; */
        this.image = file;
        this.blogImage = URL.createObjectURL(file);

        this.showPreview = true;
      }
    },
    close() {
      this.$emit("close");
      this.blogImage = "";
      this.showPreview = false;
    },
  },

  computed: {
    ...mapGetters(["getCategories"]),
    editTitle() {
      return this.name ? "Blog Güncelle" : "Blog Ekle";
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
