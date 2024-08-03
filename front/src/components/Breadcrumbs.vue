<template>
  <v-breadcrumbs :items="items" class="ma-0 pa-0">
    <template v-slot:divider>
      <v-icon>mdi-forward</v-icon>
    </template>
    <template v-slot:item="{ item }">
      <v-breadcrumbs-item
        exact
        :to="item.to"
        :disabled="item.disabled">
        {{ item.text }}
      </v-breadcrumbs-item>
    </template>
  </v-breadcrumbs>
</template>

<script>
  export default {
    name: "Breadcrumbs",
    props: {
      items: {
        type: Array,
        default: [],
      }
    },
    data: function() {
      return {}
    },
    components: {},
    methods: {},
    created() {},
    mounted() {}
  }
</script>