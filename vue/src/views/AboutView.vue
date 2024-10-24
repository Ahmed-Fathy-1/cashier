<template>
  <div class="about-us">
    <div class="title text-center">
      <h1>A: {{ data?.aboutUs?.intro_title}} </h1>
      <p>
        {{data?.aboutUs?.intro_desc}}
      </p>
    </div>

    <CustomerNeeds />
    <CounterSection  :numbers="data?.aboutUs?.numbers"/>
    <HowWork :workflow="data?.aboutUs?.workflow"/>
    <!-- <OurExperience /> -->
  </div>
</template>

<script setup>
import CustomerNeeds from "@/components/Home/CustomerNeeds.vue";
import HowWork from "@/components/About/HowWork.vue";
import CounterSection from "@/components/Home/CounterSection.vue";
import fetchPageData from "@/api/get/fetchPageData";
import {ref,onMounted} from 'vue';

const data = ref(null);

onMounted(async () => {
  try {
    data.value = await fetchPageData('about-us');
    console.log(data.value?.aboutUs?.intro_title); // This logs the title if available
  } catch (error) {
    console.error("Error fetching page data:", error);
  }
});




</script>

<style lang="scss" scoped>
.about-us {
  margin: 6rem 0;
}

.custommers-needs {
  margin-top: 5rem;
}
</style>


