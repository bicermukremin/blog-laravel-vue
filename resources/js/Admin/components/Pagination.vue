<template>
  <div>
    <nav>
      <ul class="pagination justify-content-center">
        <li class="page-item" :class="{ disabled: meta.current_page == 1 }">
          <a class="page-link" href="#" @click.prevent="switchPage(meta.current_page - 1)"
            >Önceki</a
          >
        </li>
        <li
          class="page-item"
          :class="{ active: meta.current_page == page }"
          v-for="page in meta.last_page"
          :key="page"
        >
          <a class="page-link" href="#" @click.prevent="switchPage(page)">{{ page }}</a>
        </li>
        <li class="page-item" :class="{ disabled: meta.current_page == meta.last_page }">
          <a class="page-link" href="#" @click.prevent="switchPage(meta.current_page + 1)"
            >Sonraki</a
          >
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  props: ["meta"],

  computed: {},
  methods: {
    switchPage(page) {
      this.$emit("changePage", page);
    },
  },
};
</script>

<style lang="scss" scoped></style>
