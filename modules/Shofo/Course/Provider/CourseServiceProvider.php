<?php

namespace Shofo\Course\Provider;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Shofo\Course\Models\Course;
use Shofo\Course\Models\Section;
use Shofo\Course\Policies\CoursePolicy;
use Shofo\Course\Policies\SectionPolicy;
use Shofo\RolePermission\Models\Permission;

class CourseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Route/course_routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Route/section_routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Route/lesson_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Courses');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Lang/');
        $this->loadTranslationsFrom(__DIR__ . '/../Lang/', 'Course');

        Gate::policy(Course::class, CoursePolicy::class);
        Gate::policy(Section::class, SectionPolicy::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        config()->set('sidebar.items.course', [
            "icon" => "i-courses",
            "title" => "دوره ها",
            "url" => route('course.index'),
            "permission" => Permission::PERMISSION_MANAGE_COURSES,
        ]);
    }
}
