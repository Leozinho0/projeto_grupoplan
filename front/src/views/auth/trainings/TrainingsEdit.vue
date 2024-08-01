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
          <TrainingsForm :training.sync="training" ref="formTraining"></TrainingsForm>
        </v-col>
      </v-row>
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

  import Training from "@/services/Training";
  import TrainingsForm from "@/views/auth/trainings/TrainingsForm.vue";
  import Breadcrumbs from '@/components/Breadcrumbs.vue';

  export default {
    name: "TrainingsEdit",
    data() {
      return {
        loading_init: true,
        loading: false,

        training: {},

        breadcrumbs: [ 
          { id: 1, to: { name: 'Home' }, disabled: false, text: 'Home'  }, 
          { id: 2, to: { name: 'TrainingsIndex' }, disabled: false, text: 'Treinamentos'  }, 
          { id: 3, to: { name: 'TrainingsEdit' }, disabled: true, text: 'Editar Treinamento'  }, 
        ],
      }
    },
    components: {
      SK2,
      TrainingsForm,
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
          const response = await Training.show(this.$route.params.training);
          this.training = response.data.data;
        } catch (e) {
          //
        } finally {
          this.loading = false;
        }
      },
      async update() {
        this.$refs.formTraining.$v.$touch();

        if(!this.$refs.formTraining.$v.$invalid){
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

              let params = {
                _method: "put",
                name: this.training.name,
              };

              try {
                const response = await Training.update(this.training.uuid, params);
                this.training = response.data.data;
                  
                this.$notify({
                  group: "sistema",
                  type: "success",
                  text: "Alterado com sucesso!"
                });

                this.initialize();
              } catch(e) {
                //
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