<?php


namespace Fourstacks\NovaRepeatableFields;

use Illuminate\Contracts\Validation\Rule;
use Laravel\Nova\Fields\Field;

class ArrayRules implements Rule
{
    /**
     * @var array
     */
    private $rules = [];

    /**
     * @var array
     */
    private $messages = [];

    /**
     * @var Field
     */
    private $field;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Repeater $field, array $rules)
    {
        $this->rules = $rules;
        $this->field = $field;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $input = [$attribute => json_decode($value, JSON_OBJECT_AS_ARRAY)];
        $rules = $this->prefixRules();
        $attributes = $this->getAttributes();

        $validator = \Validator::make($input, $rules, [], $attributes);

        $this->message = $validator->errors();

        return $validator->passes();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }

    /**
     * @return array
     */
    private function prefixRules(): array
    {
        $rules = [];
        $attribute = $this->field->attribute;

        foreach ($this->rules as $key => $rule) {
            $rules["{$attribute}.*.{$key}"] = $rule;
        }

        return $rules;
    }

    /**
     * @return array
     */
    private function getAttributes(): array
    {
        $attributes = [];
        $subFields = $this->field->meta()['sub_fields'] ?? [];
        $attribute = $this->field->attribute;

        foreach ($subFields as $field) {
            $key = $field['name'];
            $attributes["{$attribute}.*.{$key}"] = strtolower($field['label']);
        }

        return $attributes;
    }
}
