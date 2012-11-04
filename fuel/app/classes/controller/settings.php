<?php

class Controller_Settings extends Controller_Template
{
    public function before() 
    {
        parent::before();

        if (!Session::get('screen_name') || !Twitter::logged_in())
        {
            Response::redirect('certificate/login');
        }
    }

    public function action_index()
    {
        $this->template->title = 'Hatena Diary Keyword Bot | Settings';
        $this->template->content = ViewModel::forge('settings/index');

        // get Settings
        $user = Model_User::find()->where('screen_name', Session::get('screen_name'))->get_one();
        // do_filterでpostされた場合
        $include_keywords = Input::post('include_keywords');
        $exclude_keywords = Input::post('exclude_keywords');
        if (isset($include_keywords)) 
        {
            $user->include_keyword = $include_keywords;
        }
        if (isset($exclude_keywords)) 
        {
            $user->exclude_keywords = $exclude_keywords;
        }

        $this->template->content->user = $user;

        // get contents
        $contents_list = array();
        $histories = array();
        if (isset($user->include_keyword)) 
        {
            $contents_list = Model_Contents::search_contents($user->include_keyword); 
            $histories = Model_History::find_tweet($user->screen_name);
        }
        $this->template->content->list = $contents_list;
        $this->template->content->histories = $histories;
    }

    public function action_status($param)
    {
        $this->template->title = 'Hatena Diary Keyword Bot | Settings';
        $this->template->content = ViewModel::forge('settings/index');

        // get Settings
        $user = Model_User::find()->where('screen_name', Session::get('screen_name'))->get_one();
        $user->enable = $param === 'enable' ? 1:0;
        $user->save();

        Response::redirect('settings');
    }

    public function action_delete()
    {
        $user = Model_User::find()->where('screen_name', Session::get('screen_name'))->get_one();
        $user->delete();
        DB::delete('histories')->where('screen_name', Session::get('screen_name'))->execute();

        Response::redirect('certificate/logout');
    }

    public function action_save()
    {
        $user = Model_User::find()->where('screen_name', Session::get('screen_name'))->get_one();
        $user->include_keyword  = Input::post('include_keywords');
        $user->exclude_keywords = Input::post('exclude_keywords');
        $user->save();
        Response::redirect('settings');
    }
}
