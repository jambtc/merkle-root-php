<?php
class MerkleRoot
{
    /**
     * Calcola il Merkle Root
     * 
     * La funzione calcola il Merkle Root a partire dai dati passati come argomento, utilizzando 
     * la funzione hash SHA256 per calcolare gli hash dei singoli elementi e degli hash intermedi. 
     * Viene restituito il Merkle Root, ovvero l'hash della radice del Merkle Tree.
     * 
     * @param array $data Array di hash
     * @return string Merkle root
     */
    public function root(array $data): string
    {
        // Se il numero di elementi è dispari, duplica l'ultimo elemento
        if (count($data) % 2 != 0) {
            $data[] = end($data);
        }

        // Calcola gli hash dei singoli elementi
        foreach ($data as $element) {
            $merkle_tree[] = hash('sha256', $element);
        }

        // Calcola gli hash intermedi
        while (count($merkle_tree) > 1) {
            $level = [];
            for ($i = 0; $i < count($merkle_tree); $i += 2) {
                $left = $merkle_tree[$i];
                $right = isset($merkle_tree[$i + 1]) ? $merkle_tree[$i + 1] : $left;
                $level[] = hash('sha256', $left . $right);
            }
            $merkle_tree = $level;
        }

        return $merkle_tree[0];
    }
    
}

// array di dati
$data = [
    '2b44e6ec8a82f17f87f17c62b7c10b98afb0e84d8247417c7e276a438ae81d1b',
    '2b44e6ec8a82f17f87f17c62b7c10b98afb0e84d8247417c7e276a438ae81d1b',
    '2b44e6ec8a82f17f87f17c62b7c10b98afb0e84d8247417c7e276a438ae81d1b',
    '2b44e6ec8a82f17f87f17c62b7c10b98afb0e84d8247417c7e276a438ae81d1b',
    '5f2fb9087b45d6a030b1827a21dcd1816d24fec6833afff8183bafbee95e72a0'
];

// inizializzo la classe
$merkle = new MerkleRoot();

// genero il Merkle root
$root = $merkle->root($data);


echo "Merkle root: $root\n";
