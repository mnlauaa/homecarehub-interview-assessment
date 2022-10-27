<script setup>
import { Link, Head } from "@inertiajs/inertia-vue3";
import CommonLayout from "@/Layouts/CommonLayout.vue";
import ImageInput from "@/Components/Form/ImageInput.vue";
import TextInput from "@/Components/Form/TextInput.vue";
import TextareaInput from "@/Components/Form/TextareaInput.vue";

const props = defineProps({
    post: {
        Type: Object,
        default: {},
    },
    errors: {
        Type: Object,
        default: {},
    },
});
</script>

<script>
import { Inertia } from "@inertiajs/inertia";
export default {
    data: () => ({
        form: {
            title: null,
            author_name: null,
            image: null,
            body: null,
        },
    }),
    methods: {
        submit() {
            const vm = this;
            Inertia.post(route("post.update", { post: vm.post.id }), {
                _method: "patch",
                ...vm.form,
            });
        },
    },
    mounted() {
        const vm = this;
        vm.form = { ...vm.post };
    },
};
</script>

<template>
    <Head title="Edit Post" />

    <CommonLayout>
        <div class="back-link mb-3">
            <Link :href="route('post.show', { post: post.id })">Back</Link>
        </div>

        <div class="container">
            <form @submit.prevent="submit">
                <h3 class="fw-bold mb-3">Edit a post</h3>

                <div class="mb-3">
                    <TextInput
                        placeholder="Post title"
                        v-model="form.title"
                        :error="errors.title"
                    />
                </div>

                <div class="mb-3">
                    <TextInput
                        placeholder="Author name"
                        v-model="form.author_name"
                        :error="errors.author_name"
                    />
                </div>

                <div class="mb-3">
                    <ImageInput
                        placeholder="Choose an image for the post"
                        v-model="form.image"
                        name="imgFile"
                        :error="errors.image"
                    />
                </div>

                <div class="mb-3">
                    <TextareaInput
                        placeholder="Start typing"
                        v-model="form.body"
                        :error="errors.body"
                    />
                </div>
                <div v-if="errors.first_name">{{ errors.first_name }}</div>

                <button type="submit" class="btn btn-sm btn-primary float-end">
                    Save
                </button>
            </form>
        </div>
    </CommonLayout>
</template>
