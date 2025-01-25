# DocAssist

**DocAssist** is a lightweight web application designed to streamline operations for small clinics and healthcare facilities. It provides tools for managing patients, scheduling appointments, maintaining medical records, and tracking invoices. With robust session-based authentication and role-based access control, the platform ensures data security and accessibility for different types of users.

---

## Features

### 1. **Patient Management**
- Store and organize patient details, including:
  - Name, email, phone number, address, date of birth, and gender.
- Quickly access and update patient records.

### 2. **Appointment Scheduling**
- Manage appointments between patients and doctors.
- Track appointment statuses (Pending, Completed, or Rejected).
- View and handle both upcoming and past appointments.

### 3. **Medical Records**
- Keep comprehensive medical records for patients:
  - Doctor’s name
  - Diagnosis
  - Prescriptions
  - Additional notes
- Easily retrieve historical records for patient care continuity.

### 4. **Invoice Tracking**
- Generate and manage invoices for patient services.
- Monitor payment statuses (Paid or Unpaid).
- Simplify the billing process for healthcare facilities.

### 5. **Secure Session-Based Authentication**
- Protect sensitive data using session-based authentication.
- Enable role-based access control (Admin, Doctor, Nurse) for appropriate access levels.

---

## Database Structure

### **1. Users Table**  
| Column       | Type                           | Description              |
|--------------|--------------------------------|--------------------------|
| id           | BIGINT                         | Primary key              |
| name         | VARCHAR(255)                   | User name                |
| email        | VARCHAR(255)                   | User email               |
| password     | VARCHAR(255)                   | User password            |
| role         | ENUM('admin','doctor','nurse') | User role                |
| is_active    | BOOLEAN                        | User account status      |
| created_at   | TIMESTAMP                      | Record creation date     |
| updated_at   | TIMESTAMP                      | Record update date       |

### **2. Patients Table**  
| Column       | Type                  | Description              |
|--------------|-----------------------|--------------------------|
| id           | BIGINT                | Primary key              |
| name         | VARCHAR(255)          | Patient name             |
| email        | VARCHAR(255)          | Patient email            |
| phone        | VARCHAR(20)           | Patient phone number     |
| address      | TEXT                  | Patient address          |
| dob          | DATE                  | Patient date of birth    |
| gender       | ENUM('male','female') | Patient gender           |
| created_at   | TIMESTAMP             | Record creation date     |
| updated_at   | TIMESTAMP             | Record update date       |

### **3. Medical Records Table**  
| Column       | Type                | Description              |
|--------------|---------------------|--------------------------|
| id           | BIGINT              | Primary key              |
| patient_id   | BIGINT              | Foreign key to patients  |
| doctor_id    | BIGINT              | Foreign key to users     |
| diagnosis    | TEXT                | Diagnosis details        |
| prescription | TEXT                | Prescription information |
| notes        | TEXT                | Additional notes         |
| created_at   | TIMESTAMP           | Record creation date     |
| updated_at   | TIMESTAMP           | Record update date       |

### **4. Appointments Table**  
| Column            | Type                                   | Description              |
|-------------------|----------------------------------------|--------------------------|
| id                | BIGINT                                 | Primary key              |
| patient_id        | BIGINT                                 | Foreign key to patients  |
| doctor_id         | BIGINT                                 | Foreign key to users     |
| appointment_date  | DATETIME                               | Appointment date & time  |
| status            | ENUM('pending','completed','rejected') | Appointment status       |
| created_at        | TIMESTAMP                              | Record creation date     |
| updated_at        | TIMESTAMP                              | Record update date       |

### **5. Invoices Table**  
| Column            | Type                  | Description              |
|-------------------|-----------------------|--------------------------|
| id                | BIGINT                | Primary key              |
| patient_id        | BIGINT                | Foreign key to patients  |
| amount            | UNSIGNEDBIGINTEGER    | Invoice amount           |
| payment_status    | ENUM('Paid','Unpaid') | Payment status           |
| created_at        | TIMESTAMP             | Record creation date     |
| updated_at        | TIMESTAMP             | Record update date       |

---

## Installation

### Prerequisites
- PHP 8.0 or higher
- Composer
- MySQL or a supported database

### Steps to Install
1. Clone the repository:
   ```bash
   git clone https://github.com/zadid15/docassist-session-based-authentication.git
   cd docassist-session-based-authentication
   ```

2. Install backend and frontend dependencies:
   ```bash
   composer install
   ```

3. Configure the `.env` file:
   ```bash
   cp .env.example .env
   ```
   Update database credentials and other environment variables.

4. Run migrations and seeders to set up the database:
   ```bash
   php artisan migrate --seed
   ```

5. Start the development server:
   ```bash
   php artisan serve
   ```
   Visit the application at `http://localhost:8000`.

---