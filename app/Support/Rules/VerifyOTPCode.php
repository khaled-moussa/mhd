<?php

namespace App\Support\Rules;

use App\Domain\Users\Actions\GetUserByEmailAction;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class VerifyOTPCode implements ValidationRule
{
    public function __construct(private string $email) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->email) {
            $fail('Try again later.');
        }

        $user = app(GetUserByEmailAction::class)->execute(
            email: $this->email
        );

        if (! $user) {
            $fail('Try again later.');
        }

        $result = $user->consumeOneTimePassword($value);

        if (! $result->isOk()) {
            if ($result->value == 'rateLimitExceeded') {
                $fail("To many attempet try again later");
            }
            $fail($result->validationMessage());
        }
    }
}
