<template>
    <v-app-bar class="d-flex align-center justify-center">
        <v-container fluid="True">
            <v-row align-content="center" style="width: 100%">
                <v-col cols="12" style="border: 1px solid red">
                    <v-switch></v-switch>
                </v-col>
            </v-row>
        </v-container>
    </v-app-bar>
    <v-container class="fill-height" fluid="True">
        <v-row align-content="center">
            <v-col>
                <v-sheet class="mx-auto pa-6 rounded-lg elevation-2" width="30%">
                    <v-form fast-fail @submit.prevent>
                    <v-text-field
                        v-model="username"
                        :rules="userNameRules"
                        label="Nome de usuário"
                    ></v-text-field>

                    <v-text-field
                        v-model="password"
                        :rules="passwordNameRules"
                        label="Senha"
                        type="password"
                    ></v-text-field>
                    <v-container class="d-flex justify-center">
                        <v-btn  variant="tonal">Login</v-btn>
                    </v-container>
                    </v-form>
                </v-sheet>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
   
</script>

<style scoped>
    
</style>
