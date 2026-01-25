<?php

namespace App\Domain\Contacts\Actions;

use App\Domain\Contacts\DTOs\CreateContactDto;
use App\Domain\Contacts\Models\Contact;

class CreateContactAction
{
    /**
     * Create a new contact request.
     */
    public function execute(CreateContactDto $dto): Contact
    {
        return Contact::create($dto->toArray());
    }
}
