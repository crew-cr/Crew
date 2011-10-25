  protected function getPager()
  {
    $query = $this->buildQuery();
    $paginateMethod = $this->configuration->getPaginateMethod();
    $pager = $query->$paginateMethod($this->getPage(), $this->configuration->getPagerMaxPerPage());

    return $pager;
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute('<?php echo $this->getModuleName() ?>.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.page', 1, 'admin_module');
  }

  protected function buildQuery()
  {
<?php if ($this->configuration->hasFilterForm()): ?>
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
<?php echo $this->getFormCustomization('filter', 'filters') ?>
    }

    $query = $this->filters->buildCriteria($this->getFilters());
<?php else: ?>
    $query = PropelQuery::from('<?php echo $this->getModelClass() ?>');
<?php endif; ?>
    
    foreach ($this->configuration->getWiths() as $with) {
      $query->joinWith($with);
    }
    
    foreach ($this->configuration->getQueryMethods() as $method) {
      $query->$method();
    }
    
    $this->processSort($query);
    
    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $query);
    $query = $event->getReturnValue();

    return $query;
  }
