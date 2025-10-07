<template>
  <v-app >
    <router-view />
  </v-app>
</template>

<script setup>
    import { ref, watch } from 'vue';
    import { useTheme } from 'vuetify';
    const theme= useTheme();
    const teste= ref("")

    const wtheme= watch(teste,() => {
      return theme.global.name.value
    })

</script>
