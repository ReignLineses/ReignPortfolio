<?php
// Each page sets these BEFORE including this file.
$pageTitle   = $pageTitle   ?? 'REIGN — Online Portfolio';
$currentPage = $currentPage ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f7f7f4">
    <title><?= e($pageTitle) ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/img/logo/reignLogo.png?v=3">

    <!-- Fonts: Syne (display) + Inter (text). Needs internet. -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&amp;family=Syne:wght@500;700;800&amp;display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/showcase.css">
    <link rel="stylesheet" href="assets/css/listing.css">
    <link rel="stylesheet" href="assets/css/project.css">
    <link rel="stylesheet" href="assets/css/contact.css">
</head>
<body>

<a class="skipLink" href="#main">Skip to content</a>

<header class="siteHeader" data-header>
    <a class="brand" href="index.php" aria-label="REIGN – home">
        <span class="brandMark">
            <img src="assets/img/logo/reignLogo.png" alt="" width="64" height="64">
        </span>
        <span class="brandWord">REIGN</span>
    </a>

    <button class="navToggle" type="button" aria-expanded="false" aria-controls="siteNav" data-nav-toggle>
        <span>Menu</span>
        <span class="navToggleIcon" aria-hidden="true"></span>
    </button>

    <nav id="siteNav" class="siteNav" aria-label="Primary">
        <ul>
            <?php foreach (getNavItems() as $key => [$label, $href]): ?>
                <li>
                    <a href="<?= e($href) ?>"<?= $currentPage === $key ? ' aria-current="page"' : '' ?>>
                        <?= e($label) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>

<main id="main">
