<?php

/**
 * @file
 * Contains \Drupal\Core\Asset\Collection\AssetCollectionInterface.
 */

namespace Drupal\Core\Asset\Collection;
use Drupal\Core\Asset\AssetInterface;
use Drupal\Core\Asset\AssetLibraryRepository;

/**
 * Describes an asset collection.
 *
 * TODO we need a few more methods here to deal with library resolution
 *
 * @see \Drupal\Core\Asset\Collection\AssetCollectionBasicInterface
 */
interface AssetCollectionInterface extends AssetCollectionBasicInterface {

  /**
   * Merges another asset collection into this one.
   *
   * If an asset is present in both collections, as identified by
   * AssetInterface::id(), the asset from the passed collection will
   * supercede the asset in this collection.
   *
   * @param AssetCollectionInterface $collection
   *   The collection to merge.
   *
   * @param bool $freeze
   *   Whether to freeze the provided collection after merging. Defaults to TRUE.
   *
   * @return void
   */
  public function mergeCollection(AssetCollectionInterface $collection, $freeze = TRUE);

  /**
   * Freeze this asset collection, preventing asset additions or removals.
   *
   * This does not prevent modification of assets already contained within the
   * collection.
   *
   * TODO put this on the basic interface so aggregates have it, too?
   *
   * @return void
   */
  public function freeze();

  /**
   * Indicates whether or not this collection is frozen.
   *
   * @return bool
   */
  public function isFrozen();

  /**
   * Returns all contained CSS assets in a traversable form.
   *
   * @return \Traversable
   */
  public function getCss();

  /**
   * Returns all contained JS assets in a traversable form.
   *
   * @return \Traversable
   */
  public function getJs();

  /**
   * Sorts contained assets by id by passing the provided callback to uksort().
   *
   * @param $callback
   *
   * @return void
   */
  public function uksort($callback);

  /**
   * Sorts contained assets via ksort() on their ids.
   *
   * @return void
   */
  public function ksort();

  /**
   * Reverses the sort order of the contained assets.
   *
   * @return void
   */
  public function reverse();

  /**
   * Adds a key identifying a library to this collection.
   *
   * Resolving this key into a real AssetLibrary is the responsibility of the
   * resolveLibraries() method.
   *
   * @param string $key
   *   The string identifying the library. It should be two-part composite key,
   *   slash-delimited, with the first part being the module owner and the
   *   second part being the library name.
   *
   * @return void
   *
   * @see AssetCollectionInterface::resolveLibraries()
   */
  public function addUnresolvedLibrary($key);

  /**
   * Indicates whether the collection has any unresolved library keys.
   *
   * @return bool
   *   TRUE if unresolved keys are present, FALSE otherwise.
   */
  public function hasUnresolvedLibraries();

  /**
   * Gets the unresolved library keys from this collection.
   *
   * @return array
   *   An indexed array of library keys.
   */
  public function getUnresolvedLibraries();

  /**
   * Empties the collection of its unresolved library keys.
   *
   * @return void
   */
  public function clearUnresolvedLibraries();

  /**
   * Resolves all contained library references and adds them to this collection.
   *
   * "References" refers to library keys. This includes both libraries added
   * directly to this collection, as well as those libraries included indirectly
   * via a contained asset's declared dependencies.
   *
   * @param AssetLibraryRepository $repository
   *   The AssetLibraryRepository to use for resolving library keys into
   *   AssetLibrary objects.
   *
   * @return void
   */
  public function resolveLibraries(AssetLibraryRepository $repository);
}
