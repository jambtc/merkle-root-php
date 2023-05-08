# merkle-root-php
Merkle Root Calculator per php


## Usage

```php
require __DIR__ . '/src/MerkleRoot.php';


// array di dati
$data = ['abc', 'cde', 'efg', 'jki', 'lmn'];

// inizializzo la classe
$merkle = new MerkleRoot();

// genero il Merkle root
$root = $merkle->root($data);


echo "Merkle root: $root\n";
echo "Verifica Merkle root: " . ($merkle->verify($data, $root) ? 'SUCCESSO' : 'FALLITO') . "\n";
```

Nell'esempio, il metodo `root` viene utilizzata per calcolare il Merkle Root a partire dalla lista di dati 'abc', 'cde', 'efg', 'jki', 'lmn', e viene stampato il risultato.

Successivamente, il metodo `verify` viene utilizzata per verificare se i dati 'abc', 'cde', 'efg', 'jki', 'lmn' corrispondono al Merkle Root calcolato e viene stampato il risultato della verifica.
