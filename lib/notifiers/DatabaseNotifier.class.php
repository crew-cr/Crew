<?php

class DatabaseNotifier extends BaseNotifier
{
  public function notifyStatus(sfEvent $event)
  {
    if(!$this->configure($event))
    {
      return true;
    }

    switch($this->arguments['type'])
    {
      case 'file':
        $file       = $this->arguments['object'];
        $oldStatus  = $this->arguments['old'];
        File::saveAction(
          $this->subject->getUser()->getId(),
          $file->getBranch()->getRepositoryId(),
          $file->getBranchId(),
          $file->getId(),
          $oldStatus,
          $file->getStatus()
        );
        break;

      case 'branch':
        $branch     = $this->arguments['object'];
        $oldStatus  = $this->arguments['old'];
        Branch::saveAction(
          $this->subject->getUser()->getId(),
          $branch->getRepositoryId(),
          $branch->getId(),
          $oldStatus,
          $branch->getStatus()
        );
        break;
    }
    return true;
  }
}
