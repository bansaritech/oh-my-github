<?php

namespace App\Jobs;

use App\GithubClient\Broker;
use App\Models\GithubRepo;
use App\Models\Scan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\jobs\StandardJob;

class ScanRepo implements ShouldQueue
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

   
        $this->log("\n\nJob started");
        $github = $this->github();
        $repos = $github->getRepositories();
        $this->log("Repo Scan completed, found " . count($repos) . " repositories");
        foreach ($repos as $r)
        {
            $name = $r['full_name'];
            $this->log("Scanning $name.");
            $fork = $r['fork'];
            $github_repo = new GithubRepo();
            $github_repo->user_id = $this->getScan('user_id');
            $github_repo->scan_id = $this->getScan('id');
            $github_repo->name = $name;
            $github_repo->fork = $fork;
            $github_repo->details = $r;
            $github_repo->save();
            if(!$fork) {
                $this->dispatchJob(ScanCollabs::class, $github_repo->id);
            }
        }
    }

    
}
