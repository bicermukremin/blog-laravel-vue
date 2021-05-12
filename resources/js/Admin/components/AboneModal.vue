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
              <label for="title" class="form-label">Mail Adresi</label>
              <input
                type="text"
                class="form-control"
                id="title"
                @blur="$v.abone.email.$touch()"
                v-model="abone.email"
                placeholder="Example input placeholder"
                :class="[{ 'is-invalid': errorFor('email') || $v.abone.email.$error }]"
              />
              <!-- <small v-if="!$v.abone.title.required" class="form-text text-danger"
                >Bu alan zorunludur...</small
              > -->
              <small v-if="!$v.abone.email.email" class="form-text text-danger"
                >Lütfen içerik geçerli bir mail adresi giriniz.
              </small>

              <v-errors :errors="errorFor('email')"></v-errors>
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
import { required, email } from "vuelidate/lib/validators";
export default {
  mixins: [validationErrors],
  props: {
    name: {
      required: true,
      type: Boolean,
    },
    abone: {
      required: false,
      type: Object,
    },
  },
  validations: {
    abone: {
      email: {
        required,
        email,
      },
    },
  },

  methods: {
    create() {
      this.$emit("createAbone", { abone: this.abone });
      this.close();
    },
    update() {
      this.$emit("updateAbone", { abone: this.abone });
      this.close();
    },

    close() {
      this.$emit("close");
    },
  },

  computed: {
    editTitle() {
      return this.name ? "Abone Güncelle" : "Abone Ekle";
    },
  },
};
</script>

<style lang="scss" scoped>
.stat-val {
  display: none;
}
</style>
