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
              @click.prevent="close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="title" class="form-label">Hizmet Başlığı</label>
              <input
                type="text"
                class="form-control"
                id="title"
                @blur="$v.service.title.$touch()"
                v-model="service.title"
                placeholder="Example input placeholder"
                :class="[{ 'is-invalid': errorFor('title') || $v.service.title.$error }]"
              />
              <!-- <small v-if="!$v.service.title.required" class="form-text text-danger"
                >Bu alan zorunludur...</small
              > -->
              <small v-if="!$v.service.title.minLength" class="form-text text-danger"
                >Lütfen başlık kısmı en az
                {{ $v.service.title.$params.minLength.min }} karakterden oluşmalıdır...
              </small>

              <v-errors :errors="errorFor('title')"></v-errors>
            </div>
            <CoolLightBox
              :items="newImages.length > 0 ? newImages : images"
              :index="index"
              :fullScreen="true"
              @close="index = null"
            >
            </CoolLightBox>
            <div class="d-flex flex-row col-lg-6 mb-3" v-if="name">
              <div
                v-for="(image, imageIndex) in newImages.length > 0 ? newImages : images"
                :key="imageIndex"
              >
                <div class="pointer">
                  <img
                    class="mr-4 mb-2 hvr-grow-shadow"
                    :id="imageIndex"
                    :src="image"
                    width="80px"
                    height="80px"
                    @mouseover="shadow1"
                    @mouseout="shadow2"
                    @click.prevent="index = imageIndex"
                    :style="{
                      backgroundImage: 'url(' + image + ')',
                    }"
                  />
                </div>
                <button
                  class="btn btn-danger btn-sm mr-3"
                  @click.prevent="resmiSil1"
                  :id="imageIndex"
                >
                  <span v-if="(loading = imageIndex && deleting)">
                    <i class="fas fa-circle-notch fa-spin"></i> Siliniyor...
                  </span>
                  <span v-else>Resmi Sil</span>
                </button>
              </div>
            </div>
            <CoolLightBox
              :items="serviceImages"
              :index="index2"
              :fullScreen="true"
              @close="index2 = null"
            >
            </CoolLightBox>
            <div class="d-flex flex-row col-lg-6">
              <div v-for="(image, imageIndex2) in serviceImages" :key="imageIndex2">
                <div class="pointer">
                  <img
                    class="mr-4 mb-2 hvr-grow-shadow"
                    :id="imageIndex2"
                    :src="image"
                    width="80px"
                    height="80px"
                    @mouseover="shadow1"
                    @mouseout="shadow2"
                    @click="index2 = imageIndex2"
                    :style="{
                      backgroundImage: 'url(' + image + ')',
                    }"
                  />
                </div>
                <button
                  class="btn btn-danger btn-sm mr-3"
                  @click.prevent="resmiSil2"
                  :id="imageIndex2"
                >
                  <span v-if="(loading = imageIndex2 && deleting)">
                    <i class="fas fa-circle-notch fa-spin"></i> Siliniyor...
                  </span>
                  <span v-else>Resmi Sil</span>
                </button>
              </div>
            </div>
            <div class="mb-3">
              <label v-if="!name" for="image" class="form-label">Resim</label><br />
              <button
                @click.prevent="onSearchFile"
                v-if="
                  newImages.length > 0
                    ? newImages.length
                    : images.length + serviceImages.length < 4
                "
                class="btn btn-outline-primary"
              >
                Resim Seç
              </button>
              <input
                type="file"
                class="form-control stat-val"
                id="image"
                name="image"
                @change="uploadImage"
                ref="file"
                placeholder="Another input placeholder"
                multiple
              />
            </div>
            <div class="mb-3">
              <label for="content" class="form-label">Hizmet İçeriği</label>
              <ckeditor
                @blur="$v.service.content.$touch()"
                v-model="service.content"
              ></ckeditor>
              <small v-if="!$v.service.content.minLength" class="form-text text-danger"
                >Lütfen içerik kısmı en az
                {{ $v.service.content.$params.minLength.min }} karakterden oluşmalıdır...
              </small>
              <small v-if="!$v.service.content.maxLength" class="form-text text-danger"
                >Lütfen içerik kısmı en fazla
                {{ $v.service.content.$params.maxLength.max}} karakterden oluşmalıdır...
              </small>
            </div>
            <div class="col-lg-12">
              <a @click="newItem" class="text-white btn btn-secondary rounded-0 btn-sm"
                >Aşamalar Ekle</a
              >

              <ul class="list-group mt-3 mb-3 border-0">
                <li
                  v-for="(item, index) in name == true ? serviceItems : serviceNewItems"
                  :key="index"
                  class="list-group-item d-flex pl-2"
                >
                  <input type="text" class="form-control mr-2" v-model="item.value" />

                  <button
                    class="btn btn-sm btn-danger rounded-0"
                    @click="serviceItems.splice(index, 1)"
                  >
                    Sil
                  </button>
                </li>
              </ul>

              <v-errors :errors="errorFor('history_items')"></v-errors>
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
export default {
  components: {
    CoolLightBox,
  },
  mixins: [validationErrors],
  props: {
    name: {
      required: true,
      type: Boolean,
    },
    service: {
      required: false,
      type: Object,
    },
    images: {
      required: false,
      type: Array,
    },
    serviceItems: {
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
      serviceImages: [],
      updateImages: [],
      newImages: [],
      serviceNewItems: [],
      index: null,
      index2: null,
      imageFiles: [],
      deleting: false,
      showPreview: false,
    };
  },
  validations: {
    service: {
      title: {
        required,
        minLength: minLength(5),
      },
      content: {
        required,
        minLength: minLength(15),
        maxLength: maxLength(3000),
      },
    },
  },

  methods: {
    loading(e) {
      return e.currentTarget.id;
    },
    async resmiSil1(e) {
      this.deleting = true;

      await axios
        .post("/api/serviceResimSil/" + this.service.id, { index: e.currentTarget.id })
        .then((res) => {
          /*  debugger; */
          this.newImages = res.data.data.images;
          this.newImages = this.newImages.map(
            (item) => "http://127.0.0.1:8000/storage/" + item
          );
          this.$toast.success("Resim başarılı bir şekilde silinmiştir.");
          this.deleting = false;
        })
        .catch((err) => {
          console.log(err.res.data.errors);
          this.$toast.danger("Resim silinemedi.");
        });
    },
    async resmiSil2(e) {
      this.deleting = true;
      const index = e.currentTarget.id;
      this.serviceImages.splice(index, 1);
      this.imageFiles.splice(index, 1);
      this.updateImages.splice(index, 1);

      this.$toast.success("Resim başarılı bir şekilde silinmiştir.");
      this.deleting = false;
    },
    shadow1(e) {
      $(e.target).addClass("shadow");
    },
    shadow2(e) {
      $(e.target).removeClass("shadow");
    },
    newItem() {
      let item = {
        value: "",
      };
      if (this.name) {
        this.serviceItems.push(item);
      } else {
        this.serviceNewItems.push(item);
      }
    },
    onSearchFile() {
      this.$refs.file.click();
    },
    create() {
      this.$emit("createService", {
        service: this.service,
        images: this.imageFiles,
        items: this.serviceNewItems,
      });
      this.close();
    },
    update() {
      this.$emit("updateService", {
        service: this.service,
        images: this.updateImages,
        items: this.serviceItems,
      });
      this.close();
    },
    uploadImage(e) {
      const files = e.target.files;
      for (let index = 0; index < files.length; index++) {
        const file = files[index];

        const mimes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
        if (!mimes.includes(file.type)) {
          this.$toast.error("Yüklediğiniz resim jpeg, jpg, png ve gif tipinde olmalı!.");
        } else if (file.size > 2 * 1024 * 1024) {
          this.$toast.error("Yüklediğiniz resim 2 MB boyutunu geçmemeli!");
        } else {
          if (this.name == true) {
            this.updateImages.push(file);
            this.serviceImages.push(URL.createObjectURL(file));
                  if(this.newImages.length > 0) {

                    var array = this.newImages.concat(this.serviceImages);
                  }else{

                    var array = this.images.concat(this.serviceImages);
                  }
            if (array.length > 4) {
              this.$toast.warning("Toplamda kayıtlı resim sayısı 4 adet olmalıdır. ");
              const miktar = 4 - this.images.length;
              this.serviceImages.splice(miktar);
              this.updateImages.splice(miktar);
            }
          } else {
            console.log(file);
            this.imageFiles.push(file);
            this.serviceImages.push(URL.createObjectURL(file));
            if (this.imageFiles.length > 4) {
              this.$toast.warning("Toplamda kayıtlı resim sayısı 4 adet olmalıdır. ");
              this.imageFiles.splice(4);
            }
            if (this.serviceImages.length > 4) {
              this.serviceImages.splice(4);
            }
          }

          this.showPreview = true;
        }
      }
      /* this.service.image = ""; */
    },
    close() {
      this.$emit("close");
      this.updateImages = [];
      this.serviceImages = [];
      this.newImages = [];
      this.imageFiles = [];

      this.showPreview = false;
    },
  },

  computed: {
    editTitle() {
      return this.name ? "Hizmet Güncelle" : "Hizmet Ekle";
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
