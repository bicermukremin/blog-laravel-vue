<template>
  <div class="row">
    <div class="col">
      <section class="card">
        <header class="card-header">
          <div class="card-actions mb-2">
            <router-link
              :to="{ name: 'about' }"
              tag="button"
              class="btn btn-secondary btn-sm"
              >Geri</router-link
            >
            <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
            <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
          </div>

          <h2 class="card-title">{{ setTitle1 }}</h2>
        </header>
        <div class="card-body">
          <div class="about">
            <div class="form-group row" v-if="aboutCount < 4">
              <label class="col-lg-3 control-label text-lg-right pt-2">{{
                imageTitle
              }}</label>
              <div class="col-lg-6">
                <vue-dropzone
                  ref="myVueDropzone1"
                  id="dropzone1"
                  :options="dropzoneOptions1"
                  @vdropzone-success="fileUploaded1"
                  @vdropzone-queue-complete="afterUploadComplete1"
                  @vdropzone-sending-multiple="sendMessage1"
                  @vdropzone-error="errorFile1"
                ></vue-dropzone>
              </div>
            </div>
            <div class="form-group row" v-else>
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <div class="alert alert-warning">
                  <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-hidden="true"
                  >
                    ×
                  </button>
                  <strong>Resim</strong> Güncellemek için önce resim silmelisiniz.
                </div>
              </div>
              <div class="col-md-3"></div>
            </div>

            <div class="form-group row" v-if="edit && aboutCount > 0">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >Kayıtlı Olan Resimler</label
              >
              <CoolLightBox
                :items="items1"
                :index="index1"
                :fullScreen="true"
                @close="index1 = null"
              >
              </CoolLightBox>
              <transition name="fade" mode="out-in">
                <div class="d-flex flex-row col-lg-6">
                  <div v-for="(image, imageIndex) in items1" :key="imageIndex">
                    <div class="pointer">
                      <img
                        class="mr-4 mb-2 hvr-grow-shadow"
                        :id="imageIndex"
                        :src="image"
                        width="150px"
                        height="150px"
                        @mouseover="shadow1"
                        @mouseout="shadow2"
                        @click="index1 = imageIndex"
                        :style="{ backgroundImage: 'url(' + image + ')' }"
                      />
                    </div>
                    <button
                      class="btn btn-danger btn-sm mr-3"
                      name="resim"
                      :id="imageIndex"
                      @click.prevent="resmiSil1"
                    >
                      <span v-if="(loading = imageIndex && deleting)">
                        <i class="fas fa-circle-notch fa-spin"></i> Siliniyor...
                      </span>
                      <span v-else>Resmi Sil</span>
                    </button>
                  </div>
                </div>
              </transition>
              <div class="loading" v-if="isloading">
                <div class="lds-ripple">
                  <div></div>
                  <div></div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <div class="alert alert-info">
                  <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-hidden="true"
                  >
                    ×
                  </button>
                  <strong>Toplamda en fazla 4 adet resim</strong> kayıtlı olmalıdır.
                </div>
              </div>
              <div class="col-md-3"></div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >Hakkımızda Başlık</label
              >
              <div class="col-lg-6">
                <input
                  @blur="$v.about.title.$touch()"
                  v-model="about.title"
                  type="text"
                  class="form-control"
                  placeholder="Başlık"
                  :class="[{ 'is-invalid': errorFor('title') || $v.about.title.$error }]"
                />
                <!-- <small v-if="!$v.about.title.required" class="form-text text-danger"
                >Bu alan zorunludur...</small
              > -->
                <small v-if="!$v.about.title.minLength" class="form-text text-danger"
                  >Lütfen başlık kısmı en az
                  {{ $v.about.title.$params.minLength.min }} karakterden oluşmalıdır...
                </small>

                <v-errors :errors="errorFor('title')"></v-errors>
              </div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >Hakkımızda Açıklama</label
              >
              <div class="col-lg-6">
                <ckeditor
                  @blur="$v.about.description.$touch()"
                  v-model="about.description"
                  placeholder="Açıklama"
                  >Açıklama</ckeditor
                >
                <small
                  v-if="!$v.about.description.minLength"
                  class="form-text text-danger"
                  >Lütfen açıklama kısmı en az
                  {{ $v.about.description.$params.minLength.min }} karakterden
                  oluşmalıdır...
                </small>
                <small
                  v-if="!$v.about.description.maxLength"
                  class="form-text text-danger"
                  >Lütfen açıklama kısmı en fazla
                  {{ $v.about.description.$params.maxLength.min }} karakterden
                  oluşmalıdır...
                </small>

                <v-errors :errors="errorFor('description')"></v-errors>
              </div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >Misyon</label
              >
              <div class="col-lg-6">
                <ckeditor
                  @blur="$v.about.mission.$touch()"
                  v-model="about.mission"
                  placeholder="Misyon"
                  >Misyon</ckeditor
                >
                <small v-if="!$v.about.mission.minLength" class="form-text text-danger"
                  >Lütfen açıklama kısmı en az
                  {{ $v.about.mission.$params.minLength.min }} karakterden oluşmalıdır...
                </small>
                <small v-if="!$v.about.mission.maxLength" class="form-text text-danger"
                  >Lütfen açıklama kısmı en fazla
                  {{ $v.about.mission.$params.maxLength.min }} karakterden oluşmalıdır...
                </small>

                <v-errors :errors="errorFor('mission')"></v-errors>
              </div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >Vizyon</label
              >
              <div class="col-lg-6">
                <ckeditor
                  @blur="$v.about.vision.$touch()"
                  v-model="about.vision"
                  placeholder="Vizyon"
                  >Vizyon</ckeditor
                >
                <small v-if="!$v.about.vision.minLength" class="form-text text-danger"
                  >Lütfen açıklama kısmı en az
                  {{ $v.about.vision.$params.minLength.min }} karakterden oluşmalıdır...
                </small>
                <small v-if="!$v.about.vision.maxLength" class="form-text text-danger"
                  >Lütfen açıklama kısmı en fazla
                  {{ $v.about.vision.$params.maxLength.min }} karakterden oluşmalıdır...
                </small>

                <v-errors :errors="errorFor('vision')"></v-errors>
              </div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >Tarihçe</label
              >
              <div class="col-lg-6">
                <ckeditor
                  @blur="$v.about.history_content.$touch()"
                  v-model="about.history_content"
                  placeholder="Tarihçe"
                ></ckeditor>
                <small
                  v-if="!$v.about.history_content.minLength"
                  class="form-text text-danger"
                  >Lütfen açıklama kısmı en az
                  {{ $v.about.history_content.$params.minLength.min }} karakterden
                  oluşmalıdır...
                </small>
                <small
                  v-if="!$v.about.history_content.maxLength"
                  class="form-text text-danger"
                  >Lütfen açıklama kısmı en fazla
                  {{ $v.about.history_content.$params.maxLength.min }} karakterden
                  oluşmalıdır...
                </small>

                <v-errors :errors="errorFor('description')"></v-errors>
              </div>
            </div>
            <div class="form-group row">
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
                >Krolonojik Özgeçmiş</label
              >
              <div class="col-lg-6">
                <a @click="newItem" class="text-white btn btn-secondary rounded-0 btn-sm"
                  >Özgeçmiş Alanı Ekle</a
                >

                <ul class="list-group mt-3 mb-3 border-0">
                  <li
                    v-for="(item, index) in historyItems"
                    :key="index"
                    class="list-group-item d-flex pl-2"
                  >
                    <select v-model="item.year" class="form-control mr-2">
                      <option>2001</option>
                      <option>2002</option>
                      <option>2003</option>
                      <option>2004</option>
                      <option>2005</option>
                      <option>2006</option>
                      <option>2007</option>
                      <option>2008</option>
                      <option>2009</option>
                      <option>2010</option>
                      <option>2011</option>
                      <option>2012</option>
                      <option>2013</option>
                      <option>2014</option>
                      <option>2015</option>
                      <option>2016</option>
                      <option>2017</option>
                      <option>2018</option>
                      <option>2019</option>
                      <option>2020</option>
                    </select>
                    <!--  <input type="text" class="form-control mr-2" v-model="item.year" /> -->
                    <input type="text" class="form-control mr-2" v-model="item.value" />

                    <button
                      class="btn btn-sm btn-danger rounded-0"
                      @click="historyItems.splice(index, 1)"
                    >
                      Sil
                    </button>
                  </li>
                </ul>

                <v-errors :errors="errorFor('history_items')"></v-errors>
              </div>
            </div>
          </div>
          <button
            @click.prevent="shootMessage1"
            :disabled="$v.$invalid"
            class="btn btn-primary btn-lg"
          >
            {{ setButtonName }}
          </button>

          <hr />
          <hr />
          <br />
          <header class="card-header">
            <div class="card-actions">
              <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
              <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
            </div>

            <h2 class="card-title">{{ setTitle2 }}</h2>
          </header>
          <form class="form-horizontal form-bordered soft" id="dropzoney">
            <div
              class="form-group row"
              v-if="softImages.length < 6 || softImages.length == null"
            >
              <label class="col-lg-3 control-label text-lg-right pt-2"
                >Programlama Dil Resimleri</label
              >
              <div class="col-lg-6">
                <vue-dropzone
                  ref="myVueDropzone2"
                  id="dropzone2"
                  :options="dropzoneOptions2"
                  @vdropzone-queue-complete="afterUploadComplete2"
                  @vdropzone-sending-multiple="sendMessage2"
                  @vdropzone-error="errorFile2"
                  @vdropzone-success="fileUploaded2"
                ></vue-dropzone>
              </div>
            </div>
            <div class="form-group row" v-else>
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <div class="alert alert-warning">
                  <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-hidden="true"
                  >
                    ×
                  </button>
                  <strong>Resim</strong> Güncellemek için önce resim silmelisiniz.
                </div>
              </div>
              <div class="col-md-3"></div>
            </div>

            <label
              v-if="softImages.length > 0"
              class="col-lg-3 control-label text-lg-right pt-2"
              for="inputPlaceholder"
              >Kayıtlı Olan Programlama Dil Resimleri</label
            >

            <CoolLightBox
              :items="items2"
              :index="index2"
              :fullScreen="true"
              @close="index2 = null"
            >
            </CoolLightBox>
            <div
              class="form-group row"
              v-if="softImages.length > 0"
              v-for="row in rows"
              :key="'row' + row"
            >
              <label
                class="col-lg-3 control-label text-lg-right pt-2"
                for="inputPlaceholder"
              ></label>
              <div class="d-flex flex-row col-lg-6">
                <div
                  class="d-flex flex-column"
                  v-for="(image, column) in softsInRow(row)"
                  :key="'row' + row + column"
                >
                  <div class="pointer">
                    <img
                      class="mr-3 mb-2 image"
                      :id="'image' + indexSoft(row, column)"
                      :src="`http://127.0.0.1:8000/storage/${image}`"
                      width="150px"
                      height="150px"
                      @mouseover="shadow1"
                      @mouseout="shadow2"
                      @click="index2 = indexSoft(row, column)"
                      :style="{ backgroundImage: 'url(' + image + ')' }"
                    />
                  </div>
                  <button
                    class="btn btn-danger btn-xs mr-2"
                    name="resim"
                    :id="indexSoft(row, column)"
                    @click.prevent="resmiSil2"
                  >
                    Resmi Sil
                  </button>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <div class="alert alert-info">
                  <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-hidden="true"
                  >
                    ×
                  </button>
                  <strong>Toplamda en fazla 6 adet resim</strong> kayıtlı olmalıdır.
                </div>
              </div>
              <div class="col-md-3"></div>
            </div>
            <button @click.prevent="shootMessage2" class="btn btn-primary btn-lg">
              {{ setButtonName }}
            </button>
          </form>
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
export default {
  components: {
    CoolLightBox,
  },
  mixins: [validationErrors],
  validations: {
    about: {
      title: {
        required,
        minLength: minLength(5),
      },
      description: {
        required,
        minLength: minLength(15),
        maxLength: maxLength(1500),
      },
      mission: {
        required,
        minLength: minLength(15),
        maxLength: maxLength(300),
      },
      vision: {
        required,
        minLength: minLength(15),
        maxLength: maxLength(300),
      },
      history_content: {
        required,
        minLength: minLength(15),
        maxLength: maxLength(1500),
      },
    },
  },
  data() {
    return {
      item: [],
      indeterminate: true,
      progress: 0,
      counterClockwise: false,
      hideBackground: false,
      isloading: true,
      deleting: false,
      items1: [],
      items2: [],
      index1: null,
      index2: null,
      columns: 3,
      imageIndex: "",
      softCount: 6,
      softImageCount: 0,
      aboutImages: {},
      historyItems: [],
      aboutCount: 0,
      aboutImageCountMax: 4,
      edit: false,
      softImages: {},
      softId: 1,
      about: {
        title: "",
        description: "",
        mission: "",
        vision: "",
        history_content: "",
        history_items: {
          year: "",
          value: "",
        },
      },
      dropzoneOptions1: {
        url: "http://127.0.0.1:8000/api/about",
        thumbnailWidth: 150,
        headers: { "Content-Type": "multipart/form-data" },
        headers: {
          "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').content,
        },
        manuallyAddFile: true,
        acceptedFiles: "image/jpeg, image/jpg, image/png, image/gif",
        maxFilesize: 2,
        parallelUploads: 4,
        maxFiles: 4,
        uploadMultiple: true,
        autoProcessQueue: false,
        addRemoveLinks: true,
        paramName: "images",
        dictDefaultMessage:
          "<i class='fa fa-cloud-upload'></i>Resim seçmek için tıklayınız ya da resmi buraya sürükleyiniz.",
      },
      dropzoneOptions2: {
        url: "http://127.0.0.1:8000/api/yazilim",
        thumbnailWidth: 150,
        headers: { "Content-Type": "multipart/form-data" },
        headers: {
          "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').content,
        },
        acceptedFiles: "image/jpeg, image/jpg, image/png, image/gif",
        maxFilesize: 2,
        parallelUploads: 6,
        maxFiles: 6,
        uploadMultiple: true,
        autoProcessQueue: false,
        addRemoveLinks: true,
        paramName: "images",
        dictDefaultMessage:
          "<i class='fa fa-cloud-upload'></i>Resim seçmek için tıklayınız ya da resmi buraya sürükleyiniz.",
      },
    };
  },
  methods: {
    newItem() {
      let item = {
        year: "",
        value: "",
      };
      this.historyItems.push(item);
    },
    fileUploaded1(file, response) {
      if (this.edit) {
        this.about = response.data;
        this.aboutImages = JSON.parse(response.data.images);
        this.items1 = this.aboutImages.map(
          (item) => "http://127.0.0.1:8000/storage/" + item
        );
        this.aboutCount = JSON.parse(response.data.images).length;

        Swal.fire("Güncellendi!", "Güncelleme İşlemi Başarılı.", "success");

        if (this.dropzoneOptions1.maxFiles) {
          this.$refs.myVueDropzone1.removeAllFiles();
        }
      } else {
        Swal.fire("Eklendi!", "Ekleme İşlemi Başarılı.", "success").then(() =>
          this.$router.push({ name: "about" })
        );
      }
    },
    fileUploaded2(file, response) {
      this.initSoft().then(
        Swal.fire("Güncellendi!", "Güncelleme İşlemi Başarılı.", "success")
      );
    },
    shadow1(e) {
      $(e.target).addClass("shadow");
    },
    shadow2(e) {
      $(e.target).removeClass("shadow");
    },
    errorFile2(file, message, xhr) {
      $(file.previewElement).find(".dz-error-message span").hide();
      /* inputError(Object.values(message.errors)); */
      const mimes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
      if (!mimes.includes(file.type)) {
        this.$toast.error("Yüklediğiniz resim jpeg, jpg, png ve gif tipinde olmalı!.");
      } else if (file.size > 2 * 1024 * 1024) {
        this.$toast.error("Yüklediğiniz resim 2 MB boyutunu geçmemeli!");
      } else {
        if (message.errors) {
          /* this.$refs.myVueDropzone1.getRejectedFiles().forEach((f) => {
            this.$refs.myVueDropzone1.enqueuFiles(f);
          }); */
          setTimeout(() => {
            Swal.fire("Başarısız!", "Önce resimleri yeniden yükleyerek başlayın", "info");
          }, 3000);
          inputError(Object.values(message.errors));
        } else {
          Swal.fire("Başarısız!", message, "error");
        }
      }
    },
    errorFile1(file, message, xhr) {
      $(file.previewElement).find(".dz-error-message span").hide();
      const mimes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
      if (!mimes.includes(file.type)) {
        this.$toast.error("Yüklediğiniz resim jpeg, jpg, png ve gif tipinde olmalı!.");
      } else if (file.size > 2 * 1024 * 1024) {
        this.$toast.error("Yüklediğiniz resim 2 MB boyutunu geçmemeli!");
      } else {
        if (message.errors) {
          /* this.$refs.myVueDropzone1.getRejectedFiles().forEach((f) => {
            this.$refs.myVueDropzone1.enqueuFiles(f);
          }); */
          setTimeout(() => {
            Swal.fire("Başarısız!", "Önce resimleri yeniden yükleyerek başlayın", "info");
          }, 3000);
          inputError(Object.values(message.errors));
        } else {
          Swal.fire("Başarısız!", message, "error");
        }
      }
    },
    indexSoft(row, column) {
      if (column == 0 && row == 1) {
        return 0;
      } else if (column == 1 && row == 1) {
        return 1;
      } else if (column == 2 && row == 1) {
        return 2;
      } else if (column == 0 && row == 2) {
        return 3;
      } else if (column == 1 && row == 2) {
        return 4;
      } else if (column == 2 && row == 2) {
        return 5;
      }
    },
    softsInRow(row) {
      return this.softImages.slice((row - 1) * this.columns, row * this.columns);
    },
    itemsInRow(row) {
      return this.items.slice((row - 1) * this.columns, row * this.columns);
    },
    placeholdersInRow(row) {
      return this.columns - this.softsInRow(row).length;
    },
    afterUploadComplete1: async function () {},
    afterUploadComplete2: async function () {},
    shootMessage1: async function () {
      if (this.$refs.myVueDropzone1.getQueuedFiles().length) {
        this.$refs.myVueDropzone1.processQueue();
      } else {
        this.sendMessage();
      }
    },
    shootMessage2: async function () {
      this.$refs.myVueDropzone2.processQueue();
    },
    sendMessage1: async function (files, xhr, formData) {
      var history_items = JSON.stringify(this.historyItems);

      formData.append("title", this.about.title);
      formData.append("description", this.about.description);
      formData.append("mission", this.about.mission);
      formData.append("vision", this.about.vision);
      formData.append("history_content", this.about.history_content);
      formData.append("history_items", history_items);
      formData.append("edit", this.edit);
      formData.append("id", this.about.id);
    },
    sendMessage: async function () {
      var history_items = JSON.stringify(this.historyItems);
      const formData = new FormData();
      formData.append("title", this.about.title);
      formData.append("description", this.about.description);
      formData.append("mission", this.about.mission);
      formData.append("vision", this.about.vision);
      formData.append("history_content", this.about.history_content);
      formData.append("history_items", history_items);
      formData.append("edit", this.edit);
      formData.append("id", this.about.id);
      this.$store.dispatch("updateAbout", formData).then(() => {
        if (this.getServiceErrors) {
          inputError(Object.values(this.getServiceErrors));
        } else {
          this.$toast.success("İşlem başarılı bir şekilde tamamlanmıştır.");
        }
      });
    },
    sendMessage2: async function (files, xhr, formData) {},
    async initSoft() {
      this.isloading = true;
      if (this.$route.params.aboutEdit) {
        this.progress = 100;
          debugger
        this.about = this.$route.params.aboutEdit;
        this.aboutImages = JSON.parse(this.about.images);
        this.historyItems = JSON.parse(this.about.history_items);

        this.aboutCount = JSON.parse(this.about.images).length;
        this.items1 = this.aboutImages.map(
          (item) => "http://127.0.0.1:8000/storage/" + item
        );

        await axios
          .get("/api/yazilim")
          .then((res) => {
            this.softImages = JSON.parse(res.data.data[0]);
            this.softImageCount = JSON.parse(res.data.data[0]).length;
            this.items2 = this.softImages.map(
              (item) => "http://127.0.0.1:8000/storage/" + item
            );
            this.softId = 1;
          })
          .then(() => (this.isloading = false))

          .catch((Err) => {
            console.log(Err.res.data.errors);
          });
        this.edit = true;
      } else {
        this.isloading = true;
        this.about = {};
        this.aboutImages = {};
        this.historyItems = [];
        (this.aboutCount = 0), (this.edit = false);
        await axios
          .get("/api/yazilim")
          .then((res) => {
            this.softImages = JSON.parse(res.data.data[0]);
            this.softImageCount = JSON.parse(res.data.data[0]).length;
            this.items2 = this.softImages.map(
              (item) => "http://127.0.0.1:8000/storage/" + item
            );
            this.softId = res.data.data[0].id;
          })
          .then(() => (this.isloading = false))

          .catch((Err) => {
            console.log(Err);
          });
      }
    },
    loading(e) {
      return e.currentTarget.id;
    },
    async resmiSil1(e) {
      this.deleting = true;
      await axios
        .post("/api/aboutResimSil/" + this.about.id, { index: e.currentTarget.id })
        .then((res) => {
          this.aboutImages = JSON.parse(res.data.data.images);
          this.items1 = this.aboutImages.map(
            (item) => "http://127.0.0.1:8000/storage/" + item
          );
          this.aboutCount = JSON.parse(res.data.data.images).length;
          this.$toast.success("Resim başarılı bir şekilde silinmiştir.");
          this.deleting = false;
        })
        .catch((err) => {
          console.log(err.res.data.errors);
          this.$toast.danger("Resim silinemedi.");
        });
    },
    async resmiSil2(e) {
      await axios
        .post("/api/softResimSil", { id: this.softId, index: e.currentTarget.id })
        .then((res) => {
          this.$toast.success("Resim başarılı bir şekilde silinmiştir.");
          this.initSoft();
        })
        .catch((err) => {
          console.log(err.res.data.errors);
          this.$toast.danger("Resim silinemedi.");
        });
    },
  },
  created() {
    this.initSoft();
  },

  watch: {
    softImages: function () {
      this.dropzoneOptions2.maxFiles = this.softCount - this.softImageCount;
    },

    aboutImages: function () {
      this.dropzoneOptions1.maxFiles =
        this.aboutImageCountMax -
        (this.aboutImages.length ? this.aboutImages.length : this.aboutCount);
    },
  },
  computed: {
    historyIndex() {
      return this.historyItems.length;
    },
    rows() {
      return this.softImages === null ? 0 : Math.ceil(this.softCount / this.columns);
    },
    imageCount() {
      return this.aboutImageCountMax - this.aboutCount;
    },
    setTitle1() {
      return this.$route.params.aboutEdit
        ? "Hakkımızda Bölümü Güncelleme"
        : "Hakkımızda Bölümü Ekleme";
    },
    setTitle2() {
      return this.$route.params.aboutEdit
        ? "Programlama Dili Bölümü Güncelleme"
        : "Programlama Dili Bölümü Ekleme";
    },
    setButtonName() {
      return this.$route.params.aboutEdit ? "Güncelle" : "Kaydet";
    },
    imageTitle() {
      return this.$route.params.aboutEdit ? "Resim Güncelle" : "Resim Seç";
    },
  },
  beforeCreate() {
    $("head").append(
      $('<link rel="stylesheet">').attr(
        "href",
        "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      )
    );
  },
};
</script>

<style lang="scss" scoped>
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
