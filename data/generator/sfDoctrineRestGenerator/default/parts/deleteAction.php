  /**
   * Removes a <?php echo $this->getModelClass() ?> object, based on its
   * primary key
   * @param   sfWebRequest   $request a request object
   * @return  string
   */
  public function executeDelete(sfWebRequest $request)
  {
<?php $primaryKey = $this->configuration->getValue('default.update_key', Doctrine::getTable($this->getModelClass())->getIdentifier()); ?>
    $this->forward404Unless($request->isMethod(sfRequest::DELETE));
<?php if (!is_array($primaryKey)): ?>
    $primaryKey = $request->getParameter('<?php echo $primaryKey ?>');
    $this->forward404Unless($primaryKey);
    $this->item = Doctrine::getTable($this->model)->findOneBy<?php echo sfInflector::camelize($primaryKey) ?>($primaryKey);
<?php else: ?>
    $q = Doctrine::getTable($this->model)->createQuery('a');
<?php foreach($primaryKey as $key): ?>
    $key = $request->getParameter('<?php echo $key ?>');
    $this->forward404Unless($key);
    $q->andWhere('<?php echo $key ?> = ?', $key);
<?php endforeach ?>
    $item = $q->fetchOne();
<?php endif ?>
    $this->forward404Unless($this->item);
    $this->item->delete();
    return sfView::NONE;
  }
