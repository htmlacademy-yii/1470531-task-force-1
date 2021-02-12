<?php

require_once 'classes/Task.php';

use classes\Task;

$task = new Task(1, 2);

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

assert($task->getCurrentStatus() === Task::STATUS_COMPLETED, 'Wrong task status');
assert($task->getAvailableStatuses() === $availableStatuses, 'Wrong available statuses');
assert($task->start() === Task::STATUS_STARTED, 'Wrong task status');
assert($task->complete() === Task::STATUS_COMPLETED, 'Wrong task status');
