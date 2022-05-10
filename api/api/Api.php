<?php
class Api
{
    private $routes;

    public function __construct()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit();
        }

        $arRoutes = ROOT . '/config/routes.php';
        $this->routes = include($arRoutes);

    }

    public function init() {
        $url = $this->getPath();
        $url =substr($url, 4);


        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $url)) {
                $internalRoutes = preg_replace("~$uriPattern~", $path, $url);
                $internalRoutes = explode('/', strtok($internalRoutes, '?'));

                $className = ucfirst(array_shift($internalRoutes));
                $method = ucfirst(array_shift($internalRoutes));
                $params = $this->getParams($url, $path);


                switch ($_SERVER['REQUEST_METHOD']) {
                    case 'GET':
                        if ($_GET) {
                            $params = $_GET;
                        }
                        break;
                    case 'POST':
                        $arPost = json_decode(file_get_contents('php://input'), true);
                        if ($arPost) {
                            $params = $arPost;
                        }
                        break;
                }


                if ($className) {
                    $res = $className::$method($params);
                    isset($res['error']) ? header('HTTP/1.0 404 not found') : header("HTTP/1.1 200 OK");

                    echo json_encode($res);
                }
                exit();
            }
            //header('HTTP/1.0 404 not found');
        }
    }

    private function getPath() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $path = stristr(ROOT, 'public_html/');
            $pathProject = str_replace('public_html', '', $path);
            return trim(str_replace($pathProject, '', $_SERVER['REQUEST_URI']), '/');
        }
    }

    private function getParams($url, $path) {
        $arParams = [];
        $arValues = explode('/', $url);
        $arValues = array_splice($arValues, 2);
        $arKeys = explode('/', $path);
        $arKeys =array_splice($arKeys, 2);

        foreach ($arValues as $key => $value) {
            $key = str_replace('$', "", $arKeys[$key]);
            $arParams[$key] = $value;
        }

        return $arParams;
    }
}