# সকল বাংলা সংবাদপত্র (All Bangla Newspaper Directory)

PHP + MySQL দিয়ে তৈরি একটি সহজ সংবাদপত্র ডিরেক্টরি ওয়েবসাইট।  
allbanglanewspaper.link স্টাইলের মতো কাজ করে।

## ফিচার

- ক্যাটেগরি অনুসারে ফিল্টার (দৈনিক, অনলাইন, ইংরেজি, আঞ্চলিক, টিভি)
- সার্চ ফাংশন
- রেসপন্সিভ ডিজাইন
- অ্যাডমিন প্যানেল (যোগ / এডিট / ডিলিট)
- ফিচার্ড মার্কিং

## ইনস্টলেশন

### ১. ফাইল আপলোড
পুরো `all-bangla-newspaper` ফোল্ডারটি তোমার হোস্টিং-এর `public_html` বা যেকোনো ডিরেক্টরিতে আপলোড করো।

### ২. ডাটাবেস তৈরি
1. cPanel → phpMyAdmin এ যাও
2. নতুন ডাটাবেস তৈরি করো (নাম: `bangla_newspaper`)
3. `database.sql` ফাইলটি ইমপোর্ট করো

### ৩. কনফিগারেশন
`config.php` ফাইল খুলে নিচের মানগুলো পরিবর্তন করো:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'তোমার_ডাটাবেস_ইউজার');
define('DB_PASS', 'তোমার_ডাটাবেস_পাসওয়ার্ড');
define('DB_NAME', 'bangla_newspaper');

define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'একটা_শক্তিশালী_পাসওয়ার্ড');
```

### ৪. অ্যাডমিন লগইন
- URL: `https://তোমারডোমেইন.com/admin/login.php`
- ডিফল্ট ইউজারনেম: `admin`
- ডিফল্ট পাসওয়ার্ড: `admin123`  
  **লাইভে অবশ্যই পরিবর্তন করবে!**

## ফোল্ডার স্ট্রাকচার

```
all-bangla-newspaper/
├── config.php          → ডাটাবেস ও সাইট সেটিংস
├── index.php           → ফ্রন্টএন্ড হোমপেজ
├── style.css           → স্টাইলশিট
├── database.sql        → ডাটাবেস স্কিমা + স্যাম্পল ডাটা
├── README.md
└── admin/
    ├── login.php
    ├── index.php       → ড্যাশবোর্ড
    ├── add.php
    ├── edit.php
    ├── delete.php
    └── logout.php
```

## লোকাল টেস্ট (XAMPP / WAMP)

1. `all-bangla-newspaper` ফোল্ডারটি `htdocs` এ রাখো
2. MySQL চালু করো
3. phpMyAdmin এ `database.sql` ইমপোর্ট করো
4. ব্রাউজারে যাও: `http://localhost/all-bangla-newspaper`

## পরবর্তী উন্নতি (ঐচ্ছিক)

- পাসওয়ার্ড hashing (password_hash)
- ক্যাটেগরি ম্যানেজমেন্ট (অ্যাডমিন থেকে)
- ইমেজ আপলোড (লোগোর জন্য)
- Pagination
- SEO meta tags আরও উন্নত করা

---
তৈরি করেছে: Grok (xAI)  
প্রশ্ন থাকলে আবার জিজ্ঞাসা করো।
