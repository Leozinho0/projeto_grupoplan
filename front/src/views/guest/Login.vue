<template>
  <div class="login">
    <v-container fluid>
      <v-row>
        <v-col v-show="$vuetify.breakpoint.mdAndUp" md="6" style="background-color: #ffffff;">
          <v-img class="mx-auto" :src="require('@/assets/sys/img/logo_1.png')" style="width: 440px; position: absolute; opacity: .5; top: 100px; left: -210px;"></v-img>
          <div class="d-flex">
            <v-spacer></v-spacer>
            <Tauth class="transparent">
              <template slot="content">
                <div>
                  <v-img contain :src="require('@/assets/sys/img/logo_1.png')"></v-img>
                </div>
                <div class="mt-6 display-1 text-right">
                  <span class="white--text">{{ label_sub_pt }}</span>
                </div>
              </template>
            </Tauth>
          </div>
        </v-col>
        <v-col md="6">
          <Tauth class="rounded">
            <template slot="content">
              <div class="mb-4" v-show="!$vuetify.breakpoint.mdAndUp">
                <div>
                  <v-img v-if="this.$vuetify.theme.isDark" contain :src="require('@/assets/sys/img/logo_1.png')"></v-img>
                  <v-img v-else contain :src="require('@/assets/sys/img/logo_1.png')"></v-img>
                </div>
                <div class="mt-4 text-h6 text-center">
                  <span>{{ label_sub_pt }}</span>
                </div>
              </div>
              <ContainerLogin></ContainerLogin>
              <div class="d-flex justify-space-between mt-2">
                <router-link style="text-decoration: none;" class="grey--text" :to="{ name: 'Login' }">
                  {{ label_register_pt }}
                </router-link>
                <router-link style="text-decoration: none;" class="grey--text" :to="{ name: 'Login' }">
                  {{ label_forgot_password_pt }}
                </router-link>
              </div>
            </template>
          </Tauth>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  import Tauth from "@/components/templates/Tauth.vue";
  import ContainerLogin from "@/components/containers/ContainerLogin.vue";
  import { mapActions } from "vuex";

  export default {
    name: "Login",
    components: {
      Tauth,
      ContainerLogin,
    },
    data: () => ({
      loading_init: true,
      loading: false,
      
      label_sub_pt: "Soluções Tecnológicas & Realidade Virtual",
      label_register_pt: 'Cadastre-se',
      label_forgot_password_pt: 'Esqueceu sua senha?',
    }),
    computed: {},
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
  };
</script>