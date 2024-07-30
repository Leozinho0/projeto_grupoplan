<template>
  <v-card elevation="0" class="outlined flat ma-auto py-4 text-center">
  <v-row
    class="fill-height ma-0"
    align="center"
    justify="center">
    <v-progress-circular
      indeterminate
      color="light-green">
    </v-progress-circular>
  </v-row>
  <div class="mt-2 text--secondary">{{title}}</div>
  </v-card>
</template>

<script>
  export default {
    props: {
      title: {
        type: String,
        default: 'Carregando...'
      }
    }
  }
</script>