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
                        <s-add-material-component></s-add-material-component>
                    </v-tabs-window-item>

                    <v-tabs-window-item value="two">
                        <s-view-material-component></s-view-material-component>
                    </v-tabs-window-item>
                </v-tabs-window>
            </v-card-text>
        </v-card>
    </v-main>
</template>

<script setup>
    import SAddMaterialComponent from './SAddMaterialComponent.vue';
    import SViewMaterialComponent from './SViewMaterialComponent.vue';

    import { ref } from 'vue';
    const tab= ref(null)

</script>

<style scoped>
    .active{
        background: rgb(0, 183, 255);
        color: white;
    }
</style>