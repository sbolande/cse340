-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Dec 04, 2021 at 05:19 AM
-- Server version: 8.0.26
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(1, 'John', 'Doe', 'jdoe@example.com', '$2y$10$mnAiY1NBKzZZGYoz5SVhJeps94Y.GVX.r.aLt1Px8fFJ16CFvriE6', '1', NULL),
(5, 'Admin', 'User', 'admin@cse340.net', '$2y$10$DNbm7.M8TyeZQgoSFpPyXe/sA/Cc313dyDuCaJG5T5JS03cGJZQr.', '3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int NOT NULL,
  `invId` int NOT NULL,
  `imgName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imgPath` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imgDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imgPrimary` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(3, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2021-11-15 17:35:38', 1),
(4, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2021-11-15 17:35:38', 1),
(5, 2, 'model-t.jpg', '/phpmotors/images/vehicles/model-t.jpg', '2021-11-15 17:36:05', 1),
(6, 2, 'model-t-tn.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '2021-11-15 17:36:05', 1),
(7, 3, 'adventador.jpg', '/phpmotors/images/vehicles/adventador.jpg', '2021-11-15 17:36:30', 1),
(8, 3, 'adventador-tn.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '2021-11-15 17:36:30', 1),
(9, 4, 'monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck.jpg', '2021-11-15 17:36:40', 1),
(10, 4, 'monster-truck-tn.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '2021-11-15 17:36:40', 1),
(11, 5, 'mechanic.jpg', '/phpmotors/images/vehicles/mechanic.jpg', '2021-11-15 17:36:49', 1),
(12, 5, 'mechanic-tn.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '2021-11-15 17:36:49', 1),
(13, 6, 'batmobile.jpg', '/phpmotors/images/vehicles/batmobile.jpg', '2021-11-15 17:37:03', 1),
(14, 6, 'batmobile-tn.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '2021-11-15 17:37:03', 1),
(15, 7, 'mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van.jpg', '2021-11-15 17:37:14', 1),
(16, 7, 'mystery-van-tn.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '2021-11-15 17:37:14', 1),
(17, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2021-11-15 17:37:30', 1),
(18, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2021-11-15 17:37:30', 1),
(19, 9, 'crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic.jpg', '2021-11-15 17:37:40', 1),
(20, 9, 'crwn-vic-tn.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '2021-11-15 17:37:40', 1),
(21, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2021-11-15 17:37:52', 1),
(22, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2021-11-15 17:37:52', 1),
(23, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2021-11-15 17:38:03', 1),
(24, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2021-11-15 17:38:03', 1),
(25, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2021-11-15 17:38:15', 1),
(26, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2021-11-15 17:38:15', 1),
(27, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2021-11-15 17:38:22', 1),
(28, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2021-11-15 17:38:22', 1),
(29, 14, 'van.jpg', '/phpmotors/images/vehicles/van.jpg', '2021-11-15 17:38:35', 1),
(30, 14, 'van-tn.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '2021-11-15 17:38:35', 1),
(31, 16, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2021-11-15 17:38:48', 1),
(32, 16, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2021-11-15 17:38:48', 1),
(33, 15, 'no-image.png', '/phpmotors/images/vehicles/no-image.png', '2021-11-15 17:44:20', 1),
(34, 15, 'no-image-tn.png', '/phpmotors/images/vehicles/no-image-tn.png', '2021-11-15 17:44:20', 1),
(35, 1, 'wrangler-2.jpg', '/phpmotors/images/vehicles/wrangler-2.jpg', '2021-11-15 17:55:52', 0),
(36, 1, 'wrangler-2-tn.jpg', '/phpmotors/images/vehicles/wrangler-2-tn.jpg', '2021-11-15 17:55:52', 0),
(37, 13, 'aerocar-2.jpg', '/phpmotors/images/vehicles/aerocar-2.jpg', '2021-11-15 17:56:05', 0),
(38, 13, 'aerocar-2-tn.jpg', '/phpmotors/images/vehicles/aerocar-2-tn.jpg', '2021-11-15 17:56:05', 0),
(39, 16, 'delorean-2.jpg', '/phpmotors/images/vehicles/delorean-2.jpg', '2021-11-15 17:56:16', 0),
(40, 16, 'delorean-2-tn.jpg', '/phpmotors/images/vehicles/delorean-2-tn.jpg', '2021-11-15 17:56:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,2) NOT NULL,
  `invStock` smallint NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28001.01', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/phpmotors/images/vehicles/model-t.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '30000.00', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '417650.00', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '150000.00', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '100.00', 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '65000.00', 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '10000.00', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000.00', 1, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '10000.00', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000.00', 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195.00', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800.00', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000.00', 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month. ', '/phpmotors/images/vehicles/van.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '20000.00', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image-tn.png', '35000.00', 1, 'Brown', 2),
(16, 'DeLorean', 'DMC', 'Need to get back to the future? Want to get your parents together back in their highschool days? This gull-wing, sports car features a Flux-Capacitor to get the job done. Safe for dogs, too!', '/phpmotors/images/vehicles/delorean.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '45000.00', 1, 'Silver', 3);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invId` int NOT NULL,
  `clientId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(2, 'So fast its almost like traveling in time. (4/5)', '2021-11-30 20:45:53', 16, 1),
(3, 'Coolest ride on the road. (4/5)', '2021-11-30 20:56:56', 16, 1),
(4, 'I\'m feeling Marty McFly! (5/5)', '2021-12-01 18:25:44', 16, 1),
(5, 'The most futuristic ride of our day. (4.5/5)', '2021-12-01 19:19:38', 16, 1),
(7, '80&#39;s livin and I love it! (5/5)', '2021-12-01 19:31:40', 16, 1),
(8, 'Best car I&#39;ve ever owned.', '2021-12-02 02:36:21', 1, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_images` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `invId` (`invId`) USING BTREE,
  ADD KEY `clientId` (`clientId`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
