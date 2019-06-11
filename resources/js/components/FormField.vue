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
                        :errors="childErrors"
                ></sub-field-row>
            </draggable>

            <button
                    type="button"
                    class="btn btn-default btn-primary"
                    @click.prevent="addNewRow"
                    v-text="addButtonText"
                    :class="{ 'cursor-not-allowed opacity-50': hasReachedMaximumRows }"
            ></button>
        </template>
    </default-field>
</template>

<script>
	import draggable from 'vuedraggable'
	import {FormField, HandlesValidationErrors} from 'laravel-nova'
	import SubFieldRow from './rows/SubFieldRow.vue';
    import { Errors } from 'form-backend-validation'

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

		computed: {
		    childErrors() {
		        if (this.hasError) {
		            return new Errors(this.firstError);
                }

		        return new Errors();
            },

			addButtonText() {
				return (this.field.add_button_text)
					? this.field.add_button_text
					: 'Add row'
			},

			hasReachedMaximumRows() {
				if (this.field.maximum_rows) {
					return this.rows.length >= this.field.maximum_rows;
				}

				return false;

			},
			shouldAddInitialRows() {
				return (this.field.initial_rows) && (this.field.initial_rows > this.rows.length);
			}
		},

		methods: {

			setInitialValue() {
				this.value = this.field.value || '';
				this.$nextTick(() => {
					this.rows = (this.value)
						? JSON.parse(this.value)
						: [];

					if (this.shouldAddInitialRows) {
						let count = this.field.initial_rows - this.rows.length;
						for (let i = 1; i <= count; i++) {
							this.addNewRow();
						}
					}
				});
			},

			fill(formData) {
				formData.append(this.field.attribute, this.value || '')
			},

			addNewRow() {
				if (! this.hasReachedMaximumRows) {
					let newRow = this.field.sub_fields
						.map(subField => subField.name)
						.reduce((o, key) => ({...o, [key]: null}), {});

					this.rows.push(newRow);
				}
			},

			deleteRow(index) {
				this.rows.splice(index, 1);
			}
		},

		watch: {
			'rows': {
				handler: function (newRows) {
					this.value = JSON.stringify(newRows);
				},
				deep: true
			}
		}
	}
</script>
