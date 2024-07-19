<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchLimitToGithubReposTable extends Migration
{
    public function up()
    {
        Schema::table('github_repos', function (Blueprint $table) {
            $table->integer('branch_limit')->default(5);
        });
    }

    public function down()
    {
        Schema::table('github_repos', function (Blueprint $table) {
            $table->dropColumn('branch_limit');
        });
    }
}
