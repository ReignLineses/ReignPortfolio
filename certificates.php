<?php
require_once __DIR__ . '/includes/functions.php';

$pageTitle    = 'Certificates — REIGN';
$currentPage  = 'certificates';
$certificates = getCertificates();

include __DIR__ . '/includes/header.php';
?>

<section class="listPage">
    <header class="listHead">
        <h1 class="pageTitle">Certificates</h1>
        <p class="listCount"><?= countLabel(count($certificates), 'certificate') ?></p>
    </header>

    <?php if (empty($certificates)): ?>
        <p class="listEmpty">No certificates yet. Add images to <code>assets/img/certificates/</code> and add their details to the <code>certificates</code> table in phpMyAdmin.</p>
    <?php else: ?>
        <ul class="cardGrid cardGridWide">
            <?php foreach ($certificates as $certificate): ?>
                <li class="card">
                    <!-- The picture opens full size, so the certificate text stays readable -->
                    <a href="<?= e($certificate['image']['src']) ?>" target="_blank" rel="noopener">
                        <div class="cardMedia"><?= imageTag($certificate['image'], $certificate['title'] . ' certificate', true) ?></div>
                    </a>
                    <div class="cardInfo">
                        <h2 class="cardTitle"><?= e($certificate['title']) ?></h2>
                        <p class="cardMeta"><?= e($certificate['issuer']) ?>, <?= e(date('F Y', strtotime($certificate['issuedOn']))) ?></p>
                        <?php if ($certificate['credentialUrl'] !== null): ?>
                            <a class="cardLink" href="<?= e($certificate['credentialUrl']) ?>" target="_blank" rel="noopener">Verify credential ↗</a>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
