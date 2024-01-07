SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

/* hier 'mydb' veranderen als u een andere naam wilt*/
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mydb`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orders_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `orders_item` (
  `orders_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `producten` (
  `productid` int(11) NOT NULL,
  `productnaam` varchar(250) NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `categorie` varchar(45) NOT NULL,
  `imagesrc` varchar(120) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `merk` varchar(45) DEFAULT NULL,
  `productinformatie` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `producten` (`productid`, `productnaam`, `description`, `prijs`, `categorie`, `imagesrc`, `datum`, `merk`, `productinformatie`) VALUES
(0, 'Playstation 5', 'Met de PlayStation 5 Slim Digital Edition breng je jouw game ervaring naar een hoger niveau. Deze PlayStation 5 Digital Edition heeft geen cd lade, waardoor je geen games op disc of blu-ray films afspeelt. Wil je dit wel? Dan installeer je gemakkelijk de los verkrijgbare Disc Drive op je Digital Edition. Zo speel je alsnog fysieke games en kijk je ook blu-ray films. De PS5 Slim is 30 procent kleiner dan zijn voorganger. Hierdoor neemt hij minder ruimte in op je bureau of naast je tv. Daarnaast heeft de Slim een opslag van 1 terabyte, waar de originele PlayStation 5 825 gigabyte opslagruimte heeft. Door de krachtige grafische processor in deze console game je in 4K resolutie met een maximale verversingssnelheid van 120 hertz. De SSD zorgt voor 20 keer snellere laadtijden in games dan op voorgaande PlayStation consoles. Speel je veel RPG of shooter games? Met 3D audio hoor je precies waar je tegenstanders vandaan komen. In-game bestuur jij jouw personage met de meegeleverde DualSense controller. Deze heeft voelbare feedback en trigger effecten, waardoor je niet alleen ziet en hoort, maar ook voelt wat er in je game gebeurt.', 450.00, 'spelcomputers', 'playstation5.png', '2020-11-12', 'Sony', 'De nieuwste spelcomputer van Sony!'),
(1, 'RTX4090', 'De hoge grafische prestaties van de MSI GeForce RTX 4090 Gaming X Trio 24G worden gegarandeerd door de grafische processor met een maximale boostklok van 2.520 MHz en het 24 GB GDDR6X-geheugen met een effectieve klokfrequentie van 21.000 MHz. De MSI GeForce RTX 4090 Gaming X Trio 24G wordt op lage temperaturen gehouden door het triple koelsysteem dat door MSI is ontwikkeld.', 1200.00, 'onderdelen', 'rtx4090.png', '2022-10-12', 'Nvidia', 'De krachtigste GPU op de markt!'),
(2, 'Arduino', 'Dit is de Arduino Uno R4 WiFi. Met zijn ingebouwde Wi-Fi® en Bluetooth® mogelijkheden maakt de UNO R4 WiFi naadloze draadloze communicatie mogelijk. Hierdoor kun je jouw projecten op afstand verbinden en besturen. Dit board combineert de RA4M1 microprocessor van Renesas met de ESP32-S3 van Espressif. De UNO R4 WiFi behoudt het welbekende UNO formaat. Het is dan ook compatibel is met bestaande shields en accessoires. Het beschikt over uitgebreid geheugen en een snellere kloksnelheid. Waardoor je moeiteloos complexe berekeningen en taken kunt uitvoeren. De ingebouwde 12x8 LED-matrix biedt een helder display om visuele effecten weer te geven. Ook is dit ideaal om sensorgegevens op weer te geven, zonder dat je extra hardware nodig hebt. Met de toevoeging van een QWIIC-connector biedt de UNO R4 WiFi nog meer veelzijdigheid. Waardoor je snel en gemakkelijk verbinding kunt maken met verschillende QWIIC-componenten en sensoren. De UNO R4 WiFi bevat een foutopsporingsmechanisme dat runtime crashes detecteert. Op basis hiervan geeft hij gedetailleerde uitleg en hints over de code-regel die de crash veroorzaakt. Een zeer welkome verbetering ten opzichte van de Uno R3 is dat de Uno R4 een USB-C poort heeft. Het board kan eenvoudig worden geprogrammeerd via de gratis Arduino IDE software. Met ingebouwde HID-ondersteuning kan het board een muis of toetsenbord simuleren wanneer deze via USB op een computer is aangesloten.', 32.00, 'gadgets', 'arduino.png', '2019-09-02', 'arduino', 'Een mini computer!'),
(3, 'RaspberryPI', 'De Raspberry Pi 4 model B 8GB is het nieuwste board van Raspberry Pi. Hoewel de Pi 4 op het vorige model lijk zijn er een aantal zeer belangrijke upgrades doorgevoerd. Een van de belangrijkste onderdelen in de Raspberry Pi 4 is de Broadcom BCM2711 SoC. Deze bestaat uit vier 1,5 GHz 64-bit ARM Cortex-A72 CPU-kernen en zou een mooie prestatieverbetering moeten bieden over de Cortex-A53 CPU in de Raspberry Pi 3 (het is tot drie keer sneller). Het is nu ook voor het eerst mogelijk om de hoeveelheid RAM te kiezen. Opties zijn: 2 GB, 4 GB of zelfs 8 GB RAM. Ter referentie, de Raspberry Pi 3 kwam alleen met 1 GB RAM, wat een beetje aan de magere kant is voor normaal gebruik. De Raspberry Pi 4 model B 8GB komt met 2 Micro HDMI aansluitingen waar je elk een 4K monitor op aan kunt sluiten. Let op! De Raspberry Pi 4 wordt erg warm, wij raden het zeker aan om Heatsinks te gebruiken.', 30.00, 'gadgets', 'Pi5-nbg.png', '2023-10-23', 'raspberry', 'Een mini computer'),
(4, 'NVIDIA Quardo', 'De PNY NVIDIA T400 combineert NVIDIA Turing GPU-architectuur met de nieuwste geheugen- en weergavetechnologieën om de beste prestaties en functies te leveren in een single-slot PCIe vormfactor. Met fotorealistische rendering profiteren gebruikers van een grotere vloeiendheid en snellere prestaties met AI-toepassingen, en kunnen ze op een meer kosteneffectieve manier gedetailleerde, realistische VR-ervaringen creëren in een groter aantal configuraties van werkstationchassis. De PNY NVIDIA T400 levert AI-versnelling met 4 GB GDDR6-geheugen voor grote datasets.', 209.00, 'onderdelen', '0VBKqGE85lq5.jpg\r\n', '2018-11-13', 'NVIDIA', 'Een goedkope optie van NVIDIA'),
(5, '10TH generation Intel core I7', 'De Intel Core i7-10700K, codenaam \"Comet Lake-S\", beschikt over 8 verwerkingseenheden en is geschikt om op een moederbord met Socket 1200 te plaatsen. De processor beschikt over 16 MB Smart cache en werkt op een snelheid van 3,8 GHz. De Intel Core i7-10700K beschikt over een interne geheugencontroller met twee geheugen kanalen.', 289.00, 'onderdelen', '3jx92Qogw0Xn.jpg', '2020-10-15', 'Intel', 'Een krachtige processor van Intel.'),
(6, 'Apple MacBook Pro 16 (2023)', 'Met Apple MacBook Pro 16\" (2023) M3 Pro (12 core CPU/18 core GPU) 18GB/512GB Zilver bewerk je soepel video\'s in zware programma\'s als Final Cut Pro. Hier zijn de M3 Pro chip en het 18 gigabyte werkgeheugen krachtig genoeg voor. Door de ProMotion technologie zie je snelle beelden vloeiend. Op het 1000 nits Liquid Retina XDR scherm zie je 1 miljard kleuren en elk detail. Heb je behoefte aan nog meer schermruimte? Dan sluit je gemakkelijk twee externe schermen aan. Over de veiligheid van je bestanden maak jij je geen zorgen. Via Touch ID log je met jouw vingerafdruk in op je MacBook zonder dat je een wachtwoord invoert. Je werkt gerust een hele dag aan je creaties, want een volledig opgeladen MacBook Pro gaat tot wel 22 uur mee.', 3050.00, 'laptops', '4GPNDDRJp92J.jpg', '2023-10-19', 'Apple', 'Laptop van Apple.'),
(7, 'Microsoft Surface Pro 9 - 13', 'De Microsoft Surface Pro 9 i7/16GB/512GB PLATINUM is een krachtige 13 inch laptop en tablet in één. Door de combinatie van de snelle en energiezuinige Intel Core i7 Evo processor en het 16 gigabyte DDR5 werkgeheugen, bewerk je grote foto- en videobestanden in Adobe programma\'s zonder vastlopers. Door het compacte formaat ga je ook onderweg aan de slag met je grafische projecten. Wanneer je klaar bent, renderen je beelden snel door de Intel Iris Xe Graphics videokaart. Bovendien heb je 2 usb C poorten met zowel usb 4.0 als Thunderbolt 4 ondersteuning, waarmee je eenvoudig een docking station en monitor aan de Surface koppelt. Met een 3:2 schermverhouding past er veel tekst op de Surface Pro 9, wat fijn leest en schrijft.', 2189.00, 'laptops', '7Mg2Ym8jWg2j.JPG', '2023-06-20', 'microsoft', 'Laptop van Microsoft.'),
(8, 'Apple iPhone 14', 'Apple iPhone 14 128GB Zwart is een alleskunner. Met de verbeterde standaard- en groothoeklens maak je nog scherpere foto\'s dan zijn voorganger, Apple iPhone 13. Daarnaast heeft de TrueDepth selfiecamera autofocus. Zo ligt de focus sneller op je gezicht en blijft het beeld bijvoorbeeld scherp als je beweegt tijdens het videobellen, ook bij weinig licht. Dankzij de krachtige A15 Bionic chip en 4 GB werkgeheugen bewerk je snel al je foto\'s en multitask je erop los. Je bewaart je foto\'s en apps op het 128 GB opslaggeheugen. Met de speciale Action Mode blijven al je video\'s stabiel als je iets opneemt waarbij je veel beweegt. Op het 6,1 inch OLED scherm kijk je in hoge kwaliteit naar al je favoriete series en films. Wil je meer schermruimte? Kies van voor iPhone 14 Plus.', 799.00, 'telefoons', '7NvvYyL04EB.JPG', '2022-11-24', 'apple', 'Telefoon van Apple.'),
(9, 'MSI MPG B550 GAMING PLUS', 'Let op: dit moederbord werkt alleen met 3e en 5e generatie AMD Ryzen processoren, met een AM4 socket, met uitzondering van de 3400G en 3200G.\r\n\r\nDe MSI MPG B550 GAMING PLUS is een moederbord voor hardcore gamers. Op het moederbord zitten veel heatsinks, waardoor warmte beter af te voeren is. Zo blijven de onderdelen zelfs onder de zwaarste belasting koel. Dit moederbord gebruik je met een AMD Ryzen processor van de 3e generatie door de AM4 socket. Ruimte voor snelle opslag is er op de 2 M.2 sloten, waarop je snelle SSDs installeert. Sluit je videokaart en tot wel 4 RAM modules aan op de verstevigde sloten. Zo blijft je moederbord recht tijdens het installeren en aansluiten. Als echt gaming moederbord heeft deze MSI ook RGB verlichting, die je zelf instelt via de software van MSI.', 125.00, 'onderdelen', 'm0Qk770Q6yNA.JPG', '2020-07-15', 'MSI', 'Gaming moederboard van MSI.'),
(10, 'ASUS RT-AX88U ', 'De Asus RT-AX88U Pro is een supersnelle router voor gamers en grote gezinnen. Dankzij de nieuwe Wireless AX-standaard kun je met deze router met meer dan 20 apparaten tegelijk online, zonder dat het netwerk vertraagt. De gaming optie geeft bovendien voorrang aan jouw favoriete online spellen, zodat je altijd zonder vertraging gamet. De router heeft een ingebouwde virusscanner die ervoor zorgt dat alle apparaten op je netwerk beschermd zijn tegen hackers en virussen. Met een maximale snelheid van 4800 Mbps heb je voldoende bandbreedte om op meerdere apparaten tegelijk een film te streamen in Ultra HD. Koppel 2 van deze routers aan elkaar met Asus AiMesh en je gaat zelfs online in iedere kamer van je huis', 259.00, 'gadgets', 'm6N1WRg9Dlkr.JPG', '2022-09-13', 'Asus', 'Snelle Wi-Fi router van Asus.'),
(11, 'A-Series USB Stick - USB 2.0 - 128 GB', 'A-Series USB-sticks zijn er voor snelle en betrouwbare gegevensoverdracht en ideale archivering van uw gegevens. De USB-aansluiting geeft altijd en overal veilig toegang tot uw gegevens. Dankzij het compacte formaat is deze USB-stick uitermate geschikt voor allerdaags gebruik en kan deze makkelijk vervoerd worden.', 12.50, 'gadgets', 'RK1q9kvG7q2q.JPG', '2023-06-06', 'A-series', 'Snelle usb 2.0.'),
(12, 'Asus TUF Gaming A16', 'Speel je favoriete games op de 16 inch Asus TUF Gaming A16 Advantage Edition FA617NS-N3085W. Met de AMD Radeon RX 7600S videokaart speel je middelzware games op minimaal 60 fps. Ook stream je bijvoorbeeld via Twitch jouw gameplay in full hd, door de 7000 serie AMD Ryzen 7 processor en het 16 gigabyte DDR5 werkgeheugen. Heb je na een tijdje meer opslagruimte nodig of wil je nog soepeler multitasken? Dan breid je de opslag of het werkgeheugen van deze Asus gemakkelijk uit. Daarnaast heeft het beeldscherm een verversingssnelheid van 165 hertz, waardoor je snel bewegende beelden vloeiend ziet. Dit is vooral handig bij snelle shooters of racespellen. Game je graag in de avond? Geen zorgen, met het verlichte toetsenbord game je ook in de avond in stijl verder.', 1199.50, 'laptops', 'Rnj0kJAPZGNq.jpg', '2019-12-19', 'Asus', 'Gaming laptop van Asus.'),
(13, 'Lenovo Legion Pro 5', 'Je speelt al je favoriete middelzware games op de 16 inch Lenovo Legion Pro 5 16IRX8 82WK00B1MH gaming laptop. Ook stream je jouw gameplay in WQXGA kwaliteit via Twitch en werk je aan game designs in zware software als Unreal Engine. Daar zijn de 13e generatie Intel Core i9 processor, het 32 gigabyte DDR5 werkgeheugen en de NVIDIA GeForce RTX 4060 videokaart krachtig genoeg voor. Tijdens het gamen zie je de snel bewegende beelden vloeiend, want deze laptop heeft een verversingssnelheid van 240 hertz. Daarnaast geniet je van scherp beeld en zie je veel details door het WQXGA beeldscherm. Bovendien zie je ook bij donkere games het beeldscherm duidelijk door de hoge helderheid van 500 nits. Game je graag in het donker? Stel jouw favoriete kleuren in op het RGB verlichte toetsenbord met 4 aanpasbare zones, zodat je in stijl verder gamet als het donker is.', 2099.00, 'laptops', 'q5A5OnAVnvx7.jpg', '2023-04-12', 'lenovo', 'Gaming laptop van Lenovo.'),
(100, 'Xbox X', 'De Xbox Series X is de snelste en krachtigste Microsoft console tot nu toe. Hij is speciaal ontwikkeld voor de nieuwe consolegeneratie waarin jij als speler centraal staat. Door de volgende eigenschappen beleef je gamen als nooit tevoren:', 419.00, 'spelcomputers', 'xbox.jpeg', '2021-01-30', 'microsoft', 'De niewste game console van microsoft!'),
(101, 'Nintendo switch', 'De Nintendo Switch-console beschikt over 32 GB aan opslagruimte en 4 GB aan werkgeheugen. Ook is hij uitgerust met een Custom NVIDIA Tegra SoC-processor en een Custom NVIDIA Tegra-grafische kaart. Deze zijn gebaseerd op de hardware van NVIDIA GeForce, die je vaak in gaming-pc\'s terugziet. De console bevat ingebouwde luidsprekers, een 720p-scherm met touchscreen en levendige kleuren, en HDTV-ondersteuning voor de beste game-ervaring. Daarnaast werkt het geheugen van de Nintendo Switch met microSDXC-, microSDHC- of microSD-geheugenkaarten. Hierdoor heb je de mogelijkheid om het geheugen uit te breiden tot wel 2 TB.', 299.00, 'spelcomputers', 'switch.webp', '2017-01-03', 'nintendo', 'De hybride gameconsole van Nintendo'),
(102, 'SAMSUNG Galaxy Z Flip4', 'Er valt zoveel te ontdekken met Galaxy Flip4, dat je natuurlijk niet wil dat je onverwachts moet stoppen. Daarom beschikt dit toestel over een 3.700mAh-batterij. Deze grote capaciteit laat jou een hele dag genieten van de mogelijkheden bij het maken en bekijken van jouw multimedia. Het 8GB-werkgeheugen en de octa-coreprocessor met Qualcomm Snapdragon-chipset zorgen voor vloeiende prestaties als je meerdere taken tegelijk uitvoert. En goed om te weten: de Samsung Galaxy Z Flip4 heeft genoeg ruimte om al jouw belangrijke momenten op te slaan, namelijk 128 GB.\r\nVan nachtfotograaf tot selfiespecialist', 1019.00, 'telefoons', 'flip.webp', '2024-01-03', 'samsung', 'Flip phone'),
(105, 'OK. OMP 50-1 BLK', 'De OK OMP 50-1 BLK is een compacte, stijlvolle flipphone met hoofdtelefoonaansluiting en kleurendisplay. Deze gsm is uitgerust met een camera van 0,08 megapixel en hij beschikt over een handige agendafunctie.', 29.50, 'telefoons', 'OK.webp', '2024-01-20', 'OK', '?');

CREATE TABLE `recensies` (
  `idrecensies` int(11) NOT NULL,
  `inhoud` varchar(250) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `recensies` (`idrecensies`, `inhoud`, `rating`, `Product_id`, `User_id`) VALUES
(1, 'Echt een top processor!', 5, 5, 91),
(3, 'meh', 3, 5, 94),
(9, 'slechtste aankoop ooit!', 1, 5, 94),
(13, 'test', 5, 5, 94),
(14, 'W\'s IN DE CHAT!', 5, 0, 92),
(15, 'wow!', 5, 5, 94);

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(500) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `surname_prefix` varchar(20) DEFAULT NULL,
  `surname` varchar(30) NOT NULL,
  `street_name` varchar(55) NOT NULL,
  `apartment_nr` varchar(20) NOT NULL,
  `postal_code` varchar(6) NOT NULL,
  `city` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`id`, `email`, `password`, `first_name`, `surname_prefix`, `surname`, `street_name`, `apartment_nr`, `postal_code`, `city`) VALUES
(91, 'banaan@banaan.nl', 'a16e29f4d035d9a1eb9a1d9ca3845a8a89a64989ff187b5193b76b2f7061ad85cc6684d74c32e362d09446d309e8cc35bdf202239e06559ff4869cd737111aa1', 'banaan', '', 'banaan', 'banaan', '1', '1234HB', 'banaan'),
(92, 'willy@gmail.com', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'wiljan', '', 'verhoeven', 'test', '1', '1234HB', 'test'),
(94, 'test@test.nl', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', 'test', '', 'test', 'test', '1', '1234HB', 'test'),
(97, 't@hotmail.com', '99f97d455d5d62b24f3a942a1abc3fa8863fc0ce2037f52f09bd785b22b800d4f2e7b2b614cb600ffc2a4fe24679845b24886d69bb776fcfa46e54d188889c6f', 't', '', 't', 't', 't', '1234HB', 't'),
(99, 'ben@appel.nl', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'ben', '', 'appel', 'a', '1', '1234HB', 'a');


ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Orders_User1_idx` (`user_id`);

ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`orders_id`,`product_id`),
  ADD KEY `fk_Orders_has_Product_Product1_idx` (`product_id`),
  ADD KEY `fk_Orders_has_Product_Order_idx` (`orders_id`);

ALTER TABLE `producten`
  ADD PRIMARY KEY (`productid`);

ALTER TABLE `recensies`
  ADD PRIMARY KEY (`idrecensies`,`Product_id`,`User_id`),
  ADD KEY `fk_recensies_Product_idx` (`Product_id`),
  ADD KEY `fk_recensies_User1_idx` (`User_id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

ALTER TABLE `recensies`
  MODIFY `idrecensies` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;


ALTER TABLE `orders`
  ADD CONSTRAINT `fk_Orders_User1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `orders_item`
  ADD CONSTRAINT `fk_Orders_has_Product_Orders` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Orders_has_Product_Product1` FOREIGN KEY (`product_id`) REFERENCES `producten` (`productid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `recensies`
  ADD CONSTRAINT `fk_recensies_Product` FOREIGN KEY (`Product_id`) REFERENCES `producten` (`productid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recensies_User1` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
