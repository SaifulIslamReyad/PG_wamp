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
    registration_number VARCHAR(100) NOT NULL,
    chamber_address TEXT NOT NULL
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
    cc VARCHAR(200) ,
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



INSERT INTO specializations (specialization_name) VALUES 
('General Medicine'),
('General Dentistry'),
('Orthodontics'), 
('Periodontics'), 
('Endodontics'), 
('Cardiology'),
('Dermatology'),
('Neurology'),
('Psychiatry'),
('Pediatrics'),
('Oncology'),
('Nephrology'),
('Endocrinology'),
('Pulmonology'),
('Rheumatology'),
('Gastroenterology'),
('Hematology'),
('Urology'),
('ENT (Otorhinolaryngology)'),
('Ophthalmology'),
('Orthopedics'),
('Gynecology'),
('Anesthesiology'),
('Radiology'),
('Pathology'),
('Emergency Medicine'),
('Family Medicine'),
('Infectious Diseases'),
('Prosthodontics'), 
('Oral Surgery'), 
('Pediatric Dentistry'), 
('Oral Medicine'), 
('Oral Pathology'), 
('Oral Radiology');


INSERT INTO doctors (doctor_name, doctor_email, doctor_password, qualification, registration_number, mobile, chamber_address) VALUES 
('Dr. Ashraful Islam Suhad', 'suhad@gmail.com', 'suhad', 'BDS, FCPS', '1', '01580000001',"Barishal"),
('Dr. Siam Howlader', 'siam@example.com', 'pass123', 'BDS, MDS', '2', '01580000002',"Barishal"),
('Dr. Nayeem Islam', 'nayeem@example.com', 'pass123', 'BDS, DDS', '3', '01580000003', "Khulna"),
('Dr. Tania Akter', 'tania@example.com', 'pass123', 'BDS', '4', '01580000004',"Khulna"),
('Dr. Farzana Islam', 'farzana@example.com', 'pass123', 'BDS, MDS', '5', '01580000005',"Khulna"),
('Dr. Tahmina Rahman', 'tahmina@example.com', 'pass123', 'BDS, MS', '6', '01580000006',"Khulna"),
('Dr. Fahim Rahman', 'fahim@example.com', 'pass123', 'BDS, FCPS', '7', '01580000007',"Khulna"),
('Dr. Imran Hossain', 'imran@example.com', 'pass123', 'BDS, MS', '8', '01580000008',"Khulna"),
('Dr. Ayesha Siddiqua', 'ayesha@example.com', 'pass123', 'BDS', '9', '01580000009',"Khulna"),
('Dr. Mahbub Hasan', 'mahbub@example.com', 'pass123', 'BDS, DDS', '10', '01580000010',"Khulna"),
('Dr. Shakil Ahmed', 'shakil@example.com', 'pass123', 'BDS, MDS', '11', '01580000011', 'Dhaka'),
('Dr. Laila Noor', 'laila@example.com', 'pass123', 'BDS, MS', '12', '01580000012', 'Dhaka'),
('Dr. Rifat Hossain', 'rifat@example.com', 'pass123', 'BDS, DDS', '13', '01580000013', 'Chattogram'),
('Dr. Nargis Akter', 'nargis@example.com', 'pass123', 'BDS', '14', '01580000014', 'Sylhet'),
('Dr. Arifuzzaman Khan', 'arif@example.com', 'pass123', 'BDS, FCPS', '15', '01580000015', 'Dhaka'),
('Dr. Munni Akter', 'munni@example.com', 'pass123', 'BDS, MS', '16', '01580000016', 'Rangpur'),
('Dr. Shahin Alam', 'shahin@example.com', 'pass123', 'BDS, DDS', '17', '01580000017', 'Barishal'),
('Dr. Nazmul Huda', 'nazmul@example.com', 'pass123', 'BDS, MDS', '18', '01580000018', 'Dhaka'),
('Dr. Sabina Yasmin', 'sabina@example.com', 'pass123', 'BDS', '19', '01580000019', 'Khulna'),
('Dr. Al Amin Hossain', 'alamin@example.com', 'pass123', 'BDS, FCPS', '20', '01580000020', 'Dhaka');


