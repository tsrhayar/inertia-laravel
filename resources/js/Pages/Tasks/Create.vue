<script setup>
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    title: null,
    body: null,
    category_id: null,
});

const addTask = () => {
    form.post("/tasks", {
        onSuccess: () => {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Task added succefully",
                showConfirmButton: false,
                timer: 1500,
            });
        },
    });
};
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-8 m-auto">
                <form
                    class="bg-white px-5 py-3 rounded"
                    @submit.prevent="addTask"
                >
                    <h3 class="text-center">Create new task</h3>
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
                        <span
                            class="d-block text-danger fs-14px"
                            v-for="(error, index) in form.errors.title"
                            :key="index"
                        >
                            {{ error }}
                        </span>
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
                    <button
                        :disabled="form.processing"
                        type="submit"
                        class="btn btn-primary"
                    >
                        {{ form.processing ? "Loading ..." : " Create" }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
