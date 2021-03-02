<?php

use Taskforce\Exceptions\PermissionException;
use Taskforce\Models\Task;

require_once '../config.php';

// Активация утверждений и отключение вывода ошибок
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);

// Создание обработчика
function my_assert_handler($file, $line, $code, $desc = null)
{
    print_r($desc);
}

// Подключение callback-функции
assert_options(ASSERT_CALLBACK, 'my_assert_handler');

$availableStatuses = [
    'started' => 'В работе',
    'canceled' => 'Отменено'
];

$task = new Task(1, 2, 1);
assert($task->getCurrentStatus() === Task::STATUS_COMPLETED, 'Test Wrong task status');
assert($task->getAvailableStatuses() === $availableStatuses, 'Test Wrong available statuses');

/*
 * Создание задачи
 * Пользователь не может создать задачу
 * */
try {
    $task = new Task(1, null, 2);
    $task->create();
} catch (PermissionException $e) {
    my_assert_handler(null, null, null, "Test Customer can't create task, he is not an owner - OK");
    echo '</br>';
}

/*
 * Создание задачи
 * Пользователь может создать задачу
 * */
try {
    $task = new Task(1, null, 1);
    $task->create();
} catch (PermissionException $e) {
    my_assert_handler(null, null, null, "Test Customer can create task - ERROR");
    echo '</br>';
}

/*
 * Взятие задачи
 * Пользователь не может взять задачу, т.к. ее взял другой пользователь
 * */
try {
    $task = new Task(1, 2, 1);
    $task->start();
} catch (PermissionException $e) {
    my_assert_handler(null, null, null, "Test Customer can't start task. Other user is already take it - OK");
    echo '</br>';
}

/*
 * Взятие задачи
 * Пользователь может взять задачу
 * */
try {
    $task = new Task(1, null, 1);
    $task->start();
} catch (PermissionException $e) {
    my_assert_handler(null, null, null, "Test Customer can't start task - ERROR");
    echo '</br>';
}

/*
 * Завершение задачи
 * Пользователь не может завершить задачу
 * */
try {
    $task = new Task(1, 2, 2);
    $task->complete();
} catch (PermissionException $e) {
    my_assert_handler(null, null, null, "Test Customer can't complete task - OK");
    echo '</br>';
}

/*
 * Завершение задачи
 * Пользователь может завершить задачу
 * */
try {
    $task = new Task(1, 2, 1);
    $task->complete();
} catch (PermissionException $e) {
    my_assert_handler(null, null, null, "Test Customer can't complete task - ERROR");
    echo '</br>';
}

/*
 * Отмена задачи
 * Пользователь не может завершить задачу
 * */
try {
    $task = new Task(1, 2, 2);
    $task->cancel();
} catch (PermissionException $e) {
    my_assert_handler(null, null, null, "Test Customer can't cancel task - OK");
    echo '</br>';
}

/*
 * Отмена задачи
 * Пользователь может завершить задачу
 * */
try {
    $task = new Task(1, 2, 1);
    $task->cancel();
} catch (PermissionException $e) {
    my_assert_handler(null, null, null, "Test Customer can't cancel task - ERROR");
    echo '</br>';
}

/*
 * Провал задачи
 * Пользователь не может провалить задачу
 * */
try {
    $task = new Task(1, 2, 3);
    $task->fail();
} catch (PermissionException $e) {
    my_assert_handler(null, null, null, "Test Customer can't fail task - OK");
    echo '</br>';
}

/*
 * Провал задачи
 * Пользователь может провалить задачу
 * */
try {
    $task = new Task(1, 2, 2);
    $task->fail();
} catch (PermissionException $e) {
    my_assert_handler(null, null, null, "Test Customer can't fail task - ERROR");
    echo '</br>';
}
