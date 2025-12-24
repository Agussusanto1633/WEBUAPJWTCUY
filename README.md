# 🚗 Koneksi Jasa API

Aplikasi API untuk platform "Koneksi Jasa" - marketplace jasa cuci mobil dan service AC yang dibuat dengan Laravel 11.

## 🎯 Overview

**Koneksi Jasa** adalah platform yang menghubungkan pengguna dengan penyedia jasa cuci mobil dan service AC profesional di daerah mereka. Aplikasi ini menyediakan sistem pencarian, rating, dan booking untuk layanan otomotif.

### ✨ Fitur Utama
- **🚗 Cuci Mobil**: Pencucian mobil, detailing, coating, dan perawatan kendaraan
- **❄️ Service AC**: Perbaikan, maintenance, dan instalasi AC mobil & ruangan
- **⭐ Rating & Review**: Sistem rating 1-5 bintang dengan review dari pelanggan
- **🔍 Pencarian & Filter**: Pencarian berdasarkan lokasi, kategori, dan harga
- **📄 Pagination**: Sistem pagination untuk data yang efisien

## 📁 Struktur Proyek

```
demo_web/
├── app/
│   ├── Http/Controllers/Api/
│   │   ├── ServiceProviderController.php  # CRUD API untuk penyedia jasa
│   │   └── CategoryController.php         # CRUD API untuk kategori
│   └── Models/
│       ├── ServiceProvider.php            # Model untuk penyedia jasa
│       └── Category.php                   # Model untuk kategori
├── database/
│   ├── migrations/
│   │   ├── 2025_11_25_153716_create_categories_table.php
│   │   └── 2025_11_25_153729_create_service_providers_table.php
│   └── seeders/
│       ├── CategorySeeder.php             # Seeder data kategori awal
│       └── DatabaseSeeder.php
├── routes/
│   └── api.php                           # API routes definition
├── Koneksi-Jasa-API.postman_collection.json # Postman collection
└── README.md                            # Dokumentasi ini
```

## 🗄️ Database Schema

### Tabel Categories
Menyimpan data kategori layanan (cuci mobil, service AC, dll).

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT | Primary key (auto increment) |
| name | VARCHAR(100) | Nama kategori (wajib) |
| description | TEXT | Deskripsi kategori |
| created_at | TIMESTAMP | Waktu pembuatan record |
| updated_at | TIMESTAMP | Waktu update record |

### Tabel Service Providers
Menyimpan data penyedia jasa.

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT | Primary key (auto increment) |
| name | VARCHAR(100) | Nama penyedia jasa (wajib) |
| category_id | BIGINT | Foreign key ke categories (wajib) |
| phone | VARCHAR(20) | Nomor telepon |
| email | VARCHAR(100) | Email penyedia jasa |
| address | TEXT | Alamat lengkap |
| description | TEXT | Deskripsi layanan |
| price_range | VARCHAR(50) | Rentang harga |
| rating | DECIMAL(3,2) | Rating (0.00 - 5.00) |
| is_available | BOOLEAN | Status ketersediaan (default: true) |
| created_at | TIMESTAMP | Waktu pembuatan record |
| updated_at | TIMESTAMP | Waktu update record |

## 🔗 API Endpoints

### Base URL
```
http://localhost:8000/api
```

### 1. Root Endpoint
```
GET /
```
Response example:
```json
{
    "message": "Koneksi Jasa API",
    "version": "1.0.0",
    "theme": "Jasa Cuci Mobil & Service AC",
    "endpoints": {
        "service-providers": {
            "GET /api/service-providers": "Get all with pagination & search",
            "GET /api/service-providers/{id}": "Get by ID",
            "POST /api/service-providers": "Create new",
            "PUT /api/service-providers/{id}": "Update",
            "DELETE /api/service-providers/{id}": "Delete"
        }
    }
}
```

### 2. Service Providers Endpoints

#### a. Get All Service Providers (Dengan Pagination & Search) 📋
```
GET /api/service-providers
```

**Query Parameters:**
- `limit` (integer, 1-100, default: 10) - Jumlah data per halaman
- `page` (integer, default: 1) - Halaman yang diminta
- `search` (string) - Pencarian di nama, deskripsi, atau alamat
- `orderBy` (string) - Kolom sorting: `id`, `name`, `rating`, `created_at`, `price_range`, `updated_at`
- `sortBy` (string) - Arah sorting: `asc`, `desc`
- `category_id` (integer) - Filter berdasarkan kategori (1=Cuci Mobil, 2=Service AC)

**Example Request:**
```bash
GET /api/service-providers?limit=10&page=1&search=carwash&orderBy=rating&sortBy=desc&category_id=1
```

**Response Format:**
```json
{
    "success": true,
    "message": "Service providers retrieved successfully",
    "data": {
        "providers": [
            {
                "id": 1,
                "name": "AutoClean Car Wash",
                "category_id": 1,
                "phone": "08123456789",
                "email": "autoclean@example.com",
                "address": "Jl. Sudirman No. 123",
                "description": "Professional car wash service",
                "price_range": "Rp 50.000 - 150.000",
                "rating": 4.5,
                "is_available": true,
                "created_at": "2025-11-25T15:37:16.000000Z",
                "updated_at": "2025-11-25T15:37:16.000000Z",
                "category": {
                    "id": 1,
                    "name": "Cuci Mobil",
                    "description": "Jasa pencucian mobil, detailing, dan perawatan kendaraan"
                }
            }
        ],
        "pagination": {
            "current_page": 1,
            "total_pages": 5,
            "per_page": 10,
            "total_items": 45,
            "has_next_page": true,
            "has_prev_page": false
        }
    }
}
```

