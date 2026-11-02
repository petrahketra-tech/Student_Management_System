# Adding these files to your Laravel + Jetstream project (simple version)

Run every command in the VS Code terminal, inside the project folder.

## 0. If you used the FIRST version of the files, clean up first
```powershell
Remove-Item app\Policies, app\Listeners, app\Models\Concerns, database\seeders\Concerns -Recurse -Force -ErrorAction SilentlyContinue
(Get-Content app\Models\User.php) | Where-Object { $_ -notmatch 'HasSmsRelations' -and $_ -notmatch 'Traits.HasRoles' } | Set-Content app\Models\User.php
```
This deletes the old extra folders and removes the old trait lines from `User.php`. Skip this step if you never copied the first version.

## 1. Packages (skip what you already did)
```powershell
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

## 2. Copy the files
```powershell
Expand-Archive -Path "$HOME\Downloads\sms-student-management-simple.zip" -DestinationPath .\_sms_tmp -Force
Copy-Item .\_sms_tmp\sms\* . -Recurse -Force
Remove-Item .\_sms_tmp -Recurse -Force
```

## 3. Edit `app/Models/User.php` by hand
At the top, with the other `use` lines, add:
```php
use Spatie\Permission\Traits\HasRoles;
```
Inside the class, add `HasRoles` to the traits line (keep the ones already there):
```php
use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, HasRoles;
```
Then add these two methods anywhere inside the class:
```php
// a user (student) has one student record
public function student()
{
    return $this->hasOne(Student::class);
}

// a user (lecturer) teaches many courses
public function taughtCourses()
{
    return $this->hasMany(Course::class, 'lecturer_id');
}
```

## 4. Edit `bootstrap/app.php` by hand
Make the middleware section look like this:
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
    ]);
})
```

## 5. (Optional) Give new sign-ups the student role automatically
In `app/Actions/Fortify/CreateNewUser.php`, change the `return User::create([...]);` so the user is saved to a variable first:
```php
$user = User::create([
    'name' => $input['name'],
    'email' => $input['email'],
    'password' => Hash::make($input['password']),
]);

$user->assignRole('student');

\App\Models\Student::create([
    'user_id' => $user->id,
    'student_number' => 'REG-' . $user->id,
    'name' => $user->name,
    'email' => $user->email,
]);

return $user;
```
Without this step a new sign-up has no role until an admin sets one.

## 6. Database and run
Make sure MySQL is green, `.env` has your database name, then:
```powershell
php artisan optimize:clear
php artisan migrate:fresh --seed
npm run build
php artisan serve
```
Log in as `admin@mubs.ac.ug` / `password`.

## 7. Test checklist
- Admin: add, edit, delete a student and a course; register a student; register the same pair twice and see the error message.
- Lecturer (`lecturer1@mubs.ac.ug`): only BUC3131 and BUC3130 show; `/students` gives 403.
- Student (`student1@mubs.ac.ug`): sees all courses and only their own registrations; `/students` and `/users` give 403.
