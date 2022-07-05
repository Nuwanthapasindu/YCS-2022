<template>
    <main class="d-flex">
        <side-bar :open="nav_active" />
        <!-- Dashboard  Contents -->
        <div class="container-fluid">
            <!-- Nav Bar Start  -->
            <NavBar @toggleNav="toggle" />
            <!-- Nav Bar End  -->
            <div class="container">

            
                <div class="row my-5">
                    <div class="col-lg-12 col-md-12">
                        <div class="card shadow w-100">
                            <div class="card-head">
                                <h1>Student Attendance</h1>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="3"></th>
                                            </tr>
                                            <tr>
                                                <th>#</th>
                                                <th>Student Name</th>
                                                <th>Attendance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Hanwellage Nuwantha Pasindu Kavishan Dias</td>
                                                <td><input type="checkbox" /></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <TableWidget Heading="Today Student Attendance" :TableHeaders="TableHeaders" />
            </div>
            <dashboard-footer />
        </div>
        <!-- Dashboard  Contents -->

    </main>
</template>

<script>
import TableWidget from '@/components/Dashboard/tables/TableWidget.vue';
export default {
    data() {
        return {
            nav_active: false,
            TableHeaders: ['#', 'Student Name', 'Attendance', 'time'],
        };
    },
    methods: {
        toggle(value) {
            this.nav_active = value;
        }
    },
    components: { TableWidget }
}
</script>

<style lang="scss" scoped>
main {
    width: 100vw;
    min-height: 100vh;
    height: auto;
    overflow-x: hidden;
}

.container {
    overflow-x: hidden;

    .card {
        border-radius: 20px;
        overflow: hidden;
        z-index: 1;

        .card-head {
            height: 200px;
            background: linear-gradient(0deg, rgba(255, 0, 150, 0.3), rgba(255, 0, 150, 0.3)), url('@/assets/Dashboard/StudentAttendance/Banner.jpg');
            background-size: cover;
            background-position: center center;
            display: flex;
            align-items: center;
            justify-content: center;

            h1 {
                color: #ffff;
                font-weight: 900;
            }
        }

        .card-body {
            table.table {
                tr {
                    input[type="checkbox"] {
                        width: 20px;
                        height: 20px;
                        accent-color: var(--dashboard-main);
                    }
                }
            }
        }
    }
}
</style>