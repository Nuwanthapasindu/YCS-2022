<template>
    <div class="row px-2">
        <div class="col-lg-6 col-md-12 mb-3">
            <input :type="show ? 'text' : 'password'" readonly disabled class="form-control" v-model="pwd" />
        </div>

        <div class="col-lg-6 col-md-12">
            <button class="btn btn-outline-success w-50" @click.prevent="show = !show">{{ show ? 'Hide' : 'Show'
            }}</button>
            <button class="btn btn-outline-secondary w-50" @click.prevent="Generator">Generator</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {


        return {
            pwd: null,
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
            var generator = retVal.toString();
            this.pwd = generator
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