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
              <span class="display-2 color-base--text">Usuários</span>
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
          <v-card flat>
            <v-card-text>
              <v-row>
                <v-col class="col-12 col-md-4">
                  <v-text-field
                    v-model="searchContent"
                    outlined
                    dense
                    placeholder="Digite sua pesquisa..."
                    color="color-base"
                    append-icon="mdi-magnify"
                    clearable
                    hide-details
                    persistent-placeholder>
                  </v-text-field>
                </v-col>
                <v-col class="col-12 col-md-8 text-right">
                  <v-btn
                    color="color-base"
                    class="white--text"
                    :to="{ name: 'UsersCreate' }">
                    <v-icon left>
                      mdi-plus-box-outline
                    </v-icon>
                    Novo Usuário
                  </v-btn>
                </v-col>
              </v-row>
              <v-row>
                <v-col class="col-12">
                  <v-data-table
                    class="v-sheet v-sheet--outlined"
                    dense
                    fixed-header
                    :headers="headers"
                    :items="items"
                    :loading="loading"
                    loading-text="Carregando..."
                    no-data-text="Vazio"
                    no-results-text="Não encontrado"
                    :search="searchContent">
                    <template v-slot:item.name="{ item }">
                      <v-avatar size="25">
                        <v-img :src="require('@/assets/avatar.png')"></v-img>
                      </v-avatar>
                      <span class="blue--text ml-2">{{ item.name | truncate(20) }}</span>
                    </template>
                    <template v-slot:item.created_at="{ item }">
                      <span>{{ item.created_at | moment("L LT") }}</span>
                    </template>
                    <template v-slot:item.actions="{ item }">
                      <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                          <v-btn 
                            disabled
                            v-on="on"
                            v-bind="attrs"
                            icon>
                            <v-icon
                            color="blue">
                            mdi-eye
                            </v-icon>
                          </v-btn>
                        </template>
                        <span>Visualizar</span>
                      </v-tooltip>
                      <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                          <v-btn 
                            v-on="on"
                            v-bind="attrs"
                            icon
                            :to="{ name: 'UsersEdit', params: { user: item.uuid } }">
                            <v-icon
                              color="green">
                              mdi-pencil
                            </v-icon>
                          </v-btn>
                        </template>
                        <span>Editar</span>
                      </v-tooltip>
                      <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                          <v-btn 
                            v-on="on"
                            v-bind="attrs"
                            icon
                            disabled>
                            <v-icon
                              color="red">
                              mdi-delete
                            </v-icon>
                          </v-btn>
                        </template>
                        <span>Apagar</span>
                      </v-tooltip>
                    </template>
                  </v-data-table>
                </v-col>
              </v-row>
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

  import Breadcrumbs from '@/components/Breadcrumbs.vue';

  export default {
    name: "UsersIndex",
    data() {
      return {
        loading_init: true,
        loading: false,

        headers: [
          { text: 'UUID', align: 'start', sortable: true, value: 'uuid', class: 'color-base--text' },
          { text: 'Nome', align: 'start', sortable: true, value: 'name', class: 'color-base--text' },
          { text: 'Email', align: 'start', sortable: true, value: 'email', class: 'color-base--text' },
          { text: 'Data de Criação', align: 'start', sortable: true, value: 'created_at', class: 'color-base--text' },
          { text: 'Ações', align: 'start', sortable: false, value: 'actions', class: 'color-base--text' },
        ],
        items: [],
        searchContent: "",

        breadcrumbs: [ 
          { id: 1, to: { name: 'Home' }, disabled: false, text: 'Home' }, 
          { id: 2, to: { name: 'UsersIndex' }, disabled: true, text: 'Usuários' }, 
        ],

        totalItems: 0,
      }
    },
    components: {
      SK2,
      Breadcrumbs,
    },
    computed: {
      ...mapGetters("auth", ["usuario"]),
    },
    methods: {
      async initialize() {
        this.loading_init = true;

        try {
          await this.paginate();
        } catch (e) {
          //
        } finally {
          this.loading_init = false;
        }
      },
      async paginate() {
        this.loading = true;
        
        try {
          let params = {...this.options};

          const response = await User.index(params);
          this.items = response.data.data;
          this.totalItems = response  .data.meta.total;
        } catch(e) {
          //
        } finally {
          this.loading = false;
        }
      },
    },
    async created() {},
    mounted() {
      this.initialize();
    }
  }
</script>