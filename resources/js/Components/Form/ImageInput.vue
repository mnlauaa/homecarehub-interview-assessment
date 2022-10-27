<script>
export default {
    props: {
        modelValue: {
            type: [Object, String],
            default: null,
        },
        name: {
            type: String,
            default: null,
        },
        placeholder: {
            type: String,
            default: null,
        },
        error: {
            type: String,
            default: null,
        },
    },
    computed: {
        url() {
            const vm = this;
            return typeof vm.modelValue === "string"
                ? vm.modelValue
                : URL.createObjectURL(vm.modelValue);
        },
    },
};
</script>

<template>
    <div class="d-flex align-items-center" v-if="modelValue">
        <img :src="url" />
        <i
            class="bi-x-circle-fill remove-icon ml-2"
            role="img"
            aria-label="remove"
            @click="$emit('update:modelValue', null)"
        />
    </div>
    <template v-else>
        <input
            type="text"
            class="form-control"
            :class="{ 'is-invalid': error }"
            :placeholder="placeholder"
            @click="$refs[`file-${name}`].click()"
            readonly
        />
        <input
            :ref="`file-${name}`"
            type="file"
            :name="name"
            accept="image/*"
            @change="$emit('update:modelValue', $event.target.files[0])"
            hidden
        />
    </template>
    <div class="d-flex align-items-center mt-1 error" v-if="error">
        <i class="bi-info-circle mr-1" />
        <span>{{ error }}</span>
    </div>
</template>

<style scoped>
input[type="text"] {
    cursor: pointer;
}

img {
    max-height: 15rem;
    max-width: 50%;
}

.remove-icon {
    color: red;
    font-size: 1.5rem;
    cursor: pointer;
}
</style>
