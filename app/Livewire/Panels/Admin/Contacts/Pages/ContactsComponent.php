<?php

namespace App\Livewire\Panels\Admin\Contacts\Pages;

use App\App\Web\Resources\Contacts\ContactsResource;
use App\Domain\Contacts\Actions\DeleteContactAction;
use App\Domain\Contacts\Actions\GetContactByUuidAction;
use App\Domain\Contacts\Actions\GetContactsAction;
use App\Domain\Contacts\Models\Contact;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use App\Support\Traits\HandlePaginationButtons;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ContactsComponent extends Component
{
    // use WithLivewireExceptionHandling;
    use WithPagination;
    use HandlePaginationButtons;

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function render()
    {
        $contacts = $this->contacts();

        $this->initPaginationButtons($contacts);

        return view('admin_livewire::contacts.pages.contacts-component', [
            'paginator'    => $contacts,
            'contactsData' => $this->contactsData($contacts),
        ]);
    }

    /*
    |-----------------------------
    | Computed Properties
    |-----------------------------
    */
    public function contacts()
    {
        return app(GetContactsAction::class)->execute();
    }

    public function contactsData($contacts): array
    {
        return ContactsResource::collection($contacts->items())->resolve();
    }

    /*
    |-----------------------------
    | Actions
    |-----------------------------
    */
    public function viewContact(string $contactUuid): void
    {
        $contact = $this->getContact($contactUuid);

        $contactData = (new ContactsResource($contact))->resolve();

        $this->dispatchContactLoadedEvent($contactData);
    }

    public function deleteContact(string $contactUuid): void
    {
        $contact = $this->getContact($contactUuid);

        app(DeleteContactAction::class)->execute($contact);

        // If current page becomes empty → go back
        if ($this->contacts()->count() === 0 && $this->currentPage > 1) {
            $this->previousPage();
        }

        if ($this->currentPage === 1) {
            $this->resetPage();
        }

        $this->dispatchContactDeletedEvent();
    }

    /*
    |-----------------------------
    | Event Listeners
    |-----------------------------
    */
    #[On(EventsEnum::CONTACT_CREATED_EVENT->value)]
    public function handleContactCreated(): void
    {
        $this->resetPage();
    }

    /*
    |-----------------------------
    | Helpers
    |-----------------------------
    */
    private function getContact(string $contactUuid): ?Contact
    {
        return app(GetContactByUuidAction::class)->execute($contactUuid);
    }

    /*
    |-----------------------------
    | Dispatchers
    |-----------------------------
    */
    private function dispatchContactLoadedEvent(array $data): void
    {
        $this->dispatch(EventsEnum::CONTACT_LOADED_EVENT, data: $data);
    }

    private function dispatchContactDeletedEvent(): void
    {
        $this->dispatch(EventsEnum::CONTACT_DELETED_EVENT);
    }
}
