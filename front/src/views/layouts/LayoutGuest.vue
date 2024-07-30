<template>
  <div class="LayoutGuest">
    <v-main>
      <router-view/>
    </v-main>
    <CompAppFooter></CompAppFooter>
  </div>
</template>
  
<script>
  import CompAppFooter from "@/components/CompAppFooter.vue";

  export default {
    name: 'LayoutGuest',
    data() {
      return {}
    },
    components: {
      CompAppFooter,
    },
    computed: {},
    methods: {
      initialize() {}
    },
    mounted() {
      this.initialize();
    }
  }
</script>