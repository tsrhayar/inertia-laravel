<template>
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
            <tr v-for="(task, index) in tasks.data" :key="index">
                <td>{{ task.id }}</td>
                <td class="truncate-td">{{ task.title }}</td>
                <td class="truncate-td">{{ task.body }}</td>
                <td class="truncate-td">
                    {{ task.category.name }}
                </td>
                <td>
                    <span v-if="task.done" class="badge text-bg-success"
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
   <TableTasksPagination :tasks="tasks" />
</template>

<script setup>
import TableTasksPagination from '@/Components/TableTasksPagination.vue';

const props = defineProps({
    tasks: {
        type: Object,
        required: true,
    },
});
</script>
