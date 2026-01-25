<?php

namespace App\Domain\Contacts\Actions;

use App\Domain\Contacts\Models\Contact;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteContactAction
{
    /**
     * Delete the given contact request.
     */
    public function execute(Contact $contact): void
    {
        if (! $contact->exists) {
            throw new ModelNotFoundException('Cannot delete: Contact instance not found or already deleted.');
        }

        $contact->delete();
    }
}
