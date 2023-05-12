<?php

require __DIR__ . '/src/MerkleRootCalculator.php';

/**
 * Questa funzione carica un file e ne restituisce il contenuto in formato json
 * 
 * @param string $filename
 * @return json 
 */
function loadFile($filename){
    // verifico l'esistenza del file
    if (file_exists($filename)) {
        $json = json_decode(file_get_contents($filename));
    } else {
        echo "Il file {$filename} non esiste.\n";
        die();
    }
    
    // verifico se il file è un json
    if ((json_last_error() === JSON_ERROR_NONE) == false) {
        echo "Il file {$filename} contiene un errore e non viene riconosciuto.\n";
        die();
    }
    return $json;
}

/**
 * Inizio della verifica
 */
echo "Merkle Root Calculator\n\n";

// carico il contenuto dei file json
$qldb_data = loadFile('qldb.json'); 
$blockchain_data = loadFile('blockchain.json'); 

// genero l'array di hash di qldb
foreach ($qldb_data as $data) $qldb_hashes[] = $data->document_hash; 

// prendo solo l'elemento 0 del json della blockchain
$blockchain_data = $blockchain_data[0]; 

// inizializzo la classe e calcolo il Merkle root con gli hash ricavati dal qldb
$merkle = new MerkleRootCalculator(); 
$qldb_root = $merkle->root($qldb_hashes); 

// stampo il risultato
echo "Merkle root da Blockchain: $blockchain_data->merkleRoot\n";
echo "Merkle root da QLDB: $qldb_root\n";
echo "Verifica Merkle root: " . ($merkle->verify($qldb_hashes, $blockchain_data->merkleRoot) ? 'SUCCESSO' : 'FALLITO') . "\n";

