-- Insert data into Users table
INSERT INTO Users (Username, Password, Email, FirstName, LastName, Role)
VALUES 
  ('user1', 'password1', 'user1@email.com', 'John', 'Doe', 'user'),
  ('admin1', 'adminpass', 'admin@email.com', 'Admin', 'User', 'admin'),
  ('user2', 'pass123', 'user2@email.com', 'Jane', 'Smith', 'user');

-- Insert data into Locations table
INSERT INTO Locations (Name, Description, ImageURL)
VALUES 
  ('Paris', 'The city of love and lights', 'paris.jpg'),
  ('New York', 'The city that never sleeps', 'newyork.jpg'),
  ('Tokyo', 'A city of modern and traditional', 'tokyo.jpg');

-- Insert data into Hotels table
INSERT INTO Hotels (Name, LocationID, Description, Price, Rating, ImageURLs)
VALUES 
  ('Eiffel Tower Hotel', 1, 'Luxury hotel near the Eiffel Tower', 200.00, 4.5, '["img1.webp", "img2.png"]'),
  ('Times Square Hotel', 2, 'Central location in Times Square', 180.00, 4.0, '["img1.jpg"]'),
  ('Tokyo Skyline Hotel', 3, 'Great view of the Tokyo skyline', 220.00, 4.8, '["img1.webp"]');

-- Insert data into Flights table
INSERT INTO Flights (DepartureLocationID, ArrivalLocationID, DepartureDateTime, ArrivalDateTime, Price, Airline)
VALUES 
  (1, 2, '2023-01-15 10:00:00', '2023-01-15 15:00:00', 400.00, 'AirFrance'),
  (2, 3, '2023-02-20 12:00:00', '2023-02-20 18:00:00', 600.00, 'Delta'),
  (3, 1, '2023-03-25 08:00:00', '2023-03-25 14:00:00', 500.00, 'ANA');

-- Insert data into Bookings table
INSERT INTO Bookings (UserID, HotelID, FlightID, CheckInDate, CheckOutDate, TotalPrice)
VALUES 
  (1, 1, 1, '2023-04-10', '2023-04-15', 600.00),
  (2, 2, 2, '2023-05-05', '2023-05-10', 800.00),
  (3, 3, 3, '2023-06-20', '2023-06-25', 700.00);

-- Insert data into Reviews table
INSERT INTO Reviews (UserID, HotelID, Rating, Comment, Date)
VALUES 
  (1, 1, 4, 'Great experience, loved the view!', '2023-04-20'),
  (2, 2, 3, 'Nice hotel, but a bit noisy at night', '2023-05-15'),
  (3, 3, 5, 'Amazing service and breathtaking view', '2023-07-01');
