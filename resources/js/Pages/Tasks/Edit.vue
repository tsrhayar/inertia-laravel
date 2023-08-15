<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import Swal from "sweetalert2";

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
    task: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    id: props.task.id,
    title: props.task.title,
    body: props.task.body,
    category_id: props.task.category_id,
    done: !!props.task.done,
});

const updateTask = () => {
    form.put(route("tasks.update", props.task.id), {
        onSuccess: () => {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Task edited succefully",
                showConfirmButton: false,
                timer: 1500,
            });

            
        },
        onFinish: () => {
            // console.log(usePage().props.errors);
        }
    });
};
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-8 m-auto">
                <form
                    class="bg-white px-5 py-3 rounded"
                    @submit.prevent="updateTask"
                >
                    <h3 class="text-center">Edit task</h3>
                    <hr />
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input
                            v-model="form.title"
                            type="text"
                            class="form-control"
                            id="title"
                            placeholder="title"
                        />
                        <div v-if="form.errors.title">
                            <span
                                class="d-block text-danger fs-14px"
                                v-for="(error, index) in form.errors.title"
                                :key="index"
                            >
                                {{ error }}
                            </span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Body</label>
                        <textarea
                            v-model="form.body"
                            class="form-control"
                            id="body"
                            rows="3"
                            placeholder="body"
                        ></textarea>
                        <span
                            class="d-block text-danger fs-14px"
                            v-for="(error, index) in form.errors.body"
                            :key="index"
                        >
                            {{ error }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Category</label>
                        <select class="form-select" v-model="form.category_id">
                            <option disabled value="">
                                -- Select category --
                            </option>
                            <option
                                v-for="(category, index) in categories"
                                :key="index"
                                :value="category.id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                        <span
                            class="d-block text-danger fs-14px"
                            v-for="(error, index) in form.errors.category_id"
                            :key="index"
                        >
                            {{ error }}
                        </span>
                    </div>
                    <div class="mb-3 form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            value=""
                            id="flexCheckChecked"
                            v-model="form.done"
                        />
                        <label class="form-check-label" for="flexCheckChecked">
                            Done
                        </label>
                    </div>
                    <button
                        :disabled="form.processing"
                        type="submit"
                        class="btn btn-primary"
                    >
                        {{ form.processing ? "Loading ..." : " Update" }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
