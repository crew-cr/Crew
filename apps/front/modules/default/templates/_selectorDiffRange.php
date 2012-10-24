<?php /** @var selectorDiffRangeForm $form */ ?>

<?php echo $form->renderFormTag(url_for('default/validateSelectorDiffRange')) ?>
  <?php echo $form->renderHiddenFields(); ?>
  Compare from
  <?php echo $form['from']->render(array('class' => 'select2')); ?>
  to
  <?php echo $form['to']->render(array('class' => 'select2')); ?>
  <button type="submit" class="no-marge">Show</button>
</form>