DROP DATABASE IF EXISTS `greta_eval_php_poo`;
CREATE DATABASE greta_eval_php_poo;

USE greta_eval_php_poo;

DROP TABLE IF EXISTS `character`;
CREATE TABLE `character` (
	 `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	 `type` VARCHAR(100) NOT NULL,
	 `name` VARCHAR(50) NOT NULL,
	 `description` TEXT NOT NULL,
	 `picture` VARCHAR(150) NOT NULL,
	 `health` INT(3) NOT NULL,
	 `strength` INT(3) NOT NULL,
	 `magic` INT(3) NOT NULL,
	 `created_at` DATETIME NOT NULL,
	 `updated_at` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `character` (`type`, `picture`, `name`, `description`, `health`, `strength`, `magic`, `created_at`, `updated_at`)
VALUES
    ('App\\Entity\\Warrior', 'Aragorn.webp', 'Aragorn' "Aragorn est fils d'Arathorn et de Gilraen, petit-fils d\'Arador. Avant la Guerre de l\'Anneau, il est le chef des Rôdeurs du Nord, surnommé Grand-Pas.", '150', '30', '0', '2023-03-24 14:16:36.000000', '2023-03-24 14:16:36.000000'),
    ('App\\Entity\\Wizard', 'Gandalf.webp', 'Gandalf', "Gandalf le Gris, plus tard connu sous le nom de Gandalf le Blanc, et initialement nommé Olórin (en quenya) ou Mithrandir (en sindarin), était un Istar (Magicien), envoyé sur la Terre du Milieu au Troisième Âge pour combattre la menace de Sauron.", '75', '20', '150', '2023-03-24 14:16:36.000000', '2023-03-24 14:16:36.000000')
;
