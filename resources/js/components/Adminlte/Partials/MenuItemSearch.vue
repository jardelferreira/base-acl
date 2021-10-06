<template>
  <li>
    <div class="form-inline my-2">
      <div
        class="input-group"
        data-widget="sidebar-search"
        data-arrow-sign="&raquo;"
      >
        <!-- {{-- Search input --}} -->
        <input class="form-control form-control-sidebar" type="search" />

        <!-- {{-- Search button --}} -->
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-fw fa-search"></i>
          </button>
        </div>
      </div>
    </div>
  </li>
</template>
<script>
export default {
  data() {
    return {};
  },
  props: {
    menuItem: Object,
  },
  methods: {
    getId(item) {
      return typeof item.id != "undefined" ? item.id : Math.random();
    },
    getString(item) {
      return typeof item.text === "string" ? item.text : "Procurar";
    },
  },
};
</script>