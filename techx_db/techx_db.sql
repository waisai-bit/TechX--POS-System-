-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2019 at 06:05 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `techx_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `BrandID` varchar(15) NOT NULL,
  `BrandName` varchar(30) NOT NULL,
  `BrandLogo` varchar(30) NOT NULL,
  `Status` varchar(15) NOT NULL,
  PRIMARY KEY (`BrandID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`BrandID`, `BrandName`, `BrandLogo`, `Status`) VALUES
('B-0001', 'Apple', 'BrandLogo/___image9991.png', 'Active'),
('B-0002', 'SAMSUNG', 'BrandLogo/___image8881.png', 'Active'),
('B-0003', 'Oppo', 'BrandLogo/___image5551.png', 'Active'),
('B-0004', 'Vivo', 'BrandLogo/___image6661.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `CategoryID` varchar(15) NOT NULL,
  `CategoryName` varchar(30) NOT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
('Cat-0001', 'Smart Phone'),
('Cat-0002', 'Tablet');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `ColorID` varchar(15) NOT NULL,
  `ColorName` varchar(30) NOT NULL,
  PRIMARY KEY (`ColorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`ColorID`, `ColorName`) VALUES
('Col-0001', 'Black'),
('Col-0002', 'Red'),
('Col-0003', 'Blue'),
('Col-0004', 'White'),
('Col-0006', 'Gray'),
('Col-0007', 'Green'),
('Col-0008', 'Gold');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` varchar(30) NOT NULL DEFAULT '',
  `Surname` varchar(30) NOT NULL,
  `Forename` varchar(30) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `DateofBirth` varchar(15) NOT NULL,
  `Address` varchar(30) NOT NULL,
  `Phoneno` varchar(30) NOT NULL,
  `AccountName` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Surname`, `Forename`, `Gender`, `DateofBirth`, `Address`, `Phoneno`, `AccountName`, `Password`) VALUES
('C-0001', 'Wai Sai', 'Kham Leng', 'Male', '09-Jan-1999', 'Hlaing Townshop', '09421118239', 'waisai@gmail.com', 'waiphyoaung'),
('C-0002', 'No No', 'Kiko', 'Female', '09-Nov-1999', 'Mawbe townshop', '09781182238', 'kiko@gmail.com', 'kiko'),
('C-0003', 'Kyaw', 'Soe Hein', 'Male', '01-Nov-1999', 'Tawe Township', '0942118239', 'kyaw@gmail.com', '123456'),
('C-0004', 'Soe', 'Sundy', 'Female', '24-Dec-1999', 'Kabar Aye Township', '09799718249', 'soe@gmail.com', '1500'),
('C-0005', 'Kelly', 'Nigga', 'Male', '21-Jun-1995', 'Kyo Kone Township', '09321821211', 'kellynigga@gmail.com', 'kellynigga'),
('C-0006', 'Min', 'Thin', 'Male', '08-Nov-2000', 'Heaven Township', '0942118238', 'minthin@gmail.com', '123'),
('C-0007', 'Wai Sai', 'Lawliet', 'Male', '08-Nov-2019', 'Hlaing', '0942118239', 'lawliet@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `DeliveryID` varchar(15) NOT NULL,
  `Transportation` varchar(30) NOT NULL,
  `Transportation_Type` varchar(30) NOT NULL,
  `Status` varchar(30) NOT NULL,
  `RegionID` varchar(15) NOT NULL,
  `StaffID` varchar(15) NOT NULL,
  PRIMARY KEY (`DeliveryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`DeliveryID`, `Transportation`, `Transportation_Type`, `Status`, `RegionID`, `StaffID`) VALUES
('Deli-0001', 'Delivery Van', 'Vehicle', 'Pending', 'Reg-0001', 'S-0002'),
('Deli-0002', 'Delivery Van', 'Vehicle', 'Pending', 'Reg-0003', 'S-0002'),
('Deli-0003', 'Delivery Van', 'Vehicle', 'Pending', 'Reg-0002', 'S-0002'),
('Deli-0004', 'Delivery Van', 'Vehicle', 'Pending', 'Reg-0004', 'S-0008'),
('Deli-0005', 'Delivery Van', 'Vehicle', 'Pending', 'Reg-0005', 'S-0008'),
('Deli-0006', 'Delivery Van', 'Vehicle', 'Pending', 'Reg-0006', 'S-0002'),
('Deli-0007', 'Delivery Van', 'Vehicle', 'Pending', 'Reg-0007', 'S-0002'),
('Deli-0008', 'Delivery Van', 'Vehicle', 'Pending', 'Reg-0007', 'S-0003');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE IF NOT EXISTS `discount` (
  `DiscountID` varchar(15) NOT NULL,
  `DiscountPoint` int(11) NOT NULL,
  `Percentage` int(11) NOT NULL,
  `Description` varchar(30) NOT NULL,
  PRIMARY KEY (`DiscountID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE IF NOT EXISTS `model` (
  `ModelID` varchar(15) NOT NULL,
  `ModelName` varchar(30) NOT NULL,
  `FrontImage` varchar(30) NOT NULL,
  `BackImage` varchar(30) NOT NULL,
  `SpecificationID` varchar(15) NOT NULL,
  PRIMARY KEY (`ModelID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`ModelID`, `ModelName`, `FrontImage`, `BackImage`, `SpecificationID`) VALUES
('Mod-0001', 'iphone 11 pro max', 'Productphoto/___image999.png', 'Productphoto/__MWD92ZAA_1.png', 'Spec-0001'),
('Mod-0002', 'Samsung Note 10 plus', 'Productphoto/___image6.png', 'Productphoto/___image5.png', 'Spec-0003'),
('Mod-0003', 'iphone 11 ', 'Productphoto/___image3.png', 'Productphoto/___image2.png', 'Spec-0004'),
('Mod-0004', 'Samsung S10 plus', 'Productphoto/___image10.png', 'Productphoto/___image111.png', 'Spec-0005'),
('Mod-0005', 'Samsung TabS4', 'Productphoto/___images100.png', 'Productphoto/___images101.png', 'Spec-0006'),
('Mod-0006', 'Vivo V9 ', 'Productphoto/___image34.png', 'Productphoto/___image62.png', 'Spec-0007');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE IF NOT EXISTS `orderdetail` (
  `OrderID` varchar(15) NOT NULL,
  `ProductID` varchar(15) NOT NULL,
  `OrderQuantity` int(11) NOT NULL,
  `OrderPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`OrderID`, `ProductID`, `OrderQuantity`, `OrderPrice`) VALUES
('Order-0018', 'P-0001', 1, 2300000),
('Order-0018', 'P-0006', 1, 340000),
('Order-0019', 'P-0003', 1, 1600000),
('Order-0020', 'P-0003', 1, 1600000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `OrderID` varchar(15) NOT NULL,
  `Order_Date` date NOT NULL,
  `Total_Quantity` int(11) NOT NULL,
  `Total_Amount` int(11) NOT NULL,
  `Delivery_Address` varchar(30) NOT NULL,
  `Contact_Phoneno` varchar(30) NOT NULL,
  `Status` varchar(30) NOT NULL,
  `PaymentType` varchar(30) NOT NULL,
  `CardNo` varchar(30) NOT NULL,
  `CustomerID` varchar(15) NOT NULL,
  `DeliveryID` varchar(15) NOT NULL,
  PRIMARY KEY (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `Order_Date`, `Total_Quantity`, `Total_Amount`, `Delivery_Address`, `Contact_Phoneno`, `Status`, `PaymentType`, `CardNo`, `CustomerID`, `DeliveryID`) VALUES
('Order-0018', '2019-11-22', 2, 2640000, 'No(2), Pauka Street', '09421118239', 'Pending', 'MPU', '12212-121-21121-1212', 'C-0001', 'Deli-0001'),
('Order-0019', '2019-11-23', 1, 1600000, 'No(12), Roona Road', '09421118239', 'Pending', 'Master', '12212-121-21121-1212', 'C-0007', 'Deli-0001'),
('Order-0020', '2019-11-23', 1, 1600000, 'No(12), Roate Road', '09421118239', 'Pending', 'MPU', '12212-121-21121-1212', 'C-0004', 'Deli-0006');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `ProductID` varchar(15) NOT NULL,
  `CategoryID` varchar(15) NOT NULL,
  `BrandID` varchar(15) NOT NULL,
  `ModelID` varchar(15) NOT NULL,
  `ColorID` varchar(15) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  PRIMARY KEY (`ProductID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `CategoryID`, `BrandID`, `ModelID`, `ColorID`, `Quantity`, `Price`) VALUES
('P-0001', 'Cat-0001', 'B-0001', 'Mod-0001', 'Col-0001', 6, 2300000),
('P-0002', 'Cat-0001', 'B-0002', 'Mod-0002', 'Col-0001', 14, 1640000),
('P-0003', 'Cat-0001', 'B-0001', 'Mod-0003', 'Col-0004', 9, 1600000),
('P-0004', 'Cat-0001', 'B-0002', 'Mod-0004', 'Col-0004', 23, 1100000),
('P-0005', 'Cat-0002', 'B-0002', 'Mod-0005', 'Col-0004', 3, 800000),
('P-0006', 'Cat-0001', 'B-0004', 'Mod-0006', 'Col-0008', 11, 340000);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `PurchaseID` varchar(15) NOT NULL,
  `Date` date NOT NULL,
  `TotalQuantity` int(11) NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `GovTax` int(11) NOT NULL,
  `NetAmount` int(11) NOT NULL,
  `Status` varchar(30) NOT NULL,
  `SupplierID` varchar(15) NOT NULL,
  PRIMARY KEY (`PurchaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`PurchaseID`, `Date`, `TotalQuantity`, `TotalAmount`, `GovTax`, `NetAmount`, `Status`, `SupplierID`) VALUES
('PUR-0001', '2019-11-14', 8, 13000000, 650000, 13650000, 'Complete', 'Sp-0001'),
('PUR-0002', '2019-11-14', 11, 11500000, 575001, 12075001, 'Pending', 'Sp-0002'),
('PUR-0003', '2019-11-14', 2, 4000000, 200000, 4200000, 'Pending', 'Sp-0001'),
('PUR-0004', '2019-11-14', 4, 5980000, 299000, 6279000, 'Pending', 'Sp-0002'),
('PUR-0005', '2019-11-17', 5, 1500000, 75000, 1575000, 'Pending', 'Sp-0001');

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetail`
--

CREATE TABLE IF NOT EXISTS `purchasedetail` (
  `PurchaseID` varchar(15) NOT NULL,
  `ProductID` varchar(15) NOT NULL,
  `PurchaseQuantity` int(11) NOT NULL,
  `PurchasePrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasedetail`
--

INSERT INTO `purchasedetail` (`PurchaseID`, `ProductID`, `PurchaseQuantity`, `PurchasePrice`) VALUES
('PUR-0001', 'P-0001', 4, 2000000),
('PUR-0001', 'P-0002', 4, 1250000),
('PUR-0002', 'P-0003', 5, 1100000),
('PUR-0002', 'P-0004', 6, 1000000),
('PUR-0003', 'P-0001', 2, 2000000),
('PUR-0004', 'P-0001', 3, 1950000),
('PUR-0004', 'P-0002', 1, 130000),
('PUR-0005', 'P-0006', 5, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `RegionID` varchar(15) NOT NULL,
  `RegionName` varchar(30) NOT NULL,
  `DurationDate` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`RegionID`, `RegionName`, `DurationDate`) VALUES
('Reg-0001', 'Insein', '3-6 days'),
('Reg-0002', 'Shwe Pyi Tar', '3-7 days'),
('Reg-0003', 'Hledan', '1-2 days'),
('Reg-0004', 'Koe Kone', '2-3 days'),
('Reg-0005', 'Myae Nyi Gone', '2-3 days'),
('Reg-0006', 'KabarAye ', '1-2 days'),
('Reg-0007', 'Taung Kyi', '6-7 days');

-- --------------------------------------------------------

--
-- Table structure for table `specification`
--

CREATE TABLE IF NOT EXISTS `specification` (
  `SpecificationID` varchar(15) NOT NULL,
  `SpecificationCode` varchar(30) NOT NULL,
  `Sim` varchar(30) NOT NULL,
  `Network` varchar(30) NOT NULL,
  `CPU` varchar(30) NOT NULL,
  `DisplaySize` varchar(30) NOT NULL,
  `Resolution` varchar(30) NOT NULL,
  `Front_Camera` varchar(30) NOT NULL,
  `Rear_Camera` varchar(30) NOT NULL,
  `Ram` varchar(30) NOT NULL,
  `Rom` varchar(30) NOT NULL,
  `OS` varchar(30) NOT NULL,
  `Version` varchar(30) NOT NULL,
  `Battery` varchar(30) NOT NULL,
  `Weight` varchar(30) NOT NULL,
  PRIMARY KEY (`SpecificationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specification`
--

INSERT INTO `specification` (`SpecificationID`, `SpecificationCode`, `Sim`, `Network`, `CPU`, `DisplaySize`, `Resolution`, `Front_Camera`, `Rear_Camera`, `Ram`, `Rom`, `OS`, `Version`, `Battery`, `Weight`) VALUES
('Spec-0001', 'ip-11promax-RA-4-RO-256', 'Single-Sim', '4G', 'A 13', '6.4 inches', 'OLED  XDR 1280x1920', '12 MP', 'Triple 12+12+12 MP', '4 GB', '256 GB', 'IOS', 'IOS 13', '3900 MAh', '180 g'),
('Spec-0002', 'ip-11promax-RA-4-RO-64gb', 'Dual-Sim', '4G', 'A 13', '6.4 inches', 'OLED  XDR 1280x1920', '13 MP', 'Triple 12+12+12 MP', '4 GB', '64 GB', 'IOS', 'IOS 13', '3900 MAh', '180 g'),
('Spec-0003', 'ss-note10plus-RA-8-RO-256', 'Single-Sim + Hybrid-Sim', '4G', 'Exynos 9825', '6.3 inches', 'Dynamic AMOLED 1080x2280 ', '10 MP', '12+12+16 MP', '8 GB', '256 GB', 'Android', 'version 9.0', '3500 mAh', '168 g'),
('Spec-0004', 'iphone-11-RA-3-RO-64', 'E-Sim', '4G', 'A 13', '6.3 inches', 'Liquid Retina IPS LCD 828x1792', '12MP', 'Dual 12+12 MP', '3', '64 GB', 'IOS', 'IOS 13', '3110 MAh', '194 g'),
('Spec-0005', 'ss-s10plus-RA-8-RO-128', 'Single-Sim + Hybrid-Sim', '4G', 'Exynos 9820', '6.4 inches', 'Dynamic AMOLED 1440x3040 ', 'Dual 10+8 MP', 'Triple 12+12+16 MP', '8 GB', '128 GB', 'Android', '9.0', '4100 mAh', '175 g'),
('Spec-0006', 'ss-tabs4-RA-4-RO-64', 'Single-Sim', '3G', 'Snapdragon 835', '10.5 inches', '1600x2560 px', '8 MP', '13 MP', '4 GB', '64 GB', 'Android', 'version 8.1', '7300 mAh', '428 g'),
('Spec-0007', 'vivo-v9-RA-4-RO-64', 'Single-Sim', '3G', 'Snapdragon 626', '6.3 inches', 'IPS LCD 1080x2280 px', '24 MP', '16+5 MP', '4 GB', '64 GB, MicroSD up to 256gb ', 'Android', 'version 8.1', '3260 mAh', '150 g');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `StaffID` varchar(15) NOT NULL,
  `StaffName` varchar(30) NOT NULL,
  `Position` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `PhoneNo` varchar(30) NOT NULL,
  `Address` varchar(30) NOT NULL,
  `Gender` varchar(30) NOT NULL,
  PRIMARY KEY (`StaffID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `StaffName`, `Position`, `Email`, `Password`, `PhoneNo`, `Address`, `Gender`) VALUES
('S-0002', 'yee wai', 'Adminstrator', 'yeewai@gmail.com', '12345', '0979971854', 'Insein', 'Male'),
('S-0003', 'Ya Min', 'Adminstrator', 'yamin@gmail.com', '12345', '0942854119', 'Tagon Township', 'Female'),
('S-0007', 'Kyaw Kyaw', 'Delivery', 'waiyan@gmail.com', '12345', '0925232323', 'shwepyitar', 'Male'),
('S-0008', 'Aung Khant', 'Delivery', 'aung@gmail.com', '123', '09213828299', 'Insein Township', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `SupplierID` varchar(15) NOT NULL,
  `SupplierName` varchar(30) NOT NULL,
  `PhoneNo` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Address` varchar(30) NOT NULL,
  PRIMARY KEY (`SupplierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `PhoneNo`, `Email`, `Address`) VALUES
('Sp-0001', 'Ye Min Thu', '0973818211', 'yeminthu@gmail.com', 'Insein Township'),
('Sp-0002', 'Zin Zin', '092532388', 'thorzin@gmail.com', 'TaMine  Township');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
