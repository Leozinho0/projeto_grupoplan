<template>
  <v-btn icon class="color-base-2">
    <v-badge overlap color="red" :value="items.data ? (items.data.length > 0) : false" :content="items.data ? items.data.length : null">
      <v-icon>mdi-bell-outline</v-icon>
    </v-badge>
  </v-btn>
</template>

<script>
  import { mapGetters } from "vuex";
  import Notification from "@/services/Notification";

  export default {
    name: "CompNotifications",
    data() {
      return {
        loading_init: true,
        loading: false,

        items: [],
        totalItems: 0,
      };
    },
    computed: {
      ...mapGetters("auth", ["usuario"]),
    },
    methods: {
      async initialize() {
        this.loading_init = true;

        try {
          await this.paginate();
        } catch(e) {
          //
        } finally {
          this.loading_init = false;
        }
      },
      async paginate(page = 1,  filter = {}) {
        this.loading = true;

        filter = {};

        try {
          //
        } catch(e) {
          //
        } finally {
          this.loading = false;
        }
      }
    },
    mounted() {
      this.initialize();
    }
  }
</script>