<?php

include_once('models/cards.model.php');
include_once('views/cards.view.php');

class CardsController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new CardsModel();
        $this->view = new CardsView();
    }

    function showIndex() {
        $this->view->showIndex();
    }

    function showAddCards() {
        $this->view->showAddCards();
    }

    function addCard() {
        $name = $_REQUEST['name'];
        $type = $_REQUEST['type'];
        $expansion = $_REQUEST['expansion'];
        $expNumber = $_REQUEST['expNumber'];
        $rarity = $_REQUEST['rarity'];
    
        $card_id = $this->model->insertCard($name, $type, $expansion, $expNumber, $rarity);

        if($type = 1) {
            $this->view->showAddPokeCard($card_id);
        } elseif ($type = 2) {
            //$this->view->showAddTrainerCard();
        } elseif ($type = 3) {
            //$this->view->showAddEnergyCard();
        }
    }
    
    function addPokeCard() {
        $type = $_REQUEST['type'];
        $hp = $_REQUEST['hp'];
        $stage = $_REQUEST['stage'];
        $attackName1 = $_REQUEST['attackName1'];
        $attackDesc1 = $_REQUEST['attackDesc1'];
        $attackDamage1 = $_REQUEST['attackDamage1'];
        $attackEnergies1 = $_REQUEST['attackEnergies1'];
        $attackName2 = $_REQUEST['attackName2'];
        $attackDesc2 = $_REQUEST['attackDesc2'];
        $attackDamage2 = $_REQUEST['attackDamage2'];
        $attackEnergies2 = $_REQUEST['attackEnergies2'];
        $hasPokePower = $_REQUEST['hasPokePower'];
        $pokePowerName = $_REQUEST['pokePowerName'];
        $pokePowerDesc = $_REQUEST['pokePowerDesc'];
        $weakness = $_REQUEST['weakness'];
        $resistance = $_REQUEST['resistance'];
        $retreatCost = $_REQUEST['retreatCost'];
        $pokedexInfo = $_REQUEST['pokedexInfo'];
        //$image = $_REQUEST['image'];
    
        $this->model->insertCard($type, $hp, $stage, $attackName1, $attackDesc1, $attackDamage1, $attackEnergies1, $attackName2, $attackDesc2, $attackDamage2, $attackEnergies2, $hasPokePower, $pokePowerName, $pokePowerDesc, $weakness, $resistance, $retreatCost, $pokedexInfo);
    }
}