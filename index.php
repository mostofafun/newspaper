<?php
// newspapers.php নামে আলাদা ফাইলেও রাখতে পারো
$newspapers = [
    [
        "name" => "প্রথম আলো",
        "url" => "https://www.prothomalo.com/",
        "logo" => "https://www.prothomalo.com/assets/img/logo.png", // আসল লোগো লিংক
        "category" => "daily"
    ],
    [
        "name" => "দ্য ডেইলি স্টার",
        "url" => "https://www.thedailystar.net/",
        "logo" => "https://www.thedailystar.net/sites/all/themes/ts/images/logo.png",
        "category" => "english"
    ],
    [
        "name" => "জুগান্তর",
        "url" => "https://www.jugantor.com/",
        "logo" => "https://www.jugantor.com/assets/img/logo.png",
        "category" => "daily"
    ],
    // আরও অনেক যোগ করো...
];

function getNewspapers($papers, $cat = null) {
    if ($cat) {
        return array_filter($papers, fn($p) => $p['category'] === $cat);
    }
    return $papers;
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>সকল বাংলা সংবাদপত্র - All Bangla Newspaper</title>
    <style>
        body { font-family: 'SolaimanLipi', Arial, sans-serif; margin: 0; background: #f4f4f4; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        h1 { text-align: center; color: #d32f2f; }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
        }
        .card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        .card:hover { transform: translateY(-5px); }
        .card img { max-width: 100%; height: 60px; object-fit: contain; }
        .card h3 { margin: 10px 0 5px; font-size: 1.1em; }
        a { text-decoration: none; color: inherit; }
        .tabs { text-align: center; margin: 20px 0; }
        .tab-btn {
            padding: 10px 20px; margin: 5px; border: none; background: #ddd; cursor: pointer; border-radius: 5px;
        }
        .tab-btn.active { background: #d32f2f; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>সকল বাংলা সংবাদপত্র</h1>
        <p style="text-align:center;">এক জায়গায় সব বাংলাদেশী খবরের কাগজ ও অনলাইন পোর্টাল</p>

        <div class="tabs">
            <button class="tab-btn active" onclick="filterCategory('all')">সব</button>
            <button class="tab-btn" onclick="filterCategory('daily')">দৈনিক</button>
            <button class="tab-btn" onclick="filterCategory('online')">অনলাইন</button>
            <button class="tab-btn" onclick="filterCategory('english')">ইংরেজি</button>
        </div>

        <div class="grid" id="newsGrid">
            <?php foreach(getNewspapers($newspapers) as $paper): ?>
                <a href="https://www.prothomalo.com" target="_blank">
                    <div class="card">
                        <img src="https://media.prothomalo.com/prothomalo-bangla/2025-11-17/qix5skks/palo-bangla.svg" alt="<?= htmlspecialchars($paper['Prothom alo']) ?>">
                        <h3><?= htmlspecialchars($paper['name']) ?></h3>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function filterCategory(cat) {
            // সিম্পল জাভাস্ক্রিপ্ট ফিল্টার (পরে আরও উন্নত করতে পারবে)
            window.location.reload(); // এখন শুধু রিলোড, পরে AJAX করে ডাইনামিক করো
        }
    </script>
</body>
</html>