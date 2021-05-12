<template>
  <section class="card">
    <div class="loading" v-if="!completed">
      <div class="lds-ripple">
        <div></div>
        <div></div>
      </div>
    </div>
    <header class="card-header pr-15 pt-5">
      <div class="card-actions mr-15 mb-5">
        <button class="btn btn-primary" type="button" @click="openModal">
          Ekle <i class="fas fa-plus"></i>
        </button>
      </div>

      <h2 class="card-title">Kategoriler</h2>
    </header>
    <div class="card-body" v-if="getCategories.length">
      <div v-if="getCategories.length">
        <table class="table table-bordered table-striped mb-0" id="datatable-editable">
          <thead>
            <tr>
              <th>Kategori İsmi</th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tbody class="mb-5">
            <tr data-item-id="1" v-for="category in getCategories" :key="category.id">
              <td>{{ category.name }}</td>

              <td class="actions">
                <a
                  href="#"
                  @click.prevent="editCategory(category)"
                  class="on-default edit-row edit-buton"
                  ><i class="fas fa-pencil-alt"></i
                ></a>
                <a
                  href="#"
                  @click.prevent="deleteCategory(category.id)"
                  class="on-default remove-row delete-buton"
                  ><i class="far fa-trash-alt"></i
                ></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div v-else>
      <h1 class="text-center">Henüz Kaydedilmiş Bir Category Bulunmamaktadır.</h1>
    </div>
    <!-- <div v-if="!completed"><loading :isLoading="true"></loading></div> -->

    <pagination
      v-if="getCategories.length"
      :meta="getCategoryMeta"
      @changePage="listCategories"
    ></pagination>
    <CategoryModal
      :name="name"
      :category="category"
      @close="close"
      @createCategory="createCategory"
      @updateCategory="updateCategory"
    ></CategoryModal>
  </section>
</template>

<script>
import CategoryModal from "./../components/CategoryModal";
import Pagination from "./../components/Pagination";
import { inputError } from "./../../shared/utils/response";
import Loading from "./../../shared/components/Loading";
import { mapGetters } from "vuex";

