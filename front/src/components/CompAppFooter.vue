<template>
  <div class="comphelpfooter">
    <v-footer dark padless>
      <v-container>
        <v-row>
          <v-col :cols="$vuetify.breakpoint.smAndDown ? 12 : 4">
            <div class="my-2">
              <router-link :to="{ name: 'Login' }">
                <v-img contain :src="require('@/assets/sys/img/logo_1.png')" width="130"></v-img>
              </router-link>
            </div>
            <div class="my-2 d-flex justify-space-start">
              <div>
                <v-img contain :src="require('@/assets/sys/img/flag_brazil.png')" width="30"></v-img>
              </div>
              <div class="pl-2">
                Brasil
              </div>
            </div>
            <div class="my-2">
              <span>© 2024 GrupoPlan • {{ label_copyright_pt }}</span>
            </div>
            <div class="my-2">
              <a href="" target="_blank">
                <v-icon size="24px">
                  mdi-twitter
                </v-icon>
              </a>
              <a class="ml-4" href="" target="_blank">
                <v-icon size="24px">
                  mdi-instagram
                </v-icon>
              </a>
              <a class="ml-4" href="" target="_blank">
                <v-icon size="24px">
                  mdi-facebook
                </v-icon>
              </a>
            </div>
          </v-col>
          <v-col class="my-2" :cols="$vuetify.breakpoint.smAndDown ? 12 : 4">
            <div class="text-h5 font-weight-bold mb-2">{{ label_recursos_pt }}</div>
            <div v-for="(item, index) in arr_recursos_pt">
              <router-link class="d-block btn-link" :to="item.to">{{ item.name }}</router-link>
            </div>
          </v-col>
          <v-col class="my-2" :cols="$vuetify.breakpoint.smAndDown ? 12 : 4">
            <div class="text-h5 font-weight-bold mb-2">{{ label_empresa_pt }}</div>
            <div v-for="(item, index) in arr_empresa_pt">
              <router-link class="d-block btn-link" :to="item.to">{{ item.name }}</router-link>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </v-footer>
  </div>
</template>

<script>
export default {
  name: "CompHelpFooter",
  computed: {
  },
  data: () => ({
    arr_recursos_pt: [
      {
        id: 1,
        name: 'Ajuda e FAQ',
        to: {
          name: 'Login',
        }
      },
      {
        id: 2,
        name: 'Blog',
        to: {
          name: 'Login',
        }
      },
      {
        id: 3,
        name: 'Uso da Marca',
        to: {
          name: 'Login',
        }
      }
    ],
    arr_empresa_pt: [
      {
        id: 1,
        name: 'Privacidade',
        to: {
          name: 'Login',
        }
      },
      {
        id: 2,
        name: 'Como Funciona',
        to: {
          name: 'Login',
        }
      },
      {
        id: 3,
        name: 'Termos e Políticas',
        to: {
          name: 'Login',
        }
      }
    ],
    label_copyright_pt: "Todos os direitos reservados",
    label_recursos_pt: "Recursos",
    label_empresa_pt: "Empresa",
  }),
}
</script>

<style>
  .btn-link{
    color: white !important;
    text-decoration: none;
    font-size: 16px;
  }
</style>