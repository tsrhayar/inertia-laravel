<script setup>
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";

const form = useForm({
    name: null,
    email: null,
    password: null,
});

const login = () => {
    form.post(route("login"));
};
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-8 m-auto">
                <form
                    class="bg-white px-5 py-3 rounded"
                    @submit.prevent="login"
                >
                    <h3 class="text-center">Login</h3>
                    <hr />
                    <p
                        v-if="$page.props.flash.message"
                        :class="['text-danger', 'text-center']"
                        role="alert"
                    >
                        {{ $page.props.flash.message }}
                    </p>
                    <div class="mb-3">
                        <label for="title" class="form-label">Email</label>
                        <input
                            v-model="form.email"
                            type="email"
                            class="form-control"
                            id="email"
                            placeholder="email"
                        />
                        <span
                            class="d-block text-danger fs-14px"
                            v-for="(error, index) in form.errors.email"
                            :key="index"
                        >
                            {{ error }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Password</label>
                        <input
                            v-model="form.password"
                            type="password"
                            class="form-control"
                            id="password"
                            placeholder="password"
                        />
                        <span
                            class="d-block text-danger fs-14px"
                            v-for="(error, index) in form.errors.password"
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
                        {{ form.processing ? "Loading ..." : "Login" }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
