<?php
/**
 * Created by PhpStorm.
 * User: lindy
 * Date: 16/9/1
 * Time: 下午8:53
 */

namespace App\Mailer;


class UserMailer extends Mailer
{
    public function welcome($user){
        $subject = '街坊邮箱确认';
        $view = 'welcome';
        $data = ['%name%' => [$user->name],'%confirm_code%' => [$user->confirm_code]];
        $this->sendTo($user, $subject, $view, $data);
    }

    public function forgetPassword(){

    }
}