<?php $profile = getProfile(); ?>
</main>

<footer class="siteFooter">
    <div class="siteFooterTop">
        <p class="siteFooterLabel">Get in touch</p>
        <a class="siteFooterCta" href="contact.php">
            Have a project<br>in mind?
        </a>
        <p class="siteFooterMail"><?= e($profile['email']) ?></p>
    </div>

    <div class="siteFooterCols">
        <div>
            <p class="siteFooterLabel">Pages</p>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php foreach (getNavItems() as [$label, $href]): ?>
                    <li><a href="<?= e($href) ?>"><?= e($label) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div>
            <p class="siteFooterLabel">Elsewhere</p>
            <ul>
                <?php foreach ($profile['socials'] as $name => $url): ?>
                    <li><a href="<?= e($url) ?>" target="_blank" rel="noopener"><?= e($name) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="siteFooterBottom">
        <p>© <?= date('Y') ?> REIGN. All rights reserved.</p>
        <a href="#">Back to top ↑</a>
    </div>
</footer>

<script src="assets/js/main.js"></script>
<?php foreach (($pageScripts ?? []) as $script): ?>
<script src="<?= e($script) ?>"></script>
<?php endforeach; ?>
</body>
</html>
