<?php
namespace App\Utilities;

use Illuminate\Support\Str;

class Resources
{
    /**
     * Tiempo en segundos de la cache para algunos endpoint
     */
    const CACHE_DEFAULT = 60*60*24*7;

    /**
     * Paginacion para endpoint de expertises
     */
    const PAGINATE_EXPERTISES = 10;

    /**
     * Paginacion para endpoint de cultural_rights
     */
    const PAGINATE_CULTURALRIGHTS = 10;

    /**
     * Paginacion para endpoint de nac
     */
    const PAGINATE_NACS = 10;

    /**
     * Paginacion para endpoint de activitys
     */
    const PAGINATE_ACTIVITIES = 10;


    /**
     * Path para endpoint de expertises en withPath
     */
    const PATH_EXPERTISES = '/api/reference/expertises';

    /**
     * Path para endpoint de cultural_rights en withPath
     */
    const PATH_CULTURALRIGHTS = '/api/reference/cultural';

    /**
     * Path para endpoint de activitys en withPath
     */
    const PATH_ACTIVITIES = '/api/activity';

    /**
     * Path para endpoint de cultural_rights en withPath
     */
    const PATH_NACS = '/api/reference/nac';
    /**
     * @param $value
     * @return string en mayusculas
     */
    public static function getUpperString($value)
    {
        return Str::upper(strip_tags(trim($value)));
    }
}
