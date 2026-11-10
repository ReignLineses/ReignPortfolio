<?php
require_once __DIR__ . '/includes/functions.php';

$pageTitle   = 'Projects — REIGN';
$currentPage = 'projects';

$projects   = getProjects();
$categories = getCategories($projects);

// Active filter (?category=Pixel Art). Unknown values are ignored.
$requestedCategory = filter_input(INPUT_GET, 'category');
$activeCategory    = in_array($requestedCategory, $categories, true) ? $requestedCategory : '';

$shown = $activeCategory === ''
    ? $projects
    : array_filter($projects, fn (array $project) => $project['category'] === $activeCategory);

include __DIR__ . '/includes/header.php';
?>

<section class="listPage">
    <header class="listHead">
        <h1 class="pageTitle">Projects</h1>
        <p class="listCount">
            <?= countLabel(count($shown), 'project') ?><?= $activeCategory !== '' ? ' in ' . e($activeCategory) : '' ?>
        </p>
    </header>

    <?php if (count($categories) > 1): ?>
        <nav class="filters" aria-label="Filter by category">
            <a href="projects.php"<?= $activeCategory === '' ? ' aria-current="true"' : '' ?>>All</a>
            <?php foreach ($categories as $category): ?>
                <a href="projects.php?category=<?= urlencode($category) ?>"<?= $activeCategory === $category ? ' aria-current="true"' : '' ?>>
                    <?= e($category) ?>
                </a>
            <?php endforeach; ?>
        </nav>
    <?php endif; ?>

    <?php if (empty($shown)): ?>
        <p class="listEmpty">No projects here yet. Add images to <code>assets/img/projects/</code> and add their details to the <code>projects</code> table in phpMyAdmin.</p>
    <?php else: ?>
        <ul class="cardGrid">
            <?php foreach ($shown as $project): ?>
                <li class="card">
                    <a href="<?= e(projectUrl($project['id'])) ?>">
                        <div class="cardMedia"><?= imageTag($project['image'], projectAlt($project), true) ?></div>
                        <div class="cardInfo">
                            <h2 class="cardTitle"><?= e($project['title']) ?></h2>
                            <p class="cardMeta"><?= e($project['category']) ?>, <?= e($project['year']) ?></p>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
