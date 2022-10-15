<template>
    <select class="form-select" aria-label="Default select example" @change="selected_section($event)">
        <option selected> Select The Section</option>
        <option v-for="(section, key) in sections" :key="key">{{ section }}</option>
    </select>
</template>

<script>
export default {
    data() {
        return {
            sections: [
                '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'O/L', 'Math', 'Bio', 'Commerce', 'Art', 'Tech'
            ]
        }
    },
    methods: {
        selected_section(e) {
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