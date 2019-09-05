<?php

use Kirby\Cms\Form;
use Kirby\Cms\Structure;
use Kirby\Data\Yaml;

Kirby::plugin('oblik/entity-field', [
    'fields' => [
        'entity' => [
            'props' => [
                'fields' => function (array $fields) {
                    return $fields;
                }
            ],
            'computed' => [
                'value' => function () {
                    $model = Yaml::decode($this->value);
                    return $this->form($model)->values();
                },
                'fields' => function () {
                    return $this->form()->fields()->toArray();
                }
            ],
            'methods' => [
                'form' => function (array $values = []) {
                    return new Form([
                        'fields' => $this->attrs['fields'],
                        'values' => $values,
                        'model'  => $this->model
                    ]);
                },
            ],
            'save' => function ($value) {
                return $this->form($value)->data(true);
            },
            'validations' => [
                // needs custom validator to validate the form with:
                // $this->field()->form($this->requestBody())->errors()
                // before saving @see https://github.com/getkirby/ideas/issues/277
            ]
        ]
    ],
    'fieldMethods' => [
        'toEntity' => function ($field) {
            $data = $field->yaml();
            $entries = [$data];
            $structure = new Structure($entries);
            return $structure->first();
        }
    ]
]);
