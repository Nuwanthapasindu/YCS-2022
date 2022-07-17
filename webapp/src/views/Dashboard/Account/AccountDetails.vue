<template>
    <main class="d-flex">
        <side-bar :open="nav_active" />
        <!-- Dashboard  Contents -->
        <div class="container-fluid">
            <!-- Nav Bar Start  -->
            <NavBar @toggleNav="toggle" />
            <!-- Nav Bar End  -->
            <!-- Form -->
            <div class="container py-4 my-5">
                <div class="row">
                    <!-- Profile Details Start -->
                    <div class="col-lg-4 col-md-12 mb-5">
                        <div class="card shadow-sm">
                            <div class="card-head profile_card">
                                <img :src="user.profile_pic" class="profile_pic" alt="">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <!-- Profile Details Start -->
                        <div class="card shadow-sm">
                            <div class="card-body py-5">
                                <div class="row py-5">
                                    <div class="col-lg-12">
                                        <table class="table table-borderless table-hover h-100">
                                            <tr>
                                                <th>Full Name </th>
                                                <td>{{ user.full_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Mobile Number </th>
                                                <td>{{ user.mobile_number }}</td>

                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>{{ user.address }}</td>

                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ user.email }}</td>

                                            </tr>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container py-4 my-5">
                <!-- Form -->
                <div class="row">
                    <div class="col-lg-8 col-md-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-head">
                                <h1>Update Profile</h1>
                            </div>
                            <div class="card-body">
                                <AccUPdate />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <ImageUploader />
                    </div>
                </div>
                <!-- Form End -->
                <!-- Form -->
                <div class="row">
                    <PasswordUpdate />
                </div>
                <!-- Form End -->
            </div>
            <dashboard-footer />
        </div>
        <!-- Dashboard  Contents -->

    </main>
</template>

<script>
import { mapGetters } from 'vuex'
import ImageUploader from '@/components/Dashboard/uploads/ImageUploader.vue';
import AccUPdate from '@/components/Dashboard/forms/AccUPdate.vue';
import PasswordUpdate from '@/components/Dashboard/forms/PasswordUpdate';
export default {
    computed: mapGetters({
        user: 'auth/GET_USER'
    }),


    data() {
        return {
            nav_active: false,
        };
    },
    methods: {
        toggle(value) {
            this.nav_active = value;
        },

    },
    components: { ImageUploader, AccUPdate, PasswordUpdate }
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
            background-image: url('@/assets/Dashboard/MyProfile/banner.jpg');
            background-size: cover;
            background-position: center center;
            display: flex;
            align-items: center;
            justify-content: center;

            &.profile_card {
                height: 400px;

                img.profile_pic {
                    width: 200px;
                    height: 200px;
                    border-radius: 50%;

                    object-fit: cover;
                    border: 5px solid var(--dashboard-main);
                    padding: 2px;
                    transform: translate(0px, 0%);

                }
            }

            img.profile_pic {
                width: 150px;
                height: 150px;
                border-radius: 50%;
                object-fit: cover;
                transform: translate(0px, 55%);
                border: 5px solid var(--dashboard-main);
                padding: 2px;

            }

            h1 {
                color: #ffff;
                font-weight: 900;
            }
        }

        .card-body {


            table.table {
                tr {
                    cursor: pointer;
                }
            }
        }
    }
}
</style>