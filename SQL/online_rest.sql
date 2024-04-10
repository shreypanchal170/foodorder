-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 12:02 PM
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
-- Database: `online_rest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(10, 'rushabh', 'f69869c02abc772d3650f330b9c10564', 'rushabh@gmail.com', 'rush51', '2024-03-01 12:10:44'),
(16, 'hetshah', '9ff2613b6edec2979f0e97b133e94e2d', 'hetshah', 'het123', '2024-02-23 08:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `admin_codes`
--

CREATE TABLE `admin_codes` (
  `id` int(222) NOT NULL,
  `codes` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_codes`
--

INSERT INTO `admin_codes` (`id`, `codes`) VALUES
(7, 'rush51'),
(8, 'het123');

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `d_id` int(222) NOT NULL,
  `rs_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `slogan` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`d_id`, `rs_id`, `title`, `slogan`, `price`, `img`) VALUES
(19, 54, 'Veg Cheese Burger', 'A mix veg patty with creamy cheese.', 95.00, '62711e1ae9a29.jpg'),
(20, 54, 'Tower Burger', 'A tower like burger with a lot of vegies.', 150.00, '62711f03efb46.jpg'),
(21, 54, 'Crispy Chicken Burger', 'A crisp chicken patty with mayo,', 150.00, '62710352c4816.jpg'),
(22, 54, 'Spicy Fried Chicken Burger', 'A spiced fried chicken patty with a thousand island sauce.', 190.00, '6271038fa4767.jpg'),
(23, 54, 'Potato Fries', 'Crispy potato fries.', 99.00, '627103ed36995.jpg'),
(24, 54, 'Coco Cola', 'A cool beverage', 70.00, '6271041473a9e.jpg'),
(25, 54, 'Pepsi', 'A cool beverage', 70.00, '6271042be2b8d.jpg'),
(26, 55, 'Cheezy Pasta Pizza', 'A cheezy pizza with penne pasta.', 310.00, '62710d54627fc.jpg'),
(27, 55, 'Basil Pesto Pizza', 'A unique Italian combo of cheese and basil. ', 340.00, '62710d95edba2.jpg'),
(28, 55, 'Butter Chicken Pizza', 'A Indian style pizza with rich creamy butter chicken', 370.00, '62710dd73f9e5.jpg'),
(29, 55, 'BBQ Chicken Pizza', 'A spicy barbeque sauce chicken pizza ', 375.00, '62710e1774ff7.jpg'),
(30, 55, 'Chicken Tikka Pizza', 'A tandoor chicken with tandoori mayo', 390.00, '62710e4a8ba23.jpg'),
(31, 55, 'Classic Cheese Pizza', 'A blend of cheese with soft crust.', 190.00, '62710e8b9d403.jpg'),
(32, 55, 'Coco Cola', 'A cool beverage', 70.00, '62710ea143442.jpg'),
(33, 55, 'Pepsi', 'A cool beverage', 70.00, '62710eb947ddc.jpg'),
(34, 59, 'Steamed Momos', '6 Pieces of steamed momos', 70.00, '627112ff3f747.jpg'),
(35, 59, 'Veg Fried Momos', '10 pieces of fried momos', 150.00, '627110281fac2.jpg'),
(36, 59, 'Tandori Momos', '8 pieces of tadori momos', 160.00, '627112434b949.jpg'),
(37, 59, 'Steamed Sesame Seed Momos', '6 pieces of steamed momos with sesame seeds', 130.00, '62711350df195.jpg'),
(38, 59, 'Tandori and Steamed Momos', '3 pieces of tandori and 3 pieces of steamed momos', 150.00, '6271139a4d746.jpg'),
(39, 59, 'Tiranga Momos', 'A blend of three flavors.', 200.00, '627113d214cd2.jpg'),
(42, 56, 'Manchurian Dry', 'Serves 1', 130.00, '6271144b8a8d6.jpg'),
(43, 56, 'Paneer Chilli', 'Serves 1', 160.00, '6271146852243.jpg'),
(44, 56, 'Veg Crispy', 'Serves 1', 160.00, '6271148e9aa99.jpg'),
(45, 56, 'Chinese Bhel', 'Serves 2', 210.00, '627114ad65565.jpg'),
(46, 56, 'Hakka Noodles', 'Serves 2', 220.00, '62711618a999d.jpg'),
(47, 59, 'Sehezwan Paneer Momos', '6 pieces of Sehezwan sauce momos with paneer stuffing.', 200.00, '627115946b564.jpg'),
(48, 59, 'Coke', 'A cool beverage', 69.00, '627115a8b6910.jpg'),
(49, 59, 'Pepsi', 'A cool beverage', 69.00, '627115d3a0d12.jpg'),
(50, 56, 'Fries', 'Crispy potato fries.', 89.00, '6271165783c77.jpg'),
(51, 58, 'Chole Bhature', 'Serves 2', 140.00, '627116904a142.jpg'),
(52, 58, 'Tandoori Soya Chaap', 'Serves 1', 160.00, '627116d0d40fd.jpg'),
(53, 58, 'Dal Makhani', 'Serves 2', 140.00, '627116fa360ce.jpg'),
(54, 58, 'Shahi Paneer', 'Serves 2', 140.00, '6271171b1b93d.jpg'),
(55, 58, 'Coke', 'A cool beverage', 70.00, '6271176433390.jpg'),
(56, 56, 'Coke', 'A cool beverage', 70.00, '627117758db13.jpg'),
(57, 56, 'Pepsi', 'A cool beverage', 70.00, '6271178790a65.jpg'),
(58, 58, 'Pepsi', 'A cool beverage', 70.00, '6271179a82e13.jpg'),
(59, 57, 'Cappuccino', 'Does a fresh start of day', 170.00, '62711b6788b03.jpg'),
(60, 57, 'Expresso', 'A strong Coffee without milk', 180.00, '62711b8fe4f75.jpg'),
(61, 57, 'Moka', 'A taste of chocolate in coffee', 240.00, '62711bc27b41d.jpg'),
(62, 57, 'Latte ', 'A expresso with foamed milk', 200.00, '62711bf2e7281.jpg'),
(63, 57, 'Red Frappe', 'A premium coffee taste ', 310.00, '62711c3fdf46b.jpg'),
(64, 57, 'Cold brew ', 'A cold coffee without milk', 270.00, '62711c6460643.jpg'),
(65, 57, 'Iced Coffee', 'An iced coffee with refreshing coffee', 260.00, '62711cc4dd9e9.jpg'),
(66, 57, 'New York CheeseCake', 'A blend of cake and premium cheese with smooth texture ', 350.00, '62711d0e28f86.jpg'),
(67, 57, 'Chocolate Mud Cake', 'A rich chocolate taste with overloaded chocolates', 300.00, '62711d443a819.jpg'),
(68, 57, 'Coke', 'A cool beverage', 70.00, '62711d57d5864.jpg'),
(69, 57, 'Pepsi', 'A cool beverage', 70.00, '62711d6a0e8a0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `rs_id` int(222) NOT NULL,
  `c_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `url` varchar(222) NOT NULL,
  `o_hr` varchar(222) NOT NULL,
  `c_hr` varchar(222) NOT NULL,
  `o_days` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`rs_id`, `c_id`, `title`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `image`, `date`) VALUES
