<?php

namespace App;

use App\Services\ReminderService;

class MyClass
{
    protected $reminderService;

    public function __construct(ReminderService $reminderService)
    {
        $this->reminderService = $reminderService;
    }

    public function __invoke()
    {
        $this->reminderService->sendReminders();

        logger()->info('sendReminders executed from invokable class');
    }
}
