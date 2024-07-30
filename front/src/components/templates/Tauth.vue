<template>
  <v-sheet class="pa-2" flat :max-width="$vuetify.breakpoint.mdAndUp ? '500' : ''">
    <v-card-text>
      <slot name="content"></slot>
    </v-card-text>
  </v-sheet>
</template>

<script>
  export default {
    name: "TAuth",
    components: {},
    data() {
      return {};
    },
    methods: {}
  };
</script>
