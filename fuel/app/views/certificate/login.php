<div class="hero-unit">
    <h1>Hatena Diary Keyword Bot</h1>
</div>
<div class="container">
    <div class="container">
        <?php echo Html::anchor(
        'certificate/oauth', 
        Asset::img('sign-in-with-twitter-gray.png', array("height" => 30, "width" => 200))
        ); 
        ?>
    </div>
    <div class="container">
        <div class="alert-error alert-div">
            <h4 class="alert-heading">※注意事項</h4>
            <ul>
                <li>当サービスをご利用するにはTwitterアカウントが必要です。</li>
                <li>当サービスは、はてなダイアリーのエントリを拾ってTweetします。テストフィルター機能で十分にTweet内容を検証した上、ご利用ください。</li>
                <li>自動Tweetするにあたり、サインイン時に認証トークンを当サービス内に保存させていただきます(認証パスワードは保存しません)。</li>
                <li>当サービスに登録されたアカウント情報はユーザご自身で削除することが可能です。削除の際、登録頂いたアカウント情報は当サービスには一切残りません。</li>
                <li>当サービスにおけるトラブルについては管理者は一切の責任を負いかねます。</li>
                <li>管理者は当サービスを余儀なく廃止もしくは移設することがございます。</li>
                <li>上記事項について了承した上、ご利用くださいますようお願い申し上げます。</li>
            </ul>
        </div>
        <div class="alert-info alert-div">
            管理者へのお問い合わせは<?php echo Html::anchor('http://twitter.com/sa2yasu', '@sa2yasu'); ?>まで
        </div>
    </div>
</div>
