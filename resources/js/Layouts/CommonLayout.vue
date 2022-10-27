<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <nav class="navbar sticky-top navbar-light shadow-sm px-4 mb-3">
        <Link class="navbar-brand" :href="route('post.index')">Home</Link>
        <Link
            class="btn btn-sm btn-primary float-end"
            as="button"
            :href="route('post.create')"
            >New post</Link
        >
    </nav>

    <main>
        <slot />
    </main>
</template>

<style>
nav {
    background-color: white;
}
</style>
