<template>
    <div>
        <slot></slot>
    </div>
</template>


<script>
import { provide, ref } from 'vue';

export default {
    name: 'ContextRatingProvider',
    setup(props, { slots }) {
        const isRatingModalOpen = ref(false);
        const openRatingModal = () => {
            isRatingModalOpen.value = true;
        };
        const closeRatingModal = () => {
            isRatingModalOpen.value = false;
        };
        provide('isRatingModalOpen', isRatingModalOpen);
        provide('openRatingModal', openRatingModal);
        provide('closeRatingModal', closeRatingModal);

        return () => slots.default();
    }
};
</script>