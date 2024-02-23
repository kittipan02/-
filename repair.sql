-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 03:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repair`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
(1, '-'),
(2, '-'),
(3, '-'),
(4, '-'),
(5, '-'),
(6, '-'),
(7, '-'),
(8, '-'),
(9, '-'),
(10, '-'),
(11, '-'),
(12, '-'),
(13, '-'),
(14, '-'),
(15, '-'),
(16, '-'),
(17, ''),
(18, '-'),
(19, '-'),
(20, '-'),
(21, '-'),
(22, '-'),
(23, '-'),
(24, '-'),
(25, 'dell'),
(26, 'dell');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dp_id` int(11) NOT NULL,
  `dp_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dp_id`, `dp_name`) VALUES
(1, 'สำนักปลัด อบจ.'),
(2, 'สำนักงานเลขานุการ อบจ.'),
(3, 'กองคลัง'),
(4, 'กองช่าง'),
(5, 'กองสาธารณสุข'),
(6, 'กองยุทธศาสตร์และงบประมาณ'),
(7, 'กองการศึกษา ศาสนาและวัฒนธรรม'),
(8, 'กองสวัสดิการสังคม'),
(9, 'กองการเจ้าหน้าที่'),
(10, 'กองพัสดุและทรัพย์สิน'),
(11, 'หน่วยตรวจสอบภายใน');

-- --------------------------------------------------------

--
-- Table structure for table `detail_material`
--

