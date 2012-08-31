<?php

class selectorDiffRangeForm extends sfForm
{

  /**
   * @param array $defaults
   * @param array $options
   * @param null  $CSRFSecret
   *
   * @throws InvalidArgumentException
   * @throws Exception
   */
  public function __construct($defaults = array(), $options = array(), $CSRFSecret = null)
  {
    foreach (array('git_command', 'type', 'id') as $option)
    {
      if (!isset($options[$option]))
      {
        throw new Exception(sprintf('Option [%s] is required', $option));
      }
    }

    if (!$options['git_command'] instanceof GitCommand)
    {
      throw new InvalidArgumentException("Option [git_command] must be a GitCommand object");
    }

    parent::__construct($defaults, $options, $CSRFSecret);
  }


  public function configure()
  {
    $branch = $this->findCurrentBranch($this->getOption('type'), $this->getOption('id'));
    $this->widgetSchema->setNameFormat('selector_diff[%s]');
    $commits = $this->buildCommits($branch);
    
    end($commits);
    $defaultFrom = key($commits);

    $this->setWidget('from', new crewWidgetCommitSelect(array('choices' => $commits, 'default' => $defaultFrom)));
    $this->setWidget('to', new crewWidgetCommitSelect(array('choices' => $commits)));
    $this->setWidget('type', new sfWidgetFormInputHidden());
    $this->setWidget('id', new sfWidgetFormInputHidden());

    $this->setValidator('from', new sfValidatorChoice(array('choices' => array_keys($commits))));
    $this->setValidator('to', new sfValidatorChoice(array('choices' => array_keys($commits))));
    $this->setValidator('type', new sfValidatorChoice(array('choices' => array('branch', 'file'))));
    $this->setValidator('id', new sfValidatorPass());
  }

  /**
   * @param Branch $branch
   *
   * @return array
   */
  private function buildCommits(Branch $branch)
  {
    $commits = $this->getGitCommand()->getCommits(
      $branch->getRepository()->getGitDir(), 
      $branch->getBaseBranchName(), 
      $branch->getLastCommit()
    );
    $commits[$branch->getCommitReference()] = $branch->getBaseBranchName();

    $requests         = $branch->getRequests();
    $requestsByCommit = array();
    foreach ($requests as $request)
    {
      $requestsByCommit[$request->getCommit()] = $request;
    }

    $commitsWithParams = array();
    foreach ($commits as $commit => $message)
    {
      $commitsWithParams[$commit] = array('content' => $message);
      if (isset($requestsByCommit[$commit]))
      {
        $commitsWithParams[$commit]['data-review-request'] = 1;
      }
    }

    return $commitsWithParams;
  }


  /**
   * @param string $type
   * @param id     $id
   *
   * @throws Exception
   * @internal param \sfRequest $request
   *
   * @return Branch
   */
  private function findCurrentBranch($type, $id)
  {
    switch ($type)
    {
      case 'branch':
        $branch = BranchQuery::create()
          ->findOneById($id);
        break;
      case 'file':
        $branch = BranchQuery::create()
          ->useFileQuery()
          ->filterById($id)
          ->endUse()
          ->findOne();
        break;
      default:
        throw new Exception("Unkown type '%s'", $type);
    }

    if (null === $branch)
    {
      throw new Exception('Unable to find a valid branch');
    }

    return $branch;
  }

  /**
   * @return GitCommand
   */
  private function getGitCommand()
  {
    return $this->getOption('git_command');
  }

}
