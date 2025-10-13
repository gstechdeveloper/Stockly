<template>
    <form @submit.prevent="submit" ref="form">
    <v-container fluid>
        <v-row>
            <v-col>
                <h1>Editar</h1>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="4" lg="3">
                <v-text-field label="Fornecedor" ref="FornecedorNameRef" v-model="fornecedor" variant="outlined" :rules="fornecedorName" :error-messages="errorFornecedor" @keypress="errorFornecedor= ''"></v-text-field>
            </v-col>
            <v-col cols="12" md="4" lg="3">
                <v-text-field label="Endereço" v-model="endereco" variant="outlined"></v-text-field>
            </v-col>
            <v-col cols="12" md="4" lg="2">
                <v-text-field label="CNPJ" v-model="cnpj" variant="outlined"></v-text-field>
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12" md="4" lg="2">
                <v-text-field label="Inscrição Estadual" v-model="inscricao" variant="outlined"></v-text-field>
            </v-col>
            <v-col cols="12" md="4" lg="2">
                <v-select
                    label="Tipo de Fornecedor"
                    v-model="tipoFornecedor"
                    :items="['MEI','ME','PF']"
                    variant="outlined"
                ></v-select>
            </v-col>
            <v-col cols="12" md="4" lg="2">
                <v-text-field label="Telefone" v-model="telefone" variant="outlined"></v-text-field>
            </v-col>
            <v-col cols="12" md="4" lg="2">
                <v-select
                    label="Situação"
                    v-model="situacao"
                    :items="['Ativo','Inativo']"
                    variant="outlined"
                ></v-select>
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12" md="4" lg="2">
                <v-btn type="submit" variant="outlined" color="primary">Adicionar</v-btn>
            </v-col>
        </v-row>
    </v-container>
    </form>

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
    import { ref, useTemplateRef } from 'vue'
    import { request } from '@/composables/request'

    const FornecedorNameRef= useTemplateRef("FornecedorNameRef")
    const fornecedor= ref("")
    const endereco= ref("")
    const cnpj= ref("")
    const inscricao= ref("")
    const tipoFornecedor= ref("")
    const telefone= ref("")
    const snackbar= ref(false)
    const snackMessage= ref({
        color: "",
        message: ""
    })
    const situacao= ref("")
    const timeout= ref(2000)

    const form= ref(null)
    const errorFornecedor= ref("")

    const fornecedorName = [
        v => {
            if(v) return true
            
            return "O nome de fornecedor é obrigatório!"
        },
        v => (v && v.length >= 3) || "O nome do fornecedor deve ter no mínimo 3 caracteres"
    ]    

    const submit= () => {
        console.log(FornecedorNameRef.value.errorMessages)
        if(FornecedorNameRef.value.errorMessages.length == 0){
            request("post","fornecedor/add",{
                nome: fornecedor.value,
                endereco: endereco.value,
                cnpj: cnpj.value,
                inscricao: inscricao.value,
                tipofornecedor: tipoFornecedor.value,
                telefone: telefone.value,
                situacao: situacao.value
            }).then((res) => {
                snackMessage.value.message= res.data.message
                snackMessage.value.color= "green"
                snackbar.value= true
                fornecedor.value= ""
                endereco.value= ""
                cnpj.value= ""
                inscricao.value= ""
                tipoFornecedor.value= ""
                telefone.value= ""
                situacao.value= ""
            }).catch((err) => {
                errorFornecedor.value= err.response.data.errors.nome
            })
        }else{
            errorFornecedor.value= FornecedorNameRef.value.errorMessages[0]
        }
    }

</script>

<style scoped>
   
</style>