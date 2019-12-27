<template>
    <div>
        <div v-cloak class='purple'>Hello {{who}} from Vue component!</div>
    </div>
</template>

<script>
    module.exports = {
        data: function() {
            return {
                who: 'world'
            }
        },
        mounted() {
            // Načteme modelovou třídu pes
            const Dog = window.model.dog;

            // Vypíšeme psa
            let dog = new Dog();
        }
    }
</script>

<style scoped lang='scss'>

    $color: purple;

    .purple {
        color: $color;
    }

</style>
