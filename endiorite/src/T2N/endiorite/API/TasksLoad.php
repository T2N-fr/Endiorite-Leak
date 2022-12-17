<?php

namespace T2N\endiorite\API;

use T2N\endiorite\Main;
use T2N\endiorite\tasks\SayTask;
use T2N\endiorite\tasks\ScoreboardTask;

class TasksLoad {

    public function __construct() {
        Main::$instance->getScheduler()->scheduleRepeatingTask(new SayTask(), 20 * 900);
        Main::$instance->getScheduler()->scheduleRepeatingTask(new ScoreboardTask(), 20 * 10);
    }

}