<?php

/**
 * @file
 * Contains \Drupal\Core\Asset\Collection\AssetCollectionBasicInterface.
 */

namespace Drupal\Core\Asset\Collection;
use Drupal\Core\Asset\AssetInterface;
use Assetic\Asset\AssetInterface as AsseticAssetInterface;
use Drupal\Core\Asset\Exception\UnsupportedAsseticBehaviorException;

/**
 * Describes an asset collection: a container for assets.
 *
 * Asset collections are nothing more than a mechanism for holding and easily
 * moving a set of a specific type of asset around.
 *
 * This interface contains the subset of methods that feasible for
 * AssetAggregateInterface to share; because certain internal sequencing and
 * state is important to aggregates, they cannot behave like a full collection.
 *
 * @see \Drupal\Core\Asset\Aggregate\AssetAggregateInterface
 * @see \Drupal\Core\Asset\Collection\AssetCollectionInterface
 */
interface AssetCollectionBasicInterface extends \Traversable {

  /**
   * Removes an asset from the aggregate.
   *
   * Wraps Assetic's AssetCollection::removeLeaf() to ease removal of keys.
   *
   * @param AssetInterface|string $needle
   *   Either an AssetInterface instance, or the string id of an asset.
   * @param bool $graceful
   *   Whether failure should return FALSE or throw an exception.
   *
   * @return bool
   *
   * @throws \OutOfBoundsException
   */
  public function remove($needle, $graceful = FALSE);

  /**
   * Indicates whether this collection contains the provided asset.
  *
   * @param AssetInterface $asset
   *   Either an AssetInterface instance, or the string id of an asset.
   *
   * @return bool
   */
  public function contains(AssetInterface $asset);

  /**
   * Retrieves a contained asset by its string identifier.
   *
   * Call this with $graceful = TRUE as an equivalent to contains() if all you
   * have is a string id.
   *
   * @param string $id
   *   The id of the asset to retrieve.
   * @param bool $graceful
   *   Whether failure should return FALSE or throw an exception.
   *
   * @return AssetInterface|bool
   *   FALSE if no asset could be found with that id, or an AssetInterface.
   *
   * @throws \OutOfBoundsException
   */
  public function getById($id, $graceful = TRUE);

  /**
   * Reindexes the ids of all assets contained in the aggregate.
   *
   * TODO this is necessary because AssetInterface::id() doesn't guarantee stable output. Fix that, and this can go away
   *
   * @return void
   */
  public function reindex();

  /**
   * Indicates whether this collection contains any assets.
   *
   * @return bool
   *   TRUE if contained assets are present, FALSE otherwise.
   */
  public function isEmpty();
}