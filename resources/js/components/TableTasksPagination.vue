<template>
    <nav class="d-flex justify-content-center fs-14px">
        <ul class="pagination">
            <li
                class="page-item"
                v-for="(link, index) in tasks.links"
                :key="index"
            >
                <Link
                    :class="[
                        'page-link',
                        { active: link.active },
                        {
                            disabled:
                                (tasks.links[1].active && index == 0) ||
                                (tasks.links[tasks.links.length - 2].active &&
                                    index == tasks.links.length - 1),
                        },
                        { 'pointer-events-none': link.active },
                    ]"
                    :disabled="link.active"
                    :href="link.url || '#'"
                    ><span v-html="link.label"></span
                ></Link>
            </li>
        </ul>
    </nav>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    tasks: {
        type: Object,
        required: true,
    },
});
</script>