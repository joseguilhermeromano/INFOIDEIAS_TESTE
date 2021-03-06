<?php

namespace SRC;

class Funcoes
{
    /*

    Desenvolva uma função que receba como parâmetro o ano e retorne o século ao qual este ano faz parte. O primeiro século começa no ano 1 e termina no ano 100, o segundo século começa no ano 101 e termina no 200.

	Exemplos para teste:

	Ano 1905 = século 20
	Ano 1700 = século 17

     * */
    public function SeculoAno(int $ano): int {
        if($ano <= 0 ){
            return 0;
        }

        $qtd_digitos = mb_strlen($ano);

        if($qtd_digitos < 3){
            return 1;
        }elseif(($ano % 100) != 0 ){
           $seculo = floor($ano/100);
           return $seculo + 1;
        }

        return ($ano/100);
    }
	
	/*

    Desenvolva uma função que receba como parâmetro um número inteiro e retorne o numero primo imediatamente anterior ao número recebido

    Exemplo para teste:

    Numero = 10 resposta = 7
    Número = 29 resposta = 23

     * */
    public function PrimoAnterior(int $numero): int {
        $primos = [];
        $eNegativo = false;

        if($numero == 0) {
            return 0;
        }

        if($numero < 0){
            $eNegativo = true;
            $numero *= -1;
        }

        for($a = 1; $a <= $numero; $a++){
            $divisores = 0;
            for($b = $a; $b >= 1; $b--){
                if(($a % $b) == 0){
                    $divisores++;
                }
            }

            if($divisores == 2 && $a != $numero){
                array_push($primos, $a); 
            }
        }

        $numElementos = count($primos);
        $ultimo_elemento = $primos[$numElementos - 1];

        if($eNegativo){
            $ultimo_elemento *= -1;
        }

        return $ultimo_elemento;
        
    }

    /*

    Desenvolva uma função que receba como parâmetro um array multidimensional de números inteiros e retorne como resposta o segundo maior número.

    Exemplo para teste:

	Array multidimensional = array (
	array(25,22,18),
	array(10,15,13),
	array(24,5,2),
	array(80,17,15)
	);

	resposta = 25

     * */
    public function SegundoMaior(array $arr): int {
        $vetor = [];
        //checa se o array é válido (multidimensional)
        if(count($arr) == count($arr, COUNT_RECURSIVE)){
            return 0;
        }

        foreach($arr as $sub_arr){
            foreach ($sub_arr as $elem){
                array_push($vetor, $elem);
            }
        }

        array_multisort($vetor, SORT_DESC, array_keys($vetor));

        return $vetor[1];
    }

    /*
   Desenvolva uma função que receba como parâmetro um array de números inteiros e responda com TRUE or FALSE se é possível obter uma sequencia crescente removendo apenas um elemento do array.

	Exemplos para teste 

	Obs.:-  É Importante  realizar todos os testes abaixo para garantir o funcionamento correto.
         -  Sequencias com apenas um elemento são consideradas crescentes

    [1, 3, 2, 1]  false
    [1, 3, 2]  true
    [1, 2, 1, 2]  false
    [3, 6, 5, 8, 10, 20, 15] false
    [1, 1, 2, 3, 4, 4] false
    [1, 4, 10, 4, 2] false
    [10, 1, 2, 3, 4, 5] true
    [1, 1, 1, 2, 3] false
    [0, -2, 5, 6] true
    [1, 2, 3, 4, 5, 3, 5, 6] false
    [40, 50, 60, 10, 20, 30] false
    [1, 1] true
    [1, 2, 5, 3, 5] true
    [1, 2, 5, 5, 5] false
    [10, 1, 2, 3, 4, 5, 6, 1] false
    [1, 2, 3, 4, 3, 6] true
    [1, 2, 3, 4, 99, 5, 6] true
    [123, -17, -5, 1, 2, 3, 12, 43, 45] true
    [3, 5, 67, 98, 3] true

     * */
    
	public function SequenciaCrescente(array $arr): bool {
        $validacao = [];

        //checa se o array é válido (multidimensional)
        if(!(count($arr) == count($arr, COUNT_RECURSIVE))){
            return false;
        }

        //não aceita arrays com strings
        foreach($arr as $elem){
            if(!is_numeric($elem)){
                return false;
            }
        }

        $qtd_elem = count($arr);

        for($i = 0; $i < $qtd_elem; $i++){
            $current_arr = $arr;
            unset($current_arr[$i]);
            array_unshift($current_arr,"");
            unset($current_arr[0]);
            $sorted = array_values($current_arr);
            sort($sorted);
            $sorted = array_unique($sorted);//remove duplicidades
            array_unshift($sorted,"");
            unset($sorted[0]);

            if($current_arr === $sorted){
                array_push($validacao, 'true');
            }else{
                array_push($validacao, 'false');
            }
        }

        return in_array('true', $validacao) ? true : false;
    }
}

