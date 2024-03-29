<?php

require_once('controllers/cards.controller.php');
require_once('libs/Smarty.class.php');

class CardsView {
         
    private $smarty;
    
    function __construct($expansions) {
        $this->smarty = new Smarty();
        $this->smarty->assign('expansions', $expansions);
    }

    function showError($errorCode) {
        $this->smarty->assign('errorCode', $errorCode);

        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/error.tpl');
    }
    
    function showIndex($lastCards, $expansions) {
        foreach ($lastCards as $key=>$card) {
            $this->smarty->assign('cardName' . $key, $card->name);
            $this->smarty->assign('cardExp' . $key, $card->expansion);
            $this->smarty->assign('cardImageURL' . $key, $card->image);
            $this->smarty->assign('cardURL' . $key, $card->id);
        }

        unset($card);

        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/intro.tpl');
        $this->smarty->display('templates/lastCards.tpl');

    }

    function showAddCards() {
        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/addCards.tpl');
        $this->smarty->display('templates/footer.tpl');
    }

    function showAddPokeCard($card_id) {
        $this->smarty->assign('card_id', $card_id);

        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/addPokeCard.tpl');
        $this->smarty->display('templates/footer.tpl');

    }

    function showAddTrainerCard($card_id) {
        $this->smarty->assign('card_id', $card_id);

        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/addTrainerCard.tpl');
        $this->smarty->display('templates/footer.tpl');

    }

    function showAddEnergyCard($card_id) {
        $this->smarty->assign('card_id', $card_id);

        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/addEnergyCard.tpl');
        $this->smarty->display('templates/footer.tpl');

    }

    function showAdmin() {
        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/admin.tpl');
        $this->smarty->display('templates/footer.tpl');

    }

    function showAdvancedSearchCards() {
        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/advancedSearch.tpl');
        $this->smarty->display('templates/footer.tpl');
    }


    function listCards($cards, $expansions) {
        $this->smarty->display('templates/navbar.tpl');
        echo('<h3 class="my-2 ml-3">Lista de cartas en la base de datos</h3>');
        foreach ($cards as $card) {
            $this->smarty->assign('cardName', $card->name);
            $this->smarty->assign('cardId', $card->id);

            if (isset($card->error)) {
                $this->smarty->assign('cardError', $card->error);
                $this->smarty->assign('cardErrorMessage', 'CARTA TRUNCADA');
            } else {
                $this->smarty->assign('cardError', '');
                $this->smarty->assign('cardErrorMessage', '');
            }

            switch ($card->type) {
                case '1':
                    $this->smarty->assign('cardType', 'Pokémon');
                break;
                case '2':
                    $this->smarty->assign('cardType', 'Entrenador');
                break;
                case '3':
                    $this->smarty->assign('cardType', 'Energía');
                break;
            }

            switch ($card->rarity) {
                case '1':
                    $this->smarty->assign('cardRarity', 'Común');
                break;
                case '2':
                    $this->smarty->assign('cardRarity', 'Infrecuente');
                break;
                case '3':
                    $this->smarty->assign('cardRarity', 'Rara');
                break;
            }

            foreach ($expansions as $expansion) {
                if ($expansion->id == $card->expansion) {
                    $this->smarty->assign('cardExpansion', $expansion->name);
                }
            }

            $this->smarty->assign('cardId', $card->id);
            $this->smarty->display('templates/listCard.tpl');
            $this->smarty->display('templates/footer.tpl');
        }
    }

