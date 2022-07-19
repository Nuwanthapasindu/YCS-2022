<template>

    <div class="alert">
        <div class="loader"></div>
    </div>

</template>

<script>
export default {
    setup() {


        return {}
    }
}
</script>

<style lang="scss" scoped>
.loader {
    border: 4px solid var(--dashboard-main);
    border-radius: 50%;
    border-top: 4px solid var(--dashboard-color);
    width: 30px;
    height: 30px;
    -webkit-animation: spin 2s linear infinite;

}

/* Safari */
@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>