<?php $siteEntity = $site->entity()->toEntity() ?>

<h1><?= $siteEntity->text() ?></h1>

<img src="<?= $siteEntity->logo()->toFile()->url() ?>">

<ul>
	<?php foreach ($siteEntity->structure()->toStructure() as $entry) : ?>
		<li>
			<a href="<?= $entry->url() ?>" target="_blank">
				<?= $entry->url() ?>
			</a>
		</li>
	<?php endforeach ?>
</ul>

<ul>
	<?php foreach ($site->structure()->toStructure() as $entry) : ?>
		<?php
		$entity = $entry->entity()->toEntity();
		$nestedEntity = $entity->entity()->toEntity();
		?>
		<li>
			<ul>
				<li>text: <?= $entity->text() ?></li>
				<li>nested text: <?= $nestedEntity->text() ?></li>
			</ul>
		</li>
	<?php endforeach ?>
</ul>
