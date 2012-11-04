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
            $url = "http://k.hatena.ne.jp/keywordblog/".urlencode(trim($key))."?mode=json";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:13.0) Gecko/20100101 Firefox/13.0.1');
            $response = curl_exec($curl);
            curl_close($curl);
            $contents = json_decode($response); 
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
