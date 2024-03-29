<?php

class Parameters
{
    const FILE_NAME = 'producs.txt';
    const COLUMNS = ['item', 'price'];
    const POPULATION_SIZE = 10;  
}


class Catalogue{

    function createProductColumn($listOfRawProduct){
        foreach (array_keys($listOfRawProduct) as $listOfRawProductKey){
            $listOfRawProduct[Parameters::COLUMNS[$listOfRawProductKey]] = $listOfRawProduct[$listOfRawProductKey];
            unset($listOfRawProduct[$listOfRawProductKey]);
        }
        return $listOfRawProduct;

    }
    function product(){
        $collectionOfListProduct = [];
        $raw_data = file(Parameters::FILE_NAME);
        foreach ($raw_data as $listOfRawProduct ){
            $collectionOfListProduct[] = $this->createProductColumn( explode(",", $listOfRawProduct));
        }

        return $collectionOfListProduct;
    }
    
}

class Individu 
{
    function countNumberOfGen(){
        $catalogue = new Catalogue;
        return count($catalogue->product());
    }
   function createRandomIndividu(){
       for ($i = 0; $i <= $this->countNumberOfGen()-1; $i++){
           $ret[] = rand(0, 1);
       }
       return $ret;
   }
}


class Population{

    function createRandomPopulation(){
        $individu = new Individu;
       for ($i = 0; $i <= Parameters::POPULATION_SIZE-1; $i++) {
         $ret[] = $individu->createRandomIndividu(); 
       }
       
      return $ret;
    }
}

class Fitness 
{
    function selectingItem($individu){
        $catalogue = new Catalogue;
        foreach($individu as $individuKey => $binaryGen){
          if ($binaryGen ===1){
              $ret[] = [
                  'selectedKey' => $individuKey,
                  'selectedPrice' => $catalogue->product()[$individuKey]['price']
              ];
          }  
        }
        return $ret;
    }

    function calculateFitnessValue($individuKey){
       print_r($this->selectingItem($individu)); 
       exit();
    }

    function fitnessEvaluation($population){
        $catalogue = new Catalogue;
        foreach ($population as $listOfIndividuKey => $listOfIndividu){
            echo 'individu-'. $listOfIndividuKey.'<br>';
            foreach ($listOfIndividu as $individuKey =>$binaryGen){
                echo $binaryGen.'&nbsp;&nbsp;';
                print_r($catalogue->product()[$individuKey]);
                echo '<br>';
            }
            $fitnessValue = $this->calculateFitnessValue($listOfIndividu);
        }

        function calculateFitnessValue($individu){

        }
    }
}

$parameters = [
    'file_name' => 'producs.txt',
    'columns' => ['item', 'price'],
    'population_size'=> 10
];

$initialPopulation = new Population;
$population = $initialPopulation->createRandomPopulation();

$fitness = new Fitness;
$fitness->fitnessEvaluation($population);
//print_r($population);





