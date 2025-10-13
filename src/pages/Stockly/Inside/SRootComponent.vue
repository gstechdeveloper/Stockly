<template>
    <v-app>
    <inside-app-bar></inside-app-bar>
        <router-view></router-view>
    </v-app>
</template>

<script setup>
    import InsideAppBar from '@/components/InsideAppBar.vue';
</script>

<style scoped>
    
</style>
