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
                <span class="display-2 color-base--text">Dashboard</span>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col class="col-12 col-md-4" v-for="(item, index) in trainings">
            <v-card @click="completeTraining(item)" class="row ma-0">
              <v-card-text class="col-10">
                <strong>Nome:</strong><span class="blue--text"> {{ item.name }}</span>
                <br>
                <strong>Descrição:</strong><span> {{ item.description }}</span>
                <br>
                <strong>Status:</strong><strong :class="item.completed ? 'green--text' : 'red--text'"> {{ item.completed ? 'Completado' : 'Pendente' }}</strong>
              </v-card-text>
              <v-card-text class="col-2 align-center">
                <v-icon size="30">mdi-home</v-icon>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </div>
  </v-container>
</template>

<script>
  import { mapGetters } from "vuex";
  import { validationMixin } from "vuelidate";
  import { required } from "vuelidate/lib/validators";

  import SK2 from "@/components/SK2.vue";
  import Training from "@/services/Training";

  export default {
  	name: "HomeIndex",
    mixins: [validationMixin],
    validations: {},
  	data() {
      return {
        loading_init: true,
        loading: false,

        trainings: [],
      }
    },
  	components: {
      SK2,
    },
    computed: {
      ...mapGetters("auth", ["usuario"]),
    },
    methods: {
      async initialize() {
      	this.loading_init = true;

        try {
          await this.getTrainingsByUser(this.usuario.uuid);
        } catch (e) {
          //
        } finally {
          this.loading_init = false;
        }
      },
      async getTrainingsByUser(user) {
        try {
          const params = {}

          const response = await Training.getByUser(user, params);
          this.trainings = response.data;
        } catch(e) {
          //
        } finally {
          this.loading = false;
        }
      },
      async completeTraining(training) {
        this.$swal({
          icon: 'warning',
          title: 'Atualizar Status do Treinamento?',
          text: 'Você tem certeza que desejar atualizar o status do treinamento?',
          showCancelButton: true,
          cancelButtonText: 'Não',
          confirmButtonText: 'Sim',
          confirmButtonColor: '#00995d',
        }).then(async (result) => {
          if (result.isConfirmed) {
            this.loading = true;

            const params = {
              training: training.uuid
            };

            try {
              const response = await Training.complete(this.usuario.uuid, params);
              this.training = response.data.data;
                
              this.$notify({
                group: "sistema",
                type: "success",
                text: "Treinamento atualizado com sucesso!"
              });

              this.initialize();
            } catch(e) {
              //
            } finally {
              this.loading = false;
            }
          }
        });
      },
    },
    mounted() {
      this.initialize();
    }
  }
</script>