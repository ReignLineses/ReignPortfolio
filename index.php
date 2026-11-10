<?php
require_once __DIR__ . '/includes/functions.php';

$pageTitle   = 'REIGN - Online Portfolio of Reign';
$currentPage = 'home';
$profile     = getProfile();

// Scripts loaded only on this page (GSAP, then ScrollTrigger, then ours)
$pageScripts = [
    'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
    'assets/js/showcase.js',
];

// Words in the slow ticker under the hero
$ticker = ['Graphic Design', 'Logo Design', 'Pixel Art', 'UI/UX', 'Web Development', 'IT Support', 'Networking'];

include __DIR__ . '/includes/header.php';
?>

<!-- ========== HERO ========== -->
<section class="hero" id="top">
    <div class="heroTop">
        <p class="heroSmall">Portfolio of <?= e($profile['name']) ?></p>
        <p class="heroSmall heroStatus"><span class="dot" aria-hidden="true"></span> Available for projects</p>
    </div>

    <h1 class="heroTitle">Reign</h1>

    <div class="heroBottom">
        <p class="heroIntro">
            Designer by craft, IT problem-solver by day. I make logos,
            illustrations and interfaces, build websites, and keep
            devices and networks running. Scroll to see the projects.
        </p>

        <ul class="heroRoles" aria-label="What I do">
            <?php foreach ($profile['identities'] as $identity): ?>
                <li><?= e($identity['title']) ?></li>
            <?php endforeach; ?>
        </ul>

        <a class="heroCue" href="#showcase">
            <span class="heroCueLine" aria-hidden="true"></span>
            <span>See the projects</span>
        </a>
    </div>
</section>

<!-- Slow ticker (stops with reduced-motion) -->
<div class="ticker" aria-hidden="true">
    <div class="tickerTrack">
        <?php for ($copy = 0; $copy < 2; $copy++): ?>
            <ul>
                <?php foreach ($ticker as $word): ?>
                    <li><?= e($word) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endfor; ?>
    </div>
</div>

<!-- ========== SHOWCASE ========== -->
<?php include __DIR__ . '/components/showcase.php'; ?>

<!-- ========== IDENTITIES ========== -->
<section class="identities" id="whatIDo">
    <header class="sectionHead">
        <h2 class="sectionHeadTitle">One person,<br>four skill sets.</h2>
        <p class="sectionHeadText">
            My work moves between creative and technical. Both come down to
            the same thing: making things work well and look right.
        </p>
    </header>

    <ul class="identitiesGrid">
        <?php foreach ($profile['identities'] as $identity): ?>
            <li class="identity">
                <h3 class="identityTitle"><?= e($identity['title']) ?></h3>
                <p class="identityText"><?= e($identity['text']) ?></p>
                <ul class="identityTags">
                    <?php foreach ($identity['tags'] as $tag): ?>
                        <li><?= e($tag) ?></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<section class="allProjects">
    <a class="allProjectsLink" href="projects.php">
        <span>View all projects</span>
        <span aria-hidden="true">→</span>
    </a>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
