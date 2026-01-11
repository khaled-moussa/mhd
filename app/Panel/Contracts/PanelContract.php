<?php

namespace App\Panel\Contracts;

interface PanelContract
{
    public function id(): string;
    public function layout(): string;
    public function dashboardRoute(): string;
    public function primarySidebarItems(): array;
    public function secondarySidebarItems(): array;
}
