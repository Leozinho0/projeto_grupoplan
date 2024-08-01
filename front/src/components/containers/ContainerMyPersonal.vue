<template>
  <div class="ContainerMyPersonal">
    <div v-if="!loading_init">
      <v-card outlined>
        <v-card-text>
          <v-form ref="form_usuario" @submit.prevent="" :disabled="loading">
            <v-row>
              <v-col
                cols="12"
                md="6">
                <v-text-field
                  outlined
                  v-model.trim="user.name"
                  :error-messages="nameErrors"
                  label="Nome"
                  @blur="$v.user.name.$touch()"
                  required
                  dense
                  persistent-placeholder>
                </v-text-field>
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
            <v-row>
              <v-col class="text-right">
                <v-btn 
                  @click="update()" 
                  :loading="loading"
                  :disabled="loading"
                  color="deep-orange lighten-1 white--text">
                  {{ label_salvar_pt }}
                </v-btn>
              </v-col>
            </v-row>
          </v-form>
        </v-card-text>
      </v-card>
    </div>
    <div v-else>
      <SK2></SK2>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";
  import { validationMixin } from "vuelidate";
  import { required, maxLength, minLength } from "vuelidate/lib/validators";

  import SK2 from "@/components/SK2.vue";

  import User from "@/services/User";

  export default {
    mixins: [validationMixin],
    name: "ContainerMyPersonal",
    components: {
      SK2,
    },
    data() {
      return {
        loading_init: true,
        loading: false,

        label_obrigatorio_pt: "Campo obrigatório",
        label_caractere_max_pt: "Quantidade máxima de caracteres excedida",
        label_caractere_min_pt: "Quantidade mínima de caracteres inválida",
        label_invalid_pt: "Dado inválido",
        
        label_salvar_pt: "Salvar alterações",

        user: {},

        errors: {},
      }
    },
    validations: {
      user: {
        name: { required, minLength: minLength(3), maxLength: maxLength(40) },
      }
    },
    computed: {
      ...mapGetters("auth", ["usuario"]),
      nameErrors() {
        const errors = [];
        if (!this.$v.user.name.$dirty) return errors;
        !this.$v.user.name.required && errors.push(this.label_obrigatorio_pt);
        !this.$v.user.name.minLength && errors.push(this.label_caractere_min_pt);
        !this.$v.user.name.maxLength && errors.push(this.label_caractere_max_pt);
        return errors;
      },
    },
    methods: {
      async update(){
        this.$v.$touch();
        
        if(!this.$v.$invalid){
          this.$swal({
            icon: 'warning',
            title: 'Salvar alterações?',
            text: 'As alterações serão salvas',
            showCancelButton: true,
            cancelButtonText: 'Não',
            confirmButtonText: 'Sim',
            confirmButtonColor: '#FF3D00',
          }).then(async (result) => {
            if(result.isConfirmed) {

              this.loading = true;
              this.errors = {};
    
              try {
                const params = {
                  _method: "put",
                  name: this.user.name,
                };
    
                const response = await User.update(this.user.uuid, params);
                const updated_user = response.data.data;
    
                this.$notify({
                  group: "sistema",
                  type: "success",
                  text: "Alterações salvas!"
                });
    
                this.$store.commit("auth/SET_USUARIO", updated_user);
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
      async initialize() {
        this.loading_init = true;
        
        try {
          await Promise.all([]);
        } catch (e) {
          //
        } finally {
          this.loading_init = false;
        }
      }
    },
    mounted() {
      this.initialize();
    },
  }
</script>