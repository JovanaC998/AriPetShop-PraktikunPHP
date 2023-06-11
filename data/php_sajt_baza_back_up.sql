-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 08:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_sajt_baza_back_up`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `id` int(11) NOT NULL,
  `pitanje` varchar(100) NOT NULL,
  `aktivna` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`id`, `pitanje`, `aktivna`) VALUES
(1, 'How do You like our products?', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `autor`
--

CREATE TABLE `autor` (
  `id` int(11) NOT NULL,
  `slika` varchar(100) NOT NULL,
  `ime_prezime` varchar(50) NOT NULL,
  `indeks` varchar(12) NOT NULL,
  `href` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `autor`
--

INSERT INTO `autor` (`id`, `slika`, `ime_prezime`, `indeks`, `href`) VALUES
(1, 'img/author.jpg', 'Jovana Ćirić', '110/21', 'https://jovanac998.github.io/Portfolio/');

-- --------------------------------------------------------

--
-- Table structure for table `informacija`
--

CREATE TABLE `informacija` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL,
  `putanja` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `informacija`
--

INSERT INTO `informacija` (`id`, `naziv`, `putanja`) VALUES
(1, 'files', 'data/information/Dokumentacija.pdf'),
(2, 'diagram-2-fill', 'data/information/sitemap.xml'),
(3, 'instagram', 'https://www.instagram.com/'),
(4, 'facebook', 'https://www.facebook.com/');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`id`, `naziv`) VALUES
(1, 'Food'),
(2, 'Toys'),
(3, 'Bowls'),
(4, 'Collars');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `lozinka` varchar(100) NOT NULL,
  `datum_registracije` datetime NOT NULL,
  `token` varchar(255) NOT NULL,
  `verifikovan` int(1) NOT NULL DEFAULT 0,
  `id_uloga` int(11) NOT NULL,
  `blokiran` tinyint(1) NOT NULL DEFAULT 0,
  `vreme_logovanja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `email`, `lozinka`, `datum_registracije`, `token`, `verifikovan`, `id_uloga`, `blokiran`, `vreme_logovanja`) VALUES
