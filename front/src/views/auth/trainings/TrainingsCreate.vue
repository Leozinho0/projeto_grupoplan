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
              <span class="display-2 color-base--text">Novo Treinamento</span>
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
          <TrainingsForm :training.sync="training" ref="formTrainamento"></TrainingsForm>
        </v-col>
      </v-row>
      <v-row class="mt-0 item">
        <v-col class="col-12 text-right">
          <v-card flat>
            <v-card-text>
              <v-btn 
                :loading="loading"
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
                @click="store">
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
      name: 'TrainingsCreate',
      data() {
        return {
          loading_init: true,
          loading: false,

          training: {},

          breadcrumbs: [ 
            { id: 1, to: { name: 'Home' }, disabled: false, text: 'Home'  }, 
            { id: 2, to: { name: 'TrainingsIndex' }, disabled: false, text: 'Treinamentos'  }, 
            { id: 3, to: { name: 'TrainingsCreate' }, disabled: true, text: 'Novo Treinamento'  }, 
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
              //
            } catch(e) {
              //
            } finally {
              this.loading_init = false;
            }
        },
        async store() {
          this.$refs.formTrainamento.$v.$touch();
            
          if(!this.$refs.formTrainamento.$v.$invalid){
            this.$swal({
              icon: 'warning',
              title: 'Cadastrar Item?',
              text: 'Você tem certeza que desejar cadastrar o item?',
              showCancelButton: true,
              cancelButtonText: 'Não',
              confirmButtonText: 'Sim',
              confirmButtonColor: '#00995d',
            }).then(async (result,) => {
              if (result.isConfirmed) {
                this.loading = true;

                const params = {
                  name: this.training.name,
                  description: this.training.description,
                };
    
                try {
                  const response = await Training.store(params);
                  this.training = response.data.data;
                    
                  this.$notify({
                    group: "sistema",
                    type: "success",
                    text: "Item cadastrado com sucesso!"
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
      async created() {},
      mounted() {
        this.initialize();
      }
    }
  </script>