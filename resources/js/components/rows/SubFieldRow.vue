<template>
    <div class="row -horizontal">
        <div class="row-move">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="12" height="28" viewBox="0 0 12 28">
                <title>arrows-v</title>
                <path d="M11 5c0 0.547-0.453 1-1 1h-2v16h2c0.547 0 1 0.453 1 1 0 0.266-0.109 0.516-0.297 0.703l-4 4c-0.187 0.187-0.438 0.297-0.703 0.297s-0.516-0.109-0.703-0.297l-4-4c-0.187-0.187-0.297-0.438-0.297-0.703 0-0.547 0.453-1 1-1h2v-16h-2c-0.547 0-1-0.453-1-1 0-0.266 0.109-0.516 0.297-0.703l4-4c0.187-0.187 0.438-0.297 0.703-0.297s0.516 0.109 0.703 0.297l4 4c0.187 0.187 0.297 0.438 0.297 0.703z"></path>
            </svg>
        </div>
        <button class="row-delete" type="button">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="22" height="28" viewBox="0 0 22 28">
                <title>close</title>
                <path d="M20.281 20.656c0 0.391-0.156 0.781-0.438 1.062l-2.125 2.125c-0.281 0.281-0.672 0.438-1.062 0.438s-0.781-0.156-1.062-0.438l-4.594-4.594-4.594 4.594c-0.281 0.281-0.672 0.438-1.062 0.438s-0.781-0.156-1.062-0.438l-2.125-2.125c-0.281-0.281-0.438-0.672-0.438-1.062s0.156-0.781 0.438-1.062l4.594-4.594-4.594-4.594c-0.281-0.281-0.438-0.672-0.438-1.062s0.156-0.781 0.438-1.062l2.125-2.125c0.281-0.281 0.672-0.438 1.062-0.438s0.781 0.156 1.062 0.438l4.594 4.594 4.594-4.594c0.281-0.281 0.672-0.438 1.062-0.438s0.781 0.156 1.062 0.438l2.125 2.125c0.281 0.281 0.438 0.672 0.438 1.062s-0.156 0.781-0.438 1.062l-4.594 4.594 4.594 4.594c0.281 0.281 0.438 0.672 0.438 1.062z"></path>
            </svg>
        </button>
        <div class="row-inputs -horizontal">
            <component
                v-for="(subField, index) in field.sub_fields"
                :is="`${subField.type}-sub-field`"
                :key="index"
                :sub-field="subField"
                v-model="value[subField.name]"
            ></component>
        </div>
    </div>
</template>

<script>
    import TextSubField from '../sub-fields/TextSubField.vue';
    import NumberSubField from '../sub-fields/NumberSubField.vue';

    export default {

        components: {
            TextSubField,
            NumberSubField
        },

        props: ['value', 'field', 'index'],

    }
</script>