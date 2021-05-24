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
              <label for="title" class="form-label">Yorum</label>
              <input
                type="text"
                class="form-control"
                id="name"
                @blur="$v.comment.description.$touch()"
                v-model="comment.description"
                placeholder="Example input placeholder"
                :class="[
                  { 'is-invalid': errorFor('name') || $v.comment.description.$error },
                ]"
              />
              <!-- <small v-if="!$v.comment.title.required" class="form-text text-danger"
                >Bu alan zorunludur...</small
              > -->
              <small
                v-if="!$v.comment.description.minLength"
                class="form-text text-danger"
                >Lütfen yorumunuz en az
                {{ $v.comment.description.$params.minLength.min }} karakterden
                oluşmalıdır...
              </small>

              <v-errors :errors="errorFor('description')"></v-errors>
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
export default {
  mixins: [validationErrors],
  props: {
    name: {
      required: true,
      type: Boolean,
    },
    comment: {
      required: false,
      type: Object,
    },
  },
  data() {
    return {};
  },
  validations: {
    comment: {
      description: {
        required,
        minLength: minLength(5),
      },
    },
  },

  methods: {
    create() {
      this.$emit("createComment", { comment: this.comment });
      this.close();
    },
    update() {
      this.$emit("updateComment", { comment: this.comment });
      this.close();
    },

    close() {
      this.$emit("close");
    },
  },

  computed: {
    editTitle() {
      return this.name ? "Comment Güncelle" : "Comment Ekle";
    },
  },
 
};
</script>

<style lang="scss" scoped>
.stat-val {
  display: none;
}
</style>
