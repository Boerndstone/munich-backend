<template>
    <div id="main" class="mt-3">
        <div class="bg-white p-3 mb-4 flex items-center justify-between shadow">
            <h1 class="tracking-wide w-full">{{ areaHeadline }}</h1>
        </div>
    </div>
</template>

<script>

export default ({
    name: 'Gebiete',
    data() {
        return {
            areaHeadline: 'Übersicht der Gebiete',
        };
    },
})
</script>