INSERT INTO doctor_specialization (doctor_id, specialization_id) VALUES 
(1, 1), 
(1, 2), 
(1, 3), 
(2, 4), 
(3, 2), 
(4, 5), 
(5, 6), 
(6, 1), 
(7, 7), 
(8, 8), 
(9, 9),
(10, 3),
(11, 4),
(12, 5),
(13, 2),
(14, 6),
(15, 1),
(16, 8),
(17, 2),
(18, 4),
(19, 9),
(20, 7);

INSERT INTO patients (patient_name, patient_phone, patient_password, patient_dob, patient_gender) VALUES 
('Saiful Islam Reyad', '01772977405', '123', '1990-05-12', 'M'),
('Farhana Akter', '01772977402', '123', '1992-07-08', 'F'),
('Arif Hossain', '01772977403', '123', '1985-01-15', 'M'),
('Ayesha Rahman', '01772977404', '123', '1998-11-22', 'F'),
('Mohammad Karim', '01772977401', '123', '1975-03-18', 'M'),
('Sabina Yasmin', '01772977406', '123', '2000-04-25', 'F'),
('Shahadat Hossain', '01772977407', '123', '1989-06-30', 'M'),
('Nazmul Huda', '01772977408', '123', '1977-09-14', 'M'),
('Lubna Akter', '01772977409', '123', '1994-02-10', 'F'),
('Tanjila Rahman', '01772977410', '123', '1991-12-01', 'F');

INSERT INTO appointments (patient_id, doctor_id, problem, appointment_date, appointment_time, status) VALUES 
(1, 1, 'Tooth Pain', '2025-04-17', '08:00 PM ', 'Appointed'),
(2, 1, 'Gum Bleeding', '2025-04-17', '08:00 PM ', 'Appointed'),
(3, 1, 'Root Canal', '2025-04-17', '08:00 PM ', 'Appointed'),
(4, 1, 'Oral Surgery', '2025-04-17', '08:00 PM ', 'Appointed'),
(5, 1, 'Tooth Extraction', '2025-04-17', '08:00 PM ', 'Appointed'),
(7, 1, 'Cleaning', '2025-04-17', '08:00 PM ', 'Appointed'),
(8, 1, 'Teeth Whitening', '2025-04-17', '08:00 PM ', 'Appointed'),
(9, 1, 'Filling', '2025-04-17', '08:00 PM ', 'Appointed'),
(10, 1, 'Scaling', '2025-04-17', '08:00 PM ', 'Appointed');


-- INSERT INTO prescriptions (prescription_id, issued_date, cc) VALUES 
-- (1, '2025-03-01', 'Toothache'),
-- (2, '2025-03-02', 'Gum bleeding'),
-- (3, '2025-03-03', 'Root canal pain'),
-- (4, '2025-03-04', 'Swelling in jaw'),
-- (5, '2025-03-05', 'Tooth sensitivity'),
-- (6, '2025-03-06', 'Bad breath'),
-- (7, '2025-03-07', 'Cavity issue'),
-- (8, '2025-03-08', 'Broken tooth'),
-- (9, '2025-03-09', 'Follow-up checkup');


INSERT INTO medicines (medicine_name) VALUES 
('Amoxicillin'), 
('Ibuprofen'), 
('Paracetamol'), 
('Metronidazole'), 
('Clindamycin'), 
('Azithromycin'), 
('Diclofenac'), 
('Omeprazole'), 
('Ciprofloxacin'), 
('Doxycycline');

-- INSERT INTO prescribed_medicines (prescription_id, medicine_id, dosage, before_after, duration) VALUES 
-- (1, 1, '1+1+1', 'After Meal', '5'),
-- (1, 2, '1+1+1', 'Before Meal', '7'),
-- (1, 3, '1+1+1', 'After Meal', '3'),
-- (1, 4, '1+1+1', 'After Meal', '5'),
-- (2, 5, '1+1+1', 'Before Meal', '7'),
-- (2, 6, '1+1+1', 'After Meal', '3'),
-- (2, 7, '1+1+1', 'After Meal', '5'),
-- (2, 8, '1+1+1', 'Before Meal', '7'),
-- (2, 9, '1+1+1', 'After Meal', '3');