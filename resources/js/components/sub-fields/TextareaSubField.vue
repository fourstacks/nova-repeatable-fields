<template>
    <div>
        <textarea
            :id="subField.name"
            :name="subField.name"
            class="w-full form-control form-input form-input-bordered py-3 h-auto"
            :placeholder="subField.placeholder"
            v-bind="subField.attributes"
            @input="$emit('input', $event.target.value)"
            rows="5"
        >{{value}}</textarea>
    </div>

</template>

<script>

    export default {

        props: [
            'subField',
            'value'
        ],

    }
</script>