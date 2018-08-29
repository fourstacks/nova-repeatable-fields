<template>
    <div class="flex -mx-2">
        <component
            v-for="(subField, index) in field.sub_fields"
            :is="`${subField.type}-sub-field`"
            :key="index"
            :sub-field="subField"
            v-model="value[subField.name]"
        ></component>
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