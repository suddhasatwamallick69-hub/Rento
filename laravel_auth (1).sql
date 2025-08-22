-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 05:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vid` bigint(20) UNSIGNED NOT NULL,
  `uid` bigint(20) UNSIGNED NOT NULL,
  `hid` bigint(20) UNSIGNED NOT NULL,
  `booking_date` datetime NOT NULL,
  `pickup_date` datetime NOT NULL,
  `dropoff_date` datetime NOT NULL,
  `updated_pickup_date` datetime DEFAULT NULL,
  `updated_dropoff_date` datetime DEFAULT NULL,
  `address` text NOT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `house_no` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `new_bookingId` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_statuses`
--

CREATE TABLE `booking_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bid` bigint(20) UNSIGNED NOT NULL,
  `booking_reference` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2025_03_10_063940_vehicle_categories', 2),
(9, '2025_03_14_092919_otp_verification', 6),
(13, '2025_03_15_091215_vehicle_rate', 10),
(19, '2025_03_23_082119_create_payments_table', 13),
(20, '2025_03_23_063831_create_booking_statuses_table', 14),
(21, '2014_10_12_000000_create_users_table', 15),
(22, '2025_03_19_062804_create_profile_details_table', 15),
(25, '2025_03_23_061402_create_bookings_table', 17),
(26, '2025_03_11_083821_vehicles', 18);

-- --------------------------------------------------------

--
-- Table structure for table `otp_verification`
--

CREATE TABLE `otp_verification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otp_verification`
--

INSERT INTO `otp_verification` (`id`, `email`, `otp`) VALUES
(1, 'suddhasatwamallick69@gmail.com', '681845');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bid` bigint(20) UNSIGNED NOT NULL,
  `uid` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `payment_id` varchar(500) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_details`
--

CREATE TABLE `profile_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` bigint(20) UNSIGNED NOT NULL,
  `driving_license` varchar(255) NOT NULL,
  `aadhar_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile_details`
--

