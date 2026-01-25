<?php

namespace App\Livewire\Guest\Contacts;

use App\Domain\Contacts\Actions\CreateContactAction;
use App\Domain\Contacts\DTOs\CreateContactDto;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Livewire\Component;

class ContactFormCreateComponent extends Component
{
    use WithLivewireExceptionHandling;
    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    public string $name = '';
    public string $email = '';
    public ?string $phone = null;
    public string $message = '';

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function render()
    {
        return view('livewire.guest.contacts.contact-form-create-component');
    }

    /*
    |-----------------------------
    | Validation
    |-----------------------------
    */
    protected function rules(): array
    {
        return [
            'name'    => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'email'   => [
                'required',
                'email',
                'max:255'
            ],
            'phone'   => [
                'nullable',
                'string',
                'min:8',
            ],
            'message' => [
                'required',
                'string',
                'max:500'
            ],
        ];
    }

    /*
    |-----------------------------
    | Actions
    |-----------------------------
    */
    public function submit(): void
    {
        $this->validate();

        try {
            app(CreateContactAction::class)->execute(
                new CreateContactDto(
                    name: $this->name,
                    email: $this->email,
                    phone: $this->phone,
                    message: $this->message,
                )
            );

            $this->resetForm();

            $this->dispatchCreated(
                message: 'Your request has been submitted successfully.'
            );
        } catch (\Throwable $e) {
            dd($e);
            report($e);

            $this->dispatchError(
                message: 'Something went wrong. Please try again.'
            );
        }
    }

    /*
    |-----------------------------
    | Helpers
    |-----------------------------
    */
    private function resetForm(): void
    {
        $this->reset();
        $this->resetValidation();
    }

    /*
    |-----------------------------
    | Events
    |-----------------------------
    */
    private function dispatchCreated(?string $message = null): void
    {
        $this->dispatch(
            EventsEnum::CONTACT_CREATED_EVENT,
            message: $message
        );
    }
}
