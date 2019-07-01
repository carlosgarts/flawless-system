<?php
namespace Flawless\Agenda\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

/**
 * HelloWorld service provider
 *
 * @author    Carlos Gamez <carlosgarts@gmail.com>
 * @copyright 2019 Carlos Gamez
 */
class AgendaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/../Http/routes.php';
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'agenda');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'agenda');

        Event::listen('bagisto.admin.layout.head', function($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('agenda::agenda.layouts.style');
        });

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/menu.php', 'menu.admin'
        );
    }
}

//Migrations
// php artisan make:migration create_groups_table --create=groups --path=packages/Flawless/Agenda/src/Database/Migrations
// php artisan make:migration create_services_table --create=services --path=packages/Flawless/Agenda/src/Database/Migrations
// php artisan make:migration create_appointments_table --create=appointments --path=packages/Flawless/Agenda/src/Database/Migrations
// php artisan make:migration create_schedules_table --create=schedules --path=packages/Flawless/Agenda/src/Database/Migrations
// php artisan make:migration create_hollydays_table --create=hollydays --path=packages/Flawless/Agenda/src/Database/Migrations
//php artisan make:seeder ScheduleTableSeeder --path=packages/Flawless/Agenda/src/Database/Seeders
