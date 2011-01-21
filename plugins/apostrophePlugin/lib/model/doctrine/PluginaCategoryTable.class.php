<?php

/**
 * PluginaCategoryTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginaCategoryTable extends Doctrine_Table
{

  /**
   * Returns an instance of this class.
   *
   * @return object PluginaCategoryTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('aCategory');
  }

  public function addCategoriesForUser(sfGuardUser $user, $admin = false, Doctrine_Query $q = null)
  {
    if (is_null($q))
    {
      $q = $this->createQuery();
    } else
    {
      $q = clone $q;
    }
    if (!$admin)
    {
      // This will perform well if the user is the current user and Doctrine has
      // retained the relation to groups
      $groups = $user->getGroups();
      $groupIds = aArray::getIds($groups);
      $q->leftJoin('aCategory.Groups g')
        ->leftJoin('aCategory.Users u');
      // This is necessary because Doctrine doesn't have proper grouping syntax
      // available except via DQL
      $where = '';
      // Don't get burned by an empty IN clause matching everything
      if (count($groupIds))
      {
        $where .= 'g.id IN (' . implode(',', $groupIds) . ') OR ';
      }
      $q->andWhere('(' . $where . 'u.id = ?)', array($user['id']));
    }
    return $q;
  }

  public static function getCategoriesForPage($page)
  {
    return Doctrine::getTable('aCategory')->createQuery('c')
      ->innerJoin('c.Pages as p')
      ->where('p.id = ?', $page['id'])
      ->orderBy('c.name')
      ->execute();
  }

  public static function getCategorizables()
  {
    $dispatcher = sfContext::getInstance()->getConfiguration()->getEventDispatcher();
    $event = new sfEvent(null, 'apostrophe.get_categorizables');
    $dispatcher->filter($event, array());
    return $event->getReturnValue();
  }

  public static function retrieveCategoriesWithCounts()
  {
    $categorizables = self::getCategorizables();
    $q = self::getInstance()->createQuery();

    foreach($categorizables as $key => $info)
    {
      $q->leftJoin($info['relation'].' '.$key);
      $q->addSelect(sprintf('COUNT(%s.id)'));
    }

  }

  public function mergeCategory($old_id, $new_id, $tableClass, $category_column = 'category_id', $isRefClass = false, $ref_column = null)
  {
    if($isRefClass)
    {
      Doctrine_Query::create()
      ->select('old.*')
      ->from("$tableClass old, $tableClass new")
      ->where("old.$ref_column = new.$ref_column AND old.$category_column = ? AND old.$category_column = ?", array($old_id, $new_id))
      ->execute()->delete();
    }

    Doctrine::getTable($tableClass)->createQuery()
      ->update()
      ->set($category_column, $new_id)
      ->where("$category_column = ?", $old_id)
      ->execute();
  }

}