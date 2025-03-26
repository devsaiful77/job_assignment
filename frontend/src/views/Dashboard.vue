<template lang="">
    <div>
        <h4>
            Welcome :: {{ user.name }} 
            <span v-if="user.role_id == 1">(Admin Role)</span>
            <span v-if="user.role_id == 2">(Manager Role)</span>
            <span v-if="user.role_id == 3">(User Role)</span>
        </h4>
    </div>
</template>
<script setup>
import { useStore } from "vuex";
import { computed } from "vue";

const store = useStore();
const user = computed(() => store.state.user.data)

</script>