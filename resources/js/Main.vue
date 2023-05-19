
<template>
   <v-app id="app">
      <v-main>
         <keep-alive :include="['Login']">
            <router-view></router-view>
         </keep-alive>
      </v-main>
   </v-app>
</template>

<script>
export default {
   name: 'App',
   data() {
      return {
         drawer: false,
      };
   },
};
</script>

<style></style>