(78, 'Morgan', 'Freeman', 'admin123@gmail.com', 'e714f5e09b26f37bb36f63f24789a3b5', '2023-03-16 21:14:54', '06fae929dfc89577b330a11e81e11b38d768781f5a81a00acc2f0e8b8c6cb32a', 1, 2, 0, '2023-06-04 20:03:52'),
(79, 'Stephan', 'King', 'user123@gmail.com', '04fd0ecf0d3215802ef4edff60626c24', '2023-03-16 21:15:31', '4f0cbd7dd53ffd0bf03dee96e895f01c364624cf03a21c11421dba293d4bb03f', 1, 1, 0, '2023-06-04 20:03:42'),
(80, 'Harry', 'Potter', 'harry80@gmail.com', '862d9be41adf4939dcb426fc72e7620c', '2023-03-16 21:16:50', '2d5071de8a238223323d3f54c17bce8527fe49867b8c51c763e264c2b9c42b48', 1, 1, 0, NULL),
(82, 'James', 'Bond', 'james007@gmail.com', '95f2831f52eff1aa83287c2817256f8a', '2023-03-16 21:39:15', 'c48e29c291d6ec07ce4df2595415239667c81d2a38bef64006b19ee74eecf7d9', 0, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_odgovor`
--

CREATE TABLE `korisnik_odgovor` (
  `id_korisnika` int(11) NOT NULL,
  `id_odgovora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik_odgovor`
--

INSERT INTO `korisnik_odgovor` (`id_korisnika`, `id_odgovora`) VALUES
(78, 5),
(79, 5);

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

CREATE TABLE `korpa` (
  `id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `proizvod_id` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korpa`
--

INSERT INTO `korpa` (`id`, `korisnik_id`, `proizvod_id`, `kolicina`) VALUES
(1, 78, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL,
  `href` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`id`, `naziv`, `href`) VALUES
(1, 'Home', 'index'),
(2, 'Services', 'service'),
(3, 'Products', 'product');

-- --------------------------------------------------------

--
-- Table structure for table `odgovor`
--

CREATE TABLE `odgovor` (
  `id` int(11) NOT NULL,
  `odg` varchar(50) NOT NULL,
  `id_anketa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `odgovor`
--

INSERT INTO `odgovor` (`id`, `odg`, `id_anketa`) VALUES
(1, 'Very bad', 1),
(2, 'Bad', 1),
(3, 'Good', 1),
(4, 'Very good', 1),
(5, 'Excellent', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `naziv`, `href`) VALUES
(1, 'Pricing Plan', 'price'),
(3, 'About Author', 'about');

-- --------------------------------------------------------

--
-- Table structure for table `poruka`
--

CREATE TABLE `poruka` (
  `id` int(11) NOT NULL,
  `ime_prezime` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telefon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tekst_poruke` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `datum_poruke` datetime NOT NULL,
  `id_tip` int(11) NOT NULL,
  `id_korisnik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poruka`
--

INSERT INTO `poruka` (`id`, `ime_prezime`, `email`, `telefon`, `tekst_poruke`, `datum_poruke`, `id_tip`, `id_korisnik`) VALUES
(7, 'James Bond', 'james007@gmail.com', '0612345678', 'My name is Bond. James Bond.', '2023-03-16 21:40:56', 1, 82),
(8, 'Jovana Ćirić', 'jovanaciric701@gmail.com', '0616363269', 'test', '2023-06-04 02:09:42', 1, 78),
(9, 'Jovana Ćirić', 'jovanaciric701@gmail.com', '0616363269', 'blokiran mi je nalog', '2023-06-04 14:19:44', 1, 78);

-- --------------------------------------------------------

--
-- Table structure for table `price_plan`
--

CREATE TABLE `price_plan` (
  `id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price_plan`
--

INSERT INTO `price_plan` (`id`, `title`, `subtitle`, `price`) VALUES
(1, 'BASIC', 'The Affordable Choice', 49),
(2, 'STANDARD', 'The Best Choice', 99),
(3, 'EXTENDED', 'All Inclusive', 149);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL,
  `slika` varchar(100) NOT NULL,
  `alt` varchar(50) NOT NULL,
  `cena` decimal(50,2) NOT NULL,
  `prethodna_cena` decimal(50,2) DEFAULT NULL,
  `istaknut` bit(1) NOT NULL,
  `opis` varchar(20000) NOT NULL,
  `id_kategorija` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `naziv`, `slika`, `alt`, `cena`, `prethodna_cena`, `istaknut`, `opis`, `id_kategorija`) VALUES
(1, 'Bowl-B&W', 'img/allProducts/bowl.jpg', 'Slika 1', '34.99', NULL, b'0', 'Introducing the Pet Bowl-B&W, the stylish and practical solution for pet owners who want to give their furry friends the best. The unique black and white design adds a touch of elegance. The non-slip base ensures that the bowl stays in place  even during mealtime excitement, while the generous size allows for ample servings for pets of all sizes. Plus, it\'s easy to clean and dishwasher safe for hassle-free maintenance. This bowl is the perfect way to add some personality to your pet\'s dining experience while still providing a practical and functional feeding solution. Upgrade your pet\'s dining experience with stylish and functional Pet Bowl-B&W!', 3),
(2, 'Bowl For Food and Wather', 'img/allProducts/bowl-2.jpg', 'Slika 2', '49.99', NULL, b'0', 'Introducing the Bowl For Food and Water, the perfect solution for pet owners who want to keep their furry friends fed and hydrated in style. Made with high-quality, food-grade materials, this bowl is perfect for both food and water. The dual-compartment design allows for convenient and space-saving storage, while the non-slip base ensures that it stays in place even during mealtime excitement. The generous size of the bowl allows for ample servings, making it perfect for all types of pets, from small cats to large dogs. Plus, it\'s easy to clean and dishwasher safe for hassle-free maintenance. ', 3),
(3, 'Bowl For Food', 'img/allProducts/bowl-3.jpg', 'Slika 3', '54.99', NULL, b'0', 'Introducing the Bowl For Food for dog, the perfect solution for pet owners who want to keep their furry friends fed in style. Made with high-quality, food-grade materials, this bowl is specifically designed for dogs and perfect for serving their favorite meals. The bowl\'s durable and sturdy construction ensures that it can withstand the most excited eaters, while the non-slip base prevents spills and slips. The generous size of the bowl allows for ample servings, making it perfect for all types of dogs, from small breeds to large ones. Plus, it\'s easy to clean and dishwasher safe for hassle-free maintenance. Upgrade your dog\'s dining experience with the Bowl For Food for dog and give them the gift of style and functionality in one!', 3),
(4, 'Bowl With Ears', 'img/allProducts/bowl-4.jpg', 'Slika 4', '49.99', NULL, b'0', 'Make mealtime more playful with the Bowl With Ears for cats. This whimsical cat bowl is designed with high-quality, food-grade materials that are safe and durable. The unique design features two cute, pointy ears that add a touch of fun to your cat\'s feeding routine. The bowl\'s generous size is perfect for serving your feline friend\'s favorite meals, and the non-slip base ensures that it stays in place during mealtime excitement. Plus, it\'s easy to clean and dishwasher safe for hassle-free maintenance. The Bowl With Ears is the perfect way to add some personality to your cat\'s dining experience while still providing a practical and functional feeding solution.', 3),
(5, 'Bowl-Blue', 'img/allProducts/bowl-5.jpg', 'Slika 5', '49.99', NULL, b'0', 'Introducing the Blue Bowl for Dogs, the perfect blend of style and functionality. Made with high-quality, food-grade materials, this bowl is perfect for serving food and water to your furry friend. The blue color adds a touch of personality to your home decor, while the durable construction ensures that it can withstand everyday use. The bowl\'s non-slip base prevents it from sliding around during mealtime, while the generous size allows for ample servings, making it perfect for dogs of all sizes. Additionally, the bowl\'s smooth surface is easy to clean and dishwasher safe for hassle-free maintenance. Whether you\'re looking for a practical feeding solution or a stylish addition to your home, the Blue Bowl has got you covered.', 3),
(6, 'Bird Food', 'img/allProducts/birdFood.jpg', 'Slika 6', '25.99', NULL, b'0', 'Treat your feathered friends to a delicious and nutritious meal with our high-quality Bird Food. Made from premium seeds and grains, our bird food is specially formulated to provide your birds with the essential nutrients they need for a healthy and happy life. Our blend is carefully crafted to attract a variety of birds, from finches and sparrows to blue jays and cardinals. The food is easy to serve and can be used in feeders or scattered on the ground for ground-feeding birds. Our bird food is free from any harmful additives, ensuring that your birds get only the best. Give your birds the nourishment they deserve with our delicious and nutritious Bird Food.', 1),
(7, 'Wet Cat Food', 'img/allProducts/catFood.jpg', 'Slika 7', '35.99', NULL, b'0', 'Indulge your cat\'s taste buds with our high-quality Wet Cat Food. Made with real meat, poultry or fish, our wet cat food is specially formulated to provide your feline friend with all the essential nutrients they need for a healthy and happy life. Our delicious and nutritious recipe is available in a variety of flavors and textures, from tender pâtés to savory chunks in gravy, ensuring your cat will find a flavor they love. Our wet cat food is easy to serve, making mealtime hassle-free, and comes in convenient individual portions to ensure freshness and portion control. Our cat food is made with premium ingredients and free from any harmful additives, ensuring that your cat gets only the best. Treat your cat to the taste they crave and the nutrition they need with our delicious Wet Cat Food.', 1),
(8, 'Cat Snack', 'img/allProducts/catFood-2.jpg', 'Slika 8', '10.99', NULL, b'0', 'Treat your cat to a delicious and healthy snack with our premium Cat Snack. Made with real meat, poultry, or fish, our cat snacks are specially formulated to provide your feline friend with the essential nutrients they need for a healthy and happy life. Our snacks are available in a variety of flavors and textures, from soft and chewy treats to crunchy bites, ensuring your cat will find a flavor they love. Our cat snacks are easy to serve and come in convenient packaging, making them perfect for on-the-go or as a quick treat between meals. Our snacks are made with premium ingredients and free from any harmful additives, ensuring that your cat gets only the best. Treat your cat to the taste they crave and the nutrition they need with our delicious Cat Snack.', 1),
(9, 'Wet Dog Food', 'img/allProducts/dogFood.jpg', 'Slika 9', '5.99', NULL, b'0', 'Give your furry friend a delicious and nutritious meal with our high-quality Wet Dog Food. Made with real meat, poultry or fish, our wet dog food is specially formulated to provide your dog with all the essential nutrients they need for a healthy and happy life. Our delicious and nutritious recipe is available in a variety of flavors and textures, from tender pâtés to savory chunks in gravy, ensuring your dog will find a flavor they love. Our wet dog food is easy to serve, making mealtime hassle-free, and comes in convenient individual portions to ensure freshness and portion control. Our dog food is made with premium ingredients and free from any harmful additives, ensuring that your dog gets only the best. Our wet dog food is perfect for dogs of all sizes and ages, from puppies to seniors. ', 1),
(10, 'Dry Dog Food', 'img/allProducts/dogFood-2.jpg', 'Slika 10', '59.99', NULL, b'0', 'Dry Dog Food made with real meat, poultry or fish, our dry dog food is specially formulated to provide your dog with all the essential nutrients they need for a healthy and happy life. Our delicious and nutritious recipe is available in a variety of flavors and textures, from crunchy kibble to tender bites, ensuring your dog will find a flavor they love. Our dry dog food is easy to serve and comes in convenient packaging, making it perfect for busy pet owners. Our dog food is made with premium ingredients and free from any harmful additives, ensuring that your dog gets only the best. Our dry dog food is perfect for dogs of all sizes and ages, from puppies to seniors. Additionally, our dry dog food helps to promote healthy digestion and maintain a healthy weight.', 1),
(11, 'Fluffy Dog Toy', 'img/allProducts/dogToy.jpg', 'Slika 11', '45.99', NULL, b'0', 'Give your furry friend a soft and cuddly companion with our Fluffy Dog Toy. Made with premium quality materials, our dog toy is designed to provide endless hours of playtime and entertainment for your dog. Its soft and fluffy texture makes it easy to hold, carry and cuddle, while its bright and colorful design makes it a fun and attractive addition to your dog\'s toy collection. Our dog toy is also durable and easy to clean, ensuring that it will last for a long time and remain hygienic for your pet. Our Fluffy Dog Toy is perfect for dogs of all sizes and ages, providing them with comfort and companionship when you are not around. ', 2),
(12, 'Dog Chewing Toy', 'img/allProducts/dogToy-2.jpg', 'Slika 12', '25.99', NULL, b'0', 'Keep your furry friend\'s teeth and gums healthy while satisfying their natural chewing instincts with our durable Dog Chewing Toy. Made with high-quality and non-toxic materials, our chewing toy is designed to withstand tough chewing and is safe for your pet to play with. The unique design and texture of the toy provide an excellent chewing experience, promoting healthy teeth and gums while reducing destructive chewing behavior. Our dog chewing toy is also easy to clean and maintain, ensuring that it remains hygienic for your pet to use. Our dog chewing toy is perfect for dogs of all sizes and ages, providing them with a safe and enjoyable way to relieve stress, anxiety, and boredom.', 2),
(13, 'Happy Birthay Toy', 'img/allProducts/dogToy-3.jpg', 'Slika 13', '30.99', NULL, b'0', 'Celebrate your furry friend\'s birthday in style with our Happy Birthday Toy for dogs! Made with high-quality materials, our dog toy is designed to provide endless hours of playtime and entertainment for your pet. The toy features a fun and colorful design, complete with birthday-themed decorations and a squeaker inside, adding to the excitement and fun of playtime. Our Happy Birthday Toy is also durable and easy to clean, ensuring that it will last for many birthdays to come. This toy is perfect for dogs of all sizes and ages, adding to the fun and excitement of their special day.', 2),
(14, 'Feather Cat Toy', 'img/allProducts/catToy.jpg', 'Slika 14', '15.99', NULL, b'0', 'Keep your furry feline friend entertained for hours with our Feather Cat Toy. Made with high-quality materials, our cat toy is designed to provide endless fun and excitement for your pet. The toy features a feather design, which mimics the natural movements of birds, providing an engaging and stimulating experience for your cat. The toy is also lightweight and easy to carry, allowing your cat to play and pounce around the house with ease. Our Feather Cat Toy is also safe and non-toxic, ensuring that it is suitable for cats of all ages and sizes. The toy is easy to clean and maintain, ensuring that it remains hygienic for your pet to use. ', 2),
(15, 'Natural Catnip Toy', 'img/allProducts/catToy-2.jpg', 'Slika 15', '45.99', NULL, b'0', 'Entertain your furry feline friend with our Natural Catnip Toy. Made with high-quality and non-toxic materials, our catnip toy is designed to provide endless hours of fun and entertainment for your cat. The toy features a natural catnip filling, which is irresistible to cats, providing a playful and stimulating experience for your pet. Our catnip toy is also durable and easy to clean, ensuring that it will last for a long time and remain hygienic for your pet. The toy is also lightweight and easy to carry, allowing your cat to play and pounce around the house with ease. Our Natural Catnip Toy is perfect for cats of all ages and sizes, providing them with a safe and enjoyable way to relieve stress, anxiety, and boredom.', 2),
(16, 'Cat Skateboard', 'img/allProducts/catToy-3.jpg', 'Slika 16', '60.99', NULL, b'0', 'Introduce your furry feline friend to the exciting world of skateboarding with our Cat Skateboard. Made with high-quality and non-toxic materials, our skateboard is designed to provide a safe and fun experience for your pet. The skateboard features a compact and lightweight design, perfect for cats of all sizes and ages. The skateboard is also durable and easy to clean, ensuring that it will last for many hours of playtime. Our Cat Skateboard is easy to use and comes with a non-slip surface, providing a secure and stable platform for your cat to play and practice their skateboarding skills. The skateboard is also portable and easy to store, making it perfect for both indoor and outdoor play. ', 2),
(17, 'Cat Collar-Black', 'img/allProducts/catCollar.jpg', 'Slika 17', '30.99', NULL, b'0', 'Our Black Cat Collar is the perfect accessory for your furry feline friend. Made with high-quality and durable materials, our cat collar is designed to provide comfort and style for your pet. The collar features a sleek and modern design, with an adjustable buckle that allows you to customize the fit to your cat\'s neck size. The collar is also lightweight and comfortable, ensuring that your cat can wear it all day without any discomfort or irritation. Our Black Cat Collar is easy to use and comes with a detachable bell, which not only adds to the style of the collar but also alerts you when your cat is nearby. The collar is also easy to clean and maintain, ensuring that it remains hygienic and in good condition for your pet to use. ', 4),
(18, 'Dog Collar-White', 'img/allProducts/dogCollar.jpg', 'Slika 18', '20.99', NULL, b'0', 'Our White Dog Collar is made with high-quality and durable materials, our dog collar is designed to provide comfort and style for your pet. The collar features a classic and elegant design, with an adjustable buckle that allows you to customize the fit to your dog\'s neck size. The collar is also lightweight and comfortable, ensuring that your dog can wear it all day without any discomfort or irritation. Our White Dog Collar is easy to use and comes with a sturdy D-ring, which is perfect for attaching a leash or ID tag. Our White Dog Collar is perfect for pet owners who want to keep their furry canine friend safe and stylish while they explore the outdoors. Give your dog a classic and elegant accessory with our White Dog Collar.', 4),
(19, 'Dog Collar-Red', 'img/allProducts/dogCollar-2.jpg', 'Slika 19', '30.99', NULL, b'0', 'Our Red Dog Collar is the ultimate fashion accessory for your furry friend. Made with premium quality materials, this collar is built to last and provide maximum comfort to your pup. The collar features a bold and vibrant red color that is sure to turn heads and make your dog stand out from the crowd. It is fully adjustable, so you can ensure the perfect fit for your dog\'s neck size, and comes with a sturdy D-ring that makes it easy to attach a leash or ID tag. The collar is also lightweight and soft, ensuring that your dog will not experience any discomfort or irritation. Our Red Dog Collar is perfect for pet owners who want to give their dog a stylish and comfortable accessory that is both practical and fashionable. It is easy to clean and maintain, ensuring that it remains hygienic and in top condition for your pet to use. Give your dog the gift of style with our Red Dog Collar.', 4),
(20, 'Dog Collar-Black', 'img/allProducts/dogCollar-3.jpg', 'Slika 20', '20.99', NULL, b'0', 'Our Black Dog Collar is the epitome of style and comfort for your furry friend. Made with premium quality materials, this collar is built to last and provide maximum comfort to your pup. The collar features a sleek and sophisticated black color that is perfect for any occasion. It is fully adjustable, so you can ensure the perfect fit for your dog\'s neck size, and comes with a sturdy D-ring that makes it easy to attach a leash or ID tag. The collar is also lightweight and soft, ensuring that your dog will not experience any discomfort or irritation. Our Black Dog Collar is perfect for pet owners who want to give their dog a stylish and comfortable accessory that is both practical and fashionable. It is easy to clean and maintain, ensuring that it remains hygienic and in top condition for your pet to use. ', 4),
(21, 'Waves', 'img/product-1.png', 'Slika 21', '250.99', '199.99', b'1', 'The unique blend of seeds and grains in our Waves bird food provides a variety of tastes and textures that your birds will love. We\'ve included a mix of sunflower seeds, millet, and other nutritious grains to provide your birds with a well-rounded diet. Our food is also rich in protein, which helps support healthy feather growth and overall bird health.\n\nOur Waves bird food is easy to serve and can be offered in a variety of ways. It can be placed in a feeding dish, mixed with fresh fruits and vegetables, or sprinkled on the bottom of the cage. It\'s also suitable for a wide range of bird species, including parrots, canaries, and finches.', 1),
(22, 'Proto', 'img/product-2.png', 'Slika 22', '179.99', '200.99', b'1', 'Our premium pet food for cats is made with high-quality ingredients to provide your feline friend with a balanced and nutritious diet. We understand that cats have unique dietary needs, which is why our food is carefully formulated to provide all the essential nutrients your cat needs to thrive.\n\nOur pet food for cats is made with real meat as the first ingredient, providing a rich source of protein that supports healthy muscle development and overall wellbeing. We also include a blend of vitamins and minerals to support healthy digestion, a strong immune system, and healthy skin and coat.', 1),
(23, 'Hyper', 'img/product-3.png', 'Slika 23', '199.99', '250.99', b'1', 'Hyper Dog Food is a premium dog food brand that caters to the nutritional needs of active dogs. We understand that your furry friend needs the right balance of nutrients to stay healthy and energetic, which is why our dog food is made with high-quality ingredients that are carefully selected to provide a complete and balanced diet.At Hyper Dog Food, we are committed to providing your furry friend with the best possible nutrition. Try our Hyper Dog Food today and see the difference in your dog\'s health and vitality!', 1),
(24, 'Slice', 'img/product-4.png', 'Slika 24', '189.99', '210.99', b'1', 'Our pet food is free from artificial colors, flavors, and preservatives, ensuring that your pet receives a natural and wholesome meal. We offer a variety of flavors, so you can find the perfect one to suit your pet\'s taste preferences. Our food is also easy to serve and can be offered in a variety of ways. It can be placed in a feeding dish, mixed with fresh vegetables, or offered as a tasty treat. We also include a blend of essential vitamins and minerals to support healthy digestion, a strong immune system, and healthy skin and coat.', 1),
(25, 'Prima', 'img/product-5.png', 'Slika 25', '279.99', '299.99', b'1', 'Prima Cat Food is a premium brand that offers a range of high-quality, natural cat food products to meet the nutritional needs of your feline friend. Our cat food is carefully crafted with the finest ingredients to ensure that your cat receives a complete and balanced meal every time.\n\nOur Slice Cat Food is made with real meat as the primary ingredient, providing a rich source of protein that supports healthy muscle development and overall wellbeing. We also include a blend of essential vitamins and minerals to support healthy digestion.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `title`, `text`, `icon`) VALUES
(1, 'Pet Boarding', 'We provide a safe and comfortable environment for pets to stay while their owners are away. We are also offer additional services, such as grooming,veterinary care, and training.', 'house'),
(2, 'Pet Feeding', 'We offer a range of pet feeding options, including a variety of pet food brands, treats. We are also offer range of feeding accessories, including bowls and water dispensers.', 'food'),
(3, 'Pet Grooming', 'We offer pet grooming, which refers to the process of cleaning and maintaining the hygiene of pets, such as cats and dogs.It includes various activities like bathing, brushing, trimming, and clipping their hair or fur.', 'grooming'),
(4, 'Pet Training', 'We offer pet training, which is the process of teaching a pet, such as a dog or cat, to learn and follow certain commands or behaviorsThere are different types of pet training, including obedience training, behavior training, and agility training.', 'cat'),
(5, 'Pet Exercise', 'Pet owners should consult with our veterinarian to determine the appropriate type and amount of exercise for their pets. It is important to gradually increase exercise routines.', 'dog'),
(6, 'Pet Treatment', 'Pet treatment refers to the medical care and procedures provided to pets when they are sick or injured. .the goal of pet treatment is to maintain the health and well-being of pets.', 'vaccine');

-- --------------------------------------------------------

--
-- Table structure for table `service_price`
--

CREATE TABLE `service_price` (
  `id_service` int(11) NOT NULL,
  `id_plan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_price`
--

INSERT INTO `service_price` (`id_service`, `id_plan`) VALUES
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 3),
(6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tip`
--

CREATE TABLE `tip` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tip`
--

INSERT INTO `tip` (`id`, `naziv`) VALUES
(1, 'Cat'),
(2, 'Dog'),
(3, 'Bird');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id`, `naziv`) VALUES
(1, 'Korisnik'),
(2, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informacija`
--
ALTER TABLE `informacija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uloga` (`id_uloga`);

--
-- Indexes for table `korisnik_odgovor`
--
ALTER TABLE `korisnik_odgovor`
  ADD PRIMARY KEY (`id_korisnika`,`id_odgovora`),
  ADD KEY `id_odgovora` (`id_odgovora`);

--
-- Indexes for table `korpa`
--
ALTER TABLE `korpa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`),
  ADD KEY `proizvod_id` (`proizvod_id`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `odgovor`
--
ALTER TABLE `odgovor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anketa` (`id_anketa`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poruka`
--
ALTER TABLE `poruka`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tip` (`id_tip`),
  ADD KEY `id_korisnik` (`id_korisnik`);

--
-- Indexes for table `price_plan`
--
ALTER TABLE `price_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategorija` (`id_kategorija`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_price`
--
ALTER TABLE `service_price`
  ADD PRIMARY KEY (`id_service`,`id_plan`),
  ADD KEY `id_plan` (`id_plan`);

--
-- Indexes for table `tip`
--
ALTER TABLE `tip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `autor`
--
ALTER TABLE `autor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `informacija`
--
ALTER TABLE `informacija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `korpa`
--
ALTER TABLE `korpa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `odgovor`
--
ALTER TABLE `odgovor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `poruka`
--
ALTER TABLE `poruka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `price_plan`
--
ALTER TABLE `price_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tip`
--
ALTER TABLE `tip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`id_uloga`) REFERENCES `uloga` (`id`);

--
-- Constraints for table `korisnik_odgovor`
--
ALTER TABLE `korisnik_odgovor`
  ADD CONSTRAINT `korisnik_odgovor_ibfk_1` FOREIGN KEY (`id_korisnika`) REFERENCES `korisnik` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `korisnik_odgovor_ibfk_2` FOREIGN KEY (`id_odgovora`) REFERENCES `odgovor` (`id`);

--
-- Constraints for table `korpa`
--
ALTER TABLE `korpa`
  ADD CONSTRAINT `korpa_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`),
  ADD CONSTRAINT `korpa_ibfk_2` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvodi` (`id`);

--
-- Constraints for table `odgovor`
--
ALTER TABLE `odgovor`
  ADD CONSTRAINT `odgovor_ibfk_1` FOREIGN KEY (`id_anketa`) REFERENCES `anketa` (`id`);

--
-- Constraints for table `poruka`
--
ALTER TABLE `poruka`
  ADD CONSTRAINT `poruka_ibfk_1` FOREIGN KEY (`id_tip`) REFERENCES `tip` (`id`),
  ADD CONSTRAINT `poruka_ibfk_2` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnik` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD CONSTRAINT `proizvodi_ibfk_1` FOREIGN KEY (`id_kategorija`) REFERENCES `kategorija` (`id`);

--
-- Constraints for table `service_price`
--
ALTER TABLE `service_price`
  ADD CONSTRAINT `service_price_ibfk_1` FOREIGN KEY (`id_plan`) REFERENCES `price_plan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_price_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `service` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
