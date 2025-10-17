<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // // Gates للمعلمين
        // Gate::define('isTeacher', function (User $user) {
        //     return $user->role === 'teacher';
        // });

        // // Gates للطلاب
        // Gate::define('isStudent', function (User $user) {
        //     return $user->role === 'student';
        // });

        // // Gates للمدير
        // Gate::define('isAdmin', function (User $user) {
        //     return $user->role === 'admin';
        // });
        
      Gate::define('isTeacher', function ($user) {
    return $user instanceof Teacher;
});

Gate::define('isStudent', function ($user) {
    return $user instanceof Student;
});

Gate::define('isAdmin', function ($user) {
    return $user instanceof User && $user->role === 'admin';
});
    }
}
