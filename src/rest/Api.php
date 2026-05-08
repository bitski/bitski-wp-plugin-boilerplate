<?php
/**
 * Plugin REST API gateway.
 *
 * Registers REST API routes for the plugin.
 *
 * Routes are registered conditionally based on the plugin config options.
 * Each route is registered with a callback function that handles the request.
 * The callback function is responsible for fetching and returning the data needed for the route.
 *
 * @since 0.3.0
 */

namespace BitskiWPPluginBoilerplate\rest;

use BitskiWPPluginBoilerplate\core\Options;
use WP_REST_Request;
use WP_REST_Response;

class Api
{
    /**
     * Initializes plugin REST API gateway.
     */
    public function init(): void
    {
        add_action('rest_api_init', [$this, 'registerRestRoutes']);
    }

    /**
     * Registers REST API routes.
     */
    public function registerRestRoutes(): void
    {
        // Registers the 'example-rest-feature' REST route if the feature is enabled in config options.
        if (Options::get('bitski-wp-plugin-boilerplate/option/example-rest-feature')) {
            register_rest_route('bitski-wp-plugin-boilerplate/v1', '/example-rest-feature', [
                'methods'             => 'GET',
                'callback'            => [$this, 'handleExampleRestFeatureEndpoint'],
                'permission_callback' => '__return_true',
                'args'                => [
                    'param' => [
                        'type'        => 'string',
                        'required'    => false,
                        'description' => 'Example query parameter.',
                    ],
                ]
            ]);
        }
        // Add additional endpoints here as needed.
    }

    /**
     * Example REST feature endpoint handler.
     *
     * Returns a basic JSON response.
     *
     * @param  WP_REST_Request  $request
     *
     * @return WP_REST_Response
     */
    public function handleExampleRestFeatureEndPoint(WP_REST_Request $request): WP_REST_Response
    {
        // Extracts the 'param' request parameter with default.
        $param = $request->get_param('param') ?: 'default-value';

        // Returns a JSON response with the 'param' value.
        return new WP_REST_Response([
            'success' => true,
            'message' => 'This is an example plugin REST endpoint.',
            'param'   => $param,
        ]);
    }
}