//TESTES PARTICULARES
echo "<pre>";
echo "TESTES DA FUNÇÃO SELCULO ANO: \n\n";
echo Funcoes::SeculoAno(1905)."\n";
echo Funcoes::SeculoAno(1700)."\n";
echo Funcoes::SeculoAno(33333)."\n";
echo Funcoes::SeculoAno(2022)."\n";
echo Funcoes::SeculoAno(1968)."\n";
echo Funcoes::SeculoAno(645)."\n";
echo Funcoes::SeculoAno(107)."\n";
echo Funcoes::SeculoAno(45)."\n";
echo Funcoes::SeculoAno(0)."\n";
echo "</pre>";

echo "<pre>";
echo "TESTES DA FUNÇÃO PRIMO ANTERIOR: \n\n";
echo Funcoes::PrimoAnterior(19)."\n";
echo Funcoes::PrimoAnterior(10)."\n";
echo Funcoes::PrimoAnterior(29)."\n";
echo Funcoes::PrimoAnterior(0)."\n";
echo Funcoes::PrimoAnterior(-10)."\n";
echo Funcoes::PrimoAnterior(-29)."\n";
echo "</pre>";

$arr = array (
    array(25,22,18),
    array(10,15,13),
    array(24,5,2),
    array(80,17,15)
);


echo "<pre>";
echo "TESTES DA FUNÇÃO SEGUNDO MAIOR: \n\n";
echo Funcoes::SegundoMaior($arr)."\n";
$arr = [22, 23, 24];
echo Funcoes::SegundoMaior($arr)."\n";
echo "</pre>";

echo "<pre>";
echo "TESTES DA FUNÇÃO SEQUENCIA CRESCENTE: \n\n";
echo "[1, 3, 2, 1]:".(Funcoes::SequenciaCrescente([1, 3, 2, 1]) ? 'true' : 'false')."\n";
echo "[1, 3, 2]:".(Funcoes::SequenciaCrescente([1, 3, 2])? 'true' : 'false')."\n";
echo "[1, 2, 1, 2]:".(Funcoes::SequenciaCrescente([1, 2, 1, 2])? 'true' : 'false')."\n";
echo "[3, 6, 5, 8, 10, 20, 15]:".(Funcoes::SequenciaCrescente([3, 6, 5, 8, 10, 20, 15])? 'true' : 'false')."\n";
echo "[1, 1, 2, 3, 4, 4]:".(Funcoes::SequenciaCrescente([1, 1, 2, 3, 4, 4])? 'true' : 'false')."\n";
echo "[1, 4, 10, 4, 2]:".(Funcoes::SequenciaCrescente([1, 4, 10, 4, 2])? 'true' : 'false')."\n";
echo "[10, 1, 2, 3, 4, 5]:".(Funcoes::SequenciaCrescente([10, 1, 2, 3, 4, 5])? 'true' : 'false')."\n";
echo "[1, 1, 1, 2, 3]:".(Funcoes::SequenciaCrescente([1, 1, 1, 2, 3])? 'true' : 'false')."\n";
echo "[0, -2, 5, 6]:".(Funcoes::SequenciaCrescente([0, -2, 5, 6])? 'true' : 'false')."\n";
echo "[1, 2, 3, 4, 5, 3, 5, 6]:".(Funcoes::SequenciaCrescente([1, 2, 3, 4, 5, 3, 5, 6])? 'true' : 'false')."\n";
echo "[40, 50, 60, 10, 20, 30]:".(Funcoes::SequenciaCrescente([40, 50, 60, 10, 20, 30])? 'true' : 'false')."\n";
echo "[1, 1]:".(Funcoes::SequenciaCrescente([1, 1])? 'true' : 'false')."\n";
echo "[1, 2, 5, 3, 5]:".(Funcoes::SequenciaCrescente([1, 2, 5, 3, 5])? 'true' : 'false')."\n";
echo "[1, 2, 5, 5, 5]:".(Funcoes::SequenciaCrescente([1, 2, 5, 5, 5])? 'true' : 'false')."\n";
echo "[10, 1, 2, 3, 4, 5, 6, 1]:".(Funcoes::SequenciaCrescente([10, 1, 2, 3, 4, 5, 6, 1])? 'true' : 'false')."\n";
echo "[1, 2, 3, 4, 3, 6]:".(Funcoes::SequenciaCrescente([1, 2, 3, 4, 3, 6])? 'true' : 'false')."\n";
echo "[1, 2, 3, 4, 99, 5, 6]:".(Funcoes::SequenciaCrescente([1, 2, 3, 4, 99, 5, 6])? 'true' : 'false')."\n";
echo "[123, -17, -5, 1, 2, 3, 12, 43, 45]:".(Funcoes::SequenciaCrescente([123, -17, -5, 1, 2, 3, 12, 43, 45])? 'true' : 'false')."\n";
echo "[3, 5, 67, 98, 3]:".(Funcoes::SequenciaCrescente([3, 5, 67, 98, 3])? 'true' : 'false')."\n";
echo "</pre>";

