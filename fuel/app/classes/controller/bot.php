<?php

class Controller_Bot extends Controller
{
    public function action_index()
    {
        $users = Model_User::find()->where('enable', 1)->order_by('post_at')->limit(10)->get();

        foreach ($users as $user) 
        {
            Model_Bot::bot($user);
        } 
        exit;
    }
}
