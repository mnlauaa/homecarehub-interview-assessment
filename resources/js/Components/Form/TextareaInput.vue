<script>
export default {
    props: {
        modelValue: {
            type: String,
            default: null,
        },
        placeholder: {
            type: String,
            default: null,
        },
        rows: {
            type: String,
            default: "10",
        },
        error: {
            type: String,
            default: null,
        },
    },
};
</script>

<template>
    <textarea
        class="form-control"
        :class="{ 'is-invalid': error }"
        :rows="rows"
        :placeholder="placeholder"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
    <div class="d-flex align-items-center mt-1 error" v-if="error">
        <i class="bi-info-circle mr-1" />
        <span>{{ error }}</span>
    </div>
</template>
