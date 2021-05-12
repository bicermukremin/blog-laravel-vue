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
              <label for="title" class="form-label">Proje Başlığı</label>
              <input
                type="text"
                class="form-control"
                id="title"
                @blur="$v.project.company_name.$touch()"
                v-model="project.company_name"
                placeholder="Example input placeholder"
                :class="[
                  {
                    'is-invalid':
                      errorFor('company_name') || $v.project.company_name.$error,
                  },
                ]"
              />
              <!-- <small v-if="!$v.project.title.required" class="form-text text-danger"
                >Bu alan zorunludur...</small
              > -->
              <small
                v-if="!$v.project.company_name.minLength"
                class="form-text text-danger"
                >Lütfen şifreniz en az
                {{ $v.project.company_name.$params.minLength.min }} karakterden
                oluşmalıdır...
              </small>

              <v-errors :errors="errorFor('company_name')"></v-errors>
            </div>
            <img
              :src="
                projectImage
                  ? projectImage
                  : `http://127.0.0.1:8000/storage/${project.image}`
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
            <div class="mb-3">
              <label for="content" class="form-label">Proje İçeriği {{ name }}</label>

              <select
                data-plugin-selectTwo
                class="form-control populate"
                v-model="idService"
              >
                <option disabled value="0">Bir Hizmet Seçiniz</option>
                <option
                  v-for="service in getServices"
                  :key="service.id"
                  :value="service.id"
                >
                  {{ service.title }}
                </option>
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
  mixins: [validationErrors],
  props: {
    name: {
      required: true,
      type: Boolean,
    },
    project: {
      required: false,
      type: Object,
    },
    serviceId: {
      required: true,
      type: Number,
    },
    showImage: {
      required: false,
      type: Boolean,
    },
  },
  data() {
    return {
      projectImage: "",
      showPreview: false,
      image: "",
      idService: 0,
      /*  serviceId: this.project.service.id ? this.project.service.id : 0, */
    };
  },
  watch: {
    // whenever question changes, this function will run
    serviceId: function (value) {
      this.idService = value;
    },
  },
  validations: {
    project: {
      company_name: {
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
      this.$emit("createProject", {
        project: this.project,
        image: this.image,
        serviceId: this.idService,
      });
      this.close();
    },
    update() {
      this.$emit("updateProject", {
        project: this.project,
        image: this.image,
        serviceId: this.idService,
      });
      this.close();
    },
    uploadImage(e) {
      const file = e.target.files[0];
      /* this.project.image = ""; */

      const mimes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
      if (!mimes.includes(file.type)) {
        this.$toast.error("Yüklediğiniz resim jpeg, jpg, png ve gif tipinde olmalı!.");
      } else if (file.size > 2 * 1024 * 1024) {
        this.$toast.error("Yüklediğiniz resim 2 MB boyutunu geçmemeli!");
      } else {
        /*  debugger; */
        this.image = file;
        this.projectImage = URL.createObjectURL(file);

        this.showPreview = true;
      }
    },
    close() {
      this.$emit("close");
      this.projectImage = "";
      this.showPreview = false;
    },
  },

  computed: {
    editTitle() {
      return this.name ? "Proje Güncelle" : "Proje Ekle";
    },
    resimButton() {
      return this.name ? "Resim Güncelle" : "Resim Ekle";
    },
    ...mapGetters(["getServices"]),
  },
  beforeCreate() {
    this.$store.dispatch("initService", { filter: null });

    $("head").append(
      $('<link rel="stylesheet">').attr(
        "href",
        "http://127.0.0.1:8000/admin/vendor/select2/css/select2.css"
      )
    );
    $("head").append(
      $('<link rel="stylesheet">').attr(
        "href",
        "http://127.0.0.1:8000/admin/vendor/select2-bootstrap-theme/select2-bootstrap.min.css"
      )
    );
    var jQueryAppear1 = document.createElement("script");
    jQueryAppear1.setAttribute("src", "admin/vendor/select2/js/select2.js");
    document.body.appendChild(jQueryAppear1);
  },
};
</script>

<style lang="scss" scoped>
.stat-val {
  display: none;
}
</style>
