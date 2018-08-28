<?php

namespace Fourstacks\NovaRepeatableFields;

use Laravel\Nova\Fields\Field;

class Repeater extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-repeatable-fields';

    public function addField($fieldConfig)
    {
        $config = $this->normaliseFieldConfig($fieldConfig);

        $fields = (array_key_exists('sub_fields', $this->meta))
            ? $this->meta['fields']
            : [];

        $this->withMeta([
            'sub_fields' => array_push($fields, $config),
        ]);
    }

    private function normaliseFieldConfig($fieldConfig)
    {
        $allowedKeys = ['label', 'name', 'placeholder', 'type', 'width'];
        $config = array_intersect_key($fieldConfig, array_flip($allowedKeys));

        if(! isset($config['name'])){
            $config['name'] = str_slug($config['name'], '_');
        }
        if(! isset($config['placeholder'])){
            $config['placeholder'] = $config['name'];
        }
        if(! isset($config['type'])){
            $config['type'] = 'text';
        }
        if(! isset($config['width'])){
            $config['width'] = null;
        }

        return $config;
    }
}
