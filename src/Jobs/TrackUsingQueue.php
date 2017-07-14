<?php

namespace Ubeeqo\LaravelSift\Jobs;

use Ubeeqo\LaravelSift\Jobs\Job;
use Ubeeqo\LaravelSift\SiftScience;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrackUsingQueue extends Job implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The type of event to record in Sift
     *
     * @var string
     */
    protected $type;

    /**
     * The properties about the event
     *
     * @var array
     */
    protected $properties;

    /**
     * Create a new instance
     *
     * @param string $type
     * @param array  $properties
     */
    public function __construct($type, $properties)
    {
        $this->type = $type;
        $this->properties = $properties;
    }

    /**
     * Execute the job
     *
     * @param Ubeeqo\LaravelSift\SiftScience $sift
     */
    public function handle(SiftScience $sift)
    {
        $sift->client()->track($this->type, $this->properties);
    }
}
