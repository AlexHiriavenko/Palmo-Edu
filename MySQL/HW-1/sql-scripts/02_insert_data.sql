-- Insert records into the users table
INSERT INTO users (full_name, address, birth_date, role) VALUES
('John Doe', 'Kyiv, Khreshchatyk St, 1', '1985-05-12', 'Administrator'),
('Mary Smith', 'Lviv, Horodotska St, 12', '1990-09-23', 'User'),
('Peter Johnson', 'Odesa, Derybasivska St, 25', '1978-11-05', 'Editor');

-- Insert records into the regions table
INSERT INTO regions (region_name) VALUES
('Kyiv Region'),
('Lviv Region'),
('Odesa Region'),
('Dnipropetrovsk Region'),
('Kharkiv Region');