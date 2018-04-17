-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2017 at 04:22 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `chemical`
--

CREATE TABLE `chemical` (
  `ChemID` int(11) NOT NULL,
  `ChemName` varchar(50) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `StatusChemID` int(11) NOT NULL,
  `TestingLabID` int(11) NOT NULL,
  `LocationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chemical`
--

INSERT INTO `chemical` (`ChemID`, `ChemName`, `Description`, `StatusChemID`, `TestingLabID`, `LocationID`) VALUES
(1, 'Sodium Chloride', 'An ionic compound with the chemical formula NaCl, representing a 1:1 ratio of sodium and chloride ions.', 1, 1, 1),
(2, 'Acetone', 'Organic compound with the formula (CH) CO.  It is a colorless, volatile, flammable liquid, and is the simplest ketone.', 1, 2, 4),
(3, 'Potassium', 'A chemical element with symbol K and atomic number 19. It was first isolated from potash, the ashes of plants, from which its name derives. In the periodic table, potassium is one of the alkali metals.', 3, 1, 3),
(4, 'Chlorine', 'A chemical element with symbol Cl and atomic number 17. The second-lightest of the halogens, it appears between fluorine and bromine in the periodic table and its properties are mostly intermediate between them.', 1, 2, 3),
(5, 'Carbon', 'A chemical element with symbol C and atomic number 6. It is nonmetallic and tetravalent - making four electrons available to form covalent chemical bonds.', 2, 1, 2),
(6, 'Oxygen', 'Is a chemical element with symbol O and atomic number 8. It is a member of the chalcogen group on the periodic table and is a highly reactive nonmetal and oxidizing agent that readily forms oxides with most elements as well as other compounds.', 3, 2, 4),
(7, 'Oxygen', 'is a chemical element with symbol O and atomic number 8. It is a member of the chalcogen group on the periodic table and is a highly reactive nonmetal and oxidizing agent that readily forms oxides with most elements as well as other compounds.', 3, 8, 1),
(8, 'Carbon', 'A chemical element with symbol C and atomic number 6. It is nonmetallic and tetravalent - making four electrons available to form covalent chemical bonds.', 2, 7, 2),
(9, 'Sodium Chloride', 'An ionic compound with the chemical formula NaCl, representing a 1:1 ratio of sodium and chloride ions.', 1, 9, 1),
(16, 'Alcohol', 'Used as an disinfectant', 1, 3, 2),
(18, 'Ethyl Alcohol', 'Used for disinfectant', 2, 34, 1),
(19, 'Sodium Chloride', 'An ionic compound with the chemical formula NaCl, representing a 1:1 ratio of sodium and chloride ions.', 3, 7, 4),
(21, 'Carbon Monoxide', 'Description here...', 1, 40, 3),
(22, 'Hydrogen Peroxide monoxide', 'Use for wound and for cleansing wound', 2, 1, 3),
(23, 'Acetone', 'sklvnskflv', 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(30) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `subject` varchar(300) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `status`, `subject`, `time`, `UserID`) VALUES
(21, 'When we will calibrate?', 1, 'Calibration of Chemical', '2017-08-22 06:11:48', 4),
(22, 'Hi I''m John Omar Esguerra', 1, 'Hi I''m John Omar Esguerra', '2017-08-22 23:41:06', 14),
(23, 'When we will be the meeting?', 1, 'Meeting on Calibration', '2017-08-23 03:04:02', 14),
(24, 'Hey, reply me!', 1, 'Meeting on Calibration', '2017-08-23 03:04:02', 14);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `EquipID` int(11) NOT NULL,
  `EquipName` varchar(50) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `StatusEquipID` int(11) NOT NULL,
  `TestingLabID` int(11) NOT NULL,
  `LocationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`EquipID`, `EquipName`, `Description`, `StatusEquipID`, `TestingLabID`, `LocationID`) VALUES
(1, 'Hirayama Autoclave', 'This product is used to liquefy media (Mode 4). Mode 4 can also be used prewarm the chamber for faster start.', 1, 2, 1),
(2, 'Sturdy Autoclave', 'Sturdy Autoclave is a temperature Sensor for more precise liquid temperature control. It also has piped water supply and auto water fill.', 1, 2, 1),
(3, 'General Purpose Incubator', 'An incubator is a device used to grow and maintain microbiological cultures or cell cultures. The incubator maintains optimal temperature, humidity and other conditions such as the carbon dioxide (CO2) and oxygen content of the atmosphere inside.', 1, 2, 5),
(4, 'BOD Incubator', ' B.O.D Incubators or Low Temperature Incubators are commonly used for applications such as B.O.D. Determinations, Plant and Insect Studies, Fermentation Studies, and Bacterial Culturing among many others.', 1, 2, 2),
(5, 'Binder Incubator', 'Binder Incubators are specially designed for long-term and stable continuous operation. Ideal for gentle\r\nincubation of organisms, such as on agar plates, and also for conditioning of heat sensitive media.\r\n', 1, 2, 2),
(6, 'Microplate Incubator', 'Increase sensitivity and specificity of ELISA assays and reduce incubation time with the Thermo Scientific<sup>TM</sup> iEMS Incubator/Shaker, a high-performance microplate incubator and shaker designed for ELISA applications.', 1, 2, 2),
(7, 'Top Loading Balance (Scout Pro)', 'is a flexible programming allows you use piece counts for inventory control, percent weighing to compare samples for compounding or formulation, totalization to sum the weights measured, and features weight hold for oversized packages in shipping. ', 1, 2, 2),
(8, 'Top Loading Balance', ' is among the most common types of weight measuring scales used in the laboratory. Top loading balances are available in a variety of sizes and weight capacities, from 20 g to 64.1 kg. ', 1, 2, 2),
(9, 'E.coli Water Bath Incubator', 'bacterium Escherichia coli (E. coli for short) is crucial in modern biotechnology. Scientists use it to store DNA sequences from other organisms, to produce proteins and to test protein function.', 1, 2, 2),
(10, 'Water Bath', 'is laboratory equipment made from a container filled with heated water. It is used to incubate samples in water at a constant temperature over a long period of time.', 1, 2, 2),
(11, 'Biosafety Cabinet', 'Microbiological safety cabinet is an enclosed, ventilated laboratory workspace for safely working with materials contaminated with (or potentially contaminated with) pathogens requiring a defined biosafety level.', 1, 2, 2),
(12, 'Refrigerator (Electrolux White Westinghouse)', 'Electrolux White-Westinghouse is a modern and grey refrigerator - the color dominating the other brand as well. Inside, the containers and doors are made of transparent materials, enabling us to view the content upon opening the refrigerator''s door. ', 1, 2, 4),
(13, 'Refrigerator with Freezer ( Biobase)', 'awan pay', 1, 2, 4),
(14, 'ThermoHygrometer', 'Thermo hygrometers are useful for measurements of humidity. Humidity is a representation of the concentration of water vapour in the air where the value is shown as a percent. Thermo hygrometers have sensors which measure humidity of the air and temperature of the air.', 1, 2, 3),
(15, 'Thermohygrometer', 'At the touch of a button, memory recalls the highest and lowest temperature and humidity readings', 1, 2, 2),
(16, 'Stomacher', 'the Stomacher, was compared with other methods of homogenization. Various food samples were homogenized on the Stomacher and also in Ato-mix blenders (prawns and other cooked foods) by simple mixing (raw meats, powdered egg and milk), or by using a pestle and mortar (cheese).', 1, 2, 2),
(17, 'Vortex Mixer', 'Vortex Mixer is a simple device used commonly in laboratories to mix small vials of liquid. ... In cell culture and microbiology laboratories they may be used to suspend cells.', 1, 2, 2),
(18, 'Colony Counter', 'Biological procedures often rely on an accurate count of bacterial colonies and cells. Colony counters are used to estimate a liquid culture''s density of microorganisms by counting individual colonies on an agar plate, slide, mini gel, or Petri dish.', 1, 2, 3),
(19, 'Bacticinerator', 'Complete sterilization occurs in only 5 to 7 seconds at optimum temperature of 1500<sup>o</sup>F (815<sup>o</sup>C). Heat is contained in deep ceramic tube to safeguard laboratory personnel - no open flame. No need to wait for instruments to turn red.', 1, 2, 2),
(20, 'Bacticinerator', 'Safely sterilizes loops and needles by infrared heat', 1, 2, 2),
(21, 'Dehumidifier (kolin)', 'The Kolin dehumidifier is packed with features that are suited to everyone''s needs, and would indeed be a beneficial addition to every Filipino household and other establishments deemed necessary.', 1, 2, 2),
(22, 'Dehumidifier (kolin)', 'The Kolin dehumidifier is packed with features that are suited to everyone''s needs, and would indeed be a beneficial addition to every Filipino household and other establishments deemed necessary.', 1, 2, 3),
(23, 'Microscope (Leica)', 'Is used but in fully functioning condition. It is still in great shape, few light scratches here and there. Camera, lights, and optics are perfect.', 1, 2, 2),
(24, 'Microscope (Motic)', 'Provides high resolution and excellent optical performance for all microscopy needs.', 1, 2, 2),
(25, 'Quanti-tray plus Sealer or Equivalent', 'Provides easy, rapid, and accurate bacterial counts.', 1, 2, 2),
(26, 'UV Viewing Cabinet', 'The ultraviolet viewing cabinet have specialized viewports for contrast observation that even accommodate users that wear prescription glasses. Filters to protect the eyes from harmful shortwave radiation and block the blue haze associated with longwave UV radiation.', 1, 2, 2),
(27, 'UV Lamp', 'UV lamps have many applications in the laboratory depending on the model used, including water testing, quality control inspection, nondestructive testing, sanitation, UV curing, gel viewing, mineralogy, arson investigation, TLC, E. coli testing, and sterilization.', 1, 2, 2),
(28, 'Water Purification System ( ThermoScientific)', 'The most commonly used solvent in laboratories is water; it is regularly used for cleaning and is the basis for cell cultures, buffers and reagents, making the quality of water critical to the success of experiments. ', 1, 2, 4),
(29, 'Hot Plate (Corning)', 'Controls for stir and heat, digital display for heat and stir levels light for power and a 8 1/2" X 8-1/2" platform.', 1, 2, 1),
(30, 'Caliper', 'A Vernier caliper is a precision instrument that measures internal dimensions, outside dimensions, and depth. It can measure to an accuracy of one thousandth of an inch and one hundredth of a millimeter. The caliper has two sets of jaws, one each on the upper and lower portions.', 1, 2, 2),
(31, 'pH Meter', 'A pH Meter is a scientific instrument that measures the hydrogen-ion activity in water-based solutions, indicating its acidity or alkalinity expressed as pH. ... The pH meter is used in many applications ranging from laboratory experimentation to quality control.', 1, 2, 5),
(32, 'Drying Oven', 'Laboratory ovens can be used for sample drying, baking, annealing, conditioning, sterilizing, evaporating and dehydrating, and other general laboratory work. Operating temperatures range up to 235<sup>o</sup>C (455<sup>o</sup>F).', 1, 2, 5),
(33, 'Canopy Hood', 'Canopy Hoods are specifically designed to vent non-toxic materials such as heat, steam and odors from large or bulky apparatus that do not require a physical barrier such as ovens, steam baths and autoclaves.', 1, 2, 5),
(34, 'Pippetor (100-1000 &#181;l)', 'A pipette (sometimes spelled pipet) is a laboratory tool commonly used in chemistry, biology and medicine to transport a measured volume of liquid, often as a media dispenser.', 1, 2, 2),
(35, 'Pippetor (100-1000 &#181;l)', 'A pipette (sometimes spelled pipet) is a laboratory tool commonly used in chemistry, biology and medicine to transport a measured volume of liquid, often as a media dispenser.', 1, 2, 2),
(36, 'Pippetor (1-10 ml)', 'Pipettes come in several designs for various purposes with differing levels of accuracy and precision, from single piece glass pipettes to more complex adjustable or electronic pipettes.', 1, 2, 2),
(37, 'Bottle Top Dispenser (1-10 ml)', 'The easy-to-use Prospenser bottle-top dispensers and Biotrate digital burette deliver trouble-free and reliable dispensing of liquids including strong acids, bases and solvents directly from a supply bottle.', 1, 2, 3),
(38, 'Air Conditioner( Sanyo)', 'Air conditioning (often referred to as AC, A.C., or A/C) is the process of removing heat from a confined space, thus cooling the air, and removing humidity. Air conditioning can be used in both domestic and commercial environments.', 2, 2, 3),
(39, 'Air Conditioner( Sanyo)', 'Air conditioning (often referred to as AC, A.C., or A/C) is the process of removing heat from a confined space, thus cooling the air, and removing humidity. Air conditioning can be used in both domestic and commercial environments.', 1, 2, 3),
(41, 'Standard Electricfan', 'Used for ventilation and hotness remedy', 2, 1, 3),
(42, 'Bacticinetator', 'For bacteria', 3, 34, 1),
(43, 'Hirayama Autoclave', 'This product is used to liquefy media (Mode 4). Mode 4 can also be used prewarm the chamber for faster start.', 3, 7, 1),
(44, 'Bacticinator', 'Used for bacteria', 1, 7, 2),
(45, 'Cell Phone', 'For communication and evaluation', 3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `LabID` int(11) NOT NULL,
  `LabName` varchar(50) NOT NULL,
  `LabFullName` varchar(100) NOT NULL,
  `UserLevelID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`LabID`, `LabName`, `LabFullName`, `UserLevelID`) VALUES
