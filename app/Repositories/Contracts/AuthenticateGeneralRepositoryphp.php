<?php

namespace App\Repositories\Contracts;

interface DashboardManagerRepository
{
    public function AdminManager();
    public function CallcenterManager();

    public function SalesManager($roleid,$userid);


    public function DashManager($role,$userid);

}
