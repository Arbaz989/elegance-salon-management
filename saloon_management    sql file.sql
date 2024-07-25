-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2024 at 12:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saloon_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `stylist_id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `service_id` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `time_slot_id` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `user_name`, `stylist_id`, `user_email`, `service_id`, `appointment_date`, `time_slot_id`, `status`) VALUES
(5, 1, 'Arbaz_ak', 0, '', '3', '2024-07-18', 7, 'approved'),
(7, 1, '', 0, '', '1', '2024-07-13', 6, 'approved'),
(8, 1, 'Arrbaz', 0, 'haa@gmail.com', '2', '2024-07-13', 8, 'rejected'),
(9, 1, 'haa', 12, 'haa@gmail.com', '1', '2024-07-19', 6, 'approved'),
(10, 1, '3434', 12, 'aa@gmail.com', '1', '2024-07-30', 9, 'rejected'),
(11, 16, 'aaaf', 12, 'aaaf@gmail.com', '4', '2024-07-28', 9, 'rejected'),
(12, 17, 'numan', 12, 'numan@gmail.com', '3', '2024-07-24', 1, 'approved'),
(13, 20, 'usama', 18, 'usama@gmail.com', '1', '2024-07-24', 1, 'approved'),
(14, 23, 'zaid', 18, 'zaid@gmail.com', '3', '2024-07-05', 1, 'approved'),
(15, 23, 'zaid', 18, 'zaid@gmail.com', '2', '2024-07-03', 1, 'rejected'),
(16, 23, 'zaid', 18, 'zaid@gmail.com', '12', '2024-07-05', 12, 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `feedback` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `feedback`, `submitted_at`) VALUES
(1, 'Arbaz', 'la6691684@gmail.com', 'dfdfdfdf', '2024-07-12 05:53:58'),
(2, 'Arbazddf', 'akka@gmail.com', 'fddgfgf', '2024-07-12 05:55:58'),
(3, 'Arbazddf', 'akka@gmail.com', 'fddgfgf', '2024-07-12 05:59:41'),
(4, 'Arbaz', 'arkay@gmail.com', 'dfdfdfd', '2024-07-12 06:03:08'),
(5, 'zaid', 'akka@gmail.com', 'dfdfdf', '2024-07-12 06:08:17'),
(6, 'numan', 'arkay@gmail.com', 'dfdfd', '2024-07-12 06:11:18'),
(7, 'numan', 'arkay@gmail.com', 'dfdfd', '2024-07-12 06:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `threshold` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_name`, `quantity`, `threshold`, `supplier_id`, `cost`) VALUES
(2, 'Combs', 100, 20, 1, 5.99),
(3, 'Hair Straightener', 80, 15, 2, 29.99),
(4, 'Mirrors', 50, 10, 3, 19.99),
(5, 'Curling Iron', 10, 5, 4, 24.99),
(6, 'Scissors', 30, 10, 5, 9.99),
(7, 'Spray Bottles', 15, 5, 6, 3.99),
(8, 'Styling Chairs', 2, 3, 7, 199.99),
(9, 'Hair Dryer', 25, 10, 8, 49.99),
(10, 'Reception Desk', 5, 2, 9, 299.99),
(11, 'Apron', 20, 5, 10, 14.99),
(12, 'Gloves', 40, 10, 11, 4.99),
(13, 'Towels', 30, 8, 12, 2.99),
(14, 'Styling Stations', 6, 2, 13, 399.99),
(15, 'Grooms and ups', 2, 3, 1, 100.00),
(16, 'Grooms and ups', 1, 2, 3, 100.00),
(17, 'Styled chairs', 2, 2, 14, 122.00);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `appointment_id`, `amount`, `payment_date`) VALUES
(3, 11, 1890.00, '2024-07-09 13:03:48'),
(4, 11, 1890.00, '2024-07-09 13:06:53'),
(5, 12, 1000.00, '2024-07-09 13:07:17'),
(6, 15, 23232.00, '2024-07-12 07:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `price`, `description`, `created_at`) VALUES
(1, 'Service-1:Haircut', 9.99, 'Haircut', '2024-07-02 08:19:14'),
(2, 'Service-2:Hair Wash', 10.99, 'Description for Service 2', '2024-07-02 08:19:14'),
(3, 'Service-3:Hair Color', 11.99, 'Description for Service 3', '2024-07-02 08:19:14'),
(4, 'Service-4:Hair Shave', 12.99, 'Description for Service 4', '2024-07-02 08:19:14'),
(5, 'Service-5:Hair Straight', 13.99, 'Description for Service 5', '2024-07-02 08:19:14'),
(6, 'Service-6: Manicure', 15.99, NULL, '2024-07-12 07:11:32'),
(7, 'Service-7: Pedicure', 18.99, NULL, '2024-07-12 07:11:32'),
(8, 'Service-8: Facial', 25.99, NULL, '2024-07-12 07:11:32'),
(9, 'Service-9: Waxing', 20.99, NULL, '2024-07-12 07:11:32'),
(10, 'Service-10: Hair Coloring', 50.99, NULL, '2024-07-12 07:11:32'),
(11, 'Service-11: Hair Highlights', 65.99, NULL, '2024-07-12 07:11:32'),
(12, 'Service-12: Beard Trim', 12.99, NULL, '2024-07-12 07:11:32'),
(13, 'Service-13: Hair Spa', 30.99, NULL, '2024-07-12 07:11:32'),
(14, 'Service-14: Scalp Treatment', 35.99, NULL, '2024-07-12 07:11:32'),
(15, 'Service-15: Bridal Makeup', 100.99, NULL, '2024-07-12 07:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `stylist_services`
--

CREATE TABLE `stylist_services` (
  `stylist_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stylist_services`
--

INSERT INTO `stylist_services` (`stylist_id`, `service_id`) VALUES
(12, 1),
(12, 2),
(12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact_info`) VALUES
(1, 'Supplier Combs', 'contact@supplierA.com'),
(2, 'Supplier HairStraightner', 'contact@supplierB.com'),
(3, 'Supplier Mirrors', 'contact@supplierC.com'),
(4, 'Supplier Combs', 'contact@supplierA.com'),
(5, 'Supplier HairStraightener', 'contact@supplierB.com'),
(6, 'Supplier Mirrors', 'contact@supplierC.com'),
(7, 'Supplier Curling iron', 'checkyourmail112@gmail.com'),
(8, 'Supplier Scissors', 'contact@supplierE.com'),
(9, 'Supplier Spray bottles', 'contact@supplierF.com'),
(10, 'Supplier Styling chairs', 'contact@supplierG.com'),
(11, 'Supplier Hair dryer', 'contact@supplierH.com'),
(12, 'Supplier Reception desk', 'contact@supplierI.com'),
(13, 'Supplier Apron', 'contact@supplierJ.com'),
(14, 'Supplier Gloves', 'contact@supplierK.com'),
(15, 'Supplier Towels', 'contact@supplierL.com'),
(16, 'Supplier Styling stations', 'contact@supplierM.com');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `stylist_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` int(11) NOT NULL,
  `slot_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `slot_time`) VALUES
(1, '08:00:00'),
(2, '09:00:00'),
(3, '10:00:00'),
(4, '11:00:00'),
(5, '12:00:00'),
(6, '13:00:00'),
(7, '14:00:00'),
(8, '15:00:00'),
(9, '16:00:00'),
(10, '17:00:00'),
(11, '18:00:00'),
(12, '19:00:00'),
(13, '20:00:00'),
(14, '21:00:00'),
(15, '22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `role` enum('admin','user','receptionist','stylist') NOT NULL,
  `user_password` varchar(400) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `contact_info` varchar(255) DEFAULT NULL,
  `work_schedule` text DEFAULT NULL,
  `commission_rate` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `role`, `user_password`, `created_at`, `contact_info`, `work_schedule`, `commission_rate`) VALUES
(1, 'Arbaz_ak', 'la6691684@gmail.com', 'admin', '$2y$10$9/6TSWLqLowS6OEeoHfTj.5G7dyxcgrWbuJVgJO7m95gIIkH6nMIO', '2024-06-27 23:22:24', NULL, NULL, NULL),
(9, 'ads', 'asa@gmail.com', 'admin', '$2y$10$xvmiaertxdgmj.z3LlsCTOhcAflArEXVc/H3NO6ThnLTHaAaR9QKq', '2024-06-28 10:12:07', NULL, NULL, NULL),
(12, 'Arbaazz', '1234@gmail.com', 'stylist', '$2y$10$5tcHF1Y/DHtvHddS.8j/GO/GJEXxDG7lmSXyFSKXwWPhYZtNmepT6', '2024-07-06 13:27:07', '03352864013', '8am to 10 pm', 0.06),
(13, 'aat', 'aat@gmai.com', 'user', '$2y$10$cSfOIeueYIIHcAWB5V6RFOmuBGOU8YrMNIg8JQ95jxpyDC2vt7hxa', '2024-07-06 13:27:37', NULL, NULL, NULL),
(14, 'haa', 'haa@gmail.com', 'user', '$2y$10$ByIYU673zLTqwXTM9AV4P.hyADdLMjR6ncik1tiyIZ1nwsJPKKo32', '2024-07-06 13:46:37', NULL, NULL, NULL),
(15, '3434', 'aa@gmail.com', 'user', '$2y$10$Q8O03J4BoGJtGyGmZbltHOQHEfkfOqB0NBefjI2EpcluGTx/ioqLS', '2024-07-06 13:58:46', NULL, NULL, NULL),
(16, 'aaaf', 'aaaf@gmail.com', 'user', '$2y$10$AMfRAMLhyHBzLzRHH3aEhu73NUWK1C9iX.ygo4Qt2MTE.4A4NXGXS', '2024-07-06 14:12:38', NULL, NULL, NULL),
(17, 'Numan', 'numan@gmail.com', 'stylist', '$2y$10$mkZjZ7rxXvPWxtZ3JGk3s.w5lFzBYQH34KR/sJCBQ1bJl5om9whJm', '2024-07-07 05:45:07', '03352864013', NULL, 3.00),
(18, 'arkay', 'arkay@gmail.com', 'stylist', '$2y$10$fkGVtpOUPmk525cEtsXXaOOO2c99w.jvV4FO6LeLJDL8WPdNZiCz.', '2024-07-08 03:20:30', 'dffddf', NULL, 2.00),
(19, 'arva', 'arva@gmail.com', 'user', '$2y$10$3gvSh41PNJC31GgY7TPTVesC8elYCjyf5h2oKNECBfVkY7jKZUTmW', '2024-07-08 03:22:51', NULL, NULL, NULL),
(20, 'usama', 'usama@gmail.com', 'user', '$2y$10$EXFsQYZraSlB3njcDg8KhOuoYbFTwFYD1kwxU8WGNlh4yHlLZEOkO', '2024-07-08 03:29:18', NULL, NULL, NULL),
(21, 'hamza', 'hamza@gmail.com', 'receptionist', '$2y$10$wbjoSS2a9km37wOpYyh3Vu2IwkFAwWoEkrTXGlB8AMxExmHRfZmZi', '2024-07-08 10:45:06', '03352864013', NULL, 454.00),
(23, 'zaid', 'zaid@gmail.com', 'user', '$2y$10$CKurFAD9T/uBgrxrAI81ce.W6QjbhbJy21suqORGd4ufPmXxKWMT2', '2024-07-10 10:48:14', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `time_slot_id` (`time_slot_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stylist_services`
--
ALTER TABLE `stylist_services`
  ADD PRIMARY KEY (`stylist_id`,`service_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stylist_id` (`stylist_id`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slots` (`id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`);

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`id`),
  ADD CONSTRAINT `purchase_orders_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `stylist_services`
--
ALTER TABLE `stylist_services`
  ADD CONSTRAINT `stylist_services_ibfk_1` FOREIGN KEY (`stylist_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `stylist_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`stylist_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
