<template>
    <v-container fluid>
        <v-row>
            <v-col>
                <h1>Listar</h1>
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12" v-for="key, item in items" :key="key">
                <v-expansion-panels variant="accordion" style="margin: 0px">
                    <v-expansion-panel >
                        <v-expansion-panel-title class="text-button">
                            <v-avatar color="primary" class="mr-5">
                                <v-icon icon="mdi-account-tie"></v-icon>
                            </v-avatar> 
                            {{ items[item].nome }}
                        </v-expansion-panel-title>
                        <v-expansion-panel-text>
                            <v-container fluid>
                                <v-row>
                                    <v-col cols="6">
                                        <b>Nome do Fornecedor:</b> {{ items[item].nome }}
                                    </v-col>
                                    <v-col cols="6">
                                        <b>Endereço:</b> {{ items[item].endereco || "Não informado" }}
                                    </v-col>
                                    <v-col cols="6">
                                        <b>CNPJ:</b> {{ items[item].cnpj || "Não informado" }}
                                    </v-col>
                                    <v-col cols="6">
                                        <b>Inscrição:</b> {{ items[item].inscricao || "Não informado" }}
                                    </v-col>
                                    <v-col cols="6">
                                        <b>Tipo de Fornecedor:</b> {{ items[item].tipofornecedor || "Não informado" }}
                                    </v-col>
                                    <v-col cols="6">
                                        <b>Telefone:</b> {{ items[item].telefone || "Não informado" }}
                                    </v-col>
                                    <v-col cols="6">
                                        <b>Situação:</b> {{ items[item].situacao || "Não informado" }}
                                    </v-col>  
                                    <v-col cols="12">
                                        <hr>
                                    </v-col>
                                    <v-col cols="12">
                                        <h1 class="text-overline">Ações:</h1>
                                    </v-col>
                                    <v-col cols="4">
                                        <v-btn color="info" class="text-overline" @click="editFornecedor(items[item].nome)">Editar</v-btn>
                                    </v-col>
                                    
                                </v-row>
                            </v-container>
                        </v-expansion-panel-text>
                    </v-expansion-panel>
                </v-expansion-panels>
            </v-col>
            <v-col cols="4">
                {{ "Página " + currentinfoPage + " de " + infoLastPage }}
            </v-col>
            <v-col cols="2" md="4" lg="6"></v-col>
            <v-col cols="3" md="2" lg="1">
                <v-btn variant="outlined" color="primary" @click="search(anterior)" :disabled="anterior == null ? true : false" class="w-100">Anterior</v-btn>
            </v-col>
            <v-col cols="3" md="2" lg="1">
                <v-btn variant="outlined" color="primary" @click="search(prox)" :disabled="prox == null ? true : false" class="w-100">Próximo</v-btn>
            </v-col>
        </v-row>
    </v-container>

    <v-dialog
      v-model="dialog"
      class="w-sm-100 w-md-75 w-lg-50"
    >
      <v-card
        prepend-icon="mdi-account-edit"
        title="Editar usuário"
      >
        <v-card-text>
            <v-container>
                <v-row>
                    <v-col cols="12" sm="12" md="6">
                        <v-text-field variant="outlined" disabled label="Nome atual" v-model="currentNome"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="6">
                        <v-text-field variant="outlined" label="Nome atualizado" v-model="updatedNome" :rules="fornecedorName" :error-messages="errorFornecedor" ref="fornecedorNameRef"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="6">
                        <v-text-field variant="outlined" label="Endereço" v-model="endereco"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="6">
                        <v-text-field variant="outlined" label="CNPJ" v-model="cnpj"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="6">
                        <v-text-field variant="outlined" label="Inscrição" v-model="inscricao"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="6">
                        <v-select
                            label="Tipo de Fornecedor"
                            v-model="tipofornecedor"
                            :items="['MEI','ME','PF']"
                            variant="outlined"
                        ></v-select>
                    </v-col>
                    <v-col cols="12" sm="12" md="6">
                        <v-text-field variant="outlined" label="Telefone" v-model="telefone"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="6">
                        <v-select
                            label="Situação"
                            v-model="situacao"
                            :items="['Ativo','Inativo']"
                            variant="outlined"
                        ></v-select>
                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>
        <template v-slot:actions style="padding: 10px">
        <v-container fluid style="padding: 0">
            <v-row>
            <v-col cols="6" md="8"></v-col>
            <v-col cols="3" md="2">
                <v-btn
                class="ms-auto"
                color="danger"
                text="cancelar"
                variant="outlined"
                @click="dialog = false"
                ></v-btn>
            </v-col>
            <v-col cols="3" md="2">
                <v-btn
                width="auto"
                class="ms-auto"
                color="info"
                text="Atualizar"
                variant="outlined"
                @click="update"
                ></v-btn>
            </v-col>
            </v-row>
        </v-container>
        </template>
      </v-card>
    </v-dialog>

    <v-snackbar
      v-model="snackbar"
      :timeout="timeout" 
      :color="snackMessage.color"
      class="text-center"
    >
      {{ snackMessage.message }}

    </v-snackbar>

