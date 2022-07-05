<template>
    <footer class="sticky-footer row">
        <div class="container my-auto">
            <div class="copyright">
                <b>&copy; &nbsp; 2022 - {{ date }}</b> MY <span>app </span>
                &nbsp;
            <br />
                <small>inc. All rights reserved </small>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    created() {
        var today = new Date;
        this.date = today.getFullYear();

    },
    data() {
        return {
            date: null
        }
    },
}
</script>

<style lang="scss" scoped>
footer {
    height: 120px;
    overflow: hidden;
    border-top: 1px solid var(--dashboard-secondary);
    background:var(--dashboard-secondary);

    .copyright {
        text-align: center;
        font-weight: 900;
        color: var(--dashboard-color);
        text-transform: uppercase;
        display: block;
        margin: 0 auto;
        width: 75%;

        span {
            color: var(--dashboard-color);
        }

        b {

            color: var(--dashboard-color);
        }

        small {
            font-size: 10px;
            color: var(--dashboard-color);
        }
    }
}
</style>