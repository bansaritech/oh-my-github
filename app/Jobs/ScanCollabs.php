<?php

namespace App\Jobs;

use App\Models\Collaborator;
use App\Models\GithubRepo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScanCollabs  implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use StandardJob;

    private $token;
    private $scan_id;
    private $broker;
    private $scanner;
    private $cmd;

    protected $repo;

    /**
     * Create a new job instance.
     */
    public function __construct($token, $scan_id, ?int $repo = null)
    {
        $this->token = $token;
        $this->scan_id = $scan_id;
        $this->broker = null;
        $this->scanner = null;
        $this->cmd = null;
        if($repo) {
            $this->repo = $repo;
        }
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $repo = GithubRepo::find($this->repo);
        $collabs = $this->github()->getCollaborators($repo->name);
        if($collabs == NULL) {
            $this->log("Collaborator missing.");
        } else {
            $this->log("Collaborators: " . count($collabs));
        }
        foreach ($collabs as $usr)
        {
            $gid = $usr['id'];
            $name = $usr['login'];
            $this->log("   - $name");
            $col = Collaborator::whereGid($gid)->first();
            if (!$col) {
                $col = new Collaborator();
                $col->gid = $gid;
                $col->name = $name;
                $col->user_id = $this->getScan('user_id');
                $col->details = $usr;
                $col->save();
            }
            $repo->collaborators()->attach($col);
        }
    }
}
