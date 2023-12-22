-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 04:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1, 'xyz', 'xyz@gmail.com', '2023-01-30 06:55:58', '2023-01-24 06:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `assign_logs`
--

CREATE TABLE `assign_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` varchar(255) NOT NULL,
  `changes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`changes`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `chat_message` longtext NOT NULL,
  `message_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `from_user_id`, `to_user_id`, `chat_message`, `message_status`, `created_at`, `updated_at`) VALUES
(5, 8, 15, 'hi', 'Read', '2023-12-21 06:13:21', '2023-12-21 06:17:37'),
(6, 8, 15, 'assdsf', 'Read', '2023-12-21 06:16:45', '2023-12-21 06:17:37'),
(7, 1, 8, 'hhggjgj', 'Not Send', '2023-12-21 06:25:21', '2023-12-21 06:25:21'),
(8, 1, 8, 'hjgjhjh', 'Not Send', '2023-12-21 06:26:08', '2023-12-21 06:26:08'),
(9, 14, 15, 'fghhh', 'Send', '2023-12-21 06:40:47', '2023-12-21 06:40:47'),
(10, 14, 15, 'kjkj', 'Send', '2023-12-21 06:41:26', '2023-12-21 06:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) UNSIGNED NOT NULL,
  `client_code` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `current_website` varchar(255) DEFAULT NULL,
  `agent_name` varchar(250) NOT NULL,
  `closer_name` varchar(250) NOT NULL,
  `remarks` text DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_code`, `name`, `email`, `country_name`, `address`, `current_website`, `agent_name`, `closer_name`, `remarks`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 615165, 'Hakop Demirchyan', 'hakop@gmail.com', 'USA', 'new york', 'https://webart.technology', 'Saikat', 'Deb', 'test', NULL, '2023-01-02 01:27:25', '2023-07-20 01:10:33'),
(4, 986349, 'Kaushik Prakash', 'kaushik@gmail.com', 'USA', 'USA', 'https://supplywestock.com', 'Prodipto', 'Sudipto', 'Test54', NULL, '2023-01-04 16:28:05', '2023-12-07 04:23:58'),
(5, 881513, 'Sankar Bera', 'sankar.webart@gmail.com', 'AUS', 'kolkata', NULL, 'Prodipto', 'Sudipto', 'test', NULL, '2023-01-05 16:38:29', '2023-07-20 01:10:03'),
(6, 528493, 'Sakibul Hasan', 'sakib.iut@gmail.com', 'Canada', 'Toronto, Canada', 'https://getmehired.co/', 'Preetodeep', 'Pritam', '\"Client has signed up for SMO for 184.25 USD (250 CAD). Client signed a contract for 3 months but they will pay the money on monthly basis. Client has a business (https://getmehired.co/) where they teach coding, data engineering. And they also provide placement support as well. Client signed up for social media marketing on Facebook, Instagram and linkdin and lead generation campaign. (Campaign cost will be paid separately by the client). They have scheduled a zoom call today at 2.30 AM IST (4 PM EST). AM team needs to attend the Zoom call at that time. \r\n\r\nZoom Link: meet.google.com/heq-petb-btf\r\n\"', NULL, '2023-08-23 15:08:34', '2023-08-23 15:08:34'),
(7, 154055, 'Dee Barnes', 'dee@itsacheerthing.net', 'USA', 'Tennessee, USA', NULL, 'MISC', 'Akash', 'itsacheerthing.net', NULL, '2023-08-23 15:47:13', '2023-08-23 15:47:13'),
(8, 842503, 'JARON SIEGEL', 'cmlabz@gmail.com', 'USA', '\"Michigan \"', NULL, 'suman', 'Prodipto', '\"Client signed up for SMO & SEO. We have to bring more sales of his product by doing the organic marketing,we also discussed about influencer marketing if he want we can also do influencer marketing for him. Project cost is 450USD, he paid 225USD and said that he will be paying rest 225USD in 2 days once he clear 225USD in 2 days . By that please do your required R&D and once he pays the rest amount in next 2 days, please update that on the sales sheet. AM teams need to call him today at 11:20 pm(ist)\r\n\"', NULL, '2023-08-23 16:13:51', '2023-08-23 16:13:51'),
(9, 701593, 'FARRAH ANDICAN', 'farrah@inter-routes.com', 'USA', 'FAIRFAX, Virginia', NULL, 'RISHIKESH', 'Prodipto', 'CLIENT SIGNED UP FOR 30 DAYS OF SOCIAL MEDIA MARKETING. SHE WANTS TO DO THE CROWD FUNDING FOR HER PRODUCT FOR THAT WE HAVE TO DO THE SOCIAL MEDIA MARKETING. WE HAVE TO SUGGEST THE AD BUDGET FOR THE PAID CAMPAIGNS. ALSO WE HAVE TO DESIGN A \"COMING SOON\" PAGE AS COMPLERMENTARY. AM TEAM NEEDS TO CALL HER AT 1:50 A.M IST TODAY.', NULL, '2023-08-23 16:21:38', '2023-08-23 16:21:38'),
(10, 415845, 'Henderson Smith, Jr.', 'henderson@livingwelltherapies.net', 'USA', 'TEXAS', NULL, 'SUMAN', 'Prodipto', 'Client signed up graphic design he need 20 to 25 images for his classes that he gonna provide in the form .', NULL, '2023-08-23 16:27:17', '2023-08-23 16:27:17'),
(11, 812106, 'Henderson Smith, Jr.', 'henderson@livingwelltheerapies.net', 'USA', 'TEXAS', NULL, 'SUMAN', 'Prodipto', 'Client signed up graphic design he need 20 to 25 images for his classes that he gonna provide in the form of ppt. Am teams needs to call him at 9:50pm(ist) today. Also client has asked for a paid invoice from our end.', NULL, '2023-08-24 10:00:29', '2023-08-24 10:00:29'),
(12, 782134, 'scott paulk', 'scottpaulk@gmail.com', 'USA', 'GA', NULL, 'SUMAN', 'Prodipto', 'Client signed up for redesigning the website he has. As he has mentioned he want us to redesign 3 websites that is why gave a customized plan. He is willing to start with the one website. Website is - AM team needs to call him after 30 minutes from now, i.e, 12.25 AM IST today.', NULL, '2023-08-24 10:07:10', '2023-08-24 10:07:10'),
(13, 648618, 'Robert Williams', 'traveler0715@gmail.com', 'USA', 'Mount Vernon, NY', NULL, 'Sayani', 'Saikat', 'Client is targeting for individual travel agents to get sign up or register with the program which he provide. He sign up for social media promotion on Facebook and Instagram for that. Client is a very busy person. He always get busy for 17 hours in a day. We will have to take care of his page creation and we have to give him the admin access. He will have a separate ad budget for sponsor advertisement. Sign up for $200 in a month. AM team needs to contact with him tomorrow 11.1.23 around.', NULL, '2023-08-24 10:11:56', '2023-08-24 10:11:56'),
(14, 458757, 'Steve Montgomery', 'srmmontgomery@telus.ne', 'USA', '\"City: Victoria State: AB Country - Canada\"', NULL, 'Suvendu Mour', 'Prodipto', 'Client signed up for social media promotion for his business. His website is - https://cpsvictoria.com/. We need to create the facebook page for him and do the marketing in Linkedin and google as well. He is really specific about the target market of his. AM team needs to call him in 45 minutes from now.', NULL, '2023-08-24 10:18:09', '2023-08-24 10:18:09'),
(15, 334920, 'Alex Ortiz', 'processwithus@gmail.com', 'USA', 'Meriden, CT', NULL, 'Akash', 'Saikat', 'He is a partner client. He sign up for a marketing project for one of his client. His client is a beauty specialist. She will be looking forward her social media promotion. Her Instagram account is https://instagram.com/addictivebeautynow?igshid=YWJhMjlhZTc=. She is planning to get more bookings and also more focused on good creatives. Sign up for $250/month. AM team needs to call him at 4:45 IST. Client is also concern we will not disclose our name infront of his client.', NULL, '2023-08-24 10:23:11', '2023-08-24 10:23:11'),
(16, 739854, 'Dhiman Choudhury', 'dhimancanada@gmail.com', 'USA', 'Toronto, ON', NULL, 'Sayani', 'Pritam', 'client signed up for social media marketing with 201', NULL, '2023-08-24 10:28:49', '2023-08-24 10:28:49'),
(17, 394393, 'Matilda Chimwani', 'communitytaxserviceoffice@gmail.com', 'USA', 'Dallas,Texas', NULL, 'Sanu', 'Prodipto', 'Client signed up for Social Media promotion for her business. We need to cover LinkedIn and google only. Her website is communitytax.com. Client concern is also to remove the bad reviews from the website. AM team needs to Call back her today at.', NULL, '2023-08-24 10:34:57', '2023-08-24 10:34:57'),
(18, 383940, 'JOSEPH SPELTZ', 'joe@bossertrealty.com', 'USA', '\"City: MINNEOTA State: MI\"', NULL, 'Satyajit Das', 'Prodipto', 'Client signed up for social media marketing on Facebook, Instagram, linkedin, ***he is main concern is to increase the no of followers in his social media account from his traget market that is south Carolina***. also he will be sharing some raw video clips, we need to make it', NULL, '2023-08-24 10:41:18', '2023-08-24 10:41:18'),
(19, 484161, 'Simba Mujuru', 'simbamujuru@PMG-INS.COM', 'USA', '\"City: West Bloomfield State: Mi\"', NULL, 'koushik biswas', 'Saikat', 'Client signed up for Social Media Marketing for one month. He is into insurance sector and is investing 20 to 25 dollars on ads but is not getting good leads. We need to make sure that he is getting good leads. Client is filling the questionnaire form and AM team needs to call him today after 3 hours.', NULL, '2023-08-24 10:46:45', '2023-08-24 10:46:45'),
(20, 368176, 'Sean Love', 'sean.mlove@icloud.com', 'USA', 'Milwaukee, Wi', NULL, 'Soumyajit Singha', 'Pritam', 'Client signup for SMO for 150 USD. Client has a business of driving helpers. His targeted area chicago and Milwaukee. His website https://www.loveandletherwood.com/ .We have to do the marketing on facebook and instragram.', NULL, '2023-08-24 10:54:55', '2023-08-24 10:54:55'),
(21, 423702, 'Kenneth Cheo', 'kcheo@oursalescoach.com', 'USA', 'Hanover,Ma', NULL, 'Sayani', 'Prodipto', 'Client is a Sales Coach & this is his website https://oursalescoach.com/. Client only do business with software development companies & manufacturing companies. He is planning to get business from entire USA. We have to take care of Facebook , LinkedIn, & SEO. Client pay us $300 for one month.', NULL, '2023-08-24 10:59:24', '2023-08-24 10:59:24'),
(22, 618309, 'Anurag Jain', 'alex@myrrhusa.com', 'USA', 'New York', NULL, 'Soumyajit Singha', 'Akash', '\"Client talk to the Akash, client may have real estate business.Today akash is not coming to the office. If client have no real estate business then may be his business is myrrhusa.com.\r\nAM team need to talk to the client according that they.', NULL, '2023-08-24 11:03:52', '2023-08-24 11:03:52'),
(23, 252521, 'Nick Williams', 'nickwilliams@witseng.com', 'USA', 'Fairfax , Vi', NULL, 'Surajit', 'Prodipto', 'Client signed up for a website. He wants two parts in the website , one is regarding construction and another one is excavation. Client has shown a website (www.hrparts.com) as reference. we have to create a website with the same look and feel or better than that.', NULL, '2023-08-24 11:23:09', '2023-08-24 11:23:09'),
(24, 310623, 'Herman Spira', 'herman613@gmail.com', 'USA', 'Spring Valley , Ne', NULL, 'Arunashaf Mollick', 'Saikat', 'Client signed up for 4 logo designs. He has sent two samples to us and the directions and will send us the 2 more. He has a product made of aluminium which he puts in the trucks. The YOYO signs in the back and the ZIP sign in the side of a truck. He has a website project as well, if we deliver a good logo design he will give us the website project.', NULL, '2023-08-24 11:33:04', '2023-08-24 11:33:04'),
(25, 407981, 'Michael Wayne', 'domains_management@digitalbusinesslounge.com', 'USA', 'TORONTO , CA', NULL, 'SUMAN', 'Prodipto', 'INITIALLY, HE WANT TO BUILT CONTENT AND GET FOLLWERS AND GET LIKES INTO HIS WEBSITE (https://weyanconsulting.com). INTITIALLY HIS TARGET AUDIENCE IS LOCALLY AND IN FUTURE .', NULL, '2023-08-24 11:37:18', '2023-08-24 11:37:18'),
(26, 270049, 'KATHY DAVIS', 'THEBODYBALM@GMAIL.COM', 'USA', 'BLOOMFIELD , CO', NULL, 'Arunashaf Mollick', 'Prodipto', 'Client signed up for an e-commerce website. She has 5-7 products. She liked the websites \'shop.recodestudios.com\' and \'semitictribes.com\'.', NULL, '2023-08-24 11:41:40', '2023-08-24 11:41:40'),
(27, 864517, 'Trent Ballentine', 'trent@manicnomad.com', 'USA', '\"Bloomington , Il \"', NULL, 'Abhay Bhanjo', 'Prodipto', 'Client is a partner client. He has send us the requirements over email and', NULL, '2023-08-24 11:45:33', '2023-08-24 11:45:33'),
(28, 489862, 'Nakisha Kinlaw', 'kinlawconsulting@gmail.com', 'USA', 'City: Boynton Beach . State: Fl', NULL, 'Suvendu Mour', 'Prodipto', 'Client signed up for a website. She liked this (www.elevateyourhealth.co.uk) for her business. She is into employee wellness consultation . We had also talked about the hosting as well. Price quoted was 260 USD for 3 years.', NULL, '2023-08-24 11:49:36', '2023-08-24 11:49:36'),
(29, 905874, 'Khurram Hussain', 'khurramhussain@mojosol.com', 'USA', 'California', NULL, 'Sudhansu Sekhar Sahu', 'Pritam', 'Client has a business of security door bell. He is launching this business. He signed up for 100 USD to create a marketing plan and competitor research. His competitors are: https://ring.com/ and https://www.arlo.com/en-us/. Asked to call back 3 PM PST (4.30 AM IST) tomorrow. Also he asked to send a calendar link and a meeting link. Copy muhammadkashan@irvinei.com on every email.', NULL, '2023-08-24 11:52:58', '2023-08-24 11:52:58'),
(30, 389429, 'MICHELE GRAMMATIKAS', 'micheleagramm@gmail.com', 'USA', 'DANA POINT, CA.', NULL, 'Soumyajit Singha', 'Prodipto', '\"Client Signed up for Social Media Marketing. She has a great knowledge on digital marketing. She is into construction and has started real estate investment. She wants to create the brand awareness for the real estate one. She wants us to help her with that. She has ran campaigns on her facebook before so she is aware of the\r\npart as well. Also, She will be needing an landing page. She has been given a combined package of landing page and social media marketing in 250 USD. She has told if she is getting good work she will upgrade the plan. AM team needs to call her on Monday at 1 PM EST', NULL, '2023-08-24 11:57:56', '2023-08-24 11:57:56'),
(31, 779926, 'Johann Goeb', 'info@reseaudereferencenational.com', 'Canada', 'Canada', NULL, 'Misc', 'Prodipto', 'Client signed up for a website. He is a partner client. He needs a website where the contents will be provided by him only. He needs contents in two languages, i.e, English and French. Both of them will be provided by him only. Also, for one of his client we need to change the resolution of a logo and needs to send him in vector format by tomorrow itself. For the website he will get in touch with us soon. Current priority is to get the logo work and mock up done by tomorrow itself.** He needs the logo within 24', NULL, '2023-08-24 12:02:00', '2023-08-24 12:02:00'),
(32, 695366, 'Kayvon Javid', 'onecure@aol.com', 'USA', 'California', NULL, 'Akash Nag', 'Akash', 'Client provide dental service and his website is https://drsmilenewport.com/. Sign up for Facebook, Instagram and SEO. Sign up amount $300 for month. Client did not provide any convenient time till yet to be in touch with him. He will be busy right now he will inform us for the good time when AM team needs to contact with him.', NULL, '2023-08-24 12:05:11', '2023-08-24 12:05:11'),
(33, 883069, 'Matthew Lopez', 'matthew@localbidz.org', 'USA', 'TEXAS', NULL, 'SUMAN', 'Akash', '\"Client sign up for Social media handling posting And Affiliated link creation and also editing videos for $600 for month. We have to take care of affiliate accounts creation where we have put on his content we are creating using veed.io. We also have to create personal accounts for him and using that personal account we have to follow 100 random people and also we have to comment on those post made by the affiliate links. For videos he will be providing us the content of his where we have to just make those videos in a sync with the audio files using https://www.veed.io/ and have to save in different languages. Also social media platforms will be only Facebook, Instagram, LinkedIn & Twitter. We have to create 3 videos a day, 3 affiliate links and also personal account creation. For understanding the project there is couple of links below,\r\nhttps://docs.google.com/document/d/1zGb65iGYNfP-wylaksy65YrM7L2nI6nMn9hIFN7Xqm8/edit?invite=CIzuoIUJ\r\nhttps://drive.google.com/drive/folders/1uWgqGlvPaas3Y92ixOkX-6-SKGtWc_qa\r\nhttps://docs.google.com/spreadsheets/d/1yjWjRfrgeMAaSOKyqFWfNIaWko3sr8lBy7PkFSMRBuk/edit?invite=CIjR5psG#gid=0\r\nhttps://docs.google.com/spreadsheets/d/1yDF1F5_crmZyxNDXx5yiWAgibxYbbHRx8Xr95fGOvdY/edit?invite=CKm9-5wG#gid=0\r\nAM team needs to call him at 2.30 IST.\r\n\r\nVEED - Edit, Record & Livestream Video - Online\r\nAn online video suite for professionals. Record, edit and stream your videos in the cloud. The fastest and easiest way to make professional-quality videos.\r\nwww.veed.io\"', NULL, '2023-08-24 12:16:57', '2023-08-24 12:16:57'),
(34, 404606, 'Nancy Beckwith', 'nancy@executiveelement.com', 'USA', 'california', NULL, 'SUMAN', 'Prodipto', 'Client signed up for social media promotion, she don\'t need leads. she want to built a brand of her business we will be covering facebook, instagram and linkedin. Also we need to write the content for her GODADDY website.She give 200usd to marketing and 100usd for content writing for website. AM teams need to call him at', NULL, '2023-08-24 12:47:44', '2023-08-24 12:47:44'),
(35, 357081, 'Johan Ospina', 'johan@digitaljohan.com', 'USA', '\"City Chicago State Illinois\"', NULL, 'Debjoti Dutta', 'Prodipto', 'Client signed up for SMO,he is a partner client,he does not have any social media present so he want to generate business,leeds from social media platforms. While paying us stripe showed client that the payment is not processed earlier and then later he got message from his bank that the amount is discharged. And also we have received the payment as well. We have told client that if it gets reversed, he should take care of it. If something like that happens you guys take care. AM team needs to call him today 1 AM IST.', NULL, '2023-08-24 12:52:47', '2023-08-24 12:52:47'),
(36, 276548, 'Thesan Muthiah', 'mtheesan@yahoo.com', 'USA', 'Toronto, On', NULL, 'Satyajit', 'Pritam', 'He is looking to build a basic website for a international school. Project cost US$450 and paid upfront amount of US$250. AM team need to call him tomorrow 9.2.23 after 12PM EST.', NULL, '2023-08-24 15:27:50', '2023-08-24 15:27:50'),
(37, 872141, 'Christine Bieri', 'christine@cbierisolutions.com', 'USA', '\"Greenfield Park , Qu, Canada \"', NULL, 'Abhay Bhanjo', 'Akash', 'Client has a social media site https://newborhoodtalks.com. We have to take care of marketing. She is looking for more engagement on that platform. She is getting audience sign in that platform but can not getting engagement from those audience. We will take care of Facebook, Instagram, Twitter and Google promotion. Sign up with US$400 for month. AM team needs to call her tomorrow morning at 10AM EST.', NULL, '2023-08-24 15:30:48', '2023-08-24 15:30:48'),
(38, 186953, 'michael morosi', 'contractor2020@gmail.com', 'USA', 'City: binghamton,Ne', NULL, 'Sayani', 'Prodipto', 'Client signed up for a landing page on wordpress. All of the details has been sent to us by client. Sending you the details over here. He just wants to replicate the pdf into the landing page after some modifications. AM team needs to call him at 2.30 IST today.', NULL, '2023-08-24 15:34:20', '2023-08-24 15:34:20'),
(39, 881932, 'Abner DeSousa', 'Ades3225@gmail.com', 'USA', '\"Brockton , Ma \"', NULL, 'Abhay Bhanja', 'Akash', 'He is a partner client. He have one website https://baptistgrace.com/ which he want to redesign. He showed two websites https://newlifesouthcoast.com/ & https://north.newlifechurch.org/. He wants a video banner as well for that he have his own edited video which he will give us. Project cost US$550 and upfront as US$250. AM team needs to follow him at 5 PM EST.', NULL, '2023-08-24 15:40:48', '2023-08-24 15:40:48'),
(40, 945653, 'Alain Adunagow', 'alain@alkatek.com', 'USA', 'Irvine , Ca', NULL, 'Surajit', 'Prodipto', 'Client signed up for a website. He has sent us all the details along with that Sudipto Da knows the brief details of this project. AM needs to call him back after 1hour', NULL, '2023-08-24 15:44:06', '2023-08-24 15:44:06'),
(41, 501932, 'Demarr Pinnock', 'welldrdee@gmail.com', 'USA', 'Jacksonville, FL', NULL, 'SUMAN', 'Akash', '\"\r\nClient run this business https://thewelldr.com/. Sign up for Digimix where we have to take care of Facebook, LinkedIn, Google and Basic SEO. Sign up amount US$350 for month. AM team needs to follow with him after 3 hours around 2 IST.', NULL, '2023-08-24 15:47:57', '2023-08-24 15:47:57'),
(42, 192790, 'Kevin Jackson', 'kevin.jackson@outlook.com', 'USA', 'GREENVILLE,SC', NULL, 'Sarnab Kolay', 'Prodipto', '\"Client signed up for a non profit website. he just has the domain and do not more about it. We have to find whether he has the server or not. If not we have quoted the server cost is 260 dollars for 3 years. His non profit is not incorporated so he is not in a hurry with the website. He has liked the look and feel of compassion.com.', NULL, '2023-08-24 15:51:33', '2023-08-24 15:51:33'),
(43, 469456, 'Raul Torres', 'globowaycommunication@gmail.com', 'USA', 'Lawrence, Ma', NULL, 'Suvendu', 'Akash', 'He is a wholesaler of a energy drink company. Client sign up for a E-commerce website for that. His current website is https://uberwholesaler.com/. Project cost US$2000 and upfront amount US$500. AM team needs to call him tomorrow 16.2.23 at 10 AM EST (8.30 IST)', NULL, '2023-08-24 15:54:52', '2023-08-24 15:54:52'),
(44, 533187, 'Brad Mitchell', 'brad@weightloss-solutions.com', 'USA', 'Id', NULL, 'MISC', 'Pritam', '\"Client signed up for UI/UX design. He is our existing client. He had a bad experience earlier. He needs PSD for his website. We need to take this project as priority and need to deliver it as soon as possible.\r\n\r\nHere is what client says:\r\nI am looking for a UI/UX design with WordPress content.\r\n\r\nCreate a design that we can adapt to every page\r\n\r\nHome page\r\n\r\nUltimate guide page\r\n\r\nBlog home page +each sub page header\r\n\r\nAnd the 3 pages of the Spa Products\r\n\r\nPlease look it over, give me a price.\r\n\r\nPlease keep in mind, I need to get this done fast.\r\n\r\nAM team needs to call him tomorrow (16.2.23 at 10 AM PST)\r\nAssign the project to anyone apart from brian and dev (Client says)\"', NULL, '2023-08-24 15:58:32', '2023-08-24 15:58:32'),
(45, 121904, 'Vasile Buciuman-Coman', 'vasile.coman@xclmail.com', 'USA', 'MA', NULL, 'MISC', 'Pritam', 'Client is an existing client. He is into enterprise design. Client signed up for SMO with 300 USD for Facebook, and Instagram. His website: https://www.xclnav.com/. His target audience is between 20-35 and target area san Jose. He is only targeting IT professionals. He have a budget of 300 USD/week for Facebook advertisement. Initially we also suggested about linkdin advertisement but it seems a bit expensive to him so he will only do Facebook advertisement now. He said that we have to give him the creative\'s dimensions and he will provide us the creative. AM team needs to call him on 13th March at 4 PM CST (3.30 AM IST)', NULL, '2023-08-24 16:01:44', '2023-08-24 16:01:44'),
(46, 486917, 'Dane McFarlin', 'dane.mcfarlin@gmail.com', 'USA', 'Dane McFarlin', NULL, 'Surajit', 'Prodipto', 'Client signed up for a basic website. This is the reference website www.monecity.com. we have to create a website like this with a chatbot tool and inquiry form. He is not decided from where he is going to take the hosting. He will discuss that with his partner and inform us. AM team needs to call him back at 2:15AM today.', NULL, '2023-08-24 16:06:25', '2023-08-24 16:06:25'),
(47, 217533, 'Ali Mahak', 'ali-mahak@msn.com', 'USA', 'Los Angeles, CA', NULL, 'Sarnab Kolay', 'Akash', 'Client is running this dental service https://www.picodentalgroup.com/. He sign up for social media marketing for his business with US$250. We have to take care of Facebook, Instagram, LinkedIn & Google as well. He want Google ad as well for that he will keep a separate ad budget. AM team needs to contact with him tomorrow on 24.2.23 at 10 AM PST (11.30 IST)', NULL, '2023-08-24 16:08:49', '2023-08-24 16:08:49'),
(48, 120020, 'Vineet Unadkat', 'vunadkat@gmail.com', 'USA', 'CA', NULL, 'Suman', 'Pritam', 'client has a restaurant business. His website: https://eatgarbanzo.com/. He signed up for social media marketing for Facebook, Instagram, and Google. AM team needs to call him on either 1 march or 2 nd march.', NULL, '2023-08-24 16:12:21', '2023-08-24 16:12:21'),
(49, 712805, 'PANKAJ AGRAWAL', 'pankajagrawalnj@gmail.com', 'USA', 'PENNINGTON , NE', NULL, 'Surajit', 'Prodipto', 'Client signed up for a landing page redesign. We have to redesign this (gotomentors.com) landing page with new look and feel. He also wants to redesign his main website but he don\'t have the access of the website. This is not included in this package. AM team needs to call him back at 11PM IST today.', NULL, '2023-08-24 16:16:08', '2023-08-24 16:16:08'),
(50, 392656, 'Trent Ballentine', 'trent@manicnomadd.com', 'USA', 'Chicago', NULL, 'MISC', 'Pritam', '\"He is an existing client. He didn\'t liked the work earlier. He signed up for a website project. It is a website project for his friend. He is into pest control. He signed with upfront of 150 USD. Once he sees the mock up and approves it then he will pay another 150 USD and once we will deliver the project then he will pay 300 USD. Logo is included in the project.\r\n\r\nClient have sent some requirements which is as follows: \r\n\r\nI want to get a website set up for my buddy’s pest control business. \r\n\r\n1) I own domain BugOutBugs.com\r\n\r\n2) would need a logo for the business\r\n\r\n3) site with contact submission. \r\n\r\n4) he’s doing business in Omaha Nebraska. \r\n\r\n5) here’s a nice reference site. https://www.spidexx.com/\r\n\r\n6) let’s not show a pest control person in a mask. People have an adversity to chemicals so there’s no need to emphasize the negative of the industry. \r\n\r\nDo not copy the website for mock up rather take ideas and inspiration. AM team needs to call him at 1 CST today (12.30 IST)\"', NULL, '2023-08-24 16:20:40', '2023-08-24 16:20:40'),
(51, 150935, 'SANJEEV KUMAR', 'dhospicellc@gmail.com', 'USA', 'ANDERSON, SC', NULL, 'MISC', 'Akash', 'Client sign up for his YouTube channel promotion. His channel is https://www.youtube.com/@doctorathome1815. He is planning to post two videos in a week and we have to make sure he will get good engagement on that. Client sign up with US$200 for month. AM team have to call him today at 2.30 EST (1 IST).', NULL, '2023-08-24 16:25:48', '2023-08-24 16:25:48'),
(52, 151914, 'Kayvon Javid', 'onecure@aoll.com', 'USA', 'California', NULL, 'MISC', 'Akash', 'Client sign up for redesign of this website https://phlebotomyeducators.com/. We have to take care the entire website as per their requirement and they also want a payment gateway for taking payments online. Project amount is $750 and pay the entire amount as an upfront. AM team need to follow with the client tomorrow as per their convenience. Contact person will be ( Katrina Saldivar, Number: (310) 561-7265, Email: kmcsaldivar@gmail.com)', NULL, '2023-08-24 16:30:28', '2023-08-24 16:30:28'),
(53, 927552, 'Kayvon Javid', 'oneccure@aoll.com', 'USA', 'California', NULL, 'MISC', 'Akash', 'Client sign up for redesign of this website https://phlebotomyeducators.com/. We have to take care the entire website as per their requirement and they also want a payment gateway for taking payments online. Project amount is $750 and pay the entire amount as an upfront. AM team need to follow with the client tomorrow as per their convenience.', NULL, '2023-08-24 16:30:53', '2023-08-24 16:30:53'),
(54, 954099, 'Brad Berekoff', 'brad@cdnroofdr.com', 'USA', '\"Victoria State: Br, Canada\"', NULL, 'Kamaljit', 'Pritam', '\"Client signed up for redesigning of his website: cdnroofdr.com, He liked our website Digitalwebber.com.\r\nHe is looking a modern looking website. In this package Logo+Business card and Introductory video is included. \r\nAM team needs to call him within 5 AM IST today\"', NULL, '2023-08-25 08:33:43', '2023-08-25 08:33:43'),
(55, 592364, 'WILLIAM HARTMAN', 'billhartman@acm.org', 'USA', 'FL', NULL, 'Suvendu (OM)', 'Pritam', '\"He is an existing client. Earlier we didn\'t work well for him because the project manager didn\'t understand his nature of service. This time he said that if he doesn\'t get the work done properly then he will raise the dispute for both of the times. His business is: https://elangomat.org/\r\nthis is basically a boy scouting where they give elangomat training. This is a personality development sort of thing(Training camp). (Kindly do a little bit of research about the elangomat system and order of arrows). He is basically looking for more engagement and want to share his views with others about the elangomat system like what is the problem in the system and what could be change. I gave him an idea that we can target those people who are following this website https://oa-bsa.org/ because they are also into the same nature of service and this is a government organization . So we have to target specific audience and set a strategy in order to generate traffic. \r\n\r\nAlso he was asking that in his website there is no tool through he can track the traffic, so he was asking for some plug in suggestion so that we can track the traffic. So AM also have to give the suggestions as well. \r\n\r\nyou can refer this document to know more about the elangomat(not provided by client): https://www.hoac-bsa.org/Data/Sites/1/media/order-of-the-arrow/oa-documents/elangomat-guide-updated-march-2021.pdf\r\n\r\nAM Team needs to call him on Monday (6th March) at 10.30 AM EST\"', NULL, '2023-08-25 08:37:10', '2023-08-25 08:37:10'),
(56, 425928, 'Alison oconnor', 'oconnor.alison@gmail.com', 'Canada', 'vancouver, Canada', NULL, 'Sayani', 'Prodipto', 'Client signed up for Social Media Marketing for her ERC business. She is also willing to run the ad campaigns but she is very much concerned about the budget regarding the ad campaign. This is her landing page - https://ercfilenow.com/r/grantassistance. She is more interested in running the video ads only. AM Team needs to call her today, i.e, 08.03.23 at 10 AM PST, i.e, 11.30 PM IST.', NULL, '2023-08-25 08:40:38', '2023-08-25 08:40:38'),
(57, 141031, 'Luis Gouveia', 'luis@omniblvd.com', 'USA', 'New York', NULL, 'MISC', 'Pritam', 'This is the project of one of his client. We have to create 16 banner and 4 videos in a month. We have to do the posting as well. He said he will not work through Bitrix. He will give the high-level CRM access. And there he will create the the user dashboard. AM team needs to call him tomorrow(9.3.23) between 9 AM-11 AM EST', NULL, '2023-08-25 08:44:03', '2023-08-25 08:44:03'),
(58, 496307, 'Manish Jain', 'manish@krivtech.com', 'USA', 'BRENTWOOD , Ca', NULL, 'Surajit', 'Akash', 'He is partner client and sign up for a SEO project. He have a client where she is into real estate. We have to take care of only SEO for that business and we have to use at least 10 keywords for that. Sign up with 300USD for one month. He also mention he did not like DEEP as a project manager so we have to give him a different project manager who can understand his needs better way and do proper communication with him. He will share the business details to the project manager as well. He also mention he is trying for one month if we do a good job then he will give this SEO project for long term and also he might give the Google PPC project of this business. AM team have to contact with him at 1.30 PM PST (3 AM IST).', NULL, '2023-08-25 08:47:46', '2023-08-25 08:47:46'),
(59, 555607, 'Kola Adetola', 'koadetola@gmail.com', 'USA', 'MA', NULL, 'Debjoti', 'Pritam', 'Client has signed up for a website development. He is looking for a template website like https://21cig.capital/en/. And he is looking for the content from https://www.marketprohomebuyers.com/. He wants a contact from on this website like https://fasthomeoffer.com/. He will also provide some of the contents. Along with this we have to switch his domain from providenceaccounting-appraisal to providenceappraisal for one of his other website. AM Team needs to call him on Monday at 4.00 PM EST (2 AM IST)', NULL, '2023-08-25 08:51:50', '2023-08-25 08:51:50'),
(60, 517545, 'ALBERT Philbert', 'alphi101@yahoo.com', 'USA', 'GEORGIA', NULL, 'SUMAN', 'Prodipto', '\"Client signed up for social media marketing for his debt management business which he has started 3 years ago. He hasn\'t done anything regarding marketing for the business. We will be helping him to generate leads, he has a website but he doesn\'t want to use that for fetching leads. He will developing new website with the help of us very soon. Just to start the work we have told that we will start with organic marketing. Client is a very busy person so he doesn\'t have much time to give on the project. AM team needs to call him tomorrow, i.e, 14.3.23 at 10 AM EST', NULL, '2023-08-25 08:54:51', '2023-08-25 08:54:51'),
(61, 140678, 'Orsel Mcghee', 'orselsmcghee@gmail.com', 'USA', 'CA', NULL, 'MISC', 'Pritam', 'The SSL has expired for https://thehipsteragency.com/. We have to integrate the SSL for 1 year.', NULL, '2023-08-25 08:57:40', '2023-08-25 08:57:40'),
(62, 828852, 'Lisa Gibson', 'mylisa@renmanserv.com', 'USA', 'New York', NULL, 'Misc', 'Prodipto', 'Client signed up for doing some changes in the website of her client. Website URL is http://www.phcpdaycare.org. We need to update some information and remove the newsletter section and the footer name. Client has asked to communicate with her through skype only. He has added Max on her skype and wants the AM to be added over there only.', NULL, '2023-08-25 09:00:48', '2023-08-25 09:00:48'),
(63, 453341, 'Sui Chin', 'contactcwim@gmail.com', 'USA', 'Ottawa , ON', NULL, 'Abhay Bhanjo', 'Prodipto', '\"Client signed up for a website for her charity named chinwomeninternationalmission.com. She wants home, who we are, picture, event, blog, article, Donate box and also and ebook download option as well. She also needs video links to be added in the website.\r\nAM team needs to communicate with her through zoom. She will send us the zoom call details from her end. As Client has done wire transfer and she was not willing to pay the additional charges of 15 CAD. So we have offered that the additional charges that client is paying will be adjusted from the gross amount of the project.\"', NULL, '2023-08-25 09:03:23', '2023-08-25 09:03:23'),
(64, 284879, 'Asia Mion', 'brooksfoundation0@gmail.com', 'USA', 'Jackson , MS', NULL, 'Abhay Bhanja', 'Prodipto', 'We have reactivated the project. The details already send to the project manager.', NULL, '2023-08-25 09:07:26', '2023-08-25 09:07:26'),
(65, 177802, 'Jum Raoof', 'newworldproductsusa@gmail.com', 'USA', 'Georgia', NULL, 'MISC', 'Saikat', '\"Client sign up for price changes for his website https://www.childrensbooksandmusic.com/. Client is already provided a document file for the price changes. \r\nAlso we have to create a landing page for him. Landing page will be same like this https://www.childrensbooksandmusic.com/special-discount-for-schools/ page. But this landing page is for schools only and when they will purchase the product they will not have to pay the VAT charges that time. \r\nAM team have to contact with him tomorrow on 22.3.23 at 6.30PM Eastern time (4.00 AM IST)\"', NULL, '2023-08-25 09:11:12', '2023-08-25 09:11:12'),
(66, 654763, 'Gilbert Tsaturyan', 'firsteaglehospice@gmail.com', 'USA', 'Los Angeles, CA', NULL, 'Misc', 'Saikat', 'Client signed up for 1 year hosting and SSL.', NULL, '2023-08-25 09:30:46', '2023-08-25 09:30:46'),
(67, 233872, 'Ronald Keller', 'info@discountgoldanddiamonds.com', 'USA', 'New York', NULL, 'MISC', 'Akash', '\"Client sign up with $200 for Google Ad Campaign. He is planning to get more reach and business by doing Google Ad Campaign into his website. For the campaign he have a separate ad budget of $200 for month. He is already doing Bing Ad as he mentioned me. He also told about his requirement. His targeted audience is Women above 25 Years and target market is entire USA. He is also told that he want clients will come with using their desktop not from their mobile phones. Also we have to integrate the google analytics for him and AM team have to call him on 27.3.23 at 1.30 IST.\r\n\r\n USE OUR BUSINESS NAME AS WEBART TECHNOLOGY PVT. LTD.', NULL, '2023-08-25 09:36:52', '2023-08-25 09:36:52'),
(68, 200298, 'Marcial Cordon', 'marcialcordon@gmail.com', 'USA', 'East Elmhurst,Ne', NULL, 'Sarnab Kolay', 'Prodipto', 'Client signed up for a landing page for his client, where he is a wholeseller under https://aquafeelsolutions.com/. He needs content similar to the website https://aquafeelsolutions.com/. He also needs a logo, business card and an inquiry form as well. AM team needs to call him tomorrow, 28.3.23 at 10.45 AM EST. i.e, 8.15 PM IST', NULL, '2023-08-25 09:40:23', '2023-08-25 09:40:23'),
(69, 290496, 'Paul Chesher', 'paul.c@mediatownmarketing.com', 'USA', 'Ontario, Canada', NULL, 'Kamaljeet', 'Pritam', 'Client is in ecommerce business. His website: https://www.jeepbeef.com/. Client wants to do only paid advertisement. Please do not do any kind of Organic marketing. AM team needs to call him on Monday at 4.30 PM EST (2.00 AM IST)', NULL, '2023-08-25 09:43:26', '2023-08-25 09:43:26'),
(70, 357367, 'JASON LIPSTEIN', 'MARKATOONSTV@GMAIL.COM', 'USA', 'SAINT-LAURENT , QC', NULL, 'Surajit', 'Prodipto', 'Client is a partner client. Signed up for social media marketing on facebook , instagram, linkedin for his buiness. AM needs to call him at 11:45 AM IST today.', NULL, '2023-08-25 09:47:35', '2023-08-25 09:47:35'),
(71, 984698, 'Temitope Hushie', 'greendeltaauction@gmail.com', 'USA', 'kentucky', NULL, 'Suman', 'Prodipto', '\"client signed for website he already purchsed the divi theme . we just have to build the website. he is into in skin product business. AM team needs to call him tomorow at 6pm to 6:30pm (est) her time.', NULL, '2023-08-25 09:50:33', '2023-08-25 09:50:33'),
(72, 413801, 'Tracy Jordan', 'tjordan225@gmail.com', 'USA', 'Texas', NULL, 'Misc', 'Prodipto', 'Client signed up for Social Media Marketing for 1 month. He has a construction business. He has the instagram handle but he is not sure about the facebook, we have told him that we will help him in creating a new facebook page if he doesnt have. AM team needs to all him in 30 Mins, i.e, 9.45 PM IST today', NULL, '2023-08-25 09:54:16', '2023-08-25 09:54:16'),
(73, 359320, 'Trevor Forde', 'trevorforde@yahoo.com', 'USA', 'Ne', NULL, 'satyajit das', 'Pritam', '\"Client signed up for social media marketing. His website is http://zulujuice.com/ \r\nHe is currently working on the four products Zulu tea, Zulu juice, zulu bitter crystals and zulu beauty products (Blood of Gods)\r\nHis physical presence is in Atlanta, Georgia. In all the creatives we have to use that address only. He will send the contact number and complete address of the business.\r\nHis primary focus area is: Atlanta, Georgia\r\nPrimary focus audience: Black People only\r\nAM team needs to call him today at 1.30 PM EST(11.30 PM IST). He said that there will be another person to assist on the project as he can not speak always (Her name will be Mellissa)\r\nPayment Method: Payoneer\"', NULL, '2023-08-25 09:58:02', '2023-08-25 09:58:02'),
(74, 352948, 'Patrick Lawson', 'universepat@gmail.com', 'USA', 'Washington', NULL, 'amitavo chakraborty', 'Prodipto', 'client signed up for social media marketing for one month. he is starting a property management business . he is in the registration phase and we need to help him with the brand awareness of his business. platform mentioned are - facebook , instagram and linkedin. AM team needs to call him tomorrow,i.e, 11.04.23 at 1:00pm PST,i.e, 1.30 AM IST.', NULL, '2023-08-25 10:01:41', '2023-08-25 10:01:41'),
(75, 694733, 'Michael Cain', 'mikecaininc@gmail.com', 'USA', 'Texas', NULL, 'Sayani Nag', 'Akash', 'Client is running this business https://www.insurancebymikecain.com/ where he is looking for leads of people of above 65 age group. We have to take care of Facebook and Google marketing for him. He have another website http://mikecain.buymedigap.net/. Client is also using a platform call t65.app where he get information of people of 65 above age group. Client sign up with $250 for month. He will also have a Ad budget for ad campaign. AM team need to follow him on 13.4.23 at 3.30PM Central Time (2 AM IST).', NULL, '2023-08-25 10:04:46', '2023-08-25 10:04:46'),
(76, 916287, 'Gerard Jang', 'Infinityrentals41@gmail.com', 'USA', 'Maryland', NULL, 'Prodipto', 'Saikat', 'Client signed up for a car rental application. He has already discussed about the entire project with Brian. He has paid the first phase out of ten installments. The first installment he has paid is for the figma designs. AM team needs to call him at 7 pm EST today.', NULL, '2023-08-25 10:08:59', '2023-08-25 10:08:59'),
(77, 646873, 'yourdesignsource', 'dee@naturalremedee.com', 'USA', '\"Illinois \"', NULL, 'SUMAN', 'Prodipto', '\"Client has reactivated her project. She needs some modification on her website - yourdesignsource. She wants her website to be running on her server. AM team needs to call her tomorrow, i.e, 14.04.23 at 3.30 CST. She has told brian to be her project manager', NULL, '2023-08-25 10:11:50', '2023-08-25 10:11:50'),
(78, 932737, 'JONATHAN BORTHWICK', 'JBORTHWICKOG@GMAIL.COM', 'USA', 'LANGLEY, BC, CANADA', NULL, 'Sayani', 'Akash', 'Client is selling online comic on this platform https://trollandunicorn.com/site/. His website is in under-construction by a fiber guy. Client sign up for marketing and more engagement into his platform where he want more users can log in to that platform by organically. Sign up with CA$250 ($186.61). We have to take care of his Facebook, Instagram and Twitter. AM team have to contact with him tomorrow on 18.04.23 around 12-1 PM PST (12.30-1.30 IST).', NULL, '2023-08-25 10:14:19', '2023-08-25 10:14:19'),
(79, 871734, 'Jonathan Borthwick', 'JBORTHWICKOGeg@GMAIL.COM', 'USA', 'Langley', NULL, 'Sayani', 'Saikat', 'Client wants to get a logo created for his business. This is an up sale, it is closed by Pinak.', NULL, '2023-08-25 10:17:44', '2023-08-25 10:17:44'),
(80, 610257, 'Rajdeep Singh', 'admin@flexpaintinginc.com', 'USA', 'Bolton, Canada', NULL, 'Debjoti Dutta', 'Prodipto', 'Client signed up for google listing, local listing and article posting on all the business directories and local directories of his local area. AM team needs to call him in 45 mins 4:30 AM IST.', NULL, '2023-08-25 10:20:45', '2023-08-25 10:20:45'),
(81, 553458, 'William Welch', 'wtwelch@spectrointelligence.com', 'USA', 'Ashland, KY', NULL, 'ANIKET SAHA', 'Saikat', 'client signed up for SMM. We need to handle his facebook and linkedin. We need to boost his webinar and bring more engagements in it. He will provide us three videos in a month, we need to post them and do organic marketting. AM team needs to call him 6 pm eastern his time which is 3:30 am ist.', NULL, '2023-08-25 10:32:21', '2023-08-25 10:32:21'),
(82, 243944, 'JAMES SHIELDS', 'skybum@gmail.com', 'USA', 'Illinois', NULL, 'Akash', 'Saikat', 'Client sign up for a restaurant website. He is looking for a website where he is planning to showcase his restaurant menus and also planning a online reservation with his website. Client sign up for $850 for the website and $100 for the logo design. Client pays $300 as an upfront amount to initiate the work. AM team needs to follow him on Friday 28.04.23 around 11AM Central Time (9.30PM IST). He also provided us the logo requirements (i.e. Branched and herbs like they are growing out of the logo, only to the one without the olive in the Y). He wants a vintage look with his logo where we can customize with his given samples or we can use other templates. We also promised to give him logo samples on Friday when AM will contact with him.', NULL, '2023-08-25 10:35:30', '2023-08-25 10:35:30'),
(83, 228763, 'Chase Gregory', 'chasegregory1@gmail.com', 'USA', 'FLORIDA', NULL, 'SUMAN', 'Prodipto', 'Client signed up for graphic designing work , where we have to create 15 creative and 5 motion graphic. He paid half of amount for work and half of amount he will pay after seeing the work. AM team need to call him 2:30am(IST).', NULL, '2023-08-25 10:38:01', '2023-08-25 10:38:01'),
(84, 240887, 'Shawn Ferreira', 'shawn@anilloworldwide.org', 'USA', 'FLORIDA', NULL, 'Aniket', 'Akash', 'He is providing English tuition and language courses. He is already doing marketing on Instagram but right now he is looking for more students who can take classes from his end. For that we will be taking care of marketing for him on Facebook, Instagram and LinkedIn. For that he sign up with $200 for marketing. We will give him this month as complementary service with Research and development and we can start marketing on very 1st of the month of May and we told him that renewal will be on the 1st of June. AM team need to follow him back tomorrow 26.04.23 around 11 AM EST (8.30 PM IST).', NULL, '2023-08-25 10:41:05', '2023-08-25 10:41:05'),
(85, 641859, 'Jijo Joseph', 'jijo.joseph@jrmunique.com', 'USA', 'Calgary, Alberta, Canada', NULL, 'Kamaljeet + Sayani', 'Saikat', 'Client is running an IT service. His only concern is looking for generating at least of 3-5 qualified leads in a month for his business. We need to run the campaign from our end only. For that he signed up with CA$500 for the marketing. He did not provide any follow up call. AM team have to follow him up.', NULL, '2023-08-25 10:44:06', '2023-08-25 10:44:06'),
(86, 248809, 'Yaroslav Drozdyuk', 'slavic@slavicd.com', 'USA', 'Kentucky, US', NULL, 'ANIKET', 'Akash', 'Client is looking for a Handyman website. He is using https://slavicd.com/handy.html this page for the service and wants to build a website like https://www.northseattlehandyman.com/. He also mentioned that he will not go for the Wordpress website so we have to built that website in Custom PHP. He sign up with $300 and rest of the $500 he will pay us at the time of delivery. AM team need to call him on 27.4.23 at 11AM Eastern Time (8.30PM IST).', NULL, '2023-08-25 10:47:10', '2023-08-25 10:47:10'),
(87, 929380, 'Ernesto Toscano Gama', 'info@mystaffhero.com', 'USA', '\"Washington  \"', NULL, 'Sarnab Kolay', 'Prodipto', 'Client is a partner client. He has signed up for a project where we need to handle the social media handling of his client and also we need to edit 3 -4 videos that the client will provide us. We also need to design the landing page for the client. The client has not yet closed the deal so he has also said that if the client does not onboard with him, he will use this as a credit and will use this for any other project that he will close. He has not given us the call back time so the AM team needs to call him at 1 PM PST today, i.e, 27.4.23', NULL, '2023-08-25 10:49:24', '2023-08-25 10:49:24'),
(88, 229240, 'Edward Naso', 'Ed@nasopools.com', 'USA', '\"Cresskill, NE \"', NULL, 'ANIKET', 'Akash', 'Client sign up for YouTube intro and outro video for his YouTube channel. His YouTube channel is based on his business and he provide pool cleaning and repairing services. His website is https://nasopools.com/. Project amount $100 and paid entire upfront amount. Follow Up with client by tomorrow 28.4.23 at 2PM EST (11:30 IST).', NULL, '2023-08-25 10:53:02', '2023-08-25 10:53:02'),
(89, 211191, 'Laurel Archer', 'carytutor@gmail.com', 'USA', 'RALEIGH North Carolina', NULL, 'ANIKET', 'Prodipto', 'Client signed up for instagram marketing for her teaching business. She is an english teacher. She wants to promote herself in the indian market. She wants to reach to indian people who wants to learn english. Client has paid 100 USD now and the rest 50 USD she will be paying tomorrow. AM team needs to call her tomorrow, i.e, 05.05.23 at 1.30 ES', NULL, '2023-08-25 10:55:36', '2023-08-25 10:55:36'),
(90, 360780, 'Michael McCracken', 'mike@oldsouthco.com', 'USA', 'Lewisville , Te', NULL, 'Surajit', 'Akash', 'Client signed up for a basic website. His current website is (http://www.oldsouthco.com/). Client will fill up the questionnaire form. AM team needs to call him at 3pm CST (1:30AM IST) today.', NULL, '2023-08-25 10:58:34', '2023-08-25 10:58:34'),
(91, 931357, 'Jamel Wade', 'info@7od.org', 'USA', 'marryland', NULL, 'SUMAN', 'Prodipto', '\"client needs \r\nNeeds:\r\n\r\n· Color Correction\r\n\r\n· Color Grading\r\n\r\n· Sound leveling\r\n\r\non a video . \r\nsharing you the drive link - https://drive.google.com/file/d/1dU60iP2VcSq_yDKaoh2FjCtkgUDdPi75/view\r\nAM team needs to call him after 6 AM IST tomorrow.\"', NULL, '2023-08-25 11:01:34', '2023-08-25 11:01:34'),
(92, 557899, 'John Lee', 'johnnylee27@gmail.com', 'USA', 'Alabama', NULL, 'ANIKET', 'Prodipto', 'Client signed up for youtube marketing for 3 months his youtube channel. He is more focusing on the hashtags and also as he had already worked with us he has told to make intro a bit shorter in terms of duration. Also, we need to do the email marketing. He has some sample email templates with him he will be sharing that with us, and he has asked us to use those templates as testing. Then we need to create the templates for him for blasting. AM team needs to call him today at 1 PM CST, i.e, 11.30 PM IST', NULL, '2023-08-25 11:04:07', '2023-08-25 11:04:07'),
(93, 783218, 'Malick Traore Dermane', 'mtdermane@gmail.com', 'USA', 'Montreal, Qu, Canada', NULL, 'Kamaljit', 'Akash', 'Client is a developer. He is developing an web application by his end. For that he is looking for 7 UI Slide design. We have to create slides as per his requirement. He will have his logo and details which we can use for design. Entire project cost is CA$400 and sign up with CA$200. AM team need to call him in 20 minutes from our end at 2.10AM IST (4.40 EST) because he will not be available after 5 EST time.', NULL, '2023-08-25 11:24:21', '2023-08-25 11:24:21'),
(94, 398385, 'Christopher Reeves', 'technology@taktyx.com', 'USA', 'Georgia', NULL, 'Md Sahil Islam', 'Prodipto', 'Client signed up for social media marketing for 1 month. He is a partner client who has just started the business. We will be promoting and help him to get clients through organic marketing. AM team needs to call him on Monday, i.e, 15.05.23 at 6.30 PM his time, 4 AM IST.', NULL, '2023-08-25 11:26:59', '2023-08-25 11:26:59'),
(95, 345532, 'Jacqueline Lawrence', 'jacquelinedlawrence@gmail.com', 'USA', 'State ,Ca', NULL, 'Sayani', 'Prodipto', 'Client signed up for SMO for her non profit. She is looking for more donations. We will be handling facebook, instagram and youtube. For the youtube, she already has the videos we need to just create a new youtube channel and we need to upload that videos on the new channel. We have promised the ssl certification for her website complementary from our end. AM team needs to call her at 2.10 AM IST today.', NULL, '2023-08-25 11:29:19', '2023-08-25 11:29:19'),
(96, 989858, 'Stephe pagac', 'innovations@garrisongrip.com', 'USA', 'Arizona', NULL, 'Suman', 'Prodipto', '\"Client signed up for SMO for 15 days (250usd , if client like the work then he will pay again after 15 days.we have to make 4 videos for the entire month. The duration of the video will 1 minute 10 second. We have to take care of facebook, instagram, twitter and Youtube. Am team needs to call him on Monday at 8 AM PST,', NULL, '2023-08-25 11:32:01', '2023-08-25 11:32:01');
INSERT INTO `clients` (`id`, `client_code`, `name`, `email`, `country_name`, `address`, `current_website`, `agent_name`, `closer_name`, `remarks`, `deleted_at`, `created_at`, `updated_at`) VALUES
(97, 169399, 'Alvaro PAYERAS', 'Apayeras@gmail.com', 'USA', 'FLORIDA', NULL, 'SUMAN', 'Akash', '\"Client is running a home improvement service called Everglades Kitchen & Bath. Client sign up for a website development where he is planning to showcase his services and his previous works into the portfolio section. The project cost is $560 and sign up with $260. He also told us he have a color preference of the website as green and black. He already have a questionnaire link by his email. AM team have to call him back by tomorrow on 16.05.23 at 6PM Eastern time (3.30 IST)', NULL, '2023-08-25 11:34:30', '2023-08-25 11:34:30'),
(98, 633697, 'Harvinder Dhillon', 'originalsingh00@gmail.com', 'USA', 'Winnapeg, Ma, Canada', NULL, 'Sayani', 'Akash', 'Client is doing Immigration Consultation. He signed up for a website development. We have to build a website for him and he also want to take payment by his website. So we have to take care of payment gateway integration. He will send us some references from his end. His main concern is he wants to build the website that will be complete professional. Project cost is CA$1149 and sign up with CA$400 for the website. AM team can all him on 17.05.23 at 11:30 CST (10 IST) .', NULL, '2023-08-25 11:37:41', '2023-08-25 11:37:41'),
(99, 739525, 'Eduardo Azcoitia', 'accounting@goldenCompassGroup.com', 'USA', 'Texas', NULL, 'Kamaljeet', 'Akash', 'Client is in financial services. His business is goldenCompassGroup.com. He signed up for social media marketing for 2 business for 60 days. We have to do social media marketing on Facebook, Instagram, LinkedIn. As he mentioned one of the business is his financial business we have to take care another one is for one his client who is also into the same nature of business. Project cost is $500 for 60 Days for 2 businesses. AM team can contact with him on 17.05.23 at 12.30pm CST (11 IST).', NULL, '2023-08-25 11:40:22', '2023-08-25 11:40:22'),
(100, 977503, 'Raymond Mullaney', 'ray@ers.ai', 'USA', 'Rhode Island', NULL, 'Misc', 'Prodipto', 'Client signed up for 2 videos where he wants to explain what his product does. He wants to explain this page - https://www.fiduciaryriskratings.com/active-risk-monitoring/. He has liked the work of salish dictionary\'s video. If we can give him good quality he will give us more work. AM team needs to call him tomorrow, 18.05.23 at 11 AM EST, i.e, 8.30 PM IST.', NULL, '2023-08-25 11:42:59', '2023-08-25 11:42:59'),
(101, 612434, 'adam adam', 'usflooringfactory1@yahoo.com', 'USA', '\"City: houston State: TX\"', NULL, 'Satyajit Das', 'Prodipto', '\"Client signed up for the landing page for his website. His business name is https://museuminstallation.com/. In this website his banner is not popping and that is a upsale point but before that we need to show him the landing page. AM team needs to call him tomorrow, i.e, 19.05.23 at 12 noon CST, i.e, 10.30 PM IST.\r\n\r\nMuseum - Granite - Quartz - Cabinet\r\nRemodeling Experience Museum Flooring - Quality with Exceptional Service At Museum Flooring, Cabinet, Quartz, Granite.\r\nmuseuminstallation.com\"', NULL, '2023-08-25 11:45:48', '2023-08-25 11:45:48'),
(102, 889106, 'Eric Anderson', 'eanderson11200@gmail.com', 'USA', 'NJ, USA', NULL, 'MISC', 'Akash', 'Client is looking for fundraising campaign for his Go Fund Me. His campaign link is https://www.gofundme.com/f/patents-inventions-that-would-improve-life?utm_campaign=p_lico+share-sheet&utm_medium=copy_link&utm_source=customer. We have to help him for collecting fund for him. As he do not have money right now he sign up for 15 Days Marketing for him with $100. Marketing package is $200 for month. AM team need to call him on monday 22.05.23 at 3 PM EST (12.30 IST).', NULL, '2023-08-25 11:48:45', '2023-08-25 11:48:45'),
(103, 582981, 'filmore francis', 'info@yvemoreenterprise.com', 'USA', 'Florida', NULL, 'KAMALJEET SINGH', 'Akash', 'Client is providing business credit and business loans. He have a website https://yvemoreenterprise.com/. He sign up for social media marketing on Facebook, Instagram, LinkedIn & Google promotion. His main focus is generating leads for his business. Sign up for two month of marketing for $500. He will also invest on Ad Budget. AM team needs to contact with him on Monday 22.05.23 at 10.30 EST (8 IST|).', NULL, '2023-08-25 11:51:57', '2023-08-25 11:51:57'),
(104, 731322, 'Jorge Alsina', 'forallyousend@gmail.com', 'USA', 'texas', NULL, 'suman', 'Prodipto', 'He is a partner client. He is into in insurance. We have to generate leads for his insurance business from instagram and facebook, he like https://ltinsures.com/. He want to taste us our services weather we are capable or not, if he like the work then he will continue the services.AM team leads to call him at 11:30pm(ist) i;e 1pm cst', NULL, '2023-08-25 11:54:59', '2023-08-25 11:54:59'),
(105, 721750, 'Dayna Hale', 'dayna@goldfieldsglobal.com', 'USA', 'Ontario, Canada', NULL, 'Md Sahil Islam', 'Akash', '\"Client sign up for one Logo and Business Card Design (2 Revision mentioned) for her son\'s business. For that she pay CA$100. She recently fired her graphics designer. If we deliver quality work to her she have more graphics projects that she will outsource to us. She is also planning to hire us as for her graphics work as she mentioned earlier. \r\n(6\"\"x8\"\" \r\nHale Lawn Service \r\nCarson Hale \r\n647 619 8449\r\n\r\nLawn cutting \r\nTrimming\r\nRemoval services) This is the information for the business card. \r\nAM team need to call her today at 12.15 IST.\"', NULL, '2023-08-25 11:58:30', '2023-08-25 11:58:30'),
(106, 192699, 'Serkan Turhan', 'sekoo2@gmail.com', 'USA', 'Mooresville , No', NULL, 'Surajit', 'Prodipto', 'Client is a partner client. Signed up for Social media marketing on Facebook. He will share his Ad budget with his Project Manager. AM team needs to call him between 3:00AM-3:05AM IST today.', NULL, '2023-08-25 12:01:53', '2023-08-25 12:01:53'),
(107, 186129, 'DAVID HOCKEY', 'dave@avav.ca', 'Canada', 'CANADA', NULL, 'SUMAN', 'Akash', '\"Client sign up for a custom website design where client wants to sell MP3 Special Occasion Song with buyer\'s personally spoken story/message inserted. Once customer will purchase the music they can upload or record the narration for final touch. And super admin will customize that and will deliver the final product to the website with a link which customers can share and they can Download or Listen from there. Project value is 3600 USD and sign up with 900 USD. He will pay rest amount in easy 3 breakups. He also mentioned that he can pay the 2nd Installment by 1st week of June. He will be going to USA by tomorrow to her daughter house. AM team have to contact with him in 15 minutes (4.55 AM IST).\r\n(His Skype ID is knightshot and address him as David)\"', NULL, '2023-08-25 12:04:59', '2023-08-25 12:04:59'),
(108, 498788, 'Marcial Cordon', 'marcialcordoon@gmail.com', 'USA', 'State: Ne', NULL, 'Misc', 'Prodipto', 'Client signed up for a non profit website. He is already a client of us. He asked us to be more specific in the communication process. Also, the project that we are working he is looking to get it delivered as soon as possible. AM team need to call him tomorrow at 10.30 AM EST, i.e, 8 PM IST.', NULL, '2023-08-25 12:09:03', '2023-08-25 12:09:03'),
(109, 739227, 'Frank Scurlock', 'frankscurlock@me.com', 'USA', 'Florida', NULL, 'Aniket', 'Prodipto', 'Client signed up for Facebook marketing and blog posting for his non - profit. His website is https://noigilerfoundation.org. AM team needs to call him today at 4 AM IST.', NULL, '2023-08-25 12:15:58', '2023-08-25 12:15:58'),
(110, 399450, 'Paul Meunier', 'sexytimetoys69@gmail.com', 'Canada', 'Ontario, Canada', NULL, 'Sayani', 'Akash', 'Client sign up for shopify customization where he will sell some adult products. He is already working on his website but due to some time issue currently he is not able to do the work. We have to take care of product upload as category wise and we have to take care of images and banners of website. He told that he have CSV file for his products. AM team have to contact with him at 4pm EST (1.30 IST). He will give the website access to the project manager itself.', NULL, '2023-08-25 12:21:04', '2023-08-25 12:21:04'),
(111, 351303, 'Jai Waterman', 'accounting@blockstation.com', 'USA', '\" State: new york\"', NULL, 'satyajit das', 'Prodipto', 'client signed up for PSD Mock up for a Website for stock exchange website. The client will give us the information about the call back time.', NULL, '2023-08-25 12:24:01', '2023-08-25 12:24:01'),
(112, 138612, 'Randolph Duke', 'rduke777@gmail.com', 'USA', 'Texas', NULL, 'Aniket', 'Prodipto', 'Client signed up for social media marketing for 1 month. He wants to drive traffic on https://www.weroutefreedom.com/?elevate and https://www.profitacceleratorsystem.com/fun/?page=optin&id=rduke777&wid=hb-1, we have also told him that we will post some blogs as well in the blogging platforms. AM team needs to call him on Monday, i.e, 29.05.23 between 1 and 2 PM CST, i.e, 11.30 and 12.30 IST.', NULL, '2023-08-25 12:26:50', '2023-08-25 12:26:50'),
(113, 533240, 'Mark Coca', 'Mark@delphidistributing.com', 'USA', 'NEW MEXICO', NULL, 'KAMALJIT', 'Prodipto', '\"He is into a business of sport equipment selling and sign up for social media marketing. Sign up for $300 for month. AM team needs to call him at 3 Mountain Time (2.30 IST) today.', NULL, '2023-08-25 12:57:38', '2023-08-25 12:57:38'),
(114, 608265, 'Milena Soc', 'milena.soc@gmail.com', 'USA', '\"City: Ann Arbor State: MI\"', NULL, 'Satyajit Das', 'Prodipto', 'Client signed up for 4 creative design, AM team needs to call her tomorrow 1est.', NULL, '2023-08-25 13:00:37', '2023-08-25 13:00:37'),
(115, 744209, 'Syed Hussain', 'rhussain@labwork360.com', 'USA', 'Texas', NULL, 'Sudhanshu', 'Prodipto', 'Client signed up for digi mix (SEO & SMO) for 2 months. His business is https://labwork360.com/. We suggested the ad budget of 400 USD for him. We need to handle the ad accounts for him. Also, we need to blast the emails from his portal that he has. AM team needs to call him tomorrow, i.e, 31.5.23 at 10 AM CST, i.e, 8.30 PM IST.', NULL, '2023-08-25 13:03:16', '2023-08-25 13:03:16'),
(116, 537372, 'Bret Sablosky', 'bretvote100@gmail.com', 'USA', 'New York', NULL, 'Rishikesh', 'Prodipto', 'Client signed up for a basic informative website for the non profit with a donate now button. We also need to do the SEO for the 2 months. We have given a customized deal of the website and the 2 months of SEO. AM team needs to call him at 1 AM - 1:10 AM IST today.', NULL, '2023-08-25 13:06:04', '2023-08-25 13:06:04'),
(117, 281194, 'Jarmanjit Singh', 'jarmanbatth@gmail.com', 'USA', '\"Brampton \"', NULL, 'SUMAN', 'Akash', 'Client signed up for video editing. He need three video for his IT services ,which he use for his promotion. AM teams needs to call him tomorrow at 1am(IST) i;e 3:30 pm(EST)', NULL, '2023-08-25 13:08:26', '2023-08-25 13:08:26'),
(118, 102371, 'Michelet Lauture', 'mlauture25@gmail.com', 'AUS', 'Michelet Lauture	Pennsylvania', NULL, 'Aniket', 'Akash', 'kj jk', NULL, '2023-08-25 13:11:05', '2023-12-11 02:14:43'),
(119, 140387, 'Samuel Mensah Oduro', 'samuel@ymedical.org', 'USA', 'Rancho palos Verdes , Ca', NULL, 'Surajit', 'Prodipto', 'Client signed up for a basic website with 3months of SEO. This is for his client\'s business . AM team needs to call him at 1:25AM today.', NULL, '2023-08-25 13:14:03', '2023-08-25 13:14:03'),
(120, 905878, 'Michael W. Goldstein', 'mwglawyer@gmail.com', 'USA', '\"New York  \"', NULL, 'Trambak Singha Roy', 'Akash', '\"Client is in real estate law services. He have a website www.Atty1.com. Client sign up for redesigning of his website as per his requirements he already mentioned by email. We have to create a logo for him as well. Website cost will be $500 and for logo he is paying an additional cost of $50. Project value is $550 and sign up with $250. AM team needs to contact with him at 7pm Eastern Time (4.30 IST).\r\n\r\nProject information from client:\r\nYou will use the look & feel & color scheme (subject to revisions at my request) from\r\n\r\nhttps://shopluxusa.com/ YES - I LIKE THE Home page & MENUS, but the other pages need different format \r\nThe FEATURED DAILY DEALS portion of the page could be used on a Practice Areas page, with each Watch replaced by image for each practice area\r\n\r\n\r\nhttps://countrywideprocess.net/ The website could also take some ideas from the Home page only from this site (not the other pages)\r\n\r\nFor logo he like the logo of this website https://rouselawyers.com.au/.\r\n\r\nRest of the details is forwarded to the project@digitalwebber.com\"', NULL, '2023-08-25 13:16:54', '2023-08-25 13:16:54'),
(121, 805034, 'Samuel Mensah Oduro', 'samuel@ymediccaal.org', 'USA', 'Rancho palos Verdes , Ca', NULL, 'Surajit', 'Prodipto', 'Client signed up for modification of this website (http://voltamed.org/) with 2 months of SEO. Also we have to renew the SSL of this website. AM team needs to call him at 12:15 AM today. It is Up-sale.', NULL, '2023-08-25 13:19:59', '2023-08-25 13:19:59'),
(122, 516071, 'Suzan David', 'suz@webandstorymedic.com', 'USA', 'Chicago', NULL, 'Amitavo', 'Saikat', '\"Client signed up for SMO for 1 month. She is a partner client where we have to give her leads for her business. AM team needs to call her tomorrow, i.e,06.06.23 in between 12.30 PM - 1 PM CST.\r\n\"', NULL, '2023-08-25 13:23:01', '2023-08-25 13:23:01'),
(123, 593053, 'Ronald Keller', 'olympiark@aol.com', 'USA', 'New York', NULL, 'MISC', 'Akash', '\"Client sign up for shopify customization for him. Where we have to create a new page for him where he will add approx 30 products & he will give us images and all description. The pages will like https://discountgoldanddiamonds.com/collections/engagement-rings/products/diamond-engagement-ring-rsk50536-e-c?variant=42336473120927 and the 360 view videos will be also provided by client. He will start with 1 product at first then by the time he will provide rest of the products to us for upload.\r\nHis first priority is to change the banner with a hyperlink. He already provided us that. The link he provided that is http://discountgoldanddiamonds.hibid.com/auctions/current which we have to hyperlink on the banner which is given in to the chat.\r\nAM team needs to call him at 4-5pm EST (1.30-2.30 IST)\"', NULL, '2023-08-25 13:26:16', '2023-08-25 13:26:16'),
(124, 625996, 'Emmanuel Ogiozee', 'victorymediapro@gmail.com', 'USA', 'Texas', NULL, 'MISC', 'Akash', 'Client sign up for a basic website development where he is planning to show all of his services and client can get in touch with him for services. Services he provide photography, videography, graphics design, Video editing etc. Project cost $500 and sign up with $250. AM team can contact with him by tomorrow 6.6.23 at 1pm Central Time (11.30 IST)', NULL, '2023-08-25 13:30:07', '2023-08-25 13:30:07'),
(125, 645343, 'James Goethe', 'JDGOETHE@GMAIL.COM', 'USA', '\"FLORIDA  \"', NULL, 'suman', 'Saikat', '\"Client signed up for Search Engine Optimization. currently he ranked number 33, we have to make it 1 in ranking this is his website (https://www.farrowpulicelaw.com/sarasota-personal-injury-lawyer/) . He also provide the keyword, we have optimize this one keyword (sarasota personal injury lawyer)\r\n.We asked the client to give the time to call him.\"', NULL, '2023-08-25 13:34:26', '2023-08-25 13:34:26'),
(126, 261862, 'Abdul Rehman', 'sys2comusa@gmail.com', 'USA', 'Pennsylvania, Stroudsburg', NULL, 'Sarnab Kolay', 'Akash', 'Client is looking for a eCommerce template of lorem version. We will give him the shopluxusa.com and there will be no content and all. His Idea is he wants to learn how e-commerce will work and its internal feature. For that we will also help him for demonstration and guidance on that. He also want a separate landing page where he wants to showcase himself as a e-commerce manager and about himself. We have to provide him a template for that and we have to set up that page with his content and images. AM team can contact him by tomorrow on 8.6.23 but before that he ask for a whatsapp text is he available or not. We have to create a whatsapp group as well with him. He asks for a female project manager as his other business in-charge are also female so that will be convenient for them if there is a female project manager. ( Rest $300 he will pay in 2 break ups as $150 each)', NULL, '2023-08-25 13:38:13', '2023-08-25 13:38:13'),
(127, 239849, 'Luigi LLanos', 'luigi@locallatitude.com', 'USA', 'Nevada', NULL, 'Misc', 'Prodipto', 'Client signed up for 4 UI UX designs for his website. His website is https://platftou.elementor.cloud/. It will be opened with the pin - 7880. We have to create 4 UI UX for Destination page. We have to create the designs for explore our citites, attractions, cuisines and start planning. He likes the design of this website https://www.simpleviewinc.com/. AM team needs to call him today at 4 AM IST.', NULL, '2023-08-25 13:41:20', '2023-08-25 13:41:20'),
(128, 892013, 'Austin Lee', 'alee@orb.solutions', 'USA', 'Novi, Michigan', NULL, 'Trambak Singha Roy', 'Saikat', 'Client sign up for email marketing. We have to provide him 2 email template. He have a mailchimp account & he will provide us an access. Dev also had a word with the client and understand the project very well. Sign up for $150 for the project. AM team have to contact with him on monday 12.6.23 at 10.30 Eastern Time (8PM IST)', NULL, '2023-08-25 13:47:49', '2023-08-25 13:47:49'),
(129, 482970, 'Felix Gallardo', 'fariastechnology@gmail.com', 'USA', 'Texas', NULL, 'Kamaljit', 'Prodipto', 'I am attaching client\'s requirement in the sales deal. AM team needs to call him on Monday, i.e, 12.06.2023 at 11.30 AM Texas time.', NULL, '2023-08-25 13:53:08', '2023-08-25 13:53:08'),
(130, 658819, 'Peter St. Jean', 'doctorpeterstjean@gmail.com', 'USA', 'Illinois', NULL, 'MISC', 'Akash', 'Client sign up for a website development. We have to create a new website for his new community. This website will be the home for all of his plan and ideas he have for his community. In this website there will be few sections of his community\'s academy, resort and other staffs. There will be a page of communication where he will showcase of his new podcast and show information which he planning to host on youtube. Website cost is $900 and sign up with $450. AM team have to call him today on 12.6.23 at 3.30 Central Time (2 AM IST).', NULL, '2023-08-25 13:55:30', '2023-08-25 13:55:30'),
(131, 914588, 'Justin Mayall', 'officemanager.slidingsolutions@gmail.com', 'USA', 'Oceanside , Ca', NULL, 'Surajit', 'Prodipto', 'Client signed up for Social media marketing for 30 days. client\'s manager will be the primary point of contact for this project. Her name is Dani and this is her number 7602958500. We need to call Dani. She is already filling up the questionnaire form. AM team needs to call her back at 1PM PST (1:30AM IST) today.', NULL, '2023-08-25 13:58:48', '2023-08-25 13:58:48'),
(132, 975051, 'Tim Kern', 'info@timkern.com', 'INDIA', 'Indian', NULL, 'Misc', 'Prodipto', 'Client reactivated the project of his website. We have to do the needful changes on the website and we have to make the website live into his godaddy server. He does not know how to give the delicate access so the project manager will have to guide him regarding the same. AM Team needs to call him on Monday, i.e, 19.06.23 at 1.30 his time, i.e, 11 PM IST.', NULL, '2023-08-25 14:02:16', '2023-08-25 14:02:16'),
(133, 589392, 'Abraham Manoukian', 'Idealchoicehh@gmail.com', 'USA', 'California', NULL, 'Misc', 'Saikat', 'Client signed up for updating the SSL of his website. His website is idealchoicehomehealth.com.', NULL, '2023-08-25 14:05:11', '2023-08-25 14:05:11'),
(134, 635981, 'Mohammed Hossain', 'LANTANKAVA@GMAIL.COM', 'USA', 'FLORIDA', NULL, 'SUMAN', 'Prodipto', 'Client signed up for SMO, his website is (https://www.happykratoms.com/). AM team needs to call him tomorrow at 11:30(est) i;e 9pm(ist). Client has asked us to do the research properly before we are starting the work for him.', NULL, '2023-08-25 14:09:07', '2023-08-25 14:09:07'),
(135, 337871, 'Alia Farooq', 'aliafarooq25@gmail.com', 'USA', 'Ontario, Canada', NULL, 'Misc', 'Prodipto', '\"Client signed up for a landing page and 2 months of marketing on facebook, instagram and google. She is into real estate.We also need to provide hosting from our end. Price quoted for hosting is 260 CAD for 2 years. Client is a bit skeptical. We need to make sure that we are giving her good work. She had a domain but she is not sure whether she has it now or not. If she does not have we need to suggest her good domain names. AM team needs to call her today, i.e, 20.06.23 at 8.30 IST.\r\n\"', NULL, '2023-08-25 14:12:58', '2023-08-25 14:12:58'),
(136, 430275, 'Aaron Lombardo', 'Aaron@NorthStarReserves.com', 'USA', 'Idaho', NULL, 'MISC', 'Akash', 'Client is running a consulatation services from his end. He is looking for marketing of his business. We have to take care of SMO (ie Facebook, Instagram, LinkedIn) and SEO for his busienss. He mostly serving on mountain time zone states (i.e.Colorado, Idaho, Montana, Oregon, Utah). For that client sign up for $400 monthly. AM team have to call him on 22.06.23 at 10 AM Mountain Time (9.30 IST).', NULL, '2023-08-25 14:16:28', '2023-08-25 14:16:28'),
(137, 175882, 'Shashank Dhadphale', 'shashdha@yahoo.com', 'USA', 'Minnesota', NULL, 'ANIKET', 'Prodipto', 'Client signed up for social media marketing for his insurance business. Client\'s business website is - https://zenithinsuranceservices.com/. He wants to generate leads for this business. He has liked ltinsures.com and he has an another business of IT Consultancy. AM team needs to call him today at 12.20 AM IST.', NULL, '2023-08-25 14:19:57', '2023-08-25 14:19:57'),
(138, 671392, 'Daniel Kureshi', '843email@gmail.com', 'USA', 'South Carolina', NULL, 'MISC', 'Saikat', '\"Client is sign up for website design with graphics design. We will create:-\r\n1. Website\r\n2. Logo\r\n3. Business card\r\n4. Refregerator magnet Design 3\r\n5. Table top sign holders 3 (With QR code)\r\n6. Sign hotel lobby design\r\n7. Brochure design & content 1\r\n8. Door hangers 3\r\n9. Magazine 10 pages\r\nProject cost will be $450 for the website and $250 for creatives. Total project cost is $700 and Sign up with $300. AM team have to call him on Monday at 10am Eastern Time (7.30pm IST).\"', NULL, '2023-08-25 14:23:13', '2023-08-25 14:23:13'),
(139, 573137, 'castell Rolle', 'MJMBLOCK@AOL.COM', 'USA', 'North Carolina', NULL, 'Sreyashi Ghosh', 'Prodipto', 'Client signed up for Social Media marketing for his business. His website is https://solexvideoscanners.org/. We have to drag people into his website. He has said we need to communicate with his daughter monica and she will add him on conference and each and every discussion will be having through monica only. AM team needs to call monica at 2 AM IST today.', NULL, '2023-08-25 14:26:32', '2023-08-25 14:26:32'),
(140, 487710, 'RON VAILLANT', 'R.P.VAILLANT@GMAIL.COM', 'USA', 'AL, CANADA', NULL, 'KAMAL', 'Akash', '\"Client is having a music website Client is having a music website http://scripturesong.com/. He sell music album and CD\'s. Client sign up for redesign the website. We have to make the website with the same look and feel like the current one but we have to add a player where customer can listen few songs and also a payment gateway integration (Paypal) for purchasing the album or CD\'s. In his current website he do not have this features we have to take care of that. But he is willing to create the new website like the old one. Project cost is 1350 CAD and Sign up with 500 CAD. He will pay the rest in 2 break ups. Client provide us ftp of the old website:\r\nWebsite UrL. http://www.scripturesongs.com\r\nftp: ftp2.netadvent.org\r\nusr: scripturesongsronv\r\npss: vaillant\r\nAnd his requirement into a document we will provide in workgroup itself. AM team have to call him on 4pm Mountain Time (3.30 IST).\"', NULL, '2023-08-25 14:30:47', '2023-08-25 14:30:47'),
(141, 479519, 'Robert Golden', 'rdg2400@hotmail.com', 'USA', 'California', NULL, 'ANIKET', 'Akash', '\"Client have a domain flipping business https://www.gamblingdomains.com/. Client sign up for website redesign. His vision is creating the website simple and user friendly with the help of search filter for category and subcategory. There will be a payment gateway. Gross will be $1500 and sign up will be $300. AM team have to call him at 3.30pm Pacific Time (4am IST).\r\n\r\n(i.e. His main focus will be the game changer part of his current website which will be the main part of new website. That is something like featured domains.)\"', NULL, '2023-08-25 14:33:16', '2023-08-25 14:33:16'),
(142, 511551, 'Christopher Morales', 'kingfisherbella@gmail.com', 'USA', 'Armingdale Ne', NULL, 'Ayush', 'Saikat', '\"Had a conversation with the client he wants an brand new website for his vegan Items. Here is the existing\r\nwebsite link - kingfisherllc.info, Client will speak with the AM Team around 3 pm EST 27/06/2023. Client\r\nwill fill the questionnaire till yet he just have the colour preference as bird as kingfisher.\"', NULL, '2023-08-25 14:35:16', '2023-08-25 14:35:16'),
(143, 199580, 'Robert Jones', 'akajonespi@aol.com', 'Canada', 'AB, Canada', NULL, 'Sagar', 'Saikat', 'Client has signed up us for 6 months SEO Promotion along with the website revamp. (https://virtualrealestatestaging.com/) Please also do the follow up as soon as possible to check his preference along with the questionnaire. AM team needs to call him around 12 our time today which is 28.6.2022', NULL, '2023-08-25 14:41:45', '2023-08-25 14:41:45'),
(144, 145922, 'John VEGA', '5330742@gmail.com', 'USA', 'california', NULL, 'suman', 'Akash', 'He is into in construction business. He need a website for his construction business, total cost of the project his 550usd he upfront with us 250usd. AM team needs to call him tomorrow at 8am(pst) i;e 8:30pm(ist)', NULL, '2023-08-25 14:43:58', '2023-08-25 14:43:58'),
(145, 801943, 'Thomas Mahn', 'support@tech-master.com', 'USA', '\"City: Waterloo State: On\"', NULL, 'ANIKET', 'Saikat', '\"Client has signed up for the website designing, here is the existing site- (https://www.tech-master.com/)\r\nClient paid $300 CAD Upront remaining payment once the work is done! Call back is been schedule tomorrow\r\n7.07.2023 around 11.30am EST with AM.\r\nClient needs to showcase his products also would like to receive quote on items.\"', NULL, '2023-08-25 14:48:31', '2023-08-25 14:48:31'),
(146, 337952, 'jabbie uswman', 'jabbiethehandyman@yahoo.ca', 'USA', 'ON.CANADA', NULL, 'Kamaljit singh', 'Prodipto', 'Client signed up for an affilate website with 2 months of marketing and we will give 1month of marketing complementary for our end.Total package cost is 1600 CAD.PM Team have to call 4.30pm est.Also, we need to help him in selecting the product.', NULL, '2023-08-25 14:51:46', '2023-08-25 14:51:46'),
(147, 170068, 'Stevie Delar', 'Letspickuptrash@protonmail.com', 'USA', 'Huntsville , Al', NULL, 'AMITAVO', 'Prodipto', 'Client signed up for a landing page for his business. He is into junk removal business. AM team needs to call him today at 4.30 CST, i.e, 3 AM IST.', NULL, '2023-08-25 14:55:36', '2023-08-25 14:55:36'),
(148, 692213, 'Victor VeVea', 'vvevea@gmail.com', 'USA', 'California', NULL, 'Sudhanshu', 'Prodipto', '\"Client is a partner client. Sign up for 2 video creation of minimum 30 Second Duration of each video. Video will be for,\r\n\r\n1. English language video for DetainerDefense.com 661-927-7268. Is your landlord a slumlord? Do you have water leaks, mold, broken HVAC, missing window screens, broken door locks, or other problems your landlord refuses to fix? Are you being evicted? Are you being harassed by your landlord? We may be able to help.\r\n\r\n2. Punjabi language video for Ravi from PunjabParalegal.com 661-379-5556. We provide document services for divorces, custody, support, eviction, restraining orders, guardianships, adoptions and more. If we can’t help with your legal needs, we can probably refer you to someone who can.\r\n\r\nClient told us to use our own wording. For 2 videos he sign up with $100 and rest $100 he will pay us at the time of delivery. His another mail id is victor@661justice.com. AM team will have to contact him as per clients convenience (Client did not provide a call back time yet.)\r\n\"', NULL, '2023-08-25 14:57:52', '2023-08-25 14:57:52'),
(149, 684565, 'Pearlchavon Dehaney', 'Pearlchavondehaney@gmail.com', 'USA', 'NY', NULL, 'Misc', 'Prodipto', 'Client signed up for social media marketing for her business. She is into baby care products. She wants brand awareness for her business. AM team needs to call her tomorrow at 6.30 PM EST, i.e, 4 AM IST.', NULL, '2023-08-25 15:00:34', '2023-08-25 15:00:34'),
(150, 768228, 'PRASANTI DE JAGER', 'prashanti@vedamandala.com', 'USA', 'CALIFORNIA', NULL, 'SUMAN', 'Prodipto', 'Client signed up for social media marketing. we have engage more people into his website i;e (https://prajnaremedies.com/). AM team needs to call him tomorrow at 12 (mst) i;e 11:30pm(ist)', NULL, '2023-08-25 15:07:33', '2023-08-25 15:07:33'),
(151, 657482, 'Oneil Madden', 'pastoromadden@aol.com', 'USA', 'CALIFORNIA', NULL, 'Aniket', 'Akash', 'Client sign up for his Non-profit organisation promotion and fundraising. We have to take care of facebook & instagram promotion. We have to generate donation for them and also they are planning for brodcasting we have to promote that as well. He will be starting that marketing from 1st of August. He just booked the services by now with $250 for month. AM team have to contact with him by tomorrow on 19.7.23 at 9am Pacific Time for an welcome call.', NULL, '2023-08-25 15:11:07', '2023-08-25 15:11:07'),
(152, 281929, 'kevin jarstad', 'krjcrypto@gmail.com', 'USA', 'Florida', NULL, 'Amitavo', 'Prodipto', 'Client signed up for social media marketing and search engine optimization for 2 business. We need to bring more users to the https://cryptostc.com/. This is a platform where her brings content creators and youtubers and promotes his crypto through them. He also has https://fhsac.com/ this business where the seo is been set he just needs social media marketing for this. For cryptostc.com, he needs both seo and smo. The entire project cost is 900 USD and the client has paid 450 for 30 days. AM team needs to call him at 1 AM IST today.', NULL, '2023-08-25 15:14:41', '2023-08-25 15:14:41'),
(153, 791043, 'Paul Patenaude', 'theboys@rogers.com', 'Canada', 'Canada', NULL, 'Trambak', 'Prodipto', '\"Client signed up for social media marketing for his wedding directory. He wants more reach and more expansion to his business directory. AM team needs to call him on Tuesday, 25.07.23 at 2 PM EST.', NULL, '2023-08-25 15:18:57', '2023-08-25 15:18:57'),
(154, 885793, 'Balwan Singh', 'BALWANPOST@GMAIL.COM', 'USA', 'FLORIDA', NULL, 'SUMAN', 'Akash', 'Client sign up for website re-designing. His website is https://yogatalk.com/. We have to design the website with a theme he will be providing. He is showcasing the yoga classes with Acuity plugin. We have to also integrate that into the theme. Project gross is $450 and sign up with $200. Client already spoke with Sudipto about the project. AM team have to call him at 12:45 IST.', NULL, '2023-08-25 15:23:08', '2023-08-25 15:23:08'),
(155, 736602, 'CHAD HANNA', 'acsco55@gmail.com', 'USA', 'Lead, SD', NULL, 'Aniket', 'Akash', 'Client is already worked with us earlier. He want some changes in his website called https://tilfordgulch.com/. We have to replace the Book Camp Karolyn section from its current place to above the reservation option. Along with that he have a problem with the reservation form when anyone is fill out that mail is going to his trash not into his inbox. Along with that there is some other captcha problem he have mention. He is looking for the section changes by today itself. AM team have to contact with him at 1am IST.', NULL, '2023-08-25 15:26:13', '2023-08-25 15:26:13'),
(156, 979306, 'Matt Brown', 'actor_mattbrown@outlook.com', 'Canada', 'Canada', NULL, 'Kamaljeet', 'Akash', 'Client is running a studio with 5 of his friends. They just started 2 months back. He signed up for marketing of their business. They are looking for brand engagement and getting business. For that we have to promote their Facebook, Instagram and YouTube. Client sign up for 1 month of marketing with $300. AM team have to contact with him on Monday 24.7.23 at 12 pacific time (12.30 IST). He already filled out the questionnaire link.', NULL, '2023-08-25 15:28:56', '2023-08-25 15:28:56'),
(157, 368393, 'Mohammad Hozri', 'ngdfw1@gmail.com', 'USA', 'Haltom City', NULL, 'ANIKET', 'Saikat', 'Had a conversation with client regarding SMO for 1month he signed up for Facebook, Instagram, LinkedIn, and schedule a call back at 2 ist 24-07-2023 , he is having a business of furniture and his website is https://www.ngdfw.com/ he paid $200.', NULL, '2023-08-25 15:33:51', '2023-08-25 15:33:51'),
(158, 818328, 'Howard Prager', 'cryptobiosecure@gmail.com', 'USA', 'Florida', NULL, 'Shreyashri', 'Prodipto', 'Client signed up for a landing page for his insurance business. We have also discussed about the marketing for 1 month of social media marketing. After delivering the landing page he will start the marketing. AM team needs to follow up accordingly. Dev is already in touch with him.', NULL, '2023-08-28 09:47:18', '2023-08-28 09:47:18'),
(159, 598026, 'Ryan Park', 'ryan.park@hawaiiunified.com', 'USA', 'Huwaii', NULL, 'Aniket', 'Prodipto', 'Client signed up for website and 2 months of social media marketing. He is into selling solar panels. We have to connect CRM to his website. He already has a logo which we have to edit a bit. AM team needs to call him at 7.30 AM Huwaii time, i.e,11 PM IST today, i.e, 28.7.23. Social Media Platforms mentioned are Facebook, Instagram and Linkedin.', NULL, '2023-08-28 09:50:16', '2023-08-28 09:50:16'),
(160, 645551, 'Gary Millstein', 'gary@benefitshealth.com', 'USA', 'California', NULL, 'Surajit', 'Prodipto', 'Client signed up for 1month of SMO and landing page. He is a insurance agent. He is in business for 30years. He provides both health and life insurance. He is looking for leads from California. AM team needs to call him at 2PM PST(2:30AM IST) today.', NULL, '2023-08-28 09:52:43', '2023-08-28 09:52:43'),
(161, 348275, 'Kent Gubrud', 'kglawbroker@gmail.com', 'USA', 'New York , Ne', NULL, 'Anirban Bhattacharjee', 'Prodipto', 'Client signed up for social media marketing.He has a law firm also has real state business.He paid 300USD for 45days of SMO in Facebook,Instagram & Linkedin.Also We have to do some changes in his website.AM team needs to call him back tomorrow(01/08/2023) at 11am EST(8:30pm IST).', NULL, '2023-08-28 09:55:41', '2023-08-28 09:55:41'),
(162, 812948, 'SANDEEP KHANUJA', 'sandeepcosmic@gmail.com', 'USA', 'virginia, united states', NULL, 'Sreyashi', 'Saikat', 'Client has signed up for website designing along with the server for 1 years and SSL, here is the reference site (https://numerodata.com/) call back schedule for the introduction with the AM\'s Team 3/8/2023 12 noon EST.', NULL, '2023-08-28 09:59:09', '2023-08-28 09:59:09'),
(163, 955683, 'David Sieving', 'theshops@goyrownway.com', 'USA', 'California', NULL, 'Surajit', 'Akash', 'Client signed up for Website fixing. we need to fix the website (https://surveymarm.com/). We have to make sure when client will click on the get start button on his website (https://surveymarm.com/) they will redirect to his link. We have to fix the bugs and glitches where they will not go forward to those third party websites (https://1wgafz.top/landing-fortune-wheel?&&). AM team needs to call him back tomorrow (3rd August) at 3PM PST (3:30AM IST).', NULL, '2023-08-28 10:02:39', '2023-08-28 10:02:39'),
(164, 297142, 'Jessica Cabell', 'jessicacabell@aol.com', 'USA', 'Baltimore , MD', NULL, 'Surajit', 'Prodipto', 'Client signed up for 30days of Social Media Marketing (Facebook, Instagram, Threads, & LinkedIn) and SEO . This is her Website (butcherpremier.com). Client is open for suggestions on her website if we feel some suggestions are required she is open for that. AM team needs to call her at 3:15PM EST (12:45AM IST) today.', NULL, '2023-08-28 10:05:22', '2023-08-28 10:05:22'),
(165, 420499, 'Steven Hicks', 'steven@iimiinc.com', 'USA', 'Jackson , Mi', NULL, 'Irfan Hussain', 'Prodipto', 'Client signed up for LinkedIn Marketing for 30days. He has a domain leasing business. This is his website(https://leasepermonth.com/).He has domains from specific areas so we have to target customers according to that. We have to build more connection in his LinkedIn Account. AM team needs to call him at 1:45AM IST today.', NULL, '2023-08-28 10:09:52', '2023-08-28 10:09:52'),
(166, 124804, 'Suraj Thapaliya', 'suraj.thapaliya22@gmail.com', 'USA', 'Texas', NULL, 'Kamaljeet', 'Akash', 'Client is sign up for an affiliate website and logo. He is planning to sell daily essentials. He did not come up with the product. We will be helping him with the product suggestion and also we will help him for affiliate set up. We will help him with the business name suggestion as well. Website gross is $750 and $200 is the sign up amount. AM team have to call him at 12.30 Central Time (11 IST).', NULL, '2023-08-28 10:13:51', '2023-08-28 10:13:51'),
(167, 189276, 'Rob Farrow', 'rob.farrow@robfarrow.net', 'USA', 'British Columbia', NULL, 'Sudhansu', 'Akash', 'Client signed up for 3 months of YouTube Marketing, He provides CPA & Financial services. He has a YouTube Channel. We have to promote his channel. He has paid 700CAD(520.85 USD) for 3(three) months of YouTube Marketing. AM Team needs to call him at 3:30 PM PST (4:00 AM IST) today.', NULL, '2023-08-28 10:16:24', '2023-08-28 10:16:24'),
(168, 982794, 'Chuck B Buhr', 'chuckbbuhr@gmail.com', 'Canada', 'Canada', NULL, 'Samiran', 'Prodipto', 'Client\'s sister is a piano teacher. Client is a partner client. She has just shifted with the client so she wants new student for her piano class. She is planning to do a open house so we have to give her footfalls for the open house. They will be running the ads as well. The ad budget has not been decided. We can provide the ad budget to them. AM team needs to call him at 10.45PM IST today.', NULL, '2023-08-28 10:19:51', '2023-08-28 10:19:51'),
(169, 806488, 'Ryan Krause', 'gm@greater-minds.com', 'USA', 'Indiana', NULL, 'ANIKET', 'Saikat', 'client signed up for 1 month of SMO (FB, INSTAGRAM, INSTAGRAM THREAD, LINKEDin) paid $250 . AM need to call him on WEDNESDAY 16th August evening time EST', NULL, '2023-08-28 10:23:03', '2023-08-28 10:23:03'),
(170, 451610, 'Jesse Walker', 'faulknerwalshdesigns@gmail.com', 'USA', 'MABLETON , Georgia', NULL, 'Surajit', 'Prodipto', 'Client signed up for SMO and SEO for her business , we also have to optimize her website. This is her website (https://faulknerwalshdesigns.com/). Total project cost will be 600USD for 2 months of SMO and SEO. She Signed up with 300USD and she will pay rest of the 300USD next month. AM team needs to call her today at 5:35M IST.', NULL, '2023-08-28 10:26:31', '2023-08-28 10:26:31'),
(171, 981025, 'ALMUDENA KONRAD', 'ALMUDENA@GMAIL.COM', 'USA', 'California', NULL, 'Tanmoy Pramanick', 'Akash', 'Client is an author and sign up for a website where she wants to sell her books. Currently she have only 2 Books. Website will have payment gateway feature. Client sent a reference website https://davidgoggins.com/. Website price is $550 and client sign up with $150. AM team need to follow up with her at 11.30 Pacific Time (12 IST).', NULL, '2023-08-28 10:29:27', '2023-08-28 10:29:27'),
(172, 884468, 'Christian DeVere', 'buykratompowders@gmail.com', 'USA', 'Columbus,OH', NULL, 'Irfan Hussain', 'Saikat', '\"client has signed up for 300 google reviews on his google profile page paid $250 and remaining $250 will be getting paid after 150 reviews, \r\n\r\n\r\nclient\'s requirement:- \r\n\r\nI just need you to post the 5 star reviews I will provide you, and then need them put on the listing (we have 4 listings) that I specify. That\'s it and that\'s all I need done. But I need them to:\r\n\r\n1) The accounts need nicknames or American Names. I don\'t want reviews from Lo Duck Wong, or Muhammad Fazrika. I need reviews from names like Shawn, Wendy, Bill, Harry, Jason, Tina, Frank etc.....\r\n2) I do not want all the reviews going up overnight or even a couple of days. I think it\'s reasonable from SEO experience that this project should take about 30 days to complete. That\'s posting 10 reviews at the location I specify everyday\"', NULL, '2023-08-28 10:32:40', '2023-08-28 10:32:40'),
(173, 384859, 'Arnold Bulosan', 'arnoldb@uniflexcircuits.com', 'USA', 'San Jose, California', NULL, 'Misc', 'Prodipto', 'Client signed up for renewing the SSL Certification for 2 years of his website. His website is uniflexcircuits.com. Please do it ASAP', NULL, '2023-08-28 10:35:23', '2023-08-28 10:35:23'),
(174, 464614, 'Syed Imran Shah', 'info@prepaidstates.com', 'USA', '89 Northgate Rd, Northborough, MA 01532', NULL, 'Irfan Hussain', 'Saikat', 'client has sign up for a website designing. paid 300 remaining 450 will be getting paid after the work is done {its a partner client wants in PHP just like digital webber}', NULL, '2023-08-28 10:38:37', '2023-08-28 10:38:37'),
(175, 488280, 'Ishaq Khan', 'Lindorak@gmail.com', 'USA', '\"Brampton,On \"', NULL, 'Abhay Bhanja', 'Prodipto', 'Client signed up for Social Media Marketing for 30 days.He provide consultancy services and he is looking for lead generation for his business and we have to do marketing on Facebook,Instagram,linkedin and Google.AM team needs to call him today(18/8/23) 6pm EST i.e 3:30am IST', NULL, '2023-08-28 10:41:36', '2023-08-28 10:41:36'),
(176, 914165, 'Dee Barnes', 'dee@itsacheerthingg.net', 'USA', 'Tennessee, USA', NULL, 'MISC', 'Akash', 'Client is running a t-shirt business. She is looking for graphics design for her t-shirt business. We have to design 20 graphics for her. For design she will send us the colour requirement and ideas and contents. Designs will be specially for girls and related to cheer-leading. She has more design work in her pipeline after that. She paid $170 for the work. AM team have to call her at 5.15pm Eastern Time (2.45 IST)', NULL, '2023-08-28 10:45:14', '2023-08-28 10:45:14'),
(177, 287116, 'Raul Torres', 'globowaycommunicationn@gmail.com', 'USA', 'Lawrence, Ma', NULL, 'Suvendu', 'Akash', 'He is a wholesaler of a energy drink company. Client sign up for a E-commerce website for that. His current website is https://uberwholesaler.com/. Project cost US$2000 and upfront amount US$500. AM team needs to call him tomorrow 16.2.23 at 10 AM EST (8.30 IST).', NULL, '2023-08-28 10:48:10', '2023-08-28 10:48:10'),
(178, 649211, 'Nick Williams', 'nickwilliams@witsengg.com', 'USA', 'Fairfax , Vi', NULL, 'Surajit', 'Prodipto', 'Client signed up for a website. He wants two parts in the website , one is regarding construction and another one is excavation. Client has shown a website (www.hrparts.com) as reference. we have to create a website with the same look and feel or better than that. AM team needs to call him back after 45mins at 3:40AM IST today (28/01/2023).', NULL, '2023-08-28 10:51:16', '2023-08-28 10:51:16'),
(179, 182226, 'Amber Watson', 'kohuwujid@mailinator.com', 'AUS', 'Eos quaerat magna u', 'https://www.kovevew.us', 'Gisela Greer', 'Odette Boone', 'Aut nisi voluptatem', NULL, '2023-12-07 03:21:03', '2023-12-07 03:21:03'),
(180, 418373, 'Rylee Walters', 'tuwasaseh@mailinator.com', 'USA', 'Accusamus ut laborum', 'https://www.humusiwaxini.in', 'Yoshio Bond', 'Declan Best', 'Error atque recusand', NULL, '2023-12-07 03:22:47', '2023-12-07 03:22:47'),
(181, 909323, 'Jolie Terry', 'cexihitete@mailinator.com', 'UK', 'Est doloribus tempor', 'https://www.loryfe.org', 'Ishmael Byrd', 'Bryar Grant', 'Dolorem natus libero', NULL, '2023-12-07 03:28:20', '2023-12-07 03:28:20'),
(182, 257952, 'Ocean Burgess', 'doxuz@mailinator.com', 'AUS', 'Quam fugiat sint ni', 'https://www.byqojozucofam.me', 'Abbot Nixon', 'Perry Turner', 'Aspernatur eaque et', NULL, '2023-12-07 03:28:42', '2023-12-07 03:28:42'),
(183, 696756, 'Kameko Ward', 'mofo@mailinator.com', 'INDIA', 'Soluta aspernatur in', 'https://www.kifurizazeha.com.au', 'Hall Russo', 'Sandra Woodard', 'Qui id dignissimos m', NULL, '2023-12-07 03:29:24', '2023-12-07 03:29:24'),
(184, 384012, 'Xena Cline', 'xuke@mailinator.com', 'INDIA', 'Eiusmod esse aut in', 'https://www.tadegyworiv.me.uk', 'Katelyn Martinez', 'David Burgess', 'Consequatur Sit nec', NULL, '2023-12-07 03:31:43', '2023-12-07 03:31:43'),
(185, 923081, 'Josiah Walters', 'fofuw@mailinator.com', 'Canada', 'Ut est duis in elig', 'https://www.bihaceroci.tv', 'Jessamine Greer', 'Ciaran Lamb', 'Doloremque pariatur', NULL, '2023-12-07 04:35:09', '2023-12-07 04:35:09'),
(186, 141329, 'Irma Malone', 'keho@mailinator.com', 'USA', 'Voluptate molestiae', 'https://www.lupunolivoq.org.uk', 'Dillon House', 'Jonah Butler', 'Adipisci nihil volup', NULL, '2023-12-07 06:10:04', '2023-12-07 06:10:04'),
(187, 633252, 'kjhhhkj', 'loxabu@mailinator.com', 'AUS', 'bbbv', 'https://www.kovevew.us', 'nbbnnb', 'Declan Best', 'klk', NULL, '2023-12-07 23:03:01', '2023-12-07 23:03:01'),
(188, 927139, 'New Client', 'tushar@gmail.com', 'USA', 'US', NULL, 'kjkj', 'duuyt', 'tyuiy reut', NULL, '2023-12-21 03:43:05', '2023-12-21 03:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `closers`
--

CREATE TABLE `closers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `closers`
--

INSERT INTO `closers` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1, 'xyz', 'xyz@gmail.com', '2023-01-23 06:55:27', '2023-01-17 06:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `currency` int(11) NOT NULL,
  `instalment` int(11) NOT NULL,
  `net_amount` double(8,2) NOT NULL,
  `sale_date` date NOT NULL,
  `payment_mode` int(11) NOT NULL,
  `other_payment_mode` varchar(250) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `client_id`, `sale_id`, `currency`, `instalment`, `net_amount`, `sale_date`, `payment_mode`, `other_payment_mode`, `created_at`, `updated_at`) VALUES
