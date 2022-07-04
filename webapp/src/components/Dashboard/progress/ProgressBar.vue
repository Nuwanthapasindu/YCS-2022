<template>
    <div class="progress-bar">
        <div class="bar" :style="'width:' + progress + '%;'"></div>
    </div>
</template>

<script>
export default {

    props: {
        progress: {
            required: true,
            type: Number,
        }
    }

}
</script>

<style lang="scss" scoped>
div.progress-bar {
    width: 100%;
    height: 10px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    border-radius: 20px;
    background-color: var(--dashboard-color);

    .bar {
        width: 0%;
        max-width: 100%;
        height: 6px;
        border-radius: 20px;
        background-color: var(--dashboard-main);
        transition: all auto ease-in-out;
    }
}
</style>