(1, 'RSTL', 'Regional Standards and Testing Laboratory', 2),
(2, 'CVLC', 'Cagayan Valley Laboratory Consortium', 2),
(3, 'Admin', 'Admin', 1),
(4, 'Viewer', 'Viewer', 3);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `LocationID` int(11) NOT NULL,
  `LocationName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LocationID`, `LocationName`) VALUES
(1, 'Microbiology Laboratory Hot Room'),
(2, 'Microbiology Laboratory Isolation and Incubation Room'),
(3, 'Microbiology Laboratory Media Preparation Room'),
(4, 'Microbiology Laboratory'),
(5, '');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `ServiceID` int(11) NOT NULL,
  `ServiceName` varchar(100) NOT NULL,
  `TestingLabID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`ServiceID`, `ServiceName`, `TestingLabID`) VALUES
(2, 'WasteWater Testing', 2),
(3, 'Nutrient Content Test', 1),
(4, 'Testing of Food Additive Content', 2),
(5, 'Nutrient Fact Computation', 1),
(7, 'Phytochemical Testing of Plant Extracts', 1),
(8, 'CVLC Water Testing', 9),
(10, 'Phytochemical Testing of Plant Extracts', 8),
(11, 'Water Activity Testing Of Food', 9),
(12, 'Testing of Food Additive Content', 8),
(13, 'Nutrient Content Test', 7),
(14, 'RSTL Carbon Test', 1),
(50, 'Microbiology Water Testing', 2),
(52, 'RSTL Water and Chemical Caliberation', 3),
(56, 'Techno Hub Water Testing', 34),
(60, 'Chemical Testing', 1),
(61, 'Techo Hub Chemical Test', 34),
(64, 'CVLC Water and Chemical Testing', 7),
(67, 'RSTL Carbon Test', 2),
(68, 'RSTL Microbiology Testing', 2),
(69, 'CVLC Metrology Testing', 7),
(70, 'CVLC Water and Chemical Testing', 40),
(71, 'Chemistry Agricultural Testing', 3);

-- --------------------------------------------------------

--
-- Table structure for table `statuschemical`
--

CREATE TABLE `statuschemical` (
  `StatusChemID` int(11) NOT NULL,
  `StatusChemName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuschemical`
--

INSERT INTO `statuschemical` (`StatusChemID`, `StatusChemName`) VALUES
(1, 'Available'),
(2, 'Warning'),
(3, 'Not Available');

-- --------------------------------------------------------

--
-- Table structure for table `statusequipment`
--

CREATE TABLE `statusequipment` (
  `StatusEquipID` int(11) NOT NULL,
  `StatusEquipName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statusequipment`
--

INSERT INTO `statusequipment` (`StatusEquipID`, `StatusEquipName`) VALUES
(1, 'Functional'),
(2, 'Not Functional'),
(3, 'Defective');

-- --------------------------------------------------------

--
-- Table structure for table `testinglab`
--

CREATE TABLE `testinglab` (
  `TestingLabID` int(11) NOT NULL,
  `TestingLabName` varchar(50) NOT NULL,
  `LabID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testinglab`
--

INSERT INTO `testinglab` (`TestingLabID`, `TestingLabName`, `LabID`) VALUES
(1, 'Metrology Services', 1),
(2, 'Microbiological Testing Laboratory', 1),
(3, 'Chemistry Laboratory', 1),
(7, 'Metrology Services', 2),
(8, 'Microbiological Testing Laboratory', 2),
(40, 'CVLC Chem Lab', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `LabID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `Email`, `Password`, `LabID`) VALUES
(4, 'cvlc', 'dost@gov.ph', '50192b80674cb4e8c8ce6066c8074dca', 2),
(6, 'rstl', 'rstl@gmail.com', '2098b4c312fbcab6ca62b5ffd7ce2196', 1),
(12, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 3),
(13, 'omar', 'omar@yahoo.com', '827ccb0eea8a706c4c34a16891f84e7b', 4),
(14, 'john', 'john@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 4);

-- --------------------------------------------------------

--
-- Table structure for table `userlevel`
--

CREATE TABLE `userlevel` (
  `UserLevelID` int(11) NOT NULL,
  `UserLevelName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlevel`
--

INSERT INTO `userlevel` (`UserLevelID`, `UserLevelName`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Viewer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chemical`
--
ALTER TABLE `chemical`
  ADD PRIMARY KEY (`ChemID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`EquipID`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`LabID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`LocationID`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Indexes for table `statuschemical`
--
ALTER TABLE `statuschemical`
  ADD PRIMARY KEY (`StatusChemID`);

--
-- Indexes for table `statusequipment`
--
ALTER TABLE `statusequipment`
  ADD PRIMARY KEY (`StatusEquipID`);

--
-- Indexes for table `testinglab`
--
ALTER TABLE `testinglab`
  ADD PRIMARY KEY (`TestingLabID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `userlevel`
--
ALTER TABLE `userlevel`
  ADD PRIMARY KEY (`UserLevelID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chemical`
--
ALTER TABLE `chemical`
  MODIFY `ChemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `EquipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
  MODIFY `LabID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `LocationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `statuschemical`
--
ALTER TABLE `statuschemical`
  MODIFY `StatusChemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `statusequipment`
--
ALTER TABLE `statusequipment`
  MODIFY `StatusEquipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `testinglab`
--
ALTER TABLE `testinglab`
  MODIFY `TestingLabID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `userlevel`
--
ALTER TABLE `userlevel`
  MODIFY `UserLevelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