(54, 11, 'Tipsy Burgers', 'tipsyburgers@gmail.com', '1212121212', 'www.tipsyburgers.com', '11am', '8pm', 'mon-sat', 'Alkapuri, near Railway Station, Vadadora, Gujarat.', '62710255ce1e8.jpg', '2022-05-03 10:22:13'),
(55, 13, 'Tom and Jerry Pizza', 'tomandjerrypizza@gmail.com', '9191919191', 'www.tomandjerrypizza.com', '11am', '8pm', 'mon-sat', 'Taksh Galaxy Mall, Waghodia char rasta, Vadadora, Gujarat.', '6271051b4ab69.jpg', '2022-05-03 10:34:03'),
(56, 12, 'Grannies Chinese', 'grannieschinese@gmail.com', '4545454544', 'www.grannieschinese.com', '11am', '8pm', 'mon-sat', 'Eva Mall, Manjalpur, Vadadora, Gujarat.', '6271059626bcc.jpg', '2022-05-03 10:36:06'),
(57, 16, 'Episode Cafe', 'episodecafe@gmail.com', '9898989898', 'www.episodecafe.com', '8am', '6pm', 'mon-sat', 'Eva Mall, Manjalpur, Vadadora, Gujarat.', '6271066dc7fc6.jpg', '2022-05-03 10:39:41'),
(58, 15, 'Taste of Delhi', 'tasteofdelhi@gmail.com', '7474747474', 'www.tasteofdelhi@gmail.com', '10am', '8pm', 'mon-sat', 'Fatehgunj, Vadadora, Gujarat.', '627106d3393aa.jpg', '2022-05-03 10:41:23'),
(59, 14, 'Momo Mami', 'momomami@gmail.com', '7878787878', 'www.momomami.com', '11am', '8pm', 'mon-fri', 'Inorbit Mall, Vadadora, Gujarat.', '627107376997b.jpg', '2022-05-03 10:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `res_category`
--

CREATE TABLE `res_category` (
  `c_id` int(222) NOT NULL,
  `c_name` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `res_category`
--

INSERT INTO `res_category` (`c_id`, `c_name`, `date`) VALUES
(11, 'Burger', '2022-05-03 10:18:00'),
(12, 'chinese', '2022-05-03 10:18:12'),
(13, 'pizza', '2022-05-03 10:18:44'),
(14, 'momos', '2022-05-03 10:18:55'),
(15, 'punjabi', '2022-05-03 10:19:00'),
(16, 'coffee', '2022-05-03 10:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `status` int(222) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`) VALUES
(34, 'hetshah', 'het', 'shah', 'het@gmail.com', '8888888888', '9ff2613b6edec2979f0e97b133e94e2d', 'parul university waghodia road', 1, '2024-02-21 12:52:09'),
(35, 'rushabh', 'shah', 'rushabh', 'admin@gmail.com', '07698091969', 'f69869c02abc772d3650f330b9c10564', 'Parul university Waghodiya Road', 1, '2024-03-02 17:17:02'),
(36, 'kingblackadam23@gmail.com', 'shah', 'kashyap', 'kingblackadam23@gmail.com', '9979483378', '96280ae3e67b3677ee21be415720dad5', 'Arth consultancy waghodiya road', 1, '2024-03-02 04:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

CREATE TABLE `users_orders` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `status` enum('dispatch','on_way','delivered','rejected') NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `title`, `quantity`, `price`, `instruction`, `status`, `date`) VALUES
(197, 35, 'Cheezy Pasta Pizza', 1, 310.00, 'testing of order \r\nrushabh and het ', 'delivered', '2024-03-07 09:26:31'),
(198, 35, 'Sehezwan Paneer Momos', 1, 200.00, 'testing of rushabh and het payment', 'rejected', '2024-03-07 09:26:28'),
(199, 35, 'Chicken Tikka Pizza', 1, 390.00, 'payid testing ', 'dispatch', '2024-03-07 09:55:28'),
(200, 35, 'Dal Makhani', 1, 140.00, 'testttttting payment id insert ', 'dispatch', '2024-03-07 09:58:18'),
(201, 0, '', 0, 0.00, '', 'dispatch', '2024-03-07 09:59:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `admin_codes`
--
ALTER TABLE `admin_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`rs_id`);

--
-- Indexes for table `res_category`
--
ALTER TABLE `res_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `admin_codes`
--
ALTER TABLE `admin_codes`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `d_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `rs_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `res_category`
--
ALTER TABLE `res_category`
  MODIFY `c_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
