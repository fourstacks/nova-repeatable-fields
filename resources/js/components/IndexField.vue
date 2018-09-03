<template>
    <div class="py-4">
        <p class="mb-4"><strong v-text="summaryText"></strong></p>
        <ul v-show="detailVisible" class="list-reset">
            <li v-for="row in rows">
                <ul class="list-reset mb-4">
                    <li class="flex items-top mb-1" v-for="subRow in row">
                        <span class="block w-1/6 mr-2">{{ subRow.label }}:</span>
                        <span class="block"><strong>{{ subRow.value }}</strong></span>
                    </li>
                </ul>
            </li>
        </ul>
        <a @click.prevent="toggleDetail"
           aria-role="button"
           class="cursor-pointer dim inline-block text-primary font-bold"
           v-text="toggleText"
        ></a>
    </div>
</template>

<script>
    import RepeaterDisplay from '../mixins/RepeaterDisplay';

    export default {

        mixins: [RepeaterDisplay],

        props: ['resourceName', 'field'],
    }
</script>
