<template>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <img
                    :src="user.photo_url"
                    class="rounded mx-auto d-block w-75 m-auto mb-3"
                    alt="Profile Photo"
                />
                <div class="mb-3">
                    <label for="formFile" class="form-label"
                        >Choice Profile Photo</label
                    >
                    <input class="form-control" type="file" id="formFile" />
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
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const user = computed(() => usePage().props.user);
</script>
