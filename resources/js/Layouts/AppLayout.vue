<template>
  <div class="wrapper">
    <Head :title="title" />
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"
            ><i class="fas fa-bars"></i
          ></a>
        </li>

        <li class="nav-item">
          <jet-nav-link
            :href="route('dashboard')"
            :active="route().current('dashboard')"
          >
            Dashboard
          </jet-nav-link>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Team Management -->

        <jet-dropdown
          id="settingsDropdown"
          classes="nav-item dropdown user-menu"
        >
          <template #trigger>
            <img
              v-if="$page.props.jetstream.managesProfilePhotos"
              class="user-image img-circle elevation-1"
              width="32"
              height="32"
              :src="$page.props.user.profile_photo_url"
              :alt="$page.props.user.name"
            />
            <span v-else class="d-none d-md-inline ml-2">{{
              $page.props.user.name
            }}</span>

            <svg
              class="ml-2"
              width="18"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                clip-rule="evenodd"
              />
            </svg>
          </template>

          <template #content>
            <!-- Account Management -->
            <h6 class="dropdown-header small text-muted">Manage Account</h6>

            <jet-dropdown-link :href="route('profile.show')">
              Profile
            </jet-dropdown-link>

            <jet-dropdown-link
              :href="route('api-tokens.index')"
              v-if="$page.props.jetstream.hasApiFeatures"
            >
              API Tokens
            </jet-dropdown-link>

            <hr class="dropdown-divider" />

            <!-- Authentication -->
            <form @submit.prevent="logout">
              <jet-dropdown-link as="button"> Log Out </jet-dropdown-link>
            </form>
          </template>
        </jet-dropdown>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-warning elevation-2">
      <!-- Brand Logo -->
      <a href="/" class="brand-link">
        <jet-application-mark
          width="36"
          class="brand-image img-circle elevation-1"
          style="opacity: 0.8"
        />
        <span class="brand-text font-weight-light">SGLT  </span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div v-if="$page.props.jetstream.managesProfilePhotos" class="image">
            <img
              :src="$page.props.user.profile_photo_url"
              class="img-circle elevation-1"
              alt="User Image"
            />
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ $page.props.user.name }}</a>
          </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column nav-legacy"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <side-bar-menu-items
              v-bind:menuItem="this.$options.custon.menu"
            ></side-bar-menu-items>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col">
              <h1><slot name="header"></slot></h1>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <jet-banner />
          <div class="row">
            <div class="col">
              <slot></slot>
            </div>
            <div v-show="hasSlot('aside')" class="col-lg-3">
              <slot name="aside"></slot>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b><a href="https://jetstream.laravel.com">Jetstream</a></b>
      </div>
      <strong>Powered by</strong> <a href="https://adminlte.io">AdminLTE</a>
    </footer>
  </div>
</template>

<script>
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import { Head } from "@inertiajs/inertia-vue3";
import SideBarMenuItems from "@/components/Adminlte/Partials/SideBarMenuItems.vue";

export default {
  components: {
    Head,
    JetApplicationLogo,
    JetApplicationMark,
    JetBanner,
    JetDropdown,
    JetDropdownLink,
    JetNavLink,
    SideBarMenuItems,
  },

  props: {
    title: String,
  },

  data() {
    return {
      showingNavigationDropdown: false,
    };
  },
  methods: {
    switchToTeam(team) {
      this.$inertia.put(
        route("current-team.update"),
        {
          team_id: team.id,
        },
        {
          preserveState: false,
        }
      );
    },

    logout() {
      this.$inertia.post(route("logout"));
    },

    hasSlot(name = "default") {
      return !!this.$slots[name];
    },
  },

  computed: {
    path() {
      return window.location.pathname;
    },
  },
};
</script>
