<template>
    <v-app-bar class="d-flex align-center justify-center" style="padding: 20px">
        <v-app-bar-title>Application Bar</v-app-bar-title>
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
                    <h5 class="text-h2 my-5">Stockly</h5>
                    <v-form @submit.prevent="submitForm" ref="formRef">
                    <v-text-field
                        v-model="username"
                        :rules="userNameRules"
                        label="Nome de usuário"
                        :model-value="username"
                    ></v-text-field>

                    <v-text-field
                        v-model="password"
                        :rules="passwordRules" 
                        label="Senha"
                        type="password"
                    ></v-text-field>
                    <v-container class="d-flex justify-center">
                        <v-btn  type="submit" variant="tonal" color="primary">Login</v-btn>
                    </v-container>
                    </v-form>
                </v-sheet>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
    import { ref } from 'vue';
    import { errorMessages } from 'vue/compiler-sfc';
    import { useTheme } from 'vuetify';


    const theme= useTheme()
    const Ltheme= ref("Claro")
    const username= ref("")
    const password= ref("")
    const formRef= ref(null)

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
            theme.global.name.value = "light"
            Ltheme.value= "Claro"
        }else{
            theme.global.name.value= "dark"
            Ltheme.value= "Escuro"
        }
    }

    const submitForm= () => {
        if(formRef.value.validate()){
            console.log("Pronto")
        }
    }
</script>

<style scoped>
    
</style>
