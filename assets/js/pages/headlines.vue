<template>
    <headline-component :title="headline" />
</template>

<script>
    // data and props are the most important things in vue
    // data are values whioch change while the app is running
    // props different, when a component receives a prop data can't change it
    // props are there to receive data
    // props to components like arguments to a function
    // props are there to receive data, not to modify it!!!

    import headlineComponent from '../components/headline';

    export default ({
        name: 'Gebiete',
        components: {
            headlineComponent,
        },
        data() {
            return {
                headline: 'Übersicht der Gebiete',
            };
        },
    })
</script>




