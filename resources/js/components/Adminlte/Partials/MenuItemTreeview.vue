<template>
    <li v-bind:id="id" :class="submenu_class">
        <Link v-bind:class="personalClass"
         v-bind:href="href" v-bind:target="target"
         >
         <i :class="`${icon.icon} ${icon.color}`"
          ></i>
          <p>
              {{string}}
              <i class="fas fa-angle-left right"></i>
          <span v-if="(typeof this.subMenuItem.label != 'undefined')"
          :class="`badge badge-${label_color} right`">
            {{this.menuLabel}}
          </span>
          </p>
         </Link>
          
         <ul class="nav nav-treeview">
         <side-bar-menu-items v-bind:menuItem="this.subMenuItem.submenu">

         </side-bar-menu-items>
        </ul>               
    </li>
    
</template>
<script>

import { Link } from '@inertiajs/inertia-vue3'
// import SideBarMenuItems from './SideBarMenuItems.vue'

export default {
    components:{
        Link,
        // SideBarMenuItems,
    },
    props:{
        subMenuItem: Object,
    },
    data() {
        return {
            id: this.getId(this.subMenuItem),
            personalClass: this.getClasses('nav-link', this.subMenuItem),
            submenu_class: this.getSubMenuClasses('nav-item has-treeview',this.subMenuItem),
            string: this.getString(this.subMenuItem),
            compiled_val: this.getCompiled(this.subMenuItem),
            target: (typeof this.subMenuItem.target != 'undefined' ? this.subMenuItem.target : ""),
            icon: this.getIcon(this.subMenuItem),
            label_color: this.getLabelColor(this.subMenuItem),
            href: this.getHref(this.subMenuItem),
            menuLabel: this.getLabel(this.subMenuItem),
        }
    },
    methods: {
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
}
</script>