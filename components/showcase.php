<?php
/**
 * Immersive showcase section. Needs includes/functions.php loaded already.
 */
$featured = getFeaturedProjects();
$total    = count($featured);

$lead  = 0.7;   // scroll distance before project 1 reaches the centre
$tail  = 0.4;   // scroll distance the last project stays before the section ends
$steps = ($total - 1) + $lead + $tail;
?>
<?php if ($total === 0): ?>
    <section class="showcaseEmpty" id="showcase">
        <h2>Selected projects</h2>
        <p>No featured projects yet. Add images to <code>assets/img/projects/</code>
           and add their details to the <code>projects</code> table in phpMyAdmin.</p>
    </section>
<?php else: ?>
    <section class="showcase" id="showcase" data-showcase
             data-lead="<?= $lead ?>" data-tail="<?= $tail ?>"
             style="--steps: <?= number_format($steps, 2, '.', '') ?>;"
             aria-label="Selected projects">

        <div class="showcaseStage">
            <!-- First in tab order so keyboard users can bypass every project link -->
            <div class="showcaseActions">
                <a class="showcaseSkip" href="#top">To the Top</a>
                <a class="showcaseSkip" href="#whatIDo">Skip showcase</a>
            </div>

            <div class="showcaseItems">
                <?php foreach ($featured as $project): ?>
                    <?php include __DIR__ . '/showcaseItem.php'; ?>
                <?php endforeach; ?>
            </div>

            <div class="showcaseHud">
                <p class="showcaseLabel">Projects</p>
                <p class="showcaseCounter" aria-hidden="true">
                    <span data-current>01</span><span class="showcaseOf"> / <?= sprintf('%02d', $total) ?></span>
                </p>
            </div>
        </div>
    </section>
<?php endif; ?>
