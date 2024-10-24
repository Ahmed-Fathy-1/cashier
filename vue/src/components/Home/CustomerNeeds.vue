<template>
  <div class="custommers-needs mb-5">
    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-6 col-md-12 col-12">
          <div class="title">
            <h1>{{ data?.title }}</h1>
            <p>
              {{ data?.desc }}
            </p>
          </div>

          <div class="points mt-5">
            <div
              class="point d-flex gap-3 align-items-center"
              v-for="(need, index) in data?.sub_needs"
              :key="index"
              :class="{ 'mt-4 mb-4': index == 1 }"
            >
              <img :src="need?.image" width="50" alt="..." />

              <div class="text">
                <h6 class="fw-bold">{{ need.title }}</h6>
                <p>{{ need.desc }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-12 col-12">
          <div class="image d-flex justify-content-end">
            <img
              src="../../assets/images/customer-mobile.svg"
              width="400"
              alt="...."
              loading="lazy"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, toRaw } from "vue";
import fetchPageData from "@/api/get/fetchPageData";

const data = ref(null);

onMounted(async () => {
  try {
    data.value = await fetchPageData('main_needs');
    console.log(data.main_needs); // This logs the title if available
  } catch (error) {
    console.error("Error fetching page data:", error);
  }
});

</script>

<style lang="scss" scoped>
.custommers-needs {
  background-image: url(../../assets/images/customers.svg);
  background-repeat: no-repeat;
  background-size: contain;
  background-position-x: right;
  margin-top: 10rem;
  p {
    color: #505056;
  }
}

@media (max-width: 992px) {
  .custommers-needs {
    background-position-y: bottom;
    background-size: 25rem;
  }
}
</style>
