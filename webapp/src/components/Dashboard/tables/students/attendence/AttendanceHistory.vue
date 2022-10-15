<template>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>

                        <th>Student Name</th>
                        <th>Marked</th>

                    </tr>
                </thead>
                <tbody>

                    <tr v-for="data in TableData" :key="data.id">


                        <td>{{ data.student.full_name }}</td>

                        <td>
                            <span class="badge bg-success" v-if="data.attendance">marked</span>
                            <span class="badge bg-danger" v-else>Un marked</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
    props: {
            TableData: {
                type: Object,
                required: true
            },
        }
    }
</script>

<style scoped>

</style>