</template>

<script setup>
    import { request } from '@/composables/request';
    import { onMounted, ref, useTemplateRef } from 'vue';
    import { useRouter } from 'vue-router'

    const currentinfoPage= ref("")
    const infoLastPage= ref("")
    const anterior= ref("")
    const prox= ref("")

    const fornecedorNameRef= useTemplateRef("fornecedorNameRef")
    const dialog= ref(false)
    const router= useRouter()
    const items= ref([])
    const currentNome= ref("")
    const updatedNome= ref("")
    const endereco= ref("")
    const cnpj= ref("")
    const timeout= ref(2000)
    const inscricao= ref("")
    const errorFornecedor= ref("")
    const tipofornecedor= ref("")
    const telefone= ref("")
    const snackbar= ref(false)
    const snackMessage= ref({
        color: "",
        message: ""
    })
    const situacao= ref("")

    const fornecedorName = [
        v => {
            if(v) return true
            
            return "O nome de fornecedor é obrigatório!"
        },
        v => (v && v.length >= 3) || "O nome do fornecedor deve ter no mínimo 3 caracteres"
    ]  

    const search= (url) => {
        request("get",url,{},true,false).then((res) => {
            items.value= res.data.data
            currentinfoPage.value= res.data.current_page
            infoLastPage.value= res.data.last_page
            anterior.value= res.data.prev_page_url
            prox.value= res.data.next_page_url
        })
    }

    const update= () => {
        if(fornecedorNameRef.value.errorMessages.length == 0){
            request("put","fornecedor/update",{ 
                currentNome: currentNome.value,
                updatedNome: updatedNome.value,
                endereco: endereco.value,
                cnpj: cnpj.value,
                inscricao: inscricao.value,
                tipofornecedor: tipofornecedor.value,
                telefone: telefone.value,
                situacao: situacao.value
            }).then((res) => {
                dialog.value = false
                snackMessage.value.color= "success"
                snackMessage.value.message= res.data.message
                snackbar.value= true
                request("get","fornecedor/list",{}).then((res) => {
                    items.value= res.data.data
                })
            }).catch((err) => {
                errorFornecedor.value= err.response.data.errors.updatedNome
            })
        }
    }

    const editFornecedor= (nome) => {
        dialog.value= true
        request("post","fornecedor/select",{ "nome": nome}).then((res) => {
            currentNome.value= res.data[0].nome
            updatedNome.value= res.data[0].nome
            endereco.value= res.data[0].endereco
            cnpj.value= res.data[0].cnpj
            inscricao.value= res.data[0].inscricao
            tipofornecedor.value= res.data[0].tipofornecedor
            telefone.value= res.data[0].telefone
            situacao.value= res.data[0].situacao
        })
    }

    onMounted(() => {
        request("get","fornecedor/list",{}).then((res) => {
            items.value= res.data.data
            currentinfoPage.value= res.data.current_page
            infoLastPage.value= res.data.last_page
            anterior.value= res.data.prev_page_url
            prox.value= res.data.next_page_url
        })
    })
</script>

<style scoped>
   
</style>