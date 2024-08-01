<template>
  <v-app>
    <router-view/>
    <notifications class="mt-16" :position="$vuetify.breakpoint.mdAndUp ? 'top right' : 'top center'" group="sistema">
      <template slot="body" slot-scope="props">
        <v-alert
          transition="scale-transition"
          dense
          dismissible
          :type="props.item.type">
          {{ props.item.text }}
        </v-alert>
      </template>
    </notifications>
  </v-app>
</template>