<template>

<Transition>
  <p v-if="showMessage">{{ message }}</p>
</Transition>

</template>

<script setup>
import { onMounted,defineProps,ref } from 'vue';


defineProps({
    'message':String
})


const showMessage = ref(true)

onMounted(()=>{
    setTimeout(()=>{
        showMessage.value = false
    },3000)
})
</script>

<style scoped>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>