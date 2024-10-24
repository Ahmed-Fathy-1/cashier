<template>
  <AppBanner />
  <WhayUs />
  <TechSetion />
  <CustomerNeeds />
  <CounterSection />
  <PackagesSection />
  <Feedback />
  <FrequentlyQues />
</template>

<script setup>
import AppBanner from "@/components/Home/AppBanner.vue";
import { defineAsyncComponent } from "vue";

const delay = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

const WhayUs = defineAsyncComponent(() =>
  delay(1000).then(() => import("@/components/Home/WhayUs.vue"))
);
const TechSetion = defineAsyncComponent(() =>
  delay(2000).then(() => import("@/components/Home/TechSetion.vue"))
);
const CustomerNeeds = defineAsyncComponent(() =>
  delay(1000).then(() => import("@/components/Home/CustomerNeeds.vue"))
);
const CounterSection = defineAsyncComponent(() =>
  delay(1000).then(() => import("@/components/Home/CounterSection.vue"))
);
const PackagesSection = defineAsyncComponent(() =>
  delay(1000).then(() => import("@/components/Home/PackagesSection.vue"))
);
const Feedback = defineAsyncComponent(() =>
  delay(1000).then(() => import("@/components/Home/Feedback.vue"))
);
const FrequentlyQues = defineAsyncComponent(() =>
  delay(1000).then(() => import("@/components/Home/FrequentlyQues.vue"))
);
</script>

<style lang="scss"></style>
