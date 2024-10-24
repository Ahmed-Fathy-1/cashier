<template>
  <div class="feed-back pt-5 pb-5">
    <div class="container">
      <div class="title text-center">
        <h1>Feedback from our customers</h1>
      </div>

      <Carousel
        :autoplay="2000"
        v-bind="settings"
        :breakpoints="breakpoints"
        class="mt-5"
      >
        <Slide v-for="(slide, index) in 10" :key="index">
          <div class="carousel__item">
            <div class="card m-3 text-start">
              <div class="card-body py-1 px-4">
                <v-rating
                  v-model="rating"
                  class="ma-2"
                  color="yellow"
                  density="compact"
                  size="small"
                ></v-rating>

                <p>
                  "Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  Suspendisse varius enim in eros elementum tristique. Duis
                  cursus, mi quis viverra ornare."
                </p>

                <div class="writer d-flex align-items-center gap-2">
                  <img src="../../assets/images/writer.png" width="30" alt="" />
                  <div class="name">
                    <span class="fw-bold">Jenny Wilson</span>
                    <p class="mb-0">14 jan , 2024s</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </Slide>

        <template #addons>
          <Navigation />
        </template>
      </Carousel>
    </div>
  </div>
</template>


<script setup>
import "vue3-carousel/dist/carousel.css";
import { Carousel, Navigation, Slide } from "vue3-carousel";
import { ref, onMounted, toRaw } from "vue";
import fetchPageData from "@/api/get/fetchPageData";

const active = ref(true);


const data = ref(null)

onMounted(async() => {
 try {
    data.value = await fetchPageData('feedbacks');
    console.log(
      toRaw(data?.value)
    ); 
  } catch (error) {
    console.error("Error fetching page data:", error);
  }
});

const settings = ref({
  itemsToShow: 1,
  snapAlign: "center",
});

const breakpoints = ref({
  700: {
    itemsToShow: 2,
    snapAlign: "center",
  },
  // 1024 and up
  1024: {
    itemsToShow: 3,
    snapAlign: "start",
  },
});

const rating = ref(5);
</script>

<style lang="scss" scoped>
.feed-back {
  background-color: var(--bs-info);
}

.writer {
  .name {
    span,
    p {
      font-size: 12px;
    }
  }
}
</style>
