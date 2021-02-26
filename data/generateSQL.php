<?php

require_once '../config.php';

use Taskforce\Helpers\CSV\CSVConverter;

$City = new CSVConverter('cities.csv', '01_city.sql', 'city');
$City->create();

$Category = new CSVConverter('categories.csv', '02_category.sql', 'category');
$Category->create();

$Specializations = new CSVConverter('specializations.csv', '03_specialization.sql', 'specialization');
$Specializations->create();

$User = new CSVConverter('users.csv', '04_user.sql', 'user');
$User->create();

$UsersSpecializations = new CSVConverter('users_specializations.csv', '05_user_specialization.sql',
    'user_specialization');
$UsersSpecializations->create();

$Profile = new CSVConverter('profiles.csv', '06_profile.sql', 'profile');
$Profile->create();

//$Photos = new CSVConverter('photo_of_work.csv', '07_photo_of_work.sql', 'photo_of_work');
//$Photos->create();

$Task = new CSVConverter('tasks.csv', '08_task.sql', 'task');
$Task->create();

//$TaskFile = new CSVConverter('tasks_files.csv', '09_task_file.sql', 'task_file');
//$TaskFile->create();

$Response = new CSVConverter('responses.csv', '10_response.sql', 'response');
$Response->create();

$Review = new CSVConverter('reviews.csv', '11_review.sql', 'review');
$Review->create();

//$Notification = new CSVConverter('notifications.csv', '12_notification.sql', 'notification');
//$Notification->create();
