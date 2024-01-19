-- Create Users table
CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    FirstName VARCHAR(255),
    LastName VARCHAR(255),
    Role ENUM('user', 'admin') DEFAULT 'user',
    Cookie varchar(128) DEFAULT NULL
);


-- Create Locations table
CREATE TABLE Locations (
    LocationID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    Description TEXT,
    ImageURL VARCHAR(255)
);

-- Create Flights table
CREATE TABLE Flights (
    FlightID INT PRIMARY KEY AUTO_INCREMENT,
    DepartureLocationID INT,
    ArrivalLocationID INT,
    DepartureDateTime DATETIME,
    ArrivalDateTime DATETIME,
    Price DECIMAL(10, 2),
    Airline VARCHAR(255),
    FOREIGN KEY (DepartureLocationID) REFERENCES Locations(LocationID),
    FOREIGN KEY (ArrivalLocationID) REFERENCES Locations(LocationID)
);

-- Create Hotels table
CREATE TABLE Hotels (
    HotelID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    LocationID INT,
    Description TEXT,
    Price DECIMAL(10, 2),
    Rating DECIMAL(3, 2),
    ImageURLs JSON, -- Store image URLs as JSON
    FOREIGN KEY (LocationID) REFERENCES Locations(LocationID)
);



-- Create Bookings table
CREATE TABLE Bookings (
    BookingID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    HotelID INT,
    FlightID INT,
    CheckInDate DATE,
    CheckOutDate DATE,
    TotalPrice DECIMAL(10, 2),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (HotelID) REFERENCES Hotels(HotelID),
    FOREIGN KEY (FlightID) REFERENCES Flights(FlightID)
);

-- Create Reviews table
CREATE TABLE Reviews (
    ReviewID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    HotelID INT,
    Rating INT,
    Comment TEXT,
    Date DATE,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (HotelID) REFERENCES Hotels(HotelID)
);
