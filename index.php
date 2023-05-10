<?php

require __DIR__ . '/src/MerkleRoot.php';

// carica il json del Qldb
$data_qldb = json_decode(file_get_contents('qldb.json'));

// carica il json della Blockchain
$data_blockchain = json_decode(file_get_contents('blockchain.json'));

// genero l'array di hash di qldb
foreach ($data_qldb as $data){
    $qldb[] = $data->document_hash;
}

// inizializzo la classe
$merkle = new MerkleRoot();

// genero il Merkle root con i dati da qldb
$root_qldb = $merkle->root($qldb);

echo "Merkle Root Calculator\n\n";
echo "Merkle root da Blockchain: $data_blockchain->merkle_root\n";
echo "Merkle root da QLDB: $root_qldb\n";
echo "Verifica Merkle root: " . ($merkle->verify($qldb, $data_blockchain->merkle_root) ? 'SUCCESSO' : 'FALLITO') . "\n";