export default {
  props: {
    searched: {
      type: String,
      required: false,
    },
  },
  components: {
    CategoryModal,
    Pagination,
    Loading,
  },

  data() {
    return {
      completed: false,
      isLoading: false,
      filter: [],
      category: {
        name: "",
      },

      name: false,
    };
  },
  computed: {
    ...mapGetters(["getCategories", "getCategoryErrors", "getCategoryMeta"]),
  },
  watch: {
    // whenever question changes, this function will run
    searched: function (value) {
      this.filter["search"] = value;
      this.listCategories();
    },
  },
  methods: {
    listCategories(page) {
      if (page) {
        this.completed = true;
        this.filter["page"] = page;
      } else {
        this.completed = false;
      }
      /* if (this.searched) {
        this.filter["search"] = this.searched;
      } */
      this.$store.dispatch("initCategory", { filter: this.filter }).then(() => {
        this.completed = true;
      });
    },
    openModal() {
      $("#exampleModal").modal("show");
      (this.category = {
        name: "",
      }),
        (this.name = false);
    },
    editCategory(category) {
      $("#exampleModal").modal("show");
      this.category = category;
      this.name = true;
    },
    close() {
      if (this.getCategoryErrors == null) {
        $("#exampleModal").modal("hide");
        this.category = {
          name: "",
        };

        this.name = false;
      }
    },
    deleteCategory(id) {
      Swal.fire({
        title: "Emin misiniz?",
        text: "Tekrar geri alamazsınız!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Evet, eminim sil!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.$store.dispatch("deleteCategory", id).then(() => {
            if (this.getCategoryErrors) {
              inputError(Object.values(this.getCategoryErrors));
            } else {
              Swal.fire("Silindi!", "Silinme İşlemi Başarılı.", "success");
            }
          });
        }
      });
    },

    createCategory(payload) {
      this.isLoading = true;
      this.$store
        .dispatch("saveCategory", {
          name: payload.category.name,
        })
        .then(() => {
          this.isLoading = false;
          if (this.getCategoryErrors) {
            inputError(Object.values(this.getCategoryErrors));
          } else {
            this.close();
            this.$toast.success(
              "Category ekleme işlemi başarılı bir şekilde tamamlanmıştır."
            );
          }
        });
    },

    updateCategory(payload) {
      this.isLoading = true;
      this.$store
        .dispatch("updateCategory", {
          name: payload.category.name,
          id: payload.category.id,
        })
        .then(() => {
          /* debugger; */
          this.isLoading = false;

          if (this.getCategoryErrors) {
            inputError(Object.values(this.getCategoryErrors));
          } else {
            this.close();

            this.$toast.success(
              "Category güncelleme işlemi başarılı bir şekilde tamamlanmıştır."
            );
          }
        });
    },
  },
  async created() {
    this.listCategories();
  },
  /*  beforeCreate() {
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
    $("head").append(
      $('<link rel="stylesheet">').attr(
        "href",
        "http://127.0.0.1:8000/admin/vendor/datatables/media/css/dataTables.bootstrap4.css"
      )
    );

    var jQueryAppear1 = document.createElement("script");
    jQueryAppear1.setAttribute("src", "admin/vendor/select2/js/select2.js");
    document.body.appendChild(jQueryAppear1);
    var jQueryAppear2 = document.createElement("script");
    jQueryAppear2.setAttribute(
      "src",
      "admin/vendor/datatables/media/js/jquery.dataTables.min.js"
    );
    document.body.appendChild(jQueryAppear2);
    var jQueryAppear3 = document.createElement("script");
    jQueryAppear3.setAttribute(
      "src",
      "admin/vendor/datatables/media/js/dataTables.bootstrap4.min.js"
    );
    document.body.appendChild(jQueryAppear3);
    var jQueryAppear4 = document.createElement("script");
    jQueryAppear4.setAttribute(
      "src",
      "admin/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js"
    );
    document.body.appendChild(jQueryAppear4);
    var jQueryAppear5 = document.createElement("script");
    jQueryAppear5.setAttribute(
      "src",
      "admin/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js"
    );
    document.body.appendChild(jQueryAppear5);
    var jQueryAppear6 = document.createElement("script");
    jQueryAppear6.setAttribute(
      "src",
      "admin/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js"
    );
    document.body.appendChild(jQueryAppear6);
    var jQueryAppear7 = document.createElement("script");
    jQueryAppear7.setAttribute(
      "src",
      "admin/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js"
    );
    document.body.appendChild(jQueryAppear7);
    var jQueryAppear8 = document.createElement("script");
    jQueryAppear8.setAttribute(
      "src",
      "admin/vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"
    );
    document.body.appendChild(jQueryAppear8);
    var jQueryAppear9 = document.createElement("script");
    jQueryAppear9.setAttribute(
      "src",
      "admin/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"
    );
    document.body.appendChild(jQueryAppear9);
    var jQueryAppear10 = document.createElement("script");
    jQueryAppear10.setAttribute(
      "src",
      "admin/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"
    );
    document.body.appendChild(jQueryAppear10);
    var jQueryAppear11 = document.createElement("script");
    jQueryAppear11.setAttribute(
      "src",
      "admin/js/examples/examples.datatables.default.js"
    );
    document.body.appendChild(jQueryAppear11);
    var jQueryAppear12 = document.createElement("script");
    jQueryAppear12.setAttribute(
      "src",
      "admin/js/examples/examples.datatables.row.with.details.js"
    );
    document.body.appendChild(jQueryAppear12);
    var jQueryAppear13 = document.createElement("script");
    jQueryAppear13.setAttribute(
      "src",
      "admin/js/examples/examples.datatables.tabletools.js"
    );
    document.body.appendChild(jQueryAppear13);
  }, */
};
</script>

<style scoped>
.edit-buton {
  color: #542fb9 !important;
}
.delete-buton {
  color: #ca2727 !important;
}
.my-toast {
  color: #fff !important;
}
</style>
