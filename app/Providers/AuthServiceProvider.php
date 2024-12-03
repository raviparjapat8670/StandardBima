<?php
namespace App\Providers;

use App\Models\Occupation;
use App\Policies\OccupationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Occupation::class => OccupationPolicy::class,  // Register your policies here
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Call registerPolicies in the correct provider
        $this->registerPolicies();
    }
}
