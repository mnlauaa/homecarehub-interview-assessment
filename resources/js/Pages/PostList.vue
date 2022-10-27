<script setup>
import { Link, Head } from "@inertiajs/inertia-vue3";
import CommonLayout from "@/Layouts/CommonLayout.vue";
const props = defineProps({
    posts: {
        Type: Array,
        default: [],
    },
});
</script>

<script>
import moment from "moment";
export default {
    data: () => ({
        filter: "",
    }),
    methods: {
        formatDate(date) {
            return moment.utc(date).local().format("MMM, D, YYYY");
        },
    },
    computed: {
        filteredPost() {
            const vm = this;
            return vm.posts.filter((post) =>
                post.author_name.toLowerCase().includes(vm.filter.toLowerCase())
            );
        },
    },
};
</script>

<template>
    <Head title="Post List" />

    <CommonLayout>
        <div class="container">
            <input
                type="text"
                class="form-control my-4 search"
                placeholder="Search by author"
                v-model="filter"
            />
            <div
                class="mb-5"
                v-for="post in filteredPost"
                :key="`post-${post.id}`"
            >
                <div class="post-item">
                    <img class="mr-3" :src="`${post.image}`" />
                    <div class="post-message">
                        <div class="title">{{ post.title }}</div>
                        <div class="date">
                            {{ formatDate(post.created_at) }} |
                            {{ post.author_name }}
                        </div>
                        <div class="content">{{ post.body }}</div>
                    </div>
                </div>
                <Link
                    class="float-end"
                    :href="route('post.show', { post: post.id })"
                >
                    Read more
                </Link>
            </div>
        </div>
    </CommonLayout>
</template>

<style scoped>
.search {
    border-radius: 20px;
}

.post-item {
    display: flex;
}
.post-item img {
    width: 120px;
    height: 100px;
    object-fit: cover;
}

.post-message {
    overflow: hidden
}

.post-message .title {
    font-size: 1.3rem;
    font-weight: bold;
}

.post-message .date {
    font-size: 0.7rem;
    color: grey;
}

.post-message .content {
    display: -webkit-box;
    overflow: hidden;
    white-space: pre-wrap;
    text-overflow: ellipsis;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
}
</style>
