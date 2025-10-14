<template>
        <v-navigation-drawer v-model="drawer" app temporary>
            <v-list-item title="Stockly" subtitle="Aplicativo de Estoque">
            </v-list-item>
            <v-divider></v-divider>
            <v-list-item link title="Fornecedor" @click="router.push('/stockly/app/fornecedor')" :class="linkfornecedor"></v-list-item>
            <v-list-item link title="Material" @click="router.push('/stockly/app/material')" :class="linkmaterial"></v-list-item>
            <v-list-item link title="List Item 3"></v-list-item>
        </v-navigation-drawer>

        <v-app-bar>
            <v-app-bar-title>
                <div class="brand" @click="drawer = !drawer">
                    <img 
                        width="50"
                        src="@/assets/stockly.png"
                        />
                    <div class="title mx-2">Stockly</div>
                </div>
            </v-app-bar-title>
        </v-app-bar>
</template>

<script setup>
    import { computed, ref } from 'vue';
    import { useRouter } from 'vue-router';
    
    const router= useRouter()
    const linkfornecedor = computed(() => {
        if(router.currentRoute.value.name == "homeFornecedor"){
            return "link"
        }else{
            return ""
        }
    })

    const linkmaterial = computed(() => {
        if(router.currentRoute.value.name == "homeMaterial"){
            return "link"
        }else{
            return ""
        }
    })

    
    const drawer= ref(false)
</script>

<style scoped>
    .brand{
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .title{
        font-weight: 300;
        font-size: 1.7rem;
    }
    .link{
        background: rgb(0, 183, 255);
        color: white;
    }
    
</style>