-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 25, 2018 at 11:38 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_ldwap`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Laravel', 'Admin', 'dhavalbharadva@gmail.com', 'admin', '$2y$10$n.9i27WfoO8wdDRwoXdf0OAQh8hPZjiz4BirndxyPb.9ZNbRLtY4u', 's8I9UowqqRJMAo18zOcrxuPYObvQCnV9TU6gSN4yoZOFzYViPvSArn7TjCFo', '2016-10-23 23:58:33', '2016-11-11 11:38:10');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('pending','answered') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `fullname`, `email`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'First Enquiry', 'firstenquiry@gmail.com', 'First Enquiry Subject', 'This is first enquiry', 'answered', '2016-10-24 08:48:12', '2016-11-11 11:37:32'),
(2, 'Second Enquiry', 'secondenquiry@gmail.com', 'Second Enquiry Subject', 'This is second enquiry', 'pending', '2016-10-24 23:24:31', '2016-11-11 11:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `metadata`
--

CREATE TABLE `metadata` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `metadata`
--

INSERT INTO `metadata` (`id`, `url`, `title`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'http://ldwap.dhthedeveloper.in/about', 'About Laravel Dynamic Website', 'Laravel Dynamic Website', 'Laravel, Website, MVC,', 'Laravel Dynamic Website with Admin Panel is the best package for startup project with laravel 5 framework.', '2016-10-24 00:06:52', '2016-10-24 00:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_10_10_104728_create_admin_table', 1),
('2015_10_13_124512_create_password_resets_table', 1),
('2015_10_23_104401_create_pages_table', 1),
('2015_11_18_112049_create_settings_table', 1),
('2016_01_19_071115_create_metadata_table', 1),
('2016_10_24_054221_create_portfolio_categories_table', 2),
('2016_10_24_054239_create_portfolio_table', 2),
('2016_10_24_054231_create_banned_ips_table', 2),
('2016_10_24_054232_create_flags_table', 2),
('2016_10_24_060310_create_services_table', 3),
('2016_10_24_060604_create_team_table', 4),
('2016_10_24_061326_create_enquiries_table', 5),
('2016_10_24_061802_create_sliders_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `slug`, `title`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'home', 'Home', '<div class=\"row\">\r\n<div class=\"col-lg-12\">\r\n<h1 class=\"page-header\">Welcome to Modern Business</h1>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"panel panel-default\">\r\n<div class=\"panel-heading\">\r\n<h4>Bootstrap v3.2.0</h4>\r\n</div>\r\n\r\n<div class=\"panel-body\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>\r\n<a class=\"btn btn-default\" href=\"#\">Learn More</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"panel panel-default\">\r\n<div class=\"panel-heading\">\r\n<h4>Free &amp; Open Source</h4>\r\n</div>\r\n\r\n<div class=\"panel-body\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>\r\n<a class=\"btn btn-default\" href=\"#\">Learn More</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"panel panel-default\">\r\n<div class=\"panel-heading\">\r\n<h4>Easy to Use</h4>\r\n</div>\r\n\r\n<div class=\"panel-body\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>\r\n<a class=\"btn btn-default\" href=\"#\">Learn More</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-lg-12\">\r\n<h2 class=\"page-header\">Modern Business Features</h2>\r\n</div>\r\n\r\n<div class=\"col-md-6\">\r\n<p>The Modern Business template by Start Bootstrap includes:</p>\r\n\r\n<ul>\r\n	<li><strong>Bootstrap v3.2.0</strong></li>\r\n	<li>jQuery v1.11.0</li>\r\n	<li>Font Awesome v4.1.0</li>\r\n	<li>Working PHP contact form with validation</li>\r\n	<li>Unstyled page elements for easy customization</li>\r\n	<li>17 HTML pages</li>\r\n</ul>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia dolorum ducimus unde.</p>\r\n</div>\r\n\r\n<div class=\"col-md-6\">\r\n<p>The Modern Business template by Start Bootstrap includes:</p>\r\n\r\n<ul>\r\n	<li><strong>Bootstrap v3.2.0</strong></li>\r\n	<li>jQuery v1.11.0</li>\r\n	<li>Font Awesome v4.1.0</li>\r\n	<li>Working PHP contact form with validation</li>\r\n	<li>Unstyled page elements for easy customization</li>\r\n	<li>17 HTML pages</li>\r\n</ul>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia dolorum ducimus unde.</p>\r\n</div>\r\n</div>\r\n\r\n<hr />\r\n<div class=\"well\">\r\n<div class=\"row\">\r\n<div class=\"col-md-8\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>\r\n</div>\r\n\r\n<div class=\"col-md-4\"><a class=\"btn btn-lg btn-default btn-block\" href=\"#\">Call to Action</a></div>\r\n</div>\r\n</div>\r\n', '1', '2016-10-24 00:02:44', '2016-10-24 00:02:44'),
(2, 'about', 'About Us', '<h3 style=\"clear:both;\">At a Glance</h3>\r\n\r\n<div>\r\n<div>Laravel App is a leading and globally accepted IT solution provider and currently at the forefront of offshore software development to serve the people across the world. We spread our wings in the business of Software Development, Web Designing &amp; Multimedia, E-Commerce Solutions, Search Engine Optimization, Mobile Application Development, Business Software Services etc... We also provide IT Infrastructure Solutions, System Integration, Network/Server Management services across India.<br />\r\n<br />\r\nLaravel App was founded in 2009 with a view to endowing our clients with the optimum IT solutions in terms of hardware, software and network integration. The main functional areas were merely computer sales and maintenance. Functioning since one and a half decades, today Laravel App is a well-known name in branded hardware and software development.<br />\r\n<br />\r\nWe are recognized in the market for our ability to deliver, both hardware and software solutions merged in a single bouquet to comprehensively accomplish our client&#39;s overall IT needs.<br />\r\n<br />\r\nWe commit ourselves to achieve consistent reliability, efficiency and performance of our products &amp; services related to IT Hardware, Software &amp; Networking products. We attempt to achieve maximum customer satisfaction through continuous feedback mechanism and continual improvement in Quality Management Systems.<br />\r\n<br />\r\nWe have been accredited <strong>CMMi5, ISO 9001:2008, ISO 27001 and ISO 20000</strong> Certifications for observing international standards in a wide scope of activities like Manufacturing, Sales &amp; Services of Peripherals &amp; Networking Products as well as Design &amp; Development of Software/Portals. We specialize in building successful online business and creating competitive advantages for our clients.<br />\r\n<br />\r\nWe are constantly in the process of updating our software skills adopting new technologies that can perform better functions. We believe in integrating our skills with our clients&#39; inputs to achieve desirable results. We have developed our own performance measurement systems that virtually support our clients into the routine of software developing and over- viewing the performance of our skilled manpower.<br />\r\n<br />\r\nWe are ready with all sorts of solutions and we deliver any application that is web based and further our solutions are designed to adapt your business rather than your business adapting the software. Our solutions are 100% fruitful and empower you to take control of your business online and in real time!\r\n<h3 style=\"clear:both;\">Infrastructure</h3>\r\nLaravel App has its sprawling offices spread across 4 floors in the heart of the city of Ahmedabad - the commercial capital of Gujarat, India.<br />\r\nThis office is the headquarters of Laravel App Technologies and houses production, sales, marketing, business, human resources, admin &amp; finance groups and all other staff contributing continuously to the tremendous growth of the organization.\r\n<h3 style=\"clear:both;\">Key Highlights</h3>\r\n\r\n<ul>\r\n	<li>30,000 sq. ft. office space area</li>\r\n	<li>1000+ developers seating capacity</li>\r\n	<li>Gigabit Ethernet connectivity</li>\r\n	<li>35 mbps dedicated leased line for Internet and 10 mbps broadband connectivity</li>\r\n	<li>State-of-the-art data center running on IBM Blade Centers and P series servers</li>\r\n	<li>VM ware Virtualization environment for on-demand scalability on server</li>\r\n	<li>Physical Access controls (Biometric) at each departments</li>\r\n	<li>Unified communication backbone for VoIP, Audio/Video conferencing</li>\r\n	<li>Dedicated Test Environment for Independent Validation and Verification</li>\r\n	<li>Antivirus Client Server Edition Implemented</li>\r\n	<li>Enterprise level Firewall Implemented</li>\r\n	<li>Dedicated Training Academy for technical and corporate trainings</li>\r\n</ul>\r\n\r\n<h3 style=\"clear:both;\">Locations</h3>\r\nWe are providing our world class services from various strategic locations across the world. Apart from the development centre with state of the art infrastructure in Ahmedabad, we have offices in Delhi, Mumbai, Jaipur, Chandigarh, Lucknow in India, we have our business development centres in USA, UK, France, Germany, Sweden and Australia.</div>\r\n</div>\r\n', '1', '2016-10-24 00:03:15', '2016-10-24 00:03:15'),
(3, 'policy', 'Privacy Policy', '<strong open=\"\" sans=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" sans=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br />\r\n<br />\r\n<strong open=\"\" sans=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" sans=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br />\r\n<br />\r\n<strong open=\"\" sans=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" sans=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br />\r\n<br />\r\n<strong open=\"\" sans=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" sans=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br />\r\n<br />\r\n<strong open=\"\" sans=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" sans=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br />\r\n<br />\r\n<strong open=\"\" sans=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" sans=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br />\r\n<br />\r\n<strong open=\"\" sans=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" sans=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br />\r\n<br />\r\n<strong open=\"\" sans=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" sans=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>', '1', '2016-10-24 00:03:44', '2016-11-10 18:44:59'),
(4, 'terms', 'Terms & Conditions', '<strong open=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br />\r\n<br />\r\n<strong open=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br />\r\n<br />\r\n<strong open=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br />\r\n<br />\r\n<strong open=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br />\r\n<br />\r\n<strong open=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br />\r\n<br />\r\n<strong open=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br />\r\n<br />\r\n<strong open=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br />\r\n<br />\r\n<strong open=\"\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: \">Lorem Ipsum</strong><span open=\"\" style=\"color: rgb(0, 0, 0); font-family: \"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>', '1', '2016-10-24 00:04:12', '2016-11-10 18:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `category_id`, `title`, `link`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Web Development One', 'http://google.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.', '1.png', '1', '2015-09-18 00:41:23', '2016-11-11 11:04:51'),
(2, 1, 'Web Development Two', 'http://google.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.', '2.png', '1', '2015-09-18 02:03:59', '2016-11-11 11:05:25'),
(3, 1, 'Web Development Three', 'http://google.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.', '3.png', '1', '2015-09-18 02:04:27', '2016-11-11 11:05:09'),
(4, 2, 'Android One', 'http://google.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.', '4.png', '1', '2015-09-18 02:05:37', '2016-11-11 11:02:19'),
(5, 2, 'Android Two', 'http://google.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.', '5.png', '1', '2015-09-18 02:06:03', '2016-11-11 11:02:46'),
(6, 2, 'Android Three', 'http://google.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.', '6.png', '1', '2015-09-18 02:06:37', '2016-11-11 11:02:34'),
(7, 3, 'Web Design One', 'http://google.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.', '7.png', '1', '2015-09-18 02:07:19', '2016-11-11 11:03:45'),
(8, 3, 'Web Design Two', 'http://google.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.', '8.png', '1', '2015-09-18 02:08:06', '2016-11-11 11:04:09'),
(9, 3, 'Web Design Three', 'http://google.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.', '9.png', '1', '2015-09-18 02:08:53', '2016-11-11 11:03:57'),
(10, 4, 'iPhone One', 'http://google.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.', '10.png', '1', '2015-09-18 02:09:48', '2016-11-11 11:02:59'),
(11, 4, 'iPhone Two', 'http://google.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.', '11.png', '1', '2015-09-18 02:10:40', '2016-11-11 11:03:26'),
(12, 4, 'iPhone Three', 'http://google.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.', '12.png', '1', '2015-09-18 02:11:16', '2016-11-11 11:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_categories`
--

