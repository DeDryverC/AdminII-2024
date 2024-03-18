CREATE TABLE `woodytoys`.`articles` (
  `id` INT NOT NULL PRIMARY KEY,
  `name` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand` VARCHAR(255) DEFAULT NULL,
  `price` FLOAT DEFAULT NULL
);
CREATE TABLE `woodytoys`.`res_users` (
  `id` INT NOT NULL PRIMARY KEY,
  `login` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `uuid` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `firstname` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `access_accounting` BOOLEAN DEFAULT FALSE,
  `access_contact` BOOLEAN DEFAULT FALSE
);
CREATE TABLE `woodytoys`.`invoice` (
  `id` INT NOT NULL PRIMARY KEY,
  `name` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer` VARCHAR(255) DEFAULT NULL,
  `date` DATE  DEFAULT NULL,
  `amount` FLOAT DEFAULT NULL
);

CREATE TABLE `woodytoys`.`contact` (
  `id` INT NOT NULL PRIMARY KEY,
  `name` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` BOOLEAN DEFAULT FALSE,
  `individual` BOOLEAN DEFAULT FALSE,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL
);

INSERT INTO `woodytoys`.`articles`
(`id`, `name`, `brand`, `price`)
VALUES
(1, 'Tracteur', 'Playmebil', 50.00),(2, 'Voiture Police', 'Playmebil', 44.99),(3, 'Camion Pompier', 'Playmebil', 25.99),(4, 'Maison Fleuriste', 'Lago', 50.00),(5, 'Falcon Millenium', 'Lago', 249.99);
INSERT INTO `woodytoys`.`res_users`
(`id`,  `login`, `uuid`,  `password`, `firstname`, `lastname`, `access_accounting`,  `access_contact`)
VALUES
(1, 'johndoe@woodytoys.seldric.be', 'a6519ed0-42ac-11ee-be56-0242ac120002', '$2y$10$3vqYajsAXabY9xgNqs98fO043EDW4ZWQLLrS4hqm7DoGrOqkArgYm',  'John', 'Doe', TRUE, FALSE), (2, 'cdd@woodytoys.seldric.be', 'c184c0d8-42ac-11ee-be56-0242ac120002', '$2y$10$Gc5XU.PUQfOo/P.Htq/bzufhTvhkWQ.1X1fcyfagrJRgkzsxH/WJa', 'Cedric', 'De Dryver', TRUE, TRUE);
INSERT INTO `woodytoys`.`invoice`
(`id`,  `name`,  `customer`, `date`, `amount`)
VALUES
(1, 'INV/0001', 'customer1@abcompany.be', '2023-08-18', 159.59), (2, 'INV/0002', 'g.doe@dfg.inc', '2023-08-20', 248.44);
INSERT INTO `woodytoys`.`contact`
(`id`,  `name`,  `company`, `individual`, `email`,  `phone`)
VALUES
(1, 'Customer One', FALSE, TRUE, 'customer1@abcompany.be', '04700000004'), (2, 'George Doe', FALSE, TRUE, 'g.doe@dfg.inc', '04704700004'), (3, 'ABC Company', TRUE, FALSE, 'contact@abcompany.be', '04700000004');

CREATE USER admin_woodytoys IDENTIFIED WITH mysql_native_password BY 'password123';
GRANT ALL PRIVILEGES ON woodytoys.articles TO 'admin_woodytoys';
