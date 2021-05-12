<template>
  <section class="pt-3 pb-4 home-concept-construction">
    <div class="container">
      <div class="row pt-4">
        <div class="col">
          <h2 class="mb-0 text-color-dark">Projects</h2>
          <p class="lead">Lorem ipsum dolor sit amet.</p>

          <div
            class="diamonds-wrapper lightbox"
            data-plugin-options="{'delegate': '.diamond', 'type': 'image', 'gallery': {'enabled': true}}"
          >
            <ul class="diamonds">
              <li>
                <a class="diamond" :href="`storage/${project1.image}`">
                  <div class="content">
                    <img :src="`storage/${project1.image}`" class="img-fluid" alt="" />
                  </div>
                </a>
              </li>
              <li>
                <a :href="`storage/${project2.image}`" class="diamond">
                  <div class="content">
                    <img :src="`storage/${project2.image}`" class="img-fluid" alt="" />
                  </div>
                </a>
              </li>
              <li>
                <a :href="`storage/${project3.image}`" class="diamond">
                  <div class="content">
                    <img :src="`storage/${project3.image}`" class="img-fluid" alt="" />
                  </div>
                </a>
              </li>
              <li>
                <a :href="`storage/${project4.image}`" class="diamond diamond-sm">
                  <div class="content">
                    <img :src="`storage/${project4.image}`" class="img-fluid" alt="" />
                  </div>
                </a>
              </li>
              <li>
                <a :href="`storage/${project5.image}`" class="diamond">
                  <div class="content">
                    <img :src="`storage/${project5.image}`" class="img-fluid" alt="" />
                  </div>
                </a>
              </li>
              <li>
                <a :href="`storage/${project6.image}`" class="diamond diamond-sm">
                  <div class="content">
                    <img :src="`storage/${project6.image}`" class="img-fluid" alt="" />
                  </div>
                </a>
              </li>
              <li>
                <a :href="`storage/${project7.image}`" class="diamond diamond-sm">
                  <div class="content">
                    <img :src="`storage/${project7.image}`" class="img-fluid" alt="" />
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div
        class="row row-diamonds-description justify-content-center justify-content-xl-start text-center text-xl-left"
      >
        <div class="col-md-8 col-lg-6">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Quisque rutrum
            pellentesque imperdiet. Lorem ipsum dolor sit amet, consectetur adipiscing
            metus elit. Quisque rutrum pellentesque imperdiet.
          </p>
          <router-link class="btn btn-outline btn-primary" :to="{ name: 'projelerimiz' }"
            >Projelerimizi İncele</router-link
          >
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      project1: "",
      project2: "",
      project3: "",
      project4: "",
      project5: "",
      project6: "",
      project7: "",
    };
  },

  beforeCreate() {
    this.$store.dispatch("initProject", { filter: null });
    axios.get("/api/projects").then((res) => {
      this.projects = res.data.data;
      this.project1 = res.data.data[0];
      this.project2 = res.data.data[1];
      this.project3 = res.data.data[2];
      this.project4 = res.data.data[3];
      this.project5 = res.data.data[4];
      this.project6 = res.data.data[5];
      this.project7 = res.data.data[6];

      console.log(this.projects);
    });
  },
};
</script>

<style lang="scss" scoped></style>
