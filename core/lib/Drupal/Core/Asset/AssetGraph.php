<?php

/**
 * @file
 * Contains \Drupal\Core\Asset\AssetGraph.
 */

namespace Drupal\Core\Asset;
use Gliph\Graph\DirectedAdjacencyGraph;

/**
 * An extension of the DirectedAdjacencyGraph concept designed specifically for
 * Drupal's asset management use case.
 *
 * Drupal allows for two types of sequencing declarations:
 *
 *   - Dependencies, which guarantee that dependent asset must be present and
 *     that it must precede the asset declaring it as a dependency.
 *   - Ordering, which can guarantee that asset A will be either preceded or
 *     succeeded by asset B, but does NOT guarantee that B will be present.
 *
 * The impact of a dependency can be calculated myopically (without knowledge of
 * the full set), as a dependency inherently guarantees the presence of the
 * other vertex in the set.
 *
 * For ordering, however, the full set must be inspected to determine whether or
 * not the other asset is already present. If it is, a directed edge can be
 * declared; if it is not.
 *
 * This class eases the process of determining what to do with ordering
 * declarations by implementing a more sophisticated addVertex() mechanism,
 * which incrementally sets up (and triggers) watches for any ordering
 * declarations that have not yet been realized.
 */
class AssetGraph extends DirectedAdjacencyGraph {
  public function addVertex($vertex) {
    parent::addVertex($vertex); // TODO: Change the autogenerated stub
  }
}