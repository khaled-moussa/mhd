<?php

namespace App\Domain\Contacts\Actions;

use App\Domain\Contacts\Models\Contact;

class GetContactsAction
{
    /**
     * Get all contacts.
     */
    public function execute()
    {
        return Contact::query()
            ->latest('created_at')
            ->paginate(20);
    }
}
