<?php

namespace App\Subscribers;

use Spatie\ResponseCache\Facades\ResponseCache;
use Statamic\Events\Concerns\ListensForContentEvents;

class ResponseCacheStatamicSubscriber
{
    use ListensForContentEvents;

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        foreach ($this->events as $event) {
            $events->listen($event, self::class.'@clear');
        }
    }

    /**
     * Commit changes.
     *
     * @param mixed $event
     */
    public function clear()
    {
        if (config('responsecache.enabled')) {
            ResponseCache::clear();
        }
    }
}