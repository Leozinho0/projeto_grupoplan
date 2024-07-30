<template>
  <v-app-bar app elevation="0">
    <template>
      <v-app-bar-nav-icon @click="SIDEBAR_TOGGLE">
      </v-app-bar-nav-icon>
      <v-spacer></v-spacer>
    </template>
    <v-toolbar-title>
      <v-img v-if="this.$vuetify.theme.isDark" contain :src="require('@/assets/sys/img/logo_1.png')" width="130"></v-img>
      <v-img v-else contain :src="require('@/assets/sys/img/logo_1.png')" width="130"></v-img>
    </v-toolbar-title>
    <v-spacer></v-spacer>
    <CompNotifications></CompNotifications>
  </v-app-bar>
</template>

<script>
  import { mapGetters, mapMutations } from "vuex";
  import CompNotifications from "@/components/CompNotifications.vue";

  export default {
    name: "CompAppBar",
    data() {
      return {
        loading_init: true,
        loading: false,
        
        title: "GrupoPlan",
      }
    },
    computed: {
      ...mapGetters("auth", ["usuario"]),
    },
    components: {
      CompNotifications,
    },
    methods: {
      ...mapMutations(["SIDEBAR_TOGGLE"]),
      async initialize(){
        this.loading_init = true;

        try {
          //
        } catch(e) {
          //
        } finally {
          this.loading_init = false;
        }
      }
    },
    mounted() {
      this.initialize();
    },
  }
</script>