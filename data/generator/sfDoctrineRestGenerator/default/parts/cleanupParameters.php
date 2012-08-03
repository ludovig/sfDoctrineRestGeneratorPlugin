  /**
   * Cleans up the request parameters
   *
   * @param   array  $params  an array of parameters
   * @return  array  an array of cleaned parameters
   */
  protected function cleanupParameters($params)
  {
    unset($params['sf_format']);
    unset($params['module']);
    unset($params['action']);

    $additional_params = <?php var_export($this->configuration->getValue('get.additional_params', array())); ?>;

    // save additionalParams for later reuse
    $additionalParams = array();
    foreach ($additional_params as $name)
    {
      if (isset($params[$name]))
      {
        $additionalParams[$name] =  $params[$name];
      }
    }
    $this->additionalParams = $additionalParams;

    foreach ($params as $name => $value)
    {
      if ((null === $value) || ('' === $value) || in_array($name, $additional_params))
      {
        unset($params[$name]);
      }
    }

    return $params;
  }
