# Contribution Report: BUC3131 Coursework Two

Project: MUBS Student Management System (Laravel). Repository: https://github.com/petrahketra-tech/Student_Management_System (private).

Group members: Nakyanzi Petra Ketra 24/U/18277/PS, Mutesi Joan 24/U/17348/PS, Muyomba Ashiraf 24/U/24311/PS

## Members, branches and tasks

| Member | GitHub | Branch | Pull requests | Tasks completed |
|---|---|---|---|---|
| Nakyanzi Petra Ketra | petrahketra-tech | feature/database-and-seeders, feature/readme-and-report | #1,  | Created the Laravel project with Jetstream and Spatie permission (initial commit on main). Wrote the first migrations, models, controllers, views and seeders, set up the roles and permissions, and changed the courses to BBC, BBA and the other degree courses (#1). README, screenshots and this report. |
| Muyomba Ashiraf | 2400724311-ship-it | feature/database-relationships | #2 | Added more sample students and their course registrations in the seeders (#2). Checked the relationships and the unique registration constraint.|
| Mutesi Joan | MJoan505 | feature/crud-and-layouts | #3 | Added search by name to the students list (controller and Blade page). Also went though the layouts to make sure everything is on point. |

## Pull requests

| No. | Title | Author | From and to | Status |
|---|---|---|---|---|
| #1 | Change courses to BBC, BBA and others, remove credit units | petrahketra-tech | feature/database-and-seeders into develop | Approved and merged by MJoan505 |
| #2 | Add more sample students and course registrations | 2400724311-ship-it | feature/database-relationships into develop | Approved and merged by MJoan505 |
| #3 | Add search by name to the students list | MJoan505 | feature/crud-and-layouts into develop | approved and merged by petraketra-tech |
| #4 | Update README and add contribution report | petrahketra-tech | feature/readme-and-report into develop | approved by MJoan505 and merged by 2400724311-ship-it |
| #5 | Final merge | petrahketra-tech | develop into main | 2400724311-ship-it |

## Branching and review

- `main` holds the stable code and `develop` is used for integration
- Each member used their own feature branch and opened pull requests into `develop`
- Reviews: #1 approved by MJoan505, #2 approved by MJoan505, #3 approved by petrahketra-tech, #4 approved by 2400724311-ship-it, #5 approved by 2400724311-ship-it

## Testing

The integrated `develop` branch was tested by petrahketra-tech on 9/11/2026 with the admin, lecturer and student logins, using `php artisan migrate:fresh --seed`, before it was merged into `main`.

## Individual notes

- Ketra: authentication, roles and permissions, controllers, made the reports and README for the work. Also merged the final work on github.
- Ashiraf: the database design, relationships and seeders, added new courses and their relationships.
- Joan: the student pages, the layout and the search for the students.