INSERT INTO `profile_details` (`id`, `uid`, `driving_license`, `aadhar_number`, `created_at`, `updated_at`) VALUES
(1, 2, 'hcyrwj55jy', '4500 1547 6547', '2025-03-31 10:52:50', '2025-03-31 10:52:50'),
(2, 3, 'null', '4517 1547 1002', '2025-03-31 11:53:31', '2025-03-31 11:53:31'),
(3, 4, 'gjjyybkkei44', '1234 4567 8976', '2025-04-04 06:16:06', '2025-04-04 06:16:06'),
(4, 5, 'null', '1234 4568 4578', '2025-04-15 07:45:00', '2025-04-15 07:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone_number`, `email`, `role`, `password`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'NULL', 'admin@gmail.com', 'admin', '$2y$12$.mJmgnJtVxYFSgcSgJAoMOTRsxiniHpV83tW.bJg3wRhixi5yMlby', 1, '2025-03-31 07:29:28', '2025-03-31 07:57:14'),
(2, 'Suddhasatwa Mallick', '6291598779', 'suddhasatwamallick69@gmail.com', 'user', '$2y$12$.mJmgnJtVxYFSgcSgJAoMOTRsxiniHpV83tW.bJg3wRhixi5yMlby', 1, '0000-00-00 00:00:00', '2025-03-31 12:09:22'),
(3, 'Surandam Samanta', '9330314807', 'suddhasatwamallick7@gmail.com', 'host', '$2y$12$.mJmgnJtVxYFSgcSgJAoMOTRsxiniHpV83tW.bJg3wRhixi5yMlby', 1, '0000-00-00 00:00:00', '2025-03-31 11:53:31'),
(4, 'Debadri Saha', '70035 50340', 'debadrisaha29@gmail.com', 'host', '$2y$12$.mJmgnJtVxYFSgcSgJAoMOTRsxiniHpV83tW.bJg3wRhixi5yMlby', 1, '0000-00-00 00:00:00', '2025-04-04 06:16:07'),
(5, 'Kinjol Bose', '6291598778', 'kinjolbose1@gmail.com', 'host', '$2y$12$PGDzp22gXGKfCR0XDKpUAeq/TDg3GiTHitZdPLIZ.IDUVvBEGbdGK', 1, '2025-04-15 07:44:19', '2025-04-29 09:45:24'),
(6, 'Bapi Saren', '9748756541', 'bapisaren1234@gmail.com', 'host', '$2y$12$PGDzp22gXGKfCR0XDKpUAeq/TDg3GiTHitZdPLIZ.IDUVvBEGbdGK', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `oid` bigint(20) UNSIGNED NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `fuel_type` varchar(255) NOT NULL,
  `capacity` varchar(255) NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `registration_date` date NOT NULL,
  `validity_date` date NOT NULL,
  `registration_certificate` varchar(255) NOT NULL,
  `pollution_certificate` varchar(255) NOT NULL,
  `images` varchar(800) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `latitude` decimal(20,14) NOT NULL,
  `longitude` decimal(20,14) NOT NULL,
  `street` text NOT NULL,
  `suburb` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `availability` varchar(255) NOT NULL,
  `approval` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `oid`, `model_name`, `category`, `fuel_type`, `capacity`, `registration_number`, `registration_date`, `validity_date`, `registration_certificate`, `pollution_certificate`, `images`, `name`, `phone_number`, `email`, `latitude`, `longitude`, `street`, `suburb`, `city`, `state`, `pincode`, `address`, `availability`, `approval`, `created_at`, `updated_at`) VALUES
(1, 4, 'Maruti Grand Vitara', 'SUV', 'Diesel', '6', 'WB20BX3406', '2024-07-02', '2039-07-01', '1745937111IMG-20250428-WA0006.jpg', '174238236329401222099_data_science_ca2.pdf', '1742382363grandvitaramarutisuzukigrandvitararightfrontthreequarter13.jpeg,1742382363grandvitaramarutisuzukigrandvitararightrearthreequarter.jpeg,1742382363grandvitaramarutisuzukigrandvitararightsideview.jpeg,1742382363grandvitaragrandvitarainfotainmentsystem.jpeg,1742382363grandvitaragrandvitaraopenboottrunk.jpeg,1742382363grandvitaramarutisuzukigrandvitarabootspace.jpeg,1742382363grandvitaramarutisuzukigrandvitaradashboard.jpeg,1742382363grandvitaramarutisuzukigrandvitarafrontrowseats.jpeg,1742382363grandvitaramarutisuzukigrandvitaragearshiftergearshifterstalk.jpeg,1742382363grandvitaramarutisuzukigrandvitarainnercarroof.jpeg,1742382363grandvitaramarutisuzukigrandvitararearseats.jpeg', 'Debadri Saha', '70035 50340', 'surandam098@gmail.com', 22.53031753640563, 88.35265355029380, '53, Sarat Bose Rd', 'Paddapukur, Bhowanipore', 'Kolkata', 'West Bengal', '700025', '53, Sarat Bose Rd, Paddapukur, Bhowanipore, Kolkata, West Bengal 700025, India', 'Yes', 'Yes', '2025-03-18 13:06:03', '2025-05-06 09:45:50'),
(2, 6, 'Honda i-VTEC', 'Sedan', 'Petrol', '5', 'WB20BX3406', '2024-07-02', '2039-07-01', '1745937111IMG-20250428-WA0006.jpg', '1742454955DSca2coverpage.pdf', '1742454955citycityrightfrontthreequarter.jpeg,1742454955citycityrightrearthreequarter.jpeg,1742454955citycityrightsideview.jpeg,1742454955citycitysteeringwheel.jpeg,1742454955citycityfrontcentrearmreststorage (1).jpeg,1742454955citycityfrontcentrearmreststorage.jpeg,1742454955citycityfrontview.jpeg,1742454955citycityinfotainmentsystem.jpeg,1742454955citycityinstrumentcluster.jpeg,1742454955citycityopenboottrunk.jpeg,1742454955citycitypedalsfootcontrols.jpeg,1742454955citycityrearseats.jpeg', 'Bapi Saren', '+91 90839 94591', 'bapisaren1234@gmail.com', 22.48224874568429, 88.35557122415630, 'Gandhi Colony', 'Netaji Nagar', 'Kolkata', 'West Bengal', '700040', 'Gandhi Colony, Netaji Nagar, Kolkata, West Bengal 700040', 'Yes', 'Yes', '2025-03-19 09:15:55', '2025-03-19 09:16:40'),
(3, 5, 'TATA CURVV', 'SUV', 'Electric', '7', 'WB20BX3406', '2024-07-02', '2039-07-01', '1745937111IMG-20250428-WA0006.jpg', '1742661488dsca2.pdf', '1742661488curvvcurvvsteeringwheel.jpeg,1742661488curvvcurvvsunroofmoonroof.jpeg,1742661488curvvtatacurvvdashboard.jpeg,1742661488curvvtatacurvvfrontrowseats.jpeg,1742661488curvvcurvvbootspace.jpeg,1742661488curvvcurvvleftfrontthreequarter.jpeg,1742661488curvvcurvvleftrearthreequarter.jpeg,1742661488curvvcurvvleftsideview.jpeg,1742661488curvvcurvvrearview.jpeg,1742661488curvvcurvvrightpaddleshifter.jpeg,1742661488curvvcurvvroofmountedcontrolssunroofcabinlightcontrols.jpeg', 'Kinjol Bose', '+91 89003 69574', 'kinjolboseedu@gmail.com', 22.43794924846964, 88.42891360212062, 'Haridhan Chakraborty Sarani', 'Blue Bird Apartment, Amantrani Park', 'Rajpur Sonarpur', 'West Bengal', '700150', 'Blue Bird Apartment, Amantrani Park, Sonarpur, Rajpur Sonarpur, West Bengal 700150\n', 'Yes', 'Yes', '2025-03-21 18:38:08', '2025-03-22 17:32:03'),
(4, 3, 'Toyota Camry', 'Sedan', 'Diesel', '6', 'WB20BX3406', '2024-07-02', '2039-07-01', '1745937111IMG-20250428-WA0006.jpg', '1743183106DSca2coverpage.pdf', '1743183106citycityfrontseatbackpockets.jpeg,1743183106citycityinnercarroof.jpeg,1743183106citycityseatadjustmentmanualfordriver.jpeg,1743183106engine-force-516x253.jpg,1743183106exterior_thumb1-389x264.png,1743183106specs-bottom-1920x2836.jpg', 'Surandam Samanta', '+91 73638 73891', 'surandam098@gmail.com', 22.49199216372756, 88.35020793061733, 'Graham Road', 'Shantigarh', 'Kolkata', 'West Bengal', '700040', 'Graham Road, Shantigarh, Kolkata - 700040, WB, India', 'Yes', 'Yes', '2025-03-27 19:31:46', '2025-03-27 19:32:26'),
(5, 5, 'TATA EV PUNCH', 'Midsize', 'Electric', '5', 'WB20BX3406', '2024-07-02', '2039-07-01', '1745937111IMG-20250428-WA0006.jpg', '174318491229401222099_data_science_ca2.pdf', '1743184912punchpunchdashboard.jpeg,1743184912punchpunchfrontrowseats.jpeg,1743184912punchpunchleftfrontthreequarter.jpeg,1743184912punchpunchleftrearthreequarter.jpeg,1743184912punchpunchleftsideview.jpeg,1743184912punchpunchrearseats.jpeg,1743184912punchpunchrearview.jpeg,1743184912punchrightsideview36.jpeg,1743184912punchtatapunchfrontrowseats.jpeg,1743184912punchtatapunchrearseats.jpeg,1743184912punchtatapunchrightrearthreequarter.jpeg,1743184912punchtatapunchrightsideview.jpeg', 'Kinjol Bose', '+91 89003 69574', 'kinjolboseedu@gmail.com', 22.43794924846964, 88.42891360212062, 'Haridhan Chakraborty Sarani', 'Blue Bird Apartment, Amantrani Park', 'Rajpur Sonarpur', 'West Bengal', '700150', 'Blue Bird Apartment, Amantrani Park, Sonarpur, Rajpur Sonarpur, West Bengal 700150\n', 'Yes', 'Yes', '2025-03-27 20:01:52', '2025-03-30 18:55:37'),
(6, 3, 'Toyota Fortuner', 'SUV', 'Diesel', '7', 'WB20BX3406', '2024-07-02', '2039-07-01', '1745937111IMG-20250428-WA0006.jpg', '174318588229401222099_data_science_ca2.pdf', '1743185882toyotafortuneraction.jpeg,1743185882toyotafortunerinterior (1).jpeg,1743185882toyotafortunerinterior (2).jpeg,1743185882toyotafortunerinterior (3).jpeg,1743185882toyotafortunerinterior.jpeg,1743185882toyotanewfortunerexterior (1).jpeg,1743185882toyotanewfortunerexterior (2).jpeg,1743185882toyotanewfortunerexterior (3).jpeg,1743185882toyotanewfortunerexterior.jpeg', 'Surandam Samanta', '+91 73638 73891', 'surandam098@gmail.com', 22.49181916200593, 88.34628452483565, '57, MANI VISTA, 3M, Netaji Subhash Chandra Bose Rd', 'Ashok Nagar, Tollygunge', 'Kolkata', 'West Bengal', '700040', '57, MANI VISTA, 3M, Netaji Subhash Chandra Bose Rd, Ashok Nagar, Tollygunge, Kolkata, West Bengal 700040', 'Yes', 'Yes', '2025-03-27 20:18:02', '2025-03-29 19:04:22'),
(7, 6, 'Maruti Suzuki Alto K10', 'Hatchback', 'Petrol', '5', 'WB20BX3406', '2024-07-02', '2039-07-01', '1745937111IMG-20250428-WA0006.jpg', '1743186378ca1 Unix & Shell Programming cover page.pdf', '1743186378mini_magick20250124-1-14zwkbac2c57091-5483-4248-9994-017417965682.jpeg,1743186378mini_magick20250124-1-199ujuua75eb35e-a10a-4dcd-a968-a106719bb61b.jpeg,1743186378RackMultipart20250124-33-1lb1c5de46c8cca-e3a2-4b23-bf78-8fdda4b1a254.jpg,1743186378RackMultipart20250124-1404-1r6tkh26aa1685c-f8c5-415a-9dbe-14ba6b1e58a6.jpg,1743186378RackMultipart20250124-16842-nrzxy6ff47b85b-9611-44a2-94ae-26221396282e.jpg', 'Bapi Saren', '+91 90839 94591', 'bapisaren1234@gmail.com', 22.44354800357217, 88.41540703792316, 'Sonarpur Station Road', 'Mission Pally, Narendrapur, Rajpur', 'Rajpur Sonarpur', 'West Bengal', '700103', 'Mission Pally, Narendrapur, Rajpur Sonarpur, West Bengal 700103', 'Yes', 'Yes', '2025-03-27 20:26:18', '2025-03-29 21:42:45'),
(8, 3, '3m5', 'SUV', 'Petrol', '6', 'WB20BX3406', '2014-07-02', '2025-05-02', '1745937111IMG-20250428-WA0006.jpg', '1744625825apaarid.pdf', '1744625825Adobe Express - file.png,1744625825car-free-transparent-png-8.png,1744625825commuter.jpeg', 'Surandam Samanta', '+91 73638 73891', 'surandam098@gmail.com', 22.44306910780111, 88.42662732749340, 'Sonarpur Station Road', 'Shimultala', 'Rajpur Sonarpur', 'West Bengal', '700150', 'Axis Bank, Kamrabad More, Sonarpur Station Road, Shimultala, Rajpur Sonarpur - 700150, WB, India', 'No', 'No', '2025-04-13 23:17:05', '2025-05-02 15:05:04'),
(9, 5, 'Mahindra Bolero', 'SUV', 'Diesel', '6', 'WB20BX3406', '2024-07-02', '2039-07-01', '1745937111IMG-20250428-WA0006.jpg', '1745937125BCA_6th_SEM.pdf', '1745937125bolerobolerorearview.jpeg,1745937125bolerobolerosteeringwheel.jpeg,1745937125boleroboleroleftfrontthreequarter.jpeg,1745937125bolerobolerorightfrontthreequarter.jpeg', 'Kinjol Bose', '+91 89003 69574', 'kinjolboseedu@gmail.com', 22.43794924846964, 88.42891360212062, 'Haridhan Chakraborty Sarani', 'Blue Bird Apartment, Amantrani Park', 'Rajpur Sonarpur', 'West Bengal', '700150', 'Blue Bird Apartment, Amantrani Park, Sonarpur, Rajpur Sonarpur, West Bengal 700150\n', 'Yes', 'Yes', '2025-04-29 09:02:05', '2025-04-29 09:08:16');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_categories`
--

CREATE TABLE `vehicle_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_categories`
--

INSERT INTO `vehicle_categories` (`id`, `name`, `parent_id`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'CAR', 0, 'This is a car', '1741597727download.jpeg', '2025-03-10 03:38:47', '2025-03-10 03:38:47'),
(2, 'SUV', 1, 'suv car', '1741597944pexels-mikebirdy-116675-removebg-preview.png', '2025-03-10 03:42:24', '2025-03-10 03:42:24'),
(3, 'Sedan', 1, 'Sedan Car', '1741606048sedan.jpeg', '2025-03-10 05:57:28', '2025-03-10 05:57:28'),
(4, 'Midsize', 1, 'Midsize Car', '1741607417midsize_car.jpg', '2025-03-10 06:20:17', '2025-03-10 06:20:17'),
(5, 'Van', 0, 'Van', '1741607709van.jpeg', '2025-03-10 06:25:09', '2025-03-10 06:25:09'),
(6, 'Minivan', 5, 'Minivan', '1741609205minivan.jpeg', '2025-03-10 06:50:05', '2025-03-10 06:50:05'),
(7, 'Full-Size Van', 5, 'Full-Size Van', '1741611705Full-SizeVan.jpeg', '2025-03-10 07:31:45', '2025-03-10 07:31:45'),
(8, 'Passenger Van', 5, 'Passenger Van', '1741611787Passenger Van.jpg', '2025-03-10 07:33:07', '2025-03-10 07:33:07'),
(9, '2 Wheeler', 0, '2 Wheeler', '17416121292Wheeler.jpg', '2025-03-10 07:38:49', '2025-03-10 07:38:49'),
(10, 'Scooter', 9, 'Scooter', '1741612253scooter.jpg', '2025-03-10 07:40:53', '2025-03-10 07:40:53'),
(11, 'Commuter Bikes', 9, 'Commuter Bikes', '1741612425commuter.jpeg', '2025-03-10 07:43:45', '2025-03-10 07:43:45'),
(12, 'Wagon', 1, 'Wagon', '1741613801wagon.jpg', '2025-03-10 08:06:41', '2025-03-10 08:06:41'),
(13, 'Truck', 0, 'truck ig[u[ububo ogorng', '1741877001van.jpeg', '2025-03-13 09:13:21', '2025-03-13 09:13:21'),
(14, 'Hatchback', 1, 'Hatchback', '1743186254altok10metallicsilkysilver.jpeg', '2025-03-28 12:54:14', '2025-03-28 12:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_rate`
--

CREATE TABLE `vehicle_rate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vid` bigint(20) UNSIGNED NOT NULL,
  `rate_per_hour` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_rate`
--

INSERT INTO `vehicle_rate` (`id`, `vid`, `rate_per_hour`, `created_at`, `updated_at`) VALUES
(1, 1, 140.00, '2025-03-22 05:51:56', '2025-05-02 14:55:57'),
(2, 2, 90.00, '2025-03-22 05:53:22', '2025-03-22 05:53:22'),
(3, 3, 120.00, '2025-03-22 11:09:32', '2025-03-22 11:09:32'),
(4, 4, 100.00, '2025-03-28 12:02:32', '2025-03-28 12:02:32'),
(5, 5, 120.00, '2025-03-28 12:32:21', '2025-03-28 12:32:21'),
(6, 6, 233.00, '2025-03-28 12:48:35', '2025-03-28 12:48:35'),
(7, 7, 93.00, '2025-03-28 12:56:55', '2025-03-28 12:56:55'),
(8, 9, 100.00, '2025-04-29 09:08:09', '2025-04-29 09:08:09'),
(9, 8, 89.00, '2025-05-02 12:30:36', '2025-05-02 12:30:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_vid_foreign` (`vid`),
  ADD KEY `bookings_uid_foreign` (`uid`),
  ADD KEY `bookings_hid_foreign` (`hid`);

--
-- Indexes for table `booking_statuses`
--
ALTER TABLE `booking_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_statuses_booking_reference_unique` (`booking_reference`),
  ADD KEY `booking_statuses_bid_foreign` (`bid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_verification`
--
ALTER TABLE `otp_verification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `otp_verification_email_unique` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_bid_foreign` (`bid`),
  ADD KEY `payments_uid_foreign` (`uid`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profile_details`
--
ALTER TABLE `profile_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_details_uid_foreign` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_oid_foreign` (`oid`);

--
-- Indexes for table `vehicle_categories`
--
ALTER TABLE `vehicle_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_rate`
--
ALTER TABLE `vehicle_rate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_rate_vid_foreign` (`vid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_statuses`
--
ALTER TABLE `booking_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `otp_verification`
--
ALTER TABLE `otp_verification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile_details`
--
ALTER TABLE `profile_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vehicle_categories`
--
ALTER TABLE `vehicle_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vehicle_rate`
--
ALTER TABLE `vehicle_rate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_hid_foreign` FOREIGN KEY (`hid`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_vid_foreign` FOREIGN KEY (`vid`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_statuses`
--
ALTER TABLE `booking_statuses`
  ADD CONSTRAINT `booking_statuses_bid_foreign` FOREIGN KEY (`bid`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_bid_foreign` FOREIGN KEY (`bid`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profile_details`
--
ALTER TABLE `profile_details`
  ADD CONSTRAINT `profile_details_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_oid_foreign` FOREIGN KEY (`oid`) REFERENCES `users` (`id`);

--
-- Constraints for table `vehicle_rate`
--
ALTER TABLE `vehicle_rate`
  ADD CONSTRAINT `vehicle_rate_vid_foreign` FOREIGN KEY (`vid`) REFERENCES `vehicles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
