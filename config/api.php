<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Page Limit
    |--------------------------------------------------------------------------
    |
    | This value is to limit how many results appear in the response of the api
    | per page. This is to allow easy modification of the limits dependant on
    | the host machine.
    |
    */
    'page_limit' => env('API_PAGE_LIMIT', 100),
];
