<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|   example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|   https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|   $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|   $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|   $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|       my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['404_override'] = 'not_found';
$route['translate_uri_dashes'] = FALSE;

$route['wb-set-exam'] = 'home/landingpage';

require_once( BASEPATH .'database/DB.php');
$db =& DB();
$query = $db->get( 'app_routes' );
$result = $query->result();
//echo '<pre>';print_r($result);
foreach( $result as $row )
{
    //echo $row->controller;
    if(trim($row->controller)!='')
    {
        $route[ $row->slug ]                  = $row->controller;
        $route[ $row->slug.'/(:num)' ]        = $row->controller;
        $route[ $row->slug.'/(:num)/(:any)' ] = $row->controller;
        $route[ $row->slug.'/:any' ]          = $row->controller;
        $route[ $row->slug.'/(:any)/(:any)' ] = $row->controller;
        $route[ $row->slug.'/(:any)/(:any)/(:any)' ] = $row->controller;


        //$route[ $row->controller ]           = 'error404';
        //$route[ $row->controller.'/:any' ]   = 'error404';
    }
    else
    {
        $route[ $row->slug ]                 = 'content';
        $route[ $row->slug.'/:any' ]         = 'content';
        //$route[ $row->controller ]           = 'error404';
        //$route[ $row->controller.'/:any' ]   = 'error404';
    }
}

$db->select('slug');
$db->from('tbl_examination');
$query = $db->get();
$resultApp = $query->result();
foreach( $resultApp as $rowApp )
{
    $route[ $rowApp->slug ]                 = 'Manage_service/index';
    $route[ $rowApp->slug.'/:any' ]         = 'Manage_service/index';
    //$route[ $row->controller ]           = 'error404';
    //$route[ $row->controller.'/:any' ]   = 'error404';


}

$db->select('slug');
$db->from('tbl_kpo');
$query = $db->get();
$resultApp = $query->result();
foreach( $resultApp as $rowApp )
{
    $route[ $rowApp->slug ]                 = 'Manage_service/institute';
    $route[ $rowApp->slug.'/:any' ]         = 'Manage_service/institute';
    //$route[ $row->controller ]           = 'error404';
    //$route[ $row->controller.'/:any' ]   = 'error404';


}


$route['assets/(:any)'] = 'assets/$1';
