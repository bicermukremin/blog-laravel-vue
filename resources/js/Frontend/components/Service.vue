<template>
  <section class="section section-tertiary section-no-border section-custom-construction">
    <div class="container">
      <div class="row pt-4">
        <div class="col">
          <h2 class="mb-0 text-color-dark">Hizmetlerimiz</h2>
          <p class="lead">
            Müşteri memnuniyeti odaklı web teknolojileri hizmetlerim hakkında daha fazla
            bilgi ve her türlü sorularınız için bana ulaşabilirsiniz.
          </p>
        </div>
      </div>

      <div class="row mt-4" v-for="row in rows" :key="'row' + row">
        <div
          class="col-lg-6"
          v-for="(service, column) in servicesInRow(row)"
          :key="'row' + row + column"
        >
          <div
            class="feature-box feature-box-style-2 custom-feature-box mb-4 appear-animation"
            data-appear-animation="fadeInUp"
            data-appear-animation-delay="300"
          >
            <div class="feature-box-icon w-auto">
              <img
                :src="`storage/${service.images ? service.images[0] : null}`"
                alt=""
                class="img-fluid"
                width="55"
              />
            </div>
            <div class="feature-box-info ml-3">
              <h4 class="mb-2">{{ service.title }}</h4>
              <p v-html="service.content.substring(0, 50)"></p>
              <router-link
                class="mt-3"
                :to="{
                  name: 'singleService',
                  params: {
                    slugService: service.slug,
                    service: service,
                  },
                }"
                >Learn More <i class="fas fa-long-arrow-alt-right"></i
              ></router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      services: {},
      columns: 2,
      serviceCount: 0,
    };
  },
  computed: {
    rows() {
      return this.services === null ? 0 : Math.ceil(this.serviceCount / this.columns);
    },
  },
  methods: {
    servicesInRow(row) {
      return this.services.slice((row - 1) * this.columns, row * this.columns);
    },
    placeholdersInRow(row) {
      return this.columns - this.servicesInRow(row).length;
    },
  },
  beforeCreate() {
    axios.get("/api/services").then((res) => {
      this.services = res.data.data;
      this.serviceCount = res.data.data.length;
     
    });
  },
};
</script>

<style lang="scss" scoped></style>
