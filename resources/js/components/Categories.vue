<template>
    <div class="card mb-2 overflow-hidden">
        <div class="btn-group-vertical">
            <Link
                v-for="(category, index) in categories"
                :key="index"
                :href="`/category/${category.id}/tasks`"
                :class="[
                    'btn',
                    'btn-primary',
                    { active: isActive(category.id) },
                ]"
            >
                 {{ category.name }}</Link
            >
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
});

const isActive = (categoryId) => {
    // Get the current URL path and split it into parts
    const currentPathParts = window.location.pathname.split("/");

    // Extract the category ID from the URL
    const urlCategoryId = parseInt(
        currentPathParts[currentPathParts.length - 2]
    );

    // Compare the URL category ID with the provided categoryId
    return urlCategoryId === categoryId;
};
</script>
