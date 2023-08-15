<template>
    <div
        class="btn-group mb-2 me-2"
        role="group"
        aria-label="Basic outlined example"
    >
        <Link
            :href="route('order.tasks', ['id', 'asc'])"
            :class="[
                'btn',
                'btn-sm',
                'btn-outline-primary',
                {
                    active: isActiveRoute('/order/id/asc/tasks'),
                },
            ]"
        >
            ID <i class="fa-solid fa-arrow-up"></i>
        </Link>
        <Link
            :href="route('order.tasks', ['id', 'desc'])"
            :class="[
                'btn',
                'btn-sm',
                'btn-outline-primary',
                {
                    active: isActiveRoute('/order/id/desc/tasks'),
                },
            ]"
        >
            ID <i class="fa-solid fa-arrow-down"></i>
        </Link>

        <Link
            :href="route('order.tasks', ['title', 'asc'])"
            :class="[
                'btn',
                'btn-sm',
                'btn-outline-primary',
                {
                    active: isActiveRoute('/order/title/asc/tasks'),
                },
            ]"
        >
            Title A-Z <i class="fa-solid fa-arrow-up"></i>
        </Link>
        <Link
            :href="route('order.tasks', ['title', 'desc'])"
            :class="[
                'btn',
                'btn-sm',
                'btn-outline-primary',
                {
                    active: isActiveRoute('/order/title/desc/tasks'),
                },
            ]"
        >
            Title Z-A <i class="fa-solid fa-arrow-down"></i>
        </Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const isActiveRoute = (path) => {
    return window.location.pathname == path;
};
</script>
