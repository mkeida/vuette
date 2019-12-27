// Definuje modelový objekt, kde budou
// uloženy všechny modelové třídy
window.model = {};

// Získá modelové třídy od serveru
axios.get('/api/get-model').then((res) => {
    // Projdeme všechny .js soubory modelu
    for (file of res.data) {
        // Vyžádáme si soubor a provedeme inject
        // modelových tříd
        axios.get(file.path).then((script) => {
            // Spustíme zdrojový kód souboru. Provede se inject
            // modelové třídy do window.model objektu
            try {
                // Zavoláme obsah souboru
                eval(script.data);
            } catch (e) {
                // Ohlásí chybu do konzole
                throw e.constructor(`Error in evaled script: ${e.message} in ${file}`);
            }
        });
    }
}).then(() => {
    // Po načtení modelových tříd načteme komponenty
    const nLink = httpVueLoader('/client/components/NLink.vue');
    const myComponent = httpVueLoader('/client/components/MyComponent.vue');

    // Globálně zaregistruje NLink komponentu pro
    // generování Nette odkazů uvnitř Vue komponent
    Vue.component('n-link', nLink);

    // Vytvoří novou Vue instanci
    var vm = new Vue({
        // Element, na který instance bude mountnuta
        el: '#app',
        // Komponenty
        components: {
            'my-component': myComponent
        }
    });

    // Nastaví build proces pro kompilaci SASSu
    httpVueLoader.langProcessor.scss = function (scss) {
        // Vrátíme promise
        return new Promise(function(resolve, reject) {
            // Kompilace
            Sass.compile(scss, function (result) {
                // Povedlo se?
                if (result.status === 0)
                    // Vrátíme výsledek
                    resolve(result.text)
                else
                    // Vrátíme chybové hlášení
                    reject(result)
            });
        });
    }
});
