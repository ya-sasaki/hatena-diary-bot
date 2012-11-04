<?php

class Model_Contents
{
    /**
     * コンテンツを検索
     */ 
    static function search_contents($keys) 
    {
        $key_list = explode(',', $keys);

        $contents_list = array();
        foreach ($key_list as $key) 
        {
            $contents = json_decode(file_get_contents(
                "http://k.hatena.ne.jp/keywordblog/".urlencode(trim($key))."?mode=json",
                false,
                stream_context_create(
                    array('http' => 
                    array(
                        'method' => 'GET',
                        'header' => 'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
                    )
                )
            )));
            
            foreach ($contents->entries as $entry) 
            {
                $contents_list[$entry->path] = $entry;
            } 
        }
        
        // 日付でソート
        usort($contents_list, function($a, $b) { return strcmp($b->date, $a->date); });
        return array_values($contents_list);
    }

    /**
     * コンテンツを取得してフィルターする。
     * bot用
     */
    static function filtered_contents($keys, $excludes) {
        $contents_list = self::search_contents($keys);

        $exclude_keywords = array();
        if (mb_strlen(trim($excludes)) > 0) 
        { 
            $exclude_keywords = explode(',', $excludes);
        }
        $filtered_list = array();
        foreach ($contents_list as $contents) 
        {
            $hit = false;
            foreach ($exclude_keywords as $keyword) 
            {
                if (mb_strlen(trim($keyword)) == 0) {
                    continue;
                }
                if (mb_strpos($contents->body, trim($keyword)) > -1 ||
                    stripos($contents->body, trim($keyword)) > -1 ||
                    mb_strpos($contents->title, trim($keyword)) > -1 ||
                    stripos($contents->title, trim($keyword)) > -1) 
                {
                    $hit = true;
                    break;
                }
            }
            if (!$hit) 
            {
                array_push($filtered_list, $contents);
            }
        }
        return $filtered_list;
    } 
}
