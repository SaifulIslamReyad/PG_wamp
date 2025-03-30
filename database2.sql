CREATE TABLE specialization (
    specialization_id INT PRIMARY KEY,
    specialization_name VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE doctors (
    doctor_id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_name VARCHAR(200) NOT NULL,
    doctor_email VARCHAR(200) NOT NULL UNIQUE,
    doctor_password VARCHAR(200) NOT NULL,
    specialization_id INT,
    mobile VARCHAR(15) NOT NULL, 
    qualification VARCHAR(255) NOT NULL,
    registration_number VARCHAR(100) NOT NULL,
    FOREIGN KEY (specialization_id) REFERENCES specialization(specialization_id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE patients (
    patient_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_name VARCHAR(255) NOT NULL,
    patient_dob DATE NOT NULL,
    patient_NID VARCHAR(20) UNIQUE,
    patient_birth_reg_no VARCHAR(20) UNIQUE,
    patient_gender ENUM('Male', 'Female', 'Other') NOT NULL
) ENGINE=InnoDB;

CREATE TABLE appointments (
    appointment_no INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    problem VARCHAR (200), 
    phone VARCHAR (200) NOT NULL, 
    appointment_date DATE NOT NULL, 
    appointment_time TIME NOT NULL,
    status ENUM('Checkup', 'Appointed', 'Seen') DEFAULT 'Appointed',
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE medicines (
    medicine_id INT AUTO_INCREMENT PRIMARY KEY,
    medicine_name VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE prescribed_medicines (
    appointment_no INT,
    medicine_id INT,
    dosage VARCHAR(50), 
    before_after ENUM('Before Meal', 'After Meal') DEFAULT 'After Meal',
    duration VARCHAR(50),
    FOREIGN KEY (appointment_no) REFERENCES appointments(appointment_no) ON DELETE CASCADE,
    FOREIGN KEY (medicine_id) REFERENCES medicines(medicine_id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE specialization_medicines (
    medicine_id INT,
    specialization_id INT,
    FOREIGN KEY (specialization_id) REFERENCES specialization(specialization_id) ON DELETE CASCADE,
    FOREIGN KEY (medicine_id) REFERENCES medicines(medicine_id) ON DELETE CASCADE
) ENGINE=InnoDB;
