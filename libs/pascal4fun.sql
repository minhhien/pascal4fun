-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2020 at 03:58 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pascal4fun`
--

-- --------------------------------------------------------

--
-- Table structure for table `Exercise`
--

CREATE TABLE IF NOT EXISTS `Exercise` (
  `exercise_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `question` varchar(500) CHARACTER SET utf8 NOT NULL,
  `answer` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `sample_code` varchar(500) CHARACTER SET utf8 NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`exercise_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Exercise`
--

INSERT INTO `Exercise` (`exercise_id`, `name`, `question`, `answer`, `sample_code`, `level`) VALUES
(1, 'Xuất (output)', 'Viết chương trình hiển thị lên màn hình dòng chữ "Chao ban da den voi Pascal for fun"', 'Chao ban da den voi Pascal for fun', 'program Excercise2;\nbegin\n	(*  Viết mã Pascal ở đây *)\nend.', 1),
(2, 'Nhập (input)', 'Viết chương trình nhập vào tên một người và hiển thị lên màn hình dòng chữ "Hello " + tên người đó.', 'Hello ', 'program Excercise2;\nbegin\n	(*  Viết mã Pascal ở đây *)\nend.', 1),
(3, 'Toán tử số học', 'Hoàn thiện mã của chương trình dưới đây. Chương trình sẽ sử dụng các toán tử số học.', '', 'function cal(x:integer): integer;\nbegin\n	cal := 0;\nend;', 2),
(4, 'Toán tử số học 2', 'Hoàn thiện mã của chương trình dưới đây. Chương trình sẽ sử dụng các toán tử số học.', '', 'function cal(x:integer): integer;\nbegin\n	cal := 0;\nend;	', 1),
(5, 'Toán tử số học 3', 'Hoàn thiện mã của chương trình dưới đây. Chương trình sẽ sử dụng các toán tử số học.', '', 'function cal(x, y:integer): integer;\nbegin\n	cal := 0;\nend;	', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `marks` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`username`, `password`, `fullname`, `marks`, `active`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 20, 1),
('haiminh', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyen Hai Minh', 20, 1),
('khoa', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Việt Nam', 15, 1),
('khoanv', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyen Viet Khoa', 5, 1),
('minhhien', 'e10adc3949ba59abbe56e057f20f883e', 'Tran Minh Hien', 20, 1),
('student1', 'e10adc3949ba59abbe56e057f20f883e', 'The first student', 5, 1),
('student2', 'e10adc3949ba59abbe56e057f20f883e', 'The second student', 0, 1),
('toan', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyen Toan', 5, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
