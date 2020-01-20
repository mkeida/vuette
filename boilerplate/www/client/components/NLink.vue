<template>
    <a :href='url'>
        <slot />
    </a>
</template>

<script>
    module.exports = {
        // Data komponenty
        data: function() {
            return {
                url: ''
            }
        },
        // Atributy komponenty
        props: ['to', 'params'],
        // Když je componenta vytvořena
        created() {
            // Odkaz na momentální scope
            let _this = this;

            // Zažádá server o adresu
            axios.get('/api/get-link', {
                params: {
                    // Cílová destinace
                    dest: _this.to,
                    // Query parametry cílové URL
                    params: JSON.stringify(_this.params)
                }
            }).then((res) => {
                // Aktualizace URL proměnné
                this.url = res.data;
            });
        }
    }
</script>
