CREATE TABLE specializations (
    specialization_id INT AUTO_INCREMENT PRIMARY KEY,
    specialization_name VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE doctors (
    doctor_id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_name VARCHAR(200) NOT NULL,
    doctor_email VARCHAR(200) NOT NULL UNIQUE,
    doctor_password VARCHAR(200) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    qualification VARCHAR(255) NOT NULL,
    registration_number VARCHAR(100) NOT NULL
) ENGINE=InnoDB;


CREATE TABLE doctor_specialization (
    doctor_id INT,
    specialization_id INT,
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id) ON DELETE CASCADE,
    FOREIGN KEY (specialization_id) REFERENCES specializations(specialization_id) ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE patients (
    patient_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_phone VARCHAR (200) NOT NULL, 
    patient_name VARCHAR(255) NOT NULL,
    patient_password VARCHAR(200) NOT NULL,
    patient_dob DATE NOT NULL,
    patient_gender CHAR(1) CHECK (patient_gender IN ('M', 'F', 'O'))
) ENGINE=InnoDB;

CREATE TABLE appointments (
    appointment_no INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    problem VARCHAR (200), 
    appointment_date DATE NOT NULL, 
    appointment_time TIME NOT NULL,
    status ENUM('Checkup', 'Appointed', 'Seen') DEFAULT 'Appointed',
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id) ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE prescriptions (
    prescription_id INT PRIMARY KEY,
    issued_date DATE NOT NULL,
    FOREIGN KEY (prescription_id) REFERENCES appointments(appointment_no) ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE medicines (
    medicine_id INT AUTO_INCREMENT PRIMARY KEY,
    medicine_name VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE prescribed_medicines (
    prescription_id INT,
    medicine_id INT,
    dosage VARCHAR(50), 
    before_after ENUM('Before Meal', 'After Meal') DEFAULT 'After Meal',
    duration VARCHAR(50),
    FOREIGN KEY (prescription_id) REFERENCES prescriptions(prescription_id) ON DELETE CASCADE,
    FOREIGN KEY (medicine_id) REFERENCES medicines(medicine_id) ON DELETE CASCADE
) ENGINE=InnoDB;

