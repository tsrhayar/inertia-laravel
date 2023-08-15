<template>
    <div class="container-fluid">
        <div
            v-if="$page.props.flash.message"
            :class="[$page.props.flash.class, 'd-none']"
            role="alert"
        >
            {{ $page.props.flash.message }}
        </div>
        <div class="row py-2">
            <div class="col-2 fs-14px">
                <Categories :categories="categories" />
            </div>
            <div class="col-10">
                <div class="row">
                    <div class="col">
                        <Sort />
                    </div>
                    <div class="col">
                        <form @submit.prevent="searchTask">
                            <div class="row">
                                <div class="col-9">
                                    <input
                                        v-model="form.term"
                                        class="form-control form-control-sm"
                                        type="text"
                                        placeholder="Search a task ..."
                                    />
                                </div>
                                <div class="col-3">
                                    <button
                                        :disabled="!form.term"
                                        type="submit"
                                        class="w-100 btn btn-sm btn-primary"
                                    >
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div>
                    <TableTasks :tasks="tasks" :authUser="authUser" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Categories from "@/Components/Categories.vue";
import TableTasks from "@/Components/TableTasks.vue";
import Sort from "@/Components/Sort.vue";
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
    tasks: {
        type: Object,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
    authUser: {
        type: Object,
        required: true,
    },
});

const searchTask = () => {
    form.get(route("search.tasks"));
};

let uri = window.location.search.substring(1);
let params = new URLSearchParams(uri);
let term = params.get("term");
const form = useForm({
    term: term || "",
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
