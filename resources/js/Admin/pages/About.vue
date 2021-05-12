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
        <router-link
          tag="button"
          :to="{ name: 'aboutEdit' }"
          class="btn btn-primary"
          type="button"
        >
          Ekle <i class="fas fa-plus"></i>
        </router-link>
      </div>

      <h2 class="card-title">Hakkımızda</h2>
    </header>
    <div class="card-body" v-if="getAbouts">
      <div v-if="getAbouts">
        <table class="table table-bordered table-striped mb-0" id="datatable-editable">
          <thead>
            <tr>
              <th>Başlık</th>
              <th>Açıklama</th>
              <th>Misyon</th>
              <th>Vizyon</th>
              <th>Aktif/Pasif</th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tbody class="mb-5">
            <tr data-item-id="1" v-for="about in getAbouts" :key="about.id">
              <td>{{ about.title }}</td>
              <td v-html="about.description"></td>
              <td v-html="about.mission"></td>
              <td v-html="about.vision"></td>
              <td>
                <span
                  class="pointer"
                  :class="{
                    'badge badge-danger': about.active == 0,
                    'badge badge-primary': about.active == 1,
                  }"
                  @click.prevent="makeAktive(about.id)"
                  >{{ about.active == 0 ? "Aktifleştir" : "Pasifleştir" }}</span
                >
              </td>
              <td class="actions">
                <router-link
                  :to="{ name: 'aboutEdit', params: { aboutEdit: about } }"
                  href="#"
                  class="on-default edit-row edit-buton"
                  ><i class="fas fa-pencil-alt"></i
                ></router-link>
                <a
                  href="#"
                  @click.prevent="deleteAbout(about.id)"
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
      <h1 class="text-center">Henüz Kaydedilmiş Bir Hizmet Bulunmamaktadır.</h1>
    </div>
    <!-- <div v-if="!completed"><loading :isLoading="true"></loading></div> -->
    <pagination
      v-if="getAbouts.length"
      :meta="getAboutMeta"
      @changePage="listAbout"
    ></pagination>
  </section>
</template>

<script>
import Pagination from "./../components/Pagination";
import { inputError } from "./../../shared/utils/response";
import Loading from "./../../shared/components/Loading";
import { mapGetters, mapState } from "vuex";

export default {
  props: {
    searched: {
      type: String,
      required: false,
    },
  },
  components: {
    Loading,
    Pagination,
  },

  data() {
    return {
      completed: false,
      isLoading: false,
      filter: [],
      about: {},
      name: false,
    };
  },
  computed: {
    ...mapGetters(["getAbouts", "getAboutErrors", "getAboutMeta"]),
  },
  watch: {
    // whenever question changes, this function will run
    searched: function (value) {
      this.filter["search"] = value;
      this.listAbout();
    },
  },

  methods: {
    makeAktive(id) {
      this.$store.dispatch("makeActive", id).then(() => {
        this.$toast.info("Güncelleştirilmiştir.");
      });
    },

    listAbout(page) {
      if (page) {
        this.completed = true;
        this.filter["page"] = page;
      } else {
        this.completed = false;
      }

      this.$store.dispatch("indexAbout", { filter: this.filter }).then(() => {
        this.completed = true;
      });
    },

    editAbout(about) {
      this.about = about;

      this.name = true;
    },

    deleteAbout(id) {
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
          this.$store.dispatch("deleteAbout", id).then(() => {
            if (this.getAboutErrors) {
              inputError(Object.values(this.getAboutErrors));
            } else {
              Swal.fire("Silindi!", "Silinme İşlemi Başarılı.", "success");
            }
          });
        }
      });
    },
  },
  async created() {
    this.listAbout();
  },
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
.pointer {
  cursor: pointer;
}
</style>
