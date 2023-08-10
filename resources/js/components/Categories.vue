<template>
    <div class="row mb-2 overflow-hidden">
        <span class="text-center mb-2">Filter by category</span>
        <div class="btn-group-vertical">
            <Link
                :href="`/`"
                :class="[
                    'btn',
                    'btn-outline-secondary',
                    { active: isAll() },
                    { 'pointer-events-none': isAll() },
                ]"
            >
                ALL
            </Link>
            <Link
                v-for="(category, index) in categories"
                :key="index"
                :href="`/category/${category.id}/tasks`"
                :class="[
                    'btn',
                    'btn-outline-secondary',
                    { active: isActive(category.id) },
                    { 'pointer-events-none': isActive(category.id) },
                ]"
            >
                {{ category.name }}
            </Link>
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
    const currentPathParts = window.location.pathname.split("/");
    const urlCategoryId = parseInt(
        currentPathParts[currentPathParts.length - 2]
    );
    return urlCategoryId === categoryId;
};

const isAll = () => {
    return window.location.pathname == "/";
};
</script>