    function ShowCard($card, $cardDetails, $expansions) {

        $this->smarty->assign('cardName', $card[0]->name);
        $this->smarty->assign('expansionName', $card[0]->expansion);
        $this->smarty->assign('cardURL', $card[0]->image);

        switch ($card[0]->type) {
            case '1': // Pokémon
                $this->smarty->assign('trainerCard', 'd-none');
                $this->smarty->assign('energyCard', 'd-none');
                if(isset($cardDetails[0]->pokePowerDesc)) {
                    $cardDetails[0]->pokePowerDesc = str_replace("{", "<span class='tcg-symbol'>", $cardDetails[0]->pokePowerDesc);
                    $cardDetails[0]->pokePowerDesc = str_replace("}", "</span>", $cardDetails[0]->pokePowerDesc);
                }
                if(isset($cardDetails[0]->attackDesc1)) {
                    $cardDetails[0]->attackDesc1 = str_replace("{", "<span class='tcg-symbol'>", $cardDetails[0]->attackDesc1);
                    $cardDetails[0]->attackDesc1 = str_replace("}", "</span>", $cardDetails[0]->attackDesc1);
                }
                if(isset($cardDetails[0]->attackDesc2)) {
                    $cardDetails[0]->attackDesc2 = str_replace("{", "<span class='tcg-symbol'>", $cardDetails[0]->attackDesc2);
                    $cardDetails[0]->attackDesc2 = str_replace("}", "</span>", $cardDetails[0]->attackDesc2);
                }
                break;
            case '2': // Entrenador
                $this->smarty->assign('pokemonCard', 'd-none');
                $this->smarty->assign('energyCard', 'd-none');
                if(isset($cardDetails[0]->description)) {
                    $cardDetails[0]->description = str_replace("{", "<span class='tcg-symbol'>", $cardDetails[0]->description);
                    $cardDetails[0]->description = str_replace("}", "</span>", $cardDetails[0]->description);
                }
                $this->smarty->assign('trainerDescription', $cardDetails[0]->description);
                break;
            case '3': // Energía
                $this->smarty->assign('trainerCard', 'd-none');
                $this->smarty->assign('pokemonCard', 'd-none');
                if(isset($cardDetails[0]->description)) {
                    $cardDetails[0]->description = str_replace("{", "<span class='tcg-symbol'>", $cardDetails[0]->description);
                    $cardDetails[0]->description = str_replace("}", "</span>", $cardDetails[0]->description);
                }
                $this->smarty->assign('energyDescription', $cardDetails[0]->description);
                break;
        }

        foreach ($expansions as $expansion) {
            if($expansion->id == $card[0]->expansion) {
                $this->smarty->assign('expansionName', $expansion->name);
            }
        }

        //Acá empieza la declaración de variables para mostrar los datos de la carta en caso de que sea un Pokémon

        if ($card[0]->type == '1') {
            switch ($cardDetails[0]->stage) {
                case '0':
                    $this->smarty->assign('stage', 'Pokémon Básico');
                    break;
                case '1':
                    $this->smarty->assign('stage', 'Etapa 1');
                    break;
                case '2':
                    $this->smarty->assign('stage', 'Etapa 2');
                    break;
            }

            $this->smarty->assign('evolvesFrom', $cardDetails[0]->evolvesFrom);
            $this->smarty->assign('hp', $cardDetails[0]->hp);
            $this->smarty->assign('typeSymbol', $cardDetails[0]->type);

            // Datos del PokePower. Si no tiene, no se muestra nada.
            if (!isset($cardDetails[0]->pokePowerName)) {
                $this->smarty->assign('pokePowerHidden', 'd-none');
            } else {
                $this->smarty->assign('pokePowerHidden', '');
            }
            $this->smarty->assign('pokePowerName', $cardDetails[0]->pokePowerName);
            $this->smarty->assign('pokePowerDescription', $cardDetails[0]->pokePowerDesc);

            //Datos del primer ataque. Si no tiene, no se muestra nada.
            if ($cardDetails[0]->attackName1 == '') {
                $this->smarty->assign('attackHidden1', 'd-none');
            } else {
                $this->smarty->assign('attackHidden1', '');
            }
            $this->smarty->assign('attackName1', $cardDetails[0]->attackName1);
            $this->smarty->assign('attackDesc1', $cardDetails[0]->attackDesc1);
            $this->smarty->assign('attackDamage1', $cardDetails[0]->attackDamage1);
            $this->smarty->assign('attackEnergies1', $cardDetails[0]->attackEnergies1);

            //Datos del segundo ataque. Si no tiene, no se muestra nada.
            if ($cardDetails[0]->attackName2 == '') {
                $this->smarty->assign('attackHidden2', 'd-none');
            } else {
                $this->smarty->assign('attackHidden2', '');
            }
            $this->smarty->assign('attackName2', $cardDetails[0]->attackName2);
            $this->smarty->assign('attackDesc2', $cardDetails[0]->attackDesc2);
            $this->smarty->assign('attackDamage2', $cardDetails[0]->attackDamage2);
            $this->smarty->assign('attackEnergies2', $cardDetails[0]->attackEnergies2);

            if ($cardDetails[0]->weakness == '0') {
                $this->smarty->assign('weakness', '');
            } else {
                $this->smarty->assign('weakness', $cardDetails[0]->weakness);
            }

            if ($cardDetails[0]->resistance == '0') {
                $this->smarty->assign('resistance', '');
            } else {
                $this->smarty->assign('resistance', $cardDetails[0]->resistance);
            }

            $this->smarty->assign('retreatCost', $cardDetails[0]->retreatCost);
            $this->smarty->assign('pokedexText', $cardDetails[0]->pokedexInfo);
        }
        // Descripción de Entrenadores y Energías
        // Lo hago así para no asignar variables que no se van a usar.

        $this->smarty->assign('cardId', $card[0]->id);
        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/showCard.tpl');
        $this->smarty->display('templates/vue/commentList.tpl');
        $this->smarty->display('templates/footer.tpl');
    }

    function showEditCard($card, $cardDetails) {
        $this->smarty->assign('cardId', $card[0]->id);
        $this->smarty->assign('cardName', $card[0]->name);
        $this->smarty->assign('cardType', $card[0]->type);
        $this->smarty->assign('cardRarity', $card[0]->rarity);
        $this->smarty->assign('expansion', $card[0]->expansion);
        $this->smarty->assign('expNumber', $card[0]->expNumber);

        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/editCards.tpl');
    }

    function showEditCardImg($card) {
        $this->smarty->assign('cardId', $card[0]->id);

        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/editCardImg.tpl');
    }

