<?php

namespace Servers;
use Services\PessoaService;
class RestServer
{
    public static function run($request)
    {

        $response = array(
            'status' => '',
            'data' => '',
        );

        $class = isset($request['class']) ? $request['class'] : null;
        $method = isset($request['method']) ? $request['method'] : '';

        try {
            if (class_exists('Services\\'.$class)) {
                if (method_exists('Services\\'.$class, $method)) {
                    $response = call_user_func(['Services\\'.$class, $method], $request);
                    return json_encode(['status' => 'Sucesss',
                        'data' => $response]);
                } else {
                    $response['status'] = 'Error';
                    $response['data'] = "O Metódo=>  {$method} da classe => {$class} inválido ou não informado";
                    return json_encode($response);
                }
            } else {
                $response['status'] = 'Error';
                $response['data'] = "Classe {$class} nao informada ou invalida";
                return json_encode($response);
            }
        } catch (\Exception $e) {
            $response['status'] = 'Error';
            $response['data'] = $e->getMessage();
            return json_encode($response);
        }

    }
}

