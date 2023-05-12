<?php
/**
 * Merkle Root Calculator
 * 
 * Author: Sergio Casizzone
 * Date: 03.05.2023
 */

class MerkleRootCalculator
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

    /**
     * Verifica il Merkle Root
     * 
     * La funzione verifica se i dati passati come argomento corrispondono al Merkle Root passato 
     * come secondo argomento. La funzione utilizza la funzione root per calcolare il Merkle Root 
     * e restituisce true se il Merkle Root calcolato corrisponde a quello passato come argomento.
     * 
     * @param array $data Array di hash
     * @param array $root merkle root
     * @return boolean 
     */
    public function verify(array $data, string $root): bool
    {
        return ($this->root($data) === $root);
    }
}
