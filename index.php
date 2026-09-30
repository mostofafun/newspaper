<?php
require_once 'config.php';

$db = getDB();

// Get categories
$categories = $db->query("SELECT * FROM categories ORDER BY sort_order ASC")->fetchAll();

// Filter by category
$catSlug = isset($_GET['cat']) ? trim($_GET['cat']) : null;
$search = isset($_GET['q']) ? trim($_GET['q']) : null;

$sql = "SELECT n.*, c.name_bn as category_name, c.slug as category_slug 
        FROM newspapers n 
        JOIN categories c ON n.category_id = c.id 
        WHERE n.is_active = 1";

$params = [];

if ($catSlug && $catSlug !== 'all') {
    $sql .= " AND c.slug = ?";
    $params[] = $catSlug;
}

if ($search) {
    $sql .= " AND n.name LIKE ?";
    $params[] = '%' . $search . '%';
}

$sql .= " ORDER BY n.is_featured DESC, n.sort_order ASC, n.name ASC";

$stmt = $db->prepare($sql);
$stmt->execute($params);
$newspapers = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?> - All Bangla Newspaper Directory</title>
    <meta name="description" content="বাংলাদেশের সব জনপ্রিয় দৈনিক, অনলাইন ও ইংরেজি সংবাদপত্র এক জায়গায় পড়ুন।">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1><?= SITE_NAME ?></h1>
            <p>এক ক্লিকে সব বাংলা সংবাদপত্র</p>
        </div>
    </header>

    <main class="container">
        <!-- Tabs -->
        <div class="tabs">
            <a href="?cat=all" class="tab-btn <?= (!$catSlug || $catSlug === 'all') ? 'active' : '' ?>">সব</a>
            <?php foreach ($categories as $cat): ?>
                <a href="?cat=<?= htmlspecialchars($cat['slug']) ?>" 
                   class="tab-btn <?= ($catSlug === $cat['slug']) ? 'active' : '' ?>">
                    <?= htmlspecialchars($cat['name_bn']) ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Search -->
        <form class="search-box" method="GET" action="">
            <?php if ($catSlug && $catSlug !== 'all'): ?>
                <input type="hidden" name="cat" value="<?= htmlspecialchars($catSlug) ?>">
            <?php endif; ?>
            <input type="text" name="q" placeholder="সংবাদপত্র খুঁজুন..." value="<?= htmlspecialchars($search ?? '') ?>">
            <button type="submit">🔍</button>
        </form>

        <!-- Grid -->
        <?php if (count($newspapers) > 0): ?>
            <div class="grid">
                <?php foreach ($newspapers as $paper): ?>
                    <a href="<?= htmlspecialchars($paper['url']) ?>" target="_blank" rel="noopener" class="card">
                        <div class="logo-box">
                            <?php if (!empty($paper['logo'])): ?>
                                <img src="<?= htmlspecialchars($paper['logo']) ?>" alt="<?= htmlspecialchars($paper['name']) ?>" loading="lazy">
                            <?php else: ?>
                                <div class="logo-placeholder">
                                    <?= mb_substr($paper['name'], 0, 1, 'UTF-8') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <h3><?= htmlspecialchars($paper['name']) ?></h3>
                        <?php if ($paper['is_featured']): ?>
                            <span class="featured-badge">জনপ্রিয়</span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p style="text-align:center; padding: 40px; color:#666;">কোনো সংবাদপত্র পাওয়া যায়নি।</p>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?= date('Y') ?> <?= SITE_NAME ?>. সব অধিকার সংরক্ষিত।</p>
            <p><a href="admin/login.php">অ্যাডমিন লগইন</a></p>
        </div>
    </footer>
</body>
</html>
