<?php
$card_deck =
    [
        'herz' => [
            'zwei' => 2,
            'drei' => 3,
            'vier' => 4,
            'fuenf' => 5,
            'sechs' => 6,
            'sieben' => 7,
            'acht' => 8,
            'neun' => 9,
            'zehn' => 10,
            'bube' => 10,
            'dame' => 10,
            'koenig' => 10,
            'ass' => [1, 0]
        ],
        'pik' => [
            'zwei' => 2,
            'drei' => 3,
            'vier' => 4,
            'fuenf' => 5,
            'sechs' => 6,
            'sieben' => 7,
            'acht' => 8,
            'neun' => 9,
            'zehn' => 10,
            'bube' => 10,
            'dame' => 10,
            'koenig' => 10,
            'ass' => [1, 0]
        ],
        'karo' => [
            'zwei' => 2,
            'drei' => 3,
            'vier' => 4,
            'fuenf' => 5,
            'sechs' => 6,
            'sieben' => 7,
            'acht' => 8,
            'neun' => 9,
            'zehn' => 10,
            'bube' => 10,
            'dame' => 10,
            'koenig' => 10,
            'ass' => [1, 0]
        ],
        'kreuz' => [
            'zwei' => 2,
            'drei' => 3,
            'vier' => 4,
            'fuenf' => 5,
            'sechs' => 6,
            'sieben' => 7,
            'acht' => 8,
            'neun' => 9,
            'zehn' => 10,
            'bube' => 10,
            'dame' => 10,
            'koenig' => 10,
            'ass' => [1, 0]
        ]
    ];


function get_random_card(): int
{
    global $card_deck, $card_values, $card_colors;
    $card_color = array_rand($card_deck);
    $card_numb = array_rand($card_deck[$card_color]);
    $card_value = -1;
    if($card_numb === 'ass'){
        $ass_value = rand(0, 1);
        $card_value = $card_deck[$card_color]['ass'][$ass_value];
        unset($card_deck[$card_color][$card_numb]);
        return $card_value;
    }
    $card_value = $card_deck[$card_color][$card_numb];
    unset($card_deck[$card_color][$card_numb]);
    return $card_value;
}
function dealCards(): array{

    $drawnCards = [];
    for($i = 0; $i < 2;$i++){
       $drawnCards[] = get_random_card();
    }
    return $drawnCards;
}

function whoWon(array $playerCards, array $dealerCards): int{
    $valuePlayer = array_sum($playerCards);
    $valueDealer = array_sum($dealerCards);
    
    if ($valueDealer === 21) {
        return -1;
    }
    if ($valuePlayer === 21) {
        return 1;
    }
    if(getDiff($valuePlayer) < getDiff($valueDealer)){
        return 1;
    }
    if (getDiff($valuePlayer) > getDiff($valueDealer) || getDiff($valueDealer) === getDiff($valuePlayer)){
        return -1;
    }
    return 0;
}
function getDiff(int $cardNum){
    return $cardNum > 21 ? $cardNum - 21 : 21 - $cardNum;
}

function game():string{
    $playerPoints = 0;
    $dealerPoints = 0;
    $playerCards = [];
    $dealerCards = [];
    for($i = 0; $i < 5; $i++){
        $playerCards = dealCards();
        $dealerCards = dealCards();
        $winner = whoWon($playerCards, $dealerCards);
        if($winner === 0){
            return 'fehler';
        }
        if($winner === 1) {
            $playerPoints++;
        }
        if($winner === -1){
            $dealerPoints++;
        }
        echo 'Player: ' . $playerPoints . ' vs ' . 'Dealer: ' . $dealerPoints;
        echo '<br>';
        
    }
    return ($playerPoints > $dealerPoints) ? 'Spieler hat gewonnen' : 'Dealer hat gewonnen';
}
game();
