<template>
  
  <div class="layout">
    <NavBar v-if="$route.path == '/'" />
    <NavBar2 v-if="$route.path != '/'" />
    <router-view></router-view>
    <Footer />
  </div>
</template>



<script setup>
import NavBar from "@/components/partials/NavBar.vue";
import NavBar2 from "@/components/partials/NavBar2.vue";
import { useScroll } from "@/compasaples/scroll";
import Footer from "@/components/partials/Footer.vue";
const { nav } = useScroll();
</script>

<style lang="scss" scoped></style>
