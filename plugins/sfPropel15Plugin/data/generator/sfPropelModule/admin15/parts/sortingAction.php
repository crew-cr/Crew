<?php
$customSorts = array(); 
foreach ($this->configuration->getValue('list.display') as $name => $field)
{
  if ($customSort = $field->getConfig('sort_method', false, false))
  {
    $customSorts[$name] = $customSort;
  }
}
?>

  protected function processSort($query)
  {
    $sort = $this->getSort();
    if (array(null, null) == $sort)
    {
      return;
    }

<?php if ($customSorts): ?>
    $customSorts = $this->getCustomSorts();
    if (isset($customSorts[$sort[0]]))
    {
      $method = $customSorts[$sort[0]];
      $query->$method('asc' == $sort[1] ? 'asc' : 'desc');
      return;
    }

<?php endif ?>    
    try
    {
      $column = <?php echo constant($this->getModelClass().'::PEER') ?>::translateFieldName($sort[0], BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_PHPNAME);
    }
    catch (PropelException $e)
    {
      // probably a fake column, using a custom orderByXXX() query method
      $column = sfInflector::camelize($sort[0]);
    }
    
    $method = sprintf('orderBy%s', $column);
    
    try
    {
      $query->$method('asc' == $sort[1] ? 'asc' : 'desc');
    }
    catch(PropelException $e)
    {
      // non-existent sorting method
      // ignore the sort parameter
      $this->setSort(array(null, null));
    }
  }

  protected function getSort()
  {
    $sort = $this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.sort', null, 'admin_module');
    if (null === $sort)
    {
      $sort = $this->configuration->getDefaultSort();
      $this->setSort($sort);
    }

    return $sort;
  }

  protected function setSort(array $sort)
  {
    if (null !== $sort[0] && null === $sort[1])
    {
      $sort[1] = 'asc';
    }

    $this->getUser()->setAttribute('<?php echo $this->getModuleName() ?>.sort', $sort, 'admin_module');
  }

<?php if ($customSorts): ?>
  protected function getCustomSorts()
  {
    return <?php echo $this->asPhp($customSorts) ?>;
  }
<?php endif ?>
