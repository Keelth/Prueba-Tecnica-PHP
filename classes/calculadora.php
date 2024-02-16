<?php

class calculadora
{

    private $resultado;
    private $usuarioRes;
    private $usuarioAnterior;
    private $operando_1;
    private $operando_2;
    private $operando_3;
    private $operaciones_anteriores;
    private static ?calculadora $instance = null;

    private function __construct()
    {
        $this->resultado = "";
        $this->usuarioRes = "";
        $this->usuarioAnterior = "";
        $this->operando_1 = "";
        $this->operando_2 = "";
        $this->operando_3 = "";
        $this->operaciones_anteriores = array();
        $file = fopen("db.txt", "r");
        if (filesize("db.txt")) {
            while (!feof($file)) {
                $line = fgets($file);
                if (!(trim($line) == '')) {
                    $record = explode(",", $line);
                    $this->operaciones_anteriores[$record[0]] = $record[1];
                }
            }
        }
        fclose($file);
    }

    public static function getInstance(): calculadora
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setOperando1($operando_1)
    {
        $this->operando_1 = $operando_1;
    }

    public function setOperando2($operando_2)
    {
        $this->operando_2 = $operando_2;
    }

    public function setOperando3($operando_3)
    {
        $this->operando_3 = $operando_3;
    }

    public function setUsuario($usuarioRes)
    {
        $this->usuarioRes = $usuarioRes;
    }

    public function appendOperacionAnterior($usuarioRes, $operacion)
    {
        $this->operaciones_anteriores[$usuarioRes] = $operacion;
    }

    public function verificar()
    {
        if (!(empty($this->operando_1)) and !(empty($this->operando_2))) {
            $this->realizarOperacion();
        } else {
            $this->resultado = "Tanto Operando 1 como Operando 2 deben ser ingresados.";
        }
    }

    public function realizarOperacion()
    {
        if (empty($this->operando_3)) {
            if (is_numeric($this->operando_1) and is_numeric($this->operando_2)) {
                $this->resultado = (int) $this->operando_1 + (int) $this->operando_2;
            } else {
                $this->resultado = $this->operando_1 . $this->operando_2;
            }
        } else {
            if (is_numeric($this->operando_1) and is_numeric($this->operando_2) and is_numeric($this->operando_3)) {
                $this->resultado = (int) $this->operando_1 + (int) $this->operando_2 + (int) $this->operando_3;
            } else {
                $this->resultado = $this->operando_1 . $this->operando_2 . $this->operando_3;
            }
        }

        if (in_array($this->resultado, $this->operaciones_anteriores) == 1) {
            $this->usuarioAnterior = array_search($this->resultado, $this->operaciones_anteriores);
            $this->setUsuario($this->usuarioAnterior);
        } else {
            $this->appendOperacionAnterior($this->usuarioRes, $this->resultado);
            $current = file_get_contents("db.txt");
            $textToAdd = $this->usuarioRes . ',' . $this->resultado;
            $textToAdd .= "\n";
            $current .= $textToAdd;
            file_put_contents("db.txt", $current);
        }
    }

    public function getResultado()
    {
        return $this->resultado;
    }

    public function getUsuario()
    {
        return $this->usuarioRes;
    }
}