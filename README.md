# blood-donation-portal
A  complete web-based blood donation management system connecting donors with hospitals. Built with PHP, MySQL, HTML, CSS, and JavaScript.
# 🩸 Online Blood Donation Portal

A complete web-based blood donation management system that connects blood donors with hospitals in need. This platform streamlines the process of blood donation, request management, and inventory tracking.

<img width="1896" height="913" alt="Screenshot 2026-02-27 223453" src="https://github.com/user-attachments/assets/9c602dd9-b0b7-4d53-875c-2a4a40233bb8" />


## 📋 Table of Contents
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Screenshots](#-screenshots)
- [Database Structure](#-database-structure)
- [Installation Guide](#-installation-guide)
- [Usage Guide](#-usage-guide)
- [Login Credentials](#-login-credentials)
- [Project Structure](#-project-structure)
- [Future Enhancements](#-future-enhancements)

## ✨ Features

### 👥 Three User Roles

| Role | Capabilities |
|------|--------------|
| **Admin** | Approve users, manage donations, handle requests, monitor blood stock |
| **Donor** | Register, schedule donations, view donation history, track status |
| **Hospital** | Request blood, check real-time stock availability, view request history |

### 🎯 Key Functionalities

- ✅ **User Registration with Approval System** - New accounts require admin verification
- ✅ **Real-time Blood Stock Management** - Automatic updates on donations/requests
- ✅ **Smart Request Handling** - Auto-rejection if insufficient stock
- ✅ **Dark/Light Mode Toggle** - User preference saved in browser
- ✅ **Fully Responsive Design** - Works on desktop, tablet, and mobile
- ✅ **Session-based Authentication** - Secure login/logout system

## 🛠️ Tech Stack

| Technology | Purpose |
|------------|---------|
| **HTML5** | Structure and content |
| **CSS3** | Styling, animations, responsive design |
| **JavaScript** | Client-side validation, dark mode toggle, interactivity |
| **PHP (Core)** | Server-side logic, database operations, session management |
| **MySQL** | Database management |
| **XAMPP** | Local development server |
| **Git & GitHub** | Version control and hosting |

## 📸 Screenshots

### Home Page

<img width="1896" height="913" alt="Screenshot 2026-02-27 223453" src="https://github.com/user-attachments/assets/69b14cea-bba7-4154-b046-8faf49ea5276" />

<img width="1608" height="977" alt="image" src="https://github.com/user-attachments/assets/2318e60f-b6db-48dc-970e-4016fefd5026" />

<img width="1670" height="968" alt="image" src="https://github.com/user-attachments/assets/2230593d-2212-4250-8686-0ea0c2a974b7" />

### Admin Dashboard
<img width="1597" height="961" alt="image" src="https://github.com/user-attachments/assets/95286475-d024-412d-abe5-d1a0660df6fc" />

<img width="1390" height="857" alt="image" src="https://github.com/user-attachments/assets/22f682e0-b022-4ff9-8d70-5f48da9380af" />

<img width="1459" height="850" alt="image" src="https://github.com/user-attachments/assets/65534b28-b4d1-4577-90a7-df0e780e3df4" />

<img width="1551" height="865" alt="image" src="https://github.com/user-attachments/assets/2816fb05-7703-4a0a-8c93-8b6b83db8304" />

### Donor Dashboard

<img width="1605" height="943" alt="Screenshot 2026-02-27 223934" src="https://github.com/user-attachments/assets/ee0d834b-b1a6-4d91-9c23-70090f40388f" />

### Hospital Dashboard

<img width="1023" height="871" alt="Screenshot 2026-02-27 224113" src="https://github.com/user-attachments/assets/cd1f7297-1cd4-4a86-a320-b5af61bd7097" />

### Dark Mode

<img width="1678" height="970" alt="Screenshot 2026-02-27 224357" src="https://github.com/user-attachments/assets/61303861-0c8b-4ef6-ad9d-9f3bb08136ef" />

## 🗄️ Database Structure

The database `blood_donation_portal` contains four tables:

### Users Table
Stores all user information (Admin, Donors, Hospitals)

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | int(11) | PRIMARY KEY, AUTO_INCREMENT | Unique user ID |
| full_name | varchar(100) | NOT NULL | User's full name |
| email | varchar(100) | UNIQUE, NOT NULL | Login email |
| phone | varchar(15) | NOT NULL | Contact number |
| password | varchar(255) | NOT NULL | Login password |
| role | enum('Admin','Donor','Hospital') | NOT NULL | User type |
| blood_group | enum('A+','A-','B+','B-','AB+','AB-','O+','O-') | NULL | For donors only |
| status | enum('Pending','Approved','Rejected') | DEFAULT 'Pending' | Account approval status |
| created_at | timestamp | DEFAULT current_timestamp() | Registration time |

### Donations Table
Tracks all blood donation records

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | int(11) | PRIMARY KEY, AUTO_INCREMENT | Donation ID |
| donor_id | int(11) | FOREIGN KEY (users.id) ON DELETE CASCADE | Donor reference |
| blood_group | enum(...) | NOT NULL | Donor's blood group |
| donation_date | date | NOT NULL | Date of donation |
| status | enum('Pending','Approved','Rejected') | DEFAULT 'Pending' | Donation status |

### Blood Requests Table
Manages hospital blood requests

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | int(11) | PRIMARY KEY, AUTO_INCREMENT | Request ID |
| hospital_id | int(11) | FOREIGN KEY (users.id) ON DELETE CASCADE | Hospital reference |
| blood_group | enum(...) | NOT NULL | Requested blood type |
| units | int(11) | NOT NULL | Number of units needed |
| status | enum('Pending','Approved','Rejected') | DEFAULT 'Pending' | Request status |
| request_date | timestamp | DEFAULT current_timestamp() | Request time |

### Blood Stock Table
Maintains current blood inventory

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | int(11) | PRIMARY KEY, AUTO_INCREMENT | Stock ID |
| blood_group | enum(...) | UNIQUE, NOT NULL | Blood type |
| units | int(11) | DEFAULT 0 | Available units |

### Database Relationships

- **One-to-Many**: One donor can have many donations
- **One-to-Many**: One hospital can make many requests
- **Cascade Delete**: Deleting a user removes all related donations/requests

## 🚀 Installation Guide

### Prerequisites
- XAMPP (PHP 8.2+ and MySQL)
- Web browser (Chrome, Firefox, Edge)
- Git (optional, for cloning)

### Step-by-Step Installation

#### Step 1: Install XAMPP
1. Download XAMPP from [apachefriends.org](https://www.apachefriends.org/)
2. Install with default settings
3. Open XAMPP Control Panel
4. Start **Apache** and **MySQL** services

#### Step 2: Download Project
**Option A: Clone with Git**
```bash
git clone https://github.com/IshaIjaz/blood-donation-portal.git
```
git clone https://github.com/IshaIjaz/blood-donation-portal.git

**Option B: Download ZIP**

Download ZIP from GitHub

Extract to XAMPP's htdocs folder

#### Step 3: Move to htdocs
Windows: Copy to C:\xampp\htdocs\blood-donation-portal\

Mac: Copy to /Applications/XAMPP/htdocs/blood-donation-portal/

#### Step 4: Create Database
Open phpMyAdmin: http://localhost/phpmyadmin

Click "New" in left sidebar

Database name: blood_donation_portal

Collation: utf8mb4_general_ci

Click "Create"

#### Step 5: Import Database
Select the new database

Click "Import" tab

Click "Choose File"

Select sql/blood_donation_portal.sql

Click "Go"

#### Step 6: Configure Connection
Open connection.php and verify:

php
$servername = "localhost";
$username = "root";
$password = "";
$database = "blood_donation_portal";

#### Step 7: Run Project
Open browser and go to:

text
http://localhost/blood-donation-portal/

## 📖 Usage Guide
### For Donors

Register as Donor (select blood group)

Wait for Admin Approval

Login with credentials

View Dashboard with donation history

Schedule New Donation using date picker

Track Status (Pending → Approved/Rejected)

### For Hospitals

Register as Hospital

Wait for Admin Approval

Login with credentials

Check Blood Stock availability

Submit Request (blood group + units)

Track Request Status in history

### For Admin

Login with admin credentials

View Statistics on dashboard

Approve/Reject Users in Users tab

Approve/Reject Donations (adds to stock)

Approve/Reject Requests (checks stock)

Monitor Blood Stock in Stock tab

## 🔑 Login Credentials
Admin Account

Email: admin@bdp.com

Password: admin123

Role: Admin

Status: Approved

### Sample Donor Accounts
Ali Khan - ali.khan@email.com / password123 (A+)

Sara Ahmed - sara.ahmed@email.com / password123 (B+)

Hassan Raza - hassan.raza@email.com / password123 (O+)

Fatima Bibi - fatima@email.com / password123 (AB+)

Yasir Ali - yasir@gmai.com / password123 (O-)

Bisma Khan - bisma@email.com / password123 (O+)

### Sample Hospital Accounts
City Hospital Lahore - city.hospital@email.com / hospital123 (Approved)

Fatima Memorial Hospital - fmh@email.com / hospital123 (Approved)

Jinnah Hospital - jinnah@email.com / hospital123 (Approved)

Al Shifa Hospital - alshifa@email.com / hospital123 (Pending)

New Life Hospital - newlife@gmail.com / hospital123 (Pending)

## 📁 Project Structure
blood-donation-portal/
│
├── 📄 index.php              # Home page
├── 📄 about.php              # About us
├── 📄 contact.php            # Contact page
├── 📄 login.php              # User login
├── 📄 register.php           # Registration
├── 📄 logout.php             # Logout
├── 📄 admin_dashboard.php    # Admin panel
├── 📄 donor_dashboard.php    # Donor panel
├── 📄 hospital_dashboard.php # Hospital panel
├── 📄 donate_blood.php       # Donation form
├── 📄 request_blood.php      # Request form
├── 📄 approve_user.php       # Approve user
├── 📄 approve_donation.php   # Approve donation
├── 📄 approve_request.php    # Approve request
├── 📄 reject_donation.php    # Reject donation
├── 📄 reject_request.php     # Reject request
├── 📄 delete_user.php        # Delete user
├── 📄 connection.php         # Database connection
│
├── 📁 css/
│   └── style.css             # All styles + dark mode
│
├── 📁 js/
│   └── script.js             # JavaScript functions
│
├── 📁 sql/
│   └── blood_donation_portal.sql  # Database dump


## 🚀 Future Enhancements
Email notifications for approvals/rejections

SMS alerts for emergency requests

Donor eligibility checker (age, weight, last donation)

Analytics dashboard with charts and graphs

Export reports to PDF/Excel

Password hashing for security

CAPTCHA for registration forms

Multi-language support
