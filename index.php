<?php

require __DIR__ . '/src/MerkleRootCalculator.php';
require __DIR__ . '/func/functions.php';


echo "Merkle Root Calculator\n\n";

echo "Fai la tua scelta:\n\n";
echo "   1. Compara i Merkle Root\n";
echo "   2. Estrai il Merkle Root dal file QLDB\n";
echo "   3. Estrai il Merkle Root dal file Blockchain\n";
echo "   4. Mostra gli hash dei file\n";
$scelta = readline();

if ($scelta != '1' && $scelta != '2' && $scelta != '3' && $scelta != '4'){
    echo "\nScelta non consentita!\n\n";
    die();
}

// carico il contenuto dei file json
$qldb_json = loadFile('qldb.json');
$blockchain_json = loadFile('blockchain.json');

// Estraggo le informazioni dai file
$result = verificaMerkleRoot($qldb_json, $blockchain_json);
if ($scelta == '4'){
    unset($result['all_qldb_hashes']);
    echo '<pre>' . print_r($result, true) . '</pre>';

    die();
}


if ($scelta == '1'){
    foreach ($result['blockchain_data'] as $period => $merkleRoot) {
        // Inizializzo la classe e calcolo il Merkle root con gli hash ricavati dal qldb
        $merkle = new MerkleRootCalculator();
        $qldb_root = $merkle->root($result['qldb_hashes'][$period]);

        // stampo il risultato per singolo periodo
        echo "\nPeriodo: $period\n";
        echo "Merkle root da Blockchain: $merkleRoot\n";
        echo "Merkle root da QLDB: $qldb_root\n";
        echo "Verifica Merkle root: " . ($merkle->verify($result['qldb_hashes'][$period], $merkleRoot) ? 'SUCCESSO' : 'FALLITO') . "\n";
    }
    
    die();
}

if ($scelta == '2'){
    foreach ($result['all_qldb_hashes'] as $period => $hashes) {
        // Inizializzo la classe e calcolo il Merkle root con gli hash ricavati dal qldb
        $merkle = new MerkleRootCalculator();
        $qldb_root = $merkle->root($hashes);

        // stampo il risultato per singolo periodo
        echo "\nPeriodo: $period\n";
        echo "Merkle root da QLDB: $qldb_root\n";
    }

    die();
}

if ($scelta == '3') {
    echo "Merkle root estratto da blockchain.json:";
    $blockchainResults = (array) $blockchain_json->json_results;

    // genero l'array con i merkle root dalla blockchain suddivisi per anno/mese
    foreach ($blockchainResults as $period => $merkleRootByPeriod) {
        // funzione che estrae date dal period salvato su blockchain
        $dateFromPeriod = dateFromPeriod($period);

        // stampo il risultato per singolo periodo
        echo "\nPeriodo: " . $dateFromPeriod->startDate->format('Y-m') . "\n";
        echo "Merkle root da file: $merkleRootByPeriod\n";
    }

    echo "\nMerkle root calcolato da file:";
    foreach ($result['blockchain_data'] as $period => $merkleRoot) {
        // stampo il risultato per singolo periodo
        echo "\nPeriodo: $period\n";
        echo "Merkle root da Blockchain: $merkleRoot\n";
    }

    die();
}