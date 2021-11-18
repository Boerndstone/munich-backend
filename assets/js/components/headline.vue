<template>
    <div id="main" class="mt-3">
        <div class="bg-white p-3 mb-4 flex items-center justify-between shadow">
            <h1 :class="[$style.test, 'tracking-wide', 'w-full']">{{ title }}</h1>
        </div>
    </div>
</template>

<script>
    export default ({
        name: 'Headline',
        props: {
            title: {
                type: String,
                required: true,
            }
        },
    })
</script>

<style lang="scss" module>
    .test {
        color: blue!important;
        background-color: red;
    }
</style>