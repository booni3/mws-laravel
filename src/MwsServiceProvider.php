<?php namespace Mws\Laravel;

use Illuminate\Support\ServiceProvider;
use anlutro\LaravelSettings\Facade as Setting;

class MwsServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

      /**
     * Set up the MWS configuration
     */
    public function boot()
    {
        
                //Setting values can also be hardcoded within env. variables and pulled in if persistence and use of LaravelSettings is not needed.    
//         $configStore = [
//             // Default service URL
//             'AMAZON_SERVICE_URL' => 'https://mws.amazonservices.com/',
//             'muteLog' => false
//         ];
        
       
//         $configStore = array_merge($configStore, config('mws'));
        $configStore = config('mws');

        $config = \App::make('config');
        $key = 'amazon-mws';
        $config->set($key,  $configStore);

    }
    
    /**
     * Register the Mws Instances to be set up with the API-key.
     * Then, the IoC-container can be used to get Mws instances ready for use.
     *
     * @return void
     */
    public function register()
    {
        //Register Aliases
        foreach (glob(__DIR__.'/Classes/*.php') as $filename) {
            $amz_alias_name = basename($filename, ".php");
            $amz_alias_path = 'Classes'.'/'.$amz_alias_name;
            if ($amz_alias_name != 'environment')
            {
                $this->app->alias($amz_alias_name, $amz_alias_path);
            }
        }
    }
    
}
