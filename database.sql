-- ==========================================================
-- Tirumala IIT & Medical Academy
-- MySQL Database Dump & Schema Definition
-- Shared Hosting / cPanel / phpMyAdmin Compatible
-- ==========================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------
-- Table structure for admin_users
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(150) DEFAULT 'Administrator',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default credentials: admin / tirumala@2026
INSERT INTO `admin_users` (`username`, `password_hash`, `full_name`) VALUES
('admin', '$2y$10$eE0m7aA9e4fG5wQ0fF4yOeO3uR5r0b5bUj2d9Y9eM4jF8fK6sB7q6', 'Tirumala Academy Administrator');

-- ----------------------------------------------------------
-- Table structure for results
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `results`;
CREATE TABLE `results` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `student_name` VARCHAR(150) NOT NULL,
  `roll_number` VARCHAR(50) NOT NULL,
  `stream` VARCHAR(50) NOT NULL,
  `exam_type` VARCHAR(50) NOT NULL,
  `year` INT NOT NULL,
  `campus` VARCHAR(100) NOT NULL,
  `score_or_rank` VARCHAR(100) NOT NULL,
  `photo_url` VARCHAR(255) DEFAULT NULL,
  `featured` INT DEFAULT 0,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  INDEX (`roll_number`),
  INDEX (`stream`),
  INDEX (`year`),
  INDEX (`campus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `results` (`student_name`, `roll_number`, `stream`, `exam_type`, `year`, `campus`, `score_or_rank`, `photo_url`, `featured`) VALUES
('K. Sai Teja', 'TIMA202401', 'MPC', 'JEE Advanced', 2024, 'Rajamahendravaram', 'AIR 142 (Top in AP)', 'assets/images/jee_adv_result.jpg', 1),
('V. Sravani', 'TIMA202402', 'BiPC', 'NEET', 2024, 'Visakhapatnam', 'Score: 695/720 (AIR 218)', 'assets/images/neet_result.jpg', 1),
('P. Rohan Kumar', 'TIMA202403', 'MPC', 'JEE Main', 2024, 'Bhimavaram', '99.94 Percentile', 'assets/images/inter_mpc_result.jpg', 1),
('M. Harshitha', 'TIMA202404', 'BiPC', 'IPE Inter', 2024, 'Tanuku', '992/1000 State Rank 4', 'assets/images/inter_bipc_result.jpg', 1),
('B. Lokesh', 'TIMA202405', 'Foundation', 'SSC Class 10', 2024, 'Payakaraopeta', '594/600 (GPA 10.0)', 'assets/images/ssc_result.jpg', 1),
('D. Ananya', 'TIMA202406', 'MPC', 'JEE Advanced', 2024, 'Rajamahendravaram', 'AIR 384', 'assets/images/jee_adv_result.jpg', 0),
('T. Vamsi Krishna', 'TIMA202407', 'BiPC', 'NEET', 2024, 'Visakhapatnam', 'Score: 678/720', 'assets/images/neet_result.jpg', 0),
('S. Preethi', 'TIMA202408', 'MPC', 'IPE Inter', 2024, 'Bhimavaram', '988/1000', 'assets/images/inter_mpc_result.jpg', 0);

-- ----------------------------------------------------------
-- Table structure for notices
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `notices`;
CREATE TABLE `notices` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT,
  `link_url` VARCHAR(255) DEFAULT NULL,
  `badge_type` VARCHAR(50) DEFAULT 'Urgent',
  `is_active` INT DEFAULT 1,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `notices` (`title`, `content`, `link_url`, `badge_type`, `is_active`) VALUES
('Admissions Open for Academic Year 2025-26 (Schools & Junior Colleges)', 'Admissions open across Rajamahendravaram, Vizag, Bhimavaram, Tanuku & Payakaraopeta campuses.', 'admissions.php', 'Admission', 1),
('Tirumala Super 60 IIT-JEE & NEET Batch Entrance Test Announced', 'Entrance screening test for scholarship & Super 60 residential batch will be conducted this Sunday.', 'admissions.php', 'Urgent', 1),
('Model Papers for Classes 6th to Intermediate Available for Free Download', 'Prepare with authentic Tirumala practice question papers available in the Model Papers section.', 'model-papers.php', 'New', 1);

-- ----------------------------------------------------------
-- Table structure for model_papers
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `model_papers`;
CREATE TABLE `model_papers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `class_grade` VARCHAR(50) NOT NULL,
  `board` VARCHAR(50) NOT NULL,
  `stream` VARCHAR(50) DEFAULT 'General',
  `file_path` VARCHAR(255) NOT NULL,
  `file_size` VARCHAR(50) DEFAULT '1.5 MB',
  `download_count` INT DEFAULT 0,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `model_papers` (`title`, `class_grade`, `board`, `stream`, `file_path`, `file_size`, `download_count`) VALUES
('Into 6th Class Entrance Model Paper 2024-25', 'Class 6', 'CBSE / STATE', 'General', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-6TH-CLASS.pdf', '1.4 MB', 342),
('Into 7th Class Entrance Model Paper - ICSE Board', 'Class 7', 'ICSE', 'General', 'https://tirumalaedu.com/wp-content/uploads/2025/01/INTO-7TH-CLASS-ICSE.pdf', '1.6 MB', 289),
('Into 7th Class Model Paper - STATE & CBSE Combined', 'Class 7', 'Combined', 'General', 'https://tirumalaedu.com/wp-content/uploads/2025/01/INTO-7TH-CLASS-STATE-CBSE.pdf', '1.8 MB', 310),
('Into 8th Class Model Paper - ICSE Stream', 'Class 8', 'ICSE', 'General', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-8TH-CLASS_ICSE.pdf', '1.9 MB', 412),
('Into 8th Class Model Paper - CBSE Stream', 'Class 8', 'CBSE', 'General', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-8TH-CLASS_CBSE.pdf', '2.0 MB', 450),
('Into 8th Class Model Paper - STATE Stream', 'Class 8', 'STATE', 'General', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-8TH-CLASS_STATE.pdf', '1.7 MB', 380),
('Into 9th Class IIT/NEET Foundation - ICSE', 'Class 9', 'ICSE', 'Foundation', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-9TH-CLASS_ICSE.pdf', '2.2 MB', 520),
('Into 9th Class IIT/NEET Foundation - CBSE', 'Class 9', 'CBSE', 'Foundation', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-9TH-CLASS_CBSE.pdf', '2.3 MB', 560),
('Into 9th Class IIT/NEET Foundation - STATE', 'Class 9', 'STATE', 'Foundation', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-9TH-CLASS_STATE.pdf', '2.1 MB', 490),
('Into 10th Class Board & Olympiad - ICSE', 'Class 10', 'ICSE', 'Foundation', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-10TH-CLASS_-ICSE.pdf', '2.4 MB', 610),
('Into 10th Class Board & Olympiad - CBSE', 'Class 10', 'CBSE', 'Foundation', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-10TH-CLASS_CBSE.pdf', '2.5 MB', 680),
('Into 10th Class Board & Olympiad - STATE', 'Class 10', 'STATE', 'Foundation', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-10TH-CLASS_STATE.pdf', '2.3 MB', 590),
('Into Intermediate MPC / BiPC Entrance - ICSE', 'Intermediate', 'ICSE', 'MPC / BiPC', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-INTER-ICSE.pdf', '2.8 MB', 890),
('Into Intermediate MPC / BiPC Entrance - CBSE', 'Intermediate', 'CBSE', 'MPC / BiPC', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-INTER-CBSE.pdf', '2.9 MB', 940),
('Into Intermediate MPC / BiPC Entrance - STATE', 'Intermediate', 'STATE', 'MPC / BiPC', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-INTER-STATE.pdf', '2.7 MB', 820);

-- ----------------------------------------------------------
-- Table structure for gallery
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `category` VARCHAR(50) NOT NULL,
  `image_url` VARCHAR(255) NOT NULL,
  `caption` TEXT,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gallery` (`title`, `category`, `image_url`, `caption`) VALUES
('Annual Day & Merit Awards Celebration', 'Events', 'assets/images/chairman_tirumala_rao.png', 'Chairman Sri N. Tirumala Rao honoring state top rankers.'),
('NEET All India Rankers Felicitation', 'Results', 'assets/images/neet_result.jpg', 'Celebrating Tirumala Academy medical entrance champions.'),
('Inter-School Sports Meet & Athletic Championship', 'Games', 'assets/images/offcanvase.jpg', 'Students competing at the state-level athletic championship.'),
('JEE Advanced State Toppers Recognition', 'Results', 'assets/images/jee_adv_result.jpg', 'IIT Bombay and IIT Madras qualifiers felicitated by MD G. Satish Babu.'),
('Science Exhibition & Robotic Innovation Fair', 'Events', 'assets/images/director_satish_babu.jpg', 'Hands-on experiential learning by young innovators.'),
('Volleyball & Cricket Tournament Finals', 'Games', 'assets/images/round_logo.png', 'Annual sports carnival promoting holistic health & discipline.');

-- ----------------------------------------------------------
-- Table structure for enquiries
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `enquiries`;
CREATE TABLE `enquiries` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `student_name` VARCHAR(150) NOT NULL,
  `parent_name` VARCHAR(150) DEFAULT NULL,
  `phone` VARCHAR(25) NOT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `class_applying` VARCHAR(50) DEFAULT NULL,
  `stream_interested` VARCHAR(50) DEFAULT NULL,
  `campus_preferred` VARCHAR(100) DEFAULT NULL,
  `message` TEXT DEFAULT NULL,
  `application_fee_paid` INT DEFAULT 0,
  `razorpay_payment_id` VARCHAR(100) DEFAULT NULL,
  `status` VARCHAR(20) DEFAULT 'Pending',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;
