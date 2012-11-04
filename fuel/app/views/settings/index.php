<script type="text/javascript">
$(document).ready(function() {
    $('#bot_control').click(function() {
        var action = $(this).attr('action');
        if (action == 'enable')
        {
            $('#start-modal').modal('show'); 
        } else {
            location.href = '/settings/status/disable';
        }
    });
    $('#bot-delete').click(function() {
        $('#delete_modal').modal('show');
    });
    $('#bot-enable').click(function() {
        location.href = '/settings/status/enable';
    });
    $('[action_url]').click(function() {
        $('#settings').attr('action', $(this).attr('action_url'));
    });
});
</script>
<div class="modal hide fade" id="start-modal">
    <div class="modal-header">
        <h4>Botを有効にしますか？</h4>
        <div class="modal-body">
            Botを有効にすると一定時間毎にキーワードに該当したはてなダイアリーをポストします。
        </div>
        <div class="model-footer">
            <button id="bot-enable" class="btn btn-primary">有効</button>
            <button id="bot-cancel" class="btn" data-dismiss="modal">キャンセル</button>
        </div>
    </div>
</div>
<div class="modal hide fade" id="delete_modal">
    <div class="modal-header">
        <h4>Botを削除しますか？</h4>
        <div class="modal-body">
            Botをこのサイトから削除します。認証情報、設定情報等は一切残りません。<br>宜しいですか？
        </div>
        <div class="model-footer">
            <?php echo Html::anchor('settings/delete', 'Bot削除', array('class' => 'btn btn-danger')); ?>
            <button id="bot-cancel" class="btn" data-dismiss="modal">キャンセル</button>
        </div>
    </div>
</div>
<div class="input-div">
    <h4>ようこそ<?php echo Html::anchor($twitter_url, $screen_name);?>さん</h4>
    <table width="100%">
        <tr>
            <td align="left">
                <?php if ($is_enabled($user)) { ?>
                <button id="bot_control" action="disable" class="btn">Bot無効</button>
                <?php } else { ?> 
                <button id="bot_control" action="enable" class="btn btn-primary">Bot有効</button>
                <?php } ?>
            </td>
            <td align="right">
                <button id="bot-delete" class="btn btn-danger">Bot削除</button>
                <?php echo Html::anchor('/certificate/logout', 'ログアウト', array('class' => 'btn')); ?>
            </td>
        </tr>
    </table>
</div>
<hr>
<div class="row">
    <div class="span6 input-div">
        <form id="settings" class="form-horizontal" method="post">
            <fieldset>
                <legend><strong>設定情報</strong></legend>
                <div class="control-group">
                    <label class="control-label" for="include_keywords">キーワード</label>
                    <div class="controls">
                    <input placeholder="input keywords..." type="text" class="input-xlarge" id="include_keywords" name="include_keywords" value="<?php echo $user->include_keyword; ?>" />
                        <p class="help-block">
                        カンマ(,)区切りで複数入力できます。
                        </p>  
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="exclude_keywords">除外キーワード</label>
                    <div class="controls">
                    <input placeholder="input keywords..." type="text" class="input-xlarge" id="exclude_keywords" name="exclude_keywords" value="<?php echo $user->exclude_keywords; ?>" />
                        <p class="help-block">
                        カンマ(,)区切りで複数入力できます。
                        </p>  
                    </div>
                </div>
                <div class="form-actions">
                    <input id="do_save" type="submit" class="btn btn-primary" action_url="settings/save" value="設定を保存" />
                    <input id="do_filter" type="submit" class="btn btn-primary" action_url="settings" value="フィルタ確認" />
                </div> 
            </fieldset>
        </form>
    </div>
    <div class="span7">
        <?php foreach ($list as $entry) { ?>
        <div class="timeline-div">
            <div>
<?php if ($is_tweeted($entry->path, $histories)) { ?><span class="label label-info">tweeted</span>&nbsp;<?php } ?> 
<?php if ($is_hit($entry, $user->exclude_keywords)) { ?><span class="label label-warning">exclude</span>&nbsp;<?php } ?>
            </div>
            <div>
                <table>
                    <tr>
                        <td width="40"><strong>URL</strong></td>
                        <td>
                        <a href="<?php echo $get_hatena_url($entry); ?>" target="_blank"><?php echo $get_hatena_url($entry); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Title</strong></td>
                        <td><?php echo $entry->title; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Include</strong></td>
                        <td><font color="blue" ><?php echo $get_hit_word($entry, $user->include_keyword); ?></font></td>
                    </tr>
                    <tr>
                        <td><strong>Exclude</strong></td>
                        <td><font color="red"><?php echo $get_hit_word($entry, $user->exclude_keywords); ?></font></td>
                    </tr>
                </table>      
            </div>
        </div>
        <?php } ?>
    </div>
</div>
