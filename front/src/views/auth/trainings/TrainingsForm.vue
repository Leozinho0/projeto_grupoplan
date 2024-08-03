<template>
  <div>
    <v-sheet v-if="loading_init" class="text-center fill-height">
      <SK2></SK2>
    </v-sheet>
    <div v-else>
      <v-row>
        <v-col>
          <v-card flat>
            <v-card-text>
              <v-form :disabled="disabled">
                <v-row>
                  <v-col class="col-12 col-md-6">
                    <v-text-field
                      v-model.trim="training.name" 
                      color="color-base"
                      label="Nome" 
                      outlined 
                      dense
                      :error-messages="nameErrors"
                      @blur="$v.training.name.$touch()"
                      persistent-placeholder
                      required>   
                    </v-text-field>
                  </v-col>
                  <v-col class="col-12 col-md-6">
                    <v-text-field
                      v-model.trim="training.description" 
                      color="color-base"
                      label="Descrição" 
                      outlined 
                      dense
                      :error-messages="descriptionErrors"
                      @blur="$v.training.description.$touch()"
                      persistent-placeholder
                      required>
                    </v-text-field>
                  </v-col>
                </v-row>
              </v-form>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
  import SK2 from "@/components/SK2.vue";

  import { validationMixin } from "vuelidate";
  import { required, maxLength } from "vuelidate/lib/validators";

  export default {
    mixins: [validationMixin],
    name: "TrainingsForm",
    validations: {
      training: {
        name: { required },
        description: { required },
      },
    },
    props: {
      training: {
        type: Object,
        default: function() {
          return {};
        }
      },
      disabled: {
        type: Boolean,
        default: function() {
          return false;
        }
      }
    },
    components: {
      SK2,
    },
    computed: {
      nameErrors() {
        const errors = [];
        if (!this.$v.training.name.$dirty) return errors;
        !this.$v.training.name.required && errors.push(this.valid_label_obrigatorio);
        return errors;
      },
      descriptionErrors() {
        const errors = [];
        if (!this.$v.training.description.$dirty) return errors;
        !this.$v.training.description.required && errors.push(this.valid_label_obrigatorio);
        return errors;
      },
    },
    data() {
      return {
        loading_init: true,
        loading: false,

        valid_label_obrigatorio: "Campo obrigatório", 
        valid_label_invalido: "Dado inválido",
        valid_max_length: "Quantidade máxima de caracteres excedida",
      }
    },
    methods: {
      async initialize() {
          this.loading_init = true;

        try {
          //
        } catch (e) {
          //
        } finally {
          this.loading_init = false;
        }
      },
    },
    mounted() {
      this.initialize();
    }
  }
</script>