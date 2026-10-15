<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Storage;

class ExportUserInfo implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected User $user)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->refresh();
        $this->user->load("fortunes");

        $resource = $this->user->toResource()->toJson();

        Storage::put("exports/{$this->user->id}-" . now()->toAtomString() . ".json", $resource);
    }
}
