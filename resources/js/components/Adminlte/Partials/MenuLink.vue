<template>
    <li v-bind:id="id" class="nav-item">
        <Link v-bind:class="personalClass"
         v-bind:href="href" v-bind:target="target"
         >
         <i :class="`${icon.icon} ${icon.color}`"
          ></i>
          <p>
              {{string}}
          <span v-if="(typeof this.menuItem.label != 'undefined')"
          :class="`badge badge-${label_color} right`">
            {{this.menuLabel}}
          </span>
          </p>
         </Link>
    </li>
    
</template>
<script>

import { Link } from '@inertiajs/inertia-vue3'

export default {
    components:{
        Link,
    },
    props:{
        menuItem: Object,
    },
    data() {
        return {
            id: this.getId(this.menuItem),
            personalClass: this.getClasses('nav-link', this.menuItem),
            string: this.getString(this.menuItem),
            compiled_val: this.getCompiled(this.menuItem),
            target: (typeof this.menuItem.target != 'undefined' ? this.menuItem.target : ""),
            icon: this.getIcon(this.menuItem),
            label_color: this.getLabelColor(this.menuItem),
            href: this.getHref(this.menuItem),
            menuLabel: this.getLabel(this.menuItem),
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
            return (typeof item['data-compiled'] != 'undefined' ? this.menuItem['data-compiled'] : "");
        },
        getLabel(item){
            return (typeof item.label != 'undefined' ? item.label : 'no label');
        }
    },
}
</script>