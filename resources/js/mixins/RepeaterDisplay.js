export default{

    data: () => ({
        detailVisible: false,
    }),

    computed: {
        value() {
            return (this.field.value)
                ? JSON.parse(this.field.value)
                : [];
        },
        toggleText() {
            return (this.detailVisible)
                ? 'Hide detail'
                : 'Show detail'
        },
        summaryText() {
            return `${this.summaryTextNumber} ${this.summaryTextLabel}`;
        },
        summaryTextNumber() {
            return (this.field.value)
                ? this.value.length
                : 0;
        },
        summaryTextLabel() {
            return (this.field.summary_label)
                ? this.field.summary_label
                : 'rows';
        },
        rows() {
            return this.value.map(row => {
                let keys = Object.keys(row);

                return keys.map(key => {
                    return {
                        label: this.field.sub_fields.find(field => field.name === key).label,
                        value: row[key]
                    }
                });
            })
        }
    },

    methods: {
        toggleDetail() {
            this.detailVisible = !this.detailVisible;
        }
    }

}