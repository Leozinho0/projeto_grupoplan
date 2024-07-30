<template>
  <div class="logout">
    <div>
      <SK2 title="Desconectando..."></SK2>
    </div>
  </div>
</template>
 
<script>
  import SK2 from "@/components/SK2.vue";
  import {mapActions} from "vuex";

  export default {
    name: "Logout",
    components: {
      SK2,
    },
    data() {
      return {}
    },
    methods: {
      ...mapActions("auth", ["signOut"]),
      async logout(){
        
        try {
          await this.signOut();
          this.$router.push({ name:'Login' });
        } catch(e) {
          //
        } finally {
          this.loading = false;
        }
      },
    },
    mounted() {
      this.logout();
    }
  }
</script>