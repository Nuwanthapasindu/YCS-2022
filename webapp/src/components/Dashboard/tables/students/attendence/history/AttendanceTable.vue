<template>
    <div class="row my-5">
        <div class="col-lg-12 col-md-12">
            <div class="card shadow w-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 heading">{{ Heading }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th v-for=" (TableHeader, key) in TableHeaders" :key="key">{{ TableHeader }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for=" (row, key) in TableData" :key="key">
                                    <td>{{ key + 1 }}</td>
                                    <td>{{ row.student.full_name }}</td>
                                    <td> <span class="badge bg-success" v-if="row.attendance">marked</span>
                                        <span class="badge bg-danger" v-else>Un marked</span>
                                    </td>
                                    <td>{{ row.time }}</td>
                                    <td>{{ row.teacher.full_name }}</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
        TableHeaders: {
            type: Array,
            required: true
        },
        Heading: {
            type: String,
            required: true
        },
    },
    data() {
        return {

        }
    },
    methods: {

    },
}
</script>

<style lang="scss" scoped>
.heading {
    font-weight: 800;
    color: var(--dashboard-color);
    text-transform: uppercase;
}

.modal {
    .profilePic {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }
}

.row {
    overflow-x: hidden;

    table {
        tr {
            th {
                text-transform: uppercase;
            }
        }

        tr {
            td {
                .btn {
                    background: var(--dashboard-color);
                    border-radius: 5px;
                    font-weight: 800;
                    color: #fff;

                    &:hover {

                        color: #000;
                        background: var(--dashboard-main);
                    }
                }
            }
        }
    }
}
</style>