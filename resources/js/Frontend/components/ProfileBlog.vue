<template>
  <div> 
    <BlogModal
      :name="name"
      :blog="blog"
      :cats="categories"
      :showImage="showImage"
      @close="close"
      @createBlog="createBlog"
      @updateBlog="updateBlog"
    ></BlogModal>
     <div class="post-block post-leave-comment mb-4">
                  <div class="col-md-12">
                    <div class="alert alert-warning">
                      <strong>Blog eklemek</strong> için tıklatınız.
                      <button
                        @click.prevent="openModal"
                        class="btn btn-success"
                        >Blog Oluştur</button
                      >
                    </div>
                  </div>
                </div>
    <div class="container" v-if="getUserBlogs.length>0">
      <div class="row mb-4">
        <div class="col-lg-6" v-for="blog in getUserBlogs" :key="blog.id">
          
          <div class="recent-posts mt-4 mb-4">
            <router-link
              :to="{
                name: 'singleBlog',
                params: {
                  slug: blog.slug,
                  
                },
              }"
            >
              <img class="img-fluid pb-3" :src="`storage/${blog.image}`" alt="Blog" />
            </router-link>
            <article class="post">
              <div class="post-date">
                <span class="day">{{ blog.created_at | day}}</span>
                <span class="month">{{ blog.created_at | month}}</span>
              </div>
              <h4 class="pt-2 pb-0 mb-0">
                <router-link class="text-color-dark" :to="{name:'singleBlog',params:{slug:blog.slug}}">{{
                  blog.title
                }}</router-link>
              </h4>
              <p>By {{ blog.author.name }}</p>
              <p v-html="blog.description"></p>
              <div class="col-lg-6">
              <router-link
                :to="{
                  name: 'singleBlog',
                  params: {
                    slug: blog.slug,
                   
                  },
                }"
                class="mt-3"
                >Devamını Oku <i class="fas fa-long-arrow-alt-right"></i
              ></router-link>
              </div>
              <div class="col-lg-6">
                 <a
                  href="#"
                  @click.prevent="editBlog(blog)"
                  class="on-default edit-row edit-buton"
                  ><i class="fas fa-pencil-alt"></i
                ></a>
                <a
                  href="#"
                  @click.prevent="deleteBlog(blog.slug)"
                  class="on-default remove-row delete-buton"
                  ><i class="far fa-trash-alt"></i
                ></a>
              </div>
            </article>
          </div>
          
        </div>
      </div>
    </div>
    <div class="container" v-else>
      <div class="row mb-4">
        <p>Henüz bir bloğunuz bulunmamaktadır. </p>
          
    </div>
    </div>
   
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import BlogModal from "./../../Admin/components/BlogModal";
import { inputError } from "./../../shared/utils/response";
export default {
  components:{
    BlogModal
  },
    data() {
    return {
      blog:{},
      categories:[],
      showImage:false,
      name:false,
      isLoading:false,
      
    }
  },
   computed: {
    ...mapGetters(["getBlogs","getUser","getBlogErrors","getUserBlogs"]),
   
  },

 /*  watch:{
    getBlogs:function () {
       this.$store.dispatch("initBlog", { filter: this.filter })

    }
  }, */

  methods: {
      openModal() {
      $("#exampleModal").modal("show");
      this.blog = {};
      this.categories = [];
      this.showImage = false;
      this.name = false;
    },
    editBlog(blog) {
      $("#exampleModal").modal("show");
      this.blog = blog;
      this.categories = blog.categories.map((el) => el.id);
      this.showImage = true;
      this.name = true;
    },
    close() {
      if (this.getBlogErrors == null) {
        $("#exampleModal").modal("hide");
        this.blog = {};
        this.categories = [];
        this.showImage = false;
        this.name = false;
      }
    },
      createBlog(payload) {
      this.isLoading = true;
  
      const formData = new FormData();
      formData.append("image", payload.image);
      formData.append("title", payload.blog.title);
      formData.append("author_id", this.getUser.id);
      formData.append("description", payload.blog.description);
      formData.append("categories", payload.categories);
      formData.append("author_description", payload.blog.author_description);

      /* debugger; */
      this.$store.dispatch("saveBlog", formData).then(() => {
        this.isLoading = false;
        if (this.getBlogErrors) {
          inputError(Object.values(this.getBlogErrors));
        } else {
          this.close();
          this.$toast.success("Blog ekleme işlemi başarılı bir şekilde tamamlanmıştır.");
        }
      });
    },
    updateBlog(payload) {
      this.isLoading = true;
      const formData1 = new FormData();
      formData1.append("image", payload.image);
      formData1.append("title", payload.blog.title);
      formData1.append("author_id", this.getUser.id);
      formData1.append("description", payload.blog.description);
      formData1.append("id", payload.blog.id);
      formData1.append("categories", payload.categories);
      formData1.append("author_description", payload.blog.author_description);
      /*  formData1.append("_method", "PATCH"); */

      this.$store
        .dispatch("updateBlog", {
          formData1,
          id: formData1.get("id"),
        })
        .then(() => {
          /* debugger; */
          this.isLoading = false;

          if (this.getBlogErrors) {
            inputError(Object.values(this.getBlogErrors));
          } else {
            this.close();

            this.$toast.success(
              "Blog güncelleme işlemi başarılı bir şekilde tamamlanmıştır."
            );
          }
        });
    },
     deleteBlog(slug) {
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
          this.$store.dispatch("deleteBlog", slug).then(() => {
            if (this.getBlogErrors) {
              inputError(Object.values(this.getBlogErrors));
            } else {
              Swal.fire("Silindi!", "Silinme İşlemi Başarılı.", "success");
            }
          });
        }
      });
    },
  },
  created() {
    this.$store.dispatch("initCategory", { filter: null });
    /* this.userBlogs=this.getBlogs.filter(blog=>blog.author.id==this.getUser.id); */

  }
};
</script>

<style lang="scss" scoped></style>
