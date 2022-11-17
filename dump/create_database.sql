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
 /* `credit_card_no` varchar(30) NOT NULL,*/
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Insert value into table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'bob', 'bob@example.fr', '26588e932c7ccfa1df309280702fe1b5'),
(4, 'vsk', 'vsk@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(6, 'database', 'database@free.fr', '11e0eed8d3696c0a632f822df385ab3c'),
(7, 'db', 'db@free.fr', 'd77d5e503ad1439f585ac494268b351b'),
(9, 'admin', 'admin@free.fr', '21232f297a57a5a743894a0e4a801fc3'),
(13, 'esigelec', 'esigelec@free.fr', '81dc9bdb52d04dc20036dbd8313ed055'),
(14, 'kumar', 'kumar@gmail.com', '79cfac6387e0d582f83a29a04d0bcdc4'),
(15, 'admins', 'admin@esigelec.fr', '2aefc34200a294a3cc7db81b43a81873'),
(16, 'today', 'today@esigelec.fr', 'c5e7dfaf771d423ecf59b008369021e8'),
(17, 'peter', 'peter@esigelec.fr', '51dc30ddc473d43a6011e9ebba6ca770');

--
-- create table `orders`
--
CREATE TABLE `orders` (
  `id` int(20) NOT NULL,
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
  `id` int(20) NOT NULL,
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


SET global general_log = on;

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
