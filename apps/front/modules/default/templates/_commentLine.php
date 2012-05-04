<?php use_helper('Markdown') ?>
<tr class="comment_bloc">
  <td class="comment_count" colspan="2"></td>
  <td class="line_comment">
    <div class="clipper">
      <div class="comments_holder">
        <?php foreach ($comments as $comment): ?>
        <div class="comment <?php if ($comment->getCheckedAt()) :?>done<?php endif; ?>" id="comment-<?php echo $comment->getId()?>">
          <div class="comment_user">
            <img class="avatar" src="<?php echo $comment->getAuthorAvatar() ?>" />
            <?php echo sprintf("<span><strong>%s</strong> %s</span>", $comment->getAuthorName(), $comment->getUpdatedAt('d/m/Y H\hi')) ?>
            - <?php echo link_to('Permalink', url_for('default/file'), array('query_string' => sprintf('file=%s#comment-%s', $comment->getFileId(), $comment->getId()), 'title' => 'Copy permalink to clipboard', 'class' => 'clipboard')) ?>
            - <label for="todo-comment-<?php echo $comment->getId()?>"><?php echo $comment->getCheckMessage() ?></label> <input type="checkbox" id="todo-comment-<?php echo $comment->getId()?>" class="todo" data-id="<?php echo $comment->getId()?>" data-url="<?php echo url_for('default/commentToggle') ?>" <?php if ($comment->getCheckedAt()) :?>checked="checked"<?php endif; ?> />
           <?php echo $userId === $comment->getUserId() ? sprintf("<button class=\"right delete danger\" data=\"%s?id=%s\">Delete</button>", url_for('default/commentDeleteLine'), $comment->getId()) : '' ?>
          </div>
          <div class="comment_body"><?php echo Markdown($comment->getValue()) ?></div>
        </div>
        <?php endforeach; ?>
        <div class="comment_form <?php echo $formVisible ? '' : 'hidden' ?>">
          <form name="fileComment" method="post" action="<?php echo url_for('default/commentAddLine') ?>" class="comment_form">
            <?php echo $form->renderHiddenFields(); ?>
            <?php echo $form['value']->render(); ?>
            <button class="close safe" type="button">Close Form</button>
            <a href="http://michelf.com/projects/php-markdown/concepts/" title="Markdown help" class="markdown">Markdown help</a>
            <button class="right good" type="submit">Add Line Note</button>
          </form>
        </div>
        <div class="comment_add <?php echo $formVisible ? 'hidden' : '' ?>">
          <button class="add_comment good">Add line note</button>
        </div>
      </div>
    </div>
  </td>
</tr>
