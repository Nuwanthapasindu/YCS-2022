<template>
    <select class="form-select" aria-label="Default select example" @change="selected_class($event)">
        <option v-for="(SectionClass, key) in classes" :key="key">{{ SectionClass }}</option>
    </select>
</template>

<script>
export default {
    data() {
        return {
            classes: [
                'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
            ]
        }
    },
    methods: {
        selected_class(e) {
            this.$emit('selected_section', e.target.value);
        }
    }
}
</script>

<style lang="scss" scoped>
select {
    border: none;
    border-bottom: 2px solid var(--dashboard-color);
    outline: 0;

    &::placeholder {
        font-weight: 400;
        color: var(--dashboard-color);
    }

    &:focus {
        outline: 0;
        box-shadow: none;
        transition: all .2s ease-in-out;
        border-bottom: 2px solid var(--dashboard-warning);

    }
}
</style>