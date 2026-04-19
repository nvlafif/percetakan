<?php

namespace App\Providers;

use App\Models\Employee;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Payroll;
use App\Models\Product;
use App\Models\Salary;
use App\Models\Transaction;
use App\Models\User;
use App\Observers\AuditObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $auditObserver = new AuditObserver;

        User::observe($auditObserver);
        Transaction::observe($auditObserver);
        Employee::observe($auditObserver);
        Salary::observe($auditObserver);
        Payroll::observe($auditObserver);
        Product::observe($auditObserver);
        Income::observe($auditObserver);
        Expense::observe($auditObserver);
    }
}
