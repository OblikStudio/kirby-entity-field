<?php

use Kirby\Cms\App;

if (class_exists('Kirby\Cms\App')) {
	App::plugin('oblik/entity-field', require 'lib/index.php');
} else {
	require_once 'kirby/bootstrap.php';
	echo kirby()->render();
}
