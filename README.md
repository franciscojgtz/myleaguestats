# myleaguestats
---

myleaguestats is an application designed for soccer-league owners to help them organize their leagues, seasons, teams, and games.


## Instructions
---
You will need a server, PHP, MySQL

### Clone the Repository

### Create a database
Create a <b>MySQL</b> databse to hold the application data

### Create tables
```
--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
 `d_id` int(10) UNSIGNED NOT NULL,
 `league_id` int(11) NOT NULL,
 `d_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
 `date_created` varchar(20) COLLATE latin1_general_ci NOT NULL,
 `date_last_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Triggers `divisions`
--
DELIMITER $$
CREATE TRIGGER `tbl_insert_division` BEFORE INSERT ON `divisions` FOR EACH ROW SET NEW.date_created = NOW(), NEW.date_last_modified = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
 `game_id` int(11) NOT NULL,
 `season_id` int(11) NOT NULL,
 `local_team_id` int(11) DEFAULT NULL,
 `visitor_team_id` int(11) DEFAULT NULL,
 `played` tinyint(1) NOT NULL,
 `local_goals` int(11) DEFAULT NULL,
 `visitor_goals` int(11) DEFAULT NULL,
 `game_place` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
 `game_date` date DEFAULT NULL,
 `game_time` time DEFAULT NULL,
 `round` varchar(11) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
 `date_created` varchar(20) COLLATE latin1_general_ci NOT NULL,
 `date_last_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

DELIMITER $$
CREATE TRIGGER `tbl_insert_game` BEFORE INSERT ON `games` FOR EACH ROW SET NEW.date_created = NOW(), NEW.date_last_modified = NOW()
$$
DELIMITER ;

--
-- Table structure for table `leagues`
--

CREATE TABLE `leagues` (
 `league_id` int(10) UNSIGNED NOT NULL,
 `user_id` int(11) NOT NULL,
 `league_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
 `date_created` varchar(20) COLLATE latin1_general_ci NOT NULL,
 `date_last_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Triggers `leagues`
--
DELIMITER $$
CREATE TRIGGER `tbl_insert_league` BEFORE INSERT ON `leagues` FOR EACH ROW SET NEW.date_created = NOW(), NEW.date_last_modified = NOW()
$$
DELIMITER ;

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
 `season_id` int(10) UNSIGNED NOT NULL,
 `league_id` int(11) NOT NULL,
 `season_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
 `date_created` varchar(20) COLLATE latin1_general_ci NOT NULL,
 `date_last_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Triggers `seasons`
--
DELIMITER $$
CREATE TRIGGER `tbl_insert_season` BEFORE INSERT ON `seasons` FOR EACH ROW SET NEW.date_created = NOW(), NEW.date_last_modified = NOW()
$$
DELIMITER ;

--
-- Table structure for table `standings`
--

CREATE TABLE `standings` (
 `st_id` int(10) UNSIGNED NOT NULL,
 `season_id` int(11) NOT NULL,
 `team_id` int(11) NOT NULL,
 `gms_won` int(11) NOT NULL,
 `gms_tied` int(11) NOT NULL,
 `gms_lost` int(11) NOT NULL,
 `gls_favor` int(11) NOT NULL,
 `gls_against` int(11) NOT NULL,
 `pts_deducted` int(11) NOT NULL,
 `bonus_pts` int(11) NOT NULL,
 `date_created` varchar(20) COLLATE latin1_general_ci NOT NULL,
 `date_last_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Triggers `standings`
--
DELIMITER $$
CREATE TRIGGER `tbl_insert_standing` BEFORE INSERT ON `standings` FOR EACH ROW SET NEW.date_created = NOW(), NEW.date_last_modified = NOW()
$$
DELIMITER ;

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
 `team_id` int(10) UNSIGNED NOT NULL,
 `user_id` int(11) NOT NULL,
 `team_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
 `date_created` varchar(20) COLLATE latin1_general_ci NOT NULL,
 `date_last_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Triggers `teams`
--
DELIMITER $$
CREATE TRIGGER `tbl_insert_team` BEFORE INSERT ON `teams` FOR EACH ROW SET NEW.date_created = NOW(), NEW.date_last_modified = NOW()
$$
DELIMITER ;

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
 `user_id` int(10) UNSIGNED NOT NULL,
 `user_email` varchar(99) COLLATE latin1_general_ci NOT NULL,
 `user_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
 `user_salt` varchar(50) COLLATE latin1_general_ci NOT NULL,
 `user_pass` varchar(1000) COLLATE latin1_general_ci NOT NULL,
 `date_created` varchar(20) COLLATE latin1_general_ci NOT NULL,
 `date_last_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `tbl_insert` BEFORE INSERT ON `users` FOR EACH ROW SET NEW.date_created = NOW(), NEW.date_last_modified = NOW()
$$
DELIMITER ;

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
 ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
 ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `leagues`
--
ALTER TABLE `leagues`
 ADD PRIMARY KEY (`league_id`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
 ADD PRIMARY KEY (`season_id`);

--
-- Indexes for table `standings`
--
ALTER TABLE `standings`
 ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
 ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`),
 ADD UNIQUE KEY `user_name` (`user_name`),
 ADD UNIQUE KEY `user_email` (`user_email`),
 ADD UNIQUE KEY `user_email_2` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
 MODIFY `d_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
 MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `leagues`
--
ALTER TABLE `leagues`
 MODIFY `league_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
 MODIFY `season_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `standings`
--
ALTER TABLE `standings`
 MODIFY `st_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
 MODIFY `team_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
 MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;
```

## Create dbconfig.php
create the file: 
classes/dbconfig.php

Add the following code: 
```
<?php
/*
Replace $host, $user, $pass, and $database with your information
*/
$host = 'localhost';
$user = 'user';
$pass = 'password';
$database = 'myleaguestats';
?>
```

