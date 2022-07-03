<template>
    <section class="container-fluid">
        <div class="container shadow-lg">
            <div class="row">
                <div class="col-lg-6 col-md-12 py-5 ">
                    <div class="container py-5">
                        <div class="row my-5">
                            <h1 class="text-center">Welcome Back</h1>
                            <small class="text-center">
                                Welcome back! Please enter Your details
                            </small>
                        </div>
                        <form>
                            <div class="mb-4">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" placeholder="Enter Your Email Address" class="form-control" />
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" placeholder="Enter Your Password" class="form-control"
                                    id="exampleInputPassword" />
                            </div>
                            <button type="submit" class="btn form-control mt-2 login-button">Sign In</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12" id="img">

                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
section.container-fluid {
    height: 100vh;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;

    .container {
        background: #fff;
        border-radius: 15px;
    }

    #img {
        background-image: url('@/assets/Login/login.jpg');
        background-size: cover;
        background-position: center center;
    }

    h1 {
        font-weight: 900;

    }

    form {
        input {
            border: 1px solid var(--dashboard-color);
            outline: 0;

            &:focus {
                outline: 0;
                box-shadow: none;

            }

        }

        label {
            font-weight: 700;
        }

        .login-button {
            background: var(--dashboard-color);
            color: #fff;
            border-radius: 5px;
            font-weight: 800;
        }
    }

}
</style>