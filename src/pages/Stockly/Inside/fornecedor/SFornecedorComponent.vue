<template>
    <v-main>
        <v-card>
            <v-tabs
                v-model="tab"
                bg-color="primary"
                >
                <v-tab value="one">Adicionar</v-tab>
                <v-tab value="two">Listar</v-tab>
            </v-tabs>

            <v-card-text style="border-bottom: 0; border-bottom-color: transparent;">
                <v-tabs-window v-model="tab">
                    <v-tabs-window-item value="one">
                        <SAddFornecedorComponent></SAddFornecedorComponent>
                    </v-tabs-window-item>

                    <v-tabs-window-item value="two">
                        <SViewFornecedorComponent></SViewFornecedorComponent>
                    </v-tabs-window-item>
                </v-tabs-window>
            </v-card-text>
        </v-card>
    </v-main>
</template>

<script setup>
    import { ref } from 'vue';
    import SAddFornecedorComponent from './SAddFornecedorComponent.vue';
    import SViewFornecedorComponent from './SViewFornecedorComponent.vue';

    const tab= ref(null)

</script>

<style scoped>
    .active{
        background: rgb(0, 183, 255);
        color: white;
    }
</style>