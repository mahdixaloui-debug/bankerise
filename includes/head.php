<?php
/**
 * Bankerise — Shared <head> Component
 * 
 * Usage:
 *   <?php
 *   $pageTitle = 'Page Title — Bankerise®';
 *   $pageDescription = 'Meta description for this page.';
 *   $isSubfolder = false;           // set true for /partners/ pages
 *   $pageStyles = [];               // extra CSS file paths (relative to root)
 *   include 'includes/head.php';  // or __DIR__ . '/../includes/head.php'
 *   ?>
 *   <!-- optional extra <style> or <script> here -->
 *   </head>
 *
 * Variables:
 *   $pageTitle       (string)  — <title> tag content
 *   $pageDescription (string)  — meta description
 *   $isSubfolder     (bool)    — true if page is inside /partners/
 *   $pageStyles      (array)   — additional CSS files to load
 *   $extraScripts    (string)  — extra <script> tags for <head> (e.g. Chart.js)
 */

$pageTitle       = $pageTitle ?? 'Bankerise®';
$pageDescription = $pageDescription ?? 'Experience Banking beyond Transactions.';
$isSubfolder     = $isSubfolder ?? false;
$pageStyles      = $pageStyles ?? [];
$extraScripts    = $extraScripts ?? '';
$base            = $isSubfolder ? '../' : '';
$assetVersion    = '20260504h';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  
  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="<?= $base ?>assets/images/brand/logo-monogram.svg">

  <!-- Tailwind CSS (CDN — centralized config) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            grape: '#4C4E89',
            'indigo-brand': '#35365F',
            pacific: '#4DB8CD',
            aqua: '#766CFF',
            bell: '#4799D1',
            dark: '#0D0F1C',
            dark2: '#141729',
            dark3: '#1A1D35',
            surface: '#111827',
            card: '#1F2937',
          },
          fontFamily: { montserrat: ['Montserrat', 'sans-serif'] },
        }
      }
    }
  </script>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Shared CSS -->
  <link rel="stylesheet" href="<?= $base ?>assets/css/shared.css?v=<?= $assetVersion ?>">

<?php foreach ($pageStyles as $cssFile): ?>
  <link rel="stylesheet" href="<?= $base . $cssFile ?>?v=<?= $assetVersion ?>">
<?php endforeach; ?>

<?= $extraScripts ?>
<?php if (!empty($_GET['show'])): ?><style id="dev-show-all">
[data-animate]{opacity:1!important;transform:none!important;transition:none!important;}
.retail-hero,.corporate-hero,.micro-hero,.about-hero,.partner-hero,.contact-hero,.use-cases-hero,.product-hero,.academy-hero,.find-hero,.hero-section,[class*="-hero"]:not([class*="-hero-"]){min-height:auto!important;height:auto!important;padding-top:6rem!important;padding-bottom:5rem!important;}
*{animation:none!important;}
</style><?php endif; ?>
