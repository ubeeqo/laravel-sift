<?php

namespace ubeeqo\LaravelSift\Listeners;

use Illuminate\Session\Store;
use ubeeqo\LaravelSift\SiftScience;
use ubeeqo\LaravelSift\Jobs\TrackUsingQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;

abstract class RecordAuthAction
{
    use DispatchesJobs;

    protected $session;
    protected $sift;

    /**
     * Create the event listener.
     *
     * @param \Illuminate\Session\Store $session
     * @param \ubeeqo\LaravelSift\SiftScience $sift
     * @return void
     */
    public function __construct(Store $session, SiftScience $sift)
    {
        $this->session = $session;
        $this->sift = $sift;
    }

    /**
     * Dispatch a queued job to track the event
     *
     * @param string $type
     * @param array  $properties
     */
    protected function track($type, $properties)
    {
        $this->dispatch(
            new TrackUsingQueue($type, $properties)
        );
    }
}