#### b. Get Service Provider by ID 🔍
```
GET /api/service-providers/{id}
```

**Example Request:**
```bash
GET /api/service-providers/1
```

#### c. Create Service Provider ➕
```
POST /api/service-providers
```

**Headers:**
```
Content-Type: application/json
```

**Request Body:**
```json
{
    "name": "AutoClean Car Wash",
    "category_id": 1,
    "phone": "08123456789",
    "email": "autoclean@example.com",
    "address": "Jl. Sudirman No. 123, Jakarta Selatan",
    "description": "Jasa cuci mobil profesional dengan peralatan modern",
    "price_range": "Rp 50.000 - 150.000",
    "rating": 4.5,
    "is_available": true
}
```

#### d. Update Service Provider ✏️
```
PUT /api/service-providers/{id}
```

**Request Body (semua field optional):**
```json
{
    "name": "AutoClean Car Wash Updated",
    "phone": "081234567890",
    "rating": 4.7,
    "is_available": true
}
```

#### e. Delete Service Provider 🗑️
```
DELETE /api/service-providers/{id}
```

### 3. Categories Endpoints

#### a. Get All Categories
```
GET /api/categories
```

**Response Format:**
```json
{
    "success": true,
    "message": "Categories retrieved successfully",
    "data": [
        {
            "id": 1,
            "name": "Cuci Mobil",
            "description": "Jasa pencucian mobil, detailing, dan perawatan kendaraan"
        },
        {
            "id": 2,
            "name": "Service AC",
            "description": "Jasa perbaikan, maintenance, dan instalasi AC mobil dan ruangan"
        }
    ]
}
```

## ⚠️ Error Responses

### Validation Error (422)
```json
{
    "success": false,
    "message": "Validation errors",
    "errors": {
        "name": ["The name field is required."],
        "category_id": ["The category id must exist in categories table."]
    }
}
```

### Not Found Error (404)
```json
{
    "success": false,
    "message": "Service provider not found"
}
```

### Internal Server Error (500)
```json
{
    "success": false,
    "message": "Internal server error",
    "error": "Database connection failed"
}
```

## 🛠️ Setup & Installation

### Prerequisites
- PHP 8.2+
- Composer
- MySQL 5.7+ or MariaDB 10.3+
- Laravel 11

### Step 1: Install Dependencies
```bash
cd demo_web
composer install
```

### Step 2: Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

Configure database di `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=koneksi_jasa
DB_USERNAME=root
DB_PASSWORD=
```

### Step 3: Run Migration & Seeder
```bash
php artisan migrate:fresh --seed
```

### Step 4: Start Development Server
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

API akan berjalan di: `http://localhost:8000/api`

## 📮 Postman Collection

Import file `Koneksi-Jasa-API.postman_collection.json` ke Postman untuk testing semua endpoints dengan mudah.

### Cara Import:
1. Buka Postman
2. Klik "Import" → "Upload Files"
3. Pilih file `Koneksi-Jasa-API.postman_collection.json`
4. Semua endpoint akan tersedia dengan contoh request

## 🧪 Testing dengan cURL

### 1. Test Root Endpoint
```bash
curl -X GET "http://localhost:8000/api" -H "Accept: application/json"
```

### 2. Get All Service Providers
```bash
curl -X GET "http://localhost:8000/api/service-providers?limit=5&page=1&search=cuci&orderBy=rating&sortBy=desc" -H "Accept: application/json"
```

### 3. Create Service Provider
```bash
curl -X POST "http://localhost:8000/api/service-providers" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Test Car Wash",
    "category_id": 1,
    "phone": "08123456789",
    "email": "test@example.com",
    "address": "Jl. Test No. 123",
    "description": "Testing service provider",
    "price_range": "Rp 50.000 - 100.000",
    "rating": 4.0
  }'
```

## 🔧 Fitur Tambahan yang Dapat Dikembangkan

1. **🔐 Authentication System**: Laravel Sanctum untuk API authentication
2. **⭐ Review & Rating System**: Tabel reviews untuk user feedback
3. **📅 Booking System**: Tabel bookings untuk sistem reservasi
4. **📸 Image Upload**: Media library untuk foto portfolio
5. **🗺️ Location Search**: Integrasi dengan Google Maps API
6. **📧 Notification System**: Email/SMS notification untuk booking
7. **💳 Payment Gateway**: Integrasi dengan payment provider
8. **👨‍💻 Admin Dashboard**: Laravel Nova atau Filament untuk admin panel

## 🤝 Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/NewFeature`)
3. Commit changes (`git commit -am 'Add new feature'`)
4. Push to branch (`git push origin feature/NewFeature`)
5. Create Pull Request

## 📄 License

This project is licensed under the MIT License.

---

**Happy Coding! 🚀✨**
