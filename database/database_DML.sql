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
('Dr. Ashraful Islam Suhad', 'suhad@gmail.com', 'suhad', 'BDS, FCPS', 'REG-001'),
('Dr. Siam Howlader', 'siam@example.com', 'pass123', 'BDS, MDS', 'REG-002'),
('Dr. Nayeem Islam', 'nayeem@example.com', 'pass123', 'BDS, DDS', 'REG-003'),
('Dr. Tania Akter', 'tania@example.com', 'pass123', 'BDS', 'REG-004'),
('Dr. Farzana Islam', 'farzana@example.com', 'pass123', 'BDS, MDS', 'REG-005'),
('Dr. Tahmina Rahman', 'tahmina@example.com', 'pass123', 'BDS, MS', 'REG-006'),
('Dr. Fahim Rahman', 'fahim@example.com', 'pass123', 'BDS, FCPS', 'REG-007'),
('Dr. Imran Hossain', 'imran@example.com', 'pass123', 'BDS, MS', 'REG-008'),
('Dr. Ayesha Siddiqua', 'ayesha@example.com', 'pass123', 'BDS', 'REG-009'),
('Dr. Mahbub Hasan', 'mahbub@example.com', 'pass123', 'BDS, DDS', 'REG-010');

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

INSERT INTO patients (patient_name, patient_phone, patient_password, patient_dob, patient_gender) VALUES 
('Md. Rafiq', '01772977401', '123', '1990-05-12', 'M'),
('Farhana Akter', '01772977402', '123', '1992-07-08', 'F'),
('Arif Hossain', '01772977403', '123', '1985-01-15', 'M'),
('Ayesha Rahman', '01772977404', '123', '1998-11-22', 'F'),
('Mohammad Karim', '01772977405', '123', '1975-03-18', 'M'),
('Sabina Yasmin', '01772977406', '123', '2000-04-25', 'F'),
('Shahadat Hossain', '01772977407', '123', '1989-06-30', 'M'),
('Nazmul Huda', '01772977408', '123', '1977-09-14', 'M'),
('Lubna Akter', '01772977409', '123', '1994-02-10', 'F'),
('Tanjila Rahman', '01772977410', '123', '1991-12-01', 'F');

INSERT INTO appointments (patient_id, doctor_id, problem, appointment_date, appointment_time, status) VALUES 
(1, 1, 'Tooth Pain', '2025-03-01', '10:00:00', 'Appointed'),
(1, 1, 'Gum Bleeding', '2025-03-02', '11:00:00', 'Appointed'),
(3, 1, 'Root Canal', '2025-03-03', '09:00:00', 'Checkup'),
(4, 1, 'Oral Surgery', '2025-03-04', '10:30:00', 'Seen'),
(5, 1, 'Tooth Extraction', '2025-03-05', '11:30:00', 'Appointed'),
(7, 1, 'Cleaning', '2025-03-07', '09:30:00', 'Appointed'),
(8, 1, 'Teeth Whitening', '2025-03-08', '10:45:00', 'Checkup'),
(9, 1, 'Filling', '2025-03-09', '11:15:00', 'Appointed'),
(10, 1, 'Scaling', '2025-03-10', '12:30:00', 'Seen');


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
(1, 1, '1+1+1', 'After Meal', '5 Days'),
(1, 2, '1+1+1', 'Before Meal', '7 Days'),
(1, 3, '1+1+1', 'After Meal', '3 Days'),
(1, 4, '1+1+1', 'After Meal', '5 Days'),
(2, 5, '1+1+1', 'Before Meal', '7 Days'),
(2, 6, '1+1+1', 'After Meal', '3 Days'),
(2, 7, '1+1+1', 'After Meal', '5 Days'),
(2, 8, '1+1+1', 'Before Meal', '7 Days'),
(2, 9, '1+1+1', 'After Meal', '3 Days');