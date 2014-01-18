-- Dumping data for table `Adressen`

INSERT INTO `Adressen` (`ID`, `Street`, `Number`, `PostalCode`, `City`) VALUES
(1, 'Ostring', '17', '3006', 'Bern'),
(2, 'some', '2', '2000', 'where'),
(9, 'street', '42', '1000', 'Buchs');

-- Dumping data for table `Kunden`

INSERT INTO `Kunden` (`ID`, `FirstName`, `LastName`, `EMail`, `Password`, `PhoneNumber`, `LastFmUser`, `AddressID`) VALUES
(1, 'Marko', 'Bublic', 'bublm1@bfh.ch', '$2y$10$pH1J8hHTTCtFCVr7JtwubOKpJwzR.d6whEoetsQAyuEv5pqfWwXGW', '079 123 45 67', 'uzapy', 1),
(2, 'some', 'one', 'some@one.com', '$2y$10$xQ.0fWnpONHlwlSISYbBjebjNrNxqmB6JRop5tRo5cuLNQMWfh6ky', '031 987 65 43', 'someone', 2),
(13, 'first', 'last', 'my@mail.com', '$2y$10$COnubU/sf0tUwn278Tsy3er9FGdpAgBhyRxGO5JdJDhOLRtxrMbQq', '022 234 45 56', 'sdf', 9);

-- Dumping data for table `Bestellungen`

INSERT INTO `Bestellungen` (`ID`, `KundenID`, `PaymentMethod`, `ShippingMethod`, `BillingAddressID`, `IsShipped`) VALUES
(4, 1, 'Postpaket', 'Rechnung', 1, 1),
(5, 1, 'Economy', 'Kreditkarte', 1, 1),
(34, 1, 'Economy', 'Kreditkarte', 1, 1),
(35, 1, 'Postpaket', 'Rechnung', 1, 1),
(36, 1, 'Postpaket', 'Rechnung', 1, 1),
(37, 1, 'Postpaket', 'Rechnung', 1, 1),
(38, 1, 'Postpaket', 'Kreditkarte', 1, 1),
(39, 1, 'Postpaket', 'Rechnung', 1, 1),
(40, 1, 'Postpaket', 'Rechnung', 1, 1),
(41, 1, 'Postpaket', 'Rechnung', 1, 1),
(42, 1, 'Postpaket', 'Rechnung', 1, 1),
(43, 1, 'Postpaket', 'PostFinance', 1, 1),
(44, 1, 'DeFex Express', 'Kreditkarte', 1, 1);

-- Dumping data for table `Platten`

