<template>
    <select class="form-select" aria-label="Default select example" @change="selected_class($event)">
        <option selected> Select The Class</option>
        <option v-for="(studentClass, key) in studentClasses" :key="key" :value="studentClass.uuid">{{
        studentClass.class_name }}</option>
    </select>
</template>

<script>
import axios from 'axios';
export default {
 
    data() {
        return {
            studentClasses: [],
        }
    },
    mounted() {
        this.getStudentClass()
    },
    methods: {
        getStudentClass() {
            axios.get('student/classes').then(response => this.studentClasses = response.data.classes)
        },
        selected_class(e) {
            this.$emit('stdClass', e.target.value);
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