<template>
    <v-app-bar class="d-flex align-center justify-center" style="padding: 20px">
        <template #append>
            <v-container>
                <v-row>
                    <v-col>
                        <h5 class="text-h6">Tema:</h5>
                        <v-switch :label="Ltheme" @change="changeTheme"></v-switch>
                    </v-col>
                </v-row>
            </v-container>
        </template>
    </v-app-bar>
    
    <v-container class="fill-height">
        <v-row align-content="center">
            <v-col>
                <v-sheet class="mx-auto pa-6 rounded-lg elevation-2 text-center w-sm-75 w-md-50 w-lg-25">
                    <h5 class="text-h2 pa-5 text-primary">Stockly</h5>
                    <v-form @submit.prevent="submitForm" ref="formRef">
                    <v-text-field
                        v-model="username"
                        :rules="userNameRules"
                        label="Nome de usuário"
                        ref="usernameRef"
                        class="mt-5"
                    ></v-text-field>

                    <v-text-field
                        v-model="password"
                        :rules="passwordRules" 
                        label="Senha"
                        type="password"
                        ref="passwordRef"
                        class="mt-5"
                    ></v-text-field>
                    <v-container class="d-flex justify-center">
                            <v-btn  type="submit" variant="outlined" color="primary">Login</v-btn>
                    </v-container>

                    </v-form>
                </v-sheet>
            </v-col>
        </v-row>
        
    </v-container>

    <v-snackbar
      v-model="snackbar"
      :timeout="timeout" 
      color="red"
      class="text-center"
    >
      {{ message }}

    </v-snackbar>
</template>

<script setup>
    import { ref, useTemplateRef } from 'vue';
    import { useTheme } from 'vuetify';
    import { request } from '@/composables/request';


    const theme= useTheme()
    const Ltheme= ref("Claro")
    const username= ref("")
    const message= ref("")
    const snackbar= ref(false)
    const timeout= ref(2000)
    const password= ref("")
    const formRef= ref(null)
    const usernameRef= useTemplateRef("usernameRef")
    const passwordRef= useTemplateRef("passwordRef")

    const userNameRules = [
        v => {
            if(v) return true
            
            return "O nome de usuário é obrigatório!"
        },
        v => (v && v.length >= 3) || "O nome deve ter ao menos 3 caracteres"
    ]

    const passwordRules = [
        v => !!v || "A senha é obrigatória",
        v => (v && v.length >= 6) || "A senha deve ter ao menos 6 caracteres"
    ]   

    const changeTheme= () =>{
        if(theme.global.name.value == "dark"){
            theme.change("light")
            Ltheme.value= "Claro"
        }else{
            theme.change("dark")
            Ltheme.value= "Escuro"
        }
    }

    const submitForm= () => {
        if(usernameRef.value.errorMessages.length == 0 && passwordRef.value.errorMessages.length == 0){
            request("post","login",{
                name: username.value,
                password: password.value
            }, false).then((res) => {
                console.log(res)
            }).catch((err) => {
                message.value= err.response.data.error
                snackbar.value= true
            })
        }
    }
</script>

<style scoped>

</style>