CREATE TABLE `detail_material` (
  `dm_id` int(11) NOT NULL,
  `dm_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_material`
--

INSERT INTO `detail_material` (`dm_id`, `dm_name`) VALUES
(1, 'วัสดุคงทน'),
(2, 'วัสดุสิ้นเปลือง'),
(3, 'วัสดุอุปกรณ์ประกอบและอะไหล่');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_parcels`
--

CREATE TABLE `equipment_parcels` (
  `parcel_id` int(11) NOT NULL,
  `ep_et_id` int(11) NOT NULL,
  `office` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `delivery_note` varchar(255) DEFAULT NULL,
  `sequence_number` varchar(255) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `frame_number` varchar(255) DEFAULT NULL,
  `registration_number` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `other_details` text DEFAULT NULL,
  `warranty_expiration_date` date DEFAULT NULL,
  `warranty_company` varchar(255) DEFAULT NULL,
  `warranty_date` date DEFAULT NULL,
  `acquisition_source` varchar(255) DEFAULT NULL,
  `purchase_contract_date` date DEFAULT NULL,
  `budget_used_by` varchar(255) DEFAULT NULL,
  `year1_percentage` decimal(5,2) DEFAULT NULL,
  `year1_remaining_price` decimal(10,2) DEFAULT NULL,
  `year2_percentage` decimal(5,2) DEFAULT NULL,
  `year2_remaining_price` decimal(10,2) DEFAULT NULL,
  `year3_percentage` decimal(5,2) DEFAULT NULL,
  `year3_remaining_price` decimal(10,2) DEFAULT NULL,
  `year4_percentage` decimal(5,2) DEFAULT NULL,
  `year4_remaining_price` decimal(10,2) DEFAULT NULL,
  `year5_percentage` decimal(5,2) DEFAULT NULL,
  `year5_remaining_price` decimal(10,2) DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `sale_method` varchar(255) DEFAULT NULL,
  `approval_document_number` varchar(255) DEFAULT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `profit_loss` decimal(10,2) DEFAULT NULL,
  `fiscal_year` varchar(4) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `head_of_department_id` int(11) NOT NULL,
  `year0` varchar(4) DEFAULT NULL,
  `item_list` text DEFAULT NULL,
  `monthly_or_annual_benefit` text DEFAULT NULL,
  `fiscal_year1` varchar(4) DEFAULT NULL,
  `dp_name1` varchar(255) DEFAULT NULL,
  `user_name1` varchar(255) DEFAULT NULL,
  `head_of_department1` int(11) DEFAULT NULL,
  `fiscal_year2` varchar(4) DEFAULT NULL,
  `dp_name2` varchar(255) DEFAULT NULL,
  `user_name2` varchar(255) DEFAULT NULL,
  `head_of_department2` int(11) DEFAULT NULL,
  `fiscal_year3` varchar(4) DEFAULT NULL,
  `dp_name3` varchar(255) DEFAULT NULL,
  `user_name3` varchar(255) DEFAULT NULL,
  `head_of_department3` int(11) DEFAULT NULL,
  `fiscal_year4` varchar(4) DEFAULT NULL,
  `dp_name4` varchar(255) DEFAULT NULL,
  `user_name4` varchar(255) DEFAULT NULL,
  `head_of_department4` int(11) DEFAULT NULL,
  `fiscal_year5` varchar(4) DEFAULT NULL,
  `dp_name5` varchar(255) DEFAULT NULL,
  `user_name5` varchar(255) DEFAULT NULL,
  `head_of_department5` int(11) DEFAULT NULL,
  `fiscal_year6` varchar(4) DEFAULT NULL,
  `dp_name6` varchar(255) DEFAULT NULL,
  `user_name6` varchar(255) DEFAULT NULL,
  `head_of_department6` int(11) DEFAULT NULL,
  `year01` varchar(4) DEFAULT NULL,
  `item_list01` text DEFAULT NULL,
  `monthly_or_annual_benefit01` text DEFAULT NULL,
  `year02` varchar(4) DEFAULT NULL,
  `item_list02` text DEFAULT NULL,
  `monthly_or_annual_benefit02` text DEFAULT NULL,
  `year03` varchar(4) DEFAULT NULL,
  `item_list03` text DEFAULT NULL,
  `monthly_or_annual_benefit03` text DEFAULT NULL,
  `year04` varchar(4) DEFAULT NULL,
  `item_list04` text DEFAULT NULL,
  `monthly_or_annual_benefit04` text DEFAULT NULL,
  `year05` varchar(4) DEFAULT NULL,
  `item_list05` text DEFAULT NULL,
  `monthly_or_annual_benefit05` text DEFAULT NULL,
  `year06` varchar(4) DEFAULT NULL,
  `item_list06` text DEFAULT NULL,
  `monthly_or_annual_benefit06` text DEFAULT NULL,
  `year07` varchar(4) DEFAULT NULL,
  `item_list07` text DEFAULT NULL,
  `monthly_or_annual_benefit07` text DEFAULT NULL,
  `ep_un_id` int(11) DEFAULT NULL,
  `ep_brand_id` varchar(200) NOT NULL,
  `ep_et_number` varchar(255) DEFAULT NULL,
  `ep_it_name` varchar(255) DEFAULT NULL,
  `ep_itd_price` decimal(10,2) DEFAULT NULL,
  `ep_itd_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment_parcels`
--

INSERT INTO `equipment_parcels` (`parcel_id`, `ep_et_id`, `office`, `district`, `province`, `delivery_note`, `sequence_number`, `serial_number`, `frame_number`, `registration_number`, `color`, `other_details`, `warranty_expiration_date`, `warranty_company`, `warranty_date`, `acquisition_source`, `purchase_contract_date`, `budget_used_by`, `year1_percentage`, `year1_remaining_price`, `year2_percentage`, `year2_remaining_price`, `year3_percentage`, `year3_remaining_price`, `year4_percentage`, `year4_remaining_price`, `year5_percentage`, `year5_remaining_price`, `sale_date`, `sale_method`, `approval_document_number`, `sale_price`, `profit_loss`, `fiscal_year`, `department_id`, `user_name`, `head_of_department_id`, `year0`, `item_list`, `monthly_or_annual_benefit`, `fiscal_year1`, `dp_name1`, `user_name1`, `head_of_department1`, `fiscal_year2`, `dp_name2`, `user_name2`, `head_of_department2`, `fiscal_year3`, `dp_name3`, `user_name3`, `head_of_department3`, `fiscal_year4`, `dp_name4`, `user_name4`, `head_of_department4`, `fiscal_year5`, `dp_name5`, `user_name5`, `head_of_department5`, `fiscal_year6`, `dp_name6`, `user_name6`, `head_of_department6`, `year01`, `item_list01`, `monthly_or_annual_benefit01`, `year02`, `item_list02`, `monthly_or_annual_benefit02`, `year03`, `item_list03`, `monthly_or_annual_benefit03`, `year04`, `item_list04`, `monthly_or_annual_benefit04`, `year05`, `item_list05`, `monthly_or_annual_benefit05`, `year06`, `item_list06`, `monthly_or_annual_benefit06`, `year07`, `item_list07`, `monthly_or_annual_benefit07`, `ep_un_id`, `ep_brand_id`, `ep_et_number`, `ep_it_name`, `ep_itd_price`, `ep_itd_image`) VALUES
(9, 44, 'อบจ. จันทบุรี', 'เมืองจันทบุรี', 'จันทบุรี', 'IV 661200002', 'ชุดที่ 1 ขนาดไม่ต่ำกว่า 200 แรงมัค', 'ชุดที่ 2 ขนาดไม่ต่ำกว่า 300 แรงมัค', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'บ.นิกเจอร์ ไลช์ โซลูชัน จำกัด', '2566-12-22', 'อบจ.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2567', 4, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '-', '055660060', 'ชุดสูบส่งน้ำ', NULL, ''),
(10, 43, 'อบจ. จันทบุรี', 'เมืองจันทบุรี', 'จันทบุรี', 'IV 661200002', 'ชุดที่ 1 ขนาดไม่ต่ำกว่า 200 แรงมัค', 'ชุดที่ 2 ขนาดไม่ต่ำกว่า 300 แรงมัค', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'บ.นิกเจอร์ ไลช์ โซลูชัน จำกัด', NULL, 'อบจ.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2567', 4, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '-', '055660059', 'ชุดสูบส่งน้ำ', 9870200.00, ''),
(11, 45, 'อบจ. จันทบุรี', 'เมืองจันทบุรี', 'จันทบุรี', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'บ.จิโนเวชั่น จำกัด(สำนักงานใหญ่)', '2564-12-26', 'บริจาค(สภากาชาดไทย)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2566', 5, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 'PHLIPH', '309620051', 'เครื่องกระตุกหัวใจไฟฟ้าอัติโนมัติ(AED)', 35000.00, ''),
(12, 46, 'อบจ. จันทบุรี', 'เมืองจันทบุรี', 'จันทบุรี', '29/66.', NULL, 'V2403-BNQ 2984', NULL, 'ถข 217 จันทบุรี', 'สีเหลือง', 'S/N 001750', NULL, NULL, NULL, 'บ.บีเถียน จำกัด', '2566-12-19', 'เงินงบประมาณ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2567', 4, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 'SINGTHAI', '020660011', 'เครื่องบด(สั่นสะเทือนด้วยระบบไฮดรอลิค)', 2120000.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_type`
--

CREATE TABLE `equipment_type` (
  `et_id` int(11) NOT NULL,
  `et_number` varchar(255) NOT NULL,
  `et_name` varchar(255) NOT NULL,
  `it_name` varchar(255) NOT NULL,
  `itd_name` varchar(255) NOT NULL,
  `un_id` int(11) DEFAULT NULL,
  `itd_price` varchar(255) NOT NULL,
  `itd_image` varchar(255) NOT NULL,
  `brand_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment_type`
--

INSERT INTO `equipment_type` (`et_id`, `et_number`, `et_name`, `it_name`, `itd_name`, `un_id`, `itd_price`, `itd_image`, `brand_name`) VALUES
(43, '055660059', 'ครุภัณฑ์การเกษตร', 'ชุดสูบส่งน้ำ', 'เครื่องนยนต์ดีเซล', 7, '9870200.00', '../upload_files/uploads/', '-'),
(44, '0556600590', 'ครุภัณฑ์การเกษตร', 'ชุดสูบส่งน้ำ', 'เครื่องนยนต์ดีเซล', 7, 'ราคารวมกับ(055 66 0059)', '../upload_files/uploads/', '-'),
(45, '309620051', '	ครุภัณฑ์วิทยาศาสตร์และการแพทย์', 'เครื่องกระตุกหัวใจไฟฟ้าอัติโนมัติ(AED)', 'รุ่น HERART START FRx', 7, '35000.00', '../upload_files/uploads/AED.jpg', 'PHILIPS'),
(46, '020660011', 'ครุภัณฑ์ก่อสร้าง', 'เครื่องบด(สั่นสะเทือนด้วยระบบไฮดรอลิค)', 'รุ่น TUV-3T', 7, '2120000', '../upload_files/uploads/', 'SINGTHAI'),
(47, '055', 'ครุภัณฑ์การเกษตรป', 'ชุดสูบส่งน้ำ', 'เครื่องนยนต์ดีเซล', 7, '9870200.00', '../upload_files/uploads/โปสเตอร์ระบบพัสดุครุภัณฑ์และการแจ้งซ่อม (1).png', 'เำก');

-- --------------------------------------------------------

--
-- Table structure for table `headofdepartment`
--

CREATE TABLE `headofdepartment` (
  `head_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `headofdepartment`
--

INSERT INTO `headofdepartment` (`head_id`, `department_id`, `first_name`, `last_name`, `position`) VALUES
(1, 1, 'นางสาววรรณา ', 'บุญส่ง', 'หัวหน้าสำนักปลัด'),
(2, 2, 'นางสาวสุกัญญา', 'อินทาภรณ์', 'เลขานุการ'),
(3, 3, 'นางชัชนิตย์', 'ดีวิเศษ', 'ผู้อำนวยการกองคลัง'),
(4, 4, 'นายสายชล', 'ชะนา', 'ผู้อำนวยการกองช่าง'),
(5, 5, 'นางสาวสุกัญญา ', 'อินทาภรณ์', 'รักษาราชการแทนผู้อำนวยการกองสาธารณสุข'),
(6, 6, 'นางเกษรา', 'ศรีไชย', 'ผู้อำนวยการกองยุทธศาสตร์และงบประมาณ'),
(7, 7, 'นางสาวพัณณ์ชุดา', 'ใจดำ', 'รักษาราชการแทนผู้อำนวยการกองการศึกษา ศาสนาและวัฒนธรรม'),
(8, 8, 'จ่าเอกสงวนศักดิ์', 'จิตต์สงวน', 'รักษาราชการแทนผู้อำนวยการกองสวัสดิการสังคม'),
(9, 9, 'นางสาวสุกัญญา', 'อินทาภรณ์', 'รักษาราชการแทนผู้อำนวยการกองการเจ้าหน้าที่'),
(10, 10, 'นางอัญชลี', 'ขจรชีพ', 'รักษาราชการแทนผู้อำนวยการกองพัสดุและทรัพย์สิน'),
(11, 11, 'นายณรงค์ศักดิ์', 'เพ็ชรกำจัด', 'รักษาราชการแทนปลัด');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `mt_id` int(11) NOT NULL,
  `mt_tm_id` int(11) NOT NULL,
  `mt_dm_id` int(11) NOT NULL,
  `mt_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`mt_id`, `mt_tm_id`, `mt_dm_id`, `mt_name`) VALUES
(14, 1, 1, 'หนังสือ'),
(15, 1, 1, 'เครื่องคิดเลขขนาดเล็ก'),
(17, 1, 1, 'เครื่องเจาะกระดาษขนาดเล็ก'),
(18, 1, 1, 'ที่เย็บกระดาษขนาดเล็ก'),
(19, 1, 1, 'ไม้บรรทัดเหล็ก'),
(20, 1, 1, 'กรรไกร'),
(21, 1, 1, 'เก้าอี้พลาสติก'),
(22, 1, 1, 'ตรายาง'),
(23, 1, 1, 'ที่ถูกพื้น'),
(24, 1, 1, 'ตะแกรงวางเอกสาร'),
(25, 1, 1, 'เครื่องตัดโฟม'),
(26, 1, 1, 'เครื่องตัดกระดาษ'),
(27, 1, 1, 'เครื่องเย็บกระดาษ'),
(28, 1, 1, 'กุญแจ'),
(29, 1, 1, 'ภาพเขียน,แผนที่'),
(30, 1, 1, 'พระบรมฉายาลักษณ์'),
(31, 1, 1, 'แผงปิดประกาศ'),
(32, 1, 1, 'แผ่นป้ายชื่อสำนักงาน'),
(33, 1, 1, 'มู่ลี่ , ม่านปรับแสง (ต่อแผ่น)'),
(34, 1, 1, 'พรม (ต่อผืน)'),
(35, 1, 1, 'นาฬิกาตั้งหรือแขวน'),
(36, 1, 1, 'พระพุทธรูป'),
(37, 1, 1, 'พระบรมรูปจำลอง'),
(38, 1, 1, 'กระเป๋า'),
(39, 1, 1, 'ตาชั่งขนาดเล็ก'),
(40, 1, 1, 'ผ้าใบติดตั้งในสำนักงาน'),
(41, 1, 1, 'ผ้าใบเต้นท์ขนาดใหญ่'),
(42, 1, 1, 'ตู้ยาสามัญประจำบ้าน'),
(43, 1, 1, 'แผงกันห้องแบบรื้อถอนได้ (Partiton)'),
(44, 1, 2, 'กระดาษ'),
(45, 1, 2, 'หมึก'),
(46, 1, 2, 'ดินสอ'),
(47, 1, 2, 'ปากกา'),
(48, 1, 2, 'ยางลบ'),
(49, 1, 2, 'น้ำยาลบคำผิด'),
(50, 1, 2, 'เทปกาว'),
(51, 1, 2, 'ลวดเย็บกระดาษ'),
(52, 1, 2, 'กาว'),
(53, 1, 2, 'สมุด'),
(54, 1, 2, 'ซองเอกสาร'),
(55, 1, 2, 'ตลับผงหมึก'),
(56, 1, 2, 'น้ำหมึกปริ้นท์'),
(57, 1, 2, 'เทป พี วี ซี แบบใส'),
(58, 1, 2, 'น้ำยาลบกระดาษไข'),
(59, 1, 2, 'ไม้บรรทัด'),
(60, 1, 2, 'คลิป'),
(61, 1, 2, 'ตัวเย็บกระดาษ'),
(62, 1, 2, 'เข็มหมุด'),
(63, 1, 2, 'กระดาษคาร์บอน'),
(64, 1, 2, 'กระดาษไข'),
(65, 1, 2, 'แฟ้ม'),
(66, 1, 2, 'สมุดบัญชี'),
(67, 1, 2, 'สมุดประวัติข้าราชการ'),
(68, 1, 2, 'แบบพิมพ์'),
(69, 1, 2, 'ผ้าสำลี'),
(70, 1, 2, 'ธงชาติ'),
(71, 1, 2, 'สิ่งพิมพ์ที่ได้จากการซื้อ'),
(72, 1, 2, 'ของใช้ในการบรรจุหีบห่อ'),
(73, 1, 1, 'น้ำมัน ไข ผึ้ง'),
(74, 1, 2, 'น้ำดื่มสำหรับบริการประชาชนในสำนักงาน'),
(75, 1, 2, 'พวงมาลัย'),
(76, 1, 1, 'พวงมาลา'),
(77, 1, 1, 'พานพุ่ม'),
(78, 1, 1, 'กรวยดอกไม้'),
(79, 2, 1, 'ไมโครโฟน'),
(80, 2, 1, 'ขาตั้งไมโครโฟน'),
(81, 2, 1, 'หัวแร้งไฟฟ้า'),
(82, 2, 1, 'เครื่องวัดกระแสไฟฟ้า'),
(83, 2, 1, 'เครื่องวัดแรงดันไฟฟ้า'),
(84, 2, 1, 'มาตรสำหรับตรวจวงจรไฟฟ้า'),
(85, 2, 1, 'เครื่องประจุไฟ'),
(86, 2, 1, 'โทรโข่ง'),
(87, 2, 1, 'ไม้ชักฟิวส์'),
(88, 2, 1, 'ไมค์ลอยพร้อมเครื่องส่งสัญญาณ'),
(89, 2, 2, 'ฟิวส์'),
(90, 2, 2, 'เทปพันสายไฟฟ้า'),
(91, 2, 2, 'สายไฟฟ้า'),
(92, 1, 2, 'เข็มขัดรัดสายไฟฟ้า'),
(93, 2, 2, 'ปลั๊คไฟฟ้า'),
(94, 2, 2, 'สวิตซ์ไฟฟ้า'),
(95, 2, 2, 'หลอดวิทยุทรานซิตเตอร์และชิ้นส่วนวิทยุ'),
(96, 2, 2, 'ลูกถ้วยสายอากาศ'),
(97, 2, 2, 'รีซีสเตอร์'),
(98, 2, 2, 'มูฟวิ่งคอยส์คอนเดนเซอร์'),
(99, 2, 2, 'ขาหลอดฟลูออเรสเซนซ์'),
(100, 2, 2, 'เบรกเกอร์'),
(101, 2, 2, 'สายอากาศ หรือ เสาอากาศสำหรับวิทยุ , เครื่องรับโทรศัพน์ , จานรับสัญญาณดาวเทียม'),
(102, 2, 2, 'แบตเตอร์โซล่าเซลล์'),
(103, 2, 2, 'กล่องรับสัญญาณ'),
(104, 2, 3, 'ดอกลำโพง'),
(105, 2, 3, 'ฮอร์นลำโพง'),
(106, 2, 3, 'แผนวงจร'),
(107, 2, 3, 'ผังแสดงวงจรต่างๆ'),
(108, 2, 3, 'แผนบังคับทางไฟ'),
(109, 3, 1, 'หม้อ'),
(110, 3, 1, 'กระทะ'),
(111, 3, 1, 'กะละมัง'),
(112, 3, 1, 'ตะหลิว'),
(113, 3, 1, 'กรอบรูป'),
(114, 3, 1, 'มีด'),
(115, 3, 1, 'ถัง'),
(116, 3, 1, 'ถาด'),
(117, 3, 1, 'แก้วน้ำ'),
(118, 3, 1, 'แก้วน้ำ'),
(119, 3, 1, 'จานรอง'),
(120, 3, 1, 'ถ้วยชาม'),
(121, 3, 1, 'ช้อนส้อม'),
(122, 3, 1, 'กระจกเงา'),
(123, 3, 1, 'โอ่งน้ำ'),
(124, 3, 1, 'ที่นอน'),
(125, 3, 1, 'กระโถน'),
(126, 3, 1, 'เตาไฟฟ้า'),
(127, 3, 1, 'เตาน้ำมัน'),
(128, 3, 1, 'เตารีด'),
(129, 3, 1, 'เครื่องตีไข่ไฟฟ้า'),
(130, 3, 1, 'เครื่องปิ้งขนมปัง'),
(131, 3, 1, 'กระทะไฟฟ้า'),
(132, 3, 1, 'หม้อไฟฟ้า รวมถึง หม้อหุงข้าวไฟฟ้า'),
(133, 3, 1, 'กระติกน้ำร้อน'),
(134, 3, 1, 'กระติกน้ำแข็ง'),
(135, 3, 1, 'ถังแก๊ส'),
(136, 3, 1, 'เตา'),
(137, 3, 1, 'ตู้เก็บอุปกรณ์ดับเพลิง'),
(138, 3, 1, 'สายยางฉีดน้ำ'),
(139, 3, 1, 'ถังขยะแบบล้อลาก'),
(140, 3, 1, 'อ่างล้างจาน'),
(141, 3, 1, 'ถังน้ำ'),
(142, 3, 2, 'ไม้กวาด'),
(143, 3, 2, 'เข่ง'),
(144, 3, 2, 'มุ้ง'),
(145, 3, 2, 'ผ้าปูที่นอน'),
(146, 3, 2, 'ปลอกหมอน'),
(147, 3, 2, 'หมอน'),
(148, 3, 2, 'ผ้าห่ม'),
(149, 3, 2, 'ผ้าปูโต๊ะ'),
(150, 3, 2, 'น้ำจืดที่ซื้อจากเอกชน'),
(151, 3, 2, 'หัวดูดตะกอนสระว่ายน้ำ'),
(152, 3, 2, 'อาหารเสริม (นม)'),
(153, 3, 2, 'วัสดุประกอบอาหาร'),
(154, 3, 2, 'อาหารสำเร็จรูป'),
(155, 4, 1, 'ไม้ต่างๆ'),
(156, 4, 1, 'ค้อน'),
(157, 4, 1, 'คีม'),
(158, 4, 1, 'ชะแลง'),
(159, 4, 1, 'จอบ'),
(160, 4, 1, 'สิ่ว'),
(161, 4, 1, 'เสียม'),
(162, 4, 1, 'เลื่อย'),
(163, 4, 1, 'ขวาน'),
(164, 4, 1, 'กบไสไม้'),
(165, 4, 1, 'เทปวัดระยะ'),
(166, 4, 1, 'เครื่องวัดขนาดเล็ก เช่น ตลับเมตร ลูกดิ่ง'),
(167, 4, 1, 'สว่านมือ'),
(168, 4, 1, 'โถส้วม'),
(169, 4, 1, 'อ่างล้างมือ'),
(170, 4, 1, 'ราวพาดผ้า'),
(171, 4, 1, 'หน้ากากใส่เชื่อมเหล็ก'),
(172, 4, 1, 'เครื่องยิงตะปู'),
(173, 4, 1, 'นั่งร้าน'),
(174, 4, 2, 'น้ำมันทาไม้'),
(175, 4, 2, 'ทินเนอร์'),
(176, 4, 2, 'สี'),
(177, 4, 2, 'ปูนซีเมนต์'),
(178, 4, 2, 'ทราย'),
(179, 4, 2, 'ยางมะตอยสำเร็จรูป'),
(180, 4, 2, 'อิฐหรือซีเมนต์บล็อก'),
(181, 4, 2, 'กระเบื้อง'),
(182, 4, 2, 'สังกะสี'),
(183, 4, 2, 'ตะปู'),
(184, 4, 2, 'เหล็กเส้น'),
(185, 4, 2, 'แปรงทาสี'),
(186, 4, 2, 'ปูนขาว'),
(187, 4, 2, 'แผ่นดินเหนียวสังเคราะห์'),
(188, 4, 3, 'ท่อน้ำและอุปกรณ์ประปา'),
(189, 4, 3, 'ท่อต่างๆ'),
(190, 4, 3, 'ท่อน้ำบาดาล'),
(191, 5, 1, 'ไขควง'),
(192, 5, 1, 'ประแจ'),
(193, 5, 1, 'แม่แรง'),
(194, 5, 1, 'กุญแจปากตาย'),
(195, 5, 1, 'กุญแจเลื่อน'),
(196, 6, 1, 'คีมล็อก'),
(197, 5, 1, 'ล็อกเกียร์'),
(198, 5, 1, 'ล็อคคลัตช์'),
(199, 5, 1, 'ล็อคพวงมาลัย'),
(200, 5, 2, 'ยางรถยนต์'),
(201, 5, 2, 'น้ำมันเบรก'),
(202, 5, 2, 'น๊อตและสกรู'),
(203, 5, 2, 'สายไมล์'),
(204, 5, 2, 'เพลา'),
(205, 5, 2, 'ฟิล์มกรองแสง'),
(206, 5, 2, 'น้ำกลั่น'),
(207, 5, 3, 'เบาะรถยนต์'),
(208, 5, 3, 'เครื่องยนต์ (อะไหล่)'),
(209, 5, 3, 'ชุดเกียร์รถยนต์'),
(210, 5, 3, 'เบรก'),
(211, 5, 3, 'ครัช'),
(212, 5, 3, 'พวงมาลัย'),
(213, 5, 3, 'สายพานใบพัด'),
(214, 5, 3, 'หม้อน้ำ'),
(215, 5, 3, 'หัวเทียน'),
(216, 5, 3, 'แบตเตอรี่'),
(217, 5, 3, 'จานจ่าย'),
(218, 5, 3, 'ล้อ'),
(219, 5, 3, 'ถังน้ำมัน'),
(220, 5, 3, 'ไฟหน้า'),
(221, 5, 3, 'ไฟเบรก'),
(222, 5, 3, 'อานจักรยาน'),
(223, 5, 3, 'ตลับลูกปืน'),
(224, 5, 3, 'กระจกมองข้างรถยนต์'),
(225, 5, 3, 'กันชนรถยนต์'),
(226, 5, 3, 'เข็มขัดนิรภัย'),
(227, 5, 3, 'สายไฮดรอลิค'),
(228, 6, 2, 'แก๊สหุงต้ม'),
(229, 6, 2, 'น้ำมันเชื้อเพลิง'),
(230, 6, 2, 'น้ำมันดีเซล'),
(231, 6, 2, 'น้ำมันก๊าด'),
(232, 6, 2, 'น้ำมันเบนซิน'),
(233, 6, 2, 'น้ำมันเตา'),
(234, 6, 2, 'น้ำมันจารบี'),
(235, 6, 2, 'น้ำมันเครื่อง'),
(236, 6, 2, 'ถ่าน'),
(237, 6, 2, 'ก๊าซ'),
(238, 6, 2, 'น้ำมันเกียร์'),
(239, 6, 2, 'น้ำมันหล่อลื่น'),
(240, 7, 1, 'ชุดเครื่องมือผ่าตัด'),
(241, 7, 1, 'ที่วางกรวยแก้ว'),
(242, 7, 1, 'กระบองตวง'),
(243, 7, 1, 'เบ้าหลวม'),
(244, 7, 1, 'หูงฟัง (Stethoscope)'),
(245, 7, 1, 'เปลหามคนไข้'),
(246, 7, 1, 'คีมถอนฟัน'),
(247, 7, 1, 'เครื่องวัดน้ำฝน'),
(248, 7, 1, 'ถังเก็บเชื้อเพลิง'),
(249, 7, 1, 'เครื่องนึ่ง'),
(250, 7, 1, 'เครื่องมือวิทยาศาสตร์'),
(251, 7, 1, 'เครื่องวัดอุณหภูมิ (ปรอทวัดไข้)'),
(252, 7, 2, 'สำลี และผ้าพันแผล'),
(253, 7, 2, 'ยาและเวชภัณฑ์'),
(254, 7, 2, 'แอลกอฮอล์'),
(255, 7, 2, 'ฟิล์มเอ็กซเรย์'),
(256, 7, 2, 'เคมีภัณฑ์'),
(257, 7, 2, 'ออกซิเจน'),
(258, 7, 2, 'น้ำยาต่างๆ'),
(259, 7, 2, 'เลือด'),
(260, 7, 2, 'สายยาง'),
(261, 7, 2, 'หลอดแก้ว'),
(262, 7, 2, 'ลวดเชื่อมเงิน'),
(263, 7, 2, 'ถุงมือ'),
(264, 7, 2, 'กระดาษกรอง'),
(265, 7, 2, 'จุกต่างๆ'),
(266, 7, 2, 'สัตว์เลี้ยงเพื่อการทดลองวิทยาศาสตร์หรือการแพทย์'),
(267, 7, 2, 'หลอดเอกซเรย์'),
(268, 7, 2, 'ทรายอะเบท'),
(269, 7, 2, 'น้ำยาพ่นหมอก ควันกำจัดยุง'),
(270, 7, 2, 'คลอรีน สารส้ม'),
(271, 7, 2, 'หน้ากากอนามัย'),
(272, 7, 2, 'ชุดป้องกันเชื้อโรค (แบบใช้ครั้งเดียวทิ้ง)'),
(273, 8, 1, 'เคียว'),
(274, 8, 1, 'สปริงเกลอร์ (Spinkler)'),
(275, 8, 1, 'จอบหมุน'),
(276, 8, 1, 'จานพรวน'),
(277, 8, 1, 'ผานไถกระทะ'),
(278, 8, 1, 'คราดซี่พรวนดินระหว่างแถว'),
(279, 8, 1, 'เครื่องดักแมลง'),
(280, 8, 1, 'ตะแกรงร่องเบนโธส'),
(281, 8, 1, 'อวน (สำเร็จรูป)'),
(282, 8, 1, 'กระชัง'),
(283, 8, 1, 'มีดตัดต้นไม้'),
(284, 8, 2, 'ปุ๋ย'),
(285, 8, 2, 'ยาป้องกันและกำจัดศัตรูพืชและสัตว์'),
(286, 8, 2, 'อาหารสัตว์'),
(287, 8, 2, 'พืชและสัตว์'),
(288, 8, 2, 'พันธุ์สัตว์ปีกและสัตว์น้ำ'),
(289, 8, 2, 'น้ำเชื้อพันธุ์สัตว์'),
(290, 8, 2, 'วัสดุเพาะชำ'),
(291, 8, 2, 'อุปกรณ์ในการขยายพันธุ์พืช เช่น ใบมีด เชือก'),
(292, 8, 2, 'ผ้าใบหรือผ้าพลาสติก'),
(293, 8, 2, 'หน้ากากป้องกันแก๊สพิษ'),
(294, 8, 3, 'หัวกะโหลกดูดน้ำ'),
(295, 9, 1, 'ขาตั้งกล้อง'),
(296, 9, 1, 'ขาตั้งเขียนภาพ'),
(297, 9, 1, 'กล่องและระวิงใส่ฟิล์มภาพยนตร์'),
(298, 9, 1, 'เครื่องกรอเทป'),
(299, 9, 1, 'เลนส์ซูม'),
(300, 9, 1, 'กระเป๋าใส่กล้องถ่ายรูป'),
(301, 9, 1, 'ป้ายไฟแจ้งเตือนแบบล้อลาก'),
(302, 9, 1, 'ป้ายประชาสัมพันธ์'),
(303, 9, 2, 'พู่กัน'),
(304, 9, 2, 'สี'),
(305, 9, 2, 'กระดาษเขียนโปสเตอร์'),
(306, 9, 2, 'ฟิล์ม'),
(307, 9, 2, 'เมมโมรี่การ์ด'),
(308, 9, 2, 'ฟิล์มสไลด์'),
(309, 9, 2, 'แถบบันทึกเสียงหรือภาพ (ภาพยนตร์,วีดีโอเทป,แผ่นซีดี)'),
(310, 9, 2, 'รูปสีหรือขาวดำที่ได้จากการล้าง อัดขยาย'),
(311, 9, 2, 'ภาพถ่ายดาวเทียม'),
(312, 9, 2, 'เอกสารเผยแพร่ผลการดำเนินงาน'),
(313, 10, 1, 'เครื่องแบบ/ชุดปฏิบัติงาน'),
(314, 10, 1, 'เสื้อ กางเกง ผ้า'),
(315, 10, 1, 'เครื่องหมายต่างๆ'),
(316, 10, 1, 'ถุงเท้า/ถุงมือ'),
(317, 10, 1, 'รองเท้า'),
(318, 10, 1, 'รองเท้า'),
(319, 10, 1, 'เข็ดขัด'),
(320, 10, 1, 'หมวก'),
(321, 10, 1, 'ผ้าผูกคอ'),
(322, 10, 1, 'เสื้อสะท้อนแสง'),
(323, 10, 1, 'เสื้อชูชีพ'),
(324, 10, 1, 'ชัดดับเพลิงรวมถึงชนิดกันไฟ (ไม่รวมถังออกซิเจน)'),
(325, 10, 1, 'ชุดประดาน้ำ(ไม่รวมถังออกซิเจน)'),
(326, 10, 1, 'เครื่องแต่งกายสำหรับกวาดถนน/ล้างท่อใส่สารเคมี'),
(327, 10, 1, 'เครื่องแต่งกายของผู้ปฏิบัติงานในโรงพยาบาล/ศูนย์บริการสาธารณสุข'),
(328, 10, 1, 'ชุดนาฏศิลป์'),
(329, 10, 1, 'ชุดดุริยางค์'),
(330, 10, 2, 'วุฒิบัตร อปพร'),
(331, 10, 2, 'บัตรประจำ อปพร'),
(332, 10, 2, 'เข็มเครื่องหมาย อปพร'),
(333, 11, 1, 'ห่วงยาง'),
(334, 11, 1, 'ไม้ตีปิงปอง'),
(335, 11, 1, 'ไม้แบดมินตัน'),
(336, 11, 1, 'ไม้เทนนิส'),
(337, 11, 1, 'เชือกกระโดด'),
(338, 11, 1, 'ดาบสองมือ'),
(339, 11, 1, 'ตะกร้าหวายแชร์บอล'),
(340, 11, 1, 'นาฬิกาจับเวลา'),
(341, 11, 1, 'นวม'),
(342, 11, 1, 'ลูกทุ่มน้ำหนัก'),
(343, 11, 1, 'เสาตาข่ายกีฬา เช่น เสาตาข่ายตะกร้อ เสาตาข่ายวอลเลย์บอล'),
(344, 11, 1, 'ห่วงบาสเก็ตบอลเหล็ก'),
(345, 11, 1, 'กระดานแสดงผลการแข่งขัน'),
(346, 11, 1, 'ลูกเปตอง'),
(347, 11, 1, 'เบาะมวยปล้ำ ยูโด'),
(348, 11, 2, 'ตาข่ายกีฬา เช่น ตาข่ายตะกร้อ วอลเลย์บอล เป็นต้น'),
(349, 11, 2, 'ลูกปิงปอง'),
(350, 11, 2, 'ลูกแบดมินตัน'),
(351, 11, 2, 'ลูกเทนนิส'),
(352, 11, 2, 'ลูกฟุตบอล'),
(353, 11, 2, 'ลูกแชร์บอล'),
(354, 11, 2, 'แผ่นโยคะ'),
(355, 11, 2, 'ตะกร้อ'),
(356, 1, 2, 'นกหวีด'),
(357, 12, 1, 'แผ่นหรือจานบันทึกข้อมูล'),
(358, 12, 2, 'อุปกรณ์บันทึกข้อมูล ( Diskette , Floppy Disk , Removable Disk , Compact Disc , Flash Drive )'),
(359, 12, 2, 'เทปบันทึกข้อมูล (Reel Magnetic Tape , Cassette Tape , Cartridge Tape)'),
(360, 12, 2, 'หัวพิมพ์หรือแถบพิมพ์สำหรับเครื่องพิมพ์คอมพิวเตอร์'),
(361, 12, 2, 'ตลับผงหมึกสำหรับเครื่องพิมพ์เลเซอร์'),
(362, 12, 2, 'กระดาษต่อเนื่อง'),
(363, 12, 2, 'สายเคเบิล'),
(364, 12, 3, 'หน่วยประมวลผล'),
(365, 12, 3, 'ฮาร์ดดิสก์ไดร์ฟ'),
(366, 1, 3, 'ซีดีรอมไดร์ฟ'),
(367, 12, 3, 'แผ่นกรองแสง'),
(368, 12, 3, 'แผงแป้นพิมพ์อักขระ หรือ แป้นพิมพ์ (Key Board)'),
(369, 12, 3, 'เมนบอร์ด (Main Board)'),
(370, 12, 3, 'เมมโมรี่ซิป (Memory Chip) เช่น RAM'),
(371, 12, 3, 'คัตซีทฟีดเตอร์ ( Cut Sheet Feeder)'),
(372, 12, 3, 'เมาส์ (Mouse)'),
(373, 12, 3, 'พรินเตอร์สวิตชิ่งบ๊อกซ์ (Printer Switching Box)'),
(374, 12, 3, 'เครื่องกระจายสัญญาณ (Hub)'),
(375, 12, 3, 'แผ่นวงจรอินเล้กทรอนิกส์ (Card) เช่น Ethernet Card , Lan Card , Anti virus Card , Sound Card เป็นต้น'),
(376, 12, 3, 'เครื่องอ่านและบันทึกข้อมูลแบต่างๆ เช่น แบบดิสเกตต์ (Diskette) แบบฮาร์ดดิสต์ (Hard Disk) แบบซีดีรอม (CD-ROM) แบบออพติคอล (Optical) เป็นต้น'),
(377, 12, 3, 'เราเตอร์ (Router)'),
(378, 13, 1, 'หุ่นเพื่อการศึกษา'),
(379, 13, 1, 'แบบจำลองภูมิประเทศ'),
(380, 13, 1, 'สื่อการเรียนการสอนทำด้วยพลาสติก'),
(381, 13, 1, 'กระดานลื่นพลาสติก (สไลเดอร์พลาสติก)'),
(382, 13, 1, 'เบาะยืดหยุ่น'),
(383, 13, 1, 'กระดานไวท์บอร์ด'),
(384, 13, 1, 'ขาตั้ง (กระดานดำ)'),
(385, 13, 1, 'แปรงลบกระดานดำ'),
(386, 13, 2, 'ซอล์ค'),
(387, 13, 2, 'ปากกาไวท์บอร์ด'),
(388, 14, 1, 'วาล์วน้ำดับเพลิง (เชื่อมกับรถดับเพลิง)'),
(389, 14, 1, 'ท่อสายส่งน้ำ'),
(390, 14, 1, 'สายดับเพลิง'),
(391, 14, 1, 'อุปกรณ์ดับไฟป่า (เช่น สายฉีด , ถัง , ไม้ตบไฟ)'),
(392, 14, 2, 'ถังดับเพลิง'),
(393, 14, 2, 'ลูกบอลดับเพลิง'),
(394, 15, 1, 'เต็นท์นอน/เต็นท์สนามขนาดเล็ก'),
(395, 15, 1, 'ถุงนอนสนาม'),
(396, 15, 1, 'เข็มทิศ'),
(397, 15, 1, 'เปลสนาม'),
(398, 15, 1, 'ม้าหิน'),
(399, 15, 2, 'หญ้าสนาม หญ้าเทียม'),
(400, 1, 2, 'โครงลวดรูปสัตว์'),
(401, 16, 1, 'บันไดอลูมิเนียม'),
(402, 16, 1, 'เครื่องมือแกะสลัก'),
(403, 16, 1, 'เครื่องมือดึงสายโทรศัพท์'),
(404, 17, 1, 'ฉิ่ง'),
(405, 17, 1, 'ฉาบ'),
(406, 17, 1, 'กรับ'),
(407, 17, 1, 'อังกะลุง'),
(408, 17, 1, 'กลอง เช่น กลองสองหน้า รำวง กลองยาว กลองแซมบ้า'),
(409, 17, 1, 'ลูกซัด'),
(410, 17, 1, 'ปารากัส'),
(411, 17, 1, 'ขลุ่ย'),
(412, 17, 1, 'ขิม'),
(413, 17, 1, 'ซอ และยางสนซอ'),
(414, 17, 1, 'จะเข้ และอุปกรณ์ เช่น ไม้ดีด , สาย  , นมจะเข้ '),
(415, 17, 1, 'โทน'),
(416, 17, 1, 'โหม่ง'),
(417, 17, 1, 'ปี่มอญ'),
(418, 17, 1, 'อูคูเลเล่'),
(419, 18, 1, 'สัญญาณไฟกระพริบ'),
(420, 18, 1, 'สัญญาณไฟฉุกเฉิน'),
(421, 18, 1, 'กรวยจราจร'),
(422, 18, 1, 'แผงกั้นจราจร'),
(423, 18, 1, 'ป้ายเตือน'),
(424, 18, 1, 'แท่นแบริเออร์ (แบบพลาสติก และ แบบคอนกรีต)'),
(425, 18, 1, 'ป้ายไฟหยุดตรวจ'),
(426, 18, 1, 'แผ่นป้ายจราจร'),
(427, 18, 1, 'กระจกโค้งมน'),
(428, 18, 1, 'ไฟแวบ'),
(429, 18, 1, 'กระบองไฟ'),
(430, 18, 2, 'ยางชะลอความเร็วรถหรือยานพาหนะ '),
(431, 18, 2, 'สติ๊กเกอร์ติดรถหรือยานพาหนะ'),
(432, 19, 1, 'มิเตอร์น้ำ'),
(433, 19, 1, 'มิเตอร์ไฟ'),
(434, 19, 1, 'สมอเรือ'),
(435, 19, 1, 'ตะแกรงกันสวะ'),
(436, 19, 1, 'หัวเชื่อมแก๊ส'),
(437, 19, 1, 'หัววาล์วเปิด - ปิดแก๊ส'),
(438, 19, 2, 'อุปกรณ์บังคับสัตว์');

-- --------------------------------------------------------

--
-- Table structure for table `repair_requests`
--

CREATE TABLE `repair_requests` (
  `request_date` date NOT NULL,
  `department_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `equipment_type_id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `equipment_number` varchar(255) NOT NULL,
  `repair_details` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `request_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `technician_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repair_status`
--

CREATE TABLE `repair_status` (
  `rs_id` int(11) NOT NULL,
  `rs_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repair_status`
--

INSERT INTO `repair_status` (`rs_id`, `rs_name`) VALUES
(1, 'กำลังดำเนินการ'),
(2, 'รอการอนุมัติ'),
(3, 'เสร็จสมบูรณ์'),
(5, 'รออะไหล่'),
(20, 'รอจำหน่าย'),
(21, 'จำหน่ายเสร้จสิ้น');

-- --------------------------------------------------------

--
-- Table structure for table `type_material`
--

CREATE TABLE `type_material` (
  `tm_id` int(11) NOT NULL,
  `tm_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_material`
--

INSERT INTO `type_material` (`tm_id`, `tm_name`) VALUES
(1, 'วัสดุสำนักงาน'),
(2, 'วัสดุไฟฟ้าและวิทยุ'),
(3, 'วัสดุงานบ้านงานครัว'),
(4, 'วัสดุก่อสร้าง'),
(5, 'วัสดุยานพาหนะและขนส่ง'),
(6, 'วัสดุเชื้อเพลิงและหล่อลื่น'),
(7, 'วัสดุวิทยาศาสตร์หรือการแพทย์'),
(8, 'วัสดุการเกษตร'),
(9, 'วัสดุโฆษณาและเผยแพร่'),
(10, 'วัสดุเครื่องแต่งกาย'),
(11, 'วัสดุกีฬา'),
(12, 'วัสดุคอมพิวเตอร์'),
(13, 'วัสดุการศึกษา'),
(14, 'วัสดุเครื่องดับเพลิง'),
(15, 'วัสดุสนาม'),
(16, 'วัสดุสำรวจ'),
(17, 'วัสดุดนตรี'),
(18, 'วัสดุจราจร'),
(19, 'วัสดุอื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `un_id` int(11) NOT NULL,
  `un_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`un_id`, `un_name`) VALUES
(1, 'ตัว'),
(2, 'ใบ'),
(3, 'อัน'),
(4, 'ชิ้น'),
(5, 'แผ่น'),
(6, 'ใบ'),
(7, 'เครื่อง');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_fname` varchar(255) NOT NULL,
  `u_lname` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_status` enum('ใช้งาน','ไม่ได้ใช้งาน') NOT NULL,
  `u_type` enum('ช่าง','แอดมิน','ผู้ใช้') NOT NULL,
  `u_dp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_fname`, `u_lname`, `u_email`, `u_password`, `u_status`, `u_type`, `u_dp_id`) VALUES
(1, 'พัชรินทร์', 'พรมศร', 'pat@gmail.com', '$2y$10$dA9RW0EE1/eB.HG86l.5OuIlgN8MCKALwFx5HOjuqp5W4vgBUYpx2', 'ใช้งาน', 'แอดมิน', 6),
(2, 'ช่าง', 'ฝึกหัด', '2@gmail.com', '$2y$10$5jE13DdPDa//Y8YWHwVHJ.pstz26bcfi67AbwSPlVRrUBjNO..D1a', 'ใช้งาน', 'ช่าง', 1),
(3, 'user', 'ผู้ใช้', '28@gmail.com', '$2y$10$GZJpXQ8qd7cSbabVGKuvvOW03FS9PARdwU3R8dwJkhVQbEhzmY1uy', 'ใช้งาน', 'ผู้ใช้', 11),
(8, 'technician', '', 'technician@gmail.com', '$2y$10$jBtgIE2et./tg4HCJwOk6.0p21SR7319nnuLtR.t1P1IVWGVM71G.', 'ใช้งาน', 'ช่าง', 1),
(9, 'admin', '', 'admin@gmail.com', '$2y$10$kE6usUC6.X9ZqwfwVFfYD.xIkmVl6aJHpuB6/n21Nkuc51RGPDje2', 'ใช้งาน', 'แอดมิน', 1),
(10, 'user', '', 'user@gmail.com', '$2y$10$xeNh8VB4wt8nu7JLQjgzBukJ39rqZ3so00mcwyUEqpcLl1uP45ITa', 'ใช้งาน', 'ผู้ใช้', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dp_id`);

--
-- Indexes for table `detail_material`
--
ALTER TABLE `detail_material`
  ADD PRIMARY KEY (`dm_id`);

--
-- Indexes for table `equipment_parcels`
--
ALTER TABLE `equipment_parcels`
  ADD PRIMARY KEY (`parcel_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `head_of_department_id` (`head_of_department_id`),
  ADD KEY `ep_et_id` (`ep_et_id`) USING BTREE,
  ADD KEY `fk_head_of_department1` (`head_of_department1`),
  ADD KEY `fk_head_of_department2` (`head_of_department2`),
  ADD KEY `fk_head_of_department3` (`head_of_department3`),
  ADD KEY `fk_head_of_department4` (`head_of_department4`),
  ADD KEY `fk_head_of_department5` (`head_of_department5`),
  ADD KEY `fk_head_of_department6` (`head_of_department6`);

--
-- Indexes for table `equipment_type`
--
ALTER TABLE `equipment_type`
  ADD PRIMARY KEY (`et_id`),
  ADD KEY `un_id` (`un_id`);

--
-- Indexes for table `headofdepartment`
--
ALTER TABLE `headofdepartment`
  ADD PRIMARY KEY (`head_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `idx_head_of_department_dept_id` (`head_id`,`department_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`mt_id`),
  ADD KEY `fk_material_tm_id` (`mt_tm_id`),
  ADD KEY `fk_material_dm_id` (`mt_dm_id`);

--
-- Indexes for table `repair_requests`
--
ALTER TABLE `repair_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `equipment_type_id` (`equipment_type_id`),
  ADD KEY `idx_department_id` (`department_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_equipment_type_id` (`equipment_type_id`),
  ADD KEY `fk_status_id` (`status_id`);

--
-- Indexes for table `repair_status`
--
ALTER TABLE `repair_status`
  ADD PRIMARY KEY (`rs_id`);

--
-- Indexes for table `type_material`
--
ALTER TABLE `type_material`
  ADD PRIMARY KEY (`tm_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`un_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `u_dp_id` (`u_dp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `detail_material`
--
ALTER TABLE `detail_material`
  MODIFY `dm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `equipment_parcels`
--
ALTER TABLE `equipment_parcels`
  MODIFY `parcel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `equipment_type`
--
ALTER TABLE `equipment_type`
  MODIFY `et_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `mt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=439;

--
-- AUTO_INCREMENT for table `repair_requests`
--
ALTER TABLE `repair_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `repair_status`
--
ALTER TABLE `repair_status`
  MODIFY `rs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `type_material`
--
ALTER TABLE `type_material`
  MODIFY `tm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `un_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipment_parcels`
--
ALTER TABLE `equipment_parcels`
  ADD CONSTRAINT `equipment_parcels_ibfk_1` FOREIGN KEY (`ep_et_id`) REFERENCES `equipment_type` (`et_id`),
  ADD CONSTRAINT `equipment_parcels_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`dp_id`),
  ADD CONSTRAINT `equipment_parcels_ibfk_3` FOREIGN KEY (`head_of_department_id`) REFERENCES `headofdepartment` (`head_id`),
  ADD CONSTRAINT `fk_head_of_department1` FOREIGN KEY (`head_of_department1`) REFERENCES `headofdepartment` (`head_id`),
  ADD CONSTRAINT `fk_head_of_department2` FOREIGN KEY (`head_of_department2`) REFERENCES `headofdepartment` (`head_id`),
  ADD CONSTRAINT `fk_head_of_department3` FOREIGN KEY (`head_of_department3`) REFERENCES `headofdepartment` (`head_id`),
  ADD CONSTRAINT `fk_head_of_department4` FOREIGN KEY (`head_of_department4`) REFERENCES `headofdepartment` (`head_id`),
  ADD CONSTRAINT `fk_head_of_department5` FOREIGN KEY (`head_of_department5`) REFERENCES `headofdepartment` (`head_id`),
  ADD CONSTRAINT `fk_head_of_department6` FOREIGN KEY (`head_of_department6`) REFERENCES `headofdepartment` (`head_id`);

--
-- Constraints for table `equipment_type`
--
ALTER TABLE `equipment_type`
  ADD CONSTRAINT `equipment_type_ibfk_1` FOREIGN KEY (`un_id`) REFERENCES `unit` (`un_id`);

--
-- Constraints for table `headofdepartment`
--
ALTER TABLE `headofdepartment`
  ADD CONSTRAINT `headofdepartment_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`dp_id`);

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `fk_material_dm_id` FOREIGN KEY (`mt_dm_id`) REFERENCES `detail_material` (`dm_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_material_tm_id` FOREIGN KEY (`mt_tm_id`) REFERENCES `type_material` (`tm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `repair_requests`
--
ALTER TABLE `repair_requests`
  ADD CONSTRAINT `fk_brand_id` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `fk_department_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`dp_id`),
  ADD CONSTRAINT `fk_equipment_type_id` FOREIGN KEY (`equipment_type_id`) REFERENCES `equipment_type` (`et_id`),
  ADD CONSTRAINT `fk_status_id` FOREIGN KEY (`status_id`) REFERENCES `repair_status` (`rs_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `repair_requests_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`dp_id`),
  ADD CONSTRAINT `repair_requests_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `repair_requests_ibfk_3` FOREIGN KEY (`equipment_type_id`) REFERENCES `equipment_type` (`et_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`u_dp_id`) REFERENCES `department` (`dp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
