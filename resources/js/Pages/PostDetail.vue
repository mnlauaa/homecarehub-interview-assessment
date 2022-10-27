<script setup>
import { Link, Head } from "@inertiajs/inertia-vue3";
import CommonLayout from "@/Layouts/CommonLayout.vue";
import ImageInput from "@/Components/Form/ImageInput.vue";
import TextInput from "@/Components/Form/TextInput.vue";
import TextareaInput from "@/Components/Form/TextareaInput.vue";

const props = defineProps({
    post: {
        Type: Object,
        default: {
            comments: [],
        },
    },
    errors: {
        Type: Object,
        default: {},
    },
});
</script>

<script>
import { Inertia } from "@inertiajs/inertia";
import moment from "moment";
export default {
    data: () => ({
        comment: null,
    }),
    methods: {
        formatDate(date) {
            return moment.utc(date).local().format("MMM, D, YYYY");
        },
        submit() {
            const vm = this;
            const form = {
                text: vm.comment,
                post_id: vm.post.id,
            };
            vm.comment = null;
            Inertia.post(route("comment.store"), form);
        },
        deletePost() {
            if (confirm("Are you sure to delete this post?")) {
                Inertia.delete(route("post.destroy", { post: this.post.id }));
            }
        },
    },
};
</script>

<template>
    <Head title="Post Detail" />

    <CommonLayout>
        <div class="back-link mb-3">
            <Link :href="route('post.index')">Back</Link>
        </div>

        <div class="container">
            <div class="title">{{ post.title }}</div>
            <div class="date mb-2">
                {{ formatDate(post.date) }} | {{ post.author_name }}
            </div>

            <img class="mb-2" :src="`${post.image}`" />

            <div class="content mb-3">{{ post.body }}</div>

            <div class="text-center">
                <Link :href="route('post.edit', { post: post.id })">Edit</Link>
                <Link class="ml-5" @click="deletePost">Delete</Link>
            </div>

            <hr />

            <!-- Comment -->
            <div
                class="mb-3"
                v-for="comment in post.comments"
                :key="`comment-${comment.id}`"
            >
                <div class="content">{{ comment.text }}</div>
                <div class="date">{{ formatDate(comment.created_at) }}</div>
            </div>
            <!-- End of Comment -->

            <form @submit.prevent="submit">
                <div class="mb-3">
                    <TextareaInput
                        placeholder="Write a comment"
                        v-model="comment"
                        rows="4"
                        :error="errors.text"
                    />
                </div>

                <button type="submit" class="btn btn-sm btn-primary float-end">
                    Add comment
                </button>
            </form>
        </div>
    </CommonLayout>
</template>

<style scoped>
.title {
    font-size: 2rem;
    font-weight: bold;
}

.date {
    font-size: 0.7rem;
    color: grey;
}

img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.content {
    font-size: 0.9rem;
    white-space: pre-wrap;
}
</style>
