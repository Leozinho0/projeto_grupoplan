<template>
  <v-navigation-drawer left app v-model="sidebar_status">
    <v-list class="text-left pa-0">
      <v-list-item link>
        <v-list-item-avatar>
          <v-img :src="usuario.avatar ? usuario.avatar : require('@/assets/avatar.png')" />
        </v-list-item-avatar>
        <v-list-item-content>
          <v-list-item-title class="text-h6">
            {{ usuario.name }}
          </v-list-item-title>
          <v-list-item-subtitle>
            {{ usuario.email }}
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
    </v-list>
    <v-divider></v-divider>
    <v-list
      nav
      dense
      class="text-left">
      <template v-for="(item, index) in sidebar_items_pt">
        <template v-if="item.children">
          <v-list-group 
            no-action 
            :group="item.group">
            <template v-slot:activator>
              <v-list-item
                class="pa-0"
                active-class="color-base-2"
                :key="item.id">
                <v-list-item-icon class="mr-4">
                  <v-icon v-text="item.icon" ></v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title class="d-flex align-center justify-space-between">
                    {{ item.name }}
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </template>
            <template v-for="(child, child_index) in item.children">
              <v-list-item
                active-class="color-base-2"
                :key="child.id"
                :to="child.to"
                link>
                <v-list-item-title class="d-flex align-center justify-space-between">
                  {{ child.name }}
                </v-list-item-title>
                <v-list-item-icon class="mr-4">
                  <v-icon v-text="child.icon"></v-icon>
                </v-list-item-icon>
              </v-list-item>
            </template>
          </v-list-group>
        </template>
        <template v-else>
          <v-list-item
            :key="index"
            :to="item.to">
            <v-list-item-icon class="mr-4">
              <v-icon v-text="item.icon"></v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title v-text="item.name"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
      </template>
      <v-list-item :to="{ name: 'Logout' }">
        <v-list-item-icon class="mr-4">
          <v-icon>mdi-logout</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Logout</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
    <v-divider></v-divider>
    <v-list
      nav
      dense
      class="text-left">
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title>{{ label_termos_pt }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title>{{ label_help_pt }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
  import { mapGetters } from "vuex";

  export default {
    name: 'CompSideBar',
    data: () => ({
      loading_init: true,
      loading: false,

      label_termos_pt: "Termos e Privacidade",
      label_help_pt: "Ajuda e FAQ",

      sidebar_items_pt: [
        {
          "id": 1,
          "name": "Home",
          "icon": "mdi-home-outline",
          "icon_color": "blue lighten-1",
          "icon_color_open": "blue darken-1",
          "to": {
            "name": "Home"
          }
        },
        {
          "id": 500,
          "name": "Notificações",
          "icon": "mdi-bell-outline",
          "icon_color": "blue lighten-1",
          "icon_color_open": "blue darken-1",
        },
        {
          "id": 100,
          "name": "Configurações",
          "icon": "mdi-cogs",
          "icon_color": "blue lighten-1",
          "icon_color_open": "blue darken-1",
          "group": "my",
          "to": {
            "name": "MyPersonal"
          },
          "children": [
            {
              "id": 101,
              "name": "Pessoal",
              "icon": "mdi-playlist-edit",
              "icon_color": "blue darken-1",
              "icon_color_open": "blue darken-3",
              "to": {
                "name": "MyPersonal"
              }
            },
          ]
        }
      ],
    }),
    computed: {
      ...mapGetters("auth", ["usuario"]),
      sidebar_status: {
        get(){
          return this.$store.state.sidebar_status;
        },
        set(value){
          if(value != this.$store.state.sidebar_status){
            this.$store.commit('SIDEBAR_TOGGLE', value);
          }
        }
      }
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
    mounted() {
      this.initialize();
    },
  }
</script>