<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');                                           //主键
            $table->string('name')->unique();                                   //用户名
            $table->string('tel')->unique();
            $table->string('email')->unique()->nullable();                                  //邮箱
            $table->string('password');                                         //密码

            //$table->integer('questions_count')->default(0);                     //提问总数
            //$table->integer('answers_count')->default(0);                       //回答总数
            $table->integer('followers_count')->default(0);  //粉丝（被关注）    //粉丝总数
            $table->integer('followings_count')->default(0);  //被粉（关注）     //关注人总数
            //$table->integer('attentions_count')->default(0);  //关注的话题       //关注话题总数
            //$table->integer('collections_count')->default(0);  //收藏的答案      //收藏列表总
            $table->integer('visitors')->default(0);  //访问者（游客）           //总访问量
            $table->integer('accumulate_points')->default(0);  //积分 **绑定邮箱加100**

            $table->string('avatar')->nullable();                               //头像uri
            $table->smallInteger('sex')->default(0);                            //性别
            $table->string('city')->nullable();                                 //所在地
            $table->string('job')->nullable();                                  //工作类别
            $table->string('signature')->default('这个人很懒,什么都没留下');  //签名

            $table->string('activation_token')->nullable();                     //会话验证码
            $table->boolean('activated')->default(false);                       //账户状态
            $table->rememberToken();                                            //跨域攻击验证码
            $table->timestamps();                                               //注册时间
            //登录日期
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
