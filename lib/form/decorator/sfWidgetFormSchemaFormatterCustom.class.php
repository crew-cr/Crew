<?php

class sfWidgetFormSchemaFormatterCustom extends \sfWidgetFormSchemaFormatter
{
  /**
   * @var string
   */
  protected $rowFormat = '
    <div class="fieldBloc">
      %label%
      <div class="fieldGroup">
        %field%%hidden_fields%%help%
        %error%
      </div>
    </div>';

  protected $helpFormat = '%help%';
  protected $errorRowFormat = "\n<div class='box error'>%errors%</div>\n";
  protected $errorListFormatInARow = '%errors%';
  protected $errorRowFormatInARow = '<span class="iconContainer info_error error_%field_id%"><span class="content">%error%</span></span>';
  protected $namedErrorRowFormatInARow = "%name%: %error%";
  protected $decoratorFormat = "%content%";

  /**
   * @param string $label
   * @param string $field
   * @param array $errors
   * @param string $help
   * @param null $hiddenFields
   * @return string
   */
  public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
  {
    $id = $this->getIdFromField($field);

    return strtr($this->getRowFormat(), array(
      '%label%'         => $label,
      '%field%'         => $field,
      '%error%'         => strtr($this->formatErrorsForRow($errors), array('%field_id%' => $id)),
      '%help%'          => $this->formatHelp($help),
      '%hidden_fields%' => null === $hiddenFields ? '%hidden_fields%' : $hiddenFields
    ));
  }

  /**
   * @param string $field
   * @return string
   */
  public function getIdFromField($field)
  {
    if(preg_match('/id="([a-zA-Z0-9_]*)"/', $field, $result))
    {
      return $result[1];
    }

    return '';
  }
}