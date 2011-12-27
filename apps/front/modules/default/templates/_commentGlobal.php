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
              <button class="right"><a title="Copy permalink to clipboard" class="clipboard" href="<?php printf("%s#comment-%s", $_SERVER['REQUEST_URI'], $commentGlobal->getId()) ?>">Permalink</a></button>
              <?php echo $userId === $commentGlobal->getUserId() ? sprintf('<button class="right danger delete" data="%s?id=%s&type=%s">Delete</button>', url_for('default/commentDeleteGlobal'), $commentGlobal->getId(), $type) : '' ?>
            </div>
            <div class="comment_body"><?php echo Markdown($commentGlobal->getValue()) ?></div>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
        <form name="commentGlobal" id="commentGlobal" class="comment_form" method="post" action="<?php echo url_for('default/commentAddGlobal?id=' . $id . '&type=' . $type) ?>" >
          <?php echo $form['value']->render(); ?>
          <button class="right no-marge" type="submit">Add Branch Note</button>
        </form>
      </div>
    </td>
  </tr>
</table>
