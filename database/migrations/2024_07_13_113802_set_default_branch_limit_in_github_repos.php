<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetDefaultBranchLimitInGithubRepos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('github_repos', function (Blueprint $table) {
            $table->integer('branch_limit')->default(5)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('github_repos', function (Blueprint $table) {
            $table->integer('branch_limit')->default(null)->change();
        });
    }
}
