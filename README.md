# 🏥 MediBook — Online Doctor Appointment & Clinic Booking System

A web-based doctor appointment and clinic booking system where patients find doctors by
specialty and book available time slots online, doctors manage their schedules and
consultations, and an administrator oversees the whole platform.

> **Course:** CSC 3215 — Web Technologies (Summer 2025–26)
> **University:** American International University-Bangladesh (AIUB)
> **Section:** J &nbsp;|&nbsp; **Group:** 10

---

## 👥 Team Members

| SL | Student ID | Name | Role |
|----|------------|------|------|
| 1 | 22-47788-2 | Muhtasim Fuad Nahin | Group Leader |
| 2 | 23-50440-1 | Sudipto Samadder Dipro | Member |

---

## 📖 About the Project

Booking a doctor's appointment is still a largely manual process for many clinics — phone
calls, queues, and no clear view of who is available or when. MediBook moves the entire
process online with a simple, smooth workflow, built entirely with the technologies covered
in the course.

The system has **three types of users**, each with its own distinct features, plus a set of
common features shared by all.

---

## ✨ Features

### Common (all users)
- User registration
- Login / Logout (with a "Remember Me" option)
- Manage profile (view, edit, delete)
- Change / reset password
- Personalized dashboard after login

### 🧑‍💼 Patient
- Search doctors by specialty (live AJAX search)
- Book an available time slot
- Cancel an existing booking
- Rate & review a doctor after a completed visit

### 🩺 Doctor
- Set and manage available time slots
- Accept / reject / complete appointment requests
- Write prescription / consultation notes

### 🛡️ Admin
- Verify / approve (or reject) new doctor accounts
- Manage medical specialties (add, edit, delete)
- View all appointments with basic statistics
- Manage user accounts (deactivate / remove)

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|------------|
| Front end | HTML, CSS, JavaScript |
| Back end | PHP (Model–View–Controller structure) |
| Database | MySQL |
| Auth | PHP Sessions + Cookies |
| Data exchange | JSON |
| Dynamic updates | AJAX |
| Server | Apache (via XAMPP) |

---

## 📁 Project Structure (MVC)

```
MediBook/
├── View/          # All pages the user sees (.php)
├── Controller/    # PHP logic: validation, sessions, routing
├── Model/         # Data layer (JSON now → MySQL for final)
├── Design/        # Style.css
├── Javascript/    # Script.js (client-side validation + AJAX)
└── README.txt     # Local project notes
```

---

## 🚀 Getting Started

1. Install [XAMPP](https://www.apachefriends.org/) and start **Apache** (and **MySQL** once the database is added).
2. Clone this repository into the XAMPP web root:
   ```bash
   git clone https://github.com/<your-username>/WebTech_Summer25-26_Group_10.git
   ```
   Place the project folder inside `xampp/htdocs/`.
3. Open the app in your browser:
   ```
   http://localhost/MediBook/View/index.php
   ```

---

## 🗺️ Use Case Diagram

The use case diagram (Patient, Doctor, Admin) is available in the `docs/` folder.

![Use Case Diagram](docs/usecase.png)

---

## 🖼️ Screenshots

_Add screenshots of the main pages here as the project progresses._

| Login | Patient Dashboard | Search Doctors |
|-------|-------------------|----------------|
| _(add image)_ | _(add image)_ | _(add image)_ |

---

## 📌 Project Milestones

- [x] **16 Aug** — Frontend implementation + draft report (Title, Description, Introduction, Background Study, Use Case Diagram, UI)
- [ ] **23 Aug** — Frontend & backend validation + ER Diagram
- [ ] **30 Aug** — Complete implementation: database connection, sessions/cookies, JSON, AJAX, and additional features

---

## 📝 License

This project is developed for academic purposes as part of the CSC 3215 (Web Technologies)
course at AIUB.
