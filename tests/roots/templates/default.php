<?php $data = $site->data()->toEntity() ?>
<?php echo $data->myfile()->toFile()->url() ?>

<?php $data = $page->data()->toEntity() ?>
<?php echo $data->myfile()->toFile()->url() ?>
