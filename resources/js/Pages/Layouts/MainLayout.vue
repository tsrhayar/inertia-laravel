<template>
    <nav class="bg-white mb-3 navbar navbar-expand-md">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Inertia Laravel</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item" v-if="user">
                        <Link
                            :class="[
                                'nav-link',
                                {
                                    active: isActiveRoute('/'),
                                },
                            ]"
                            aria-current="page"
                            :href="route('home')"
                            >Home Page</Link
                        >
                    </li>
                    <li class="nav-item" v-if="user">
                        <Link
                            :class="[
                                'nav-link',
                                {
                                    active: isActiveRoute('/tasks/create'),
                                },
                            ]"
                            :href="route('tasks.create')"
                            >Create Task</Link
                        >
                    </li>
                    <li class="nav-item" v-if="!user">
                        <Link
                            :class="[
                                'nav-link',
                                {
                                    active: isActiveRoute('/tasks/create'),
                                },
                            ]"
                            :href="route('login')"
                            >Login</Link
                        >
                    </li>
                    <li class="nav-item" v-if="!user">
                        <Link
                            :class="[
                                'nav-link',
                                {
                                    active: isActiveRoute('/tasks/create'),
                                },
                            ]"
                            :href="route('register')"
                            >Register</Link
                        >
                    </li>
                    <li class="nav-item dropdown" v-if="user">
                        <Link
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            {{ user.name }}
                        </Link>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#"
                                    >Another action</a
                                >
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                                <Link
                                    :class="[
                                        'nav-link',
                                        'border-0',
                                        'bg-white',
                                    ]"
                                    method="post"
                                    as="button"
                                    :href="route('logout')"
                                    >Logout</Link
                                >
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <slot :user="user"></slot>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const user = computed(() => usePage().props.user);

const isActiveRoute = (path) => {
    return window.location.pathname == path;
};
</script>
