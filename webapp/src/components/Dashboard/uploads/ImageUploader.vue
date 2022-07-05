<template>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="drag">
                <form enctype="multipart/form-data">
                    <p>
                        Drag and Drop Your image or
                        <br />
                        <label for="profile_pic">Select File </label>
                    </p>
                    <input type="file" accept=".jpg,.png" id="profile_pic">
                </form>
            </div>
            <ProgressBar v-if="progress" :progress="upload_progress" class="my-2" />
            <div class="image_preview" v-if="image">
                <img :src="image" alt="">
            </div>
        </div>
    </div>
</template>

<script>
import ProgressBar from '@/components/Dashboard/progress/ProgressBar.vue';
export default {
    data() {


        return {
            progress: true,
            upload_progress: 10,
            nav_active: false,
            image: 'https://images.unsplash.com/photo-1484402628941-0bb40fc029e7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80'
        }
    },
    components: {
        ProgressBar
    },
    methods: {
        toggle(value) {
            this.nav_active = value;
        }
    }
}
</script>

<style lang="scss" scoped>
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

    .drag {
        width: 100%;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--dashboard-secondary);
        border: 1px dashed var(--dashboard-color);
        text-align: center;
        color: var(--dashboard-color);

        label {
            font-weight: 800;
            text-transform: uppercase;
            cursor: pointer;
        }

        #profile_pic {
            display: none;
        }
    }

    .image_preview {
        width: 100%;
        height: 200px;
        margin-top: 10px;

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }


}
</style>