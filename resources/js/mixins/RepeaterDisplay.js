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
                ? this.__('Hide detail')
                : this.__('Show detail')
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
                    let subField = this.field.sub_fields.find(field => field.name === key);
                    let value = (['select'].some(type => type === subField.type))
                        ? subField.options[row[key]]
                        : row[key];
                    return {
                        label: subField.label,
                        value: value
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
