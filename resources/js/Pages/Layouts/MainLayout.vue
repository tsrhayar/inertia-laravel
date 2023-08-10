<template>
    <nav class="navbar navbar-expand-md bg-body-tertiary">
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
                    <li class="nav-item">
                        <Link
                            class="nav-link active"
                            aria-current="page"
                            href="/"
                            >Home Page</Link
                        >
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" href="/tasks/create">Create Task</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <slot></slot>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
