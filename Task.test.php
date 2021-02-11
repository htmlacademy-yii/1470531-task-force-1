<?php
require_once 'classes/Task.php';
use classes\Task;

$task = new Task(1, 1);

assert($task->getCurrentStatus() === Task::STATUS_NEW, print_r('complete task'));
