<?php $data = $site->entity()->toEntity() ?>
<?= $data->files()->toFile()->url() ?>

<?php $data = $page->entity()->toEntity() ?>
<?= $data->files()->toFile()->url() ?>
