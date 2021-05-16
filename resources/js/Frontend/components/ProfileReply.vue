<template>
   <div>
                  <ul class="comments" v-if="getUserReplies.length">
                    <li v-for="reply in getUserReplies" :key="reply.id">
                      <div class="comment">
                        <div class="img-thumbnail d-none d-sm-block">
                          <img class="avatar" :alt="reply.reply_user.name" :src="'storage/'+reply.reply_user.profile.avatar" />
                        </div>
                        <div class="comment-block">
                          <div class="comment-arrow"></div>
                          <span class="comment-by">
                            <strong>{{ reply.reply_user.name }}</strong>
                            <span class="float-right">
                              <span>
                                <router-link
                                :to="{
                                  name: 'singleBlog',
                                  params: {
                                    slug: reply.comment.blog.slug,
                                  
                                  }
                                }"
                                >
                                                
                                  <i class="fas fa-reply"></i> Bloga Git</router-link></span
                              >
                              <span>
                                <button
                                  class="btn btn-primary btn-xs"
                                  @click.prevent="editReply(reply)"
                                  >Düzenle</button
                                >
                                <button
                                  class="btn btn-default btn-xs"
                                  @click.prevent="deleteReply(reply.id)"
                                  >Sil</button
                                >

                              </span>
                             
                            </span>
                          </span>
                          <p v-html="reply.description"></p>

                          <span class="date float-right">{{ reply.created_at | fromNow }}</span>
                        </div>
                      </div>
                
                    </li>
                  </ul>
                    <div class="container" v-else>
                        <div class="row mb-4">
                          <p>Henüz bir cevabınız bulunmamaktadır. </p>
                            
                      </div>
                      </div>
                     <ReplyModal
                        :name="name"
                        :reply="reply"
                        @close="close"
                        
                        @updateReply="updateReply"
                      ></ReplyModal>
                  
                  </div>
</template>

<script>
import ReplyModal from "./../../Admin/components/ReplyModal";

import { inputError } from "./../../shared/utils/response";

import { mapGetters } from "vuex";
export default {
  components: {
    ReplyModal,
    
  },
  data() {
    return {
      completed: false,
      isLoading: false,
      filter: [],
      reply: {
        
      },

      name: false,
    }
  },
  computed: {
    ...mapGetters(["getReplies", "getReplyErrors",'getUserReplies']),
  },
  methods: {
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
  async created(){
    this.$store.dispatch("initReply", { filter: this.filter })
    this.$store.dispatch("initBlog",{filter:this.filter});
  }
};
</script>

<style lang="scss" scoped></style>
