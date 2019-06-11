<template>
    <div>
        <div>
            <select
                :id="subField.name"
                :name="subField.name"
                class="w-full form-control form-select"
                :class="errorClasses"
                :value="value"
                v-bind="subField.attributes"
                @change="$emit('input', $event.target.value)">
                <option
                    value=""
                    v-text="placeholder"
                    selected
                    disabled
                ></option>
                <option
                    v-for="(label, name) in subField.options"
                    :value="name"
                    :selected="name == value"
                    v-text="label"
                ></option>
            </select>
        </div>
        <p v-if="hasError" class="my-2 text-danger">
            {{ firstError }}
        </p>
    </div>

</template>

<script>
    import {HandlesValidationErrors} from 'laravel-nova'

    export default {

        props: [
            'subField',
            'value',
            'attribute'
        ],

        mixins: [HandlesValidationErrors],

        computed: {
            fieldAttribute() {
                return this.attribute
            },

            placeholder() {
                return !this.subField.placeholder
                    ? this.__('Choose an option')
                    : this.subField.placeholder
            }
        }
    }
</script>
