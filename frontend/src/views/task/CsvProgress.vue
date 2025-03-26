<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import echo from "../../plugins"; // Import Echo instance

const progress = ref(0);
const total = ref(1);
const isComplete = ref(false);
const userId = 1; // Get this from your authentication system

onMounted(() => {
    echo.private(`csv-progress.${userId}`)
        .listen(".CsvProcessingProgress", (e) => {
            progress.value = e.processed;
            total.value = e.total;
            if (e.completed) {
                isComplete.value = true;
                alert("CSV Processing Complete!");
            }
        });
});

onUnmounted(() => {
    echo.leave(`csv-progress.${userId}`);
});
</script>

<template>
    <div>
        <p>Processing: {{ progress }} / {{ total }}</p>
        <p v-if="isComplete">✅ Processing Complete!</p>
    </div>
</template>
