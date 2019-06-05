<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerUserPolicies();
    }

    public function registerUserPolicies()
    {
        /** role */
        Gate::define('create_role', function ($user) {
            return $user->hasAccess(['create_user']);
        });
        Gate::define('update_role', function ($user) {
            return $user->hasAccess(['update_user']);
        });
        Gate::define('view_role', function ($user) {
            return $user->hasAccess(['view_user']);
        });
        Gate::define('delete_role', function ($user) {
            return $user->hasAccess(['delete_user']);
        });
        
        /** user */
        Gate::define('create_user', function ($user) {
            return $user->hasAccess(['create_user']);
        });
        Gate::define('update_user', function ($user) {
            return $user->hasAccess(['update_user']);
        });
        Gate::define('view_user', function ($user) {
            return $user->hasAccess(['view_user']);
        });
        Gate::define('delete_user', function ($user) {
            return $user->hasAccess(['delete_user']);
        });

        /** state */
        Gate::define('create_state', function ($user) {
            return $user->hasAccess(['create_state']);
        });
        Gate::define('update_state', function ($user) {
            return $user->hasAccess(['update_state']);
        });
        Gate::define('view_state', function ($user) {
            return $user->hasAccess(['view_state']);
        });
        Gate::define('delete_state', function ($user) {
            return $user->hasAccess(['delete_state']);
        });

        /** city */
        Gate::define('create_city', function ($user) {
            return $user->hasAccess(['create_city']);
        });
        Gate::define('update_city', function ($user) {
            return $user->hasAccess(['update_city']);
        });
        Gate::define('view_city', function ($user) {
            return $user->hasAccess(['view_city']);
        });
        Gate::define('delete_city', function ($user) {
            return $user->hasAccess(['delete_city']);
        });

        /** client */
        Gate::define('create_client', function ($user) {
            return $user->hasAccess(['create_client']);
        });
        Gate::define('update_client', function ($user) {
            return $user->hasAccess(['update_client']);
        });
        Gate::define('view_client', function ($user) {
            return $user->hasAccess(['view_client']);
        });
        Gate::define('delete_client', function ($user) {
            return $user->hasAccess(['delete_client']);
        });

        /** vehicle category */
        Gate::define('create_vehicleCategory', function ($user) {
            return $user->hasAccess(['create_vehicleCategory']);
        });
        Gate::define('update_vehicleCategory', function ($user) {
            return $user->hasAccess(['update_vehicleCategory']);
        });
        Gate::define('view_vehicleCategory', function ($user) {
            return $user->hasAccess(['view_vehicleCategory']);
        });
        Gate::define('delete_vehicleCategory', function ($user) {
            return $user->hasAccess(['delete_vehicleCategory']);
        });

        /** vehicle type */
        Gate::define('create_vehicleType', function ($user) {
            return $user->hasAccess(['create_vehicleType']);
        });
        Gate::define('update_vehicleType', function ($user) {
            return $user->hasAccess(['update_vehicleType']);
        });
        Gate::define('view_vehicleType', function ($user) {
            return $user->hasAccess(['view_vehicleType']);
        });
        Gate::define('delete_vehicleType', function ($user) {
            return $user->hasAccess(['delete_vehicleType']);
        });

        /** vehicle species */
        Gate::define('create_vehicleSpecies', function ($user) {
            return $user->hasAccess(['create_vehicleSpecies']);
        });
        Gate::define('update_vehicleSpecies', function ($user) {
            return $user->hasAccess(['update_vehicleSpecies']);
        });
        Gate::define('view_vehicleSpecies', function ($user) {
            return $user->hasAccess(['view_vehicleSpecies']);
        });
        Gate::define('delete_vehicleSpecies', function ($user) {
            return $user->hasAccess(['delete_vehicleSpecies']);
        });

        /** vehicle fuel */
        Gate::define('create_fuel', function ($user) {
            return $user->hasAccess(['create_fuel']);
        });
        Gate::define('update_fuel', function ($user) {
            return $user->hasAccess(['update_fuel']);
        });
        Gate::define('view_fuel', function ($user) {
            return $user->hasAccess(['view_fuel']);
        });
        Gate::define('delete_fuel', function ($user) {
            return $user->hasAccess(['delete_fuel']);
        });

        /** vehicle manufacturer */
        Gate::define('create_manufacturer', function ($user) {
            return $user->hasAccess(['create_manufacturer']);
        });
        Gate::define('update_manufacturer', function ($user) {
            return $user->hasAccess(['update_manufacturer']);
        });
        Gate::define('view_manufacturer', function ($user) {
            return $user->hasAccess(['view_manufacturer']);
        });
        Gate::define('delete_manufacturer', function ($user) {
            return $user->hasAccess(['delete_manufacturer']);
        });

        /** vehicle model */
        Gate::define('create_vehicleModel', function ($user) {
            return $user->hasAccess(['create_vehicleModel']);
        });
        Gate::define('update_vehicleModel', function ($user) {
            return $user->hasAccess(['update_vehicleModel']);
        });
        Gate::define('view_vehicleModel', function ($user) {
            return $user->hasAccess(['view_vehicleModel']);
        });
        Gate::define('delete_vehicleModel', function ($user) {
            return $user->hasAccess(['delete_vehicleModel']);
        });

        /** vehicle */
        Gate::define('create_vehicle', function ($user) {
            return $user->hasAccess(['create_vehicle']);
        });
        Gate::define('update_vehicle', function ($user) {
            return $user->hasAccess(['update_vehicle']);
        });
        Gate::define('view_vehicle', function ($user) {
            return $user->hasAccess(['view_vehicle']);
        });
        Gate::define('delete_vehicle', function ($user) {
            return $user->hasAccess(['delete_vehicle']);
        });

        /** agency */
        Gate::define('create_agency', function ($user) {
            return $user->hasAccess(['create_agency']);
        });
        Gate::define('update_agency', function ($user) {
            return $user->hasAccess(['update_agency']);
        });
        Gate::define('view_agency', function ($user) {
            return $user->hasAccess(['view_agency']);
        });
        Gate::define('delete_agency', function ($user) {
            return $user->hasAccess(['delete_agency']);
        });

        /** ait gravity */
        Gate::define('create_aitGravity', function ($user) {
            return $user->hasAccess(['create_aitGravity']);
        });
        Gate::define('update_aitGravity', function ($user) {
            return $user->hasAccess(['update_aitGravity']);
        });
        Gate::define('view_aitGravity', function ($user) {
            return $user->hasAccess(['view_aitGravity']);
        });
        Gate::define('delete_aitGravity', function ($user) {
            return $user->hasAccess(['delete_aitGravity']);
        });

        /** ait measure */
        Gate::define('create_aitMeasure', function ($user) {
            return $user->hasAccess(['create_aitMeasure']);
        });
        Gate::define('update_aitMeasure', function ($user) {
            return $user->hasAccess(['update_aitMeasure']);
        });
        Gate::define('view_aitMeasure', function ($user) {
            return $user->hasAccess(['view_aitMeasure']);
        });
        Gate::define('delete_aitMeasure', function ($user) {
            return $user->hasAccess(['delete_aitMeasure']);
        });

        /** ait status  */
        Gate::define('create_aitStatus', function ($user) {
            return $user->hasAccess(['create_aitStatus']);
        });
        Gate::define('update_aitStatus', function ($user) {
            return $user->hasAccess(['update_aitStatus']);
        });
        Gate::define('view_aitStatus', function ($user) {
            return $user->hasAccess(['view_aitStatus']);
        });
        Gate::define('delete_aitStatus', function ($user) {
            return $user->hasAccess(['delete_aitStatus']);
        });

        /** ait type */
        Gate::define('create_aitType', function ($user) {
            return $user->hasAccess(['create_aitType']);
        });
        Gate::define('update_aitType', function ($user) {
            return $user->hasAccess(['update_aitType']);
        });
        Gate::define('view_aitType', function ($user) {
            return $user->hasAccess(['view_aitType']);
        });
        Gate::define('delete_aitType', function ($user) {
            return $user->hasAccess(['delete_aitType']);
        });

        /** ait */
        Gate::define('create_ait', function ($user) {
            return $user->hasAccess(['create_ait']);
        });
        Gate::define('update_ait', function ($user) {
            return $user->hasAccess(['update_ait']);
        });
        Gate::define('view_ait', function ($user) {
            return $user->hasAccess(['view_ait']);
        });
        Gate::define('delete_ait', function ($user) {
            return $user->hasAccess(['delete_ait']);
        });

        /** ait resource status */
        Gate::define('create_aitResourceStatus', function ($user) {
            return $user->hasAccess(['create_aitResourceStatus']);
        });
        Gate::define('update_aitResourceStatus', function ($user) {
            return $user->hasAccess(['update_aitResourceStatus']);
        });
        Gate::define('view_aitResourceStatus', function ($user) {
            return $user->hasAccess(['view_aitResourceStatus']);
        });
        Gate::define('delete_aitResourceStatus', function ($user) {
            return $user->hasAccess(['delete_aitResourceStatus']);
        });

        /** ait resource */
        Gate::define('create_aitResource', function ($user) {
            return $user->hasAccess(['create_aitResource']);
        });
        Gate::define('update_aitResource', function ($user) {
            return $user->hasAccess(['update_aitResource']);
        });
        Gate::define('view_aitResource', function ($user) {
            return $user->hasAccess(['view_aitResource']);
        });
        Gate::define('delete_aitResource', function ($user) {
            return $user->hasAccess(['delete_aitResource']);
        });

        /** ait resource progress origin */
        Gate::define('create_aitProgressOrigin', function ($user) {
            return $user->hasAccess(['create_aitProgressOrigin']);
        });
        Gate::define('update_aitProgressOrigin', function ($user) {
            return $user->hasAccess(['update_aitProgressOrigin']);
        });
        Gate::define('view_aitProgressOrigin', function ($user) {
            return $user->hasAccess(['view_aitProgressOrigin']);
        });
        Gate::define('delete_aitProgressOrigin', function ($user) {
            return $user->hasAccess(['delete_aitProgressOrigin']);
        });

        /** ait resource progress means */
        Gate::define('create_aitProgressMeans', function ($user) {
            return $user->hasAccess(['create_aitProgressMeans']);
        });
        Gate::define('update_aitProgressMeans', function ($user) {
            return $user->hasAccess(['update_aitProgressMeans']);
        });
        Gate::define('view_aitProgressMeans', function ($user) {
            return $user->hasAccess(['view_aitProgressMeans']);
        });
        Gate::define('delete_aitProgressMeans', function ($user) {
            return $user->hasAccess(['delete_aitProgressMeans']);
        });

        /** ait resource progress */
        Gate::define('create_aitResourceProgress', function ($user) {
            return $user->hasAccess(['create_aitResourceProgress']);
        });
        Gate::define('update_aitResourceProgress', function ($user) {
            return $user->hasAccess(['update_aitResourceProgress']);
        });
        Gate::define('view_aitResourceProgress', function ($user) {
            return $user->hasAccess(['view_aitResourceProgress']);
        });
        Gate::define('delete_aitResourceProgress', function ($user) {
            return $user->hasAccess(['delete_aitResourceProgress']);
        });

        /** document type */
        Gate::define('create_documentType', function ($user) {
            return $user->hasAccess(['create_documentType']);
        });
        Gate::define('update_documentType', function ($user) {
            return $user->hasAccess(['update_documentType']);
        });
        Gate::define('view_documentType', function ($user) {
            return $user->hasAccess(['view_documentType']);
        });
        Gate::define('delete_documentType', function ($user) {
            return $user->hasAccess(['delete_documentType']);
        });

        /** document entity */
        Gate::define('create_documentEntity', function ($user) {
            return $user->hasAccess(['create_documenEntity']);
        });
        Gate::define('update_documentEntity', function ($user) {
            return $user->hasAccess(['update_documenEntity']);
        });
        Gate::define('view_documentEntity', function ($user) {
            return $user->hasAccess(['view_documenEntity']);
        });
        Gate::define('delete_documentEntity', function ($user) {
            return $user->hasAccess(['delete_documenEntity']);
        });

        /** document */
        Gate::define('create_document', function ($user) {
            return $user->hasAccess(['create_document']);
        });
        Gate::define('update_document', function ($user) {
            return $user->hasAccess(['update_document']);
        });
        Gate::define('view_document', function ($user) {
            return $user->hasAccess(['view_document']);
        });
        Gate::define('delete_document', function ($user) {
            return $user->hasAccess(['delete_document']);
        });

    }
}