(1, 1, 20, 2, 1, 7000.00, '2023-07-25', 2, NULL, '2023-07-25 07:51:03', '2023-07-28 07:04:41'),
(2, 5, 21, 1, 1, 150.00, '2023-08-22', 2, NULL, '2023-08-23 12:11:19', '2023-08-23 16:11:19'),
(3, 8, 22, 1, 1, 225.00, '2023-08-22', 2, NULL, '2023-08-23 12:19:02', '2023-08-23 16:19:02'),
(4, 9, 23, 1, 1, 380.00, '2023-08-21', 2, NULL, '2023-08-23 12:24:29', '2023-08-23 16:24:29'),
(5, 10, 24, 1, 1, 220.00, '2023-08-21', 2, NULL, '2023-08-23 12:29:54', '2023-08-23 16:29:54'),
(6, 11, 25, 1, 1, 220.00, '2023-08-21', 2, NULL, '2023-08-24 06:05:34', '2023-08-24 10:05:34'),
(7, 12, 26, 1, 1, 150.00, '2023-10-01', 2, NULL, '2023-08-24 06:10:00', '2023-08-24 10:10:00'),
(8, 13, 27, 1, 1, 200.00, '2023-10-01', 2, NULL, '2023-08-24 06:15:47', '2023-08-24 10:15:47'),
(9, 14, 28, 1, 1, 350.00, '2023-01-16', 2, NULL, '2023-08-24 06:20:49', '2023-08-24 10:20:49'),
(10, 15, 29, 1, 1, 250.00, '2023-01-16', 2, NULL, '2023-08-24 06:26:51', '2023-08-24 10:26:51'),
(11, 16, 30, 1, 1, 150.00, '2023-01-17', 2, NULL, '2023-08-24 06:33:18', '2023-08-24 10:33:18'),
(12, 17, 31, 1, 1, 200.00, '2023-01-17', 2, NULL, '2023-08-24 06:37:34', '2023-08-24 10:37:34'),
(13, 18, 32, 1, 1, 200.00, '2023-01-23', 2, NULL, '2023-08-24 06:44:48', '2023-08-24 10:44:48'),
(14, 19, 33, 1, 1, 300.00, '2023-01-25', 2, NULL, '2023-08-24 06:49:37', '2023-08-24 10:49:37'),
(15, 20, 34, 1, 1, 150.00, '2023-01-25', 2, NULL, '2023-08-24 06:57:26', '2023-08-24 10:57:26'),
(16, 21, 35, 1, 1, 300.00, '2023-01-25', 2, NULL, '2023-08-24 07:01:57', '2023-08-24 11:01:57'),
(17, 22, 36, 1, 1, 200.00, '2023-01-27', 2, NULL, '2023-08-24 07:07:04', '2023-08-24 11:07:04'),
(18, 24, 37, 1, 1, 100.00, '2023-01-30', 2, NULL, '2023-08-24 07:35:26', '2023-08-24 11:35:26'),
(19, 25, 38, 1, 1, 186.00, '2023-01-30', 2, NULL, '2023-08-24 07:39:46', '2023-08-24 11:39:46'),
(20, 26, 39, 1, 1, 250.00, '2023-01-30', 2, NULL, '2023-08-24 07:43:56', '2023-08-24 11:43:56'),
(21, 27, 40, 1, 1, 200.00, '2023-01-31', 2, NULL, '2023-08-24 07:47:26', '2023-08-24 11:47:26'),
(22, 28, 41, 1, 1, 300.00, '2023-01-31', 2, NULL, '2023-08-24 07:51:30', '2023-08-24 11:51:30'),
(23, 29, 42, 1, 1, 100.00, '2023-01-31', 2, NULL, '2023-08-24 07:55:30', '2023-08-24 11:55:30'),
(24, 30, 43, 1, 1, 250.00, '2023-01-02', 2, NULL, '2023-08-24 08:00:26', '2023-08-24 12:00:26'),
(25, 31, 44, 1, 1, 149.00, '2023-01-02', 2, NULL, '2023-08-24 08:03:53', '2023-08-24 12:03:53'),
(26, 32, 45, 1, 1, 300.00, '2023-01-02', 2, NULL, '2023-08-24 08:08:05', '2023-08-24 12:08:05'),
(27, 33, 46, 1, 1, 600.00, '2023-03-02', 2, NULL, '2023-08-24 08:46:28', '2023-08-24 12:46:28'),
(28, 34, 47, 1, 1, 300.00, '2023-03-02', 2, NULL, '2023-08-24 08:49:59', '2023-08-24 12:49:59'),
(29, 35, 48, 1, 1, 250.00, '2023-06-02', 2, NULL, '2023-08-24 09:01:36', '2023-08-24 13:01:36'),
(30, 36, 49, 1, 1, 250.00, '2023-08-02', 2, NULL, '2023-08-24 11:29:37', '2023-08-24 15:29:37'),
(31, 37, 50, 1, 1, 400.00, '2023-08-02', 2, NULL, '2023-08-24 11:32:42', '2023-08-24 15:32:42'),
(32, 38, 51, 1, 1, 200.00, '2023-09-02', 2, NULL, '2023-08-24 11:36:59', '2023-08-24 15:36:59'),
(33, 39, 52, 1, 1, 250.00, '2023-02-09', 2, NULL, '2023-08-24 11:42:41', '2023-08-24 15:42:41'),
(34, 40, 53, 1, 1, 200.00, '2023-02-09', 2, NULL, '2023-08-24 11:46:07', '2023-08-24 15:46:07'),
(35, 41, 54, 1, 1, 350.00, '2023-02-10', 2, NULL, '2023-08-24 11:50:13', '2023-08-24 15:50:13'),
(36, 42, 55, 1, 1, 200.00, '2023-02-13', 2, NULL, '2023-08-24 11:53:32', '2023-08-24 15:53:32'),
(37, 43, 56, 1, 1, 250.00, '2023-02-15', 2, NULL, '2023-08-24 11:57:11', '2023-08-24 15:57:11'),
(38, 44, 57, 1, 1, 250.00, '2023-02-15', 2, NULL, '2023-08-24 12:00:17', '2023-08-24 16:00:17'),
(39, 45, 58, 1, 1, 300.00, '2023-02-15', 2, NULL, '2023-08-24 12:04:06', '2023-08-24 16:04:06'),
(40, 46, 59, 1, 1, 300.00, '2023-02-22', 2, NULL, '2023-08-24 12:07:36', '2023-08-24 16:07:36'),
(41, 47, 60, 1, 1, 250.00, '2023-02-23', 2, NULL, '2023-08-24 12:11:00', '2023-08-24 16:11:00'),
(42, 48, 61, 1, 1, 350.00, '2023-02-23', 2, NULL, '2023-08-24 12:14:22', '2023-08-24 16:14:22'),
(43, 49, 62, 1, 1, 150.00, '2023-02-24', 2, NULL, '2023-08-24 12:18:58', '2023-08-24 16:18:58'),
(44, 50, 63, 1, 1, 150.00, '2023-02-27', 2, NULL, '2023-08-24 12:22:20', '2023-08-24 16:22:20'),
(45, 51, 64, 1, 1, 200.00, '2023-02-28', 2, NULL, '2023-08-24 12:27:48', '2023-08-24 16:27:48'),
(46, 53, 65, 1, 1, 750.00, '2023-03-01', 2, NULL, '2023-08-25 04:32:36', '2023-08-25 08:32:36'),
(47, 54, 66, 1, 1, 244.00, '2023-03-02', 2, NULL, '2023-08-25 04:35:34', '2023-08-25 08:35:34'),
(48, 55, 67, 1, 1, 200.00, '2023-03-03', 2, NULL, '2023-08-25 04:39:23', '2023-08-25 08:39:23'),
(49, 56, 68, 1, 1, 217.00, '2023-03-08', 2, NULL, '2023-08-25 04:42:51', '2023-08-25 08:42:51'),
(50, 57, 69, 1, 1, 250.00, '2023-03-08', 3, NULL, '2023-08-25 04:46:03', '2023-08-25 08:46:03'),
(51, 58, 70, 1, 1, 300.00, '2023-03-08', 2, NULL, '2023-08-25 04:50:01', '2023-08-25 08:50:01'),
(52, 59, 71, 1, 1, 200.00, '2023-03-10', 2, NULL, '2023-08-25 04:53:38', '2023-08-25 08:53:38'),
(53, 60, 72, 1, 1, 300.00, '2023-03-13', 2, NULL, '2023-08-25 04:56:38', '2023-08-25 08:56:38'),
(54, 61, 73, 1, 1, 100.00, '2023-03-14', 2, NULL, '2023-08-25 04:59:45', '2023-08-25 08:59:45'),
(55, 62, 74, 1, 1, 100.00, '2023-03-14', 2, NULL, '2023-08-25 05:02:21', '2023-08-25 09:02:21'),
(56, 63, 75, 1, 1, 181.00, '2023-03-15', 2, NULL, '2023-08-25 05:05:31', '2023-08-25 09:05:31'),
(57, 64, 76, 1, 1, 100.00, '2023-03-17', 2, NULL, '2023-08-25 05:09:22', '2023-08-25 09:09:22'),
(58, 65, 77, 1, 1, 120.00, '2023-03-21', 2, NULL, '2023-08-25 05:29:20', '2023-08-25 09:29:20'),
(59, 66, 78, 1, 1, 125.00, '2023-03-24', 2, NULL, '2023-08-25 05:34:33', '2023-08-25 09:34:33'),
(60, 67, 79, 1, 1, 200.00, '2023-03-24', 2, NULL, '2023-08-25 05:38:58', '2023-08-25 09:38:58'),
(61, 68, 80, 1, 1, 230.00, '2023-03-27', 2, NULL, '2023-08-25 05:42:08', '2023-08-25 09:42:08'),
(62, 69, 81, 1, 1, 250.00, '2023-03-31', 2, NULL, '2023-08-25 05:45:46', '2023-08-25 09:45:46'),
(63, 70, 82, 1, 1, 200.00, '2023-04-03', 2, NULL, '2023-08-25 05:49:32', '2023-08-25 09:49:32'),
(64, 71, 83, 1, 1, 200.00, '2023-04-05', 2, NULL, '2023-08-25 05:53:01', '2023-08-25 09:53:01'),
(65, 72, 84, 1, 1, 300.00, '2023-04-06', 2, NULL, '2023-08-25 05:56:42', '2023-08-25 09:56:42'),
(66, 73, 85, 1, 1, 300.00, '2023-04-06', 2, NULL, '2023-08-25 05:59:54', '2023-08-25 09:59:54'),
(67, 74, 86, 1, 1, 250.00, '2023-04-10', 2, NULL, '2023-08-25 06:03:29', '2023-08-25 10:03:29'),
(68, 75, 87, 1, 1, 250.00, '2023-04-12', 2, NULL, '2023-08-25 06:07:15', '2023-08-25 10:07:15'),
(69, 76, 88, 1, 1, 650.00, '2023-04-12', 2, NULL, '2023-08-25 06:10:44', '2023-08-25 10:10:44'),
(70, 77, 89, 1, 1, 150.00, '2023-04-13', 2, NULL, '2023-08-25 06:13:22', '2023-08-25 10:13:22'),
(71, 78, 90, 1, 1, 186.00, '2023-04-17', 2, NULL, '2023-08-25 06:16:16', '2023-08-25 10:16:16'),
(72, 79, 91, 1, 1, 100.00, '2023-04-18', 2, NULL, '2023-08-25 06:19:20', '2023-08-25 10:19:20'),
(73, 80, 92, 1, 1, 148.00, '2023-04-19', 2, NULL, '2023-08-25 06:26:49', '2023-08-25 10:26:49'),
(74, 80, 93, 1, 1, 184.00, '2023-04-24', 2, NULL, '2023-08-25 06:30:54', '2023-08-25 10:30:54'),
(75, 81, 94, 1, 1, 200.00, '2023-04-24', 2, NULL, '2023-08-25 06:34:17', '2023-08-25 10:34:17'),
(76, 82, 95, 1, 1, 300.00, '2023-04-24', 2, NULL, '2023-08-25 06:37:04', '2023-08-25 10:37:04'),
(77, 83, 96, 1, 1, 125.00, '2023-04-25', 2, NULL, '2023-08-25 06:39:32', '2023-08-25 10:39:32'),
(78, 84, 97, 1, 1, 200.00, '2023-04-25', 2, NULL, '2023-08-25 06:42:58', '2023-08-25 10:42:58'),
(79, 85, 98, 1, 1, 367.00, '2023-04-26', 2, NULL, '2023-08-25 06:46:15', '2023-08-25 10:46:15'),
(80, 86, 99, 1, 1, 300.00, '2023-04-26', 2, NULL, '2023-08-25 06:48:26', '2023-08-25 10:48:26'),
(81, 87, 100, 1, 1, 500.00, '2023-04-26', 2, NULL, '2023-08-25 06:51:00', '2023-08-25 10:51:00'),
(82, 88, 101, 1, 1, 100.00, '2023-04-27', 2, NULL, '2023-08-25 06:54:24', '2023-08-25 10:54:24'),
(83, 89, 102, 1, 1, 100.00, '2023-05-04', 2, NULL, '2023-08-25 06:57:29', '2023-08-25 10:57:29'),
(84, 90, 103, 1, 1, 350.00, '2023-05-05', 2, NULL, '2023-08-25 07:00:03', '2023-08-25 11:00:03'),
(85, 91, 104, 1, 1, 150.00, '2023-05-09', 2, NULL, '2023-08-25 07:03:05', '2023-08-25 11:03:05'),
(86, 92, 105, 1, 1, 950.00, '2023-05-10', 2, NULL, '2023-08-25 07:06:11', '2023-08-25 11:06:11'),
(87, 93, 106, 1, 1, 148.00, '2023-05-11', 2, NULL, '2023-08-25 07:25:55', '2023-08-25 11:25:55'),
(88, 94, 107, 1, 1, 200.00, '2023-05-11', 2, NULL, '2023-08-25 07:28:30', '2023-08-25 11:28:30'),
(89, 95, 108, 1, 1, 300.00, '2023-05-12', 2, NULL, '2023-08-25 07:30:58', '2023-08-25 11:30:58'),
(90, 96, 109, 1, 1, 250.00, '2023-05-12', 2, NULL, '2023-08-25 07:33:34', '2023-08-25 11:33:34'),
(91, 97, 110, 1, 1, 260.00, '2023-05-15', 2, NULL, '2023-08-25 07:35:54', '2023-08-25 11:35:54'),
(92, 98, 111, 1, 1, 296.00, '2023-05-16', 2, NULL, '2023-08-25 07:39:11', '2023-08-25 11:39:11'),
(93, 99, 112, 1, 1, 500.00, '2023-05-16', 2, NULL, '2023-08-25 07:41:59', '2023-08-25 11:41:59'),
(94, 100, 113, 1, 1, 200.00, '2023-05-17', 2, NULL, '2023-08-25 07:44:39', '2023-08-25 11:44:39'),
(95, 101, 114, 1, 1, 100.00, '2023-05-18', 2, NULL, '2023-08-25 07:47:25', '2023-08-25 11:47:25'),
(96, 102, 115, 1, 1, 100.00, '2023-05-19', 2, NULL, '2023-08-25 07:50:47', '2023-08-25 11:50:47'),
(97, 103, 116, 1, 1, 500.00, '2023-05-19', 2, NULL, '2023-08-25 07:53:51', '2023-08-25 11:53:51'),
(98, 104, 117, 1, 1, 200.00, '2023-05-22', 2, NULL, '2023-08-25 07:56:43', '2023-08-25 11:56:43'),
(99, 105, 118, 1, 1, 74.00, '2023-05-22', 2, NULL, '2023-08-25 08:00:10', '2023-08-25 12:00:10'),
(100, 106, 119, 1, 1, 250.00, '2023-05-23', 2, NULL, '2023-08-25 08:03:51', '2023-08-25 12:03:51'),
(101, 107, 120, 1, 1, 900.00, '2023-05-23', 2, NULL, '2023-08-25 08:06:40', '2023-08-25 12:06:40'),
(102, 108, 121, 1, 1, 300.00, '2023-05-24', 2, NULL, '2023-08-25 08:10:30', '2023-08-25 12:10:30'),
(103, 109, 122, 1, 1, 250.00, '2023-05-24', 2, NULL, '2023-08-25 08:17:47', '2023-08-25 12:17:47'),
(104, 110, 123, 1, 1, 250.00, '2023-05-25', 2, NULL, '2023-08-25 08:22:43', '2023-08-25 12:22:43'),
(105, 111, 124, 1, 1, 100.00, '2023-05-25', 2, NULL, '2023-08-25 08:25:39', '2023-08-25 12:25:39'),
(106, 112, 125, 1, 1, 300.00, '2023-05-26', 2, NULL, '2023-08-25 08:28:52', '2023-08-25 12:28:52'),
(107, 113, 126, 1, 1, 300.00, '2023-05-29', 2, NULL, '2023-08-25 08:59:18', '2023-08-25 12:59:18'),
(108, 114, 127, 1, 1, 100.00, '2023-05-30', 2, NULL, '2023-08-25 09:02:07', '2023-08-25 13:02:07'),
(109, 115, 128, 1, 1, 450.00, '2023-05-30', 2, NULL, '2023-08-25 09:04:52', '2023-08-25 13:04:52'),
(110, 116, 129, 1, 1, 500.00, '2023-05-31', 2, NULL, '2023-08-25 09:07:24', '2023-08-25 13:07:24'),
(111, 117, 130, 1, 1, 150.00, '2023-05-31', 2, NULL, '2023-08-25 09:10:03', '2023-08-25 13:10:03'),
(112, 118, 131, 1, 1, 200.00, '2023-06-01', 2, NULL, '2023-08-25 09:12:26', '2023-08-25 13:12:26'),
(113, 119, 132, 1, 1, 500.00, '2023-06-02', 2, NULL, '2023-08-25 09:15:39', '2023-08-25 13:15:39'),
(114, 120, 133, 1, 1, 250.00, '2023-06-02', 2, NULL, '2023-08-25 09:18:24', '2023-08-25 13:18:24'),
(115, 121, 134, 1, 1, 600.00, '2023-06-05', 2, NULL, '2023-08-25 09:21:47', '2023-08-25 13:21:47'),
(116, 122, 135, 1, 1, 200.00, '2023-06-05', 2, NULL, '2023-08-25 09:25:05', '2023-08-25 13:25:05'),
(117, 123, 136, 1, 1, 200.00, '2023-05-06', 2, NULL, '2023-08-25 09:27:53', '2023-08-25 13:27:53'),
(118, 124, 137, 1, 1, 250.00, '2023-06-05', 2, NULL, '2023-08-25 09:31:55', '2023-08-25 13:31:55'),
(119, 125, 138, 1, 1, 220.00, '2023-06-07', 2, NULL, '2023-08-25 09:36:12', '2023-08-25 13:36:12'),
(120, 126, 139, 1, 1, 200.00, '2023-06-07', 2, NULL, '2023-08-25 09:40:01', '2023-08-25 13:40:01'),
(121, 127, 140, 1, 1, 150.00, '2023-06-08', 2, NULL, '2023-08-25 09:42:48', '2023-08-25 13:42:48'),
(122, 128, 141, 1, 1, 150.00, '2023-06-09', 2, NULL, '2023-08-25 09:49:53', '2023-08-25 13:49:53'),
(123, 129, 142, 1, 1, 500.00, '2023-06-09', 2, NULL, '2023-08-25 09:54:28', '2023-08-25 13:54:28'),
(124, 130, 143, 1, 1, 450.00, '2023-06-12', 2, NULL, '2023-08-25 09:57:09', '2023-08-25 13:57:09'),
(125, 131, 144, 1, 1, 300.00, '2023-06-13', 2, NULL, '2023-08-25 10:00:48', '2023-08-25 14:00:48'),
(126, 132, 145, 1, 1, 300.00, '2023-06-15', 2, NULL, '2023-08-25 10:03:42', '2023-08-25 14:03:42'),
(127, 133, 146, 1, 1, 120.00, '2023-06-16', 2, NULL, '2023-08-25 10:07:21', '2023-08-25 14:07:21'),
(128, 134, 147, 1, 1, 250.00, '2023-06-19', 2, NULL, '2023-08-25 10:11:08', '2023-08-25 14:11:08'),
(129, 135, 148, 1, 1, 150.00, '2023-06-19', 2, NULL, '2023-08-25 10:15:10', '2023-08-25 14:15:10'),
(130, 136, 149, 1, 1, 400.00, '2023-06-21', 2, NULL, '2023-08-25 10:18:21', '2023-08-25 14:18:21'),
(131, 137, 150, 1, 1, 300.00, '2023-06-23', 2, NULL, '2023-08-25 10:21:49', '2023-08-25 14:21:49'),
(132, 138, 151, 1, 1, 300.00, '2023-06-23', 2, NULL, '2023-08-25 10:24:49', '2023-08-25 14:24:49'),
(133, 139, 152, 1, 1, 750.00, '2023-06-26', 2, NULL, '2023-08-25 10:28:37', '2023-08-25 14:28:37'),
(134, 140, 153, 1, 1, 380.00, '2023-06-26', 2, NULL, '2023-08-25 10:32:08', '2023-08-25 14:32:08'),
(135, 141, 154, 1, 1, 300.00, '2023-06-27', 2, NULL, '2023-08-25 10:34:24', '2023-08-25 14:34:24'),
(136, 142, 155, 1, 1, 100.00, '2023-06-27', 2, NULL, '2023-08-25 10:40:43', '2023-08-25 14:40:43'),
(137, 143, 156, 1, 1, 226.00, '2023-06-28', 2, NULL, '2023-08-25 10:43:03', '2023-08-25 14:43:03'),
(138, 144, 157, 1, 1, 250.00, '2023-06-28', 2, NULL, '2023-08-25 10:45:10', '2023-08-25 14:45:10'),
(139, 145, 158, 1, 1, 225.00, '2023-07-07', 2, NULL, '2023-08-25 10:50:38', '2023-08-25 14:50:38'),
(140, 146, 159, 1, 1, 376.00, '2023-07-10', 2, NULL, '2023-08-25 10:53:22', '2023-08-25 14:53:22'),
(141, 147, 160, 1, 1, 130.00, '2023-07-14', 2, NULL, '2023-08-25 10:56:56', '2023-08-25 14:56:56'),
(142, 148, 161, 1, 1, 100.00, '2023-07-17', 2, NULL, '2023-08-25 10:59:22', '2023-08-25 14:59:22'),
(143, 149, 162, 1, 1, 200.00, '2023-07-17', 2, NULL, '2023-08-25 11:02:09', '2023-08-25 15:02:09'),
(144, 150, 163, 1, 1, 200.00, '2023-07-18', 2, NULL, '2023-08-25 11:09:41', '2023-08-25 15:09:41'),
(145, 151, 164, 1, 1, 250.00, '2023-07-18', 2, NULL, '2023-08-25 11:13:09', '2023-08-25 15:13:09'),
(146, 152, 165, 1, 1, 450.00, '2023-07-20', 2, NULL, '2023-08-25 11:16:47', '2023-08-25 15:16:47'),
(147, 153, 166, 1, 1, 250.00, '2023-07-20', 2, NULL, '2023-08-25 11:21:54', '2023-08-25 15:21:54'),
(148, 154, 167, 1, 1, 200.00, '2023-07-21', 2, NULL, '2023-08-25 11:24:33', '2023-08-25 15:24:33'),
(149, 155, 168, 1, 1, 200.00, '2023-07-21', 2, NULL, '2023-08-25 11:27:43', '2023-08-25 15:27:43'),
(150, 156, 169, 1, 1, 300.00, '2023-07-21', 2, NULL, '2023-08-25 11:30:41', '2023-08-25 15:30:41'),
(151, 157, 170, 1, 1, 200.00, '2023-07-24', 2, NULL, '2023-08-25 11:48:12', '2023-08-25 15:48:12'),
(152, 158, 171, 1, 1, 150.00, '2023-07-26', 2, NULL, '2023-08-28 05:49:11', '2023-08-28 09:49:11'),
(153, 159, 172, 1, 1, 400.00, '2023-07-27', 2, NULL, '2023-08-28 05:51:46', '2023-08-28 09:51:46'),
(154, 160, 173, 1, 1, 500.00, '2023-07-28', 2, NULL, '2023-08-28 05:54:42', '2023-08-28 09:54:42'),
(155, 161, 174, 1, 1, 300.00, '2023-07-31', 2, NULL, '2023-08-28 05:57:39', '2023-08-28 09:57:39'),
(156, 162, 175, 1, 1, 250.00, '2023-08-02', 2, NULL, '2023-08-28 06:00:59', '2023-08-28 10:00:59'),
(157, 163, 176, 1, 1, 200.00, '2023-08-02', 2, NULL, '2023-08-28 06:04:23', '2023-08-28 10:04:23'),
(158, 164, 177, 1, 1, 450.00, '2023-08-03', 2, NULL, '2023-08-28 06:08:48', '2023-08-28 10:08:48'),
(159, 165, 178, 1, 1, 200.00, '2023-08-08', 2, NULL, '2023-08-28 06:12:12', '2023-08-28 10:12:12'),
(160, 166, 179, 1, 1, 200.00, '2023-08-09', 2, NULL, '2023-08-28 06:15:17', '2023-08-28 10:15:17'),
(161, 167, 180, 1, 1, 520.00, '2023-08-11', 2, NULL, '2023-08-28 06:18:37', '2023-08-28 10:18:37'),
(162, 168, 181, 1, 1, 297.00, '2023-08-14', 2, NULL, '2023-08-28 06:21:37', '2023-08-28 10:21:37'),
(163, 169, 182, 1, 1, 250.00, '2023-08-14', 2, NULL, '2023-08-28 06:24:51', '2023-08-28 10:24:51'),
(164, 170, 183, 1, 1, 300.00, '2023-08-14', 2, NULL, '2023-08-28 06:28:17', '2023-08-28 10:28:17'),
(165, 171, 184, 1, 1, 150.00, '2023-08-16', 2, NULL, '2023-08-28 06:30:53', '2023-08-28 10:30:53'),
(166, 172, 185, 1, 1, 250.00, '2023-08-17', 2, NULL, '2023-08-28 06:34:19', '2023-08-28 10:34:19'),
(167, 173, 186, 1, 1, 300.00, '2023-08-16', 2, NULL, '2023-08-28 06:36:58', '2023-08-28 10:36:58'),
(168, 174, 187, 1, 1, 300.00, '2023-08-16', 2, NULL, '2023-08-28 06:40:11', '2023-08-28 10:40:11'),
(169, 175, 188, 1, 1, 350.00, '2023-08-18', 2, NULL, '2023-08-28 06:43:44', '2023-08-28 10:43:44'),
(170, 176, 189, 1, 1, 170.00, '2023-08-22', 2, NULL, '2023-08-28 06:46:38', '2023-08-28 10:46:38'),
(171, 177, 190, 1, 1, 500.00, '2023-02-15', 2, NULL, '2023-08-28 06:49:43', '2023-08-28 10:49:43'),
(172, 178, 191, 1, 1, 200.00, '2023-01-27', 2, NULL, '2023-08-28 06:52:40', '2023-08-28 10:52:40'),
(173, 4, 192, 1, 1, 23.00, '2023-12-14', 2, NULL, '2023-12-07 09:05:20', '2023-12-07 03:35:20'),
(174, 4, 193, 2, 1, 10.00, '2023-12-01', 2, NULL, '2023-12-08 04:54:38', '2023-12-07 23:24:38'),
(175, 4, 14, 1, 1, 10.00, '2023-12-15', 2, NULL, '2023-12-08 07:37:39', '2023-12-08 02:07:39'),
(176, 1, 194, 1, 1, 100.00, '1970-01-01', 2, NULL, '2023-12-13 09:44:32', '2023-12-13 04:14:32'),
(177, 188, 195, 1, 1, 500.00, '2023-01-01', 2, NULL, '2023-12-21 09:16:56', '2023-12-21 03:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `sale_id`, `comment_by`, `message`, `date`, `created_at`, `updated_at`) VALUES
(1, 16, 7, 'test', '2023-07-18 00:00:00', '2023-07-18 10:29:53', '2023-07-18 04:59:53'),
(2, 16, 7, 'test message', '2023-07-18 00:00:00', '2023-07-18 11:20:25', '2023-07-18 05:50:25'),
(3, 16, 7, 'bye', '2023-07-18 00:00:00', '2023-07-18 11:21:02', '2023-07-18 05:51:02'),
(4, 16, 2, 'Thanks for your comment', '2023-07-18 00:00:00', '2023-07-18 11:25:44', '2023-07-18 05:55:44'),
(5, 16, 2, 'good', '2023-07-18 00:00:00', '2023-07-18 11:32:10', '2023-07-18 06:02:10'),
(6, 15, 7, 'Require payment gateway details', '2023-07-18 00:00:00', '2023-07-18 11:41:57', '2023-07-18 06:11:57'),
(7, 15, 2, 'Okay I\'ll send as soon as possible', '2023-07-18 00:00:00', '2023-07-18 11:42:41', '2023-07-18 06:12:41'),
(8, 15, 2, 'Thank you', '2023-07-18 00:00:00', '2023-07-18 11:45:14', '2023-07-18 06:15:14'),
(9, 15, 7, 'Welcome', '2023-07-18 00:00:00', '2023-07-18 11:45:30', '2023-07-18 06:15:30'),
(10, 15, 2, 'good', '2023-07-18 11:47:09', '2023-07-18 11:47:09', '2023-07-18 06:17:09'),
(11, 15, 7, 'byyy', '2023-07-18 11:48:43', '2023-07-18 11:48:43', '2023-07-18 06:18:43'),
(12, 15, 7, 'byyy', '2023-07-18 11:48:43', '2023-07-18 11:48:43', '2023-07-18 06:18:43'),
(13, 15, 7, 'two', '2023-07-18 11:48:57', '2023-07-18 11:48:57', '2023-07-18 06:18:57'),
(14, 15, 7, 'ttteee', '2023-07-18 11:49:03', '2023-07-18 11:49:03', '2023-07-18 06:19:03'),
(15, 15, 7, 'ttrrr', '2023-07-18 11:49:14', '2023-07-18 11:49:14', '2023-07-18 06:19:14'),
(16, 15, 7, 'yyyyy', '2023-07-18 11:49:27', '2023-07-18 11:49:27', '2023-07-18 06:19:27'),
(17, 16, 1, 'hey', '2023-07-18 12:00:06', '2023-07-18 12:00:06', '2023-07-18 06:30:06'),
(18, 72, 1, 'kjkkj', '2023-12-07 10:26:59', '2023-12-07 10:26:59', '2023-12-07 04:56:59'),
(19, 72, 1, 'hi', '2023-12-08 10:37:19', '2023-12-08 10:37:19', '2023-12-08 05:07:19'),
(20, 72, 1, 'hfgghgh', '2023-12-08 10:37:26', '2023-12-08 10:37:26', '2023-12-08 05:07:26'),
(21, 72, 1, 'fgjghjghj', '2023-12-08 10:37:31', '2023-12-08 10:37:31', '2023-12-08 05:07:31'),
(22, 72, 1, 'fgjjg', '2023-12-08 10:37:35', '2023-12-08 10:37:35', '2023-12-08 05:07:35'),
(23, 72, 1, 'hjkkjk', '2023-12-08 11:20:10', '2023-12-08 11:20:10', '2023-12-08 05:50:10'),
(24, 72, 1, 'hkk', '2023-12-08 11:20:18', '2023-12-08 11:20:18', '2023-12-08 05:50:18'),
(25, 72, 1, 'kk', '2023-12-08 11:20:35', '2023-12-08 11:20:35', '2023-12-08 05:50:35'),
(26, 20, 6, 'hgjh', '2023-12-11 10:54:14', '2023-12-11 10:54:14', '2023-12-11 05:24:14'),
(27, 1, 1, 'hfhh', '2023-12-18 10:05:31', '2023-12-18 10:05:31', '2023-12-18 04:35:31'),
(28, 1, 1, 'hhh', '2023-12-18 10:05:45', '2023-12-18 10:05:45', '2023-12-18 04:35:45'),
(29, 2, 1, 'ghhjj', '2023-12-18 10:06:35', '2023-12-18 10:06:35', '2023-12-18 04:36:35'),
(30, 2, 1, 'bvbv', '2023-12-18 10:07:54', '2023-12-18 10:07:54', '2023-12-18 04:37:54'),
(31, 2, 1, 'jkkj;lk;', '2023-12-18 10:16:41', '2023-12-18 10:16:41', '2023-12-18 04:46:41'),
(32, 1, 1, 'ghkhgjfhkh', '2023-12-18 10:26:19', '2023-12-18 10:26:19', '2023-12-18 04:56:19'),
(33, 1, 1, 'qwerty', '2023-12-18 10:31:26', '2023-12-18 10:31:26', '2023-12-18 05:01:26'),
(34, 2, 1, 'hghgjhjg', '2023-12-18 10:34:50', '2023-12-18 10:34:50', '2023-12-18 05:04:50'),
(35, 2, 1, 'jhhj', '2023-12-18 10:35:53', '2023-12-18 10:35:53', '2023-12-18 05:05:53'),
(36, 2, 1, 'hghg', '2023-12-18 10:36:11', '2023-12-18 10:36:11', '2023-12-18 05:06:11'),
(37, 2, 1, 'gjj', '2023-12-18 10:36:33', '2023-12-18 10:36:33', '2023-12-18 05:06:33'),
(38, 2, 1, 'gj', '2023-12-18 10:37:37', '2023-12-18 10:37:37', '2023-12-18 05:07:37'),
(39, 2, 1, 'gjj', '2023-12-18 10:39:34', '2023-12-18 10:39:34', '2023-12-18 05:09:34'),
(40, 2, 1, 'jhj', '2023-12-18 10:40:10', '2023-12-18 10:40:10', '2023-12-18 05:10:10'),
(41, 2, 1, 'kjkj', '2023-12-18 10:42:16', '2023-12-18 10:42:16', '2023-12-18 05:12:16'),
(42, 2, 1, 'gjgj', '2023-12-18 10:43:53', '2023-12-18 10:43:53', '2023-12-18 05:13:53'),
(43, 1, 1, 'Hi i am Safikul', '2023-12-18 10:44:51', '2023-12-18 10:44:51', '2023-12-18 05:14:51'),
(44, 72, 1, 'lkg ljg', '2023-12-18 10:46:29', '2023-12-18 10:46:29', '2023-12-18 05:16:29'),
(45, 184, 1, 'bfdjhj fkghf', '2023-12-18 10:46:52', '2023-12-18 10:46:52', '2023-12-18 05:16:52'),
(46, 17, 15, 'bnmm', '2023-12-21 09:54:26', '2023-12-21 09:54:26', '2023-12-21 04:24:26'),
(47, 17, 15, 'gfffh', '2023-12-21 09:54:43', '2023-12-21 09:54:43', '2023-12-21 04:24:43'),
(48, 17, 15, 'hello', '2023-12-21 10:00:34', '2023-12-21 10:00:34', '2023-12-21 04:30:34'),
(49, 17, 15, 'hello', '2023-12-21 10:01:12', '2023-12-21 10:01:12', '2023-12-21 04:31:12'),
(50, 17, 15, 'hello', '2023-12-21 10:08:49', '2023-12-21 10:08:49', '2023-12-21 04:38:49'),
(51, 17, 15, 'hjjhkk', '2023-12-21 10:09:50', '2023-12-21 10:09:50', '2023-12-21 04:39:50'),
(52, 17, 15, 'ghkfh', '2023-12-21 10:11:46', '2023-12-21 10:11:46', '2023-12-21 04:41:46'),
(53, 17, 15, 'h kjjlh', '2023-12-21 10:11:51', '2023-12-21 10:11:51', '2023-12-21 04:41:51'),
(54, 17, 15, 'hljkjhl', '2023-12-21 10:11:56', '2023-12-21 10:11:56', '2023-12-21 04:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `client_id`, `email_id`, `mobile_no`, `created_at`, `updated_at`) VALUES
(10, 2, 'sankar.webart@gmail.com', '9874300364', NULL, NULL),
(11, 1, 'sankar.webart@gmail.com', '9874300364', NULL, NULL),
(12, 1, 'sankar.webart123@gmail.com', '9474300364', NULL, NULL),
(13, 3, 'kaushik@gmail.com', '9474300364', NULL, NULL),
(14, 22, 'adjain83@gmail.com', '8476095860', NULL, NULL),
(15, 29, 'khurramhussein@hotmail.com', '9733373199', NULL, NULL),
(16, 58, 'mailmanish123@gmail.com', '5108095832', NULL, NULL),
(17, 60, 'CASH2MENOW@GMAIL.COM', '7702562187', NULL, NULL),
(18, 67, 'olympiark@aol.com', '6313673691', NULL, NULL),
(19, 73, 'zulujuice@gmail.com', '7183411717', NULL, NULL),
(20, 90, 'mike@oldsouthco.com', '9724363060', NULL, NULL),
(21, 104, 'insurancelifema@gmail.com', '5044005771', NULL, NULL),
(22, 115, 'riffathussain1@gmail.com', '(905) 616-0595', NULL, NULL),
(23, 123, 'info@discountgoldanddiamonds.com', '6314453374', NULL, NULL),
(24, 129, 'Sales@midvalleydealers.com', '(956) 755-7066', NULL, NULL),
(25, 131, 'justin.mayall@gmail.com', '7602958500', NULL, NULL),
(26, 139, 'castellrolle@gmail.com', '3367493369', NULL, NULL),
(27, 143, 'hddjones@aol.com', '4036505018', NULL, NULL),
(28, 167, 'rafdigital@gmail.com', '6049923420', NULL, NULL),
(29, 180, 'muloveh@mailinator.com', 'Labore unde reiciend', NULL, NULL),
(30, 181, 'kemavezika@mailinator.com', 'Aperiam deserunt exp', NULL, NULL),
(31, 182, 'jitoxucaru@mailinator.com', 'Quaerat et nostrud a', NULL, NULL),
(32, 183, 'quvavukyda@mailinator.com', 'Quis qui adipisci qu', NULL, NULL),
(33, 184, 'hodovityz@mailinator.com', 'Incididunt autem dol', NULL, NULL),
(34, 185, 'vuciparun@mailinator.com', '1235469875', NULL, NULL),
(35, 185, 'quvavukyda@mailinator.com', '236541547', NULL, NULL),
(36, 185, 'kemavezika@mailinator.com', '787878888', NULL, NULL),
(37, 186, 'dijujif@mailinator.com', 'Ab doloremque animi', NULL, NULL),
(38, 187, 'henog@mailinator.com', '12132132131', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `developer_jobs`
--

CREATE TABLE `developer_jobs` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `assign_to` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`assign_to`)),
  `assign_by` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `remarks` text NOT NULL,
  `status` int(11) NOT NULL,
  `total_time` text NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `developer_jobs`
--

INSERT INTO `developer_jobs` (`id`, `sale_id`, `assign_to`, `assign_by`, `title`, `details`, `start_date`, `end_date`, `remarks`, `status`, `total_time`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, '[\"8\"]', 1, 'test', 'Test', '2023-08-07 12:10:00', '2023-08-10 12:10:00', 'Test', 1, '{\"year\":0,\"months\":0,\"days\":1,\"hours\":0,\"minutes\":0}', NULL, '2023-08-07 06:40:15', '2023-12-15 06:34:14'),
(2, 65, '[\"8\",\"15\"]', 3, 'Countrywide process', '<p>Countrywideprocess process serving form submittion</p>', '2023-08-07 12:11:00', '2023-08-17 12:11:00', 'Countrywideprocess process serving form submittion', 1, '{\"year\":0,\"months\":0,\"days\":1,\"hours\":0,\"minutes\":0}', NULL, '2023-08-07 06:41:39', '2023-12-21 04:06:00'),
(17, 195, '[\"15\"]', 1, 'Ecommerce project', 'laravel project', '2023-12-01 14:48:00', '2023-12-30 14:48:00', 'j fdkjjgh', 1, '{\"year\":0,\"months\":0,\"days\":1,\"hours\":0,\"minutes\":0}', NULL, '2023-12-21 09:18:39', '2023-12-21 04:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_names`
--

CREATE TABLE `group_names` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `uniqid` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `type` enum('Deal','Work') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_histories`
--

CREATE TABLE `log_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `remark` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_histories`
--

INSERT INTO `log_histories` (`id`, `client_id`, `sale_id`, `user_id`, `remark`, `created_at`, `updated_at`) VALUES
(1, 53, 65, '8', 'Hello', '2023-12-15 11:10:51', '2023-12-15 11:10:51'),
(2, 53, 65, '8', 'Hello 1', '2023-12-15 11:10:51', '2023-12-15 11:10:51'),
(3, 53, 65, '15', 'Safikul Tsak', '2023-12-15 11:10:51', '2023-12-15 11:10:51'),
(4, 188, 195, '1', 'Task (Ecommece Laravel Project) has been added', '2023-12-21 03:46:56', '2023-12-21 03:46:56'),
(5, 188, 195, '1', 'Task (Ecommece Laravel Project) has been assigned', '2023-12-21 03:48:39', '2023-12-21 03:48:39'),
(7, 188, 195, '15', 'hjjhkk', '2023-12-21 04:39:50', '2023-12-21 04:39:50'),
(8, 188, 195, '15', 'ghkfh', '2023-12-21 04:41:46', '2023-12-21 04:41:46'),
(9, 188, 195, '15', 'h kjjlh', '2023-12-21 04:41:51', '2023-12-21 04:41:51'),
(10, 188, 195, '15', 'hljkjhl', '2023-12-21 04:41:56', '2023-12-21 04:41:56');

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
(1, '2022_12_28_050429_create_clients_table', 1),
(2, '2014_10_12_000000_create_users_table', 2),
(3, '2014_10_12_100000_create_password_resets_table', 2),
(4, '2019_08_19_000000_create_failed_jobs_table', 2),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(6, '2022_12_28_050413_create_sales_table', 2),
(7, '2022_12_28_050503_create_closers_table', 2),
(8, '2022_12_28_050522_create_agents_table', 2),
(9, '2022_12_28_054233_create_contact_details_table', 2),
(10, '2023_12_12_121427_create_timers_table', 3),
(11, '2023_12_13_084404_create_log_histories_table', 4),
(12, '2023_12_14_100002_add_column_to_log_histories', 4),
(13, '2023_12_15_052237_create_assign_logs_table', 4),
(14, '2023_12_15_073412_create_group_names_table', 5),
(15, '2023_12_15_073826_create_group_members_table', 6),
(16, '2023_12_18_110008_create_chats_table', 6),
(17, '2023_12_18_110057_create_chat_requests_table', 6),
(18, '2023_12_18_110129_update_users_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$ddSV5x5RrfKiS/jxs9Skvuph7.IJ5tfR5kBkvqY82uZXMYrqk1TBi', '2023-01-10 14:00:19');

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
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_type` int(11) NOT NULL,
  `technology` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `marketing_plan` varchar(255) DEFAULT NULL,
  `smo_on` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `platform_name` varchar(255) DEFAULT NULL,
  `prefer_technology` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `business_name` varchar(255) NOT NULL,
  `closer_name` varchar(250) NOT NULL,
  `agent_name` varchar(250) NOT NULL,
  `reference_sites` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `customer_requerment` text NOT NULL,
  `upsale_opportunities` text DEFAULT NULL,
  `isupsale` enum('1','0') NOT NULL,
  `sale_date` date NOT NULL,
  `currency` int(11) NOT NULL,
  `gross_amount` double(10,2) NOT NULL,
  `net_amount` double(10,2) NOT NULL,
  `due_amount` double(10,2) NOT NULL,
  `payment_mode` varchar(250) NOT NULL,
  `other_pay` varchar(250) DEFAULT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'Active',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `client_id`, `project_name`, `project_type`, `technology`, `type`, `others`, `marketing_plan`, `smo_on`, `start_date`, `end_date`, `platform_name`, `prefer_technology`, `description`, `business_name`, `closer_name`, `agent_name`, `reference_sites`, `remarks`, `customer_requerment`, `upsale_opportunities`, `isupsale`, `sale_date`, `currency`, `gross_amount`, `net_amount`, `due_amount`, `payment_mode`, `other_pay`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, 1, 'Plunge', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\"]', '2023-01-02', '2024-01-02', NULL, NULL, NULL, 'Plunge', 'Sudipto', 'Prodipto', NULL, 'Test', '', NULL, '1', '2023-01-02', 0, 2000.00, 1000.00, 1000.00, '6', 'Bank transfer', 'Active', NULL, '2023-01-02 04:08:17', '2023-07-20 01:30:18'),
(7, 1, 'Countrywide process', 1, '3', '1', '', '', '', '1970-01-01', '1970-01-01', NULL, NULL, NULL, 'Law', 'Sudipto', 'Prodipto', 'webart.technology, google.com', 'Test project', '', NULL, '1', '2023-01-02', 0, 5200.00, 2300.00, 2900.00, '1', '', 'Active', NULL, '2023-01-02 05:11:37', '2023-01-03 06:04:11'),
(8, 1, 'Countrywide process', 2, NULL, NULL, NULL, 'SMO', '[\"Instagram\",\"Twitter\",\"Youtube\"]', '2023-01-10', '2023-01-12', NULL, NULL, NULL, 'Plunge', '1', '1', 'webart.technology, google.com', 'Test', '', 'Can sell the hosting and ssl', '1', '2023-01-02', 0, 6000.00, 3000.00, 3000.00, '6', NULL, 'Active', NULL, '2023-01-02 06:34:01', '2023-01-02 06:34:27'),
(9, 1, 'Plunge', 2, '1', '1', '', 'SEO_SMO', '[\"Instagram\",\"Twitter\",\"Youtube\"]', '2023-01-03', '2024-01-03', NULL, NULL, NULL, 'Plunge', 'Sudipto', 'Prodipto', 'webart.technology, google.com', 'test', '', NULL, '1', '2023-01-03', 0, 1200.00, 600.00, 600.00, '2', '', 'Active', NULL, '2023-01-03 00:46:30', '2023-01-03 06:27:47'),
(10, 4, 'Plunge', 1, '2', '1', '', '', '', '2023-01-01', '2023-05-01', NULL, NULL, NULL, 'Countrywide process', 'Sudipto', 'XYZ', NULL, 'Test', '', NULL, '1', '2023-01-04', 0, 100.00, 20.00, 80.00, '1', NULL, 'Active', NULL, '2023-01-03 04:05:24', '2023-01-03 04:21:36'),
(11, 1, 'plunge', 2, NULL, NULL, '', 'SMO', '[\"Instagram\"]', '2023-01-04', '2023-01-11', NULL, NULL, NULL, 'Plunge', 'Sudipto', 'Prodipto', NULL, 'test', '', NULL, '1', '2023-01-11', 0, 200.00, 20.00, 180.00, '2', NULL, 'Active', NULL, '2023-01-03 04:12:32', '2023-01-03 04:12:32'),
(12, 5, 'Fats', 3, NULL, NULL, '', '', '', NULL, NULL, '1', '1', NULL, 'Countrywide process', 'Sudipto', 'Prodipto', NULL, 'hi', '', 'Can sell the hosting and ssl', '1', '2023-01-11', 0, 500.00, 100.00, 400.00, '2', NULL, 'Active', NULL, '2023-01-03 04:14:24', '2023-01-03 04:14:24'),
(13, 1, 'Countrywide capital', 4, NULL, NULL, 'Test Description', '', '', '1970-01-01', '1970-01-01', NULL, NULL, NULL, 'Plunge', 'Sudipto', 'Prodipto', 'webart.technology, google.com', 'hi', '', NULL, '1', '2023-01-04', 0, 150.00, 50.00, 100.00, '4', '', 'Active', NULL, '2023-01-03 04:17:04', '2023-01-03 06:01:25'),
(14, 4, 'Plunge', 6, NULL, NULL, 'UI/UX project details', '', '', '1970-01-01', '1970-01-01', NULL, NULL, NULL, 'Law', 'Sudipto', 'Prodipto', 'webart.technology, google.com', 'This is UI project', '', 'Can sell the hosting and ssl', '1', '2023-01-12', 0, 250.00, 0.00, 250.00, '5', '', 'Active', NULL, '2023-01-03 04:20:01', '2023-01-03 04:58:47'),
(15, 4, 'Supplywestock', 1, '4', '2', '', '', '', NULL, NULL, NULL, NULL, NULL, 'Supplywestock', 'Sudipto', 'Prodipto', NULL, 'Implement payment gateway', '', NULL, '1', '2023-01-04', 0, 2000.00, 1000.00, 1000.00, '1', NULL, 'Active', NULL, '2023-01-04 16:29:06', '2023-01-04 16:29:06'),
(16, 4, 'Plunge', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'Plunge', 'Sudipto', 'Prodipto', NULL, 'test', '', NULL, '1', '2023-01-05', 0, 2500.00, 2500.00, 0.00, '2', '', 'Active', NULL, '2023-01-05 17:09:14', '2023-07-24 07:15:25'),
(20, 1, 'CRM Project', 1, '3', '5', '', '', '', NULL, NULL, NULL, NULL, NULL, 'SalesCRM', 'Ranna', 'Saikat', NULL, 'This is a CRM platform where admin can manage their user and employee', 'This is a CRM platform where admin can manage their user and employee', 'There have many upsale option like sms gateway implementation, payment gateway implementation', '1', '2023-07-25', 2, 12000.00, 6000.00, 6000.00, '2', '', 'Active', NULL, '2023-07-25 02:21:03', '2023-07-27 22:56:56'),
(21, 5, 'smo', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\"]', '2023-08-14', '2023-08-23', NULL, NULL, NULL, 'itsacheerthing.net', 'Akash', 'MISC', NULL, 'df', '', NULL, '1', '2023-08-22', 1, 170.00, 150.00, 20.00, '2', NULL, 'Active', NULL, '2023-08-23 16:11:19', '2023-08-23 16:11:19'),
(22, 8, 'SMO+SEO', 2, NULL, NULL, '', 'SEO_SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-08-22', '2024-11-11', NULL, NULL, NULL, 'https://onyaco.com/', 'Prodipto', 'suman', NULL, 'Client is running a t-shirt business. She is looking for graphics design for her t-shirt business. We have to design 20 graphics for her.', '', NULL, '1', '2023-08-22', 1, 450.00, 225.00, 225.00, '2', NULL, 'Active', NULL, '2023-08-23 16:19:02', '2023-08-23 16:19:02'),
(23, 9, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-08-21', '2024-12-24', NULL, NULL, NULL, 'inter-routes.com', 'Prodipto', 'RISHIKESH', NULL, 'CLIENT SIGNED UP FOR 30 DAYS OF SOCIAL MEDIA MARKETING. SHE WANTS TO DO THE CROWD FUNDING FOR HER PRODUCT.', '', NULL, '1', '2023-08-21', 1, 760.00, 380.00, 380.00, '2', NULL, 'Active', NULL, '2023-08-23 16:24:29', '2023-08-23 16:24:29'),
(24, 10, 'metime247.com', 5, NULL, NULL, 'Client signed up graphic design he need 20 to 25 images for his classes that he gonna provide in the form of ppt. Am teams needs to call him at 9:50pm(ist) today. Also client has asked for a paid invoice from our end.', '', '', NULL, NULL, NULL, NULL, NULL, 'metime247.com', 'Prodipto', 'SUMAN', NULL, 'Client signed up graphic design he need 20 to 25 images for his classes that he gonna provide in the form of ppt. Am teams needs to call him at 9:50pm(ist) today. Also client has asked for a paid invoice from our end.', '', NULL, '1', '2023-08-21', 1, 220.00, 220.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-23 16:29:54', '2023-08-23 16:29:54'),
(25, 11, 'metime247.com', 5, NULL, NULL, 'Client signed up graphic design he need 20 to 25 images for his classes that he gonna provide in the form of ppt. Am teams needs to call him at 9:50pm(ist) today. Also client has asked for a paid invoice from our end.', '', '', NULL, NULL, NULL, NULL, NULL, 'metime247.com', 'Prodipto', 'SUMAN', NULL, 'Client signed up graphic design he need 20 to 25 images for his classes that he gonna provide in the form of ppt. Am teams needs to call him at 9:50pm(ist) today. Also client has asked for a paid invoice from our end.', '', NULL, '1', '2023-08-21', 1, 220.00, 220.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-24 10:05:34', '2023-08-24 10:05:34'),
(26, 12, 'https://www.pmgatl.com/', 1, '1', '3', '', '', '', NULL, NULL, NULL, NULL, NULL, 'https://www.pmgatl.com/', 'Prodipto', 'suman', NULL, 'Client signed up for redesigning the website he has. As he has mentioned he want us to redesign 3 websites that is why gave a customized plan. He is willing to start with the one website. Website is - AM team needs to call him after 30 minutes from now, i.e, 12.25 AM IST today.', '', NULL, '1', '2023-10-01', 1, 300.00, 150.00, 150.00, '2', NULL, 'Active', NULL, '2023-08-24 10:10:00', '2023-08-24 10:10:00'),
(27, 13, 'http://475globaltravelcom.refr.cc/traveler0715', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-10-01', '2024-10-25', NULL, NULL, NULL, 'http://475globaltravelcom.refr.cc/traveler0715', 'Saikat', 'Sayani', NULL, 'Client is targeting for individual travel agents to get sign up or register with the program which he provide. He sign up for social media promotion on Facebook and Instagram for that. Client is a very busy person. He always get busy for 17 hours in a day. We will have to take care of his page creation and we have to give him the admin access. He will have a separate ad budget for sponsor advertisement.', '', NULL, '1', '2023-10-01', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-24 10:15:47', '2023-08-24 10:15:47'),
(28, 14, 'https://cpsvictoria.com/', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-01-16', '2025-06-24', NULL, NULL, NULL, 'https://cpsvictoria.com/', 'Prodipto', 'Suvendu Mour', NULL, 'Client signed up for social media promotion for his business. His website is - https://cpsvictoria.com/. We need to create the facebook page for him and do the marketing in Linkedin and google as well. He is really specific about the target market of his.', '', NULL, '1', '2023-01-16', 1, 700.00, 350.00, 350.00, '2', NULL, 'Active', NULL, '2023-08-24 10:20:49', '2023-08-24 10:20:49'),
(29, 15, 'bizzrus.com', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-01-16', '2025-06-17', NULL, NULL, NULL, 'bizzrus.com', 'Saikat', 'Akash', NULL, 'He is a partner client. He sign up for a marketing project for one of his client. His client is a beauty specialist. She will be looking forward her social media promotion.', '', NULL, '1', '2023-01-16', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-24 10:26:51', '2023-08-24 10:26:51'),
(30, 16, 'https://artdhiman.com/', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-01-17', '2025-05-14', NULL, NULL, NULL, 'https://artdhiman.com/', 'Pritam', 'Sayani', NULL, 'client signed up for social media marketing with 201 CAD (150.15USD).He is a painter (artist) He is sells painting. His website https://artdhiman.com/ .Looking for marketing on Facebook & Instagram. AM team needs to call him within.', '', NULL, '1', '2023-01-17', 1, 300.00, 150.00, 150.00, '2', NULL, 'Active', NULL, '2023-08-24 10:33:18', '2023-08-24 10:33:18'),
(31, 17, 'communitytax.com', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-01-19', '2024-11-20', NULL, NULL, NULL, 'communitytax.com', 'Prodipto', 'Sanu', NULL, 'Client signed up for Social Media promotion for her business. We need to cover LinkedIn and google only. Her website is communitytax.com. Client concern is also to remove the bad reviews from the website.', '', NULL, '1', '2023-01-17', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-24 10:37:34', '2023-08-24 10:37:34'),
(32, 18, 'bossertrealty.com', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-01-23', '2024-03-13', NULL, NULL, NULL, 'bossertrealty.com', 'Prodipto', 'Satyajit Das', NULL, 'Client signed up for social media marketing on Facebook, Instagram, linkedin, he is main concern is to increase the no of followers in his social media account from his traget market that is south Carolina', '', NULL, '1', '2023-01-23', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-24 10:44:48', '2023-08-24 10:44:48'),
(33, 19, 'chef4meal.com', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-01-25', '2025-08-24', NULL, NULL, NULL, 'chef4meal.com', 'Saikat', 'koushik biswas', NULL, 'Client signed up for Social Media Marketing for one month. He is into insurance sector and is investing 20 to 25 dollars on ads but is not getting good leads. We need to make sure that he is getting good leads. Client is filling the questionnaire form and AM team needs to call him today after 3 hours.', '', NULL, '1', '2023-01-25', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-24 10:49:37', '2023-08-24 10:49:37'),
(34, 20, 'https://www.loveandletherwood.com/', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-01-25', '2024-05-24', NULL, NULL, NULL, 'https://www.loveandletherwood.com/', 'Pritam', 'Soumyajit Singha', NULL, 'Client signup for SMO for 150 USD. Client has a business of driving helpers. His targeted area chicago and Milwaukee. His website https://www.loveandletherwood.com/ .We have to do the marketing on facebook and instragram.', '', NULL, '1', '2023-01-25', 1, 300.00, 150.00, 150.00, '2', NULL, 'Active', NULL, '2023-08-24 10:57:26', '2023-08-24 10:57:26'),
(35, 21, 'https://oursalescoach.com/', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Linkedin\"]', '2023-01-25', '2024-04-14', NULL, NULL, NULL, 'https://oursalescoach.com/', 'Prodipto', 'Sayani', NULL, 'Client is a Sales Coach & this is his website https://oursalescoach.com/. Client only do business with software development companies & manufacturing companies. He is planning to get business from entire USA. We have to take care of Facebook , LinkedIn,', '', NULL, '1', '2023-01-25', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-24 11:01:57', '2023-08-24 11:01:57'),
(36, 22, 'myrrhusa.com', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-01-27', '2024-02-14', NULL, NULL, NULL, 'myrrhusa.com', 'Akash', 'Soumyajit Singha', NULL, '\"Client talk to the Akash, client may have real estate business.Today akash is not coming to the office. If client have no real estate business then may be his business is myrrhusa.com.', '', NULL, '1', '2023-01-27', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-24 11:07:04', '2023-08-24 11:07:04'),
(37, 24, 'snaponads.com', 5, NULL, NULL, 'Logo Design', '', '', NULL, NULL, NULL, NULL, NULL, 'snaponads.com', 'Saikat', 'Arunashaf Mollick', NULL, 'Client signed up for 4 logo designs. He has sent two samples to us and the directions and will send us the 2 more. He has a product made of  which he puts in the trucks. The YOYO signs in the back and the ZIP sign in the side of a truck. He has a website project as well, if we deliver a good logo design he will give us the website project.', '', NULL, '1', '2023-01-30', 1, 150.00, 100.00, 50.00, '2', NULL, 'Active', NULL, '2023-08-24 11:35:26', '2023-08-24 11:35:26'),
(38, 25, 'https://weyanconsulting.com', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-01-30', '2024-04-11', NULL, NULL, NULL, 'https://weyanconsulting.com', 'Prodipto', 'suman', NULL, 'INITIALLY, HE WANT TO BUILT CONTENT AND GET FOLLWERS AND GET LIKES INTO HIS WEBSITE', '', NULL, '1', '2023-01-30', 1, 373.00, 186.00, 187.00, '2', NULL, 'Active', NULL, '2023-08-24 11:39:46', '2023-08-24 11:39:46'),
(39, 26, 'gloryinfinityllcthebodybalm.com', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'gloryinfinityllcthebodybalm.com', 'Prodipto', 'Arunashaf Mollick', NULL, 'Client signed up for an e-commerce website. She has 5-7 products. She liked the websites \'shop.recodestudios.', '', NULL, '1', '2023-01-30', 1, 700.00, 250.00, 450.00, '2', NULL, 'Active', NULL, '2023-08-24 11:43:56', '2023-08-24 11:43:56'),
(40, 27, 'manicnomad.com', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'manicnomad.com', 'Prodipto', 'Abhay Bhanjo', NULL, 'Client is a partner client. He has send us the requirements over email and whatsapp. Prodipto Da will send all the details to dev.', '', NULL, '1', '2023-01-31', 1, 800.00, 200.00, 600.00, '2', NULL, 'Active', NULL, '2023-08-24 11:47:26', '2023-08-24 11:47:26'),
(41, 28, 'kinlawconsulting', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'kinlawconsulting', 'Prodipto', 'Suvendu Mour', NULL, 'Client signed up for a website. She liked this (www.elevateyourhealth.co.uk) for her business. She is into employee wellness consultation . We had also talked about the hosting as well. Price quoted was 260 USD for 3 years. AM team needs to call', '', NULL, '1', '2023-01-31', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-24 11:51:30', '2023-08-24 11:51:30'),
(42, 29, 'Marketing Plan', 2, NULL, NULL, '', 'SEO', 'null', '2023-01-31', '2024-10-10', NULL, NULL, NULL, 'N/A', 'Pritam', 'Sudhansu Sekhar Sahu', NULL, 'Client has a business of security door bell. He is launching this business. He signed up for 100 USD to create a marketing plan and competitor research. His competitors are: https://ring.com/ and https://www.arlo.com/en-us/. Asked to call back', '', NULL, '1', '2023-01-31', 1, 100.00, 100.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-24 11:55:30', '2023-08-24 11:55:30'),
(43, 30, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-02-11', '2024-02-20', NULL, NULL, NULL, 'maxequitynow.com', 'Prodipto', 'Soumyajit Singha', NULL, '\"Client Signed up for Social Media Marketing. She has a great knowledge on digital marketing. She is into construction and has started real estate investment. She wants to create the brand awareness for the real estate one. She wants us to help her with that. She has ran campaigns on her facebook before so she is aware of the\r\npart as well. Also, She will be needing an landing page. She has been given a combined package of landing page and social media marketing in 250 USD. She has told if she is getting good work she will upgrade the plan. AM team needs to call her on Monday at 1 PM EST', '', NULL, '1', '2023-01-02', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-24 12:00:26', '2023-08-24 12:00:26'),
(44, 31, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'http://www.reseaudereferencenational.com/', 'Prodipto', 'Misc', NULL, 'Client signed up for a website. He is a partner client. He needs a website where the contents will be provided by him only. He needs contents in two languages, i.e, English and French. Both of them will be provided by him only. Also, for one of his client we need to change the resolution of a logo and needs to send him in vector format by tomorrow itself. For the website he will get in touch with us soon. Current priority is to get the logo work and mock up done by tomorrow itself.', '', NULL, '1', '2023-01-02', 1, 374.00, 149.00, 225.00, '2', NULL, 'Active', NULL, '2023-08-24 12:03:53', '2023-08-24 12:03:53'),
(45, 32, 'Digi Mix (Facebook, Instagram & SEO)', 2, NULL, NULL, '', 'SEO', 'null', '2023-01-02', '2024-02-14', NULL, NULL, NULL, 'https://drsmilenewport.com/', 'Akash', 'Akash Nag', NULL, 'Client provide dental service and his website is https://drsmilenewport.com/. Sign up for Facebook, Instagram and SEO. Sign up amount $300 for month. Client did not provide any convenient time till yet to be in touch with him. He will be busy right now he will inform us for the good time when AM team needs to contact with him.', '', NULL, '1', '2023-01-02', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-24 12:08:05', '2023-08-24 12:08:05'),
(46, 33, 'Social media handling posting And Affiliated link creation and editing videos', 2, NULL, NULL, '', 'SEO', 'null', '2023-03-02', '2024-02-12', NULL, NULL, NULL, 'Christ is Alive LLC', 'Akash', 'SUMAN', NULL, '\"Client sign up for Social media handling posting And Affiliated link creation and also editing videos for $600 for month. We have to take care of affiliate accounts creation where we have put on his content we are creating using veed.io. We also have to create personal accounts for him and using that personal account we have to follow 100 random people and also we have to comment on those post made by the affiliate links. For videos he will be providing us the content of his where we have to just make those videos in a sync with the audio files using https://www.veed.io/ and have to save in different languages. Also social media platforms will be only Facebook, Instagram, LinkedIn & Twitter. We have to create 3 videos a day, 3 affiliate links and also personal account creation. For understanding the project there is couple of links below,\r\nhttps://docs.google.com/document/d/1zGb65iGYNfP-wylaksy65YrM7L2nI6nMn9hIFN7Xqm8/edit?invite=CIzuoIUJ\r\nhttps://drive.google.com/drive/folders/1uWgqGlvPaas3Y92ixOkX-6-SKGtWc_qa\r\nhttps://docs.google.com/spreadsheets/d/1yjWjRfrgeMAaSOKyqFWfNIaWko3sr8lBy7PkFSMRBuk/edit?invite=CIjR5psG#gid=0\r\nhttps://docs.google.com/spreadsheets/d/1yDF1F5_crmZyxNDXx5yiWAgibxYbbHRx8Xr95fGOvdY/edit?invite=CKm9-5wG#gid=0\r\nAM team needs to call him at 2.30 IST.\r\n\r\nVEED - Edit, Record & Livestream Video - Online\r\nAn online video suite for professionals. Record, edit and stream your videos in the cloud. The fastest and easiest way to make professional-quality videos.\r\nwww.veed.io\"', '', NULL, '1', '2023-03-02', 1, 1200.00, 600.00, 600.00, '2', NULL, 'Active', NULL, '2023-08-24 12:46:28', '2023-08-24 12:46:28'),
(47, 34, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-03-02', '2024-03-12', NULL, NULL, NULL, 'executiveelement.com', 'Prodipto', 'SUMAN', NULL, 'Client signed up for social media promotion, she don\'t need leads. she want to built a brand of her business we will be covering facebook, instagram and linkedin. Also we need to write the content for her GODADDY website.She give 200usd to marketing and 100usd for content writing for website. AM teams need to call him at 3:30am(ist)', '', NULL, '1', '2023-03-02', 1, 500.00, 300.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-24 12:49:59', '2023-08-24 12:49:59'),
(48, 35, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-06-02', '2024-06-12', NULL, NULL, NULL, 'digitaljohan.com', 'Prodipto', 'Debjoti Dutta', NULL, 'Client signed up for SMO,he is a partner client,he does not have any social media present so he want to generate business,leeds from social media platforms. While paying us stripe showed client that the payment is not processed earlier and then later he got message from his bank that the amount is discharged. And also we have received the payment as well. We have told client that if it gets reversed, he should take care of it. If something like that happens you guys take care. AM team needs to call him today 1 AM IST.', '', NULL, '1', '2023-06-02', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-24 13:01:36', '2023-08-24 13:01:36'),
(49, 36, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'http://www.topemp.ca/', 'Pritam', 'Satyajit', NULL, 'He is looking to build a basic website for a international school. Project cost US$450 and paid upfront amount of US$250. AM team need to call him tomorrow 9.2.23 after 12PM EST.', '', NULL, '1', '2023-08-02', 1, 450.00, 250.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-24 15:29:37', '2023-08-24 15:29:37'),
(50, 37, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-08-02', '2024-10-15', NULL, NULL, NULL, 'cbierisolutions.com', 'Akash', 'Abhay Bhanjo', NULL, 'Client has a social media site https://newborhoodtalks.com. We have to take care of marketing. She is looking for more engagement on that platform. She is getting audience sign in that platform but can not getting engagement from those audience. We will take care of Facebook, Instagram, Twitter and Google promotion. Sign up with US$400 for month. AM team needs to call her tomorrow morning at 10AM EST.', '', NULL, '1', '2023-08-02', 1, 800.00, 400.00, 400.00, '2', NULL, 'Active', NULL, '2023-08-24 15:32:42', '2023-08-24 15:32:42'),
(51, 38, 'Landing Page', 2, NULL, NULL, '', 'SEO', 'null', '2023-09-02', '2024-11-29', NULL, NULL, NULL, 'downtownplumbing.info', 'Prodipto', 'Sayani', NULL, 'Client signed up for a landing page on wordpress. All of the details has been sent to us by client. Sending you the details over here. He just wants to replicate the pdf into the landing page after some modifications. AM team needs to call him.', '', NULL, '1', '2023-09-02', 1, 200.00, 200.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-24 15:36:59', '2023-08-24 15:36:59'),
(52, 39, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, '7figureswithabner.info', 'Akash', 'Abhay Bhanja', NULL, 'He is a partner client. He have one website https://baptistgrace.com/ which he want to redesign. He showed two websites https://newlifesouthcoast.com/ & https://north.newlifechurch.org/. He wants a video banner as well for that he have his own edited video which he will give us. Project cost US$550 and upfront as US$250. AM team needs to follow him at 5 PM EST.', '', NULL, '1', '2023-02-09', 1, 550.00, 250.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-24 15:42:41', '2023-08-24 15:42:41'),
(53, 40, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'alkatek.com', 'Prodipto', 'Surajit', NULL, 'Client signed up for a website. He has sent us all the details along with that Sudipto Da knows the brief details of this project. AM needs to call him back after 1hour at 4:40AM today.', '', NULL, '1', '2023-02-09', 1, 1200.00, 200.00, 1000.00, '2', NULL, 'Active', NULL, '2023-08-24 15:46:07', '2023-08-24 15:46:07'),
(54, 41, 'DIGIMIX', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-02-10', '2024-10-10', NULL, NULL, NULL, 'https://thewelldr.com/', 'Akash', 'SUMAN', NULL, '\"\r\nClient run this business https://thewelldr.com/. Sign up for Digimix where we have to take care of Facebook, LinkedIn, Google and Basic SEO. Sign up amount US$350 for month. AM team needs to follow with him after 3 hours around 2 IST.', '', NULL, '1', '2023-02-10', 1, 700.00, 350.00, 350.00, '2', NULL, 'Active', NULL, '2023-08-24 15:50:13', '2023-08-24 15:50:13'),
(55, 42, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'gardens100.com', 'Prodipto', 'Sarnab Kolay', NULL, '\"Client signed up for a non profit website. he just has the domain and do not more about it. We have to find whether he has the server or not. If not we have quoted the server cost is 260 dollars for 3 years. His non profit is not incorporated so he is not in a hurry with the website. He has liked the look and feel of compassion.com.au.\r\nAM team needs to call him tomorrow.', '', NULL, '1', '2023-02-13', 1, 770.00, 200.00, 570.00, '2', NULL, 'Active', NULL, '2023-08-24 15:53:32', '2023-08-24 15:53:32'),
(56, 43, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'www.uberwholesaler.com', 'Akash', 'Suvendu', NULL, 'He is a wholesaler of a energy drink company. Client sign up for a E-commerce website for that. His current website is https://uberwholesaler.com/. Project cost US$2000 and upfront amount US$500. AM team needs to call him tomorrow 16.2.23 at 10 AM EST (8.30 IST).', '', NULL, '1', '2023-02-15', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-24 15:57:11', '2023-08-24 15:57:11'),
(57, 44, 'UI/UX Design', 6, NULL, NULL, 'UI/UX Design', '', '', NULL, NULL, NULL, NULL, NULL, 'weightloss-solutions.com', 'Pritam', 'MISC', NULL, '\"Client signed up for UI/UX design. He is our existing client. He had a bad experience earlier. He needs PSD for his website. We need to take this project as priority and need to deliver it as soon as possible.\r\n\r\nHere is what client says:\r\nI am looking for a UI/UX design with WordPress content.\r\n\r\nCreate a design that we can adapt to every page\r\n\r\nHome page\r\n\r\nUltimate guide page\r\n\r\nBlog home page +each sub page header\r\n\r\nAnd the 3 pages of the Spa Products\r\n\r\nPlease look it over, give me a price.\r\n\r\nPlease keep in mind, I need to get this done fast.\r\n\r\nAM team needs to call him tomorrow (16.2.23 at 10 AM PST)\r\nAssign the project to anyone apart from brian and dev (Client says)\"', '', NULL, '1', '2023-02-15', 1, 250.00, 250.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-24 16:00:17', '2023-08-24 16:00:17'),
(58, 45, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-02-15', '2024-02-15', NULL, NULL, NULL, 'https://www.xclnav.com/', 'Pritam', 'MISC', NULL, 'Client is an existing client. He is into enterprise design. Client signed up for SMO with 300 USD for Facebook, and Instagram. His website: https://www.xclnav.com/. His target audience is between 20-35 and target area san Jose. He is only targeting IT professionals. He have a budget of 300 USD/week for Facebook advertisement. Initially we also suggested about linkdin advertisement but it seems a bit expensive to him so he will only do Facebook advertisement now. He said that we have to give him the creative\'s dimensions and he will provide us the creative. AM team needs to call him on 13th March at 4 PM CST (3.30 AM IST)', '', NULL, '1', '2023-02-15', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-24 16:04:06', '2023-08-24 16:04:06'),
(59, 46, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'daltboard.com', 'Prodipto', 'Surajit', NULL, 'Client signed up for a basic website. This is the reference website www.monecity.com. we have to create a website like this with a chatbot tool and inquiry form. He is not decided from where he is going to take the hosting. He will discuss that with his partner and inform us. AM team needs to call him back at 2:15AM today.', '', NULL, '1', '2023-02-22', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-24 16:07:36', '2023-08-24 16:07:36'),
(60, 47, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-02-23', '2024-02-24', NULL, NULL, NULL, 'www.picodentalgroup.com', 'Akash', 'Sarnab Kolay', NULL, 'Client is running this dental service https://www.picodentalgroup.com/. He sign up for social media marketing for his business with US$250. We have to take care of Facebook, Instagram, LinkedIn & Google as well. He want Google ad as well for that he will keep a separate ad budget. AM team needs to contact with him tomorrow on 24.2.23 at 10 AM PST', '', NULL, '1', '2023-02-23', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-24 16:11:00', '2023-08-24 16:11:00'),
(61, 48, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-02-23', '2024-02-24', NULL, NULL, NULL, 'https://eatgarbanzo.com/', 'Pritam', 'suman', NULL, 'client has a restaurant business. His website: https://eatgarbanzo.com/. He signed up for social media marketing for Facebook, Instagram, and Google. AM team needs to call him on either 1 march or 2 nd march.', '', NULL, '1', '2023-02-23', 1, 700.00, 350.00, 350.00, '2', NULL, 'Active', NULL, '2023-08-24 16:14:22', '2023-08-24 16:14:22'),
(62, 49, 'landing page design', 2, NULL, NULL, '', 'SEO', 'null', '2023-02-24', '2024-02-25', NULL, NULL, NULL, 'gotomentors.com', 'Prodipto', 'Surajit', NULL, 'Client signed up for a landing page redesign. We have to redesign this (gotomentors.com) landing page with new look and feel. He also wants to redesign his main website but he don\'t have the access of the website. This is not included in this package. AM team needs to call him back at 11PM IST today.', '', NULL, '1', '2023-02-24', 1, 250.00, 150.00, 100.00, '2', NULL, 'Active', NULL, '2023-08-24 16:18:58', '2023-08-24 16:18:58'),
(63, 50, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'manicnomad.com', 'Prodipto', 'MISC', NULL, '\"He is an existing client. He didn\'t liked the work earlier. He signed up for a website project. It is a website project for his friend. He is into pest control. He signed with upfront of 150 USD. Once he sees the mock up and approves it then he will pay another 150 USD and once we will deliver the project then he will pay 300 USD. Logo is included in the project.\r\n\r\nClient have sent some requirements which is as follows: \r\n\r\nI want to get a website set up for my buddy’s pest control business. \r\n\r\n1) I own domain BugOutBugs.com\r\n\r\n2) would need a logo for the business\r\n\r\n3) site with contact submission. \r\n\r\n4) he’s doing business in Omaha Nebraska. \r\n\r\n5) here’s a nice reference site. https://www.spidexx.com/\r\n\r\n6) let’s not show a pest control person in a mask. People have an adversity to chemicals so there’s no need to emphasize the negative of the industry. \r\n\r\nDo not copy the website for mock up rather take ideas and inspiration. AM team needs to call him at 1 CST today (12.30 IST)\"', '', NULL, '1', '2023-02-27', 1, 600.00, 150.00, 450.00, '2', NULL, 'Active', NULL, '2023-08-24 16:22:20', '2023-08-24 16:22:20'),
(64, 51, 'YouTube Channel Promotion', 2, NULL, NULL, '', 'SEO', 'null', '2023-02-28', '2024-02-28', NULL, NULL, NULL, 'doctorathomes.com', 'Akash', 'MISC', NULL, 'Client sign up for his YouTube channel promotion. His channel is https://www.youtube.com/@doctorathome1815. He is planning to post two videos in a week and we have to make sure he will get good engagement on that. Client sign up with US$200 for month. AM team have to call him today at 2.30 EST (1 IST).', '', NULL, '1', '2023-02-28', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-24 16:27:48', '2023-08-24 16:27:48'),
(65, 53, 'Website Redesign', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'phlebotomyeducators.com', 'Akash', 'MISC', NULL, 'Client sign up for redesign of this website https://phlebotomyeducators.com/. We have to take care the entire website as per their requirement and they also want a payment gateway for taking payments online. Project amount is $750 and pay the entire amount as an upfront. AM team need to follow with the client tomorrow as per their convenience. Contact person will be', '', NULL, '1', '2023-03-01', 1, 750.00, 750.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 08:32:36', '2023-08-25 08:32:36'),
(66, 54, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'cdnroofdr.com', 'Pritam', 'Kamaljit', NULL, '\"Client signed up for redesigning of his website: cdnroofdr.com, He liked our website Digitalwebber.com.\r\nHe is looking a modern looking website. In this package Logo+Business card and Introductory video is included. \r\nAM team needs to call him within 5 AM IST today\"', '', NULL, '1', '2023-03-02', 1, 734.00, 244.00, 490.00, '2', NULL, 'Active', NULL, '2023-08-25 08:35:34', '2023-08-25 08:35:34'),
(67, 53, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-03-03', '2024-03-04', NULL, NULL, NULL, 'https://elangomat.org/', 'Pritam', 'Suvendu (OM)', NULL, '\"He is an existing client. Earlier we didn\'t work well for him because the project manager didn\'t understand his nature of service. This time he said that if he doesn\'t get the work done properly then he will raise the dispute for both of the times. His business is: https://elangomat.org/\r\nthis is basically a boy scouting where they give elangomat training. This is a personality development sort of thing(Training camp). (Kindly do a little bit of research about the elangomat system and order of arrows). He is basically looking for more engagement and want to share his views with others about the elangomat system like what is the problem in the system and what could be change. I gave him an idea that we can target those people who are following this website https://oa-bsa.org/ because they are also into the same nature of service and this is a government organization . So we have to target specific audience and set a strategy in order to generate traffic. \r\n\r\nAlso he was asking that in his website there is no tool through he can track the traffic, so he was asking for some plug in suggestion so that we can track the traffic. So AM also have to give the suggestions as well. \r\n\r\nyou can refer this document to know more about the elangomat(not provided by client): https://www.hoac-bsa.org/Data/Sites/1/media/order-of-the-arrow/oa-documents/elangomat-guide-updated-march-2021.pdf\r\nAM Team needs to call him on Monday (6th March) at 10.30 AM EST\"', '', NULL, '1', '2023-03-03', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 08:39:23', '2023-08-25 08:39:23'),
(68, 56, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-03-08', '2024-08-08', NULL, NULL, NULL, 'https://ercfilenow.com/r/grantassistance', 'Prodipto', 'Sayani', NULL, 'Client signed up for Social Media Marketing for her ERC business. She is also willing to run the ad campaigns but she is very much concerned about the budget regarding the ad campaign. This is her landing page - https://ercfilenow.com/r/grantassistance. She is more interested in running the video ads only. AM Team needs to call her today', '', NULL, '1', '2023-03-08', 1, 435.00, 217.00, 218.00, '2', NULL, 'Active', NULL, '2023-08-25 08:42:51', '2023-08-25 08:42:51'),
(69, 57, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-03-08', '2024-04-08', NULL, NULL, NULL, 'https://omniblvd.com/', 'Pritam', 'MISC', NULL, 'This is the project of one of his client. We have to create 16 banner and 4 videos in a month. We have to do the posting as well. He said he will not work through Bitrix. He will give the high-level CRM access. And there he will create the the user dashboard. AM team needs to call him tomorrow(9.3.23) between 9 AM-11 AM EST', '', NULL, '1', '2023-03-08', 1, 250.00, 250.00, 0.00, '3', NULL, 'Active', NULL, '2023-08-25 08:46:03', '2023-08-25 08:46:03'),
(70, 58, 'SEO', 2, NULL, NULL, '', 'SEO', 'null', '2023-03-08', '2024-03-14', NULL, NULL, NULL, 'Kriv Technology LLC (krivtech.com)', 'Akash', 'Surajit', NULL, 'He is partner client and sign up for a SEO project. He have a client where she is into real estate. We have to take care of only SEO for that business and we have to use at least 10 keywords for that. Sign up with 300USD for one month. He also mention he did not like DEEP as a project manager so we have to give him a different project manager who can understand his needs better way and do proper communication with him. He will share the business details to the project manager as well. He also mention he is trying for one month if we do a good job then he will give this SEO project for long term and also he might give the Google PPC project of this business. AM team have to contact with him at 1.30 PM PST (3 AM IST).', '', NULL, '1', '2023-03-08', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 08:50:01', '2023-08-25 08:50:01'),
(71, 59, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'NA', 'Pritam', 'Debjoti', NULL, 'Client has signed up for a website development. He is looking for a template website like https://21cig.capital/en/. And he is looking for the content from https://www.marketprohomebuyers.com/. He wants a contact from on this website like https://fasthomeoffer.com/. He will also provide some of the contents. Along with this we have to switch his domain from providenceaccounting-appraisal to providenceappraisal for one of his other website. AM Team needs to call him on Monday at 4.00 PM EST (2 AM IST)', '', NULL, '1', '2023-03-10', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 08:53:38', '2023-08-25 08:53:38'),
(72, 60, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-03-13', '2024-07-17', NULL, NULL, NULL, 'earnwithal.info', 'Prodipto', 'SUMAN', NULL, '\"Client signed up for social media marketing for his debt management business which he has started 3 years ago. He hasn\'t done anything regarding marketing for the business. We will be helping him to generate leads, he has a website but he doesn\'t want to use that for fetching leads. He will developing new website with the help of us very soon. Just to start the work we have told that we will start with organic marketing. Client is a very busy person so he doesn\'t have much time to give on the project. AM team needs to call him tomorrow, i.e, 14.3.23 at 10 AM ES', '', NULL, '1', '2023-03-13', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 08:56:38', '2023-08-25 08:56:38'),
(73, 61, 'SSL Integration', 8, '1', NULL, '', '', '', '2023-03-14', '2025-06-20', NULL, NULL, NULL, 'https://thehipsteragency.com/', 'Pritam', 'MISC', NULL, 'The SSL has expired for https://thehipsteragency.com/. We have to integrate the SSL for 1 year.', '', NULL, '1', '2023-03-14', 1, 100.00, 100.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 08:59:45', '2023-08-25 08:59:45'),
(74, 62, 'Website Changes & Content Modification for Prince Hall Colonial Park Daycare', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'http://www.phcpdaycare.org/', 'Prodipto', 'Misc', NULL, 'Client signed up for doing some changes in the website of her client. Website URL is http://www.phcpdaycare.org. We need to update some information and remove the newsletter section and the footer name. Client has asked to communicate with her through skype only. He has added Max on her skype and wants the AM to be added over there only.', '', NULL, '1', '2023-03-14', 1, 100.00, 100.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 09:02:21', '2023-08-25 09:02:21'),
(75, 63, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'chinwomeninternationalmission.com', 'Prodipto', 'Abhay Bhanjo', NULL, '\"Client signed up for a website for her charity named chinwomeninternationalmission.com. She wants home, who we are, picture, event, blog, article, Donate box and also and ebook download option as well. She also needs video links to be added in the website.\r\nAM team needs to communicate with her through zoom. She will send us the zoom call details from her end. As Client has done wire transfer and she was not willing to pay the additional charges of 15 CAD. So we have offered that the additional charges that client is paying will be adjusted from the gross amount of the project.\"', '', NULL, '1', '2023-03-15', 1, 568.00, 181.00, 387.00, '2', NULL, 'Active', NULL, '2023-08-25 09:05:31', '2023-08-25 09:05:31'),
(76, 64, 'Project reactivation', 2, NULL, NULL, '', 'SEO', 'null', '2023-03-17', '2024-06-18', NULL, NULL, NULL, 'https://webbersunited.com/cms/skinnistore/', 'Prodipto', 'Abhay Bhanja', NULL, 'We have reactivated the project. The details already send to the project manager', '', NULL, '1', '2023-03-17', 1, 350.00, 100.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-25 09:09:22', '2023-08-25 09:09:22'),
(77, 65, 'Website Changes & Landing Page Creation', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'https://www.childrensbooksandmusic.com/', 'Saikat', 'MISC', NULL, '\"Client sign up for price changes for his website https://www.childrensbooksandmusic.com/. Client is already provided a document file for the price changes. \r\nAlso we have to create a landing page for him. Landing page will be same like this https://www.childrensbooksandmusic.com/special-discount-for-schools/ page. But this landing page is for schools only and when they will purchase the product they will not have to pay the VAT charges that time. \r\nAM team have to contact with him tomorrow on 22.3.23 at 6.30PM Eastern time (4.00 AM IST)\"', '', NULL, '1', '2023-03-21', 1, 400.00, 120.00, 280.00, '2', NULL, 'Active', NULL, '2023-08-25 09:29:20', '2023-08-25 09:29:20'),
(78, 66, 'Hosting & SSL for 1 Year', 8, NULL, NULL, '', '', '', '2023-03-24', '2024-03-23', NULL, NULL, NULL, 'https://fehospice.com/', 'Saikat', 'Misc', NULL, 'Client signed up for 1 year hosting and SSL.', '', NULL, '1', '2023-03-24', 1, 125.00, 125.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 09:34:33', '2023-08-25 09:34:33'),
(79, 67, 'Google Promotion', 2, NULL, NULL, '', 'Google Ads', 'null', '2023-03-24', '2024-03-24', NULL, NULL, NULL, 'https://cashforgoldanddiamonds.com/', 'Akash', 'MISC', NULL, '\"Client sign up with $200 for Google Ad Campaign. He is planning to get more reach and business by doing Google Ad Campaign into his website. For the campaign he have a separate ad budget of $200 for month. He is already doing Bing Ad as he mentioned me. He also told about his requirement. His targeted audience is Women above 25 Years and target market is entire USA. He is also told that he want clients will come with using their desktop not from their mobile phones. Also we have to integrate the google analytics for him and AM team have to call him on 27.3.23 at 1.30 IST.\r\n USE OUR BUSINESS NAME AS WEBART TECHNOLOGY PVT. LTD.', '', NULL, '1', '2023-03-24', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 09:38:58', '2023-08-25 09:38:58'),
(80, 68, 'Landing Page', 2, NULL, NULL, '', 'SEO', 'null', '2023-03-27', '2023-03-28', NULL, NULL, NULL, 'nvun.biz', 'Prodipto', 'Sarnab Kolay', NULL, 'Client signed up for a landing page for his client, where he is a wholeseller under https://aquafeelsolutions.com/. He needs content similar to the website https://aquafeelsolutions.com/. He also needs a logo, business card and an inquiry form as well. AM team needs to call him tomorrow, 28.3.23 at 10.45 AM EST. i.e, 8.15 PM IST', '', NULL, '1', '2023-03-27', 1, 430.00, 230.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 09:42:08', '2023-08-25 09:42:08'),
(81, 69, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-03-31', '2024-03-31', NULL, NULL, NULL, 'mediatownmarketing.com', 'Pritam', 'Kamaljeet', NULL, 'Client is in ecommerce business. His website: https://www.jeepbeef.com/. Client wants to do only paid advertisement. Please do not do any kind of Organic marketing. AM team needs to call him on Monday at 4.30 PM EST (2.00 AM IST)', '', NULL, '1', '2023-03-31', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-25 09:45:46', '2023-08-25 09:45:46'),
(82, 70, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-04-03', '2024-04-03', NULL, NULL, NULL, 'markatoons.com', 'Prodipto', 'Surajit', NULL, 'Client is a partner client. Signed up for social media marketing on facebook , instagram, linkedin for his buiness. AM needs to call him at 11:45 AM IST today.', '', NULL, '1', '2023-04-03', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 09:49:32', '2023-08-25 09:49:32'),
(83, 71, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'iubitivafamilia.info', 'Prodipto', 'Suman', NULL, '\"client signed for website he already purchsed the divi theme . we just have to build the website. he is into in skin product business. AM team needs to call him tomorow at 6pm to 6:30pm (est) her time.', '', NULL, '1', '2023-04-05', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 09:53:01', '2023-08-25 09:53:01'),
(84, 72, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-04-06', '2024-04-06', NULL, NULL, NULL, 'wristbandmonitors.com', 'Prodipto', 'Misc', NULL, 'Client signed up for Social Media Marketing for 1 month. He has a construction business. He has the instagram handle but he is not sure about the facebook, we have told him that we will help him in creating a new facebook page if he doesnt have. AM team needs to all him in 30 Mins, i.e, 9.45 PM IST today.', '', NULL, '1', '2023-04-06', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 09:56:42', '2023-08-25 09:56:42'),
(85, 73, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-04-06', '2024-04-16', NULL, NULL, NULL, 'Zulu Heritage Corporation', 'Pritam', 'satyajit das', NULL, '\"Client signed up for social media marketing. His website is http://zulujuice.com/ \r\nHe is currently working on the four products Zulu tea, Zulu juice, zulu bitter crystals and zulu beauty products (Blood of Gods)\r\nHis physical presence is in Atlanta, Georgia. In all the creatives we have to use that address only. He will send the contact number and complete address of the business.\r\nHis primary focus area is: Atlanta, Georgia\r\nPrimary focus audience: Black People only\r\n\r\nAM team needs to call him today at 1.30 PM EST(11.30 PM IST). He said that there will be another person to assist on the project as he can not speak always (Her name will be Mellissa)\r\nPayment Method: Payoneer\"', '', NULL, '1', '2023-04-06', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 09:59:54', '2023-08-25 09:59:54'),
(86, 74, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-04-10', '2024-04-10', NULL, NULL, NULL, 'bestdealsmusic.com', 'Prodipto', 'amitavo chakraborty', NULL, 'client signed up for social media marketing for one month. he is starting a property management business . he is in the registration phase and we need to help him with the brand awareness of his business. platform mentioned are - facebook , instagram and linkedin. AM team needs to call him tomorrow,i.e, 11.04.23 at 1:00pm PST,i.e, 1.30 AM IST.', '', NULL, '1', '2023-04-10', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-25 10:03:29', '2023-08-25 10:03:29'),
(87, 75, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-04-12', '2024-04-12', NULL, NULL, NULL, 'https://www.insurancebymikecain.com/', 'Akash', 'Sayani Nag', NULL, 'Client is running this business https://www.insurancebymikecain.com/ where he is looking for leads of people of above 65 age group. We have to take care of Facebook and Google marketing for him. He have another website http://mikecain.buymedigap.net/. Client is also using a platform call t65.app where he get information of people of 65 above age group. Client sign up with $250 for month. He will also have a Ad budget for ad campaign. AM team need to follow him on 13.4.23 at 3.30PM Central Time (2 AM IST).', '', NULL, '1', '2023-04-12', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-25 10:07:15', '2023-08-25 10:07:15');
INSERT INTO `sales` (`id`, `client_id`, `project_name`, `project_type`, `technology`, `type`, `others`, `marketing_plan`, `smo_on`, `start_date`, `end_date`, `platform_name`, `prefer_technology`, `description`, `business_name`, `closer_name`, `agent_name`, `reference_sites`, `remarks`, `customer_requerment`, `upsale_opportunities`, `isupsale`, `sale_date`, `currency`, `gross_amount`, `net_amount`, `due_amount`, `payment_mode`, `other_pay`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(88, 76, 'APP', 3, NULL, NULL, '', '', '', NULL, NULL, '1', '1', NULL, 'infinitycarrental.com', 'Prodipto', 'Saikat', NULL, 'Client signed up for a car rental application. He has already discussed about the entire project with Brian. He has paid the first phase out of ten installments. The first installment he has paid is for the figma designs. AM team needs to call him at 7 pm EST today.', '', NULL, '1', '2023-04-12', 1, 6500.00, 650.00, 5850.00, '2', NULL, 'Active', NULL, '2023-08-25 10:10:44', '2023-08-25 10:10:44'),
(89, 77, 'modification on her website', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'yourdesignsource', 'Prodipto', 'SUMAN', NULL, '\"Client has reactivated her project. She needs some modification on her website - yourdesignsource. She wants her website to be running on her server. AM team needs to call her tomorrow, i.e, 14.04.23 at 3.30 CST. She has told brian to be her project manager\r\n\"', '', NULL, '1', '2023-04-13', 1, 150.00, 150.00, 0.00, '2', NULL, 'Active', '2023-12-07 04:18:10', '2023-08-25 10:13:22', '2023-12-06 22:48:10'),
(90, 78, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-04-17', '2024-04-18', NULL, NULL, NULL, 'https://trollandunicorn.com/site/', 'Akash', 'Sayani', NULL, 'Client is selling online comic on this platform https://trollandunicorn.com/site/. His website is in under-construction by a fiber guy. Client sign up for marketing and more engagement into his platform where he want more users can log in to that platform by organically. Sign up with CA$250 ($186.61). We have to take care of his Facebook, Instagram and Twitter. AM team have to contact with him tomorrow on 18.04.23 around 12-1 PM PST (12.30-1.30 IST).', '', NULL, '1', '2023-04-17', 1, 373.00, 186.00, 187.00, '2', NULL, 'Active', NULL, '2023-08-25 10:16:16', '2023-08-25 10:16:16'),
(91, 79, 'GRAPHIC', 5, NULL, NULL, 'GRAPHIC', '', '', NULL, NULL, NULL, NULL, NULL, 'trollandunicorn.com/site/', 'Saikat', 'Sayani', NULL, 'Client wants to get a logo created for his business. This is an up sale, it is closed by Pinak.', '', NULL, '1', '2023-04-18', 1, 100.00, 100.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 10:19:20', '2023-08-25 10:19:20'),
(92, 80, 'Google listing, local listing and article posting', 2, NULL, NULL, '', 'Google Ads', 'null', '2023-04-19', '2024-04-24', NULL, NULL, NULL, 'flexpaintinginc.com', 'Prodipto', 'Debjoti Dutta', NULL, 'Client signed up for google listing, local listing and article posting on all the business directories and local directories of his local area. AM team needs to call him in 45 mins 4:30 AM IST.', '', NULL, '1', '2023-04-19', 1, 297.00, 148.00, 149.00, '2', NULL, 'Active', NULL, '2023-08-25 10:26:49', '2023-08-25 10:26:49'),
(93, 80, '2nd Installment', 2, NULL, NULL, '', 'SEO', 'null', '2023-04-24', '2024-04-25', NULL, NULL, NULL, 'chinwomeninternationalmission.com', 'Prodipto', 'Misc', NULL, 'Client paid us the second installment of the website into the personal account of soumyasis nath.', '', NULL, '1', '2023-04-24', 1, 184.00, 184.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 10:30:54', '2023-08-25 10:30:54'),
(94, 81, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-04-24', '2024-04-25', NULL, NULL, NULL, 'spectro intelligence', 'Saikat', 'ANIKET SAHA', NULL, 'client signed up for SMM. We need to handle his facebook and linkedin. We need to boost his webinar and bring more engagements in it. He will provide us three videos in a month, we need to post them and do organic marketting. AM team needs to call him 6 pm eastern his time which is 3:30 am ist.', '', NULL, '1', '2023-04-24', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 10:34:17', '2023-08-25 10:34:17'),
(95, 82, 'Website + Logo', 1, '1', '4', '', '', '', NULL, NULL, NULL, NULL, NULL, 'Vitalogy', 'Saikat', 'Akash', NULL, 'Client sign up for a restaurant website. He is looking for a website where he is planning to showcase his restaurant menus and also planning a online reservation with his website. Client sign up for $850 for the website and $100 for the logo design. Client pays $300 as an upfront amount to initiate the work. AM team needs to follow him on Friday 28.04.23 around 11AM Central Time (9.30PM IST). He also provided us the logo requirements (i.e. Branched and herbs like they are growing out of the logo, only to the one without the olive in the Y). He wants a vintage look with his logo where we can customize with his given samples or we can use other templates. We also promised to give him logo samples on Friday when AM will contact with him.', '', NULL, '1', '2023-04-24', 1, 950.00, 300.00, 650.00, '2', NULL, 'Active', NULL, '2023-08-25 10:37:04', '2023-08-25 10:37:04'),
(96, 83, 'GRAPHIC', 5, NULL, NULL, 'GRAPHIC', '', '', NULL, NULL, NULL, NULL, NULL, 'nsgconsulting.us', 'Prodipto', 'SUMAN', NULL, 'Client signed up for graphic designing work , where we have to create 15 creative and 5 motion graphic. He paid half of amount for work and half of amount he will pay after seeing the work. AM team need to call him 2:30am(IST).', '', NULL, '1', '2023-04-25', 1, 250.00, 125.00, 125.00, '2', NULL, 'Active', NULL, '2023-08-25 10:39:32', '2023-08-25 10:39:32'),
(97, 84, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-04-25', '2024-04-26', NULL, NULL, NULL, 'anilloworldwide.org', 'Akash', 'Aniket', NULL, 'He is providing English tuition and language courses. He is already doing marketing on Instagram but right now he is looking for more students who can take classes from his end. For that we will be taking care of marketing for him on Facebook, Instagram and LinkedIn. For that he sign up with $200 for marketing. We will give him this month as complementary service with Research and development and we can start marketing on very 1st of the month of May and we told him that renewal will be on the 1st of June. AM team need to follow him back tomorrow 26.04.23 around 11 AM EST (8.30 PM IST).', '', NULL, '1', '2023-04-25', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 10:42:58', '2023-08-25 10:42:58'),
(98, 85, '3 Lead Generation', 2, NULL, NULL, '', 'SEO', 'null', '2023-04-26', '2024-04-26', NULL, NULL, NULL, 'jrmunique.com', 'Saikat', 'Kamaljeet + Sayani', NULL, 'Client is running an IT service. His only concern is looking for generating at least of 3-5 qualified leads in a month for his business. We need to run the campaign from our end only. For that he signed up with CA$500 for the marketing. He did not provide any follow up call. AM team have to follow him up.', '', NULL, '1', '2023-04-26', 1, 734.00, 367.00, 367.00, '2', NULL, 'Active', NULL, '2023-08-25 10:46:15', '2023-08-25 10:46:15'),
(99, 86, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'slavicd.com', 'Akash', 'ANIKET', NULL, 'Client is looking for a Handyman website. He is using https://slavicd.com/handy.html this page for the service and wants to build a website like https://www.northseattlehandyman.com/. He also mentioned that he will not go for the Wordpress website so we have to built that website in Custom PHP. He sign up with $300 and rest of the $500 he will pay us at the time of delivery. AM team need to call him on 27.4.23 at 11AM Eastern Time (8.30PM IST).', '', NULL, '1', '2023-04-26', 1, 800.00, 300.00, 500.00, '2', NULL, 'Active', NULL, '2023-08-25 10:48:26', '2023-08-25 10:48:26'),
(100, 87, '1. Organic and paid ad campaign management 2. Video editing 3. One time fee for landing page', 2, NULL, NULL, '', 'SEO_SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-04-26', '2024-04-23', NULL, NULL, NULL, 'mystaffhero.com', 'Prodipto', 'Sarnab Kolay', NULL, 'Client is a partner client. He has signed up for a project where we need to handle the social media handling of his client and also we need to edit 3 -4 videos that the client will provide us. We also need to design the landing page for the client. The client has not yet closed the deal so he has also said that if the client does not onboard with him, he will use this as a credit and will use this for any other project that he will close. He has not given us the call back time so the AM team needs to call him at 1 PM PST today, i.e, 27.4.23', '', NULL, '1', '2023-04-26', 1, 700.00, 500.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 10:51:00', '2023-08-25 10:51:00'),
(101, 88, 'youtube intro and ending video', 5, NULL, NULL, 'youtube intro and ending video', '', '', NULL, NULL, NULL, NULL, NULL, 'https://nasopools.com/', 'Akash', 'ANIKET', NULL, 'Client sign up for YouTube intro and outro video for his YouTube channel. His YouTube channel is based on his business and he provide pool cleaning and repairing services. His website is https://nasopools.com/. Project amount $100 and paid entire upfront amount. Follow Up with client by tomorrow 28.4.23 at 2PM EST (11:30 IST).', '', NULL, '1', '2023-04-27', 1, 100.00, 100.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 10:54:24', '2023-08-25 10:54:24'),
(102, 89, 'Instagram marketing', 2, NULL, NULL, '', 'SEO', 'null', '2023-05-04', '2024-05-04', NULL, NULL, NULL, 'yourlearninglab.info', 'Prodipto', 'ANIKET', NULL, 'Client signed up for instagram marketing for her teaching business. She is an english teacher. She wants to promote herself in the indian market. She wants to reach to indian people who wants to learn english. Client has paid 100 USD now and the rest 50 USD she will be paying tomorrow. AM team needs to call her tomorrow, i.e, 05.05.23 at 1.30 ES', '', NULL, '1', '2023-05-04', 1, 300.00, 100.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 10:57:29', '2023-08-25 10:57:29'),
(103, 90, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'oldsouthco.com', 'Akash', 'Surajit', NULL, 'Client signed up for a basic website. His current website is (http://www.oldsouthco.com/). Client will fill up the questionnaire form. AM team needs to call him at 3pm CST (1:30AM IST) today.', '', NULL, '1', '2023-05-05', 1, 700.00, 350.00, 350.00, '2', NULL, 'Active', NULL, '2023-08-25 11:00:03', '2023-08-25 11:00:03'),
(104, 91, 'vidio work', 5, NULL, NULL, 'vidio work', '', '', NULL, NULL, NULL, NULL, NULL, '7od.org', 'Prodipto', 'suman', NULL, '\"client needs \r\nNeeds:\r\n\r\n· Color Correction\r\n\r\n· Color Grading\r\n\r\n· Sound leveling\r\n\r\non a video . \r\nsharing you the drive link - https://drive.google.com/file/d/1dU60iP2VcSq_yDKaoh2FjCtkgUDdPi75/view\r\nAM team needs to call him after 6 AM IST tomorrow.\"', '', NULL, '1', '2023-05-09', 1, 300.00, 150.00, 150.00, '2', NULL, 'Active', NULL, '2023-08-25 11:03:05', '2023-08-25 11:03:05'),
(105, 92, '{youtube video and email marketing}', 2, NULL, NULL, '', 'SEO_SMO', '[\"Facebook\",\"Youtube\"]', '2023-05-10', '2024-06-18', NULL, NULL, NULL, 'tadapp.net', 'Prodipto', 'ANIKET', NULL, 'Client signed up for youtube marketing for 3 months his youtube channel. He is more focusing on the hashtags and also as he had already worked with us he has told to make intro a bit shorter in terms of duration. Also, we need to do the email marketing. He has some sample email templates with him he will be sharing that with us, and he has asked us to use those templates as testing. Then we need to create the templates for him for blasting. AM team needs to call him today at 1 PM CST, i.e, 11.30 PM IST', '', NULL, '1', '2023-05-10', 1, 950.00, 950.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 11:06:11', '2023-08-25 11:06:11'),
(106, 93, 'UI design 7 Slides', 6, NULL, NULL, 'UI design 7 Slides', '', '', NULL, NULL, NULL, NULL, NULL, 'http://matrade-soft.com/', 'Akash', 'Kamaljit', NULL, 'Client is a developer. He is developing an web application by his end. For that he is looking for 7 UI Slide design. We have to create slides as per his requirement. He will have his logo and details which we can use for design. Entire project cost is CA$400 and sign up with CA$200. AM team need to call him in 20 minutes from our end at 2.10AM IST (4.40 EST) because he will not be available after 5 EST time.', '', NULL, '1', '2023-05-11', 1, 296.00, 148.00, 148.00, '2', NULL, 'Active', NULL, '2023-08-25 11:25:55', '2023-08-25 11:25:55'),
(107, 94, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-05-11', '2024-05-12', NULL, NULL, NULL, 'taktyx.com', 'Prodipto', 'Md Sahil Islam', NULL, 'Client signed up for social media marketing for 1 month. He is a partner client who has just started the business. We will be promoting and help him to get clients through organic marketing. AM team needs to call him on Monday, i.e, 15.05.23 at 6.30 PM his time, 4 AM IST.', '', NULL, '1', '2023-05-11', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 11:28:30', '2023-08-25 11:28:30'),
(108, 95, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-05-12', '2024-05-13', NULL, NULL, NULL, 'http://endtimeplanning.com/', 'Prodipto', 'Sayani', NULL, 'Client signed up for SMO for her non profit. She is looking for more donations. We will be handling facebook, instagram and youtube. For the youtube, she already has the videos we need to just create a new youtube channel and we need to upload that videos on the new channel. We have promised the ssl certification for her website complementary from our end. AM team needs to call her at 2.10 AM IST today.', '', NULL, '1', '2023-05-12', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 11:30:58', '2023-08-25 11:30:58'),
(109, 96, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-05-12', '2024-05-12', NULL, NULL, NULL, 'garrisongrip.com', 'Prodipto', 'Suman', NULL, '\"Client signed up for SMO for 15 days (250usd , if client like the work then he will pay again after 15 days.we have to make 4 videos for the entire month. The duration of the video will 1 minute 10 second. We have to take care of facebook, instagram, twitter and Youtube. Am team needs to call him on Monday at 8 AM PST, i.e, 8:30(ist)', '', NULL, '1', '2023-05-12', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-25 11:33:34', '2023-08-25 11:33:34'),
(110, 97, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'evergladeskitchenandbath.com', 'Akash', 'SUMAN', NULL, '\"Client is running a home improvement service called Everglades Kitchen & Bath. Client sign up for a website development where he is planning to showcase his services and his previous works into the portfolio section. The project cost is $560 and sign up with $260. He also told us he have a color preference of the website as green and black. He already have a questionnaire link by his email. AM team have to call him back by tomorrow on 16.05.23 at 6PM Eastern time (3.30 IST)', '', NULL, '1', '2023-05-15', 1, 560.00, 260.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 11:35:54', '2023-08-25 11:35:54'),
(111, 98, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'alphabetcity.biz', 'Akash', 'Sayani', NULL, 'Client is doing Immigration Consultation. He signed up for a website development. We have to build a website for him and he also want to take payment by his website. So we have to take care of payment gateway integration. He will send us some references from his end. His main concern is he wants to build the website that will be complete professional. Project cost is CA$1149 and sign up with CA$400 for the website. AM team can all him on 17.05.23 at 11:30 CST (10 IST) .', '', NULL, '1', '2023-05-16', 1, 852.00, 296.00, 556.00, '2', NULL, 'Active', NULL, '2023-08-25 11:39:11', '2023-08-25 11:39:11'),
(112, 99, 'SMO for 2 Businesses', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-05-16', '2024-05-16', NULL, NULL, NULL, 'goldenCompassGroup.com', 'Akash', 'Kamaljeet', NULL, 'Client is in financial services. His business is goldenCompassGroup.com. He signed up for social media marketing for 2 business for 60 days. We have to do social media marketing on Facebook, Instagram, LinkedIn. As he mentioned one of the business is his financial business we have to take care another one is for one his client who is also into the same nature of business. Project cost is $500 for 60 Days for 2 businesses. AM team can contact with him on 17.05.23 at 12.30pm CST (11 IST).', '', NULL, '1', '2023-05-16', 1, 500.00, 500.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 11:41:59', '2023-08-25 11:41:59'),
(113, 100, '2 Videos', 5, NULL, NULL, '2 Videos', '', '', NULL, NULL, NULL, NULL, NULL, 'https://www.fiduciaryriskratings.com/', 'Prodipto', 'Misc', NULL, 'Client signed up for 2 videos where he wants to explain what his product does. He wants to explain this page - https://www.fiduciaryriskratings.com/active-risk-monitoring/. He has liked the work of salish dictionary\'s video. If we can give him good quality he will give us more work. AM team needs to call him tomorrow, 18.05.23 at 11 AM EST, i.e, 8.30 PM IST.', '', NULL, '1', '2023-05-17', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 11:44:39', '2023-08-25 11:44:39'),
(114, 101, 'Landing Page', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'uscarpetfactory.com', 'Prodipto', 'Satyajit Das', NULL, '\"Client signed up for the landing page for his website. His business name is https://museuminstallation.com/. In this website his banner is not popping and that is a upsale point but before that we need to show him the landing page. AM team needs to call him tomorrow, i.e, 19.05.23 at 12 noon CST, i.e, 10.30 PM IST.\r\n\r\nMuseum - Granite - Quartz - Cabinet\r\nRemodeling Experience Museum Flooring - Quality with Exceptional Service At Museum Flooring, Cabinet, Quartz, Granite.\r\nmuseuminstallation.com\"', '', NULL, '1', '2023-05-18', 1, 200.00, 100.00, 100.00, '2', NULL, 'Active', NULL, '2023-08-25 11:47:25', '2023-08-25 11:47:25'),
(115, 102, 'Marketing for Fundraising', 2, NULL, NULL, '', 'SEO', 'null', '2023-05-19', '2024-05-20', NULL, NULL, NULL, 'electricitygenerationsystem.com', 'Akash', 'MISC', NULL, 'Client is looking for fundraising campaign for his Go Fund Me. His campaign link is https://www.gofundme.com/f/patents-inventions-that-would-improve-life?utm_campaign=p_lico+share-sheet&utm_medium=copy_link&utm_source=customer. We have to help him for collecting fund for him. As he do not have money right now he sign up for 15 Days Marketing for him with $100. Marketing package is $200 for month. AM team need to call him on monday 22.05.23 at 3 PM EST (12.30 IST).', '', NULL, '1', '2023-05-19', 1, 200.00, 100.00, 100.00, '2', NULL, 'Active', NULL, '2023-08-25 11:50:47', '2023-08-25 11:50:47'),
(116, 103, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-05-19', '2024-05-19', NULL, NULL, NULL, 'filmore francis', 'Akash', 'KAMALJEET SINGH', NULL, 'Client is providing business credit and business loans. He have a website https://yvemoreenterprise.com/. He sign up for social media marketing on Facebook, Instagram, LinkedIn & Google promotion. His main focus is generating leads for his business. Sign up for two month of marketing for $500. He will also invest on Ad Budget. AM team needs to contact with him on Monday 22.05.23 at 10.30 EST (8 IST|).', '', NULL, '1', '2023-05-19', 1, 500.00, 500.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 11:53:51', '2023-08-25 11:53:51'),
(117, 104, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-05-22', '2024-05-22', NULL, NULL, NULL, 'insurancelifema', 'Prodipto', 'suman', NULL, 'He is a partner client. He is into in insurance. We have to generate leads for his insurance business from instagram and facebook, he like https://ltinsures.com/. He want to taste us our services weather we are capable or not, if he like the work then he will continue the services.AM team leads to call him at 11:30pm(ist) i;e 1pm cst', '', NULL, '1', '2023-05-22', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 11:56:43', '2023-08-25 11:56:43'),
(118, 105, 'One Logo & Business Card Design', 5, NULL, NULL, 'One Logo & Business Card Design', '', '', NULL, NULL, NULL, NULL, NULL, 'goldfieldsglobal.com', 'Akash', 'Md Sahil Islam', NULL, '\"Client sign up for one Logo and Business Card Design (2 Revision mentioned) for her son\'s business. For that she pay CA$100. She recently fired her graphics designer. If we deliver quality work to her she have more graphics projects that she will outsource to us. She is also planning to hire us as for her graphics work as she mentioned earlier. \r\n(6\"\"x8\"\" \r\nHale Lawn Service \r\nCarson Hale \r\n647 619 8449\r\n\r\nLawn cutting \r\nTrimming\r\nRemoval services) This is the information for the business card. \r\nAM team need to call her today at 12.15 IST.\"', '', NULL, '1', '2023-05-22', 1, 74.00, 74.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 12:00:10', '2023-08-25 12:00:10'),
(119, 106, 'Facebook', 2, NULL, NULL, '', 'SMO', '[\"Facebook\"]', '2023-05-23', '2023-05-23', NULL, NULL, NULL, 'caferlalek.com', 'Prodipto', 'Surajit', NULL, 'Client is a partner client. Signed up for Social media marketing on Facebook. He will share his Ad budget with his Project Manager. AM team needs to call him between 3:00AM-3:05AM IST today.', '', NULL, '1', '2023-05-23', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-25 12:03:51', '2023-08-25 12:03:51'),
(120, 107, 'WEB APPLICATION', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'https://wrappedinmusic.com/', 'Akash', 'SUMAN', NULL, '\"Client sign up for a custom website design where client wants to sell MP3 Special Occasion Song with buyer\'s personally spoken story/message inserted. Once customer will purchase the music they can upload or record the narration for final touch. And super admin will customize that and will deliver the final product to the website with a link which customers can share and they can Download or Listen from there. Project value is 3600 USD and sign up with 900 USD. He will pay rest amount in easy 3 breakups. He also mentioned that he can pay the 2nd Installment by 1st week of June. He will be going to USA by tomorrow to her daughter house. AM team have to contact with him in 15 minutes (4.55 AM IST).\r\n(His Skype ID is knightshot and address him as David)\"', '', NULL, '1', '2023-05-23', 1, 3600.00, 900.00, 2700.00, '2', NULL, 'Active', NULL, '2023-08-25 12:06:40', '2023-08-25 12:06:40'),
(121, 108, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'nvun.biz', 'Prodipto', 'Misc', NULL, 'Client signed up for a non profit website. He is already a client of us. He asked us to be more specific in the communication process. Also, the project that we are working he is looking to get it delivered as soon as possible. AM team need to call him tomorrow at 10.30 AM EST, i.e, 8 PM IST.', '', NULL, '1', '2023-05-24', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 12:10:30', '2023-08-25 12:10:30'),
(122, 109, 'Facebook Marketing & Blog Posting', 2, NULL, NULL, '', 'SEO_SMO', '[\"Facebook\"]', '2023-05-24', '2024-05-24', NULL, NULL, NULL, 'https://noigilerfoundation.org', 'Prodipto', 'Aniket', NULL, 'Client signed up for Facebook marketing and blog posting for his non - profit. His website is https://noigilerfoundation.org. AM team needs to call him today at 4 AM IST.', '', NULL, '1', '2023-05-24', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-25 12:17:47', '2023-08-25 12:17:47'),
(123, 110, 'Shopify Customization', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'sexytimetoys.com', 'Akash', 'Sayani', NULL, 'Client sign up for shopify customization where he will sell some adult products. He is already working on his website but due to some time issue currently he is not able to do the work. We have to take care of product upload as category wise and we have to take care of images and banners of website. He told that he have CSV file for his products. AM team have to contact with him at 4pm EST (1.30 IST). He will give the website access to the project manager itself.', '', NULL, '1', '2023-05-25', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-25 12:22:43', '2023-08-25 12:22:43'),
(124, 111, 'psd mockup design', 6, NULL, NULL, 'psd mockup design', '', '', NULL, NULL, NULL, NULL, NULL, 'blockstation.com', 'Prodipto', 'satyajit das', NULL, 'client signed up for PSD Mock up for a Website for stock exchange website. The client will give us the information about the call back time.', '', NULL, '1', '2023-05-25', 1, 100.00, 100.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 12:25:39', '2023-08-25 12:25:39'),
(125, 112, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-05-26', '2024-05-26', NULL, NULL, NULL, 'https://www.weroutefreedom.com/?elevate and https://www.profitacceleratorsystem.com/fun/?page=optin&id=rduke777&wid=hb-1', 'Prodipto', 'Aniket', NULL, 'Client signed up for social media marketing for 1 month. He wants to drive traffic on https://www.weroutefreedom.com/?elevate and https://www.profitacceleratorsystem.com/fun/?page=optin&id=rduke777&wid=hb-1, we have also told him that we will post some blogs as well in the blogging platforms. AM team needs to call him on Monday, i.e, 29.05.23 between 1 and 2 PM CST, i.e, 11.30 and 12.30 IST.', '', NULL, '1', '2023-05-26', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 12:28:52', '2023-08-25 12:28:52'),
(126, 113, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-05-29', '2023-05-30', NULL, NULL, NULL, 'Delphi Distributing, LLC', 'Prodipto', 'KAMALJIT', NULL, '\"He is into a business of sport equipment selling and sign up for social media marketing. Sign up for $300 for month. AM team needs to call him at 3 Mountain Time (2.30 IST) today.\r\n\"', '', NULL, '1', '2023-05-29', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 12:59:18', '2023-08-25 12:59:18'),
(127, 114, 'GRAPHIC', 5, NULL, NULL, 'GRAPHIC', '', '', NULL, NULL, NULL, NULL, NULL, 'elevator63.com', 'Prodipto', 'Satyajit Das', NULL, 'Client signed up for 4 creative design, AM team needs to call her tomorrow 1est.', '', NULL, '1', '2023-05-30', 1, 100.00, 100.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 13:02:07', '2023-08-25 13:02:07'),
(128, 115, 'DIGITAL MARKETING', 2, NULL, NULL, '', 'SEO', 'null', '2023-05-30', '2024-05-30', NULL, NULL, NULL, 'https://labwork360.com/', 'Prodipto', 'Sudhanshu', NULL, 'Client signed up for digi mix (SEO & SMO) for 2 months. His business is https://labwork360.com/. We suggested the ad budget of 400 USD for him. We need to handle the ad accounts for him. Also, we need to blast the emails from his portal that he has. AM team needs to call him tomorrow, i.e, 31.5.23 at 10 AM CST, i.e, 8.30 PM IST.', '', NULL, '1', '2023-05-30', 1, 900.00, 450.00, 450.00, '2', NULL, 'Active', NULL, '2023-08-25 13:04:52', '2023-08-25 13:04:52'),
(129, 116, '{website & SEO}', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'powerfulconstitutionalrights.org', 'Prodipto', 'Rishikesh', NULL, 'Client signed up for a basic informative website for the non profit with a donate now button. We also need to do the SEO for the 2 months. We have given a customized deal of the website and the 2 months of SEO. AM team needs to call him at 1 AM - 1:10 AM IST today.', '', NULL, '1', '2023-05-31', 1, 1000.00, 500.00, 500.00, '2', NULL, 'Active', NULL, '2023-08-25 13:07:24', '2023-08-25 13:07:24'),
(130, 117, 'VIDEO EDITING', 5, NULL, NULL, 'VIDEO EDITING', '', '', NULL, NULL, NULL, NULL, NULL, 'wantride.com', 'Akash', 'SUMAN', NULL, 'Client signed up for video editing. He need three video for his IT services ,which he use for his promotion. AM teams needs to call him tomorrow at 1am(IST) i;e 3:30 pm(EST)', '', NULL, '1', '2023-05-31', 1, 300.00, 150.00, 150.00, '2', NULL, 'Active', NULL, '2023-08-25 13:10:03', '2023-08-25 13:10:03'),
(131, 118, 'Website Customisation', 4, NULL, NULL, 'Website Customisation', '', '', NULL, NULL, NULL, NULL, NULL, 'Vision Team Network Inc', 'Akash', 'Aniket', NULL, '\"Client is the owner of a website https://visionteamnetwork.com/ but there is some issues with his website which he want to fix. We have to do \r\n•Bug Fixing\r\n•Payment Gateway Issue\r\n•Ecommerce Page Issue\r\n•Ecommerce Login Issue\r\n•Switch the Hosting\r\nThe website is build in PHP. So we have to work on that. He will provide us the user access by tomorrow. He sign up with $200 and he will pay rest $300 at time of project delivery. For payment he is using authorize as gateway we suggest him to integrate stripe as payment gateway. AM team have to contact with him on 2.06.23 at 11 am EST (8.30 IST)\"', '', NULL, '1', '2023-06-01', 1, 500.00, 200.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 13:12:26', '2023-08-25 13:12:26'),
(132, 119, 'Basic Website and SEO for 3months', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'ymedical.org', 'Prodipto', 'Surajit', NULL, 'Client signed up for a basic website with 3months of SEO. This is for his client\'s business . AM team needs to call him at 1:25AM today.', '', NULL, '1', '2023-06-02', 1, 1100.00, 500.00, 600.00, '2', NULL, 'Active', NULL, '2023-08-25 13:15:39', '2023-08-25 13:15:39'),
(133, 120, 'Website & Logo Design', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'Atty1.com', 'Akash', 'Trambak Singha Roy', NULL, '\"Client is in real estate law services. He have a website www.Atty1.com. Client sign up for redesigning of his website as per his requirements he already mentioned by email. We have to create a logo for him as well. Website cost will be $500 and for logo he is paying an additional cost of $50. Project value is $550 and sign up with $250. AM team needs to contact with him at 7pm Eastern Time (4.30 IST).\r\n\r\nProject information from client:\r\nYou will use the look & feel & color scheme (subject to revisions at my request) from\r\n\r\nhttps://shopluxusa.com/ YES - I LIKE THE Home page & MENUS, but the other pages need different format \r\nThe FEATURED DAILY DEALS portion of the page could be used on a Practice Areas page, with each Watch replaced by image for each practice area\r\n\r\n\r\nhttps://countrywideprocess.net/ The website could also take some ideas from the Home page only from this site (not the other pages)\r\n\r\nFor logo he like the logo of this website https://rouselawyers.com.au/.\r\n\r\nRest of the details is forwarded to the project@digitalwebber.com\"', '', NULL, '1', '2023-06-02', 1, 550.00, 250.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 13:18:24', '2023-08-25 13:18:24'),
(134, 121, 'SEO , Website modification & SSL', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'voltamed.org', 'Prodipto', 'Surajit', NULL, 'Client signed up for modification of this website (http://voltamed.org/) with 2 months of SEO. Also we have to renew the SSL of this website. AM team needs to call him at 12:15 AM today. It is Up-sale.', '', NULL, '1', '2023-06-05', 1, 600.00, 600.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 13:21:47', '2023-08-25 13:21:47'),
(135, 122, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-06-05', '2023-06-05', NULL, NULL, NULL, 'webandstorymedic.com', 'Saikat', 'Amitavo', NULL, '\"Client signed up for SMO for 1 month. She is a partner client where we have to give her leads for her business. AM team needs to call her tomorrow, i.e,06.06.23 in between 12.30 PM - 1 PM CST.', '', NULL, '1', '2023-06-05', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 13:25:05', '2023-08-25 13:25:05'),
(136, 123, 'Shopify Modification', 4, NULL, NULL, 'Shopify Modification', '', '', NULL, NULL, NULL, NULL, NULL, 'http://www.discountgoldanddiamonds.com', 'Akash', 'MISC', NULL, '\"Client sign up for shopify customization for him. Where we have to create a new page for him where he will add approx 30 products & he will give us images and all description. The pages will like https://discountgoldanddiamonds.com/collections/engagement-rings/products/diamond-engagement-ring-rsk50536-e-c?variant=42336473120927 and the 360 view videos will be also provided by client. He will start with 1 product at first then by the time he will provide rest of the products to us for upload.\r\nHis first priority is to change the banner with a hyperlink. He already provided us that. The link he provided that is http://discountgoldanddiamonds.hibid.com/auctions/current which we have to hyperlink on the banner which is given in to the chat.\r\nAM team needs to call him at 4-5pm EST (1.30-2.30 IST)\"', '', NULL, '1', '2023-05-06', 1, 300.00, 200.00, 100.00, '2', NULL, 'Active', NULL, '2023-08-25 13:27:53', '2023-08-25 13:27:53'),
(137, 124, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'https://www.victorymediapro.com/', 'Akash', 'MISC', NULL, 'Client sign up for a basic website development where he is planning to show all of his services and client can get in touch with him for services. Services he provide photography, videography, graphics design, Video editing etc. Project cost $500 and sign up with $250. AM team can contact with him by tomorrow 6.6.23 at 1pm Central Time (11.30 IST)', '', NULL, '1', '2023-06-05', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-25 13:31:55', '2023-08-25 13:31:55'),
(138, 125, 'SEO', 2, NULL, NULL, '', 'SEO', 'null', '2023-06-07', '2024-06-07', NULL, NULL, NULL, 'https://www.farrowpulicelaw.com/sarasota-personal-injury-lawyer/', 'Saikat', 'suman', NULL, '\"Client signed up for Search Engine Optimization. currently he ranked number 33, we have to make it 1 in ranking this is his website (https://www.farrowpulicelaw.com/sarasota-personal-injury-lawyer/) . He also provide the keyword, we have optimize this one keyword (sarasota personal injury lawyer)\r\n.We asked the client to give the time to call him.\"', '', NULL, '1', '2023-06-07', 1, 440.00, 220.00, 220.00, '2', NULL, 'Active', NULL, '2023-08-25 13:36:11', '2023-08-25 13:36:11'),
(139, 126, 'Landing page, Blank Template E-commerce website and demonstration of E-commerce', 1, '1', '3', '', '', '', NULL, NULL, NULL, NULL, NULL, 'sys2com.com', 'Akash', 'Sarnab Kolay', NULL, 'Client is looking for a eCommerce template of lorem version. We will give him the shopluxusa.com and there will be no content and all. His Idea is he wants to learn how e-commerce will work and its internal feature. For that we will also help him for demonstration and guidance on that. He also want a separate landing page where he wants to showcase himself as a e-commerce manager and about himself. We have to provide him a template for that and we have to set up that page with his content and images. AM team can contact him by tomorrow on 8.6.23 but before that he ask for a whatsapp text is he available or not. We have to create a whatsapp group as well with him. He asks for a female project manager as his other business in-charge are also female so that will be convenient for them if there is a female project manager. ( Rest $300 he will pay in 2 break ups as $150 each)', '', NULL, '1', '2023-06-07', 1, 500.00, 200.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 13:40:01', '2023-08-25 13:40:01'),
(140, 127, '4 UI/UX Designs', 6, NULL, NULL, '4 UI/UX Designs', '', '', NULL, NULL, NULL, NULL, NULL, 'locallatitude.com', 'Prodipto', 'Misc', NULL, 'Client signed up for 4 UI UX designs for his website. His website is https://platftou.elementor.cloud/. It will be opened with the pin - 7880. We have to create 4 UI UX for Destination page. We have to create the designs for explore our citites, attractions, cuisines and start planning. He likes the design of this website https://www.simpleviewinc.com/. AM team needs to call him today at 4 AM IST.', '', NULL, '1', '2023-06-08', 1, 250.00, 150.00, 100.00, '2', NULL, 'Active', NULL, '2023-08-25 13:42:48', '2023-08-25 13:42:48'),
(141, 128, 'Email Marketing', 2, NULL, NULL, '', 'SEO', '[\"Facebook\"]', '2023-06-09', '2024-06-10', NULL, NULL, NULL, 'makeservicegreatagain.com', 'Saikat', 'Trambak Singha Roy', NULL, 'Client sign up for email marketing. We have to provide him 2 email template. He have a mailchimp account & he will provide us an access. Dev also had a word with the client and understand the project very well. Sign up for $150 for the project. AM team have to contact with him on monday 12.6.23 at 10.30 Eastern Time (8PM IST)', '', NULL, '1', '2023-06-09', 1, 300.00, 150.00, 150.00, '2', NULL, 'Active', NULL, '2023-08-25 13:49:53', '2023-08-25 13:49:53'),
(142, 129, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'http://midvalleydealers.com/', 'Prodipto', 'Kamaljit', NULL, 'I am attaching client\'s requirement in the sales deal. AM team needs to call him on Monday, i.e, 12.06.2023 at 11.30 AM Texas time.', '', NULL, '1', '2023-06-09', 1, 3000.00, 500.00, 2500.00, '2', NULL, 'Active', NULL, '2023-08-25 13:54:28', '2023-08-25 13:54:28'),
(143, 130, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'Quality of Life Solutions INC', 'Akash', 'MISC', NULL, 'Client sign up for a website development. We have to create a new website for his new community. This website will be the home for all of his plan and ideas he have for his community. In this website there will be few sections of his community\'s academy, resort and other staffs. There will be a page of communication where he will showcase of his new podcast and show information which he planning to host on youtube. Website cost is $900 and sign up with $450. AM team have to call him today on 12.6.23 at 3.30 Central Time (2 AM IST).', '', NULL, '1', '2023-06-12', 1, 900.00, 450.00, 450.00, '2', NULL, 'Active', NULL, '2023-08-25 13:57:09', '2023-08-25 13:57:09'),
(144, 131, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-06-13', '2024-06-14', NULL, NULL, NULL, 'slidingsolutions.com', 'Prodipto', 'Surajit', NULL, 'Client signed up for Social media marketing for 30 days. client\'s manager will be the primary point of contact for this project. Her name is Dani and this is her number 7602958500. We need to call Dani. She is already filling up the questionnaire form. AM team needs to call her back at 1PM PST (1:30AM IST) today.', '', NULL, '1', '2023-06-13', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 14:00:48', '2023-08-25 14:00:48'),
(145, 132, 'Project Reactivation', 4, NULL, NULL, 'Project Reactivation', '', '', NULL, NULL, NULL, NULL, NULL, '121five.com', 'Prodipto', 'Misc', NULL, 'Client reactivated the project of his website. We have to do the needful changes on the website and we have to make the website live into his godaddy server. He does not know how to give the delicate access so the project manager will have to guide him regarding the same. AM Team needs to call him on Monday, i.e, 19.06.23 at 1.30 his time, i.e, 11 PM IST.', '', NULL, '1', '2023-06-15', 1, 300.00, 300.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 14:03:42', '2023-08-25 14:03:42'),
(146, 133, 'SSL for 2 years', 8, NULL, NULL, '', '', '', '2023-06-16', '2025-06-16', NULL, NULL, NULL, 'idealchoicehomehealth.com', 'Saikat', 'Misc', NULL, 'Client signed up for updating the SSL of his website. His website is idealchoicehomehealth.com.', '', NULL, '1', '2023-06-16', 1, 120.00, 120.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 14:07:21', '2023-08-25 14:07:21'),
(147, 134, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-06-19', '2024-06-19', NULL, NULL, NULL, 'https://www.happykratoms.com/', 'Prodipto', 'SUMAN', NULL, 'Client signed up for SMO, his website is (https://www.happykratoms.com/). AM team needs to call him tomorrow at 11:30(est) i;e 9pm(ist). Client has asked us to do the research properly before we are starting the work for him.', '', NULL, '1', '2023-06-19', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-25 14:11:08', '2023-08-25 14:11:08'),
(148, 135, 'Landing Page with 2 years of hosting And 2 months of Marketing', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'aliafarooqreality.com', 'Prodipto', 'Misc', NULL, '\"Client signed up for a landing page and 2 months of marketing on facebook, instagram and google. She is into real estate.We also need to provide hosting from our end. Price quoted for hosting is 260 CAD for 2 years. Client is a bit skeptical. We need to make sure that we are giving her good work. She had a domain but she is not sure whether she has it now or not. If she does not have we need to suggest her good domain names. AM team needs to call her today, i.e, 20.06.23 at 8.30 IST.', '', NULL, '1', '2023-06-19', 1, 798.00, 150.00, 648.00, '2', NULL, 'Active', NULL, '2023-08-25 14:15:10', '2023-08-25 14:15:10'),
(149, 136, 'Digimix', 2, NULL, NULL, '', 'SEO', 'null', '2023-06-21', '2024-06-21', NULL, NULL, NULL, 'www.northstarreserves.com', 'Akash', 'MISC', NULL, 'Client is running a consulatation services from his end. He is looking for marketing of his business. We have to take care of SMO (ie Facebook, Instagram, LinkedIn) and SEO for his busienss. He mostly serving on mountain time zone states (i.e.Colorado, Idaho, Montana, Oregon, Utah). For that client sign up for $400 monthly. AM team have to call him on 22.06.23 at 10 AM Mountain Time (9.30 IST).', '', NULL, '1', '2023-06-21', 1, 800.00, 400.00, 400.00, '2', NULL, 'Active', NULL, '2023-08-25 14:18:21', '2023-08-25 14:18:21'),
(150, 137, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-06-23', '2024-06-23', NULL, NULL, NULL, 'https://zenithinsuranceservices.com/', 'Prodipto', 'ANIKET', NULL, 'Client signed up for social media marketing for his insurance business. Client\'s business website is - https://zenithinsuranceservices.com/. He wants to generate leads for this business. He has liked ltinsures.com and he has an another business of IT Consultancy. AM team needs to call him today at 12.20 AM IST.', '', NULL, '1', '2023-06-23', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 14:21:49', '2023-08-25 14:21:49'),
(151, 138, 'Website+Graphics', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'Beach Family Photo', 'Saikat', 'MISC', NULL, '\"Client is sign up for website design with graphics design. We will create:-\r\n1. Website\r\n2. Logo\r\n3. Business card\r\n4. Refregerator magnet Design 3\r\n5. Table top sign holders 3 (With QR code)\r\n6. Sign hotel lobby design\r\n7. Brochure design & content 1\r\n8. Door hangers 3\r\n9. Magazine 10 pages\r\nProject cost will be $450 for the website and $250 for creatives. Total project cost is $700 and Sign up with $300. AM team have to call him on Monday at 10am Eastern Time (7.30pm IST).\"', '', NULL, '1', '2023-06-23', 1, 700.00, 300.00, 400.00, '2', NULL, 'Active', NULL, '2023-08-25 14:24:49', '2023-08-25 14:24:49'),
(152, 139, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-06-26', '2024-06-26', NULL, NULL, NULL, 'https://solexvideoscanners.org/', 'Prodipto', 'Sreyashi Ghosh', NULL, 'Client signed up for Social Media marketing for his business. His website is https://solexvideoscanners.org/. We have to drag people into his website. He has said we need to communicate with his daughter monica and she will add him on conference and each and every discussion will be having through monica only. AM team needs to call monica at 2 AM IST today.', '', NULL, '1', '2023-06-26', 1, 1500.00, 750.00, 750.00, '2', NULL, 'Active', NULL, '2023-08-25 14:28:37', '2023-08-25 14:28:37'),
(153, 140, 'WEBSITE REDESIGN', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'scripturesong.com', 'Akash', 'KAMAL', NULL, '\"Client is having a music website Client is having a music website http://scripturesong.com/. He sell music album and CD\'s. Client sign up for redesign the website. We have to make the website with the same look and feel like the current one but we have to add a player where customer can listen few songs and also a payment gateway integration (Paypal) for purchasing the album or CD\'s. In his current website he do not have this features we have to take care of that. But he is willing to create the new website like the old one. Project cost is 1350 CAD and Sign up with 500 CAD. He will pay the rest in 2 break ups. Client provide us ftp of the old website:\r\nWebsite UrL. http://www.scripturesongs.com\r\nftp: ftp2.netadvent.org\r\nusr: scripturesongsronv\r\npss: vaillant\r\nAnd his requirement into a document we will provide in workgroup itself. AM team have to call him on 4pm Mountain Time (3.30 IST).\"', '', NULL, '1', '2023-06-26', 1, 1026.00, 380.00, 646.00, '2', NULL, 'Active', NULL, '2023-08-25 14:32:08', '2023-08-25 14:32:08'),
(154, 141, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'https://www.gamblingdomains.com/', 'Akash', 'ANIKET', NULL, '\"Client have a domain flipping business https://www.gamblingdomains.com/. Client sign up for website redesign. His vision is creating the website simple and user friendly with the help of search filter for category and subcategory. There will be a payment gateway. Gross will be $1500 and sign up will be $300. AM team have to call him at 3.30pm Pacific Time (4am IST).\r\n\r\n(i.e. His main focus will be the game changer part of his current website which will be the main part of new website. That is something like featured domains.)\"', '', NULL, '1', '2023-06-27', 1, 1500.00, 300.00, 1200.00, '2', NULL, 'Active', NULL, '2023-08-25 14:34:24', '2023-08-25 14:34:24'),
(155, 142, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'kingfisherllc.info', 'Saikat', 'Ayush', NULL, '\"Had a conversation with the client he wants an brand new website for his vegan Items. Here is the existing\r\nwebsite link - kingfisherllc.info, Client will speak with the AM Team around 3 pm EST 27/06/2023. Client\r\nwill fill the questionnaire till yet he just have the colour preference as bird as kingfisher.\"', '', NULL, '1', '2023-06-27', 1, 500.00, 100.00, 400.00, '2', NULL, 'Active', NULL, '2023-08-25 14:40:43', '2023-08-25 14:40:43'),
(156, 143, 'SEO and Website', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'https://virtualrealestatestaging.com/', 'Saikat', 'Sagar', NULL, 'Client has signed up us for 6 months SEO Promotion along with the website revamp. (https://virtualrealestatestaging.com/) Please also do the follow up as soon as possible to check his preference along with the questionnaire. AM team needs to call him around 12 our time today which is 28.6.2022', '', NULL, '1', '2023-06-28', 1, 1500.00, 226.00, 1274.00, '2', NULL, 'Active', NULL, '2023-08-25 14:43:03', '2023-08-25 14:43:03'),
(157, 144, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'john VEGA - CONSTRUCTION', 'Akash', 'SUMAN', NULL, 'He is into in construction business. He need a website for his construction business, total cost of the project his 550usd he upfront with us 250usd. AM team needs to call him tomorrow at 8am(pst) i;e 8:30pm(ist)', '', NULL, '1', '2023-06-28', 1, 550.00, 250.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 14:45:10', '2023-08-25 14:45:10'),
(158, 145, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'https://www.tech-master.com', 'Saikat', 'ANIKET', NULL, '\"Client has signed up for the website designing, here is the existing site- (https://www.tech-master.com/)\r\nClient paid $300 CAD Upront remaining payment once the work is done! Call back is been schedule tomorrow\r\n7.07.2023 around 11.30am EST with AM.\r\nClient needs to showcase his products also would like to receive quote on items.\"', '', NULL, '1', '2023-07-07', 1, 450.00, 225.00, 225.00, '2', NULL, 'Active', NULL, '2023-08-25 14:50:38', '2023-08-25 14:50:38'),
(159, 146, 'WEBSITE & MARKETING', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'dealsgrabbers1.com', 'Prodipto', 'Kamaljit singh', NULL, 'Client signed up for an affilate website with 2 months of marketing and we will give 1month of marketing complementary for our end.Total package cost is 1600 CAD.PM Team have to call 4.30pm est.Also, we need to help him in selecting the product.', '', NULL, '1', '2023-07-10', 1, 1204.00, 376.00, 828.00, '2', NULL, 'Active', NULL, '2023-08-25 14:53:22', '2023-08-25 14:53:22'),
(160, 147, 'Landing page', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'crumbdroppers.info', 'Prodipto', 'AMITAVO', NULL, 'Client signed up for a landing page for his business. He is into junk removal business. AM team needs to call him today at 4.30 CST, i.e, 3 AM IST.', '', NULL, '1', '2023-07-14', 1, 250.00, 130.00, 120.00, '2', NULL, 'Active', NULL, '2023-08-25 14:56:56', '2023-08-25 14:56:56');
INSERT INTO `sales` (`id`, `client_id`, `project_name`, `project_type`, `technology`, `type`, `others`, `marketing_plan`, `smo_on`, `start_date`, `end_date`, `platform_name`, `prefer_technology`, `description`, `business_name`, `closer_name`, `agent_name`, `reference_sites`, `remarks`, `customer_requerment`, `upsale_opportunities`, `isupsale`, `sale_date`, `currency`, `gross_amount`, `net_amount`, `due_amount`, `payment_mode`, `other_pay`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(161, 148, '2 Videos', 5, NULL, NULL, '2 Videos', '', '', NULL, NULL, NULL, NULL, NULL, 'http://661justice.com/', 'Akash', 'Sudhanshu', NULL, '\"Client is a partner client. Sign up for 2 video creation of minimum 30 Second Duration of each video. Video will be for,\r\n\r\n1. English language video for DetainerDefense.com 661-927-7268. Is your landlord a slumlord? Do you have water leaks, mold, broken HVAC, missing window screens, broken door locks, or other problems your landlord refuses to fix? Are you being evicted? Are you being harassed by your landlord? We may be able to help.\r\n\r\n2. Punjabi language video for Ravi from PunjabParalegal.com 661-379-5556. We provide document services for divorces, custody, support, eviction, restraining orders, guardianships, adoptions and more. If we can’t help with your legal needs, we can probably refer you to someone who can.\r\n\r\nClient told us to use our own wording. For 2 videos he sign up with $100 and rest $100 he will pay us at the time of delivery. His another mail id is victor@661justice.com. AM team will have to contact him as per clients convenience (Client did not provide a call back time yet.)\r\n\"', '', NULL, '1', '2023-07-17', 1, 200.00, 100.00, 100.00, '2', NULL, 'Active', NULL, '2023-08-25 14:59:22', '2023-08-25 14:59:22'),
(162, 149, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-07-17', '2024-07-17', NULL, NULL, NULL, 'fullthrottlebabies.com', 'Prodipto', 'Misc', NULL, 'Client signed up for social media marketing for her business. She is into baby care products. She wants brand awareness for her business. AM team needs to call her tomorrow at 6.30 PM EST, i.e, 4 AM IST.', '', NULL, '1', '2023-07-17', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 15:02:09', '2023-08-25 15:02:09'),
(163, 150, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-07-18', '2024-07-18', NULL, NULL, NULL, 'https://prajnaremedies.com/', 'Prodipto', 'SUMAN', NULL, 'Client signed up for social media marketing. we have engage more people into his website i;e (https://prajnaremedies.com/). AM team needs to call him tomorrow at 12 (mst) i;e 11:30pm(ist)', '', NULL, '1', '2023-07-18', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-25 15:09:41', '2023-08-25 15:09:41'),
(164, 151, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-07-18', '2024-07-25', NULL, NULL, NULL, 'SaltLakeCentralSeventhDayAdventistChurch.com', 'Akash', 'Aniket', NULL, 'Client sign up for his Non-profit organisation promotion and fundraising. We have to take care of facebook & instagram promotion. We have to generate donation for them and also they are planning for brodcasting we have to promote that as well. He will be starting that marketing from 1st of August. He just booked the services by now with $250 for month. AM team have to contact with him by tomorrow on 19.7.23 at 9am Pacific Time for an welcome call.', '', NULL, '1', '2023-07-18', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-25 15:13:09', '2023-08-25 15:13:09'),
(165, 152, 'DIGITAL MARKETING', 2, NULL, NULL, '', 'SEO', 'null', '2023-07-20', '2024-07-20', NULL, NULL, NULL, 'https://cryptostc.com/ and https://fhsac.com/', 'Prodipto', 'Amitavo', NULL, 'Client signed up for social media marketing and search engine optimization for 2 business. We need to bring more users to the https://cryptostc.com/. This is a platform where her brings content creators and youtubers and promotes his crypto through them. He also has https://fhsac.com/ this business where the seo is been set he just needs social media marketing for this. For cryptostc.com, he needs both seo and smo. The entire project cost is 900 USD and the client has paid 450 for 30 days. AM team needs to call him at 1 AM IST today.', '', NULL, '1', '2023-07-20', 1, 900.00, 450.00, 450.00, '2', NULL, 'Active', NULL, '2023-08-25 15:16:47', '2023-08-25 15:16:47'),
(166, 153, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-07-20', '2024-07-20', NULL, NULL, NULL, 'all4thewedding.com', 'Prodipto', 'Trambak', NULL, '\"Client signed up for social media marketing for his wedding directory. He wants more reach and more expansion to his business directory. AM team needs to call him on Tuesday, 25.07.23 at 2 PM EST.\r\n\"', '', NULL, '1', '2023-07-20', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-25 15:21:54', '2023-08-25 15:21:54'),
(167, 154, 'WEBSITE THEME CUSTOMIZATION', 4, NULL, NULL, 'WEBSITE THEME CUSTOMIZATION', '', '', NULL, NULL, NULL, NULL, NULL, 'https://yogatalk.com/', 'Akash', 'SUMAN', NULL, 'Client sign up for website re-designing. His website is https://yogatalk.com/. We have to design the website with a theme he will be providing. He is showcasing the yoga classes with Acuity plugin. We have to also integrate that into the theme. Project gross is $450 and sign up with $200. Client already spoke with Sudipto about the project. AM team have to call him at 12:45 IST.', '', NULL, '1', '2023-07-21', 1, 450.00, 200.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-25 15:24:33', '2023-08-25 15:24:33'),
(168, 155, 'Website changes', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'https://tilfordgulch.com/', 'Akash', 'Aniket', NULL, 'Client is already worked with us earlier. He want some changes in his website called https://tilfordgulch.com/. We have to replace the Book Camp Karolyn section from its current place to above the reservation option. Along with that he have a problem with the reservation form when anyone is fill out that mail is going to his trash not into his inbox. Along with that there is some other captcha problem he have mention. He is looking for the section changes by today itself. AM team have to contact with him at 1am IST.', '', NULL, '1', '2023-07-21', 1, 200.00, 200.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 15:27:43', '2023-08-25 15:27:43'),
(169, 156, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-07-21', '2024-07-23', NULL, NULL, NULL, 'The Little Red Hen Studios', 'Akash', 'Kamaljeet', NULL, 'Client is running a studio with 5 of his friends. They just started 2 months back. He signed up for marketing of their business. They are looking for brand engagement and getting business. For that we have to promote their Facebook, Instagram and YouTube. Client sign up for 1 month of marketing with $300. AM team have to contact with him on Monday 24.7.23 at 12 pacific time (12.30 IST). He already filled out the questionnaire link.', '', NULL, '1', '2023-07-21', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-25 15:30:41', '2023-08-25 15:30:41'),
(170, 157, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-07-24', '2024-07-25', NULL, NULL, NULL, 'https://www.ngdfw.com/', 'Saikat', 'ANIKET', NULL, 'Had a conversation with client regarding SMO for 1month he signed up for Facebook, Instagram, LinkedIn, and schedule a call back at 2 ist 24-07-2023 , he is having a business of furniture and his website is https://www.ngdfw.com/ he paid $200.', '', NULL, '1', '2023-07-24', 1, 200.00, 200.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-25 15:48:12', '2023-08-25 15:48:12'),
(171, 158, 'Landing Page', 4, NULL, NULL, 'Landing Page', '', '', NULL, NULL, NULL, NULL, NULL, 'itbiometrics.com', 'Prodipto', 'Shreyashri', NULL, 'Client signed up for a landing page for his insurance business. We have also discussed about the marketing for 1 month of social media marketing. After delivering the landing page he will start the marketing. AM team needs to follow up accordingly. Dev is already in touch with him.', '', NULL, '1', '2023-07-26', 1, 250.00, 150.00, 100.00, '2', NULL, 'Active', NULL, '2023-08-28 09:49:11', '2023-08-28 09:49:11'),
(172, 159, 'Website & Marketing', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'spiral-energy.com', 'Prodipto', 'Aniket', NULL, 'Client signed up for website and 2 months of social media marketing. He is into selling solar panels. We have to connect CRM to his website. He already has a logo which we have to edit a bit. AM team needs to call him at 7.30 AM Huwaii time, i.e,11 PM IST today, i.e, 28.7.23. Social Media Platforms mentioned are Facebook, Instagram and Linkedin.', '', NULL, '1', '2023-07-27', 1, 1200.00, 400.00, 800.00, '2', NULL, 'Active', NULL, '2023-08-28 09:51:46', '2023-08-28 09:51:46'),
(173, 160, 'Landing page and 1month of SMO', 4, NULL, NULL, 'Landing page and 1month of SMO', '', '', NULL, NULL, NULL, NULL, NULL, 'benefitshealth.com', 'Prodipto', 'Surajit', NULL, 'Client signed up for 1month of SMO and landing page. He is a insurance agent. He is in business for 30years. He provides both health and life insurance. He is looking for leads from California. AM team needs to call him at 2PM PST(2:30AM IST) today.', '', NULL, '1', '2023-07-28', 1, 800.00, 500.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-28 09:54:42', '2023-08-28 09:54:42'),
(174, 161, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\"]', '2023-07-31', '2024-07-31', NULL, NULL, NULL, 'depose.net', 'Prodipto', 'Anirban Bhattacharjee', NULL, 'Client signed up for social media marketing.He has a law firm also has real state business.He paid 300USD for 45days of SMO in Facebook,Instagram & Linkedin.Also We have to do some changes in his website.AM team needs to call him back tomorrow(01/08/2023) at 11am EST(8:30pm IST).', '', NULL, '1', '2023-07-31', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-28 09:57:39', '2023-08-28 09:57:39'),
(175, 162, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'macrosolutions.us', 'Saikat', 'Sreyashi', NULL, 'Client has signed up for website designing along with the server for 1 years and SSL, here is the reference site (https://numerodata.com/) call back schedule for the introduction with the AM\'s Team 3/8/2023 12 noon EST.', '', NULL, '1', '2023-08-02', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-28 10:00:59', '2023-08-28 10:00:59'),
(176, 163, 'Website Fixing', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'surveymarm.com', 'Akash', 'Surajit', NULL, 'Client signed up for Website fixing. we need to fix the website (https://surveymarm.com/). We have to make sure when client will click on the get start button on his website (https://surveymarm.com/) they will redirect to his link. We have to fix the bugs and glitches where they will not go forward to those third party websites (https://1wgafz.top/landing-fortune-wheel?&&). AM team needs to call him back tomorrow (3rd August) at 3PM PST (3:30AM IST).', '', NULL, '1', '2023-08-02', 1, 200.00, 200.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-28 10:04:23', '2023-08-28 10:04:23'),
(177, 164, 'DigiMix (SMO+SEO)', 2, NULL, NULL, '', 'SEO_SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-08-03', '2024-08-03', NULL, NULL, NULL, 'butcherpremier.com', 'Prodipto', 'Surajit', NULL, 'Client signed up for 30days of Social Media Marketing (Facebook, Instagram, Threads, & LinkedIn) and SEO . This is her Website (butcherpremier.com). Client is open for suggestions on her website if we feel some suggestions are required she is open for that. AM team needs to call her at 3:15PM EST (12:45AM IST) today.', '', NULL, '1', '2023-08-03', 1, 900.00, 450.00, 450.00, '2', NULL, 'Active', NULL, '2023-08-28 10:08:48', '2023-08-28 10:08:48'),
(178, 165, 'linkedln marketing', 2, NULL, NULL, '', 'SMO', '[\"Linkedin\"]', '2023-08-08', '2024-08-08', NULL, NULL, NULL, 'leasepermonth.com', 'Prodipto', 'Irfan Hussain', NULL, 'Client signed up for LinkedIn Marketing for 30days. He has a domain leasing business. This is his website(https://leasepermonth.com/).He has domains from specific areas so we have to target customers according to that. We have to build more connection in his LinkedIn Account. AM team needs to call him at 1:45AM IST today.', '', NULL, '1', '2023-08-08', 1, 400.00, 200.00, 200.00, '2', NULL, 'Active', NULL, '2023-08-28 10:12:12', '2023-08-28 10:12:12'),
(179, 166, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'obsinternational.com', 'Akash', 'Kamaljeet', NULL, 'Client is sign up for an affiliate website and logo. He is planning to sell daily essentials. He did not come up with the product. We will be helping him with the product suggestion and also we will help him for affiliate set up. We will help him with the business name suggestion as well. Website gross is $750 and $200 is the sign up amount. AM team have to call him at 12.30 Central Time (11 IST).', '', NULL, '1', '2023-08-09', 1, 750.00, 200.00, 550.00, '2', NULL, 'Active', NULL, '2023-08-28 10:15:17', '2023-08-28 10:15:17'),
(180, 167, 'YouTube Marketing', 2, NULL, NULL, '', 'SMO', '[\"Youtube\"]', '2023-08-11', '2024-08-11', NULL, NULL, NULL, 'robfarrow.net', 'Akash', 'Sudhansu', NULL, 'Client signed up for 3 months of YouTube Marketing, He provides CPA & Financial services. He has a YouTube Channel. We have to promote his channel. He has paid 700CAD(520.85 USD) for 3(three) months of YouTube Marketing. AM Team needs to call him at 3:30 PM PST (4:00 AM IST) today.', '', NULL, '1', '2023-08-11', 1, 1041.00, 520.00, 521.00, '2', NULL, 'Active', NULL, '2023-08-28 10:18:37', '2023-08-28 10:18:37'),
(181, 168, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-08-14', '2024-08-14', NULL, NULL, NULL, 'bottle4hope.com', 'Prodipto', 'Samiran', NULL, 'Client\'s sister is a piano teacher. Client is a partner client. She has just shifted with the client so she wants new student for her piano class. She is planning to do a open house so we have to give her footfalls for the open house. They will be running the ads as well. The ad budget has not been decided. We can provide the ad budget to them. AM team needs to call him at 10.45PM IST today.', '', NULL, '1', '2023-08-14', 1, 594.00, 297.00, 297.00, '2', NULL, 'Active', NULL, '2023-08-28 10:21:37', '2023-08-28 10:21:37'),
(182, 169, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-08-14', '2024-08-14', NULL, NULL, NULL, 'greater-minds.com', 'Saikat', 'ANIKET', NULL, 'client signed up for 1 month of SMO (FB, INSTAGRAM, INSTAGRAM THREAD, LINKEDin) paid $250 . AM need to call him on WEDNESDAY 16th August evening time EST', '', NULL, '1', '2023-08-14', 1, 250.00, 250.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-28 10:24:51', '2023-08-28 10:24:51'),
(183, 170, 'DigiMix(SMO+SEO)+Website Optimization', 2, NULL, NULL, '', 'SEO_SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-08-14', '2024-08-14', NULL, NULL, NULL, 'faulknerwalshdesigns.com', 'Prodipto', 'Surajit', NULL, 'Client signed up for SMO and SEO for her business , we also have to optimize her website. This is her website (https://faulknerwalshdesigns.com/). Total project cost will be 600USD for 2 months of SMO and SEO. She Signed up with 300USD and she will pay rest of the 300USD next month. AM team needs to call her today at 5:35M IST.', '', NULL, '1', '2023-08-14', 1, 600.00, 300.00, 300.00, '2', NULL, 'Active', NULL, '2023-08-28 10:28:17', '2023-08-28 10:28:17'),
(184, 171, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'almudenakonrad.com', 'Akash', 'Tanmoy Pramanick', NULL, 'Client is an author and sign up for a website where she wants to sell her books. Currently she have only 2 Books. Website will have payment gateway feature. Client sent a reference website https://davidgoggins.com/. Website price is $550 and client sign up with $150. AM team need to follow up with her at 11.30 Pacific Time (12 IST).', '', NULL, '1', '2023-08-16', 1, 550.00, 150.00, 400.00, '2', NULL, 'Active', NULL, '2023-08-28 10:30:53', '2023-08-28 10:30:53'),
(185, 172, 'Google Reviews', 2, NULL, NULL, '', 'Google Ads', 'null', '2023-08-17', '2024-08-17', NULL, NULL, NULL, 'athenskratom.com', 'Saikat', 'Irfan Hussain', NULL, '\"client has signed up for 300 google reviews on his google profile page paid $250 and remaining $250 will be getting paid after 150 reviews, \r\n\r\n\r\nclient\'s requirement:- \r\n\r\nI just need you to post the 5 star reviews I will provide you, and then need them put on the listing (we have 4 listings) that I specify. That\'s it and that\'s all I need done. But I need them to:\r\n\r\n1) The accounts need nicknames or American Names. I don\'t want reviews from Lo Duck Wong, or Muhammad Fazrika. I need reviews from names like Shawn, Wendy, Bill, Harry, Jason, Tina, Frank etc.....\r\n2) I do not want all the reviews going up overnight or even a couple of days. I think it\'s reasonable from SEO experience that this project should take about 30 days to complete. That\'s posting 10 reviews at the location I specify everyday\"', '', NULL, '1', '2023-08-17', 1, 500.00, 250.00, 250.00, '2', NULL, 'Active', NULL, '2023-08-28 10:34:19', '2023-08-28 10:34:19'),
(186, 173, 'SSL Certification for 2 Years', 8, NULL, NULL, '', '', '', '2023-08-16', '2025-08-16', NULL, NULL, NULL, 'uniflexcircuits.com', 'Prodipto', 'Misc', NULL, 'Client signed up for renewing the SSL Certification for 2 years of his website. His website is uniflexcircuits.com. Please do it ASAP', '', NULL, '1', '2023-08-16', 1, 300.00, 300.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-28 10:36:58', '2023-08-28 10:36:58'),
(187, 174, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'Innoaigen.technology', 'Saikat', 'Irfan Hussain', NULL, 'client has sign up for a website designing. paid 300 remaining 450 will be getting paid after the work is done {its a partner client wants in PHP just like digital webber}', '', NULL, '1', '2023-08-16', 1, 750.00, 300.00, 450.00, '2', NULL, 'Active', NULL, '2023-08-28 10:40:11', '2023-08-28 10:40:11'),
(188, 175, 'SMO', 2, NULL, NULL, '', 'SMO', '[\"Facebook\",\"Instagram\",\"Twitter\",\"Youtube\",\"Linkedin\"]', '2023-08-18', '2024-08-18', NULL, NULL, NULL, 'itsultant.com', 'Prodipto', 'Abhay Bhanja', NULL, 'Client signed up for Social Media Marketing for 30 days.He provide consultancy services and he is looking for lead generation for his business and we have to do marketing on Facebook,Instagram,linkedin and Google.AM team needs to call him today(18/8/23) 6pm EST i.e 3:30am IST', '', NULL, '1', '2023-08-18', 1, 700.00, 350.00, 350.00, '2', NULL, 'Active', NULL, '2023-08-28 10:43:44', '2023-08-28 10:43:44'),
(189, 176, '20 Graphics Design', 5, NULL, NULL, '20 Graphics Design', '', '', NULL, NULL, NULL, NULL, NULL, 'itsacheerthing.net', 'Akash', 'MISC', NULL, 'Client is running a t-shirt business. She is looking for graphics design for her t-shirt business. We have to design 20 graphics for her. For design she will send us the colour requirement and ideas and contents. Designs will be specially for girls and related to cheer-leading. She has more design work in her pipeline after that. She paid $170 for the work. AM team have to call her at 5.15pm Eastern Time (2.45 IST)', '', NULL, '1', '2023-08-22', 1, 170.00, 170.00, 0.00, '2', NULL, 'Active', NULL, '2023-08-28 10:46:38', '2023-08-28 10:46:38'),
(190, 177, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'www.uberwholesaler.com', 'Akash', 'Suvendu', NULL, 'He is a wholesaler of a energy drink company. Client sign up for a E-commerce website for that. His current website is https://uberwholesaler.com/. Project cost US$2000 and upfront amount US$500. AM team needs to call him tomorrow 16.2.23 at 10 AM EST (8.30 IST).', '', NULL, '1', '2023-02-15', 1, 2000.00, 500.00, 1500.00, '2', NULL, 'Active', NULL, '2023-08-28 10:49:43', '2023-08-28 10:49:43'),
(191, 178, 'WEBSITE', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'omgistic.com', 'Prodipto', 'Surajit', NULL, 'Client signed up for a website. He wants two parts in the website , one is regarding construction and another one is excavation. Client has shown a website (www.hrparts.com) as reference. we have to create a website with the same look and feel or better than that. AM team needs to call him back after 45mins at 3:40AM IST today (28/01/2023).', '', NULL, '1', '2023-01-27', 1, 1000.00, 200.00, 800.00, '2', NULL, 'Active', NULL, '2023-08-28 10:52:40', '2023-08-28 10:52:40'),
(192, 4, 'ggfj', 1, '3', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'ghhjl', 'lhljkl', 'hvjlhlj', NULL, 'lhll', '', NULL, '1', '2023-12-14', 1, 544.00, 23.00, 521.00, '2', NULL, 'Active', NULL, '2023-12-07 03:35:20', '2023-12-07 03:35:20'),
(193, 4, 'Garrison Heath', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'jhjk', 'fhkjhjk', 'jkhhkfj', 'Illo quis exercitati', 'kfjh', '', NULL, '1', '2023-12-01', 2, 10.00, 10.00, 0.00, '2', NULL, 'Active', NULL, '2023-12-07 23:24:38', '2023-12-07 23:24:38'),
(194, 1, 'Garrison Heath', 1, '3', '5', '', '', '', NULL, NULL, NULL, NULL, NULL, 'ghhjl', 'bvvb', 'ghg', 'g kjk', 'gjkg k', 'Magnam fugiat asper', 'Cupidatat in facilis', '1', '1970-01-01', 1, 100.00, 100.00, 0.00, '2', NULL, 'Active', NULL, '2023-12-13 04:14:32', '2023-12-13 04:14:32'),
(195, 188, 'Ecommece Laravel Project', 1, '3', '4', '', '', '', NULL, NULL, NULL, NULL, NULL, 'Online Store', 'new closer', 'new agent', NULL, 'new task', '', NULL, '1', '2023-01-01', 1, 500.00, 500.00, 0.00, '2', NULL, 'Active', NULL, '2023-12-21 03:46:56', '2023-12-21 03:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) UNSIGNED NOT NULL,
  `assign_to` int(10) UNSIGNED NOT NULL,
  `assign_by` int(10) NOT NULL,
  `assign_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `sale_id`, `assign_to`, `assign_by`, `assign_date`, `created_at`, `updated_at`) VALUES
(1, 16, 7, 3, '2023-07-18', '2023-07-18 07:13:37', '2023-07-20 06:29:30'),
(3, 4, 7, 3, '2023-07-18', '2023-07-18 07:17:36', '2023-07-20 06:29:33'),
(4, 15, 7, 3, '2023-07-18', '2023-07-18 08:58:42', '2023-07-20 06:29:36'),
(5, 13, 6, 2, '2023-07-18', '2023-07-18 09:17:18', '2023-07-17 22:17:18'),
(6, 11, 7, 3, '2023-07-20', '2023-07-20 06:15:15', '2023-07-20 00:45:15'),
(7, 20, 6, 1, '2023-07-26', '2023-07-26 09:36:50', '2023-07-26 04:06:50'),
(8, 72, 6, 1, '2023-12-08', '2023-12-08 11:10:21', '2023-12-08 05:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `upsales`
--

CREATE TABLE `upsales` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `upsale_type` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `others` text NOT NULL,
  `gross_amount` double(10,2) NOT NULL,
  `net_amount` double(10,2) NOT NULL,
  `payment_mode` int(11) NOT NULL,
  `other_payment_mode` varchar(250) NOT NULL,
  `sale_date` date NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upsales`
--

INSERT INTO `upsales` (`id`, `client_id`, `sale_id`, `upsale_type`, `start_date`, `end_date`, `others`, `gross_amount`, `net_amount`, `payment_mode`, `other_payment_mode`, `sale_date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 4, NULL, NULL, 'Others requirement', 200.00, 100.00, 2, '', '2023-01-04', NULL, '2023-01-04 06:43:24', '2023-07-20 07:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(200) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` enum('1','2','3','4','5','6','7') NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `connection_id` int(11) NOT NULL,
  `user_status` enum('Offline','Online') NOT NULL,
  `user_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile_no`, `email_verified_at`, `password`, `role_id`, `is_active`, `remember_token`, `created_at`, `updated_at`, `token`, `connection_id`, `user_status`, `user_image`) VALUES
(1, 'Webart Technology (Owner)', 'admin@gmail.com', '9632587410', NULL, '$2y$10$5dIsrq7GWMXmseeDyOhxKu.xBqCJ209zXDvTNGAeweitc9aNjX3R2', '1', 1, 'pPLjdnE00aEpQYsZ7V1k92gMHwvhbZvFYjCtRIJkEE7V92PGjuaHtKE6W2xq', '2023-01-02 01:21:46', '2023-12-21 06:25:15', 'e69c979feac59f3d3205cf3757b40494', 751, 'Online', ''),
(3, 'Sales', 'sales@gmail.com', NULL, NULL, '$2y$10$5dIsrq7GWMXmseeDyOhxKu.xBqCJ209zXDvTNGAeweitc9aNjX3R2', '2', 1, NULL, '2023-01-02 01:21:46', '2023-07-17 06:52:31', '', 0, 'Offline', ''),
(6, 'Pritam sen', 'pritam@webart.technology', '9088850821', NULL, '$2y$10$FsyHj77Dy9bDFxd1YrrTQOHB2lRwTji3j57fYLTdB8zBEeuXYvrTu', '3', 1, NULL, '2023-07-17 06:08:27', '2023-12-08 04:25:24', '', 0, 'Offline', ''),
(7, 'Sankar Bera', 'sankar@webart.technology', '9874300364', NULL, '$2y$10$S2cSAhmsPuiqYYyeCfoTveO2Ukg1s1HtR46AzlQjS3oMLco6sejGW', '4', 1, NULL, '2023-07-17 06:19:20', '2023-07-17 06:52:55', '', 0, 'Offline', ''),
(8, 'Deepak Kumar', 'deepak@gmail.com', '9874300364', NULL, '$2y$10$yBON9Myfhw3Roa.Mtg9D8eWhX8gl13pRKRr7aFq9le98IrnKPM6.i', '6', 1, NULL, '2023-07-31 01:47:44', '2023-12-21 06:17:44', '0a6e12cff842175f4ec3aead2b3b12b5', 0, 'Offline', ''),
(9, 'Sudip Ghosh', 'sudip@webart.technology', '9874300364', NULL, '$2y$10$F3ZGJ/YjEyWn.487e0r.heMAbwiaja4RjsuRgEKT97xnfVL/o9lW2', '5', 1, NULL, '2023-08-01 03:43:55', '2023-08-01 03:43:55', '', 0, 'Offline', ''),
(10, 'Sohom Bhattacharjee', 'sohom@webart.technology', '8956656897', NULL, '$2y$10$XjCUbHto/5Wi0cPQjl7ZGuLRKtpGmF6BU9gvhPiHpFkYTSFP4SYVy', '7', 1, NULL, '2023-08-07 03:41:47', '2023-08-07 03:41:47', '', 0, 'Offline', ''),
(11, 'Sudipto Chakraborty', 'sudipto@digitalwebber.com', '7003238056', NULL, '$2y$10$SEg1c4XgkGGmu/YC/Q0sD.K1nb69Ilk.UluNJpMfGFa61zi0A7YcS', '2', 1, NULL, '2023-08-14 21:13:56', '2023-08-14 21:13:56', '', 0, 'Offline', ''),
(12, 'Test Project Manager', 'test@yopmail.com', '1234567890', NULL, '$2y$10$nQh0.JKoOqdI9C7F6uz5IuTAeprBU.BXKLnIVVib/55w8VyvWzjGK', '6', 1, NULL, '2023-08-14 22:25:23', '2023-12-08 04:30:57', '', 0, 'Offline', ''),
(14, 'Test user', 'test@mail.com', '0123456789', NULL, '$2y$10$nrMLwmRecT5TdYQbPXvV8.cUvn6I7LcX3cw862XRpYCc3gI2.Mlki', '6', 1, NULL, '2023-12-08 04:32:19', '2023-12-21 06:42:57', 'd313d1feee4eddab3141cbdd7befdfe8', 0, 'Offline', ''),
(15, 'Safikul Islam', 'safikul@gmail.com', '0123456789', NULL, '$2y$10$nrMLwmRecT5TdYQbPXvV8.cUvn6I7LcX3cw862XRpYCc3gI2.Mlki', '6', 1, NULL, '2023-12-11 06:28:26', '2023-12-21 07:02:38', '1ccc4e40b51ddf39efc61d11b32fe5c9', 0, 'Offline', ''),
(16, 'Sandy', 'sandy@yopmail.com', '0123456789', NULL, '$2y$10$/58YlEhNAK/cG4o.Gff/C.4gtYkB0hFyca2jYJtr6PdNXwVHZARKy', '2', 1, NULL, '2023-12-18 04:54:47', '2023-12-18 04:54:47', '', 0, 'Offline', '');

-- --------------------------------------------------------

--
-- Table structure for table `workhistories`
--

CREATE TABLE `workhistories` (
  `id` int(11) NOT NULL,
  `developer_job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `final_status` varchar(100) NOT NULL,
  `currenttime` time NOT NULL,
  `delayThen` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workhistories`
--

INSERT INTO `workhistories` (`id`, `developer_job_id`, `user_id`, `final_status`, `currenttime`, `delayThen`, `created_at`, `updated_at`) VALUES
(1, 2, 15, 'stop', '00:00:00', 0, '2023-12-21 09:35:39', '2023-12-21 04:06:12'),
(2, 2, 15, 'stop', '00:00:05', 0, '2023-12-21 09:35:47', '2023-12-21 04:06:12'),
(3, 2, 15, 'stop', '00:00:08', 0, '2023-12-21 09:35:52', '2023-12-21 04:06:12'),
(4, 2, 15, 'stop', '00:00:08', 0, '2023-12-21 09:36:00', '2023-12-21 04:06:12'),
(5, 2, 15, 'stop', '00:00:16', 0, '2023-12-21 09:36:10', '2023-12-21 04:06:12'),
(6, 17, 15, 'start', '00:00:00', 0, '2023-12-21 09:36:12', '2023-12-21 04:06:12'),
(7, 2, 15, 'stop', '00:00:19', 0, '2023-12-21 09:36:12', '2023-12-21 04:06:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agents_email_unique` (`email`);

--
-- Indexes for table `assign_logs`
--
ALTER TABLE `assign_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `closers`
--
ALTER TABLE `closers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `closers_email_unique` (`email`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `developer_jobs`
--
ALTER TABLE `developer_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_members_group_id_foreign` (`group_id`);

--
-- Indexes for table `group_names`
--
ALTER TABLE `group_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_histories`
--
ALTER TABLE `log_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `assign_to` (`assign_to`);

--
-- Indexes for table `upsales`
--
ALTER TABLE `upsales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `workhistories`
--
ALTER TABLE `workhistories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assign_logs`
--
ALTER TABLE `assign_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `closers`
--
ALTER TABLE `closers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `developer_jobs`
--
ALTER TABLE `developer_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `group_names`
--
ALTER TABLE `group_names`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log_histories`
--
ALTER TABLE `log_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `upsales`
--
ALTER TABLE `upsales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `workhistories`
--
ALTER TABLE `workhistories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `group_names` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `assign_to` FOREIGN KEY (`assign_to`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sale_id` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
