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
                <span class="display-2 color-base--text">Home</span>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col class="col-12 col-md-4">
            CARD 1
          </v-col>
          <v-col class="col-12 col-md-4">
            CARD 2
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

  export default {
  	name: "HomeIndex",
    mixins: [validationMixin],
    validations: {},
    inject: {},
  	data() {
      return {
        loading_init: true,
        loading: false,

        prestadorItems: [],
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
          //await this.getPrestadores();
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