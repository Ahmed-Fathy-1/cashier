<template>
  <ContextRatingProvider>
  <div class="app-content">
    <RouterView />
  </div>
  <RatingServices />  
</ContextRatingProvider>
</template>

<script>
import { RouterView, useRouter } from "vue-router";
import ContextRatingProvider from "./components/providers/ContextRatingProvider.vue";
import RatingServices from "./components/General/RatingServices.vue";
import { onMounted } from "vue";

export default {
  components: {
    ContextRatingProvider,
    RatingServices,
  },
 setup() {

    const router = useRouter(null);

    onMounted(() => {
      console.log('Component is mounted!');
      if (!localStorage.getItem('token') || localStorage.getItem('token') === 'undefined') {
        router.push('/login')
      }
      else{
        const token = localStorage.getItem('token');
      }
    });
  },
};
</script>

<style>
.app-content{
  position: relative;
  z-index: 0;
}
</style>