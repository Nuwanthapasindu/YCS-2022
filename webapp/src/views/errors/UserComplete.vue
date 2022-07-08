<template>
    <main class="d-flex">

        <!-- Dashboard  Contents -->
        <div class="container-fluid">
            <!-- Form -->

            <div class="container py-4 my-5">
                <!-- Form -->
                <div class="row">
                    <div class="col-lg-8 col-md-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-head">
                                <h1>Fill your account</h1>
                            </div>
                            <div class="card-body">
                                <form class="py-2">
                                    <div class="row my-3">
                                        <div class="col-lg-6 col-md-12 mb-4">
                                            <label for="exampleInputEmail1" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" />
                                        </div>

                                        <div class="col-lg-6 col-md-12 mb-4">
                                            <label for="exampleInputEmail1" class="form-label">Mobile Number</label>
                                            <input type="tel" class="form-control" />
                                        </div>

                                    </div>
                                    <div class="row my-3">
                                        <div class="col-lg-6 col-md-12 mb-4">
                                            <label for="exampleInputEmail1" class="form-label">Address</label>
                                            <input type="text" class="form-control" />
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <label for="exampleInputEmail1" class="form-label">Email</label>
                                            <input type="email" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-lg-6 col-md-12 mb-4">
                                            <label for="" class="form-label">Password</label>
                                            <input type="password" class="form-control" />
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <label for="" class="form-label">Re Type Your Password</label>
                                            <input type="password" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn">Update</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <ImageUploader />
                    </div>
                </div>
                <!-- Form End -->
            </div>
        </div>
        <!-- Dashboard  Contents -->

    </main>
</template>

<script>
import ImageUploader from '@/components/Dashboard/uploads/ImageUploader.vue';
export default {
    data() {
        return {
            progress: false,
            upload_progress: 0,

            image: ''

        };
    },
    methods: {

    },
    components: { ImageUploader }
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
            form {
                input {
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

                label {
                    font-weight: 700;
                }

                .btn {
                    background: var(--dashboard-color);
                    color: #fff;
                    border-radius: 5px;
                    font-weight: 800;
                }
            }

            table.table {
                tr {
                    cursor: pointer;
                }
            }
        }
    }
}
</style>