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
                      v-model.trim="user.name" 
                      color="color-base"
                      label="Nome" 
                      outlined 
                      dense
                      :error-messages="nameErrors"
                      @blur="$v.user.name.$touch()"
                      persistent-placeholder
                      required>   
                    </v-text-field>
                  </v-col>
                  <v-col class="col-12 col-md-6">
                    <v-text-field
                      v-model.trim="user.email" 
                      color="color-base"
                      label="E-mail" 
                      outlined 
                      dense
                      :error-messages="emailErrors"
                      @blur="$v.user.email.$touch()"
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
  import { required, email, maxLength } from "vuelidate/lib/validators";

  export default {
    mixins: [validationMixin],
    name: "UsersForm",
    validations: {
      user: {
        name: { required },
        email: { required, email },
      },
    },
    props: {
      user: {
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
        if (!this.$v.user.name.$dirty) return errors;
        !this.$v.user.name.required && errors.push(this.valid_label_obrigatorio);
        return errors;
      },
      emailErrors() {
        const errors = [];
        if (!this.$v.user.email.$dirty) return errors;
        !this.$v.user.email.email && errors.push(this.valid_label_invalido);
        !this.$v.user.email.required && errors.push(this.valid_label_obrigatorio);
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