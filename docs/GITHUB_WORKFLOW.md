# GitHub workflow (required by the brief)

## One-time (repo owner)
```bash
git init && git add . && git commit -m "Initial Laravel + Jetstream + Spatie setup"
git branch -M main
git remote add origin https://github.com/<user>/<repo>.git
git push -u origin main
git checkout -b develop && git push -u origin develop
```
Add every teammate as a collaborator (Settings > Collaborators).

## Each member
```bash
git clone <repo-url> && cd <repo>
git checkout develop && git pull
git checkout -b feature/<your-feature>
# work, then commit often with meaningful messages
git add .
git commit -m "Add unique constraint to course_registrations"
git push -u origin feature/<your-feature>
```
Open a **Pull Request into `develop`** on GitHub. Another member reviews and merges. Never push straight to `main` or `develop`.

## Suggested branches
| Member | Branch | Work |
|---|---|---|
| 1 | feature/database-relationships | Migrations, models, relationships |
| 2 | feature/seeders | Seeders and sample data |
| 3 | feature/auth-roles-permissions | Jetstream, Spatie, middleware, policies |
| 4 | feature/student-course-crud | Student and course CRUD |
| 5 | feature/registration-and-layout | Registration, Blade layout, README, screenshots |

Good commit messages: "Add students migration", "Validate duplicate course registration", "Add @can links to navigation". Avoid "update" or "fix".

## Final merge
1. Merge all PRs into `develop`.
2. On `develop`: `php artisan migrate:fresh --seed` and run the test checklist.
3. Open a PR `develop` into `main`, merge, and submit the repository URL.
