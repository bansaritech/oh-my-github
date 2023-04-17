<?php

namespace App\Jobs;

use App\Models\Collaborator;
use App\Models\GithubRepo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScanProfile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use StandardJob;
    private $token;
    private $scan_id;
    private $broker;
    private $scanner;
    private $cmd;

    /**
     * Create a new job instance.
     */
    public function __construct($token, $scan_id)
    {
        $this->token = $token;
        $this->scan_id = $scan_id;
        $this->broker = null;
        $this->scanner = null;
        $this->cmd = null;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Clean repos
        $repos = GithubRepo::whereUserId($this->uid())->get();
        foreach($repos as $repo)
        {
            $repo->collaborators()->detach();
            $repo->delete();
        }

        // Clean collaborators
        Collaborator::whereUserId($this->uid())->delete();

        // dispatch job to scan repo
        $this->dispatchJob(ScanRepo::class);
    }
}
