# StudentHub 

A beginner-friendly PHP/MySQL student portal starter project for XAMPP. It includes responsive pages, an olive-green theme, registration/login, session-based access, admin dashboard, student profile, event CRUD API, external JSON-driven FAQ/notices/events, search/filter/sorting/pagination, a slider, modal, notification banner, hamburger navigation, and light/dark theme toggle.

## Requirements
- XAMPP (Apache + MySQL/MariaDB)
- PHP 8+ recommended
- Modern browser

## Install on Windows/XAMPP
1. Extract this folder into `C:\xampp\htdocs\StudentHub`.
2. Open XAMPP Control Panel and start **Apache** and **MySQL**.
3. Open `http://localhost/phpmyadmin/`.
4. Import `database/schema.sql` using the Import tab.
5. Open `config/db.php` and confirm the database username/password. Default XAMPP values are usually `root` and an empty password.
6. Visit `http://localhost/StudentHub/`.

## Create an admin account
1. Register a normal account through the site.
2. In phpMyAdmin, open `studenthub_db` → `users` → SQL.
3. Run this query, replacing the email with your registered email:
   `UPDATE users SET role='admin' WHERE email='your-email@example.com';`
4. Sign out and sign in again. The Admin link should now appear.

## Pages included
- `index.php`, `about.php`, `register.php`, `login.php`, `dashboard.php`, `events.php`, `profile.php`, `admin.php`
- `contact.php`, `faq.php`, `feedback.php`, `form.php`, `example.php`, `test_db.php`
- JSON data: `data/events.json`, `data/notices.json`, `data/faqs.json`, `data/students.json`
- API endpoints: `api/events.php`, `api/profile.php`
- Shared code: `config/db.php`, `includes/*`, `assets/css/style1.css`, `assets/js/script.js`

## Security notes
- Passwords are stored using `password_hash()` and checked using `password_verify()`.
- Database writes use prepared statements.
- Pages that require authentication check the session.
- Admin operations check the session role on the server.
- This is a coursework starter project, not a production-ready system. Before public deployment, add CSRF protection, rate limiting, email verification, secure cookie settings, logging/monitoring, and HTTPS.
