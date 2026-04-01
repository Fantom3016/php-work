-- AdminNeo 5.0.0 MySQL 8.0.44-0ubuntu0.24.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `cards`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `collection`;
CREATE TABLE `collection` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_set_id` int NOT NULL,
  `player_id` int NOT NULL,
  `card_name` varchar(2000) NOT NULL,
  `card_number` int NOT NULL,
  `mana_cost` int NOT NULL,
  `type` varchar(2000) NOT NULL,
  `rarity` varchar(2000) NOT NULL,
  `color` varchar(2000) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `image_file` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `full_set_id` (`full_set_id`),
  KEY `player_id` (`player_id`),
  CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`full_set_id`) REFERENCES `full_set` (`id`),
  CONSTRAINT `collection_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `collection` (`id`, `full_set_id`, `player_id`, `card_name`, `card_number`, `mana_cost`, `type`, `rarity`, `color`, `text`, `image_file`) VALUES
(36,	24,	3,	'Agonizing Remorse',	24,	2,	'Sorcery',	'Rare',	'black',	'Target opponent reveals their hand. You choose a nonland card from it or a card from their graveyard. Exile that card. You lose 1 life.',	'/var/www/html/projects/project4/images/sta-87-agonizing-remorse.jpg'),
(37,	14,	3,	'Compulsive Research',	14,	3,	'Sorcery',	'Rare',	'blue',	'Target player draws three cards. Then that player discards two cards unless they discard a land card.',	'/var/www/html/projects/project4/images/sta-77-compulsive-research.jpg'),
(38,	40,	3,	'Increasing Vengeance',	40,	2,	'Instant',	'Mythic',	'red',	'Copy target instant or sorcery spell you control. If this spell was cast from a graveyard, copy that spell twice instead. You may choose new targets for the copies.  Flashback {3}{R}{R} (You may cast this card from your graveyard for its flashback cost. Then exile it.)',	'/var/www/html/projects/project4/images/sta-103-increasing-vengeance.jpg'),
(39,	33,	3,	'Tainted Pact',	33,	2,	'Instant',	'Mythic',	'black',	'Exile the top card of your library. You may put that card into your hand unless it has the same name as another card exiled this way. Repeat this process until you put a card into your hand or you exile two cards with the same name, whichever comes first.',	'/var/www/html/projects/project4/images/sta-96-tainted-pact.jpg'),
(40,	11,	3,	'Teferis Protection',	11,	3,	'Instant',	'Mythic',	'white',	'Until your next turn, your life total can’t change and you gain protection from everything. All permanents you control phase out. (While they’re phased out, they’re treated as though they don’t exist. They phase in before you untap during your untap step.)  Exile Teferi’s Protection.',	'/var/www/html/projects/project4/images/sta-74-teferi-s-protection.jpg'),
(41,	29,	3,	'Duress',	29,	1,	'Sorcery',	'Uncommon',	'black',	'Target opponent reveals their hand. You choose a noncreature, nonland card from it. That player discards that card.',	'/var/www/html/projects/project4/images/sta-92-duress.jpg'),
(43,	44,	3,	'Shock',	44,	1,	'Instant',	'Uncommon',	'red',	'Shock deals 2 damage to any target.',	'/var/www/html/projects/project4/images/sta-107-shock.jpg'),
(45,	37,	3,	'Claim the Firstborn',	37,	1,	'Sorcery',	'Uncommon',	'red',	'Gain control of target creature with mana value 3 or less until end of turn. Untap that creature. It gains haste until end of turn.',	'/var/www/html/projects/project4/images/sta-100-claim-the-firstborn.jpg'),
(46,	24,	6,	'Agonizing Remorse',	24,	2,	'Sorcery',	'Rare',	'black',	'Target opponent reveals their hand. You choose a nonland card from it or a card from their graveyard. Exile that card. You lose 1 life.',	'/var/www/html/projects/project4/images/sta-87-agonizing-remorse.jpg'),
(47,	15,	6,	'Counterspell',	15,	2,	'Instant',	'Rare',	'blue',	'Counterspell',	'/var/www/html/projects/project4/images/sta-78-counterspell.jpg'),
(48,	24,	6,	'Agonizing Remorse',	24,	2,	'Sorcery',	'Rare',	'black',	'Target opponent reveals their hand. You choose a nonland card from it or a card from their graveyard. Exile that card. You lose 1 life.',	'/var/www/html/projects/project4/images/sta-87-agonizing-remorse.jpg'),
(49,	50,	6,	'Channel',	50,	2,	'Sorcery',	'Mythic',	'green',	'Until end of turn, any time you could activate a mana ability, you may pay 1 life. If you do, add {C}.',	'/var/www/html/projects/project4/images/sta-113-channel.jpg'),
(50,	13,	6,	'Brainstorm',	13,	1,	'Instant',	'Rare',	'blue',	'Draw three cards, then put two cards from your hand on top of your library in any order.',	'/var/www/html/projects/project4/images/sta-76-brainstorm.jpg');

