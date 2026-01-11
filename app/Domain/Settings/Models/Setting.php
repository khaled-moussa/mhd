<?php

namespace App\Domain\Settings\Models;

use App\Domain\Settings\QueryBuilders\SettingQueryBuilder;
use App\Domain\Settings\States\DesktopNotificationStates\DesktopNotificationStates;
use App\Domain\Settings\States\EmailNotificationStates\EmailNotificationStates;
use App\Domain\Settings\States\TwoFactorStates\TwoFactorStates;
use App\Support\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Setting extends Model
{
    use HasFactory, HasStates, HasUuid;

    /*
    |-------------------------------
    |  Properties
    |-------------------------------
    */
    protected $guarded = [];

    protected $casts = [
        'two_factor_state' => TwoFactorStates::class,
        'desktop_notification_state' => DesktopNotificationStates::class,
        'email_notification_state' => EmailNotificationStates::class,
    ];

    /*
    |-------------------------------
    |  Query Builder
    |-------------------------------
    */
    public function newEloquentBuilder($query): SettingQueryBuilder
    {
        return new SettingQueryBuilder($query);
    }

    /*
    |-------------------------------
    |  Getters
    |-------------------------------
    */
    public function getId(): string
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getTwoFactorState(): TwoFactorStates
    {
        return $this->two_factor_state;
    }

    public function getDesktopNotificationState(): DesktopNotificationStates
    {
        return $this->desktop_notification_state;
    }

    public function getEmailNotificationState(): EmailNotificationStates
    {
        return $this->email_notification_state;
    }

    /*
    |-------------------------------
    |  Getters Helpers
    |-------------------------------
    */
    public function isTwoFactorEnabled(): bool
    {
        return $this->two_factor_state->value();
    }

    public function isDesktopNotificationEnable(): bool
    {
        return $this->desktop_notification_state->value();
    }

    public function isEmailNotificationEnable(): bool
    {
        return $this->email_notification_state->value();
    }
}
