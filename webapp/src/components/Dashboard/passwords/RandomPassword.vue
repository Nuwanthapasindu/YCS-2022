<template>
    <div class="row px-2">
        <div class="col-lg-6 col-md-12 mb-3">
            <input :type="show ? 'text' : 'password'" readonly disabled class="form-control" v-model="state.pwd" />
        </div>

        <div class="col-lg-6 col-md-12">
            <button class="btn btn-outline-success w-50" @click.prevent="show = !show">{{ show ? 'Hide' : 'Show'
            }}</button>
            <button class="btn btn-outline-secondary w-50" @click.prevent="Generator">Generator</button>
        </div>
    </div>
</template>

<script>
import { reactive, computed } from 'vue';
import useVuelidate from '@vuelidate/core'
import { required, minLength, helpers } from '@vuelidate/validators'
export default {
    setup() {
        const state = reactive({
            pwd: ''
        })
        const rules = computed(() => {
            return {
                pwd: {
                    required: helpers.withMessage('The password is required', required),
                    minLength: helpers.withMessage('The password must be 8 charactors', minLength(8)),
                }
            }
        })

        const v$ = useVuelidate(rules, state);
        return { state, v$ }
    },
    data() {
        return {
            show: true,
        }
    },
    methods: {
        Generator() {
            var length = 10,
                charset = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM123456789!@#$%^&*()_-+=[{}]|:<,.>?/",
                retVal = "";
            for (var i = 0, n = charset.length; i < length; ++i) {
                retVal += charset.charAt(Math.floor(Math.random() * n));
            }
            let generator = retVal.toString();
            this.state.pwd = generator;

            this.$emit('generator', generator);
        }
    }
}
</script>

<style lang="scss" scoped>
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
</style>