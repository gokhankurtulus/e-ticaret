<?php

namespace routes;
class Route
{
    protected static $requestUrl;
    protected static $page;
    protected static $action;
    protected static $sort;
    protected static $pagination;

    public function get()
    {
        self::$requestUrl = $_SERVER['REQUEST_URI'];
        try {
            $parsed_url = explode('/', self::$requestUrl);
            self::$page = $parsed_url[2];
            self::$action = $parsed_url[3];
            self::$sort = $parsed_url[4];
            self::$pagination = $parsed_url[5];
        } catch (\Exception $exception) {
        }
        if (self::$page == '')
            self::$page = 'index';
        if (self::$page == 'panel' && self::$action == '')
            self::$action = 'index';
    }

    public function getUrl()
    {
        return self::$requestUrl;
    }

    public function getPage()
    {
        return self::$page;
    }

    public function getAction()
    {
        return self::$action;
    }

    public function getSort()
    {
        return self::$sort;
    }

    public function getPagination()
    {
        return self::$pagination;
    }
}