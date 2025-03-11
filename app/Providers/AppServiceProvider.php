<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Event\EventRepository;
use App\Repositories\Member\MemberRepository;
use App\Repositories\Payment\PaymentRepository;
use App\Repositories\Admin\AdminRepositoryInterface;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Member\MemberRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        // $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(MemberRepositoryInterface::class, MemberRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict();
    }
}
