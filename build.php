<?php
/**
 * Bankerise Static Site Builder
 * 
 * Run this on your local XAMPP to convert all PHP pages to static HTML.
 * Usage: Open http://localhost/build.php in your browser
 */

set_time_limit(120);

$sourceDir = __DIR__;
$outputDir = __DIR__ . '/dist';

// Pages to convert: [source_path => output_path]
$pages = [
    '/' => '/index.html',
    '/product.php' => '/product.html',
    '/about.php' => '/about.html',
    '/contact.php' => '/contact.html',
    '/partners.php' => '/partners.html',
    '/academy.php' => '/academy.html',
    '/use-cases.php' => '/use-cases.html',
    '/use-cases/' => '/use-cases/index.html',
    '/solutions/retail.php' => '/solutions/retail.html',
    '/solutions/corporate.php' => '/solutions/corporate.html',
    '/solutions/micro.php' => '/solutions/micro.html',
    '/partners/apply.php' => '/partners/apply.html',
    '/privacy.php' => '/privacy.html',
    '/terms.php' => '/terms.html',
    '__placeholder_partner_login' => '/partners/login.html',
];

// Placeholder pages: server-only flows replaced with a graceful static page.
function renderPartnerLoginPlaceholder() {
    return <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Partner Area — Bankerise®</title>
  <link rel="icon" type="image/svg+xml" href="../assets/images/brand/logo-monogram.svg">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { theme: { extend: { colors: {
      pacific: '#4DB8CD', aqua: '#766CFF', dark: '#0D0F1C', dark2: '#141729'
    }, fontFamily: { montserrat: ['Montserrat','sans-serif'] } } } }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Montserrat', sans-serif; background: #0D0F1C; color: #fff; min-height: 100vh; display:flex; align-items:center; justify-content:center; padding: 2rem; }
    .card {
      max-width: 560px; width: 100%; padding: 3rem 2.25rem; border-radius: 1.5rem; text-align: center;
      background: linear-gradient(180deg, rgba(20,23,41,.9), rgba(13,15,28,.9));
      border: 1px solid rgba(255,255,255,.08);
      box-shadow: 0 30px 80px -20px rgba(0,0,0,.6), 0 0 0 1px rgba(77,184,205,.1);
    }
    .icon-wrap { width:72px; height:72px; margin:0 auto 1.5rem; border-radius:1rem; display:flex; align-items:center; justify-content:center; background: rgba(77,184,205,.12); color:#4DB8CD; }
    h1 { font-size: 1.875rem; font-weight: 800; margin-bottom: .75rem; }
    p { color: #9CA3AF; line-height: 1.65; margin-bottom: 2rem; }
    .btn-row { display:flex; flex-wrap:wrap; gap:.75rem; justify-content:center; }
    .btn { display:inline-flex; align-items:center; gap:.5rem; padding:.85rem 1.5rem; border-radius:9999px; font-weight:600; font-size:.95rem; transition:all .25s ease; }
    .btn-primary { background: linear-gradient(135deg, #4DB8CD, #766CFF); color:#fff; }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 30px -10px rgba(77,184,205,.5); }
    .btn-ghost { border:1px solid rgba(77,184,205,.4); color:#4DB8CD; }
    .btn-ghost:hover { background: rgba(77,184,205,.1); }
    .home-link { display:inline-block; margin-top:2rem; color:#6B7280; font-size:.875rem; }
    .home-link:hover { color:#4DB8CD; }
  </style>
</head>
<body>
  <main class="card">
    <div class="icon-wrap">
      <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.657-1.343-3-3-3s-3 1.343-3 3 1.343 3 3 3 3-1.343 3-3zm0 0V7a4 4 0 118 0v4M5 11h14a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2z"/>
      </svg>
    </div>
    <h1>Partner Backoffice</h1>
    <p>The Bankerise Partner Backoffice is a live application hosted in our secured environment. To request credentials or learn more about partnership opportunities, get in touch with our team.</p>
    <div class="btn-row">
      <a href="apply.html" class="btn btn-primary">
        Apply Now
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
      </a>
      <a href="../contact.html" class="btn btn-ghost">Contact Sales</a>
    </div>
    <a href="../index.html" class="home-link">&larr; Back to Bankerise.com</a>
  </main>
</body>
</html>
HTML;
}

// Create output directory
if (!is_dir($outputDir)) mkdir($outputDir, 0755, true);

// Asset directories to copy
$assetDirs = ['assets'];
$assetFiles = ['.htaccess'];

echo "<html><body style='background:#0d0f1a;color:#fff;font-family:monospace;padding:2rem'>";
echo "<h1 style='color:#4DB8CD'>Bankerise Static Build</h1>";
echo "<hr style='border-color:#333'>";

// 1. Fetch and save each page
$baseUrl = getenv('BUILD_BASE_URL') ?: 'http://localhost/bankerise';
$successCount = 0;
$errorCount = 0;

foreach ($pages as $source => $dest) {
    $outputPath = $outputDir . $dest;

    // Create directory if needed
    $dir = dirname($outputPath);
    if (!is_dir($dir)) mkdir($dir, 0755, true);

    // Branch: synthetic placeholder pages (no PHP source to fetch)
    if (strpos($source, '__placeholder_') === 0) {
        if ($source === '__placeholder_partner_login') {
            file_put_contents($outputPath, renderPartnerLoginPlaceholder());
            echo "<p style='color:#4DB8CD'>✅ Built (placeholder): $dest</p>";
            $successCount++;
        }
        continue;
    }

    $url = $baseUrl . $source;

    // Fetch the rendered page
    $context = stream_context_create(['http' => ['timeout' => 30]]);
    $html = @file_get_contents($url, false, $context);

    if ($html === false) {
        echo "<p style='color:#ff6b6b'>❌ FAILED: $url</p>";
        $errorCount++;
        continue;
    }

    // Fix links: .php -> .html
    $html = preg_replace('/href="([^"]*?)\.php([#"])/i', 'href="$1.html$2', $html);
    $html = preg_replace('/href="([^"]*?)\.php(\?)/i', 'href="$1.html$2', $html);

    // Redirect server-only partner flows to the static placeholder (login.html)
    $html = preg_replace(
        '#href="([^"]*?)partners/(dashboard|backoffice|find)\.html#i',
        'href="$1partners/login.html',
        $html
    );

    // Fix index references
    $html = str_replace('index.html"', '"', $html); // Clean up index.html to just /

    // Write file
    file_put_contents($outputPath, $html);
    echo "<p style='color:#4DB8CD'>✅ Built: $dest</p>";
    $successCount++;
}

echo "<hr style='border-color:#333'>";

// 2. Copy assets
function copyDir($src, $dst) {
    $count = 0;
    if (!is_dir($dst)) mkdir($dst, 0755, true);
    $dir = opendir($src);
    while (($file = readdir($dir)) !== false) {
        if ($file === '.' || $file === '..') continue;
        $srcPath = $src . '/' . $file;
        $dstPath = $dst . '/' . $file;
        if (is_dir($srcPath)) {
            $count += copyDir($srcPath, $dstPath);
        } else {
            copy($srcPath, $dstPath);
            $count++;
        }
    }
    closedir($dir);
    return $count;
}

foreach ($assetDirs as $assetDir) {
    $src = $sourceDir . '/' . $assetDir;
    $dst = $outputDir . '/' . $assetDir;
    if (is_dir($src)) {
        $count = copyDir($src, $dst);
        echo "<p style='color:#4DB8CD'>📁 Copied: $assetDir/ ($count files)</p>";
    }
}

// 3. Copy includes that might be needed (images referenced relatively)
echo "<hr style='border-color:#333'>";
echo "<h2 style='color:#4DB8CD'>Build Complete!</h2>";
echo "<p>✅ Pages built: $successCount</p>";
if ($errorCount > 0) echo "<p style='color:#ff6b6b'>❌ Errors: $errorCount</p>";
echo "<p style='margin-top:1rem'><strong>Output folder:</strong> <code style='background:#1a1c2e;padding:4px 8px;border-radius:4px'>$outputDir</code></p>";
echo "<p style='color:#888;margin-top:2rem'>Upload the contents of the <code>dist/</code> folder to GitHub.</p>";
echo "</body></html>";