    function showEditPokeCard($card_id, $type, $hp, $stage, $evolvesFrom, $attackName1, $attackDesc1, $attackDamage1, $attackEnergies1, $attackName2, $attackDesc2, $attackDamage2, $attackEnergies2, $hasPokePower, $pokePowerName, $pokePowerDesc, $weakness, $resistance, $retreatCost, $pokedexInfo) {
        $this->smarty->assign('card_id', $card_id);
        $this->smarty->assign('type', $type);
        $this->smarty->assign('hp', $hp);
        $this->smarty->assign('stage', $stage);
        $this->smarty->assign('evolvesFrom', $evolvesFrom);
        $this->smarty->assign('attackName1', $attackName1);
        $this->smarty->assign('attackDesc1', $attackDesc1);
        $this->smarty->assign('attackDamage1', $attackDamage1);
        $this->smarty->assign('attackEnergies1', $attackEnergies1);
        $this->smarty->assign('attackName2', $attackName2);
        $this->smarty->assign('attackDesc2', $attackDesc2);
        $this->smarty->assign('attackDamage2', $attackDamage2);
        $this->smarty->assign('attackEnergies2', $attackEnergies2);
        $this->smarty->assign('hasPokePower', $hasPokePower);
        $this->smarty->assign('pokePowerName', $pokePowerName);
        $this->smarty->assign('pokePowerDesc', $pokePowerDesc);
        $this->smarty->assign('weakness', $weakness);
        $this->smarty->assign('resistance', $resistance);
        $this->smarty->assign('retreatCost', $retreatCost);
        $this->smarty->assign('pokedexInfo', $pokedexInfo);

        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/editPokeCard.tpl');
    }

    function showEditTrainerCard($card_id) {
        $this->smarty->assign('card_id', $card_id);

        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/editTrainerCard.tpl');
    }

    function showEditEnergyCard($card_id) {
        $this->smarty->assign('card_id', $card_id);

        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/editEnergyCard.tpl');
    }

    function showConfirmEditCard($id, $oldCardType, $newCardType) {
        switch ($oldCardType) {
            case '1':
                $this->smarty->assign('oldCardType', 'Pokémon');
                break;
            case '2':
                $this->smarty->assign('oldCardType', 'Entrenador');
                break;
            case '3':
                $this->smarty->assign('oldCardType', 'Energía');
                break;
        }
        switch ($newCardType) {
            case '1':
                $this->smarty->assign('newCardType', 'Pokémon');
                break;
            case '2':
                $this->smarty->assign('newCardType', 'Entrenador');
                break;
            case '3':
                $this->smarty->assign('newCardType', 'Energía');
                break;
        }
        $this->smarty->assign('id', $id);
        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/confirmEditCard.tpl');
    }

    function showAllCards($allCards, $allExpansions, $page = 0, $lastPage = false, $enabled = true) {
        $this->smarty->display('templates/navbar.tpl');
        echo ("<div class='container-fluid'>");
        echo ("<div class='row mb-2 mt-2'>");
        $path = deleteQuery($_SERVER['REQUEST_URI']);
        foreach ($allCards as $key=>$card) {
            foreach ($allExpansions as $expansion) {
                if ($card->expansion == $expansion->id) {
                    $card->expansion = $expansion->name;
                }
            }
            $this->smarty->assign('allCards', $card);
            $this->smarty->display('templates/showAllCards.tpl');
        }
        echo ("</div>");
        echo ("</div>");
        echo ("</div>");
        if ($enabled) {
            $this->smarty->assign('page', $page);
            $this->smarty->assign('path', $path);
            $this->smarty->assign('lastPage', $lastPage);
            $this->smarty->display('templates/pagination.tpl');
        }
        $this->smarty->display('templates/footer.tpl');

        unset ($card);
    }

    function showExpansions($allExpansions) {
        $this->smarty->display('templates/navbar.tpl');
        echo ("<div class='container-fluid'>");
        echo ("<div class='row mb-2 mt-2'>");
        foreach ($allExpansions as $key=>$expansion) {
            $this->smarty->assign('shownExpansion', $expansion);
            $this->smarty->display('templates/showExpansions.tpl');
        }

        echo ("</div>");
        echo ("</div>");
        echo ("</div>");
        $this->smarty->display('templates/footer.tpl');

        unset ($expansion);
    }
   
    function showEditExpansion($expansion) {
        $this->smarty->assign('expansionName', $expansion[0]->name);
        $this->smarty->assign('expansionId', $expansion[0]->id);

        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/editExpansion.tpl');
    }

    function listExpansions($allExpansions) {
        $this->smarty->display('templates/navbar.tpl');
        echo('<h3 class="my-2 ml-3">Lista de expansiones en la base de datos</h3>');
        foreach ($allExpansions as $expansion) {
            $this->smarty->assign('expansionName', $expansion->name);
            $this->smarty->assign('expansionId', $expansion->id);
            $this->smarty->display('templates/listExpansions.tpl');
        }
    }

    function showAddExpansion() {
        $this->smarty->display('templates/navbar.tpl');
        $this->smarty->display('templates/addExpansion.tpl');
    }
}