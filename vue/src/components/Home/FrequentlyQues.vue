<template>
  <div class="questions container pt-5 pb-5">
    <div class="title text-center">
      <h1>Frequently asked questions</h1>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse
        <br />
        varius enim in eros elementum tristique.
      </p>
    </div>

    <div class="row gy-3">
      <div
        class="col-lg-6 col-md-12 col-12"
        v-for="(item, outerIndex) in questions"
        :key="outerIndex"
      >
        <div class="accordion mt-5" :id="`accordionExample${outerIndex}`">
          <div
            class="accordion-item"
            v-for="(q, innerIndex) in item"
            :key="innerIndex"
          >
            <h2 class="accordion-header">
              <button
                class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                :data-bs-target="`#collapse${outerIndex}${innerIndex}`"
                aria-expanded="true"
                :aria-controls="`collapse${outerIndex}${innerIndex}`"
              >
                {{ q.question }}
              </button>
            </h2>
            <div
              :id="`collapse${outerIndex}${innerIndex}`"
              class="accordion-collapse collapse"
              :data-bs-parent="`#accordionExample${outerIndex}`"
            >
              <div class="accordion-body">
                {{ q.answer }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { url } from "@/config";
import axios from "axios";
const questions = ref([]);

const getQuestions = () => {
  axios.get(`${url}/questions`).then((response) => {
    questions.value = response.data;
  });
};

onMounted(() => {
  getQuestions();
});
</script>
