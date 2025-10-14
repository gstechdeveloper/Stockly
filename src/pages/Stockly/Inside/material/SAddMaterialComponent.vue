<template>
    <form @submit.prevent="submit" ref="form">
    <v-container fluid>
        <v-row>
            <v-col>
                <h1>Adicionar Material</h1>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="4" lg="3">
                <v-text-field label="Nome do Material" ref="NomeMaterialRef" v-model="nome" variant="outlined" :rules="nomeMaterialRules" :error-messages="nomeMaterialError" @keypress="nomeMaterialError= ''"></v-text-field>
            </v-col>
            <v-col cols="12" md="4" lg="3">
                <v-text-field label="Descrição" v-model="descricao" variant="outlined"></v-text-field>
            </v-col>
            <v-col cols="12" md="4" lg="2">
                <v-text-field label="Unidade" v-model="unidade_medida" :rules="unidade_medidaRules" ref="unidade_medidaRef" variant="outlined"></v-text-field>
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12" md="4" lg="2">
                <v-text-field label="Estoque mínimo" type="number" v-model="estoque_minimo" :rules="estoque_minimoRules" ref="estoque_minimoRef" variant="outlined"></v-text-field>
            </v-col>
            <v-col cols="12" md="4" lg="2">
                <v-text-field label="Localização" v-model="localizacao" variant="outlined"></v-text-field>
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
    const NomeMaterialRef= useTemplateRef("NomeMaterialRef")
    const unidade_medidaRef= useTemplateRef("unidade_medidaRef")
    const estoque_minimoRef= useTemplateRef("estoque_minimoRef")
    const nome= ref("")
    const descricao= ref("")
    const unidade_medida= ref("")
    const estoque_minimo= ref("")
    const localizacao= ref("")
    const snackbar= ref(false)
    const snackMessage= ref({
        color: "",
        message: ""
    })
    
    const timeout= ref(2000)

    const form= ref(null)
    const nomeMaterialError= ref("")

    const nomeMaterialRules = [
        v => {
            if(v) return true
            
            return "O nome do material é obrigatório!"
        },
        v => (v && v.length >= 3) || "O nome do material deve ter no mínimo 3 caracteres"
    ]

    const unidade_medidaRules= [
        v => {
            if(v) return true
            return "A unidade de medida é obrigatória!"
        }
    ]

    const estoque_minimoRules= [
        v => {
            if(v) return true
            return "O estoque mínimo é obrigatório!"
        }
    ]

    const submit= () => {
        if(NomeMaterialRef.value.errorMessages.length == 0 && estoque_minimoRef.value.errorMessages.length == 0 && unidade_medidaRef.value.errorMessages.length == 0){
            request("post","material/add",{
                nome: nome.value,
                descricao: descricao.value,
                unidade_medida: unidade_medida.value,
                estoque_minimo: estoque_minimo.value,
                localizacao: localizacao.value
            }).then((res) => {
                snackMessage.value.message= res.data.message
                snackMessage.value.color= "green"
                snackbar.value= true
                nome.value= ""
                descricao.value= ""
                unidade_medida.value= ""
                estoque_minimo.value= ""
                localizacao.value= ""
            }).catch((err) => {
                nomeMaterialError.value= err.response.data.errors.nome
            })
        }else{
            nomeMaterialError.value= NomeMaterialRef.value.errorMessages[0]
        }
    }

</script>

<style scoped>
   
</style>