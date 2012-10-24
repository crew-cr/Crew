<?php


class crewWidgetCommitSelect extends sfWidgetFormSelect
{

  /**
   * Returns an array of option tags for the given choices
   *
   * @param  string $value    The selected value
   * @param  array  $choices  An array of choices
   *
   * @return array  An array of option tags
   */
  protected function getOptionsForSelect($value, $choices)
  {
    $mainAttributes = $this->attributes;
    $this->attributes = array();

    if (!is_array($value))
    {
      $value = array($value);
    }

    $value = array_map('strval', array_values($value));
    $value_set = array_flip($value);

    $options = array();
    foreach ($choices as $key => $option)
    {
      if (!is_array($option))
      {
        $option = array('content' => $option);
      }
      $attributes = $option;
      $attributes['value'] = self::escapeOnce($key);
      if (isset($value_set[strval($key)]))
      {
        $attributes['selected'] = 'selected';
      }
      
      $optionContent = isset($option['content']) ? $option['content'] : $key;
      unset($attributes['content']);

      $options[] = $this->renderContentTag('option', self::escapeOnce($optionContent), $attributes);
    }
    
    $this->attributes = $mainAttributes;

    return $options;
  }
}
