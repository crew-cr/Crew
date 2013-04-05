<?php
 
class ImageUtils
{
  static public function getImageTypeFromContent($binaryContent)
  {
    $supportedTypes = array(
      'jpeg' => "\xFF\xD8\xFF",
      'gif'  => 'GIF',
      'png'  => "\x89\x50\x4e\x47\x0d\x0a",
      'bmp'  => 'BM',
    );

    foreach ($supportedTypes as $supportedType => $header)
    {
      if (strpos($binaryContent, $header) === 0)
      {
        return $supportedType;
      }
    }

    return null;
  }
}