<?php $data = $site->entity()->toEntity() ?>
<?php echo $data->files()->toFile()->url() ?>

<?php $data = $page->entity()->toEntity() ?>
<?php echo $data->files()->toFile()->url() ?>
