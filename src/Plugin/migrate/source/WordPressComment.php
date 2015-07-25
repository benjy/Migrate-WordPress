<?php

/**
 * @file
 * Contains \Drupal\migrate_wordpress\Plugin\migrate\source\WordPressComment.
 */

namespace Drupal\migrate_wordpress\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * @MigrateSource(
 *   id = "wp_comment"
 * )
 */
class WordPressComment extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select($this->configuration['table_prefix'] . 'comments', 'c')
      ->fields('c', array_keys($this->fields()))
      ->orderBy('comment_ID');

    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $row->setSourceProperty('comment_date', strtotime($row->getSourceProperty('comment_date')));
    $row->setSourceProperty('comment_date_gmt', strtotime($row->getSourceProperty('comment_date_gmt')));

    return parent::prepareRow($row);
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = array(
      'comment_ID' => $this->t('The comment ID'),
      'comment_post_ID' => $this->t('The comment post ID.'),
      'comment_author' => $this->t('The post comment author name.'),
      'comment_author_email' => $this->t('The comment author email'),
      'comment_author_url' => $this->t('The comment author url.'),
      'comment_author_IP' => $this->t('The comment author IP address.'),
      'comment_date' => $this->t('The comment date'),
      'comment_date_gmt' => $this->t('The date in GMT.'),
      'comment_content' => $this->t('The comment content.'),
      'comment_karma' => $this->t('The comment karma.'),
      'comment_approved' => $this->t('The comment approved status.'),
      'comment_agent' => $this->t('The comment agent.'),
      'comment_type' => $this->t('The comment type.'),
      'comment_parent' => $this->t('The comment parent comment id.'),
      'user_id' => $this->t('The the user id.'),
    );
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['comment_ID']['type'] = 'integer';
    $ids['comment_ID']['alias'] = 'p';
    return $ids;
  }

}
