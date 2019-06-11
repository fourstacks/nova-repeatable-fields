<template>
    <div>
        <div>
            <textarea
                :id="subField.name"
                :name="subField.name"
                class="w-full form-control form-input form-input-bordered py-3 h-auto"
                :placeholder="subField.placeholder"
                v-bind="subField.attributes"
                @input="$emit('input', $event.target.value)"
                rows="5"
                :class="errorClasses"
            >{{value}}</textarea>
        </div>
        <p v-if="hasError" class="my-2 text-danger">
            {{ firstError }}
        </p>
    </div>
</template>

<script>
    import {HandlesValidationErrors} from 'laravel-nova'

    export default {

        mixins: [HandlesValidationErrors],

        computed: {
            fieldAttribute() {
                return this.attribute
            },
        },

        props: [
            'subField',
            'value',
            'attribute'
        ],

    }
</script>
