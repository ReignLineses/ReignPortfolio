<?php
require_once __DIR__ . '/includes/functions.php';

$pageTitle   = 'Contact — REIGN';
$currentPage = 'contact';
$profile     = getProfile();

include __DIR__ . '/includes/header.php';
?>

<section class="contactPage">
    <h1 class="pageTitle">Contact</h1>

    <p class="contactLead">Have a project in mind, or need something fixed? Reach out any time.</p>

    <a class="contactEmail" href="mailto:<?= e($profile['email']) ?>"><?= e($profile['email']) ?></a>

    <ul class="contactSocials">
        <?php foreach ($profile['socials'] as $name => $url): ?>
            <li>
                <a href="<?= e($url) ?>" target="_blank" rel="noopener">
                    <span><?= e($name) ?></span>
                    <span aria-hidden="true">↗</span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
