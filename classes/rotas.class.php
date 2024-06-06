 <?php
    class Rotas
    {

        private $listaRotas = [''];
        private $listaCallback = [''];
        private $listaProtecao = [''];


        public function add($metodo, $rota, $callback)
        {
            $this->listaRotas[] = strtoupper($metodo) . ':' . $rota;
            $this->listaCallback[] = $callback;

            return $this;
        }

        public function ir($rota)
        {
            $param = '';
            $callback = '';
            $methodServer = $_SERVER['REQUEST_METHOD'];
            $methodServer = isset($_POST['_method']) ? $_POST['_method'] : $methodServer;
            $rota = $methodServer . ":/" . $rota;

            if (substr_count($rota, "/") >= 2) {
                $param = substr($rota, strrpos($rota, "/") + 1);
                $rota = substr($rota, 0,  strrpos($rota, "/")) . "/[NIS]";
            }

            $indice = array_search($rota, $this->listaRotas);


            if ($indice > 0) {
                $callback = explode("::", $this->listaCallback[$indice]);
            }

            $class = isset($callback[0]) ? $callback[0] : '';

            $method = isset($callback[1]) ? $callback[1] : '';

            if (class_exists($class)) {
                if (method_exists($class, $method)) {
                    $instanciaClass = new $class();
                    return call_user_func_array(
                        array($instanciaClass, $method),
                        array($param)
                    );
                } else {
                    http_response_code(404);
                }
            } else {
                http_response_code(404);
            }
        }
    }
