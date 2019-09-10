<template>
    <div class="row" :class="formLayout">
        <div class="js-row-move row-move">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="12" height="28" viewBox="0 0 12 28">
                <title>arrows-v</title>
                <path d="M11 5c0 0.547-0.453 1-1 1h-2v16h2c0.547 0 1 0.453 1 1 0 0.266-0.109 0.516-0.297 0.703l-4 4c-0.187 0.187-0.438 0.297-0.703 0.297s-0.516-0.109-0.703-0.297l-4-4c-0.187-0.187-0.297-0.438-0.297-0.703 0-0.547 0.453-1 1-1h2v-16h-2c-0.547 0-1-0.453-1-1 0-0.266 0.109-0.516 0.297-0.703l4-4c0.187-0.187 0.438-0.297 0.703-0.297s0.516 0.109 0.703 0.297l4 4c0.187 0.187 0.297 0.438 0.297 0.703z"></path>
            </svg>
        </div>
        <button
            class="row-delete"
            type="button"
            @click="deleteRow">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="22" height="28" viewBox="0 0 22 28">
                <title>close</title>
                <path d="M20.281 20.656c0 0.391-0.156 0.781-0.438 1.062l-2.125 2.125c-0.281 0.281-0.672 0.438-1.062 0.438s-0.781-0.156-1.062-0.438l-4.594-4.594-4.594 4.594c-0.281 0.281-0.672 0.438-1.062 0.438s-0.781-0.156-1.062-0.438l-2.125-2.125c-0.281-0.281-0.438-0.672-0.438-1.062s0.156-0.781 0.438-1.062l4.594-4.594-4.594-4.594c-0.281-0.281-0.438-0.672-0.438-1.062s0.156-0.781 0.438-1.062l2.125-2.125c0.281-0.281 0.672-0.438 1.062-0.438s0.781 0.156 1.062 0.438l4.594 4.594 4.594-4.594c0.281-0.281 0.672-0.438 1.062-0.438s0.781 0.156 1.062 0.438l2.125 2.125c0.281 0.281 0.438 0.672 0.438 1.062s-0.156 0.781-0.438 1.062l-4.594 4.594 4.594 4.594c0.281 0.281 0.438 0.672 0.438 1.062z"></path>
            </svg>
        </button>
        <div class="row-inputs flex-wrap" :class="formLayout">
            <h3 v-if="field.heading && field.display_stacked" class="mb-2">
                {{ field.heading + " #" + (index + 1) }}
            </h3>
            <component
                v-if="subField.type"
                v-for="(subField, index) in field.sub_fields"
                :is="`${subField.type}-sub-field`"
                :key="index"
                :sub-field="subField"
                v-model="value[subField.name]"
                class="row-input"
                :class="getInputLayout(subField)"
            ></component>

            <template
                v-if="!subField.type"
                v-for="(subField, i) in field.sub_fields">
                    <component
                        :is="'form-' + subField.component"
                        :key="i"
                        :name="'f-' + subField.attribute"
                        :field="subField"
                        :resource-id="resourceId"
                        :resource-name="resourceName"
                        v-model="value[subField.attribute]"
                        class="row-input"
                        :class="getInputLayout(subField)"
                    ></component>
            </template>

        </div>
    </div>
</template>

<script>
    import TextSubField from '../sub-fields/TextSubField.vue';
    import EmailSubField from '../sub-fields/EmailSubField.vue';
    import NumberSubField from '../sub-fields/NumberSubField.vue';
    import SelectSubField from '../sub-fields/SelectSubField.vue';
    import TextareaSubField from '../sub-fields/TextareaSubField.vue';

    export default {

        components: {
            TextSubField,
            EmailSubField,
            NumberSubField,
            SelectSubField,
            TextareaSubField,
        },

        props: ['value', 'field', 'index', 'resourceName', 'resourceId'],

        mounted(){
            var _this = this;

            this.$children.filter(component => {
                if(component.field){
                    component.value = _this.value[component.field.attribute]
                }

                component.$watch(
                    value => {
                        if(component.field){
                            _this.value[component.field.attribute] = component.value
                        }
                    }
                );
            });
        },

        computed:{
            formLayout(){
                return (this.field.display_stacked)
                    ? '-vertical'
                    : '-horizontal';
            }
        },

        methods:{
            deleteRow(){
                this.$emit('delete-row', this.index);
            },
            getInputLayout(subField){

                let width = (subField.width)
                    ? subField.width
                    : 'flex-1';

                if(this.field.display_stacked){
                	return this.formLayout;
                }
                return `${this.formLayout} ${width} mb-2`
            },
        }

    }
</script>
