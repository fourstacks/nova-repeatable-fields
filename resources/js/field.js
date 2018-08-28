Nova.booting((Vue, router) => {
    Vue.component('index-nova-repeatable-fields', require('./components/IndexField'));
    Vue.component('detail-nova-repeatable-fields', require('./components/DetailField'));
    Vue.component('form-nova-repeatable-fields', require('./components/FormField'));
})
