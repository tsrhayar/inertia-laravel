<template>
    <table class="table table-striped fs-14px table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Body</th>
                <th>Category</th>
                <th>Done</th>
                <th>Created by</th>
                <th>Created at</th>
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
                <td class="truncate-td">
                    {{ task.user.name }}
                </td>

                <td>{{ task.created_at }}</td>
                <td>
                    <template
                        v-if="task.user_id === authUser.id || authUser.is_admin"
                    >
                        <Link
                            class="btn btn-sm btn-outline-success"
                            :href="route('tasks.edit', task.id)"
                        >
                            Update
                        </Link>
                        <button
                            class="btn btn-sm btn-outline-danger ms-1"
                            @click="deleteTask(task)"
                        >
                            Delete
                        </button>
                    </template>
                    <template v-else>
                        <p>--</p>
                    </template>
                </td>
            </tr>
            <tr v-if="!tasks.data.length">
                <td colspan="7" class="text-center">Pas de taches</td>
            </tr>
        </tbody>
    </table>
    <TableTasksPagination :tasks="tasks" />
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import TableTasksPagination from "@/Components/TableTasksPagination.vue";
import { router } from "@inertiajs/vue3";
import Swal from "sweetalert2";

const props = defineProps({
    tasks: {
        type: Object,
        required: true,
    },
    authUser: {
        type: Object,
        required: true,
    },
});

console.log(props.authUser);
const deleteTask = (task) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route("tasks.destroy", task.id), {
                onSuccess: () => {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Deleted!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                },
            });
        }
    });
};
</script>
