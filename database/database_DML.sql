INSERT INTO specializations (specialization_name) VALUES 
('Orthodontics'), 
('Periodontics'), 
('Endodontics'), 
('Prosthodontics'), 
('Oral Surgery'), 
('Pediatric Dentistry'), 
('Oral Medicine'), 
('Oral Pathology'), 
('Oral Radiology'), 
('General Dentistry');

INSERT INTO doctors (doctor_name, doctor_email, doctor_password, mobile, qualification, registration_number) VALUES 
('Dr. Ashraful Islam Suhad', 'suhad@gmail.com', 'suhad', '017XXXXXXXX', 'BDS, FCPS', 'REG-001'),
('Dr. Siam Howlader', 'siam@example.com', 'pass123', '018XXXXXXXX', 'BDS, MDS', 'REG-002'),
('Dr. Nayeem Islam', 'nayeem@example.com', 'pass123', '019XXXXXXXX', 'BDS, DDS', 'REG-003'),
('Dr. Tania Akter', 'tania@example.com', 'pass123', '017XXXXXXXX', 'BDS', 'REG-004'),
('Dr. Farzana Islam', 'farzana@example.com', 'pass123', '017XXXXXXXX', 'BDS, MDS', 'REG-005'),
('Dr. Tahmina Rahman', 'tahmina@example.com', 'pass123', '018XXXXXXXX', 'BDS, MS', 'REG-006'),
('Dr. Fahim Rahman', 'fahim@example.com', 'pass123', '019XXXXXXXX', 'BDS, FCPS', 'REG-007'),
('Dr. Imran Hossain', 'imran@example.com', 'pass123', '017XXXXXXXX', 'BDS, MS', 'REG-008'),
('Dr. Ayesha Siddiqua', 'ayesha@example.com', 'pass123', '018XXXXXXXX', 'BDS', 'REG-009'),
('Dr. Mahbub Hasan', 'mahbub@example.com', 'pass123', '019XXXXXXXX', 'BDS, DDS', 'REG-010');

INSERT INTO doctor_specialization (doctor_id, specialization_id) VALUES 
(1, 1), 
(1, 3), 
(2, 4), 
(3, 2), 
(4, 5), 
(5, 6), 
(6, 1), 
(7, 7), 
(8, 8), 
(9, 9);

INSERT INTO patients (patient_name, patient_dob, patient_NID, patient_birth_reg_no, patient_gender) VALUES 
('Md. Rafiq', '1990-05-12', '1234567890', 'BR-1001', 'M'),
('Farhana Akter', '1992-07-08', '1234567891', 'BR-1002', 'F'),
('Arif Hossain', '1985-01-15', '1234567892', 'BR-1003', 'M'),
('Ayesha Rahman', '1998-11-22', '1234567893', 'BR-1004', 'F'),
('Mohammad Karim', '1975-03-18', '1234567894', 'BR-1005', 'M'),
('Sabina Yasmin', '2000-04-25', '1234567895', 'BR-1006', 'F'),
('Shahadat Hossain', '1989-06-30', '1234567896', 'BR-1007', 'M'),
('Nazmul Huda', '1977-09-14', '1234567897', 'BR-1008', 'M'),
('Lubna Akter', '1994-02-10', '1234567898', 'BR-1009', 'F'),
('Tanjila Rahman', '1991-12-01', '1234567899', 'BR-1010', 'F');

INSERT INTO appointments (patient_id, doctor_id, problem, phone, appointment_date, appointment_time, status) VALUES 
(1, 1, 'Tooth Pain', '017XXXXXXXX', '2025-03-01', '10:00:00', 'Appointed'),
(2, 1, 'Gum Bleeding', '018XXXXXXXX', '2025-03-02', '11:00:00', 'Appointed'),
(3, 1, 'Root Canal', '019XXXXXXXX', '2025-03-03', '09:00:00', 'Checkup'),
(4, 1, 'Oral Surgery', '017XXXXXXXX', '2025-03-04', '10:30:00', 'Seen'),
(5, 1, 'Tooth Extraction', '017XXXXXXXX', '2025-03-05', '11:30:00', 'Appointed'),
(6, 1, 'Braces Adjustment', '018XXXXXXXX', '2025-03-06', '12:00:00', 'Seen'),
(7, 1, 'Cleaning', '019XXXXXXXX', '2025-03-07', '09:30:00', 'Appointed'),
(8, 1, 'Teeth Whitening', '017XXXXXXXX', '2025-03-08', '10:45:00', 'Checkup'),
(9, 1, 'Filling', '018XXXXXXXX', '2025-03-09', '11:15:00', 'Appointed'),
(10, 1, 'Scaling', '019XXXXXXXX', '2025-03-10', '12:30:00', 'Seen');

INSERT INTO prescriptions (prescription_id,  issued_date) VALUES 
(1,  '2025-03-01'),
(2, '2025-03-02'),
(3,'2025-03-03'),
(4, '2025-03-04'),
(5, '2025-03-05'),
(6, '2025-03-06'),
(7, '2025-03-07'),
(8,  '2025-03-08'),
(9, '2025-03-09');

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

INSERT INTO prescribed_medicines (prescription_id, medicine_id, dosage, before_after, duration) VALUES 
(1, 1, '1 Tablet', 'After Meal', '5 Days'),
(1, 2, '1 Capsule', 'Before Meal', '7 Days'),
(1, 3, '1 Tablet', 'After Meal', '3 Days'),
(1, 4, '1 Tablet', 'After Meal', '5 Days'),
(2, 5, '1 Capsule', 'Before Meal', '7 Days'),
(2, 6, '1 Tablet', 'After Meal', '3 Days'),
(2, 7, '1 Tablet', 'After Meal', '5 Days'),
(2, 8, '1 Capsule', 'Before Meal', '7 Days'),
(2, 9, '1 Tablet', 'After Meal', '3 Days');