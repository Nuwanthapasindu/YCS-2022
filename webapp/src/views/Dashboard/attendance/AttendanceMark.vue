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
                            <AttendenceTable />
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
import AttendenceTable from '@/components/Dashboard/tables/students/attendence/AttendenceTable.vue';
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
    components: { TableWidget, AttendenceTable }
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


    }
}
</style>