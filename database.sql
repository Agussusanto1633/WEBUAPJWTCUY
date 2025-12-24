-- Database Schema untuk Koneksi Jasa (Cuci Mobil & Service AC)

-- Tabel untuk kategori jasa
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel untuk penyedia jasa
CREATE TABLE service_providers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category_id INT NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100),
    address TEXT,
    description TEXT,
    price_range VARCHAR(50),
    rating DECIMAL(3,2) DEFAULT 0.00,
    is_available BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Tabel untuk ulasan/review
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_provider_id INT NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (service_provider_id) REFERENCES service_providers(id) ON DELETE CASCADE
);

-- Insert data kategori awal
INSERT INTO categories (name, description) VALUES
('Cuci Mobil', 'Jasa pencucian mobil standar, premium, dan detailing'),
('Service AC', 'Jasa perbaikan dan maintenance AC mobil dan rumah');

-- Insert data sample untuk service providers
INSERT INTO service_providers (name, category_id, phone, email, address, description, price_range, rating) VALUES
('Mobil Bersih Abadi', 1, '08123456789', 'mobilbersih@email.com', 'Jakarta Selatan', 'Cuci mobil standar dan premium', 'Rp 50.000 - 150.000', 4.5),
('AC Sejuk Jaya', 2, '08123456790', 'acsejuk@email.com', 'Jakarta Pusat', 'Service AC mobil dan rumah', 'Rp 100.000 - 500.000', 4.2),
('Detailing Pro', 1, '08123456791', 'detailingpro@email.com', 'Jakarta Barat', 'Detailing mobil premium', 'Rp 200.000 - 1.000.000', 4.8),
('AC Teknik', 2, '08123456792', 'acteknik@email.com', 'Jakarta Timur', 'Service AC profesional', 'Rp 80.000 - 300.000', 4.0);

-- Insert data sample untuk reviews
INSERT INTO reviews (service_provider_id, customer_name, rating, comment) VALUES
(1, 'Budi Santoso', 5, 'Pelayanan sangat baik, mobil jadi bersih sempurna!'),
(1, 'Siti Nurhaliza', 4, 'Cukup puas, harga terjangkau'),
(2, 'Ahmad Fauzi', 4, 'AC saya kembali dingin, pengerjaan cepat'),
(3, 'Rina Wijaya', 5, 'Hasil detailing mobil sangat memuaskan!');