<?php

/**
 * @file
 * Contains \Drupal\migrate_wordpress\Plugin\migrate\source\WordPressTermBase.
 */

namespace Drupal\migrate_wordpress\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * @MigrateSource(
 *   id = "wp_term"
 * )
 */
class WordPressTerm extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select($this->configuration['table_prefix'] . 'terms', 't')
      ->fields('t', array_keys($this->fields()))
      ->condition('taxonomy', 'post_tag');
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = array(
      'term_id' => $this->t('The term Id'),
      'name' => $this->t('The term name.'),
      'slug' => $this->t('The term slug.'),
      'term_group' => $this->t('The term group id.'),
    );
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['term_id']['type'] = 'integer';
    $ids['term_id']['alias'] = 't';
    return $ids;
  }

}
