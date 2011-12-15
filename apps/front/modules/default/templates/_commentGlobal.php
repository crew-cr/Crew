<?php use_helper('Markdown') ?>
<table>
  <tr>
    <td class="line_comment">
      <div class="comment_holder">
        <?php if (count($commentGlobals) > 0) : ?>
          <?php foreach ($commentGlobals as $commentGlobal) : ?>
          <div class="comment" id="comment-<?php echo $commentGlobal->getId()?>">
            <div class="comment_user">
              <img class="avatar" src="<?php echo $commentGlobal->getsfGuardUser()->getProfile()->getAvatarUrl() ?>" />
              <?php echo sprintf("<span><strong>%s</strong> %s</span>", $commentGlobal->getAuthorName(), $commentGlobal->getUpdatedAt('d/m/Y H\hi')) ?>
              <?php if(CommentPeer::TYPE_BRANCH === $type): ?>
                - <?php echo link_to('Permalink', url_for('default/fileList'), array('query_string' => sprintf('branch=%s#comment-%s', $id, $commentGlobal->getId()), 'title' => 'Copy permalink to clipboard', 'class' => 'clipboard')) ?>
              <?php elseif(CommentPeer::TYPE_FILE === $type): ?>
                - <?php echo link_to('Permalink', url_for('default/file'), array('query_string' => sprintf('file=%s#comment-%s', $id, $commentGlobal->getId()), 'title' => 'Copy permalink to clipboard', 'class' => 'clipboard')) ?>
              <?php endif; ?>

              <?php echo $userId === $commentGlobal->getUserId() ? sprintf('<button class="right danger delete" data="%s?id=%s&type=%s">Delete</button>', url_for('default/commentDeleteGlobal'), $commentGlobal->getId(), $type) : '' ?>
            </div>
            <div class="comment_body"><?php echo Markdown($commentGlobal->getValue()) ?></div>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
        <form name="commentGlobal" id="commentGlobal" class="comment_form" method="post" action="<?php echo url_for('default/commentAddGlobal?id=' . $id . '&type=' . $type) ?>" >
          <?php echo $form['value']->render(); ?>
          <button class="right icon comment no-marge" type="submit">
            <?php echo $type === CommentPeer::TYPE_BRANCH ? 'Add Branch Note' : 'Add File Note' ?>
          </button>
        </form>
      </div>
    </td>
  </tr>
</table>
