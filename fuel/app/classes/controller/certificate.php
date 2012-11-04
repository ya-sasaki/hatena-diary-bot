<?php

class Controller_Certificate extends Controller_Template
{

    public function action_login()
    {
        Session::destroy();
        $this->template->title = 'Hatena Diary Keyword Bot | Login';
        $this->template->content = View::forge('certificate/login');
    }

    public function action_logout()
    {
        Twitter::logout();
        Response::redirect('certificate/login');
    }

    public function action_oauth()
    {
        if (!Session::get('screen_name') || !Twitter::logged_in())
        {
            Twitter::set_callback(Uri::create('certificate/callback'));
            Twitter::login();
        }
        Response::redirect('settings');
    }

    public function action_callback()
    {
        $tokens = Twitter::get_tokens();
        if (!isset($tokens['oauth_token']) || !isset($tokens['oauth_token_secret']))
        {
            Response::redirect('certificate/login');
        }
        $twitter_user = Twitter::get('account/verify_credentials');
        $user = Model_User::find()->where('screen_name', $twitter_user->screen_name)->get_one();
        if (!$user)
        {
            $user = Model_User::forge();
        }

        $user->screen_name = $twitter_user->screen_name;
        $user->token = $tokens['oauth_token'];
        $user->token_secret = $tokens['oauth_token_secret'];
        $user->save();
        
        Session::set('screen_name', $user->screen_name);

        Response::redirect('settings');
    }

}
