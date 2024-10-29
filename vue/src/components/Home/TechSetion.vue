<template>
  <div class="tech mb-5">
    <div class="container">
      <p class="text-center">Our Tecnologies That We Work By</p>

      <div class="row gy-5 mt-5">
        <div
          class="col-lg-3 col-md-6 col-6"
          v-for="(item, index) in toRaw(data)"
          :key="index"
        >
          <div :class="{ 'd-flex justify-content-center': pageSize > 992 }">
            <div class="tech-logo d-flex align-items-center gap-3">
              <img :src="item.image_with_full_path" width="60" alt="vue-logo" loading="lazy" />

              <span>{{ item.name }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, toRaw } from "vue";
import axios from "axios";
import { url } from "@/config";
import { useSidebarWidth } from "@/compasaples/media";
import fetchPageData from "@/api/get/fetchPageData";

const { pageSize } = useSidebarWidth();


const data = ref(null);

onMounted(async () => {
  try {
    data.value = await fetchPageData('technologies');
  } catch (error) {
    console.error("Error fetching page data:", error);
  }
});

</script>

<style lang="scss" scoped>
p {
  color: #667085;
}

.tech-logo {
  span {
    font-size: 21px;
    font-weight: bold;
  }
}
</style>
