<?php

/*
 * This file is part of the MZ\MailChimpBundle
 *
 * (c) Miguel Perez <miguel@mlpz.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace MZ\MailChimpBundle\Services\Methods;

use MZ\MailChimpBundle\Services\HttpClient;

class MCList extends HttpClient
{

    private $listId;
    private $merge = null;
    private $emailType = 'html';
    private $doubleOptin = true;
    private $updateExisting = false;
    private $replaceInterests = true;
    private $sendWelcome = false;

    /**
     * Initializes List Methods
     *
     * @param string $apiKey
     * @param string $listId
     */
    public function __construct($apiKey, $listId)
    {
        $this->apiKey = $apiKey;
        $this->listId = $listId;
    }

    /**
     * Set mailchimp merge
     *
     * @param array $merge
     */
    public function setMerge(array $merge)
    {
        $this->merge = $merge;
    }

    /**
     * Set mailchimp email type
     *
     * @param string $emailType
     */
    public function setEmailType($emailType)
    {
        $this->emailType = $emailType;
    }

    /**
     * Set mailchimp double optin
     *
     * @param boolean $doubleOptin
     */
    public function setDoubleOption($doubleOptin)
    {
        $this->doubleOptin = $doubleOptin;
    }

    /**
     * Set mailchimp update existing
     *
     * @param boolean $updateExisting
     */
    public function setUpdateExisting($updateExisting)
    {
        $this->updateExisting = $updateExisting;
    }

    /**
     * Set mailchimp replace interests
     *
     * @param boolean $replaceInterests
     */
    public function setReplaceInterests($replaceInterests)
    {
        $this->replaceInterests = $replaceInterests;
    }

    /**
     * Set mailchimp send welcome
     *
     * @param boolean $sendWelcome
     */
    public function SendWelcome($sendWelcome)
    {
        $this->sendWelcome = $sendWelcome;
    }

    /**
     * Subscribe member to list
     *
     * @param string $email
     *
     * @return boolen
     */
    public function addToList($email)
    {
        $payload = array('id' => $this->listId,
            'email_address' => $email,
            'merge_vars' => $this->merge,
            'email_type' => $this->emailType,
            'double_optin' => $this->doubleOptin,
            'update_existing' => $this->updateExisting,
            'replace_interests' => $this->replaceInterests,
            'send_welcome' => $this->sendWelcome);

        $data = $this->makeRequest('listSubscribe', $payload);

        if (!empty($data->error)) {
            return false;
        } else {
            return true;
        }
    }

}