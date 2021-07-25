<?php

namespace App\Listeners;

use App\Events\CategoryCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;

class SendCategoryCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CategoryCreated  $event
     * @return void
     */
    public function handle(CategoryCreated $event)
    {
        $current_timestamp = Carbon::now()->toDateTimeString();
        $categoryInfo = $event->category;


        //You can write for anything...

        return true;
    }
}
