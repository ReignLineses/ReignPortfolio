<?php
// Shared site helpers: view helpers first, then the data loaders for each table.
require_once __DIR__ . '/database.php';

const siteRoot = __DIR__ . '/../';
const projectImageDir = 'assets/img/projects/';
const certificateImageDir = 'assets/img/certificates/';

/* ---------- View helpers ---------- */

// Print text safely inside HTML.
function e(string|int|null $text): string
{
    return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
}

// Menu links: key => [label, file].
function getNavItems(): array
{
    return [
        'projects'     => ['Projects', 'projects.php'],
        'certificates' => ['Certificates', 'certificates.php'],
        'about'        => ['About', 'about.php'],
        'contact'      => ['Contact', 'contact.php'],
    ];
}

// "1 project", "3 projects".
function countLabel(int $count, string $noun): string
{
    return $count . ' ' . $noun . ($count === 1 ? '' : 's');
}

// Link to one project page.
function projectUrl(int $id): string
{
    return 'projectDetail.php?id=' . $id;
}

// Alt text shared by every picture of a project card.
function projectAlt(array $project): string
{
    return $project['title'] . ' — ' . $project['category'];
}

// <img> tag for an image from getImage(), with its real size so the page does not jump while loading.
function imageTag(array $image, string $alt, bool $isLazy = false): string
{
    return sprintf(
        '<img src="%s" width="%d" height="%d" alt="%s" decoding="async"%s>',
        e($image['src']),
        $image['width'],
        $image['height'],
        e($alt),
        $isLazy ? ' loading="lazy"' : ''
    );
}

/* ---------- Data helpers ---------- */

// Runs $load once per request and returns the same result afterwards.
function remember(string $key, callable $load): array
{
    static $cache = [];

    return $cache[$key] ??= $load();
}

// Turns JSON text columns of one row into arrays (broken JSON becomes an empty array).
function decodeJsonColumns(array $row, string ...$columns): array
{
    foreach ($columns as $column) {
        $row[$column] = json_decode($row[$column], true) ?? [];
    }

    return $row;
}

// Web path and real size of an image, or null when the file is missing or unreadable.
function getImage(string $directory, string $fileName): ?array
{
    $src  = $directory . $fileName;
    $size = is_file(siteRoot . $src) ? @getimagesize(siteRoot . $src) : false;

    if ($size === false) {
        return null;
    }

    [$width, $height] = $size;

    return [
        'src'    => $src,
        'width'  => $width,
        'height' => $height,
        'ratio'  => round($width / $height, 4),
    ];
}

// Replaces each row's 'image' file name with getImage() data. Rows without an image file are dropped.
function withImages(array $rows, string $directory): array
{
    $result = [];

    foreach ($rows as $row) {
        $image = getImage($directory, $row['image']);

        if ($image !== null) {
            $result[] = ['image' => $image] + $row;
        }
    }

    return $result;
}

/* ---------- Profile and experience ---------- */

// Personal details from MySQL.
function getProfile(): array
{
    return remember('profile', function () {
        $profile = getDatabase()->query('SELECT name, email, socials, identities FROM profile LIMIT 1')->fetch();

        if ($profile === false) {
            throw new RuntimeException('The profile table is empty. Import data/reign.sql in phpMyAdmin.');
        }

        return decodeJsonColumns($profile, 'socials', 'identities');
    });
}

// Work experience from MySQL.
function getExperience(): array
{
    return remember('experience', function () {
        $jobs = getDatabase()->query('SELECT `role`, place, period, isCurrent, points FROM experience ORDER BY sortOrder')->fetchAll();

        return array_map(fn (array $job) => decodeJsonColumns($job, 'points'), $jobs);
    });
}

/* ---------- Projects ---------- */

// Projects whose image file exists, newest (highest id) first. Missing gallery files are skipped.
function getProjects(): array
{
    return remember('projects', function () {
        $rows = getDatabase()
            ->query('SELECT id, image, title, category, `year`, description, gallery, featured, motion FROM projects ORDER BY id DESC')
            ->fetchAll();

        return array_map(function (array $project) {
            $project = decodeJsonColumns($project, 'gallery');
            $images  = array_map(fn ($fileName) => getImage(projectImageDir, $fileName), $project['gallery']);

            $project['gallery'] = array_values(array_filter($images));

            return $project;
        }, withImages($rows, projectImageDir));
    });
}

// Only projects marked 'featured' (homepage showcase).
function getFeaturedProjects(): array
{
    return array_filter(getProjects(), fn (array $project) => $project['featured']);
}

// Unique categories, in the order they first appear.
function getCategories(array $projects): array
{
    return array_values(array_unique(array_column($projects, 'category')));
}

// Find one project by id.
function findProject(int $id): ?array
{
    return array_column(getProjects(), null, 'id')[$id] ?? null;
}

// Previous / next project around an id (null at either end).
function getNeighbors(int $id): array
{
    $projects = getProjects();
    $index    = array_search($id, array_column($projects, 'id'));

    if ($index === false) {
        return ['previous' => null, 'next' => null];
    }

    return [
        'previous' => $projects[$index - 1] ?? null,
        'next'     => $projects[$index + 1] ?? null,
    ];
}

/* ---------- Certificates ---------- */

// Certificates whose image file exists, newest first.
function getCertificates(): array
{
    return remember('certificates', function () {
        $rows = getDatabase()
            ->query('SELECT image, title, issuer, issuedOn, credentialUrl FROM certificates ORDER BY issuedOn DESC, id DESC')
            ->fetchAll();

        return withImages($rows, certificateImageDir);
    });
}
