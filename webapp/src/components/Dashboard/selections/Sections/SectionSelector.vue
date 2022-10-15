<template>
    <select @change.prevent="select_section($event)" class="form-control">
        <option>Select The Section</option>
        <option v-for="section in sections" :key="section.id" :value="section.id">{{ section.section }} &nbsp; <b> {{
                section.additional_data
        }}</b>
        </option>

    </select>
</template>

<script>
import axios from 'axios'
export default {
    mounted() {
        axios.get('/sections/all').then(response => this.sections = response.data.sections)
    },
    data() {
        return {
            sections: []
        }
    },
    methods: {
        select_section(e) {
            this.$emit('select_section', e.target.value)
        }
    },
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