SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET time_zone = "+08:00";

--
-- Create table `user`
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO INCREMENT,
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
(1, 'apple', 'apple@example.com', '46437ab18a6657040b4535297ff247b20c535c02263713f88b6a9e17484f1f3f', 1221),
(2, 'banana', 'banana@example.com', 'f76cb816b3f74ecf30d387c64869038ac163fe26f8aabd727c1071dd567fc3d5', 1532),
(3, 'car', 'car@example.com', '7ca26aafbfe189a20d2fed657ddcca8aa31581ee6838b90289c4faa4dd23fef8', 4325),
(4, 'dog', 'dog@example.com', '48fe0661615dd0a2fc9cf1b77111613b4c3e7fc857b7bf89e472c233a0b35eb0', 2232),
(5, 'edge', 'edge@example.com', 'b85bf0f7330be07933314afcfc04aa8e8bb33827eb03bdf2f65ff26fd32444f5', 3232),



--
-- create table 'admin'
--
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(155) NOT NULL,
  `salt` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- insert value into table 'admin'
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `salt`) VALUES
(1, 'kenny', 'kenny@admin.com', "03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4", 1234),
(2, 'harry', 'harry@admin.com', "38083c7ee9121e17401883566a148aa5c2e2d55dc53bc4a94a026517dbff3c6b", 2345);

--
-- create table `orders`
--
CREATE TABLE `orders` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) NOT NULL,
  `product` varchar(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

--
-- Insert value into table `orders`
--

INSERT INTO `orders` (`id`, `category`, `product`, `quantity`, `price`) VALUES
(3, 'laptop', 'lenovo-ThinkPad X1', 1, 872),
(4, 'laptop', 'Acer_Swift 7', 1, 872),
(5, 'mobile', 'Asus-ZenFone 6', 1, 872),
(8, 'laptop', 'lenovo_38', 1, 374),
(10, 'laptop', 'lenovo-ThinkPad', 1, 872);

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

/*
REVOKE ALL PRIVILEGES ON *.* FROM 'manager'@'localhost'; 
REVOKE GRANT OPTION ON *.* FROM 'manager'@'localhost'; 
GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'manager'@'localhost'; 
ALTER USER 'manager'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
*/
