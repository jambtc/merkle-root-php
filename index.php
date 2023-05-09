<?php

require __DIR__ . '/src/MerkleRoot.php';

// carica il json del Qldb
$json_qldb = file_get_contents('qldb.json');

// Decodifica del contenuto JSON in un oggetto PHP
$data_qldb = json_decode($json_qldb);

// carica il json della Blockchain
$json_blockchain = file_get_contents('blockchain.json');

// Decodifica del contenuto JSON in un oggetto PHP
$data_blockchain = json_decode($json_blockchain);

// genero l'array di hash di qldb
foreach ($data_qldb as $data){
    $qldb[] = $data->document_hash;
}

// genero l'array di hash di qldb
foreach ($data_blockchain as $data) {
    $blockchain[] = $data->document_hash;
}

// inizializzo la classe
$merkle = new MerkleRoot();

// genero il Merkle root con i dati da qldb
$root = $merkle->root($qldb);


echo "Verifica del Merkle Root\r\n";
echo "Merkle root: $root\r\n";
echo "Verifica Merkle root: " . ($merkle->verify($blockchain, $root) ? 'SUCCESSO' : 'FALLITO') . "\r\n";

