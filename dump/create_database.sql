SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET time_zone = "+08:00";

--
-- Create table `user`
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(155) NOT NULL,
  `salt` int(4) NOT NULL,
 /* `credit_card_no` varchar(30) NOT NULL,*/
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Insert value into table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `salt`) VALUES
(1, 'apple', 'apple@example.com', 'a3bca80e619c78ce04a8225fed8f6942be5020c66e69856393d824d7529b5e56', 1221),
(2, 'banana', 'banana@example.com', '4e5bc7a29d29da8742ab754ed8fbce3fda77c0cf29f63243493f881985f79171', 1532),
(3, 'car', 'car@example.com', '0e63f4bb4b0ae5781b72e5f499a44ac6985d5b3c6125948894c92a44bada39c6', 4325),
(4, 'dog', 'dog@example.com', '4c54d6b49809a2c00c3a0582dfc72af32f31565210f55f42700c57bfcfe9bc94', 2232),
(5, 'edge', 'edge@example.com', 'fefa51fda7da09ac4fa4b910b201533e1b1de36d6dc72d8a4ce8d376b64a4aa7', 3232);



--
-- create table 'admin'
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(155) NOT NULL,
  `salt` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- insert value into table 'admin'
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `salt`) VALUES
(1, 'kenny', 'kenny@admin.com', "88d658ed9cdc1a4cfa8d0971d0b5738f11caa0958d50c43ee4b6f1566cfc7aee", 1234),
(2, 'harry', 'harry@admin.com', "bff94628140f6c3216709c13ccdb2f07df2644e515b4d3dfc311e642c7d49930", 2345);

CREATE TABLE `managers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(155) NOT NULL,
  `salt` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- insert value into table 'admin'
--

INSERT INTO `managers` (`id`, `username`, `email`, `password`, `salt`) VALUES
(1, 'charlie', 'charlie@manager.com', "8069adf6554db60ffa5383e8083b78fc761c944c0052d8fcbf2e05cf9dbaa7a8", 2458),
(2, 'samuel', 'samuel@manager.com', "498c4825f30f2b6927fa0312c8b9d0bc7ea43b3e18fe235dbb24fe3bd4509f4a", 3697);

--
-- create table `orders`
--
CREATE TABLE `orders` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) NOT NULL,
  `product` varchar(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `price` float NOT NULL,
  `userID` int(11) NOT NULL,
  Foreign Key (userID) REFERENCES users(id),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

--
-- Insert value into table `orders`
--

INSERT INTO `orders` (`id`, `category`, `product`, `quantity`, `price`, `userId`) VALUES
(1, 'laptop', 'lenovo-ThinkPad X1', 1, 872, 1),
(2, 'laptop', 'Acer_Swift 7', 1, 872, 1),
(3, 'mobile', 'Asus-ZenFone 6', 1, 872,2),
(4, 'laptop', 'lenovo_38', 1, 374, 2),
(5, 'laptop', 'lenovo-ThinkPad', 1, 872, 2);

-- --------------------------------------------------------

--
-- Create table `products`
--

CREATE TABLE `products` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `image` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `product` varchar(20) NOT NULL,
  `price` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

--
-- Insert value into table `products`
--

INSERT INTO `products` (`id`, `image`, `category`, `product`, `price`) VALUES
(28, 'laptop.jpg', 'acer', 'acer_728', 821),
(29, 'mobile.jpg', 'apple', 'i8', 873),
(30, 'mobile.jpg', 'samsung', 'sam_s6', 873),
(31, 'mobile.jpg', 'MICROSOFT', 'MIC_721', 487),
(33, 'laptop.jpg', 'APPLE', 'MACBOOK_2019', 2903),
(34, 'laptop.jpg', 'TOHIBA', 'THOSI_2019', 889);


--
-- AUTO_INCREMENT in table 'products`
--
ALTER TABLE `products`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

CREATE TABLE `verification_code` (
  `id` INT NOT NULL AUTO_INCREMENT,
   `user_id` INT NOT NULL ,
   `user_type` TEXT NOT NULL ,
   `verification_code` INT NOT NULL ,
   `expried_date` DATETIME NOT NULL ,
   PRIMARY KEY (`id`)) 
ENGINE = InnoDB;


commit;
-- create role

CREATE ROLE 'admin';
GRANT DELETE, INSERT, SELECT ON comp3335.users TO 'admin';
GRANT DELETE, INSERT, SELECT ON comp3335.users TO 'admin';

CREATE USER 'admin1'@'localhost' IDENTIFIED BY '1115597898AAAb';
GRANT 'admin' TO 'admin1'@'localhost';

create role 'student';
GRANT INSERT ON comp3335.products TO 'student';
CREATE USER 'student1'@'localhost' IDENTIFIED BY '39489310ajA';
GRANT 'student' TO 'student1'@'localhost';

CREATE ROLE 'manager';
GRANT SELECT, UPDATE, DELETE ON comp3335.orders TO 'manager';
CREATE USER 'manager1'@'localhost' IDENTIFIED BY '84968223aRh';
GRANT 'manager' TO 'manager1'@'localhost';

CREATE ROLE 'validator';
GRANT SELECT ON comp3335.users TO 'validator';
GRANT SELECT ON comp3335.admins TO 'validator';
GRANT SELECT ON comp3335.managers TO 'validator';
CREATE USER 'validator1'@'localhost' IDENTIFIED BY '87fd89asf02';
GRANT 'validator' TO 'validator1'@'localhost';

/*
REVOKE ALL PRIVILEGES ON *.* FROM 'manager'@'localhost'; 
REVOKE GRANT OPTION ON *.* FROM 'manager'@'localhost'; 
GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'manager'@'localhost'; 
ALTER USER 'manager'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
*/
