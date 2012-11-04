<?php

class View_Settings_Index extends ViewModel
{
    public function view()
    {
        function search_word($entry, $keywords) 
        {
            if (mb_strlen(trim($keywords)) === 0) { return ""; }
                $hit_words = array();
            $keyword_list = explode(',', $keywords);
            foreach ($keyword_list as $keyword) {
                if ($keyword != "" &&
                    ( 
                        mb_strpos($entry->title, trim($keyword)) > -1 || 
                        stripos($entry->title, trim($keyword)) > -1 ||
                        mb_strpos($entry->body, trim($keyword)) > -1 || 
                        stripos($entry->body, trim($keyword)) > -1
                    )

                ) 
                {
                    array_push($hit_words, $keyword);
                }
            }
            return implode(',', $hit_words);
        }

        $this->screen_name = Session::get('screen_name');
        $this->twitter_url = "http://twitter.com/$this->screen_name";

        $this->is_enabled = function($user) {
            return $user->enable == 1 ? true:false;
        };

        $this->is_tweeted = function($diary_id, $tweet_list) {
            $tweeted = false;
            foreach ($tweet_list as $tweet) 
            {
                if ($diary_id === $tweet->diary_id) 
                {
                    $tweeted = true;
                    break;
                }
            }
            return $tweeted;
        };

        $this->get_hit_word = function($entry, $keywords) {
            return search_word($entry, $keywords);
        }; 
        $this->is_hit = function($entry, $keywords) {
            return mb_strlen(trim(search_word($entry, $keywords))) > 0 ? true:false;
        };
        $this->get_hatena_url = function($entry) {
            return "http://d.hatena.ne.jp$entry->path";
        };
    }
}
