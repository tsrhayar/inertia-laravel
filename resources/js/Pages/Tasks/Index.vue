<template>
    Index pages

    <div class="container-fluid">
        <div class="row py-2">
            <div class="col-2 fs-14px">
                <Categories :categories="categories" />
            </div>
            <div class="col-10">
                <div class="card overflow-hidden">
                    <table class="table table-striped fs-14px table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Category</th>
                                <th>Done</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(task, index) in tasks.data"
                                :key="index"
                            >
                                <td>{{ task.id }}</td>
                                <td class="truncate-td">{{ task.title }}</td>
                                <td class="truncate-td">{{ task.body }}</td>
                                <td class="truncate-td">
                                    {{ task.category.name }}
                                </td>
                                <td>
                                    <span
                                        v-if="task.done"
                                        class="badge text-bg-success"
                                        >Done</span
                                    >
                                    <span v-else class="badge text-bg-danger"
                                        >Processing ...</span
                                    >
                                </td>
                                <td>{{ task.created_at }}</td>
                                <td>Action</td>
                            </tr>
                        </tbody>
                    </table>
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
                                                (tasks.links[1].active &&
                                                    index == 0) ||
                                                (tasks.links[
                                                    tasks.links.length - 2
                                                ].active &&
                                                    index ==
                                                        tasks.links.length - 1),
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
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Categories from "@/Components/Categories.vue";
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
