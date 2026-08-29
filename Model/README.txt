MODEL LAYER
-----------
Holds the data. Start with JSON files (as in the Theory2/JSON lab), then
move to a MySQL database for the final submission.

Planned files/tables:
- users        (id, name, email, phone, role, password_hash, status)
- doctors      (user_id, specialty, fee, approved)
- specialties  (id, name)
- slots        (id, doctor_id, date, start_time, end_time, is_booked)
- appointments (id, patient_id, doctor_id, slot_id, status, reason)
- reviews      (id, patient_id, doctor_id, rating, review)
- notes        (id, appointment_id, notes)
