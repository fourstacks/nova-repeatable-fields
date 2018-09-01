<template>
    <default-field :field="field">
        <template slot="field">
            <draggable
                v-model="rows"
                :options="{ handle: '.js-row-move' }">
                <sub-field-row
                    v-for="(row, index) in rows"
                    v-model="rows[index]"
                    :key="index"
                    :index="index"
                    :field="field"
                    @delete-row="deleteRow"
                ></sub-field-row>
            </draggable>

            <button
                class="btn btn-default btn-primary"
                @click.prevent="addNewRow"
                v-text="addButtonText"
            ></button>

            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
        </template>
    </default-field>
</template>

<script>
    import draggable from 'vuedraggable'
    import {FormField, HandlesValidationErrors} from 'laravel-nova'
    import SubFieldRow from './rows/SubFieldRow.vue';

    export default {

        mixins: [FormField, HandlesValidationErrors],

        components: {
            draggable,
            SubFieldRow
        },

        data: () => ({
            value: '',
            rows: []
        }),

        props: ['resourceName', 'resourceId', 'field'],

        computed:{
            addButtonText(){
                return (this.field.add_button_text)
                    ? this.field.add_button_text
                    : 'Add row'
            }
        },

        methods: {

            setInitialValue() {
                this.value = this.field.value || '';
                this.$nextTick(() => {
                    this.rows = (this.value)
                        ? JSON.parse(this.value)
                        : [];
                });
            },

            fill(formData) {
                formData.append(this.field.attribute, this.value || '')
            },

            addNewRow() {
                let newRow = this.field.sub_fields
                    .map(subField => subField.name)
                    .reduce((o, key) => ({...o, [key]: null}), {});

                this.rows.push(newRow);
            },

            deleteRow(index){
                this.rows.splice(index, 1);
            }
        },

        watch: {
            'rows' : {
                handler: function (newRows) {
                    this.value = JSON.stringify(newRows);
                },
                deep: true
            }
        }
    }
</script>