DROP TABLE IF EXISTS `full_set`;
CREATE TABLE `full_set` (
  `id` int NOT NULL AUTO_INCREMENT,
  `card_name` varchar(2000) NOT NULL,
  `card_number` int NOT NULL,
  `mana_cost` varchar(2000) NOT NULL,
  `type` varchar(2000) NOT NULL,
  `rarity` varchar(1000) NOT NULL,
  `color` varchar(2000) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `image_file` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `full_set` (`id`, `card_name`, `card_number`, `mana_cost`, `type`, `rarity`, `color`, `text`, `image_file`) VALUES
(1,	'Approach of the Second Sun',	1,	'7',	'Sorcery',	'Mythic',	'white',	'If this spell was cast from your hand and you’ve cast another spell named Approach of the Second Sun this game, you win the game. Otherwise, put Approach of the Second Sun into its owner’s library seventh from the top and you gain 7 life.',	'/var/www/html/projects/project4/images/sta-64-approach-of-the-second-sun.jpg'),
(2,	'Day of Judgment',	2,	'4',	'Sorcery',	'Mythic',	'white',	'Destroy all creatures.',	'/var/www/html/projects/project4/images/sta-65-day-of-judgment.jpg'),
(3,	'Defiant Strike',	3,	'1',	'Instant',	'Uncommon',	'white',	'Target creature gets +1/+0 until end of turn.  Draw a card.',	'/var/www/html/projects/project4/images/sta-66-defiant-strike.jpg'),
(4,	'Divine Gambit',	4,	'2',	'Sorcery',	'Uncommon',	'white',	'Exile target artifact, creature, or enchantment an opponent controls. That player may put a permanent card from their hand onto the battlefield.',	'/var/www/html/projects/project4/images/sta-67-divine-gambit.jpg'),
(5,	'Ephemerate',	5,	'1',	'Instant',	'Rare',	'white',	'Exile target creature you control, then return it to the battlefield under its owner’s control.  Rebound (If you cast this spell from your hand, exile it as it resolves. At the beginning of your next upkeep, you may cast this card from exile without paying its mana cost.)',	'/var/www/html/projects/project4/images/sta-68-ephemerate.jpg'),
(6,	'Gift of Estates',	6,	'2',	'Sorcery',	'Rare',	'white',	'If an opponent controls more lands than you, search your library for up to three Plains cards, reveal them, put them into your hand, then shuffle.',	'/var/www/html/projects/project4/images/sta-69-gift-of-estates.jpg'),
(7,	'Gods Willing',	7,	'1',	'Instant',	'Rare',	'white',	'Target creature you control gains protection from the color of your choice until end of turn. (It can’t be blocked, targeted, dealt damage, enchanted, or equipped by anything of that color.)',	'/var/www/html/projects/project4/images/sta-70-gods-willing.jpg'),
(8,	'Mana Tithe',	8,	'1',	'Instant',	'Rare',	'white',	'Counter target spell unless its controller pays {1}.',	'/var/www/html/projects/project4/images/sta-71-mana-tithe.jpg'),
(9,	'Revitalize',	9,	'1',	'Instant',	'Uncommon',	'white',	'You gain 3 life.  Draw a card.',	'/var/www/html/projects/project4/images/sta-72-revitalize.jpg'),
(10,	'Swords to Plowshares',	10,	'1',	'Instant',	'Rare',	'white',	'Exile target creature. Its controller gains life equal to its power.',	'/var/www/html/projects/project4/images/sta-73-swords-to-plowshares.jpg'),
(11,	'Teferis Protection',	11,	'3',	'Instant',	'Mythic',	'white',	'Until your next turn, your life total can’t change and you gain protection from everything. All permanents you control phase out. (While they’re phased out, they’re treated as though they don’t exist. They phase in before you untap during your untap step.)  Exile Teferi’s Protection.',	'/var/www/html/projects/project4/images/sta-74-teferi-s-protection.jpg'),
(12,	'Blue Suns Zenith',	12,	'3',	'Instant',	'Mythic',	'blue',	'Target player draws X cards. Shuffle Blue Sun’s Zenith into its owner’s library.',	'/var/www/html/projects/project4/images/sta-75-blue-sun-s-zenith.jpg'),
(13,	'Brainstorm',	13,	'1',	'Instant',	'Rare',	'blue',	'Draw three cards, then put two cards from your hand on top of your library in any order.',	'/var/www/html/projects/project4/images/sta-76-brainstorm.jpg'),
(14,	'Compulsive Research',	14,	'3',	'Sorcery',	'Rare',	'blue',	'Target player draws three cards. Then that player discards two cards unless they discard a land card.',	'/var/www/html/projects/project4/images/sta-77-compulsive-research.jpg'),
(15,	'Counterspell',	15,	'2',	'Instant',	'Rare',	'blue',	'Counterspell',	'/var/www/html/projects/project4/images/sta-78-counterspell.jpg'),
(16,	'Memory Lapse',	16,	'2',	'Instant',	'Rare',	'blue',	'Counter target spell. If that spell is countered this way, put it on top of its owner’s library instead of into that player’s graveyard.',	'/var/www/html/projects/project4/images/sta-79-memory-lapse.jpg'),
(17,	'Minds Desire',	17,	'6',	'Sorcery',	'Mythic',	'blue',	' Shuffle your library. Then exile the top card of your library. Until end of turn, you may play that card without paying its mana cost.  Storm',	'/var/www/html/projects/project4/images/sta-80-mind-s-desire.jpg'),
(18,	'Nagate',	18,	'2',	'Instant',	'Uncommon',	'blue',	'Counter target noncreature spell.',	'/var/www/html/projects/project4/images/sta-81-negate.jpg'),
(19,	'Opt',	19,	'1',	'Instant',	'Uncommon',	'blue',	'Scry 1. (Look at the top card of your library. You may put that card on the bottom.)  Draw a card',	'/var/www/html/projects/project4/images/sta-82-opt.jpg'),
(20,	'Strategic Planning',	20,	'2',	'Sorcery',	'Uncommon',	'blue',	'Look at the top three cards of your library. Put one of them into your hand and the rest into your graveyard.',	'/var/www/html/projects/project4/images/sta-83-strategic-planning.jpg'),
(21,	'Tezzerets Gambit',	21,	'4',	'Sorcery',	'Rare',	'blue',	'Draw two cards, then proliferate. (Choose any number of permanents and/or players, then give each another counter of each kind already there.)',	'/var/www/html/projects/project4/images/sta-84-tezzeret-s-gambit.jpg'),
(22,	'Time Warp',	22,	'5',	'Sorcery',	'Mythic',	'blue',	'Target player takes an extra turn after this one.',	'/var/www/html/projects/project4/images/sta-85-time-warp.jpg'),
(23,	'Whirlwind Denial',	23,	'3',	'Instant',	'Uncommon',	'blue',	'For each spell and ability your opponents control, counter it unless its controller pays 4.',	'/var/www/html/projects/project4/images/sta-86-whirlwind-denial.jpg'),
(24,	'Agonizing Remorse',	24,	'2',	'Sorcery',	'Rare',	'black',	'Target opponent reveals their hand. You choose a nonland card from it or a card from their graveyard. Exile that card. You lose 1 life.',	'/var/www/html/projects/project4/images/sta-87-agonizing-remorse.jpg'),
(25,	'Crux of Fate',	25,	'5',	'Sorcery',	'Mythic',	'black',	'Choose one —    Destroy all Dragon creatures.  or  Destroy all non-Dragon creatures.',	'/var/www/html/projects/project4/images/sta-88-crux-of-fate.jpg'),
(26,	'Dark Ritual',	26,	'1',	'Instant',	'Rare',	'black',	'Add 3 black mana',	'/var/www/html/projects/project4/images/sta-89-dark-ritual.jpg'),
(27,	'Demonic Tutor',	27,	'2',	'Sorcery',	'Mythic',	'black',	'Search your library for a card, put that card into your hand, then shuffle.',	'/var/www/html/projects/project4/images/sta-90-demonic-tutor.jpg'),
(28,	'Doom Blade',	28,	'2',	'Instant',	'Rare',	'black',	'Destroy target nonblack creature.',	'/var/www/html/projects/project4/images/sta-91-doom-blade.jpg'),
(29,	'Duress',	29,	'1',	'Sorcery',	'Uncommon',	'black',	'Target opponent reveals their hand. You choose a noncreature, nonland card from it. That player discards that card.',	'/var/www/html/projects/project4/images/sta-92-duress.jpg'),
(30,	'Eliminate',	30,	'2',	'Instant',	'Uncommon',	'black',	'Destroy target creature or planeswalker with mana value 3 or less.',	'/var/www/html/projects/project4/images/sta-93-eliminate.jpg'),
(31,	'Inquisition of Kozilek',	31,	'1',	'Sorcery',	'Rare',	'black',	'Target player reveals their hand. You choose a nonland card from it with mana value 3 or less. That player discards that card.',	'/var/www/html/projects/project4/images/sta-94-inquisition-of-kozilek.jpg'),
(32,	'Sign in Blood',	32,	'2',	'Instant',	'Rare',	'black',	'Target player draws two cards and loses 2 life.',	'/var/www/html/projects/project4/images/sta-95-sign-in-blood.jpg'),
(33,	'Tainted Pact',	33,	'2',	'Instant',	'Mythic',	'black',	'Exile the top card of your library. You may put that card into your hand unless it has the same name as another card exiled this way. Repeat this process until you put a card into your hand or you exile two cards with the same name, whichever comes first.',	'/var/www/html/projects/project4/images/sta-96-tainted-pact.jpg'),
(34,	'Tendrils of Agony',	34,	'4',	'Sorcery',	'Rare',	'black',	'Target player loses 2 life and you gain 2 life.  Storm (When you cast this spell, copy it for each spell cast before it this turn. You may choose new targets for the copies.)',	'/var/www/html/projects/project4/images/sta-97-tendrils-of-agony.jpg'),
(35,	'Village Rites',	35,	'1',	'Instant',	'Uncommon',	'black',	'As an additional cost to cast this spell, sacrifice a creature.  Draw two cards.',	'/var/www/html/projects/project4/images/sta-98-village-rites.jpg'),
(36,	'Chaos Warp',	36,	'3',	'Instant',	'Mythic',	'red',	'The owner of target permanent shuffles it into their library, then reveals the top card of their library. If it’s a permanent card, they put it onto the battlefield.',	'/var/www/html/projects/project4/images/sta-99-chaos-warp.jpg'),
(37,	'Claim the Firstborn',	37,	'1',	'Sorcery',	'Uncommon',	'red',	'Gain control of target creature with mana value 3 or less until end of turn. Untap that creature. It gains haste until end of turn.',	'/var/www/html/projects/project4/images/sta-100-claim-the-firstborn.jpg'),
(38,	'Faithless Looting',	38,	'1',	'Sorcery',	'Rare',	'red',	'Draw two cards, then discard two cards.  Flashback {2}{R} (You may cast this card from your graveyard for its flashback cost. Then exile it.)',	'/var/www/html/projects/project4/images/sta-101-faithless-looting.jpg'),
(39,	'Grapeshot',	39,	'2',	'Sorcery',	'Rare',	'red',	'Grapeshot deals 1 damage to any target.  Storm (When you cast this spell, copy it for each spell cast before it this turn. You may choose new targets for the copies.)',	'/var/www/html/projects/project4/images/sta-102-grapeshot.jpg'),
(40,	'Increasing Vengeance',	40,	'2',	'Instant',	'Mythic',	'red',	'Copy target instant or sorcery spell you control. If this spell was cast from a graveyard, copy that spell twice instead. You may choose new targets for the copies.  Flashback {3}{R}{R} (You may cast this card from your graveyard for its flashback cost. Then exile it.)',	'/var/www/html/projects/project4/images/sta-103-increasing-vengeance.jpg'),
(41,	'Infuriate',	41,	'1',	'Instant',	'Uncommon',	'red',	'Target creature gets +3/+2 until end of turn.',	'/var/www/html/projects/project4/images/sta-104-infuriate.jpg'),
(42,	'Lightning Bolt',	42,	'1',	'Instant',	'Rare',	'red',	'Lightning Bolt deals 3 damage to any target.',	'/var/www/html/projects/project4/images/sta-105-lightning-bolt.jpg'),
(43,	'Mizzixs Mastery',	43,	'4',	'Sorcery',	'Mythic',	'red',	'Exile target card that’s an instant or sorcery from your graveyard. For each card exiled this way, copy it, and you may cast the copy without paying its mana cost. Exile Mizzix’s Mastery.  Overload {5}{R}{R}{R} (You may cast this spell for its overload cost. If you do, change “target” in its text to “each.”)',	'/var/www/html/projects/project4/images/sta-106-mizzix-s-mastery.jpg'),
(44,	'Shock',	44,	'1',	'Instant',	'Uncommon',	'red',	'Shock deals 2 damage to any target.',	'/var/www/html/projects/project4/images/sta-107-shock.jpg'),
(45,	'Stone Rain',	45,	'3',	'Sorcery',	'Rare',	'red',	'Destroy target land.',	'/var/www/html/projects/project4/images/sta-108-stone-rain.jpg'),
(46,	'Thrill of Possibility',	46,	'2',	'Instant',	'Uncommon',	'red',	'As an additional cost to cast this spell, discard a card.  Draw two cards.',	'/var/www/html/projects/project4/images/sta-109-thrill-of-possibility.jpg'),
(47,	'Urzas Rage',	47,	'3',	'Instant',	'Rare',	'red',	'Kicker {8}{R} (You may pay an additional {8}{R} as you cast this spell.)  This spell can’t be countered.  Urza’s Rage deals 3 damage to any target. If this spell was kicked, instead it deals 10 damage to that permanent or player and the damage can’t be prevented.',	'/var/www/html/projects/project4/images/sta-110-urza-s-rage.jpg'),
(48,	'Abundant Harvest',	48,	'1',	'Sorcery',	'Rare',	'green',	'Choose land or nonland. Reveal cards from the top of your library until you reveal a card of the chosen kind. Put that card into your hand and the rest on the bottom of your library in a random order.',	'/var/www/html/projects/project4/images/sta-111-abundant-harvest.jpg'),
(49,	'Adventurous Impulse',	49,	'1',	'Sorcery',	'Uncommon',	'green',	'Look at the top three cards of your library. You may reveal a creature or land card from among them and put it into your hand. Put the rest on the bottom of your library in any order.',	'/var/www/html/projects/project4/images/sta-112-adventurous-impulse.jpg'),
(50,	'Channel',	50,	'2',	'Sorcery',	'Mythic',	'green',	'Until end of turn, any time you could activate a mana ability, you may pay 1 life. If you do, add {C}.',	'/var/www/html/projects/project4/images/sta-113-channel.jpg'),
(51,	'Cultivate',	51,	'3',	'Sorcery',	'Uncommon',	'green',	'Search your library for up to two basic land cards, reveal those cards, put one onto the battlefield tapped and the other into your hand, then shuffle.',	'/var/www/html/projects/project4/images/sta-114-cultivate.jpg'),
(52,	'Harmonize',	52,	'4',	'Sorcery',	'Rare',	'green',	'Draw three cards.',	'/var/www/html/projects/project4/images/sta-115-harmonize.jpg'),
(53,	'Krosan Grip',	53,	'3',	'Instant',	'Rare',	'green',	'Split second (As long as this spell is on the stack, players can’t cast spells or activate abilities that aren’t mana abilities.)  Destroy target artifact or enchantment.',	'/var/www/html/projects/project4/images/sta-116-krosan-grip.jpg'),
(54,	'Natural Order',	54,	'4',	'Sorcery',	'Mythic',	'green',	'As an additional cost to cast this spell, sacrifice a green creature.  Search your library for a green creature card, put it onto the battlefield, then shuffle.',	'/var/www/html/projects/project4/images/sta-117-natural-order.jpg'),
(55,	'Primal Command',	55,	'5',	'Sorcery',	'Mythic',	'green',	'Choose two —  • Target player gains 7 life.  • Put target noncreature permanent on top of its owner’s library.  • Target player shuffles their graveyard into their library.  • Search your library for a creature card, reveal it, put it into your hand, then shuffle.',	'/var/www/html/projects/project4/images/sta-118-primal-command.jpg'),
(56,	'Regrowth',	56,	'2',	'Sorcery',	'Rare',	'green',	'Return target card from your graveyard to your hand.',	'/var/www/html/projects/project4/images/sta-119-regrowth.jpg'),
(57,	'Snakeskin Veil',	57,	'1',	'Instant',	'Uncommon',	'green',	'Put a +1/+1 counter on target creature you control. It gains hexproof until end of turn. (It can’t be the target of spells or abilities your opponents control.)',	'/var/www/html/projects/project4/images/sta-120-snakeskin-veil.jpg'),
(58,	'Weather the Storm',	58,	'2',	'Instant',	'Rare',	'green',	'You gain 3 life.  Storm (When you cast this spell, copy it for each spell cast before it this turn.)',	'/var/www/html/projects/project4/images/sta-121-weather-the-storm.jpg'),
(59,	'Despark',	59,	'2',	'Instant',	'Rare',	'multicolor',	'Exile target permanent with mana value 4 or greater.',	'/var/www/html/projects/project4/images/sta-122-despark.jpg'),
(60,	'Electrolyze',	60,	'3',	'Instant',	'Rare',	'multicolor',	'Electrolyze deals 2 damage divided as you choose among one or two targets.  Draw a card.',	'/var/www/html/projects/project4/images/sta-123-electrolyze.jpg'),
(61,	'Growth Spiral',	61,	'2',	'Instant',	'Rare',	'multicolor',	'Draw a card. You may put a land card from your hand onto the battlefield.',	'/var/www/html/projects/project4/images/sta-124-growth-spiral.jpg'),
(62,	'Lightning Helix',	62,	'2',	'Instant',	'Rare',	'multicolor',	'Lightning Helix deals 3 damage to any target and you gain 3 life.',	'/var/www/html/projects/project4/images/sta-125-lightning-helix.jpg'),
(63,	'Putrefy',	63,	'3',	'Instant',	'Rare',	'multicolor',	'Destroy target artifact or creature. It can’t be regenerated.',	'/var/www/html/projects/project4/images/sta-126-putrefy.jpg');

DROP TABLE IF EXISTS `player`;
CREATE TABLE `player` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(2000) NOT NULL,
  `first_name` varchar(2000) NOT NULL,
  `last_name` varchar(2000) NOT NULL,
  `password_hash` varchar(2000) NOT NULL,
  `access_privileges` varchar(1000) NOT NULL DEFAULT 'user',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image_file` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `player` (`id`, `user_name`, `first_name`, `last_name`, `password_hash`, `access_privileges`, `date_created`, `image_file`) VALUES
(3,	'Admin',	'Mary',	'Williams',	'$2y$10$aaNMQ8L2XMf3FPewUtDtP.rT/YdIEN3EJxafeJ2Y/0zCsME.26q5O',	'admin',	'2025-12-16 11:19:13',	'/var/www/html/projects/project4/images/istockphoto-1326417862-612x612.jpg'),
(6,	'ICU',	'Donald',	'Pool',	'$2y$10$djzYg1RipX2QOJZHWUUkZ.6vz4.N3Wczaaf/8gFLWqz6TSKE7nhZu',	'user',	'2025-12-17 19:48:15',	'/var/www/html/projects/project4/images/Donald_Duck_angry_transparent_background.png');

-- 2025-12-18 02:46:59 UTC