CREATE TABLE `portfolio_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `portfolio_categories`
--

INSERT INTO `portfolio_categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Web Development', '1', '2016-10-24 05:47:06', '2016-10-24 05:47:06'),
(2, 'Android', '1', '2016-10-24 05:48:20', '2016-10-24 05:48:27'),
(3, 'Web Designing', '1', '2016-10-24 05:48:37', '2016-10-24 05:48:37'),
(4, 'iPhone', '1', '2016-10-24 05:48:57', '2016-10-24 05:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Service One', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?', '1.png', '1', '2016-10-24 05:02:32', '2016-10-24 05:04:48'),
(2, 'Service Two', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?', '2.png', '1', '2016-10-24 05:03:48', '2016-11-11 10:30:55'),
(3, 'Service Three', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?', '3.png', '1', '2016-10-24 05:04:20', '2016-11-11 10:31:07'),
(4, 'Service Four', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?', '4.png', '1', '2016-10-24 05:04:37', '2016-11-11 10:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `map` text COLLATE utf8_unicode_ci,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `googleplus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `logo`, `email`, `phone`, `address`, `map`, `facebook`, `twitter`, `linkedin`, `googleplus`, `created_at`, `updated_at`) VALUES
(1, 'LDWAP', NULL, 'dhavalbharadva@gmail.com', '123457890', 'Address line 1,\r\nAdress line 2,\r\nState ,  City,\r\nCountry ', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30685339.443965733!2d64.41683279582205!3d20.14368358153789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30635ff06b92b791%3A0xd78c4fa1854213a6!2sIndia!5e0!3m2!1sen!2sin!4v1478846708984\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', 'http://www.facebook.com', 'http://www.twitter.com', 'http://www.linkedin.com', 'http://www.google.com', '2016-10-24 23:50:04', '2016-11-11 11:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image_name`, `status`, `created_at`, `updated_at`) VALUES
(1, '1.png', '1', '2016-10-25 01:48:28', '2016-11-11 11:22:57'),
(2, '2.png', '1', '2016-10-25 01:48:38', '2016-11-11 11:23:17'),
(3, '3.png', '1', '2016-10-25 01:48:46', '2016-11-11 11:23:25'),
(4, '4.png', '1', '2016-10-25 01:48:53', '2016-11-11 11:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `googleplus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stackoverflow` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `firstname`, `lastname`, `role`, `description`, `image`, `facebook`, `twitter`, `linkedin`, `googleplus`, `stackoverflow`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Team', 'One', 'Founder', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?', '1.png', 'http://www.facebook.com', 'http://www.twitter.com', 'http://www.linkedin.com', 'http://www.google.com', '', '1', '2016-10-24 03:11:25', '2016-11-11 10:19:34'),
(2, 'Team', 'Two', 'CEO', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?', '2.png', 'http://www.facebook.com', 'http://www.twitter.com', 'http://www.linkedin.com', 'http://www.google.com', '', '1', '2016-11-11 10:17:10', '2016-11-11 10:19:53'),
(3, 'Team', 'Three', 'Project Manager', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?', '3.png', 'http://www.facebook.com', 'http://www.twitter.com', 'http://www.linkedin.com', 'http://www.google.com', '', '1', '2016-11-11 10:19:15', '2016-11-11 10:19:15'),
(4, 'Team', 'Four', 'Web Developer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?', '4.png', 'http://www.facebook.com', 'http://www.twitter.com', 'http://www.linkedin.com', 'http://www.google.com', 'http://stackoverflow.com/', '1', '2016-11-11 10:21:26', '2016-11-11 10:21:26'),
(5, 'Team', 'Five', 'UX-UI Desinger', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?', '5.png', 'http://www.facebook.com', 'http://www.twitter.com', 'http://www.linkedin.com', 'http://www.google.com', 'http://stackoverflow.com/', '1', '2016-11-11 10:21:54', '2016-11-11 10:21:54'),
(6, 'Team', 'Six', 'Android Developer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?', '6.png', 'http://www.facebook.com', 'http://www.twitter.com', 'http://www.linkedin.com', 'http://www.google.com', 'http://stackoverflow.com/', '1', '2016-11-11 10:22:46', '2016-11-11 10:22:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metadata`
--
ALTER TABLE `metadata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_type_index` (`type`),
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolio_category_id_foreign` (`category_id`);

--
-- Indexes for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `metadata`
--
ALTER TABLE `metadata`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD CONSTRAINT `portfolio_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `portfolio_categories` (`id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
