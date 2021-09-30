<?php
/**
 * @var string                $identifier
 * @var \App\Entities\SysPage $page
 */
if (isset($page))
{
	$identifier = current(explode('/', $page->uri));
} else
{
	$page = null;
}
$meta_keywords = $meta_keywords ?? null;
$meta_description = $meta_description ?? null;
$identifier = isset($identifier) ? str_replace('/', '-', $identifier) : '';
?>
<!doctype html>
<html class="h-100" lang="es">
<?= partial_view('head', compact(['page', 'meta_keywords', 'meta_description'])) ?>
<body class="d-flex flex-column h-100 <?= $identifier ?>">
<section id="App" class="d-flex flex-column h-100">
<main role="main" class="flex-shrink-0">