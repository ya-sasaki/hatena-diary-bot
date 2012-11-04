<?php

class Model_Bot
{
    static function bot($user) {
        $contents_list = Model_Contents::filtered_contents($user->include_keyword, $user->exclude_keywords);

        Twitter::set_access_tokens(array(
            "oauth_token" => $user->token,
            "oauth_token_secret" => $user->token_secret
        ));

        foreach ($contents_list as $entry)
        {
            // Tweet済のチェック
            $history = Model_History::find()->
                where('screen_name', $user->screen_name)->
                where('diary_id', $entry->path)->get_one();
            if ($history) 
            {
                continue;
            }
            $status  = $entry->title;
            $status .= ' - ';
            $status .= $entry->diary_title;
            $status .= ' (id:'.$entry->name.') ';
            $status .= 'http://d.hatena.ne.jp'.$entry->path;

            $result = Twitter::post('statuses/update', array('status' => $status));

            // 履歴の登録
            $history = Model_History::forge();
            $history->screen_name = $user->screen_name;
            $history->diary_id = $entry->path;
            $history->save();
        }

        // 投稿日時を記録
        $user->post_at = time();
        $user->save();
    }
}
