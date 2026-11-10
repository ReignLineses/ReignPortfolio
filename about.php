<?php
require_once __DIR__ . '/includes/functions.php';

$pageTitle   = 'About — REIGN';
$currentPage = 'about';
$profile     = getProfile();
$experience  = getExperience();

include __DIR__ . '/includes/header.php';
?>

<section class="aboutIntro">
    <h1 class="pageTitle">About</h1>
    <p class="aboutIntroText">
        I'm <?= e($profile['name']) ?>, a designer and IT problem-solver.
    </p>
</section>

<section class="experience" id="experience">
    <header class="sectionHead">
        <h2 class="sectionHeadTitle">Work<br>experience</h2>
    </header>

    <ol class="experienceList">
        <?php foreach ($experience as $job): ?>
            <li class="job">
                <p class="jobPeriod">
                    <?php if ($job['isCurrent']): ?><span class="dot" aria-hidden="true"></span><?php endif; ?>
                    <?= e($job['period']) ?>
                </p>
                <div class="jobMain">
                    <h3 class="jobRole"><?= e($job['role']) ?></h3>
                    <p class="jobPlace"><?= e($job['place']) ?></p>
                </div>
                <ul class="jobPoints">
                    <?php foreach ($job['points'] as $point): ?>
                        <li><?= e($point) ?></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ol>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>