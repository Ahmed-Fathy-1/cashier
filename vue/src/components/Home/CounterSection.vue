<template>
  <div class="counter text-white mb-5">
    <div class="container">
      <div class="row gy-5">
        <div
          class="col-lg-4 col-md-12 col-12 text-center"
          v-for="(item, index) in numbers"
          :key="index"
        >
          <h6>{{ item.title }}</h6>
          <h3>{{ item.count }}</h3>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { url } from "@/config";

const counter = ref([]);

const props = defineProps({
  numbers: {
    type: Array,
    required: false,
  },
});

</script>

<style lang="scss" scoped>
.counter {
  background-image: url(../../assets/images/counter-bg.svg);
  background-repeat: no-repeat;
  background-size: cover;
  padding: 8rem 0;
}
</style>
