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
            // Když je DOM načten, požádáme o link
            Vue.nextTick(() => {
                // Zažádá server o adresu
                axios.get('/api/get-link', {
                    params: {
                        // Cílová destinace
                        dest: this.to,
                        // Query parametry cílové URL
                        params: JSON.stringify(_this.params)
                    }
                }).then((res) => {
                    // Aktualizace URL proměnné
                    this.url = res.data;
                });
            });
        }
    }
</script>
