<template>
    <select class="form-select" aria-label="Default select example">
        <option v-for="(section,key) in sections" :key="key">{{ section }}</option>
    </select>
</template>

<script>
export default {
    data() {
        return {
            sections: [
                '1','2','3','4','5','6','7','8','9','10','O/L'
            ]
        }
    },
}
</script>

<style scoped>
</style>