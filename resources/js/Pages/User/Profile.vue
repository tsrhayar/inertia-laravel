<template>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <img
                    :src="user.image"
                    class="rounded mx-auto d-block w-75 m-auto mb-3"
                    alt="Profile Photo"
                    style="max-height: 400px;"
                />
                <div class="mb-3">
                    <form
                        @submit.prevent="uploadFile"
                        class="d-flex flex-column"
                    >
                        <label for="formFile" class="form-label"
                            >Choice Profile Photo</label
                        >
                        <input
                            class="form-control mb-2"
                            type="file"
                            id="formFile"
                            @input="setPhotoUrl"
                            accept="image/*"
                        />
                        <span
                            class="d-block text-danger fs-14px"
                            v-for="(error, index) in form.errors.photo_url"
                            :key="index"
                        >
                            {{ error }}
                        </span>
                        <button
                            :class="[
                                'btn',
                                'btn-sm',
                                'btn-primary',
                                'm-auto',
                                {
                                    disabled:
                                         form.processing,
                                },
                            ]"
                        >
                            {{
                                form.processing
                                    ? "Loading ..."
                                    : "Change Profile Photo"
                            }}
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        placeholder="Email address required"
                        v-model="user.name"
                    />
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        placeholder="Email address required"
                        v-model="user.email"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const form = useForm({
    photo_url: "",
});

const setPhotoUrl = (e) => {
    form.photo_url = e.target.files[0];
};

const user = computed(() => usePage().props.user);

const uploadFile = () => {
    form.post(route("profile"), {
        onSuccess: () => {
            form.reset("photo_url");
        },
    });
};
</script>
