<?php
require_once __DIR__ . '/includes/functions.php';

$project = findProject((int) filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));

// Unknown id, or the image file is missing → 404 page
if ($project === null) {
    http_response_code(404);
    $pageTitle   = 'Not found — REIGN';
    $currentPage = 'projects';
    include __DIR__ . '/includes/header.php';
    ?>
    <section class="pageStub">
        <h1>Not found</h1>
        <p>That project doesn't exist. <a href="projects.php">See all projects</a></p>
    </section>
    <?php
    include __DIR__ . '/includes/footer.php';
    return;
}

$pageTitle   = $project['title'] . ' — REIGN';
$currentPage = 'projects';

// Main image first, then the gallery images.
$images    = [$project['image'], ...$project['gallery']];
$neighbors = getNeighbors($project['id']);

include __DIR__ . '/includes/header.php';
?>

<article class="project">

    <header class="projectHead">
        <a class="projectBack" href="projects.php">← All projects</a>
        <h1 class="projectTitle"><?= e($project['title']) ?></h1>

        <dl class="projectMeta">
            <div><dt>Category</dt><dd><?= e($project['category']) ?></dd></div>
            <div><dt>Year</dt><dd><?= e($project['year']) ?></dd></div>
        </dl>

        <?php if ($project['description'] !== ''): ?>
            <p class="projectText"><?= e($project['description']) ?></p>
        <?php endif; ?>
    </header>

    <div class="projectShots">
        <?php foreach ($images as $number => $image): ?>
            <figure class="shot" style="--ar: <?= $image['ratio'] ?>; --cap: <?= $image['width'] ?>px;">
                <div class="shotFrame">
                    <?= imageTag($image, $project['title'] . ($number > 0 ? ' — image ' . ($number + 1) : ''), $number > 0) ?>
                </div>
            </figure>
        <?php endforeach; ?>
    </div>

    <nav class="projectNav" aria-label="More projects">
        <?php if ($neighbors['previous']): ?>
            <a class="projectNavLink" href="<?= e(projectUrl($neighbors['previous']['id'])) ?>" rel="prev">
                <span class="projectNavLabel">← Previous</span>
                <span class="projectNavTitle"><?= e($neighbors['previous']['title']) ?></span>
            </a>
        <?php endif; ?>

        <?php if ($neighbors['next']): ?>
            <a class="projectNavLink projectNavLinkNext" href="<?= e(projectUrl($neighbors['next']['id'])) ?>" rel="next">
                <span class="projectNavLabel">Next →</span>
                <span class="projectNavTitle"><?= e($neighbors['next']['title']) ?></span>
            </a>
        <?php endif; ?>
    </nav>

</article>

<?php include __DIR__ . '/includes/footer.php'; ?>
