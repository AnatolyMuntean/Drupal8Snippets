<?php

/** @var \Drupal\workflow\Entity\Workflow $workflow */
$workflow = \Drupal\workflow\Entity\Workflow::load('events_approval');
/** @var \Drupal\workflow\Entity\WorkflowState $target_state */
$target_state = $workflow->getState('events_approval_approved');

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
