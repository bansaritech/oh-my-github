<?php

namespace App\Jobs;

use App\GithubClient\Broker;
use App\Models\Collaborator;
use App\Models\GithubRepo;
use App\Models\Scan;
use Collator;
use Symfony\Component\Console\Output\ConsoleOutput;

trait StandardJob
{
    public function uid()
    {
        return $this->getScan('user_id');
    }

    public function getScan(?string $field): mixed
    {
        if (!$this->scanner) {
            $this->scanner = Scan::find($this->scan_id); 
        }
        if (!$field) {
            return $this->scanner;
        }
        return $this->scanner->$field;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    private function getCmd()
    {
        if(!$this->cmd)
        {
            $this->cmd = new ConsoleOutput();
        }
        return $this->cmd;
    }

    public function log(string $statment): void
    {
        $this->getCmd()->writeln($statment);
    }

    public function dispatchJob($cls, ?int $repo = null)
    {
        if($repo) {
            dispatch(new $cls($this->token, $this->scan_id, $repo));
        } else {
            dispatch(new $cls($this->token, $this->scan_id));
        }
    }

    public function github(): Broker
    {
        if(!$this->broker) {
            $this->broker = new Broker($this->token, $this->getScan('scan_on'));
        }
        return $this->broker;
    }

}
