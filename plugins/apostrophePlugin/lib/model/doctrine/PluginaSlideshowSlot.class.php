<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginaSlideshowSlot extends BaseaSlideshowSlot
{
  public function isOutlineEditable()
  {
    // We have an edit button and don't use an in-place editor
    return false;
  }
  
  public function getSearchText()
  {
    $text = "";
    $items = unserialize($this->value);
    foreach ($items as $item)
    {
      // backwards compatibility with older stuff in trinity that
      // didn't have the text fields in the slot
      if (isset($item->title))
      {
        $text .= $item->title . "\n";
        $text .= $item->description . "\n";
        $text .= $item->credit . "\n";
      }
    }
    return $text;
  }

  public function  getMediaItemOrder()
  {
    $data = $this->getArrayValue();
    
    return $data['order'];
  }
  
  // We don't need refreshSlot anymore thanks to ON DELETE CASCADE
  // and the new simplified non-API-driven setup
}
