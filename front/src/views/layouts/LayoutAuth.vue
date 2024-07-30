<template>
  <div class="LayoutAuth">
    <CompAppBar></CompAppBar>
    <CompSideBar></CompSideBar>
    <v-main>
      <router-view :key="$route.fullPath"/>
    </v-main>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";
  import CompAppBar from "@/components/CompAppBar.vue";
  import CompSideBar from '@/components/CompSideBar';

  export default {
    name: 'LayoutAuth',
    data() {
      return {}
    },
    components: {
      CompAppBar,
      CompSideBar,
    },
    computed: {
      ...mapGetters("auth", ["usuario"]),
    },
    methods: {
      initialize() {
        //
      }
    },
    mounted() {
      this.initialize();
    }
  }
</script>