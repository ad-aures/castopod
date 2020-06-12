<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{
    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:
        // $this->session = \Config\Services::session();

        $session = \Config\Services::session();
        $session->start();

        // Defines country
        if (!$session->has('country')) {
            try {
                $reader = new \GeoIp2\Database\Reader(
                    WRITEPATH . 'uploads/GeoLite2-Country/GeoLite2-Country.mmdb'
                );
                $geoip = $reader->country($_SERVER['REMOTE_ADDR']);
                $session->set('country', $geoip->country->isoCode);
            } catch (\Exception $e) {
                $session->set('country', 'N/A');
            }
        }
        // Defines browser
        if (!$session->has('browser')) {
            try {
                $whichbrowser = new \WhichBrowser\Parser(getallheaders());
                $session->set('browser', $whichbrowser->browser->name);
            } catch (\Exception $e) {
                $session->set('browser', 'Other');
            }
        }

        // Defines referrer
        $newreferer = isset($_SERVER['HTTP_REFERER'])
            ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST)
            : '- Direct -';
        $newreferer =
            $newreferer == parse_url(current_url(false), PHP_URL_HOST)
                ? '- Direct -'
                : $newreferer;
        if (!$session->has('referer') or $newreferer != '- Direct -') {
            $session->set('referer', $newreferer);
        }
    }

    protected function stats($postcast_id)
    {
        $session = \Config\Services::session();
        $session->start();
        $db = \Config\Database::connect();
        $procedureName = $db->prefixTable('analytics_website');
        $db->query("call $procedureName(?,?,?,?)", [
            $postcast_id,
            $session->get('country'),
            $session->get('browser'),
            $session->get('referer'),
        ]);
    }
}
