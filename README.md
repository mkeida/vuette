# Vuette
Kombinace frameworků Nette a Vue.

## Jak to funguje?
Vue komponenty jsou za pomocí knihovny **http-vue-loader** stahovány a poté načteny rovnou na klientské části aplikace bez pomoci **Node.js** nebo jakéhokoliv jiného builderu:

```javascript
new Vue({
    el: '#app',
    components: {
        'my-component': httpVueLoader('/client/components/MyComponent.vue')
    }
});
```

Ve výchozím stavu jsou všechny komponenty umístěny ve složce `www/client/components`. Samotné komponenty podporují **SASS** a rovněž i atribut **scoped**.

## Odkazy v komponentách

Komponenty pochopitelně neumožňují použití šablonovacího systému **latte** . Vue má své vlastní funkcionality pro psaní šablon (jako např. filtry a direktivy) a není to tedy problém do doby, než potřebujeme vytvořit odkaz na presenter. Pro tyto účely obsahuje šablona komponentu `NLink`:

```html
<n-link to="Books:view" :params="{ id: 1, chapter: 7 }">Odkaz</n-link>
```

Komponenta je poté přeložena na:

```html
<a href="https://web.cz/homepage/default/1?chapter=7">Odkaz</a>
```

## Načítání modelových tříd

Všechny scripty ve složce `www/client/model` a všechny scripty v podadresářích této složky jsou automaticky stahovány a poté injectnuty do globálního scopu aplikace. Aby nedošlo k zahlcení globálního scopu a k jmenným konfliktům, doporučuji ukládat modelové třídy do předpřipravené vlastnosti model:

```javascript
// Modelová třída pes
window.model.dog = class {

}
```

Použití uvnitř Vue komponenty je pak následovné:

```javascript
// Načteme modelovou třídu pes
const Dog = window.model.dog;

// Použití třídy
let dog = new Dog();
```

Veškerá logika je umístěna v zaváděcím souboru `bootstrap.js` v kořeni složky `www`.

## API presenter

Šablona obsahuje předpřipravený `ApiPresenter`, jež je zodpovědný za generování odkazů a hledání modelových tříd.

## Závislosti šablony

| Jméno         | Odkaz         |
| ------------- |-------------|
| Axios         | https://github.com/axios/axios |
| Sass compiler | https://github.com/medialize/sass.js/ |
| Vue       | https://github.com/vuejs/vue |
| Http-vue-louder |https://github.com/FranckFreiburger/http-vue-loader |
