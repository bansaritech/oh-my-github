<?php
namespace App\GithubClient;

use Illuminate\Support\Facades\Http;

class Broker {

    private $token;
    private $username;

    function __construct(string $token, string $usr)
    {
        $this->token = $token;
        $this->username = $usr;
    }

    private function url(string $uri): string {
        $base = 'https://api.github.com';
        return $base . $uri;
    }

    private function headers(): array {
        return [
            "Accept" => "application/vnd.github+json",
            "Authorization" => "Bearer " . $this->token,
            "X-GitHub-Api-Version" => "2022-11-28",
        ];
    }

    public function api(string $method, string $uri): array {
        $res = Http::withHeaders($this->headers())
            ->$method($this->url($uri));
        return $res->json() ?? [];
    }

    public function getApi(string $uri): array {
        return $this->api('get', $uri);
    }

    public function getUser(string $login = null): array {
        $res = $this->getApi('/users/' . ($login ?? $this->username));
        return $res;
    }

    public function getMyRepositories(int $page = 1): array
    {
        $per_page = 100;
        $result = $this->getApi("/user/repos?type=all&per_page=".$per_page."&page=".$page);
        if(count($result) < $per_page) {
            return $result;
        } else {
            return array_merge($result, $this->getRepositories($page+1));
        }
        // TODO: handler exception
    }

    public function getRepositories($page=1): array {
        $per_page = 100;
        $result = $this->getApi("/users/" . $this->username . "/repos?per_page=".$per_page."&page=".$page);
        if(count($result) < $per_page) {
            return $result;
        } else {
            return array_merge($result, $this->getRepositories($page+1));
        }
        // TODO: handler exception
    }

    public function getCollaborators($repo): array {
        return $this->getApi("/repos/" . $repo . "/contributors");
    }
}