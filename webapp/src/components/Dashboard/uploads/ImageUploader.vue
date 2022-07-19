<template>
    <div class="card shadow-sm" @dragenter.prevent="enter" @dragleave.prevent="leave" @dragover.prevent
        @drop.prevent="drop($event)">
        <div class="alert alert-danger" v-if="error">{{ error }}</div>
        <div class="card-body">
            <div class="drag">
                <form enctype="multipart/form-data">
                    <p>
                        Drag and Drop Your image or
                        <br />
                        <label for="profile_pic">Select File </label>
                    </p>
                    <input type="file" accept=".jpg,.png" id="profile_pic" @change.prevent="ImageSelect($event)">
                </form>
            </div>
            <ProgressBar v-if="upload_progress !== 0" :progress="upload_progress" class="my-2" />
            <div class="image_preview" v-if="image">
                <img :src="image" alt="">
            </div>
        </div>
    </div>
</template>

<script>
import ProgressBar from '@/components/Dashboard/progress/ProgressBar.vue';
import axios from 'axios';
import { mapGetters, mapActions } from 'vuex';
export default {
    computed: mapGetters({
        user: 'auth/GET_USER'
    }),
    data() {


        return {

            upload_progress: 0,
            nav_active: false,
            error: null,
            dragCount: 0,
            files: null,
            images: null,
            image: ''
        }
    },
    components: {
        ProgressBar
    },
    methods: {

        ...mapActions({
            'attempt': 'auth/attempt'
        }),
        enter() {
            this.dragCount++;

        },
        leave() {
            this.dragCount--;

        },
        drop(e) {
            e.stopPropagation()
            const files = e.dataTransfer.files;
            this.addImage(files[0]);

        },
        ImageSelect(e) {
            this.files = e.target.files[0];
            console.log();
            this.addImage(e.target.files[0]);
        },
        addImage(file) {
            if (!file.type.match('image/*')) {
                this.error = `${file.name} is not an image`;
                return;
            } else {
                this.error = null;
                this.files = file;
                const form = new FormData;
                form.append('profile_pic', file);
                axios.post('auth/profile-pic/' + this.user.uuid, form, {
                    onUploadProgress: progress => {

                        this.upload_progress = Math.round((progress.loaded / progress.total) * 100);
                    }
                })
                    .then(res => {
                        if (res.data.status === 201) {
                            this.image = res.data.path;
                            this.attempt(localStorage.getItem('token'))

                        }
                    })
                    .catch(err => {
                        this.error = err.response.data.message.profile_pic[0];
                    })


            }

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