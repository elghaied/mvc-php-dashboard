-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 09, 2024 at 03:07 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `five_team_car_dashboard_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `license_plate` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_type` enum('used','new') NOT NULL,
  `reserved` tinyint(1) NOT NULL,
  `fuel` enum('Petrol','Diesel','Electric','Other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `brand`, `model`, `license_plate`, `price`, `sale_type`, `reserved`, `fuel`) VALUES
(77, 'Toyota', 'Camry', 'AB-123-CD', 20000.00, 'used', 0, 'Petrol'),
(78, 'Honda', 'Accord', 'XY-456-ZF', 22000.00, 'new', 1, 'Diesel'),
(79, 'Ford', 'Fusion', 'GH-789-IJ', 18000.00, 'used', 0, 'Electric'),
(80, 'Chevrolet', 'Malibu', 'KL-012-MN', 25000.00, 'new', 1, 'Petrol'),
(81, 'Nissan', 'Altima', 'OP-345-QR', 23000.00, 'used', 0, 'Electric'),
(82, 'Hyundai', 'Sonata', 'ST-678-UV', 21000.00, 'new', 1, 'Petrol'),
(83, 'Volkswagen', 'Passat', 'WX-901-YZ', 19000.00, 'used', 0, 'Diesel'),
(84, 'Subaru', 'Legacy', 'CD-234-EF', 24000.00, 'new', 1, 'Electric'),
(85, 'Kia', 'Optima', 'GH-567-IJ', 20000.00, 'used', 0, 'Petrol'),
(86, 'Mazda', 'Mazda6', 'KL-890-MN', 22000.00, 'new', 1, 'Diesel'),
(87, 'Audi', 'A4', 'OP-123-QR', 18000.00, 'used', 0, 'Petrol'),
(88, 'Mercedes-Benz', 'C-Class', 'ST-456-UV', 25000.00, 'new', 1, 'Electric'),
(89, 'BMW', '3 Series', 'WX-789-YZ', 23000.00, 'used', 0, 'Diesel'),
(90, 'Tesla', 'Model 3', 'CD-012-EF', 21000.00, 'new', 1, 'Electric'),
(91, 'Ford', 'Mustang', 'GH-345-IJ', 19000.00, 'used', 0, 'Petrol'),
(92, 'Chevrolet', 'Camaro', 'KL-678-MN', 22000.00, 'new', 1, 'Diesel'),
(93, 'Nissan', '370Z', 'OP-901-QR', 20000.00, 'used', 0, 'Electric'),
(94, 'Toyota', 'Corolla', 'ST-234-UV', 24000.00, 'new', 1, 'Petrol'),
(95, 'Honda', 'Civic', 'WX-567-YZ', 18000.00, 'used', 0, 'Diesel'),
(96, 'Hyundai', 'Elantra', 'CD-890-EF', 25000.00, 'new', 1, 'Electric');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
