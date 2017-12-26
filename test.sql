-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 24, 2017 at 08:10 AM
-- Server version: 5.7.18
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'moody', 'moody@moody.moody', 'gfldgnlsglkdgkdg', '2017-10-16 17:18:19'),
(2, 'moody', 'moody@moody.moody', 'gfldgnlsglkdgkdg\r\nhghjghjgjg', '2017-10-16 17:19:16'),
(3, 'hgfhg', 'ghgf@gdfgf.hdhdf', 'fgjhnvbnjfujfvjvjvjfujf', '2017-10-16 17:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `postid` int(10) UNSIGNED NOT NULL,
  `imageurl` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `bio` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `bio`, `content`, `updated_at`, `created_at`) VALUES
(11, 'Supply Chain Attacks and Secure Software Updates', 'I generally don\'t like writing about current events, because the inherent ephemeral nature of the news means that your words become less meaningful with each passing day. As a professional, I find wasting other people\'s time in poor taste.\r\n\r\nHowever, the topic of supply chain attacks has come up repeatedly in the recent months, so I\'d like to take a moment to reflect on these incidents, as well as the work I\'ve done through Paragon Initiative Enterprises (PIE for short) to be able to solve this problem at scale.', '<div class=\"blog-post-body\" style=\"box-sizing: border-box; color: #171717; border-color: #cccccc; border-style: solid; border-width: 1px 0px; font-family: \'Open Sans\', sans-serif; font-size: 16px; background-color: #fefefe;\">\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">I generally don\'t like writing about current events, because the inherent ephemeral nature of the news means that your words become less meaningful with each passing day. As a professional, I find wasting other people\'s time in poor taste.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">However, the topic of supply chain attacks has come up repeatedly in the recent months, so I\'d like to take a moment to reflect on these incidents, as well as the work I\'ve done through Paragon Initiative Enterprises (PIE for short) to be able to solve this problem at scale.</p>\r\n<span id=\"after-fold\" style=\"box-sizing: border-box;\"></span>\r\n<h2 style=\"box-sizing: border-box; font-family: Play, serif; font-weight: 500; line-height: 1.1; color: #0088cc; margin-top: -55px; margin-bottom: 0.2rem; font-size: 26px; padding-top: 70px; padding-bottom: 0px;\">What\'s a Supply Chain Attack?</h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">In general, a supply chain attack involves first hacking a trusted third party who provides a product or service to your target, and then using your newly acquired, privileged position to compromise your intended target.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">More narrowly, we\'re only interested in supply chain attacks which involve compromising the companies that produce software used by other companies. Hardware based supply chain attacks have been demonstrated by leaked documents concerning nation state actors.</p>\r\n<h2 style=\"box-sizing: border-box; font-family: Play, serif; font-weight: 500; line-height: 1.1; color: #0088cc; margin-top: -55px; margin-bottom: 0.2rem; font-size: 26px; padding-top: 70px; padding-bottom: 0px;\">A Recent History of Supply Chain Attacks</h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">Rather than rehash the long history of supply-chain attacks (both theoretical and actual) and the motivation for virtually every Linux distro to PGP-sign their update information, let\'s just look at what\'s happened in the year 2017.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">The industry\'s first wake-up call in recent months was a ransomware called NotPetya that was spread throughout Ukraine through&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://www.cyberscoop.com/petya-ransomware-medoc-hacked-auto-update/\">the auto-update mechanism for&nbsp;<em style=\"box-sizing: border-box;\">M.E.Doc</em>, one of the few government-approved accounting softwares</a>.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">Last month, Kaspersky Lab\'s research teams published a write-up about a&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://www.kaspersky.com/about/press-releases/2017_shadowpad-how-attackers-hide-backdoor-in-software-used-by-hundreds-of-large-companies-around-the-world\">malware campaign called ShadowPad</a>, which infected a software update for an unspecified product by a company called&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://www.netsarang.com/\">NetSarang</a>. The product in question is reportedly used by hundreds of large firms, especially in the energy sector, so the long-term impact of such an infection (if undetected) is best left to the imagination.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">Most recently, but certainly not finally, we learned that the most recent updates for a common Windows utility called&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://techcrunch.com/2017/09/21/ccleaner-supply-chain-malware-targeted-tech-giants/\">CCleaner had also been infected with malware</a>.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: inherit; font-weight: 500; line-height: 1.1; color: #000000; margin-top: -55px; margin-bottom: 0.2rem; font-size: 20px; padding-top: 70px; padding-bottom: 0px;\">The Common Denominator in Recent Supply-Chain Attacks</h3>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">In each of these recent cases, malicious actors had compromised a software company and infected the \"legitimate\" copy of the software that users would download and install.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">In some of these cases, an automatic update mechanism was used to deliver the payloads. However, it is erroneous to call out auto-update features as the reason for infection. If a malicious and signed binary was uploaded to a company website, the fact that updates have to be performed manually would not have helped the victims. They would just happily install it, none the wiser.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">In all of these cases, the malicious software update was spread to everyone who installed it, rather than a targeted attack against only networks of interest. I\'d wager that there are some of these going on in the wild as I type this, but they\'re inherently much more difficult to detect.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">The real security problem here has very little to do with automation.</p>\r\n<h2 style=\"box-sizing: border-box; font-family: Play, serif; font-weight: 500; line-height: 1.1; color: #0088cc; margin-top: -55px; margin-bottom: 0.2rem; font-size: 26px; padding-top: 70px; padding-bottom: 0px;\">The Fundamental Problem with Software Update Security</h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">The reason that supply chain attacks are viable, effective, and often difficult to detect is that&nbsp;<em style=\"box-sizing: border-box;\">very little</em>&nbsp;(if any) industry attention is given towards guaranteeing&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://defuse.ca/triangle-of-secure-code-delivery.htm\">Software Authenticity</a>.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">This is a topic we have covered extensively:</p>\r\n<ul style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; list-style-position: inside; list-style-image: initial; padding-left: 24px;\">\r\n<li style=\"box-sizing: border-box;\"><a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://paragonie.com/blog/2017/08/quick-guide-simple-and-secure-automatic-updates\">Quick and dirty guide to secure automatic updates</a>&nbsp;(August 2017)</li>\r\n<li style=\"box-sizing: border-box;\"><a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://paragonie.com/blog/2016/10/guide-automatic-security-updates-for-php-developers\">A technical tutorial on the ins and outs of automatic update implementations for PHP developers</a>&nbsp;(October 2016)</li>\r\n<li style=\"box-sizing: border-box;\"><a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://paragonie.com/blog/2016/05/keyggdrasil-continuum-cryptography-powering-cms-airship\">A detailed write-up of the implementation in our Free Software content management system, CMS Airship</a>&nbsp;(May 2016)</li>\r\n<li style=\"box-sizing: border-box;\"><a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://paragonie.com/blog/2015/04/introducing-asgard-authentic-software-guard\">Our very first blog post introduced&nbsp;<em style=\"box-sizing: border-box;\">Asgard</em>, our first attempt to solve this problem for the PHP community</a>&nbsp;(April 2015)</li>\r\n</ul>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">If you read only one of the above links, read the one from August 2017.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">Our company has done a lot of work between client engagements to make it easier for developers to make their software updates&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">signed</span>,&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">auditable</span>, and&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">reproducible</span>. This does several things:</p>\r\n<ol style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px;\">\r\n<li style=\"box-sizing: border-box;\"><span style=\"box-sizing: border-box; font-weight: bold;\">Signed:</span>&nbsp;If the signing key is kept offline, even if the webserver or update server is compromised, the malware will not be accepted by the end user\'s computer. This is a nontrivial impediment to supply chain attacks, provided the company in question has adequate discipline to keep their signing key secret.</li>\r\n<li style=\"box-sizing: border-box;\"><span style=\"box-sizing: border-box; font-weight: bold;\">Auditable:</span>&nbsp;Even with a pilfered signing key, with this guarantee in place, attacks will be unavoidably detectable due to each update being committed to an append-only data structure (e.g. a Merkle tree or hash chain). This also ensures that everyone gets the same update and prevents targeted attacks (which, as mentioned above, haven\'t yet been detected, but cannot be ruled out).</li>\r\n<li style=\"box-sizing: border-box;\"><span style=\"box-sizing: border-box; font-weight: bold;\">Reproducible:</span>&nbsp;With open source software and reproducible builds, users can verify that the binary they received corresponds to the expected version of the software they intended to install. Combined with the auditability guarantee, if even one power user or security expert inspects the source code for backdoors, that\'s sufficient to ensure that all other copies of the same update are authentic.</li>\r\n</ol>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">If all three guarantees are provided, it\'s even&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://paragonie.com/blog/2016/10/guide-automatic-security-updates-for-php-developers#why-automatic-updates\">generally safer to deploy your updates automatically</a>(by default; power users should be allowed to disable this mechanism).</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">Furthermore, because of these guarantees, most attackers will be dis-incentivized to even attempt such an attack: The success of their campaign hinges on their ability to steal a cryptography key, they can\'t target networks or persons of interest, the likelihood of being caught very early is extraordinarily high.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">If we can make all software updates come with authenticity guarantees, I believe we will all-but-eliminate supply chain attacks in the real world.</p>\r\n<h2 style=\"box-sizing: border-box; font-family: Play, serif; font-weight: 500; line-height: 1.1; color: #0088cc; margin-top: -55px; margin-bottom: 0.2rem; font-size: 26px; padding-top: 70px; padding-bottom: 0px;\">Does This Really Matter?</h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">We\'ve consistently focused on the problem of ensuring software updates are secure enough to automate since our company\'s inception.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">We strongly believe that solving this problem at scale will have a more profound impact on the security of the Internet than&nbsp;<em style=\"box-sizing: border-box;\">almost any other problem in all of information security and applied cryptography</em>.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: inherit; font-weight: 500; line-height: 1.1; color: #000000; margin-top: -55px; margin-bottom: 0.2rem; font-size: 20px; padding-top: 70px; padding-bottom: 0px;\">\"Wait, I Think I Can Solve This Using [Buzzword]\"</h3>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">If you\'re looking for a killer app cybersecurity solution to these sort of attacks, the answer involves a lot of inglorious janitorial work&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://meta.stackoverflow.com/questions/293930/problematic-php-cryptography-advice-in-popular-questions\">cleaning up the software ecosystem</a>&nbsp;and&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://github.com/composer/packagist/issues/797\">assisting open source software projects</a>&nbsp;to get on board with scalable and trustworthy solutions.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">This is&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://paragonie.com/blog/2017/07/chronicle-will-make-you-question-need-for-blockchain-technology\">not a problem that necessarily needs a blockchain</a>&nbsp;to solve.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">It\'s not a problem that traditional endpoint security (read: anti-virus software) is even in the correct&nbsp;<em style=\"box-sizing: border-box;\">genre</em>&nbsp;to a solution.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">No, we\'re going to need to solve this as a community, not an industry. That means a lot of dedicated security experts and developers working together. That means a lot of short-term developer hours expended to improve the long-term health of your companies.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">I fully anticipate that&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"http://attrition.org/errata/charlatan/\">charlatans and snake-oil salesmen</a>&nbsp;will come out of the woodwork to pitch their poorly thought-out solutions to supply chain attacks as increasing number of computer criminals find them to be an effective way to infect victims. Even more hours will likely be expended on debunking their fraudulent claims and alerting the uninformed of their deception.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">But in the end? If we, as a community&mdash;as a society&mdash;can work together to solve the problem of secure software updates for the Internet at large? It will all be worth it.</p>\r\n<p>&nbsp;</p>\r\n</div>', '2017-10-15 23:32:58', '2017-10-15 23:32:58'),
(12, 'The Quick Guide to Simple and Secure Automatic Updates', 'Should your software update itself automatically? YES!\r\n\r\nIf you aren\'t convinced, we\'ve previously made the case for automatic software updates as a means of preventing yesterday\'s software vulnerabilities from being exploited today.\r\n\r\nHowever, as our previous article on the subject notes, implementing automatic software updates requires a nontrivial amount of engineering effort in order to be secure.\r\n\r\nOur company has been hard at work for the past few years to diminish the effort required to achieve secure automatic software updates in the PHP community. Most of our efforts are reproducible and/or relevant to any other programming stack, although PHP remains the first major programming language to decide to adopt modern cryptography in its standard library.\r\n\r\nLet\'s explore how to use our existing work to build a secure automatic software update system, without having to do any of the heavy lifting.', '<div class=\"blog-post-body\" style=\"box-sizing: border-box; color: #171717; border-color: #cccccc; border-style: solid; border-width: 1px 0px; font-family: \'Open Sans\', sans-serif; font-size: 16px; background-color: #fefefe;\">\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">Should your software update itself automatically?&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">YES!</span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">If you aren\'t convinced, we\'ve previously&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://paragonie.com/blog/2016/10/guide-automatic-security-updates-for-php-developers#why-automatic-updates\">made the case for automatic software updates</a>&nbsp;as a means of preventing yesterday\'s software vulnerabilities from being exploited today.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">However, as&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://paragonie.com/blog/2016/10/guide-automatic-security-updates-for-php-developers#outdated-software-risk\">our previous article on the subject</a>&nbsp;notes, implementing automatic software updates requires a nontrivial amount of engineering effort in order to be secure.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">Our company has been hard at work for the past few years to diminish the effort required to achieve&nbsp;<em style=\"box-sizing: border-box;\">secure automatic software updates</em>&nbsp;in the PHP community. Most of our efforts are reproducible and/or relevant to any other programming stack, although&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://dev.to/paragonie/php-72-the-first-programming-language-to-add-modern-cryptography-to-its-standard-library\">PHP remains the first major programming language to decide to adopt modern cryptography in its standard library</a>.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">Let\'s explore how to use our existing work to build a secure automatic software update system, without having to do any of the heavy lifting.</p>\r\n<span id=\"after-fold\" style=\"box-sizing: border-box;\"></span>\r\n<h1 style=\"box-sizing: border-box; margin: -55px 0px 0.2rem; font-size: 28px; font-family: Play, serif; font-weight: 500; line-height: 1.1; color: #000000; padding-top: 70px; padding-bottom: 0px;\">Simple and Secure Automatic Software Updates</h1>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">&nbsp;</p>\r\n<h2 id=\"how-to-implement\" style=\"box-sizing: border-box; font-family: Play, serif; font-weight: 500; line-height: 1.1; color: #0088cc; margin-top: -55px; margin-bottom: 0.2rem; font-size: 26px; padding-top: 70px; padding-bottom: 0px;\">How to Implement Secure Automatic Updates, the Easy Way</h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">First, make sure your deliverables are&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://reproducible-builds.org/\">reproducible from the source code</a>. If you\'re working with scripting languages that are never compiled into binary code, this merely requires your software be open source.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">Second, use an update framework (i.e&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://theupdateframework.github.io/\">The Update Framework</a>) that enforces code signing. This means that your update files must be signed by a private key controlled only by you, but can be verified by anyone with your public key.</p>\r\n<blockquote style=\"box-sizing: border-box; padding: 10px 20px; margin: 0px 0px 20px; font-size: 17.5px; border-left: 5px solid #eeeeee;\">\r\n<p style=\"box-sizing: border-box; margin: 0px;\">If you don\'t understand what \"private key\" or \"public key\" means,&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://paragonie.com/blog/2015/08/you-wouldnt-base64-a-password-cryptography-decoded\">this page</a>&nbsp;is an approachable introduction to cryptography terms and concepts and will shed some light on the matter.</p>\r\n</blockquote>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">Finally, run a&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://paragonie.com/blog/2017/07/chronicle-will-make-you-question-need-for-blockchain-technology\">Chronicle</a>&nbsp;instance. Every time you release an update, publish the new release information to your Chronicle. Make your code that interfaces with The Update Framework verify that the release you\'re seeing is also published in the Chronicle (or, especially for enterprise customers, their own replica of your Chronicle that resides on the corporate network).</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">That\'s it.&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">The Update Framework</span>&nbsp;(or a similar implementation relevant to your stack) and&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Chronicle</span>are all you need (as far as tooling goes). Make your software open source, and your builds reproducible, and you\'ll drastically reduce your customer\'s attack surface in terms of both space&nbsp;<em style=\"box-sizing: border-box;\">and</em>time.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">&nbsp;</p>\r\n<h2 id=\"php-secure-updates\" style=\"box-sizing: border-box; font-family: Play, serif; font-weight: 500; line-height: 1.1; color: #0088cc; margin-top: -55px; margin-bottom: 0.2rem; font-size: 26px; padding-top: 70px; padding-bottom: 0px;\">Secure Automatic Software Updates in PHP</h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">There isn\'t currently a PHP implementation of The Update Framework. If there\'s enough community interest, we may commit to building one in the future. However, that might not be necessary.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">If you\'re developing modern PHP, you\'re almost certainly using Composer and Packagist. If not, it\'s&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"http://www.phptherightway.com/#composer_and_packagist\">highly recommended that you learn it ASAP</a>.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">Earlier this year, I opened a proposal to the&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://github.com/composer/packagist/issues/797\">Packagist team</a>&nbsp;to run their own Chronicle instance, which would be used to publish information about software releases in real time. We\'re working on other proposals to enforce signature validation and solve the Public Key Infrastructure (PKI) problems.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">In other words: If you\'re using Composer, then in the near future this may already be a solved problem for you.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">If you cannot wait for our work to be accepted and deployed in Composer, you\'ll have to either roll your own implementation or&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://paragonie.com/services\">hire Paragon Initiative Enterprises</a>&nbsp;to build it for you. We\'ve previously implemented secure automatic updates in&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://paragonie.com/blog/2016/05/keyggdrasil-continuum-cryptography-powering-cms-airship\">two</a>&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://paragonie.com/blog/2017/08/introducing-ward-web-application-realtime-defender-waf-ids-automatic-security-updates-for-php-software\">different</a>&nbsp;products (one of them is Free Software). Refer to the implementation in CMS Airship if you need a starting point.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">If your users won\'t have the Sodium extension available, look into&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://github.com/paragonie/sodium_compat\">sodium_compat</a>. This probably won\'t be a problem once everyone is running PHP 7.2 and newer.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">&nbsp;</p>\r\n<h2 id=\"embedded-iot-secure-auto-update\" style=\"box-sizing: border-box; font-family: Play, serif; font-weight: 500; line-height: 1.1; color: #0088cc; margin-top: -55px; margin-bottom: 0.2rem; font-size: 26px; padding-top: 70px; padding-bottom: 0px;\">Secure Automatic Updates for Embedded Devices and the Internet of Things (IoT)</h2>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">Embedded development faces unique challenges and there hasn\'t been a lot of guidance on implementing secure automatic update protocols, especially for so-called \"smart devices\". Due to low memory or power usage requirements, it\'s often not feasible to just staple cryptography onto your product design without using up your entire power or memory budget.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">For extremely constrained devices,&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://github.com/jedisct1/libhydrogen\">libhydrogen</a>&nbsp;is an attractive option. It\'s very lightweight, and the current implementation uses only two primitives to provide a full-featured cryptography library: the Gimli permutation and Curve25519.</p>\r\n<blockquote style=\"box-sizing: border-box; padding: 10px 20px; margin: 0px 0px 20px; font-size: 17.5px; border-left: 5px solid #eeeeee;\">\r\n<p style=\"box-sizing: border-box; margin: 0px;\">Commercial support for libhydrogen is available from&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://primulinus.com/\">Primulinus</a>.</p>\r\n</blockquote>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px;\">The protocol designs that went into&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">The Update Framework</span>&nbsp;and&nbsp;<span style=\"box-sizing: border-box; font-weight: bold;\">Chronicle</span>&nbsp;can be easily re-implemented using libhydrogen, but the Hydrogen version will not be compatible with the Sodium version. If a Hydrogen variant of Chronicle is desired,&nbsp;<a style=\"box-sizing: border-box; background: 0px 0px; color: #1d5394; text-decoration-line: none; font-weight: bold;\" href=\"https://paragonie.com/contact\">get in touch with our team</a>.</p>\r\n<p>&nbsp;</p>\r\n</div>', '2017-10-16 13:27:49', '2017-10-16 13:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `agent` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `expire` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`user_id`, `hash`, `ip`, `agent`, `expire`, `created_at`) VALUES
(2, 'f142430447edd7162717307098e953159d378231b97230d0340f8a9b791a932beaa78a121fc22afce79548bcdb94cbc931e043581b45b27204f44f72d760f345', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36 OPR/48.0.2685.50', NULL, '2017-10-21 22:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(260) COLLATE utf8_unicode_ci NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `level`, `created_at`) VALUES
(2, 'Moody Moooo', 'mogawega@gmail.com', '$2y$10$k6gAUAnRZGEpLF9DmzJH8Ox7SD77o6Dl92/FxqPuXB.aHQHJNNPzq', 1, '2017-10-19 21:33:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_ibfk_1` (`postid`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD KEY `sessions_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
