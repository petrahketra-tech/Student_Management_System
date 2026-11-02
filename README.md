# MUBS Student Management System

BUC3131 Advanced Web Application Development: Coursework Two (2026/27).
A Laravel application for managing students, courses, lecturers and course registrations.

**Stack:** Laravel 11/12, Laravel Jetstream (Livewire), Spatie laravel-permission, MySQL, Blade, Tailwind CSS.

## Features
- Authentication with Jetstream (login, register, profile)
- Three roles with permissions: **admin**, **lecturer**, **student**
- Student CRUD and course CRUD (admin)
- Course registration with validation and duplicate prevention (unique `student_id + course_id`, plus a check in the controller)
- Role-based views: admin sees everything, lecturers see their own courses and the students registered in them, students see courses and only their own registrations
- Admin screen to change user roles
- Reusable Blade layout (header, navigation, content, footer) with permission-aware links

## Installation
```bash
git clone <REPOSITORY-URL> sms && cd sms
composer install
cp .env.example .env
php artisan key:generate
```

## Database setup
1. Create an empty MySQL database, e.g. `sms_db`.
2. Edit `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sms_db
DB_USERNAME=root
DB_PASSWORD=
```
3. Create the tables and sample data:
```bash
php artisan migrate --seed        # or: php artisan migrate:fresh --seed
```
4. Build the front end and run the server:
```bash
npm install && npm run build      # use `npm run dev` while developing
php artisan serve
```
Open http://127.0.0.1:8000

## Roles and permissions
| Role | Permissions | What they can do |
|---|---|---|
| admin | students.manage, courses.manage, registrations.manage, users.manage | Manage students, courses, registrations and user roles |
| lecturer | courses.view-assigned | View assigned courses and the students registered in them |
| student | courses.view-available, registrations.view-own, registrations.create-own | View courses, register, and view or drop their own registrations |

A person who signs up on the public register page has no role until an admin assigns one on the **User Access** page.

## Sample login credentials (password for all: `password`)
| Role | Email |
|---|---|
| Admin | admin@mubs.ac.ug |
| Lecturer | lecturer1@mubs.ac.ug, lecturer2@mubs.ac.ug |
| Student | student1@mubs.ac.ug ... student5@mubs.ac.ug |

## Database design
- `users` (Jetstream) 1 --- * `courses` (`courses.lecturer_id`)
- `users` 1 --- 1 `students` (`students.user_id`)
- `students` * --- * `courses` through `course_registrations` (unique `student_id, course_id`)

## Screenshots
Add the screenshots to `docs/screenshots/` and list them here:
- `01-login.png`, `02-admin-dashboard.png`, `03-students.png`, `04-courses.png`, `05-registrations.png`, `06-lecturer-courses.png`, `07-student-view.png`, `08-user-access.png`

## Team
See `docs/CONTRIBUTION_REPORT.md`.
