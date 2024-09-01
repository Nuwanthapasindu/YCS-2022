
# Student-Attendance-Marker

![Student-Attendance-Marker](https://dl.dropboxusercontent.com/s/ui08l4x0hnzoq8a/cf753b3e41634cafb24b149bf779ca31-0001.jpg?dl=0)

Student Attendance Marking System This web application can mark daily student attendance.

## This system has three main roles.
- Administrator 
- Section head 
- Teacher

Admin can create a section head account using section, email and temporarily generated password.

Using this data, the system automatically creates a user account, creates the section head class, automatically assigns that user to the class and sends an email to the user with an email and temporary password.

Similarly, Heads of Sections can set up the account of teachers in their section as above

Teachers can add their class student list.
after that Teachers can the mark student attendance

When the teacher is not able to mark the attendance, any other teacher working in the same section  can mark the class attendance of that teacher

On the teacher dashboard they can view the last week's student attendance report along with the teacher's name

In the section head dashboard they can view their section daily student attendance along with total student attendance

In the Principal dashboard also, the Principal can view the daily attendance of all the school students and he can view section wise student attendance

## Database Diagram
![DB-diagram](https://dl.dropbox.com/scl/fi/dtozp3rn14hln9dvtind6/YCS.png?rlkey=ksx8t8l6ondn473wwhe39v292&st=pcnct8j4&dl=0)

## Technologies and Packages Used

- Vue js 
- Laravel

### How to run the code

- `Git` from here: `https://git-scm.com/downloads`. If you already installed, skip this step.
- `Composer` from here: `https://getcomposer.org/download`. If you already installed, skip this step.
- `Xammp` from here: `https://www.apachefriends.org/download.html`. If you already installed, skip this step.
- Clone this repository by running below command or downloading the zip file for the code.
```sh
https://github.com/NuwanthaPasindhu/Student-Attendance-Marker
```
- Change directory to the frontend folder
```sh
cd Student-Attendance-Marker/webapp
```
- Install the necessary dependencies.
```sh
npm install --save
```

- Change directory to the server folder
```sh
cd Student-Attendance-Marker/server
```
- Install the necessary dependencies.
```sh
composer update
```
- update .env file with your DB Cridentials
```sh

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=server
DB_USERNAME=root
DB_PASSWORD=
```
- migrate Data base

```sh
php artisan migrate
```
- start tinker session to add dummy Admin data

```sh
php artisan tinker
```

```sh
    User::factory()->create();
    section::factory()->create();
    sectionClasses::factory()->create();
    UserClasses::factory()->create();
```


- setup laravel passport

```sh
php artisan passport:install --force
```
```sh
PASSPORT_PERSONAL_ACCESS_CLIENT_ID="1"
PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET  // passport generated secret key
```


- start laravel server

```sh
php artisan serve
```
- Root Userauthentication Cridentials
 ```sh
 Email - admin@admin.com
 Password - 12345678
 ```

## Authors

- [@NuwanthaPasindhu](https://www.github.com/https://github.com/NuwanthaPasindhu)


## License

[Apache License 2.0](https://choosealicense.com/licenses/apache-2.0/)
