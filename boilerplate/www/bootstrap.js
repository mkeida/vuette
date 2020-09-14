// Definuje modelový objekt, kde budou
// uloženy všechny modelové třídy
window.model = {};

// Získá modelové třídy od serveru
axios.get('./api/get-model').then((res) => {
    // Projdeme všechny .js soubory modelu
    for (file of res.data) {
        // Vytvoří script tag
        let element = document.createElement('script');

        // Přiřadí src atribut
        element.setAttribute('src', file.path);

        // Vloží script do DOMu
        document.head.appendChild(element);
    }
}).then(() => {
    // Po načtení modelových tříd načteme komponenty
    const nLink = httpVueLoader('./client/components/NLink.vue');
    const myComponent = httpVueLoader('./client/components/MyComponent.vue');

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
