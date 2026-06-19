<?php
/**
 * Site metadata container for generating brief description text.
 *
 * Data structure based on associative arrays. No external dependencies.
 */

/**
 * Retrieve a predefined list of site metadata entries.
 *
 * Each entry contains:
 * - locale: language / region identifier
 * - title: site title
 * - keywords: array of relevant terms
 * - url: site URL
 *
 * @return array
 */
function getSiteMetaCollection(): array
{
    return [
        [
            'locale'   => 'zh_CN',
            'title'    => '百家乐指南',
            'keywords' => ['百家乐', '玩法', '策略'],
            'url'      => 'https://cns-baccarat.com',
        ],
        [
            'locale'   => 'en_US',
            'title'    => 'Baccarat Guide',
            'keywords' => ['baccarat', 'rules', 'strategy'],
            'url'      => 'https://cns-baccarat.com/en',
        ],
        [
            'locale'   => 'zh_TW',
            'title'    => '百家樂入門',
            'keywords' => ['百家樂', '規則', '技巧'],
            'url'      => 'https://cns-baccarat.com/tw',
        ],
    ];
}

/**
 * Generate a short description text from a given site meta array.
 *
 * Description format: "Site: {title} | Keywords: {keyword1}, {keyword2}… | {url}"
 *
 * @param array $meta Associative array with keys: title, keywords, url
 * @return string Plain text description (safe for output)
 */
function generateDescriptionText(array $meta): string
{
    $title    = $meta['title'] ?? '';
    $keywords = isset($meta['keywords']) && is_array($meta['keywords'])
        ? implode(', ', $meta['keywords'])
        : '';
    $url      = $meta['url'] ?? '';

    // Basic HTML-safe concatenation, suitable for plain text context
    $parts = [];
    if ($title !== '') {
        $parts[] = 'Site: ' . $title;
    }
    if ($keywords !== '') {
        $parts[] = 'Keywords: ' . $keywords;
    }
    if ($url !== '') {
        $parts[] = $url;
    }

    return implode(' | ', $parts);
}

/**
 * Render all site descriptions as an HTML <ul> list.
 *
 * This function is safe for inclusion in a web page; it escapes output.
 *
 * @param array $metaCollection Array of meta arrays
 * @return string HTML string
 */
function renderDescriptionList(array $metaCollection): string
{
    $items = '';
    foreach ($metaCollection as $meta) {
        $desc = htmlspecialchars(generateDescriptionText($meta), ENT_QUOTES, 'UTF-8');
        $items .= '<li>' . $desc . '</li>';
    }
    return '<ul>' . $items . '</ul>';
}

// --- Example usage (not executed when included) ---

if (defined('STDIN') || php_sapi_name() === 'cli') {
    $metas = getSiteMetaCollection();
    echo "Site meta descriptions:\n";
    foreach ($metas as $meta) {
        echo ' - ' . generateDescriptionText($meta) . "\n";
    }
    echo "\nHTML version:\n";
    echo renderDescriptionList($metas) . "\n";
}