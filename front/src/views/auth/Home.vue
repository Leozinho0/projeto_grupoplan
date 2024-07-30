<template>
  <div class="home">
    <v-container class="pa-0">
      Bem vindo, {{ usuario.name }}
    </v-container>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";

  export default {
    name: "Home",
    data: function(){
      return {
        loading_init: true,
      }
    },
    computed: {
      ...mapGetters("auth", ["usuario"]),
    },
    components: {},
    methods: {
      async initialize() {
        this.loading_init = true;
        
        try {
          //
        } catch(e) {
          //
        } finally {
          this.loading_init = false;
        }
      },
    },
    mounted(){
      this.initialize();
    }
  }
</script>