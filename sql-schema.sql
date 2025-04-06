USE car_rental_db;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(20),
    address VARCHAR(255),
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE car_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);


CREATE TABLE locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    address VARCHAR(255)
);


CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    year INT NOT NULL,
    price_per_day DECIMAL(10,2) NOT NULL,
    available BOOLEAN DEFAULT TRUE,
    car_type_id INT,
    FOREIGN KEY (car_type_id) REFERENCES car_types(id)
);


CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    car_id INT NOT NULL,
    pickup_date DATE NOT NULL,
    return_date DATE NOT NULL,
    pickup_location_id INT,
    return_location_id INT,
    status VARCHAR(20) DEFAULT 'active',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (car_id) REFERENCES cars(id),
    FOREIGN KEY (pickup_location_id) REFERENCES locations(id),
    FOREIGN KEY (return_location_id) REFERENCES locations(id)
);


INSERT INTO car_types (name) VALUES 
('SUV'), 
('Sedan'), 
('Electric'), 
('Luxury');


INSERT INTO locations (name, address) VALUES
('Sarajevo', 'Sarajevo Airport'),
('Banja Luka', 'City Center'),
('Tuzla', 'Main Station'),
('Zenica', 'Bus Terminal'),
('Mostar', 'Old Town Office'),
('Bihać', 'Downtown Branch'),
('Brčko', 'Central Office'),
('Doboj', 'Doboj Station'),
('Bijeljina', 'City Gate'),
('Travnik', 'Travnik Office');


INSERT INTO cars (brand, model, year, price_per_day, available, car_type_id) VALUES
('BMW', 'X5', 2022, 120.00, TRUE, 1),
('Jeep', 'Wrangler', 2021, 130.00, TRUE, 1),
('Toyota', 'Land Cruiser', 2021, 140.00, TRUE, 1),
('Range Rover', 'Evoque', 2022, 145.00, TRUE, 1),
('Audi', 'A4', 2021, 90.00, TRUE, 2),
('Mercedes-Benz', 'C-Class', 2022, 110.00, TRUE, 2),
('Mercedes-Benz', 'E-Class', 2023, 125.00, TRUE, 2),
('Audi', 'A6', 2023, 135.00, TRUE, 2),
('Volkswagen', 'Golf', 2020, 60.00, TRUE, 2),
('Tesla', 'Model 3', 2023, 150.00, TRUE, 3),
('Porsche', 'Taycan', 2023, 170.00, TRUE, 3),
('Rolls-Royce', 'Phantom', 2022, 300.00, TRUE, 4),
('Lamborghini', 'Huracán', 2022, 350.00, TRUE, 4),
('Bentley', 'Continental GT', 2022, 320.00, TRUE, 4);