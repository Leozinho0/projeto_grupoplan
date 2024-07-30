<template>
  <div class="containerlogin">
    <div v-if="!loading_init">
      <v-form ref="form_login" @submit.prevent="login" :disabled="loading">
        <v-row>
          <v-col>
            <div class="mb-4">
              <span class="subtitle-2">Faça Login</span>
            </div>
            <v-text-field
              outlined
              v-model.trim="email"
              :error-messages="emailErrors"
              label="E-mail"
              @blur="$v.email.$touch()"
              required
              dense>
            </v-text-field>
            <v-text-field
              outlined
              v-model="password"
              :error-messages="passwordErrors"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :type="show1 ? 'text' : 'password'"
              label="Senha"
              @blur="$v.password.$touch()"
              required
              dense
              @click:append="show1 = !show1">
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
              large
              :loading="loading"
              :disabled="loading"
              block
              type="submit"
              color="deep-orange lighten-1 white--text">
              {{ label_submit_pt }}
            </v-btn>
          </v-col>
        </v-row>
        <v-row>
          <v-col class="text-center">
            <span>{{ label_ou_pt }}</span>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-btn block large color="#26c6da" class="mb-4 white--text" disabled>
              <v-icon
                large
                left
                class="mr-5">
                mdi-twitter
              </v-icon>
              {{ label_iniciar_sessao_twitter_pt }}
            </v-btn>
            <v-btn block large color="#4285f4" class="white--text" disabled>
              <v-icon
                large
                left
                class="mr-5">
                mdi-google-plus
              </v-icon>
              {{ label_iniciar_sessao_google_pt }}
            </v-btn>
          </v-col>
        </v-row>
      </v-form>
    </div>
    <div v-else>
      <SK2></SK2>
    </div>
  </div>
</template>

<script>
  import { mapActions, mapGetters } from "vuex";
  import { validationMixin } from "vuelidate";
  import { required, email } from "vuelidate/lib/validators";
  import SK2 from "@/components/SK2.vue";

  export default {
    mixins: [validationMixin],
    name: "ContainerLogin",
    components: {
      SK2,
    },
    validations: {
      email: { required, email },
      password: { required }
    },
    data() {
      return {
        loading_init: true,
        loading: false,

        label_obrigatorio_pt: "Campo obrigatório", 
        label_invalido_pt: "Dado inválido",
        label_submit_pt: "Acessar",
        label_ou_pt: 'Ou',
        label_iniciar_sessao_twitter_pt: 'Iniciar sessão com o Twitter',
        label_iniciar_sessao_google_pt: 'Iniciar sessão com o Google',
        
        email: "",
        password: "",
        show1: false,

        errors: {},
      }
    },
    computed: {
      ...mapGetters("auth", ["usuario"]),
      emailErrors() {
        const errors = [];
        if (!this.$v.email.$dirty) return errors;
        !this.$v.email.email && errors.push(this.label_invalido_pt);
        !this.$v.email.required && errors.push(this.label_obrigatorio_pt);
        return errors;
      },
      passwordErrors() {
        const errors = [];
        if (!this.$v.password.$dirty) return errors;
        !this.$v.password.required && errors.push(this.label_obrigatorio_pt);
        return errors;
      },
    },
    methods: {
      ...mapActions("auth", ["signIn"]),
      async login(){
        this.$v.$touch();

        if(!this.$v.$invalid){
          this.loading = true;
          this.errors = {};

          let params = {
            email: this.email,
            password: this.password,
            device_name: 'browser'
          };

          try {
            await this.signIn(params);
            this.$router.push({ name: 'Home' });
          } catch(e) {
            if(e.response.status === 422) {
              this.errors = e.response.data.errors;
            }
          } finally {
            this.loading = false;
          }
        }
      },
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