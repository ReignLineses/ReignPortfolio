<?php
/**
 * One project inside the showcase.
 * Expects: $project (array) from components/showcase.php
 */
$image = $project['image'];
?>
<article class="showcaseItem" data-showcase-item data-motion="<?= e($project['motion']) ?>" style="--ar: <?= $image['ratio'] ?>;">
    <a class="showcaseLink" href="<?= e(projectUrl($project['id'])) ?>">
        <div class="showcaseInner">

            <div class="showcaseFrame">
                <?= imageTag($image, projectAlt($project)) ?>
            </div>

            <div class="showcaseCaption" data-caption>
                <h3 class="showcaseTitle">
                    <?= e($project['title']) ?>
                    <span class="showcaseArrow" aria-hidden="true">↗</span>
                </h3>
                <p class="showcaseMeta"><?= e($project['category']) ?>, <?= e($project['year']) ?></p>
            </div>

        </div>
    </a>
</article>
