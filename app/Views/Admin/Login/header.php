<?php
/**
 * @var string $tags
 * @var string $description
 * @var string $identifier
 */
$identifier = isset($identifier) ? str_replace('/', '-', $identifier) : '';
$tags = $tags ?? '';
$description = $description ?? '';
?>
<!doctype html>
<html class="h-100">
<?= partial_view('head') ?>
<body class="d-flex flex-column h-100 <?= $identifier ?>">
<main role="main" class="h-100">