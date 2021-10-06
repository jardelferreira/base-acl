<template name="sidebar">
 
    <div v-for="menuItem in this.menuItem" :key="menuItem.index">
      <menu-item-header
        v-if="isHeader(menuItem)"
        v-bind:menuItem="menuItem"
      ></menu-item-header>

      <menu-item-search
        v-if="isMenuSearch(menuItem)"
        v-bind:menuItem="menuItem"
      ></menu-item-search>

      <menu-item-link v-if="isLink(menuItem)"
      v-bind:menuItem="menuItem"
      ></menu-item-link>

      <!-- <menu-item-treeview v-if="isSubMenu(menuItem)"
      v-bind:subMenuItem="menuItem">
      </menu-item-treeview> -->

      <li v-if="isSubMenu(menuItem)"  @click.prevent="open(this.id)"
           v-bind:id="id" :class="submenu_class">
        <a v-bind:class="personalClass"
         href="#" v-bind:target="target"
         >
         <i :class="`${icon.icon} ${icon.color}`"
          ></i>
          <p>
            Texto
              {{string}}
              <i class="fas fa-angle-left right"></i>
          <span v-if="(typeof this.subMenuItem.label != 'undefined')"
          :class="`badge badge-${label_color} right`">
            {{this.menuLabel}}
          </span>
          </p>
         </a>
          
         <ul  class="nav nav-treeview" >
         <side-bar-menu-items v-bind:menuItem="this.subMenuItem" >

         </side-bar-menu-items>
        </ul>               
    </li>

    </div>
</template>

<script>
import MenuItemTreeview from './MenuItemTreeview.vue';
import MenuItemHeader from "./MenuItemHeader.vue";
import MenuItemSearch from "./MenuItemSearch.vue";
import MenuItemLink from "./MenuLink.vue";

export default {
  name: 'SideBarMenuItems',
  components: {
    MenuItemHeader,
    MenuItemSearch,
    MenuItemLink,
    MenuItemTreeview,
  },
  props:{
    menuItem: Object,
  },
  mounted() {
    console.log(this.menuItem)
  },
  methods: {
    open(id){
      let elemento =   document.getElementById(`${id}`);
      // elemento.classList.toggle('active')
    },
    empty(value) {
      return typeof value === "undefined";
    },
    exists(value) {
      return typeof value != "undefined";
    },
    isHeader(item) {
      return typeof item.header === "string";
    },
    isLink(item) {
      return (
        typeof item.text === "string" &&
        typeof item.url === "string" ||
        typeof item.route === "string"
      );
    },
    isSubMenu(item) {
      if(typeof item.text === "string" && typeof item.submenu === "object"){
           this.subMenuItem = item.submenu;
           this.id = this.getId(this.subMenuItem)
            this.personalClass = this.getClasses('nav-link', item)
            this.submenu_class = this.getSubMenuClasses('nav-item has-treeview',item)
            this.string = this.getString(item)
            this.compiled_val = this.getCompiled(item)
            this.target = (typeof this.subMenuItem.target != 'undefined' ? this.subMenuItem.target : "")
            this.icon = this.getIcon(item)
            this.label_color = this.getLabelColor(this.subMenuItem)
            this.href = this.getHref(this.subMenuItem)
            this.menuLabel = this.getLabel(this.subMenuItem)
      console.log(this.subMenuItem)
        return true;
      }
      return false;
    },
    isLegacySearch(item) {
      return ((typeof item.text === "string") && (typeof item.search === "string"));
    },
    isCustomSearch(item) {
      return (
        typeof item.text === "string" && item.type === "sidebar-custom-search"
      );
    },
    isMenuSearch(item) {
      return (
        typeof item.text === "string" && item.type === "sidebar-menu-search"
      );
    },
    isSearch(item) {
      return (
        this.isLegacySearch(item) ||
        this.isCustomSearch(item) ||
        this.isMenuSearch(item)
      );
    },
    isAcceptedItem(item) {
      return (
        this.isSubmenu(item) ||
        this.isSearch(item) ||
        this.isHeader(item) ||
        this.isLink(item)
      );
    },
    isValidItem(item) {
      return (
        this.isAcceptedItem(item) &&
        this.empty(item.topnav_right) &&
        this.empty(item.topnav_user) &&
        this.empty(item.topnav)
      );
    },
    navSpeedAnimation(item) {
      return item.sidebar_nav_animation_speed != 300
        ? item.sidebar_nav_animation_speed
        : 300;
    },
    isAcordeon(item) {
      if (!item.sidebar_nav_accordion) return "false";
    },
    getId(item){
            return ((item.id ? item.id : Math.random()));
        },
        getString(item){
            return (typeof item != 'undefined' ? item.text : "link sem nome");
        },
        getClasses(defaultclass, classItem){
            let shift = (typeof classItem.shift != 'undefined' ? shift : '');
            return (typeof classItem.class != 'undefined' ?`${defaultclass} ${classItem.class} ${shift}` : `${defaultclass}`);
        },
        getSubMenuClasses(defaultclass, classItem){
            return (typeof classItem.class != 'undefined' ?`${defaultclass} ${classItem.class} ${shift}` : `${defaultclass}`);
        },
        getHref(item){
            return (typeof item.href != 'undefined' ? item.href : "#");       
        },
        getIcon(item){
            let brand = {};
            brand.icon = (typeof item.icon != 'undefined' ? item.icon : 'far fa-fw fa-circle');
            brand.color = (typeof item.icon_color != 'undefined' ? ` text-${item.icon_color}` : '');
            return brand;
        },
        getLabelColor(item){
            return (typeof item.label_color != 'undefined' ? item.label_color : 'primary');
        },
        getCompiled(item){
            return (typeof item['data-compiled'] != 'undefined' ? this.subMenuItem['data-compiled'] : "");
        },
        getLabel(item){
            return (typeof item.label != 'undefined' ? item.label : 'no label');
        }
  },
  data() {
    return {
            subMenuItem: {},
           
            }
  },
};
</script>