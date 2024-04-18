INSERT INTO `zip_codes` (`zip_code`, `city`) VALUES
(6000, 'Kolding');

INSERT INTO `school` (`school_ID`, `school_name`, `school_adress`, `school_zip`, `school_phone`, `school_email`, `school_page`) VALUES
(1, 'Hansenberg', 'Skovvangen 28', 6000, '79 32 01 00', 'hansenberg@email.dk', 'hansenberg.dk');

INSERT INTO `user_type` (`user_type_ID`, `name`, `permissions`) VALUES
(1, 'student', '{"edit_homework":0, "edit_submissions":0, "create_schedule":0, "administrate_site":0}'),
(2, 'teacher', '{"edit_homework":1, "edit_submissions":1, "create_schedule":1, "administrate_site":0}'),
(3, 'scheduler', '{"edit_homework":0, "edit_submissions":0, "create_schedule":1, "administrate_site":0}'),
(4, 'censor', '{"edit_homework":0, "edit_submissions":1, "create_schedule":1, "administrate_site":0}'),
(5, 'admin', '{"edit_homework":0, "edit_submissions":0, "create_schedule":0, "administrate_site":1}');


INSERT INTO `users` (`uid`, `user_type_ID`, `school_ID`, `name`, `initials`, `email`, `password`, `date_created`) VALUES
(1, 1, 1, 'Gunnar Máni Jóhannsson', 'GMJ', 'gunnarmani@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(2, 4, 1, 'Mads Madsen', 'MM', 'madsmadsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(3, 1, 1, 'Birgitte Jensen', 'BJ', 'birgittejensen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(4, 1, 1, 'Emma Olsen', 'EO', 'emmaolsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(5, 1, 1, 'Liam Nielsen', 'LN', 'liamnielsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(6, 1, 1, 'Olivia Pedersen', 'OP', 'oliviapedersen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(7, 1, 1, 'Noah Rasmussen', 'NR', 'noahrasmussen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(8, 1, 1, 'Alma Christensen', 'AC', 'almachristensen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(9, 1, 1, 'William Jensen', 'WJ', 'williamjensen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(10, 1, 1, 'Agnes Eriksen', 'AE', 'agneseriksen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(11, 1, 1, 'Arthur Andersen', 'AA', 'arthurandersen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(12, 1, 1, 'Astrid Mikkelsen', 'AM', 'astridmikkelsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(13, 1, 1, 'Benjamin Hansen', 'BH', 'benjaminhansen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(14, 1, 1, 'Carla Larsen', 'CL', 'carlalarsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(15, 1, 1, 'David Sørensen', 'DS', 'davidsorensen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(16, 1, 1, 'Ella Christiansen', 'EC', 'ellachristiansen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(17, 1, 1, 'Frederik Thomsen', 'FT', 'frederikthomsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(18, 1, 1, 'Greta Poulsen', 'GP', 'gretapoulsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(19, 1, 1, 'Hans Larsen', 'HL', 'hanslarsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(20, 1, 1, 'Ida Nielsen', 'IN', 'idanielsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(21, 1, 1, 'Jonas Madsen', 'JM', 'jonasmadsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(22, 1, 1, 'Klara Jensen', 'KJ', 'klarajensen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(23, 1, 1, 'Lars Andersen', 'LA', 'larsandersen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(24, 1, 1, 'Maja Mikkelsen', 'MM', 'majamikkelsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(25, 1, 1, 'Nikolaj Pedersen', 'NP', 'nikolajpedersen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),

(26, 2, 1, 'Eva Jensen', 'EJ', 'evajensen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(27, 2, 1, 'Anders Nielsen', 'AN', 'andersnielsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(28, 2, 1, 'Karen Pedersen', 'KP', 'karenpedersen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(29, 2, 1, 'Peter Larsen', 'PL', 'peterlarsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(30, 2, 1, 'Maria Mikkelsen', 'MM', 'mariamikkelsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(31, 2, 1, 'Jesper Christensen', 'JC', 'jesperchristensen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(32, 2, 1, 'Louise Hansen', 'LH', 'louisehansen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(33, 2, 1, 'Thomas Olsen', 'TO', 'thomasolsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(34, 2, 1, 'Camilla Andersen', 'CA', 'camillaandersen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(35, 2, 1, 'Michael Jensen', 'MJ', 'michaeljensen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(36, 2, 1, 'Sofie Kristensen', 'SK', 'sofiekristensen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(37, 2, 1, 'Ole Rasmussen', 'OR', 'olerasmussen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(38, 2, 1, 'Sara Nielsen', 'SN', 'saranielsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(39, 2, 1, 'Jakob Madsen', 'JM', 'jakobmadsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(40, 2, 1, 'Torsten Skov Fix', 'thfi', 'torstenskov@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),

(41, 4, 1, 'Lars Larsen', 'LL', 'larslarsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),

(42, 5, 1, 'Lotte Christensen', 'LC', 'lottechristensen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21');

INSERT INTO `class` (`class_ID`, `school_ID`, `class_name`, `class_teacher_ID`) VALUES
(1, 1, '1U', 26),
(2, 1, '1V', 27),
(3, 1, '2Z', 28),
(4, 1, '2X', 29),
(5, 1, '3Y', 30),
(6, 1, '3Z', 31),
(7, 1, '1X', 32),
(8, 1, '2V', 33),
(9, 1, '3U', 40),
(10, 1, '1Y', 35);

INSERT INTO `student_class` (`student_ID`, `class_ID`) VALUES
(1, 9),
(2, 9),
(3, 9),
(4, 9),
(5, 9),
(6, 9),
(7, 9),
(8, 9),
(9, 9),
(10, 9),
(11, 1),
(12, 2),
(13, 3),
(14, 4),
(15, 5),
(16, 6),
(17, 7),
(18, 8),
(19, 10),
(20, 10),
(21, 3),
(22, 4),
(23, 5),
(24, 6),
(25, 7);

INSERT INTO `subject` (`subject_ID`, `school_ID`, `subject_name`, `subject_color`) VALUES
(1, 1, 'Matematik C', '#FFE3C9'), -- Light orange
(2, 1, 'Matematik B', '#FFE3C9'), -- Light orange
(3, 1, 'Matematik A', '#FFE3C9'), -- Light orange
(4, 1, 'Dansk C', '#CCFFF6'), -- Light blue
(5, 1, 'Dansk B', '#CCFFF6'), -- Light blue
(6, 1, 'Dansk A', '#CCFFF6'), -- Light blue
(7, 1, 'Engelsk C', '#C8FFCD'), -- Light green
(8, 1, 'Engelsk B', '#C8FFCD'), -- Light green
(9, 1, 'Engelsk A', '#C8FFCD'), -- Light green
(10, 1, 'Idehistorie C', '#FFD9CC'), -- Light peach
(11, 1, 'Idehistorie B', '#F6CCFF'), -- Light purple
(12, 1, 'Idehistorie A', '#E3C9FF'), -- Light lavender
(13, 1, 'Programmering C', '#CDFFEC'), -- Light mint
(14, 1, 'Programmering B', '#CDFFEC'), -- Light mint
(15, 1, 'Programmering A', '#CDFFEC'), -- Light mint
(16, 1, 'Fysik C', '#FFD9E3'), -- Light rose
(17, 1, 'Fysik B', '#FFD9E3'), -- Light rose
(18, 1, 'Fysik A', '#FFD9E3'), -- Light rose
(19, 1, 'Kemi C', '#CDF6FF'), -- Light cyan
(20, 1, 'Kemi B', '#CDF6FF'), -- Light cyan
(21, 1, 'Kemi A', '#CDF6FF'), -- Light cyan
(22, 1, 'Biologi C', '#ECFFD9'), -- Light lime
(23, 1, 'Biologi B', '#ECFFD9'), -- Light lime
(24, 1, 'Biologi A', '#ECFFD9'), -- Light lime
(25, 1, 'Samfundsfag C', '#FFE3C9'), -- Light orange
(26, 1, 'Samfundsfag B', '#FFE3C9'), -- Light orange
(27, 1, 'Samfundsfag A', '#FFE3C9'), -- Light orange
(28, 1, 'Idræt C', '#CCFFF6'), -- Light blue
(29, 1, 'Idræt B', '#CCFFF6'), -- Light blue
(30, 1, 'Idræt A', '#CCFFF6'), -- Light blue
(31, 1, 'Teknologi C', '#C8FFCD'), -- Light green
(32, 1, 'Teknologi B', '#C8FFCD'), -- Light green
(33, 1, 'Teknologi A', '#C8FFCD'), -- Light green
(34, 1, 'Teknikfag (DDU) A', '#FFD9CC'), -- Light peach
(35, 1, 'Teknikfag (byg og hyg) A', '#FFD9CC'), -- Light peach
(36, 1, 'Teknikfag (Process) A', '#FFD9CC'), -- Light peach
(37, 1, 'Kommunikation og IT C', '#F6CCFF'), -- Light purple
(38, 1, 'Kommunikation og IT B', '#F6CCFF'), -- Light purple
(39, 1, 'Kommunikation og IT A', '#F6CCFF'), -- Light purple
(40, 1, 'Geografi C', '#E3C9FF'), -- Light lavender
(41, 1, 'Historie C', '#E3C9FF'), -- Light lavender
(42, 1, 'Psykologi B', '#E3C9FF'); -- Light lavender

INSERT INTO `subject_class` (`subject_class_ID`, `subject_ID`, `class_ID`, `subject_teacher_ID`) VALUES
(1, 1, 1, 26),
(2, 2, 2, 27),
(3, 3, 3, 28),
(4, 4, 4, 29),
(5, 5, 5, 30),
(6, 6, 6, 31),
(7, 7, 7, 32),
(8, 8, 8, 33),
(9, 9, 9, 34),
(10, 10, 10, 35),
(11, 11, 1, 36),
(12, 12, 2, 37),
(13, 13, 3, 38),
(14, 14, 4, 39),
(15, 15, 5, 40),
(16, 16, 6, 26),
(17, 17, 7, 27),
(18, 18, 8, 28),
(19, 19, 9, 29),
(20, 20, 10, 30),
(21, 21, 1, 31),
(22, 22, 2, 32),
(23, 23, 3, 33),
(24, 24, 4, 34),
(25, 25, 5, 35),
(26, 26, 6, 36),
(27, 27, 7, 37),
(28, 28, 8, 38),
(29, 29, 9, 39),
(30, 30, 10, 40),
(31, 31, 1, 26),
(32, 32, 2, 27),
(33, 33, 3, 28),
(34, 34, 4, 29),
(35, 35, 5, 30),
(36, 36, 6, 31),
(37, 37, 7, 32),
(38, 38, 8, 33),
(39, 39, 9, 34),
(40, 40, 10, 35),
(41, 41, 1, 36),
(42, 42, 2, 37);

INSERT INTO `subject_class_sections` (`section_ID`, `subject_class_ID`, `section_name`, `section_description`, `parent_section_ID`) VALUES
(43, 6, '2. UNGE I DAGENS MEDIEBILLEDE (SERIEANALYSE)', 'Vores brug af sproget kan variere på utroligt mange måder og med lige så mange forskellige betydninger til følge. I valg af enkelte ord kan du vælge at udtrykke dig med idiomer, metaforer, låneord, dialekt og meget andet og i konstruktionen af sætninger kan du gå fra det helt korte til sætninger på mange linjer. Effekterne kan være alt fra, at du giver dit sprog mere liv, til at du virker cool eller gør, at din modtager bedre forstår, hvad du siger. I dette forløb skal vi udforske forskellige måder at variere sproget på i alt fra stand up-shows og satire til holdningskampagner, sangtekster og romanuddrag.', 6),
(44, 1, '1. Grundlæggende algebra', 'Introduktion til grundlæggende algebraiske begreber og metoder.', 1),
(45, 1, '2. Lineære funktioner', 'Gennemgang af lineære funktioner og deres anvendelser i matematikken.', 1),
(46, 1, '3. Geometri og trigonometri', 'Udforskning af geometriske figurer og trigonometriske relationer.', 1),
(47, 2, '1. Differentialregning', 'Indføring i differentialregningens grundlæggende principper.', 2),
(48, 2, '2. Integralregning', 'Gennemgang af integralregning og dens anvendelser.', 2),
(49, 3, '1. Differentialligninger', 'Studie af differentialligninger og deres løsninger.', 3),
(50, 4, '1. Analyse af skønlitteratur', 'Analyse af skønlitterære tekster og deres temaer.', 4),
(51, 5, '1. Kommunikation og retorik', 'Studie af kommunikationsteori og retoriske virkemidler.', 5),
(52, 5, '2. Analyse af non-fiktionstekster', 'Analyse af non-fiktionelle tekster og deres argumentation.', 5),
(53, 6, '1. Litteraturhistorie', 'Gennemgang af dansk litteraturhistorie og dens udvikling.', 6),
(54, 6, '2. Analyse og fortolkning', 'Analyse og fortolkning af litterære tekster fra forskellige perioder.', 6),
(55, 7, '1. Engelsk grammatik', 'Gennemgang af engelsk grammatik og syntaks.', 7),
(56, 8, '1. Engelsk litteratur', 'Studie af engelsksprogede litterære værker og deres temaer.', 8),
(57, 9, '1. Engelsk kultur og samfund', 'Undersøgelse af engelsk kultur, samfund og historie.', 9),
(58, 10, '1. Filosofihistorie', 'Gennemgang af filosofiens historie og dens centrale begreber.', 10),
(59, 11, '1. Religionshistorie', 'Studie af religioners historie og deres indflydelse på samfundet.', 11),
(60, 11, '2. Politisk historie', 'Gennemgang af politiske ideologiers historie og udvikling.', 11),
(61, 12, '1. Kulturhistorie', 'Analyse af kulturelle strømninger og deres betydning i historien.', 12),
(62, 13, '1. Introduktion til programmering', 'Grundlæggende principper for programmering og algoritmer.', 13),
(63, 14, '1. Objektorienteret programmering', 'Studie af objektorienterede programmeringskoncepter.', 14),
(64, 15, '1. Softwareudvikling', 'Udvikling af softwareapplikationer og systemer.', 15),
(65, 16, '1. Mekanik', 'Gennemgang af mekanikkens love og principper.', 16),
(66, 17, '1. Elektricitet og magnetisme', 'Studie af elektriske felter, strømme og magnetiske fænomener.', 17),
(67, 18, '1. Termodynamik', 'Undersøgelse af termodynamikkens love og termer.', 18),
(68, 19, '1. Grundlæggende kemi', 'Introduktion til grundlæggende kemi og atommodeller.', 19),
(69, 20, '1. Organisk kemi', 'Studie af organiske forbindelser og deres struktur og egenskaber.', 20),
(70, 21, '1. Kvantekemi', 'Gennemgang af kvantemekanikkens principper og deres anvendelser i kemi.', 21),
(71, 22, '1. Molekylærbiologi', 'Studie af cellers struktur og funktion på molekylært niveau.', 22),
(72, 23, '1. Økologi', 'Undersøgelse af økosystemers struktur, dynamik og interaktioner.', 23),
(73, 24, '1. Evolution og genetik', 'Gennemgang af evolutionens mekanismer og genetikkens grundlæggende principper.', 24),
(74, 25, '1. Politisk teori', 'Studie af politiske teorier og ideologiers betydning i samfundet.', 25),
(75, 26, '1. Samfundsforhold og globalisering', 'Analyse af samfundsforhold og globaliseringsprocesser.', 26),
(76, 27, '1. Sociale strukturer og ulighed', 'Undersøgelse af sociale strukturer og uligheder i samfundet.', 27),
(77, 28, '1. Bevægelseslære', 'Gennemgang af kroppens bevægelsesmønstre og biomekanik.', 28),
(78, 29, '1. Sundhed og motion', 'Studie af sundhed og fysisk aktivitet i relation til idrætspraksis.', 29),
(79, 30, '1. Træningslære og præstationsoptimering', 'Analyse af træningsprincipper og præstationsoptimering inden for idræt.', 30),
(80, 31, '1. Teknologiens historie', 'Gennemgang af teknologiens historiske udvikling og betydning.', 31),
(81, 32, '1. Produktudvikling', 'Studie af produktudviklingsprocesser og innovationsteknikker.', 32),
(82, 33, '1. Bæredygtig teknologi', 'Analyse af bæredygtige teknologiske løsninger og deres indvirkning på samfundet.', 33),
(83, 34, '1. Digital design og udvikling', 'Udvikling af digitale designs og interaktive medier.', 34),
(84, 35, '1. Bygningskonstruktion', 'Studie af bygningskonstruktionsprincipper og materialevalg.', 35),
(85, 36, '1. Procesoptimering', 'Analyse af produktionsprocesser og optimering af arbejdsgange.', 36),
(86, 37, '1. Digital kommunikation', 'Studie af digitale kommunikationsplatforme og medieanalyse.', 37),
(87, 38, '1. Visuel kommunikation', 'Gennemgang af visuel kommunikationsdesign og æstetik.', 38),
(88, 39, '1. Interaktionsdesign', 'Analyse af brugerinteraktion og design af interaktive systemer.', 39),
(89, 40, '1. Naturgeografi', 'Undersøgelse af naturfænomener og landskabsdannelse.', 40),
(90, 41, '1. Verdenshistorie', 'Gennemgang af verdenshistoriens centrale begivenheder og udviklingstræk.', 41),
(91, 42, '1. Personlighedspsykologi', 'Studie af personlighedsudvikling og psykologiske teorier.', 42);

INSERT INTO `homework` (`section_ID`, `homework_title`, `homework_description`, `due_date`, `immersion_time`, `assigned_by`, `important`, `group_work`) VALUES
(1, 'Algebraiske Ligninger', 'Løs de givne algebraiske ligninger.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 1), 1, 0),
(2, 'Analyse af Lineære Funktioner', 'Analyser adfærden af lineære funktioner.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 2), 0, 0),
(4, 'Udforskning af Integralregning', 'Udforsk begreberne inden for integralregning.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 4), 1, 1),
(5, 'Analyse af Litterære Tekster', 'Analyser de givne litterære tekster og diskuter deres temaer.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 5), 0, 0),
(6, 'Forståelse af Trigonometriske Relationer', 'Forstå og løs trigonometriske relationer.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 6), 1, 0),
(8, 'Skrivning af Overbevisende Essays', 'Skriv overbevisende essays om de angivne emner.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 8), 0, 0),
(9, 'Analyse af Faktatekster', 'Analyser faktatekster og deres argumentation.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 9), 1, 0),
(10, 'Analyse af Historiske Perioder', 'Analyser historiske perioder og deres indvirkning på samfundet.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 10), 0, 1),
(12, 'Forståelse af Engelsk Grammatik', 'Forstå de grammatikalske strukturer i engelske sætninger.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 12), 1, 0),
(13, 'Udforskning af Engelsk Litteratur', 'Udforsk temaerne og motiverne i engelske litterære værker.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 13), 0, 0),
(14, 'Forståelse af Engelsk Kultur', 'Forstå forskellige aspekter af engelsk kultur og samfund.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 14), 1, 1),
(16, 'Analyse af Mekanisk Bevægelse', 'Analyser bevægelsen af objekter i henhold til mekaniske principper.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 16), 0, 0),
(18, 'Analyse af Sociale Strukturer', 'Analyser de sociale strukturer og uligheder i samfundet.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 18), 1, 0),
(19, 'Design af Digitale Løsninger', 'Design digitale løsninger til virkelighedsproblemer.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 19), 0, 0),
(21, 'Udforskning af Softwareudvikling', 'Udforsk principperne og praksis med softwareudvikling.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 21), 1, 1),
(22, 'Studie af Molekylær Biologi', 'Studie af de molekylære mekanismer bag biologiske processer.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 22), 0, 1),
(24, 'Analyse af Kemiske Reaktioner', 'Analyser kemiske reaktioner og deres kinetik.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 24), 1, 0),
(26, 'Analyse af Samfundsøkonomiske Tendenser', 'Analyser aktuelle samfundsøkonomiske tendenser og deres konsekvenser.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 26), 0, 1),
(27, 'Udforskning af Globalisering', 'Udforsk fænomenet globalisering og dens virkninger.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 27), 1, 0),
(28, 'Forståelse af Sociale Strukturer', 'Forstå de sociale strukturer og hierarkier til stede i samfundet.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 28), 0, 0),
(30, 'Studie af Sundhed og Velvære', 'Studie af begreberne sundhed og velvære og deres fremme.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 30), 1, 0),
(31, 'Udforskning af Politiske Ideologier', 'Udforsk forskellige politiske ideologier og deres konsekvenser.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 31), 0, 1),
(33, 'Forståelse af Bæredygtige Teknologier', 'Forstå principperne og anvendelserne af bæredygtige teknologier.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 33), 1, 1),
(34, 'Design af Digitale Brugergrænseflader', 'Design brugervenlige digitale brugergrænseflader til forskellige applikationer.', DATE_ADD(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY), FLOOR(RAND() * 6), (SELECT subject_teacher_ID FROM subject_class WHERE subject_class_ID = 34), 0, 0);

INSERT INTO `groups` (`homework_ID`, `group_name`) VALUES
(3, 'Gruppe 1'),
(3, 'Gruppe 2'),
(3, 'Gruppe 3'),
(8, 'Gruppe 1'),
(8, 'Gruppe 2'),
(8, 'Gruppe 3'),
(11, 'Gruppe 1'),
(11, 'Gruppe 2'),
(11, 'Gruppe 3'),
(11, 'Gruppe 4'),
(15, 'Gruppe 1'),
(15, 'Gruppe 2'),
(15, 'Gruppe 3'),
(16, 'Gruppe 1'),
(16, 'Gruppe 2'),
(16, 'Gruppe 3'),
(18, 'Gruppe 1'),
(18, 'Gruppe 2'),
(18, 'Gruppe 3'),
(18, 'Gruppe 4'),
(22, 'Gruppe 1'),
(22, 'Gruppe 2'),
(22, 'Gruppe 3'),
(23, 'Gruppe 1'),
(23, 'Gruppe 2'),
(23, 'Gruppe 3');

INSERT INTO `file_types` (`file_type_ID`, `file_type`, `extension`) VALUES
(1, 'PDF', 'pdf'),
(2, 'Word', 'docx'),
(3, 'Excel', 'xlsx'),
(4, 'PowerPoint', 'pptx'),
(5, 'Text', 'txt'),
(6, 'Link', ''),
(7, 'Zip', 'zip'),
(8, 'Image', 'jpg'),
(9, 'Video', 'mp4'),
(10, 'Audio', 'mp3');

INSERT INTO `section_files` (`section_ID`, `file_type_ID`, `file_name`) VALUES
(43, 1, 'Introduktion_Presentation'),
(43, 2, 'Introduktion_Slides'),
(43, 3, 'Introduktion_Video'),
(44, 4, 'Eksperiment_Rapport'),
(44, 5, 'Eksperiment_Data'),
(45, 6, 'https://www.hansenberg.dk/'),
(45, 7, 'Laboratorie_Instruktioner'),
(46, 8, 'Forskningsartikel'),
(46, 9, 'Forskningsartikel_Supplement'),
(47, 10, 'Opgave_Beskrivelse'),
(47, 1, 'Opgave_Rubrik'),
(48, 2, 'Quiz_Spørgsmål'),
(48, 3, 'Quiz_Svar'),
(49, 4, 'Essay_Opgave'),
(49, 5, 'Essay_Eksempel'),
(50, 6, 'https://www.hansenberg.dk/'),
(50, 7, 'Præsentations_Slides'),
(51, 8, 'Projekt_Forslag'),
(51, 9, 'Projekt_Plan'),
(52, 10, 'Case_Study'),
(52, 1, 'Case_Study_Analyse'),
(53, 2, 'Arbejdsark'),
(53, 3, 'Svarnøgle'),
(54, 4, 'Læsemateriale'),
(54, 5, 'Diskussionspunkter'),
(55, 6, 'https://www.hansenberg.dk/'),
(55, 7, 'Praksis_Eksamensspørgsmål'),
(56, 8, 'Workshop_Materialer'),
(56, 9, 'Workshop_Øvelser'),
(57, 10, 'Projekt_Instruktioner'),
(57, 1, 'Projekt_Skabelon'),
(58, 2, 'Studievejledning'),
(58, 3, 'Flashcards'),
(59, 4, 'Lektionsplan'),
(59, 5, 'Aktivitetsskemaer'),
(60, 6, 'https://www.hansenberg.dk/'),
(60, 7, 'Uddannelsesvideoer'),
(61, 8, 'Kursus_Syllabus'),
(61, 9, 'Kursus_Outline'),
(62, 10, 'Felttur_Guide'),
(62, 1, 'Felttur_Tjekliste'),
(63, 2, 'Workshop_Tidsplan'),
(63, 3, 'Workshop_Uddelinger'),
(64, 4, 'Klasseregler'),
(64, 5, 'Adfærdsregler'),
(65, 6, 'https://www.hansenberg.dk/'),
(65, 7, 'Hjemmeopgave_Svar'),
(66, 8, 'Interaktiv_Simulering'),
(66, 9, 'Simuleringsresultater'),
(67, 10, 'Diskussionsforum_Guidelines'),
(67, 1, 'Diskussionsforum_Temaer'),
(68, 2, 'Peer_Review_Formular'),
(68, 3, 'Peer_Review_Guidelines'),
(69, 4, 'Kursus_Evalueringsskema'),
(69, 5, 'Studenterundersøgelse'),
(70, 6, 'https://www.hansenberg.dk/'),
(70, 7, 'Dimissions_Taler'),
(71, 8, 'Studerendes_Prestationspriser'),
(71, 9, 'Certifikat_Skabeloner'),
(72, 10, 'Kursus_Tilmeldingsguide'),
(72, 1, 'Tilmeldingsformular'),
(73, 2, 'Adgangskrav'),
(73, 3, 'Ansøgningsformular'),
(74, 4, 'Finansiel_Hjælp_Oplysninger'),
(74, 5, 'Stipendieansøgninger'),
(75, 6, 'https://www.hansenberg.dk/'),
(75, 7, 'Adfærdspolitik'),
(76, 8, 'Karrierevejledning'),
(76, 9, 'Jobsøgningstips'),
(77, 10, 'Praktikpladser'),
(77, 1, 'Praktikpladsansøgning'),
(78, 2, 'Frivillighedsguide'),
(78, 3, 'Frivilligansøgning'),
(79, 4, 'Forskningsstøtteoplysninger'),
(79, 5, 'Forskningsstøtteansøgningsskema'),
(80, 6, 'https://www.hansenberg.dk/'),
(80, 7, 'Konferenceskema'),
(81, 8, 'Publikationsretningslinjer'),
(81, 9, 'Manuskriptskabelon'),
(82, 10, 'Laboratorieudstyr_Manual'),
(82, 1, 'Udstyr_Vedligeholdelseslog'),
(83, 2, 'Sikkerhedsprotokoller'),
(83, 3, 'Nødprocedurer'),
(84, 4, 'Facilitetsudlejningsaftale'),
(84, 5, 'Arrangementsplanlægningskontrol'),
(85, 6, 'https://www.hansenberg.dk/'),
(85, 7, 'Programregistreringsformular'),
(86, 8, 'Fundraisingkampagneoplysninger'),
(86, 9, 'Donationsformular'),
(87, 10, 'Pædagogisk_Initiativplan'),
(87, 1, 'InitiativFremdriftsrapport'),
(88, 2, 'Skoleforbedringsplan'),
(88, 3, 'Kvalitetssikringsgennemgang'),
(89, 4, 'Studerendesvurderingsmetoder'),
(89, 5, 'Vurderingsresultater'),
(90, 6, 'https://www.hansenberg.dk/'),
(90, 7, 'Mødereferater'),
(91, 8, 'Pensumudviklingsguide'),
(91, 9, 'Pensumvurderingsrapport');

-- Generate 6 rows. Randomize between subject class id 9, 19, 29 and 39. Dates are today from 08:10, 09:10, 10:20, 11:50, 13:00, 14:00. Define period to be 1
INSERT INTO `schedule` (`subject_class_ID`, `date`, `period`, `room`, `note`, `homework`) VALUES
(9, DATE_ADD(CURRENT_DATE(), INTERVAL 8 HOUR), 1, 'A101', 'Lektion 1', 1),
(19, DATE_ADD(CURRENT_DATE(), INTERVAL 9 HOUR), 1, 'A102', 'Lektion 2', 2),
(29, DATE_ADD(CURRENT_DATE(), INTERVAL 10 HOUR), 1, 'A103', 'Lektion 3', 3),
(39, DATE_ADD(CURRENT_DATE(), INTERVAL 11 HOUR), 1, 'A104', 'Lektion 4', 4),
(9, DATE_ADD(CURRENT_DATE(), INTERVAL 13 HOUR), 1, 'A105', 'Lektion 5', 5),
(19, DATE_ADD(CURRENT_DATE(), INTERVAL 14 HOUR), 1, 'A106', 'Lektion 6', 6);

INSERT INTO `absence` (`student_ID`, `schedule_ID`, `allowed`, `five_minutes_late`)
SELECT
    scs.student_ID,
    s.schedule_ID,
    CASE WHEN RAND() < 0.5 THEN 1 ELSE 0 END AS allowed,
    CASE WHEN RAND() < 0.2 THEN 1 ELSE 0 END AS five_minutes_late
FROM
    student_class scs
INNER JOIN
    schedule s ON scs.class_ID = s.subject_class_ID
ORDER BY
    RAND()
LIMIT
    10; -- Adjust the limit as needed