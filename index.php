<?php

use Kirby\Cms\App;
use Kirby\Cms\Content;
use Kirby\Form\Form;
use Kirby\Data\Yaml;

App::plugin('oblik/entity-field', [
	'options' => [
		'toggle' => false,
	],
	'fields' => [
		'entity' => [
			'props' => [
				'fields' => function (array $fields) {
					return $fields;
				},
				'icon' => function ($icon = null) {
					return $icon;
				},
				'toggle' => function ($toggle = null) {
					return $toggle ?? option('oblik.entity-field.toggle');
				},
			],
			'computed' => [
				'value' => function () {
					$data = Yaml::decode($this->value);
					return $this->form($data)->values();
				},
				'fields' => function () {
					if (empty($this->fields)) {
						throw new Exception('Please provide some fields for the entity');
					}

					return $this->form()->fields()->toArray();
				}
			],
			'methods' => [
				/**
				 * Similar to the `form()` method of the native structure field:
				 * https://github.com/getkirby/kirby/blob/3.7.3/config/fields/structure.php#L172-L178
				 */
				'form' => function (array $values = []) {
					return new Form([
						'fields' => $this->attrs['fields'],
						'values' => $values,
						'model'  => $this->model
					]);
				},
			],
			'save' => function ($value) {
				$data = $this->form($value)->data(true);
				$dataFiltered = array_filter($data);

				if (count($dataFiltered) > 0) {
					return $dataFiltered;
				} else {
					return null;
				}
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
			return new Content($field->yaml(), $field->parent());
		}
	],
	'translations' => [
		'en' => [
			'oblik.entity-field.field' => 'Field',
			'oblik.entity-field.fields' => 'Fields'
		],
	]
]);
