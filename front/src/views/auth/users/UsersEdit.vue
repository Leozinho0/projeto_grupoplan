<template>
  <v-container>
    <v-sheet v-if="loading_init" class="text-center fill-height">
      <SK2></SK2>
    </v-sheet>
    <div v-else class="root">
      <v-row class="item">
        <v-col class="col-12">
          <v-card flat>
            <v-card-text>
              <span class="display-2 color-base--text">Editar Usuário</span>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
      <v-row class="mt-0 item">
        <v-col class="col-12">
          <v-card flat>
            <v-card-text>
              <Breadcrumbs :items="breadcrumbs"></Breadcrumbs>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
      <v-row class="mt-0 item">
        <v-col class="col-12">
          <UsersForm :user.sync="user" ref="formUsuario"></UsersForm>
        </v-col>
      </v-row>
      <template v-if="errors">
        <v-row>
          <v-col class="col-12" v-for="error in errors">
            <v-alert
              class="mb-0"
              transition="scale-transition"
              dense
              type="error">
              {{ error[0] }}
            </v-alert>
          </v-col>
        </v-row>
      </template>
      <v-row class="mt-0 item">
        <v-col class="col-12 text-right">
          <v-card flat>
            <v-card-text>
              <v-btn 
                :disabled="loading"
                color="secondary"
                class="white--text mr-4"
                @click="$router.back()">
                <v-icon left>
                  mdi-arrow-left
                </v-icon>
                Voltar
              </v-btn>
              <v-btn 
                :loading="loading"
                color="color-base"
                class="white--text"
                @click="update">
                <v-icon left>
                  mdi-check
                </v-icon>
                Salvar
              </v-btn>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </div>
  </v-container>
</template>

<script>
  import { mapGetters } from "vuex";
  import SK2 from "@/components/SK2.vue";

  import User from "@/services/User";
  import UsersForm from "@/views/auth/users/UsersForm.vue";
  import Breadcrumbs from '@/components/Breadcrumbs.vue';

  export default {
    name: "UsuariosEdit",
    data() {
      return {
        loading_init: true,
        loading: false,

        user: {},
        errors: {},

        breadcrumbs: [ 
          { id: 1, to: { name: 'Home' }, disabled: false, text: 'Home'  }, 
          { id: 2, to: { name: 'UsersIndex' }, disabled: false, text: 'Usuários'  }, 
          { id: 3, to: { name: 'UsersEdit' }, disabled: true, text: 'Editar Usuário'  }, 
        ],
      }
    },
    components: {
      SK2,
      UsersForm,
      Breadcrumbs,
    },
    computed: {
      ...mapGetters("auth", ["usuario"]),
    },
    methods: {
      async initialize() {
          this.loading_init = true;

        try {
          await this.show();
        } catch (e) {
          //
        } finally {
          this.loading_init = false;
        }
      },
      async show() {
        this.loading = true;

        try {
          const response = await User.show(this.$route.params.user);
          this.user = response.data.data;
        } catch (e) {
          //
        } finally {
          this.loading = false;
        }
      },
      async update() {
        this.$refs.formUsuario.$v.$touch();

        if(!this.$refs.formUsuario.$v.$invalid){
          this.$swal({
            icon: 'warning',
            title: 'Alterar item?',
            text: 'Você tem certeza que desejar alterar o item?',
            showCancelButton: true,
            cancelButtonText: 'Não',
            confirmButtonText: 'Sim',
            confirmButtonColor: '#00995d',
          }).then(async (result,) => {
            if (result.isConfirmed) {
              this.loading = true;
              this.errors = {};

              let params = {
                _method: "put",
                name: this.user.name,
                email: this.user.email,
              };

              if(this.user.password) {
                params.password = this.user.password;
                params.password_confirmation = this.user.password_confirmation;
              }

              try {
                const response = await User.update(this.user.uuid, params);
                this.user = response.data.data;
                  
                this.$notify({
                  group: "sistema",
                  type: "success",
                  text: "Alterado com sucesso!"
                });

                this.initialize();
              } catch(e) {
                if(e.response.status === 422) {
                  this.errors = e.response.data.errors;
                }
              } finally {
                this.loading = false;
              }
            }
          });
        }
      },
    },
    mounted() {
      this.initialize();
    }
  }
</script>