INSERT INTO `Platten` (`ID`, `Artist`, `Album`, `Year`, `Country`, `Genre`, `Style`, `Label`, `Number`, `CoverName`, `Price`) VALUES
(1, 'Queens of the Stone Age', 'Songs for the Deaf', 2002, 'USA', 'Rock', 'Stoner Rock, Alternative Metal, Hard Rock', 'Interscope', '493 440-0', 'Queens_of_the_Stone_Age_-_Songs_for_the_Deaf.png', 29.90),
(2, 'Foo Fighters', 'One by One', 2002, 'USA', 'Rock', 'Alternative Rock, Post-Grunge', 'RCA', '07863 68008-1', 'Foo_Fighters_-_One_by_One.jpg', 29.90),
(3, 'Method Man & Redman', 'Blackout!', 1999, 'USA', 'Hip Hop', 'East Coast', 'Def Jam', '314 546 609-2', 'Method_Man_&_Redman_-_Blackout!.jpg', 35.00),
(4, 'Black Rebel Motorcycle Club', 'Howl', 2005, 'USA', 'Rock', 'Alternative Rock, Garage Rock Revival, Americana', 'RCA', '82876 71601 2', 'Black_Rebel_Motorcycle_Club_-_Howl.jpg', 25.00),
(5, 'Kings of Convenience', 'Declaration of Dependence', 2009, 'Norwegen', 'Indie Pop', 'Folk, Folk Rock, Adult Pop', 'Virgin', '50999 3 06840 1 0', 'Kings_of_Convenience_-_Declaration_of_Dependence.jpg', 25.00),
(6, 'Them Crooked Vultures', 'Them Crooked Vultures', 2009, 'USA', 'Rock', 'Alternative Rock, Psychedelic Rock, Hard Rock', 'Interscope', 'B0013785-01', 'Them_Crooked_Vultures_-_Them_Crooked_Vultures.png', 25.00),
(7, 'Shameboy', 'Heartcore', 2008, 'Belgien', 'Electronic', 'Techno, Electro', '541', '541416 502165', 'Shameboy_-_Heartcore.jpg', 36.00),
(8, '22-20s', '22-20s', 2004, 'England', 'Rock', ' Blues Rock, Indie Rock', 'Heavenly', 'HVNLP 51LP', '22-20s_-_22-20s.jpg', 39.00),
(9, 'The Raconteurs', 'Consolers of the Lonely', 2008, 'USA', 'Rock', 'Alternative Rock, Indie Rock', 'Third Man Records', '456060-1', 'The_Raconteurs_-_Consolers_of_the_Lonely.jpg', 29.90),
(10, 'Radiohead', 'OK Computer', 1997, 'England', 'Rock', 'Alternative Rock, Electronic', 'Parlophone', '7243 8 55229 1 8', 'Radiohead_-_OK_Computer.jpg', 35.40),
(11, 'Infadels', 'We Are Not The Infadels', 2006, 'England', 'Rock', 'Electro, Indie Rock', 'Wall Of Sound', 'WALL LP 036', 'Infadels_-_We_Are_Not_The_Infadels.jpg', 30.00),
(12, 'Phillip Morris', 'The Process of Addiction Has it''s Costs', 2008, 'USA', 'Hip Hop', 'Conscious, Alternative Hip Hop, Political Rap', 'Second Hand Music', '', 'Phillip_Morris_-_The_Process_of_Addiction_Has_its Costs.jpg', 29.00),
(13, 'Muse', 'Origin of Symmetry', 2001, 'England', 'Rock', 'Alternative Rock,\r\nSpace Rock, Progressive Metal', 'Mushroom', 'MUSH93LP', 'Muse_-_Origin_of_Symmetry.jpg', 27.00),
(14, 'Lilly Allen', 'It''s Not Me, It''s You', 2009, 'England', 'Pop', 'Synth-Pop, Electronic, Indie Pop', 'Regal', 'REG 151LP', 'Lilly_Allen_-_Its_Not_Me_Its_You.jpg', 19.00),
(15, 'Adam Green', 'Gemstones', 2005, 'USA', 'Anti-Folk', 'Alternative Country, Folk Rock, Avantgarde, Indie Rock', 'Rough Trade', 'RTRADLP194', 'Adam_Green_-_Gemstones.png', 25.00),
(16, 'The Hives', 'Tyrannosaurus Hives', 2004, 'Schweden', 'Rock', 'Garage Rock, Indie Rock, Punk', 'Interscope', 'B0002756-01', 'The_Hives_-_Tyrannosaurus_Hives.jpg', 29.90),
(17, 'Arctic Monkeys', 'Whatever People Say I Am, That''s What I''m Not', 2006, 'England', 'Rock', 'Indie Rock, Garage Rock', 'Domino', 'WIGLP162', 'Arctic_Monkeys_-_Whatever_People_Say_I_Am,_Thats_What_Im_Not.jpg', 26.75),
(18, 'Green Day', 'Nimrod', 1997, 'USA', 'Rock', 'Punk Rock, Alternative Rock, Pop Punk', 'Reprise', '9362-46794-1', 'Green_Day_-_Nimrod.jpg', 38.00),
(19, 'Justice', 'Cross', 2007, 'Frankreich', 'Electronic', 'Electro, Electro House, Disco House, Tech House', 'Ed Banger', 'BEC5772110', 'Justice_-_Cross.jpg', 19.00),
(20, 'Eminem', 'The Slim Shady LP', 1999, 'USA', 'Hip Hop', 'Rap', 'Interscope', 'INT2-90287', 'Eminem_-_The_Slim_Shady_LP.jpg', 25.00),
(21, 'Ršyksopp', 'Junior', 2009, 'Norwegen', 'Electronic', 'Synthpop, Alternative Dance, Downtempo, House, Breaks', 'EMI', '50999 6939081 4', 'Royksopp_-_Junior.png', 25.00),
(22, 'Gorillaz', 'Demon Days', 2005, 'England', 'Alternative', 'Electronic, Hip Hop, Rock, Trip Hop, Lo-Fi, Brit Pop, Downtempo, Alternative Rock, Alternative Hip Hop', 'Parlophone', '07243 873838 1 4', 'Gorillaz_-_Demon_Days.png', 25.00),
(23, 'The Chemical Brothers', 'Come with Us', 2002, 'England', ' Electronic', 'Big beat, Electronica, Acid House, Breakbeat, House', 'Virgin', '7243 8 11682 1 9', 'The_Chemical_Brothers_-_Come_with_Us.jpg', 29.90),
(24, 'Amy Winehouse', 'Back to Black', 2006, 'England', ' R&B', 'Jazz, Funk, Soul, Pop', 'Universal', 'B0008994-01', 'Amy_Winehouse_-_Back_to_Black.jpg', 24.30),
(25, 'Coldpplay', 'X&Y', 2005, 'England', 'Rock', 'Britpop, Alternative Rock', 'Parlophone', '7243 4 74786 1 1', 'Coldplay_-_X&Y.jpg', 21.40),
(26, 'Wolfmother', 'Wolfmother', 2005, 'Australien', 'Rock', 'Hard Rock, Stoner Rock, Heavy Metal, Psychedelic Rock', 'Modular', '9855004', 'Wolfmother_-_Wolfmother.jpg', 29.90),
(27, 'Paul Kalkbrenner', 'Berlin Calling Official Soundtrack', 2008, 'Deutschland', 'Electronic', 'Techno, Electro, Tech House', 'Bpitch Control', 'BPC 185', 'Paul_Kalkbrenner_-_Berlin_Calling_Official_Soundtrack.jpg', 29.90),
(28, 'The White Stripes', 'White Blood Cells', 2001, 'USA', 'Rock', 'Indie Rock, Garage Rock, Alternative rock, Punk Blues', 'Sympathy For The Record Industry', 'SFTRI660', 'The_White_Stripes_-_White_Blood_Cells.jpg', 41.25),
(29, 'Kings of Leon', 'Youth & Young Manhood', 2003, 'USA', 'Rock', 'Blues Rock, Southern Rock, Garage Rock', 'RCA', '82876 52394-2', 'Kings_of_leon_-_Youth_&_Young_Manhood.jpg', 29.90),
(30, 'Spinnerette', 'Spinnerette', 2009, 'USA', 'Rock', 'Indie Rock, Alternative Rock, Punk', 'Anthem Entertainment', '668252116 1', 'Spinnerette_-_Spinnerette.jpg', 25.00),
(31, 'Thom Yorke', 'The Eraser', 2006, 'England', 'Electronic, Rock', 'Art Rock, Electro, IDM, Experimental', 'XL Recordings', 'XLLP200', 'Thom_Yorke_-_The_Eraser.jpg', 34.55),
(32, 'Santigold', 'Santogold', 2008, 'USA', 'Alternative', 'Electronic, Hip Hop, Rock, Dub, Indie Rock, Experimental, Reggae Fusion, Electronica', 'Downtown Music', 'DWT1-70034-B', 'Santigold_-_Santogold.jpg', 28.75),
(33, 'Melissa auf der Maur', 'Out of Our Minds', 2010, 'Kanada', 'Rock', 'Alternative Rock', 'Roadrunner', 'RR 7776-1', 'Melissa_auf_der_Maur_-_Out_of_Our_Minds.jpg', 19.90),
(34, 'Beastie Boys', 'Hello Nasty', 1998, 'USA', 'Hip Hop', 'Alternative Hip Hop, Rap Rock, Jazz, Rock, Fusion', 'Grand Royal', 'GR061', 'Beastie_Boys_-_Hello_Nasty.jpg', 45.00),
(35, 'Mumford & Sons', 'Sigh No More', 2009, 'England', 'Folk Rock', 'Folk, Rock, Pop, Indie Folk, Bluegrass', 'Island', '2716932', 'Mumford_&_Sons_-_Sigh_No_More.jpg', 25.00),
(36, 'Terrorgruppe', 'Blechdose', 2002, 'Deutschland', 'Rock', 'Punk Rock, Ska', 'Destiny', 'DESTINY 106', 'Terrorgruppe_-_Blechdose.jpg', 39.90),
(37, 'The Strokes', 'Is This It', 2001, 'USA', 'Indie Rock', 'Garage Rock, Alternative Rock', 'RCA', '07863 68045 1', 'The_Strokes_-_Is_This_It.png', 36.00),
(38, 'Mani Matter', 'Dr Kolumbus', 1977, 'Schweiz', 'Folk', 'Troubadour, Singer-Songwriter', 'Zytglogge', 'ZYT 35', 'Mani_Matter_-_Dr_Kolumbus.jpg', 120.00),
(39, 'Boy', 'Mutual Friends', 2011, 'Deutschland', 'Pop', 'Indie Pop, Indie Folk', 'Gršnland', 'LPGRON118', 'Boy_-_Mutual_Friends.jpg', 25.00),
(40, 'The Prodigy', 'The Fat of the Land', 1997, 'England', 'Electronic', ' Breakbeat, Breaks, Big Beat, Alternative Dance, Dance Rock', 'XL Recordings', 'XLLP 121', 'The_Prodigy_-_The_Fat_of_the_Land.jpg', 35.50);

-- Dumping data for table `Platten_Bestellungen`

INSERT INTO `Platten_Bestellungen` (`PlattenID`, `BestellungID`, `WithDigitalDownload`, `Anzahl`) VALUES
(1, 42, 1, 2),
(2, 41, 0, 1),
(2, 43, 1, 1),
(4, 35, 1, 1),
(5, 39, 1, 1),
(6, 44, 0, 1),
(12, 34, 1, 2),
(13, 5, 1, 3),
(20, 39, 0, 2),
(29, 37, 1, 1),
(29, 43, 0, 1),
(30, 42, 0, 1),
(32, 36, 0, 1),
(35, 39, 0, 1),
(35, 44, 1, 1),
(37, 4, 1, 2),
(38, 38, 0, 1);
