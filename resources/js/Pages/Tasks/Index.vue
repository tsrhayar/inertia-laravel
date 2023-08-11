<template>
    <div class="container-fluid">
        <div
            v-if="$page.props.flash.message"
            :class="$page.props.flash.class"
            role="alert"
        >
            {{ $page.props.flash.message }}
        </div>
        <div class="row py-2">
            <div class="col-2 fs-14px">
                <Categories :categories="categories" />
            </div>
            <div class="col-10">
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
                            { active: isActiveRoute('/order/id/asc/tasks') },
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
                            { active: isActiveRoute('/order/id/desc/tasks') },
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
                            { active: isActiveRoute('/order/title/asc/tasks') },
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
                                active: isActiveRoute(
                                    '/order/title/desc/tasks'
                                ),
                            },
                        ]"
                    >
                        Title Z-A <i class="fa-solid fa-arrow-down"></i>
                    </Link>
                </div>
                <div>
                    <TableTasks :tasks="tasks" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

import Categories from "@/Components/Categories.vue";
import TableTasks from "@/Components/TableTasks.vue";
const props = defineProps({
    tasks: {
        type: Object,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});

const isActiveRoute = (path) => {
    return window.location.pathname == path;
};
</script>

<style>
.fs-12px {
    font-size: 12px !important;
}
.fs-14px {
    font-size: 14px !important;
}
.fs-16px {
    font-size: 16px !important;
}

.truncate-td {
    max-width: 100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.pointer-events-none {
    pointer-events: none;
}
</style>
