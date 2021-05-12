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

      <h2 class="card-title">Cevaplar</h2>
    </header>
    <div class="card-body" v-if="getReplies.length">
      <div v-if="getReplies.length">
        <table class="table table-bordered table-striped mb-0" id="datatable-editable">
          <thead>
            <tr>
              <th>Yazan</th>
              <th>Cevap</th>
              <th>Like</th>
              <th>Dislike</th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tbody class="mb-5">
            <tr data-item-id="1" v-for="reply in getReplies" :key="reply.id">
              <td>{{ reply.user.name }}</td>
              <td>{{ reply.description }}</td>
              <td>{{ reply.like }}</td>
              <td>{{ reply.dislike }}</td>

              <td class="actions">
                <a
                  href="#"
                  @click.prevent="editReply(reply)"
                  class="on-default edit-row edit-buton"
                  ><i class="fas fa-pencil-alt"></i
                ></a>
                <a
                  href="#"
                  @click.prevent="deleteReply(reply.id)"
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
      <h1 class="text-center">Henüz Kaydedilmiş Bir Reply Bulunmamaktadır.</h1>
    </div>
    <!--  <div v-if="!completed"><loading :isLoading="true"></loading></div> -->

    <pagination
      v-if="getReplies.length"
      :meta="getReplyMeta"
      @changePage="listReplies"
    ></pagination>
    <ReplyModal
      :name="name"
      :reply="reply"
      @close="close"
      @createReply="createReply"
      @updateReply="updateReply"
    ></ReplyModal>
  </section>
</template>

<script>
import ReplyModal from "./../components/ReplyModal";
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
    ReplyModal,
    Pagination,
    Loading,
  },

  data() {
    return {
      completed: false,
      isLoading: false,
      filter: [],
      reply: {
        description: "",
        dislike: "",
        like: "",
      },

      name: false,
    };
  },
  computed: {
    ...mapGetters(["getReplies", "getReplyErrors", "getReplyMeta"]),
  },
  watch: {
    // whenever question changes, this function will run
    searched: function (value) {
      this.filter["search"] = value;
      this.listReplies();
    },
  },
  methods: {
    listReplies(page) {
      if (page) {
        this.completed = true;
        this.filter["page"] = page;
      } else {
        this.completed = false;
      }
      /* if (this.searched) {
        this.filter["search"] = this.searched;
      } */
      this.$store.dispatch("initReply", { filter: this.filter }).then(() => {
        this.completed = true;
      });
    },
    openModal() {
      $("#exampleModal").modal("show");
      (this.reply = {
        name: "",
      }),
        (this.name = false);
    },
    editReply(reply) {
      $("#exampleModal").modal("show");
      this.reply = reply;
      this.name = true;
    },
    close() {
      if (this.getReplyErrors == null) {
        $("#exampleModal").modal("hide");
        this.reply = {
          name: "",
        };

        this.name = false;
      }
    },
    deleteReply(id) {
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
          this.$store.dispatch("deleteReply", id).then(() => {
            if (this.getReplyErrors) {
              inputError(Object.values(this.getReplyErrors));
            } else {
              Swal.fire("Silindi!", "Silinme İşlemi Başarılı.", "success");
            }
          });
        }
      });
    },

    createReply(payload) {
      this.isLoading = true;
      this.$store
        .dispatch("saveReply", {
          description: payload.reply.description,
          like: payload.reply.like,
          dislike: payload.reply.dislike,
        })
        .then(() => {
          this.isLoading = false;
          if (this.getReplyErrors) {
            inputError(Object.values(this.getReplyErrors));
          } else {
            this.close();
            this.$toast.success(
              "Reply ekleme işlemi başarılı bir şekilde tamamlanmıştır."
            );
          }
        });
    },

    updateReply(payload) {
      this.isLoading = true;

      this.$store
        .dispatch("updateReply", {
          description: payload.reply.description,
          like: payload.reply.like,
          dislike: payload.reply.dislike,
          id: payload.reply.id,
        })
        .then(() => {
          /* debugger; */
          this.isLoading = false;

          if (this.getReplyErrors) {
            inputError(Object.values(this.getReplyErrors));
          } else {
            this.close();

            this.$toast.success(
              "Reply güncelleme işlemi başarılı bir şekilde tamamlanmıştır."
            );
          }
        });
    },
  },
  async created() {
    this.listReplies();
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
