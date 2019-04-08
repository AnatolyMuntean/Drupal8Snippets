<?php

use Drupal\workflow\Entity\Workflow;
use Drupal\workflow\Entity\WorkflowManager;
use Drupal\workflow\Entity\WorkflowTransition;

// $node here is the entity with a workflow field.

/** @var \Drupal\workflow\Entity\Workflow $workflow */
$workflow = Workflow::load('events_approval');
/** @var \Drupal\workflow\Entity\WorkflowState $target_state */
$target_state = $workflow->getState('events_approval_approved');

// Fetch workflow fields attached to a node.
$workflow_fields = workflow_get_workflow_field_names($node);
if (empty($workflow_fields)) {
  return;
}
// This one assumes only one workflow field exists.
$workflow_field = reset($workflow_fields);

$old_sid = WorkflowManager::getPreviousStateId($node, $workflow_field);
$new_sid = $target_state->id();

$user = workflow_current_user();
$transition = WorkflowTransition::create([
  $old_sid,
  'field_name' => $workflow_field,
]);

$transition->setValues($new_sid, $user, NULL, '', TRUE);
$transition->setTargetEntity($node);
$transition->execute(TRUE);
