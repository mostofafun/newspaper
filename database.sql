-- বাংলা সংবাদপত্র ডিরেক্টরি ডাটাবেস
-- phpMyAdmin বা MySQL CLI-তে এই ফাইলটি ইমপোর্ট করো

CREATE DATABASE IF NOT EXISTS bangla_newspaper CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bangla_newspaper;

-- ক্যাটেগরি টেবিল
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_bn VARCHAR(100) NOT NULL,
    name_en VARCHAR(100) NOT NULL,
    slug VARCHAR(50) NOT NULL UNIQUE,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- সংবাদপত্র টেবিল
CREATE TABLE IF NOT EXISTS newspapers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    url VARCHAR(500) NOT NULL,
    logo VARCHAR(500) DEFAULT NULL,
    category_id INT NOT NULL,
    is_featured TINYINT(1) DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- স্যাম্পল ক্যাটেগরি
INSERT INTO categories (name_bn, name_en, slug, sort_order) VALUES
('দৈনিক', 'Daily', 'daily', 1),
('অনলাইন', 'Online', 'online', 2),
('ইংরেজি', 'English', 'english', 3),
('আঞ্চলিক', 'Regional', 'regional', 4),
('টিভি চ্যানেল', 'TV Channel', 'tv', 5);

-- স্যাম্পল সংবাদপত্র (লোগো লিংকগুলো উদাহরণ — প্রয়োজনমতো আপডেট করো)
INSERT INTO newspapers (name, url, logo, category_id, is_featured, sort_order) VALUES
('প্রথম আলো', 'https://www.prothomalo.com/', 'https://images.prothomalo.com/prothomalo/2023-12/8c7c8c8c-8c8c-8c8c-8c8c-8c8c8c8c8c8c/prothomalo-logo.png', 1, 1, 1),
('কালের কণ্ঠ', 'https://www.kalerkantho.com/', NULL, 1, 1, 2),
('যুগান্তর', 'https://www.jugantor.com/', NULL, 1, 1, 3),
('ইত্তেফাক', 'https://www.ittefaq.com.bd/', NULL, 1, 0, 4),
('সমকাল', 'https://samakal.com/', NULL, 1, 0, 5),
('বাংলাদেশ প্রতিদিন', 'https://www.bd-pratidin.com/', NULL, 1, 1, 6),
('আমাদের সময়', 'https://www.amadershomoy.com/', NULL, 1, 0, 7),
('নয়া দিগন্ত', 'https://www.dailynayadiganta.com/', NULL, 1, 0, 8),
('জাগো নিউজ', 'https://www.jagonews24.com/', NULL, 2, 1, 1),
('বিডিনিউজ২৪', 'https://bangla.bdnews24.com/', NULL, 2, 1, 2),
('বাংলা ট্রিবিউন', 'https://www.banglatribune.com/', NULL, 2, 0, 3),
('ধর্মীয় টিভি / অন্যান্য', 'https://www.somoynews.tv/', NULL, 2, 0, 4),
('দ্য ডেইলি স্টার', 'https://www.thedailystar.net/', NULL, 3, 1, 1),
('দ্য ফাইন্যান্সিয়াল এক্সপ্রেস', 'https://thefinancialexpress.com.bd/', NULL, 3, 0, 2),
('নিউ এজ', 'https://www.newagebd.net/', NULL, 3, 0, 3),
('রাজশাহী নিউজ', 'https://www.rajshahinews24.com/', NULL, 4, 0, 1),
('চট্টগ্রাম নিউজ', 'https://www.ctgnews.com/', NULL, 4, 0, 2),
('সময় টিভি', 'https://www.somoynews.tv/', NULL, 5, 1, 1),
('একাত্তর টিভি', 'https://www.ekattor.tv/', NULL, 5, 0, 2),
('চ্যানেল আই', 'https://www.channelionline.com/', NULL, 5, 0, 3);
