# CliniCode 🏥

CliniCode is a medical information management system designed to streamline interactions between doctors, patients, and medical data. This project is built using PHP and MySQL (via WAMP), and includes all the necessary files and folders to run locally or integrate into a WAMP stack.

---

## 🚀 Getting Started

### Prerequisites

- PHP (Recommended: 7.x or 8.x)
- MySQL / MariaDB
- WAMP/XAMPP server
- A modern web browser

---

## 🗂 Project Structure

The root folder is named `PG_wamp` and contains the following:

PG_wamp/
├── database/
│ └── temp.sql # SQL file for creating and populating the database
├── doctors/ # Handles doctor-related functionality
├── patients/ # Manages patient-side features
├── index/ # Homepage and routing
└── .git/ # Git version control

---

## 🛠️ Database Setup

To set up the database:

1. Open phpMyAdmin (or your preferred MySQL client).
2. Create a new database named: clinicode


3. Import the SQL file:

- Navigate to the `database/` folder inside `PG_wamp`
- Import `temp.sql` into the `clinicode` database.
- This file includes:
  - DDL (table creation)
  - DML (sample data)

---

## 🖥️ Running the Application

1. Place the entire `PG_wamp` folder inside your WAMP server’s `www` directory.
2. Start your WAMP/XAMPP server.
3. Open your browser and go to:http://localhost/PG_wamp/index/


---

## 📌 Notes

- This project is currently under development. Contributions and bug reports are welcome.
- Ensure the database is properly imported before running the app to avoid SQL errors.

---

## 📄 License

This project is licensed under the MIT License — feel free to use and modify it for educational or development purposes.
