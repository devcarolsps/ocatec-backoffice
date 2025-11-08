<?php


use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\File;

if (!function_exists('genUID')) {
    function genUID($l = 10)
    {
        return substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXZ"), 0, $l);
    }
}

if (!function_exists('echo_message')) {
    /**
     * @param string $message
     * @return void
     */
    function echo_message(string $message): void
    {
        $date = date('Y-m-d H:i:s');
        echo "[{$date}] {$message}" . PHP_EOL;
    }
}

if (!function_exists('mask')) {
    function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }
        return $maskared;
    }
}

if (!function_exists('validar_data')) {
    /**
     * @param string $data
     * @param string $format
     * @return bool
     */
    function validar_data(string $data, string $format = 'd/Y'): bool
    {
        $d = DateTime::createFromFormat($format, $data);
        return $d && $d->format($format) == $data;
    }
}

if (!function_exists('fileNameSlug')) {
    /**
     * @param string|null $arquivoNome
     * @return string
     */
    function fileNameSlug(?string $arquivoNome): string
    {
        $nome = pathinfo($arquivoNome, PATHINFO_FILENAME);
        $extensao = pathinfo($arquivoNome, PATHINFO_EXTENSION);

        return Str::slug($nome) . "." . $extensao;
    }
}

if (!function_exists('money')) {
    /**
     * @param string|float|int|null $value
     * @param bool $convertFromCents
     * @return float
     */
    function money($value, bool $convertFromCents = false): float
    {
        // is negative number
        $neg = strpos((string)$value, '-') !== false;

        $value = ltrim($value, '0');

        if ($value === '') {
            $value = 0;
        }

        // convert "," to "."
        $value = str_replace(',', '.', $value);

        // remove everything except numbers and dot "."
        $value = preg_replace("/[^0-9\.]/", "", $value);

        // mantém dois decimais
        $value = number_format($value, 2, '.', '');

        // remove all seperators from first part and keep the end
        $value = str_replace('.', '', substr($value, 0, -3)) . substr($value, -3);

        if ($convertFromCents === true) {
            return ($value / 100);
        }

        // Set negative number
        if ($neg) {
            $value = '-' . $value;
        }

        // return float
        return (float)$value;
    }
}

if (!function_exists('onlyNumbers')) {
    /**
     * @param string|float|int|null $value
     * @return array|string|string[]|null
     */
    function onlyNumbers($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }
}

if (!function_exists('validarCpf')) {
    /**
     * @param $cpf
     * @return bool
     */
    function validarCpf($cpf): bool
    {
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }
}


if (!function_exists('validarCnpj')) {
    /**
     * @param $document
     * @return bool
     */
    function validarCnpj($document): bool
    {
        // Extrai os números
        $cnpj = preg_replace('/[^0-9]/is', '', $document);

        // Valida tamanho
        if (strlen($cnpj) !== 14) {
            return false;
        }

        // Verifica sequência de digitos repetidos. Ex: 11.111.111/111-11
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        // Valida dígitos verificadores
        for ($t = 12; $t < 14; $t++) {
            for ($d = 0, $m = ($t - 7), $i = 0; $i < $t; $i++) {
                $d += $cnpj[$i] * $m;
                $m = ($m === 2 ? 9 : --$m);
            }

            $d = ((10 * $d) % 11) % 10;
            if ($cnpj[$i] != $d) {
                return false;
            }
        }

        return true;
    }
}

if (!function_exists('mascaraCnpjCpf')) {
    /**
     * @param $value
     * @return array|string|string[]|null
     */
    function mascaraCnpjCpf($value)
    {
        $cpf_length = 11;
        $cnpj_cpf = preg_replace("/\D/", '', $value);

        if (strlen($cnpj_cpf) > 14) {
            return $value;
        }

        if (strlen($cnpj_cpf) === $cpf_length) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
        }

        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }
}


if (!function_exists('response')) {
    /**
     * Return a new response from the application.
     *
     * @param \Illuminate\Contracts\View\View|string|array|null $content
     * @param int $status
     * @param array $headers
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function response($content = '', $status = 200, array $headers = [])
    {
        $factory = app(ResponseFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($content, $status, $headers);
    }
}

if (!function_exists('formataValorDb')) {
    function formataValorDb($valor)
    {
        return str_replace(array('.', ','), array('', '.'), $valor);
    }
}


if (!function_exists('dataExtenso')) {
    function dataExtenso($valor)
    {
        return  utf8_encode(strftime("%A, %d de %B de %Y", strtotime($valor)));
    }
}


if (!function_exists('valorExtenso')) {
    function valorExtenso($valor = 0, $maiusculas = false): string
    {
        if (!$maiusculas) {
            $singular = ["centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão"];
            $plural = ["centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões"];
            $u = ["", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove"];
        } else {
            $singular = ["CENTAVO", "REAL", "MIL", "MILHÃO", "BILHÃO", "TRILHÃO", "QUADRILHÃO"];
            $plural = ["CENTAVOS", "REAIS", "MIL", "MILHÕES", "BILHÕES", "TRILHÕES", "QUADRILHÕES"];
            $u = ["", "um", "dois", "TRÊS", "quatro", "cinco", "seis", "sete", "oito", "nove"];
        }

        $c = ["", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos"];
        $d = ["", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa"];
        $d10 = ["dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove"];

        $z = 0;
        $rt = "";

        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        foreach ($inteiro as $i => $iValue) {
            for ($ii = strlen($iValue); $ii < 3; $ii++) {
                $inteiro[$i] = "0" . $iValue;
            }
        }

        $fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);
        foreach ($inteiro as $i => $iValue) {
            $valor = $iValue;
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                    $ru) ? " e " : "") . $ru;
            $t = count($inteiro) - 1 - $i;
            $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ($valor === "000") {
                $z++;
            } else if ($z > 0) {
                $z--;
            }
            if (($t === 1) && ($z > 0) && ($inteiro[0] > 0)) {
                $r .= (($z > 1) ? " de " : "") . $plural[$t];
            }
            if ($r) {
                $rt .= ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? (($i < $fim) ? ", " : " e ") : " ") . $r;
            }
        }

        if (!$maiusculas) {
            $return = $rt ?: "zero";
        } else {
            if ($rt) {
                $rt = str_replace("E", " e ", ucwords($rt));
            }
            $return = ($rt) ?: "Zero";
        }

        if (!$maiusculas) {
            return str_replace("E", " e ", ucwords($return));
        }

        return strtoupper($return);
    }
}


if( !function_exists('deleteArquivoStorageTmp')){
    function deleteArquivoStorageTmp($path): bool
    {
        if ($path && file_exists($path)) {
            gc_collect_cycles();
            File::delete($path);
            return true;
        }
        return false;
    }
}


if( !function_exists('generateCode')){

    function generateCode($size): string
    {
        $novo_valor = "";
        $valor = "0123456789";
        mt_srand(1000000 * (double)microtime());
        for ($i = 1; $i <= $size; $i++) {
            $novo_valor .= $valor[mt_rand() % strlen($valor)];
        }
        return $novo_valor.''.str_pad(date("s") + 1, 3, "0", STR_PAD_LEFT);
    }
}

if( !function_exists('calculaData')){
    function calculaData($data_inicial, $data_final)
    {
        $diferenca = strtotime($data_final) - strtotime($data_inicial);
        return floor($diferenca / (60 * 60 * 24));
    }
}


