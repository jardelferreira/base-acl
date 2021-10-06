<template>
  <li v-bind:id="id" v-bind:class="personalClass">
    {{ string }}
  </li>
</template>
<script>
export default {
  data() {
    return {
      id: this.getId(this.menuItem),
      personalClass: this.getClasses("nav-header", this.menuItem),
      string: this.getString(this.menuItem),
    };
  },
  methods: {
    getId(item) {
      return typeof item.id != "undefined" ? item.id : Math.random();
    },
    getString(item) {
      return typeof item === "string" ? item : item.header;
    },
    getClasses(defaultclass, classItem) {
      return typeof classItem.class != "undefined"
        ? `${defaultclass} ${classItem.class}`
        : `${defaultclass}`;
    },
  },
  props: {
    menuItem: Object,
  },
  mounted() {
    console.log(this.menuItem);
  },
};
</script>