MediBook — Testing Notes

1. Project Overview

MediBook is a web-based doctor appointment management system developed using PHP, MySQL, HTML, CSS and JavaScript.

The system supports three primary roles:

* Patient
* Doctor
* Administrator

The main functions include user authentication, doctor verification, specialty management, doctor availability, appointment management, reviews, notes and AJAX-based doctor search.



2. Testing Approach

Testing was performed using functional and role-based test cases.

The main objectives were to verify that:

* Users can access functions appropriate to their roles.
* Administrators can manage doctors, users and specialties.
* Doctors can manage availability and appointment-related information.
* Patients can search for doctors, book appointments and submit reviews.
* AJAX doctor search returns appropriate results.
* Invalid or unauthorized requests are rejected.
* Database operations work correctly.



3. Functional Test Cases

| Test ID | Feature             | Test Action                                  | Expected Result                                                | Status |
| ------- | ------------------- | -------------------------------------------- | -------------------------------------------------------------- | ------ |
| TC-01   | Login               | Enter valid user credentials                 | User is authenticated and redirected according to role         | Pass   |
| TC-02   | Login               | Enter invalid credentials                    | Login fails and an error message is displayed                  | Pass   |
| TC-03   | Registration        | Submit valid registration information        | New patient account is created                                 | Pass   |
| TC-04   | Registration        | Submit invalid/incomplete information        | Validation prevents invalid registration                       | Pass   |
| TC-05   | Admin Access        | Access admin functions as administrator      | Admin functions are available                                  | Pass   |
| TC-06   | Role Protection     | Access admin function as patient/doctor      | Unauthorized access is prevented                               | Pass   |
| TC-07   | Doctor Verification | Administrator approves a pending doctor      | Doctor status changes to active/approved                       | Pass   |
| TC-08   | Doctor Verification | Administrator rejects a pending doctor       | Doctor is not available as an approved doctor                  | Pass   |
| TC-09   | User Management     | Administrator activates/deactivates a user   | User status is updated                                         | Pass   |
| TC-10   | User Management     | Administrator deletes a user                 | User is removed from the system                                | Pass   |
| TC-11   | Specialty           | Administrator adds a specialty               | Specialty is stored successfully                               | Pass   |
| TC-12   | Specialty           | Administrator deletes a specialty            | Specialty is removed successfully                              | Pass   |
| TC-13   | Availability        | Doctor creates an availability slot          | Slot is stored for the doctor                                  | Pass   |
| TC-14   | Availability        | Doctor deletes own availability slot         | Slot is removed successfully                                   | Pass   |
| TC-15   | Appointment         | Patient books an appointment                 | Appointment is created with Pending status                     | Pass   |
| TC-16   | Appointment         | Doctor accepts an appointment                | Appointment status changes to Accepted                         | Pass   |
| TC-17   | Appointment         | Doctor rejects an appointment                | Appointment status changes to Rejected                         | Pass   |
| TC-18   | Appointment         | Patient cancels an appointment               | Appointment status changes to Cancelled                        | Pass   |
| TC-19   | Appointment         | Doctor completes an appointment              | Appointment status changes to Completed                        | Pass   |
| TC-20   | Notes               | Doctor adds notes to an appointment          | Notes are stored with the appointment                          | Pass   |
| TC-21   | Review              | Patient submits a rating and review          | Review is stored successfully                                  | Pass   |
| TC-22   | Review Validation   | Patient submits an invalid rating            | Invalid rating is rejected                                     | Pass   |
| TC-23   | Doctor Search       | Patient searches for a doctor                | Matching doctors are returned                                  | Pass   |
| TC-24   | AJAX Search         | Send a search request to the search endpoint | JSON response containing matching doctors is returned          | Pass   |
| TC-25   | AJAX Search         | Search using an unmatched term               | Empty/no-result response is returned without breaking the page | Pass   |
| TC-26   | Session Security    | Access protected functionality without login | User is redirected or denied access                            | Pass   |



4. Role-Based Testing

Patient

The patient role was tested for:

* Registration and login
* Doctor search
* Appointment booking
* Appointment cancellation
* Viewing appointments
* Submitting doctor ratings and reviews
* Profile management

The patient should not be able to access administrator-only or doctor-only functions.

Doctor

The doctor role was tested for:

* Login
* Viewing appointments
* Accepting and rejecting appointments
* Completing appointments
* Managing availability slots
* Adding appointment notes
* Viewing reviews
* Profile management

The doctor should not be able to perform administrator-only operations.

Administrator

The administrator role was tested for:

* Viewing the administration dashboard
* Verifying doctors
* Managing users
* Managing specialties
* Accessing administrative functions

Administrator functions should be restricted from patients and doctors.



5. AJAX Search Testing

The doctor search functionality was tested using the `SearchController.php` endpoint.

The search process is:

1. User enters a search term.
2. JavaScript sends an AJAX request.
3. `SearchController.php` receives the request.
4. The database search method retrieves matching doctors.
5. The controller returns the result as JSON.
6. The frontend displays the matching doctors.

The endpoint was tested with:

* A valid doctor name.
* A valid specialty.
* Partial search text.
* An unmatched search term.
* An empty search request.

The expected behavior is that valid searches return matching approved doctors in JSON format, while unmatched searches return an empty result without causing a server-side error.



6. Database Testing

The database contains the following main tables:

* `users`
* `specialties`
* `appointments`
* `reviews`
* `slots`

Foreign-key relationships were tested for appointment, review and availability operations.

Appointments connect patients and doctors through the `users` table. Reviews also connect patients and doctors through the `users` table, while availability slots belong to doctors.



7. Error and Security Testing

The application was checked for common access-control problems.

Tests included:

* Accessing protected pages without authentication.
* Attempting to use administrator functionality as a patient.
* Attempting to use doctor functionality as a patient.
* Submitting incomplete form data.
* Submitting invalid rating values.
* Using invalid appointment or user identifiers.

The expected behavior is that unauthorized or invalid requests are rejected and that the application does not expose protected functionality.


8. Test Summary

The main MediBook workflows were tested across the three supported user roles.

The tests covered authentication, authorization, administration, specialties, availability, appointments, notes, reviews and AJAX doctor searching.

The results indicate that the implemented functionality operates according to the intended project workflow.

Further testing can be performed with additional edge cases, larger datasets and security-focused testing before production deployment.
