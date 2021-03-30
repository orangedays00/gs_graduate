<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('ユーザーID');/* ユーザーID */
            $table->string('avatar_file_name')->nullable($value = true)->comment('画像');
            $table->string('gender')->nullable($value = true)->comment('性別');/* 性別 nullable($value = true) がnullを許容する */
            $table->string('prefecture')->nullable($value = true)->comment('都道府県');/* 都道府県 */
            $table->string('birthday')->nullable($value = true)->comment('誕生日');/* 誕生日 */
            $table->string('period')->nullable($value = true)->comment('在籍期');/* 在籍した期 */
            $table->string('reasons_admission')->nullable($value = true)->comment('入学理由');
            $table->string('selected_mentor')->nullable($value = true)->comment('選択メンター');
            $table->string('submission_assignments')->nullable($value = true)->comment('提出課題');
            $table->string('graduation_project_url')->nullable($value = true)->comment('卒業制作（URL）');
            $table->string('graduation_project_proposal')->nullable($value = true)->comment('卒業制作（企画書）');
            $table->string('stressed_gs')->nullable($value = true)->comment('G\'s時代に悩んだこと');
            $table->string('github_account')->nullable($value = true)->comment('GitHub');
            $table->string('qiita_account')->nullable($value = true)->comment('Qiitaアカウント');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
