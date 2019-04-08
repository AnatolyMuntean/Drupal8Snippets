<?php

// field_organization is the entity reference field here, which references
// a node entity.

/** @var \Drupal\Core\Entity\Plugin\DataType\EntityReference $event_organisation_reference_entity */
$event_organisation_reference_entity = $node
  ->get('field_organization')
  ->first()
  ->get('entity');

/** @var \Drupal\node\Entity\Node $event_organisation_entity */
$event_organisation_entity = $event_organisation_reference_entity
  ->getValue();

if ($event_organisation_entity) {
  // Read entity fields, or whatever.
}
