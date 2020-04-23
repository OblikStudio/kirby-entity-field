<?php

if (class_exists('Kirby\Cms\App')) {
	require 'lib/index.php';
} else {
	require_once 'kirby/bootstrap.php';
	echo kirby()->render();
}
