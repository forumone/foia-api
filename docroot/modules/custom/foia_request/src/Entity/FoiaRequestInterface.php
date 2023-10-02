<?php

namespace Drupal\foia_request\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining FOIA Request entities.
 *
 * @ingroup foia_request
 */
interface FoiaRequestInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  /**
   * Request is in queue to be processed.
   */
  const STATUS_QUEUED = 0;

  /**
   * Request has been submitted.
   */
  const STATUS_SUBMITTED = 1;

  /**
   * Submission has failed.
   */
  const STATUS_FAILED = 2;

  /**
   * Request pending file attachment virus scan.
   */
  const STATUS_SCAN = 3;

  /**
   * Request was emailed but could still fail.
   */
  const STATUS_IN_TRANSIT = 4;

  /**
   * Sent to component via email.
   */
  const METHOD_EMAIL = 'email';

  /**
   * Sent to component via api.
   */
  const METHOD_API = 'api';

  /**
   * The number of seconds before assuming that an email request was delivered.
   */
  const ASSUME_DELIVERED_AFTER = 604800;

  /**
   * The max number of times to requeue failed submissions.
   */
  const MAX_SUBMISSION_FAILURES = 5;

  /**
   * Gets the status of the foia_request entity.
   *
   * @return int
   *   One of FoiaRequestInterface::STATUS_QUEUED or
   *   FoiaRequestInterface::STATUS_SUBMITTED or
   *   FoiaRequestInterface::STATUS_FAILED or
   *   FoiaRequestInterface::STATUS_SCAN or
   *   FoiaRequestInterface::STATUS_IN_TRANSIT
   */
  public function getRequestStatus();

  /**
   * Sets the status of the foia_request entity.
   *
   * @param int $requestStatus
   *   Set to FoiaRequestInterface::STATUS_QUEUED to mark enqueued,
   *   FoiaRequestInterface::STATUS_SUBMITTED to mark submitted,
   *   FoiaRequestInterface::STATUS_FAILED to mark failure,
   *   FoiaRequestInterface::STATUS_SCAN to mark file(s) pending virus scan.
   *
   * @return \Drupal\foia_request\Entity\FoiaRequestInterface
   *   The called foia_request entity.
   */
  public function setRequestStatus($requestStatus);

  /**
   * Returns an array of valid statuses for a FOIA request.
   *
   * @return array
   *   Valid statuses for a FOIA request.
   */
  public static function getValidRequestStatuses();

  /**
   * Gets the number of times a foia_request entity has failed.
   *
   * @return int
   *   Number of times the request has failed.
   */
  public function getSubmissionFailures();

  /**
   * Increments the number of times a foia_request entity has failed.
   *
   * @return \Drupal\foia_request\Entity\FoiaRequestInterface
   *   The called foia_request entity.
   */
  public function addSubmissionFailure();

  /**
   * Gets the method by which the request was submitted to the component.
   *
   * @return string
   *   One of FoiaRequestInterface::METHOD_EMAIL or
   *   FoiaRequestInterface::METHOD_API.
   */
  public function getSubmissionMethod();

  /**
   * Sets the method by which the request was submitted to the component.
   *
   * @param string $submissionMethod
   *   The submission method.
   */
  public function setSubmissionMethod($submissionMethod);

  /**
   * Returns array of valid methods by which request can be sent to component.
   *
   * @return array
   *   Valid submission methods for a FOIA request.
   */
  public static function getValidSubmissionMethods();

  /**
   * Gets the FOIA Request creation timestamp.
   *
   * @return int
   *   Creation timestamp of the FOIA Request.
   */
  public function getCreatedTime();

  /**
   * Sets the FOIA Request creation timestamp.
   *
   * @param int $timestamp
   *   The FOIA Request creation timestamp.
   *
   * @return \Drupal\foia_request\Entity\FoiaRequestInterface
   *   The called FOIA Request entity.
   */
  public function setCreatedTime($timestamp);

}
