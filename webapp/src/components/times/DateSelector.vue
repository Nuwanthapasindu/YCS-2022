<template>
    <select class="form-select" aria-label="Default select example" @change="selectedDate($event)">
        <option selected> Select The Date</option>
        <option v-for="(date, key) in dates" :key="key">{{ date }}</option>
    </select>
</template>

<script>
export default {
    data() {
        return {
            dates: [],
        }
    },
    mounted() {
        this.GetDates()
    },
    methods: {
        GetDates() {
            let pastYear;
            let pastMonth;
            let pastDays;
            const TODAY = new Date();
            var year = TODAY.getFullYear();
            var month = TODAY.getMonth();
            var day = TODAY.getDate();

            for (let i = 0; i < 7; i++) {
                var pastDates = new Date(year, month+1, day - i);
                pastYear = String(pastDates.getFullYear())
                pastMonth = pastDates.getMonth() < 10 ? '0' + String(pastDates.getMonth()) : String(pastDates.getMonth())
                pastDays = pastDates.getDate() < 10 ? '0' + String(pastDates.getDate()) : String(pastDates.getDate())

                this.dates.push(`${pastYear}-${pastMonth}-${pastDays}`)



            }
        },
        selectedDate(e) {
            this.$emit('SelectDate', e.target.value);
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