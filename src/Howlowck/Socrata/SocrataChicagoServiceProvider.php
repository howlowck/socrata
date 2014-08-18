<?php namespace Howlowck\Socrata;

use Illuminate\Support\ServiceProvider;

class SocrataChicagoServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
//	protected $defer = false;

	public function boot()
	{

	}
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->package('howlowck/socrata');

		$this->app['socrata-chicago'] = $this->app->share(function ($app) {
			$config = $app['config']['socrata'] ?: $app['config']['socrata::config'];
			$sec_token = $config['secret_token'];
			$pub_token = $config['public_token'];
			$url = $config['chicago'];
			$soc = new Socrata($url, $sec_token, $pub_token);
			return $soc;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('socrata-chicago');
	}

}
