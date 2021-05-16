<template>
  <div>
                  <ul class="comments" v-if="getUserComments.length">
                    <li v-for="comment in getUserComments" :key="comment.id">
                      <div class="comment">
                        <div class="img-thumbnail d-none d-sm-block">
                          <img class="avatar" :alt="comment.user.name" :src="'storage/'+comment.user.profile.avatar" />
                        </div>
                        <div class="comment-block">
                          <div class="comment-arrow"></div>
                          <span class="comment-by">
                            <strong>{{ comment.user.name }}</strong>
                            <span class="float-right">
                              <span>
                                <router-link
                                :to="{
                                  name: 'singleBlog',
                                  params: {
                                    slug: comment.blog.slug,
                                  
                                  }
                                }"
                                >
                                                
                                  <i class="fas fa-reply"></i> Bloga Git</router-link></span
                              >
                              <span>
                                <button
                                  class="btn btn-primary btn-xs"
                                  @click.prevent="editComment(comment)"
                                  >Düzenle</button
                                >
                                <button
                                  class="btn btn-default btn-xs"
                                  @click.prevent="deleteComment(comment.id)"
                                  >Sil</button
                                >

                              </span>
                             
                            </span>
                          </span>
                          <p v-html="comment.description"></p>

                          <span class="date float-right">{{ comment.created_at | fromNow }}</span>
                        </div>
                      </div>
                
                    </li>
                  </ul>
                    <div class="container" v-else>
                        <div class="row mb-4">
                          <p>Henüz bir yorumunuz bulunmamaktadır. </p>
                            
                      </div>
                      </div>
                     <CommentModal
                    :name="name"
                    :comment="comment"
                    @close="close"
                    
                    @updateComment="updateComment"
                  ></CommentModal>
                  
                  </div>
</template>

<script>
import CommentModal from "./../../Admin/components/CommentModal";
import { inputError } from "./../../shared/utils/response";
import { mapGetters } from "vuex";
export default {
  components:{
    CommentModal
  },
  data() {
    return {
    
      completed: false,
      isLoading: false,
      filter: [],
      comment: {
       
      },

      name: false,
    }
  },
  computed:{
    ...mapGetters(['getUserComments','getCommentErrors'])
  },
  methods: {
    editComment(comment) {
     
      $("#exampleModal").modal("show");
      this.comment = comment;
      this.name = true;
    
    },
    close() {
      if (this.getCommentErrors == null) {
        $("#exampleModal").modal("hide");
        this.comment = {
         
        };

        this.name = false;
      }
    },
    deleteComment(id) {
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
          this.$store.dispatch("deleteComment", id).then(() => {
            if (this.getCommentErrors) {
              inputError(Object.values(this.getCommentErrors));
            } else {
              Swal.fire("Silindi!", "Silinme İşlemi Başarılı.", "success");
            }
          });
        }
      });
    },
    updateComment(payload) {
      this.isLoading = true;

      this.$store
        .dispatch("updateComment", {
          description: payload.comment.description,
          like: payload.comment.like,
          dislike: payload.comment.dislike,
          id: payload.comment.id,
        })
        .then(() => {
          /* debugger; */
          this.isLoading = false;

          if (this.getCommentErrors) {
            inputError(Object.values(this.getCommentErrors));
          } else {
            this.close();

            this.$toast.success(
              "Yorum güncelleme işlemi başarılı bir şekilde tamamlanmıştır."
            );
          }
        });
    },
  },
  async created(){
    this.$store.dispatch('initComment',{filter:null})
    this.$store.dispatch("initBlog",{filter:this.filter});
  }
 
};
</script>

<style lang="scss" scoped></style>
