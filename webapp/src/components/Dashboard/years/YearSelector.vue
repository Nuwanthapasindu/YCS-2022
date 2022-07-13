<template>
    <select class="form-select" aria-label="Default select example" @change="selected_year($event)">
        <option selected> Select The Year</option>
        <option v-for="(year, key) in years" :key="key">{{ year }}</option>
    </select>
</template>

<script>
export default {
    data() {
        return {
            years: [],
        }
    },
    mounted() {
        this.GetYears()
    },
    methods: {
        GetYears() {
            const TODAY = new Date();
            var year = TODAY.getFullYear();
            var month = TODAY.getMonth();
            var day = TODAY.getDate();
            // Getting Past 5 Years


            var past_year = new Date(year - 1, month, day);
            this.years.push(past_year.getFullYear())

            for (let i = 0; i < 10; i++) {

                var next_years = new Date(year + i, month, day);
                this.years.push(next_years.getFullYear())

            }
        },
        selected_year(e) {
            this.$emit('year', e.target.value);
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