<?php

namespace App\Domain\Contacts\Actions;

use App\Domain\Contacts\Models\Contact;

class GetContactByUuidAction
{
    /**
     * Get specific contact request by uuid.
     */
    public function execute(string $contactUuid): Contact
    {
        return Contact::whereUuid($contactUuid)->firstOrFail();
    }
}
