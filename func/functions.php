<?php

/**
 * Funzione generiche
 * 
 * Author: Sergio Casizzone
 * Date: 18.06.2023
 */


/**
 * Questa funzione carica un file e ne restituisce il contenuto in formato json
 * 
 * @param string $filename
 * @return json 
 */
function loadFile($filename)
{
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
 * Questa funzione estrae il mese e l'anno dal periodo dal file blockchain.json
 * 
 * @param string $period
 * @return date in format yyyy-mm
 */
function dateFromPeriod($period){
    $dates = explode('__', $period);
    // echo '<pre>' . print_r($dates, true) . '</pre>';
    // exit;

    $startDate = \DateTime::createFromFormat('d-m-Y H:i:s', $dates[0] . ' 00:00:00');
    $finishDate = \DateTime::createFromFormat('d-m-Y H:i:s', $dates[1] . ' 23:59:59');
    // echo '<pre>' . print_r($startDate, true) . '</pre>';
    // echo '<pre>' . print_r($finishDate, true) . '</pre>';
    // exit;

    $result = new \stdClass;
    $result->startDate = $startDate;
    $result->finishDate = $finishDate;
    
    return $result;
}

/**
 * Questa funzione verifica entrambi i merkle root e restituisce gli array da stampare a video
 * 
 * @param string $qldb_json, $blockchain_json
 * @return array
 */
function verificaMerkleRoot($qldb_json, $blockchain_json)
{
    $blockchainResults = (array) $blockchain_json->json_results;
    // echo '<pre>' . print_r($blockchainResults, true) . '</pre>';
    // exit;

    // genero l'array con i merkle root dalla blockchain suddivisi per anno/mese
    foreach ($blockchainResults as $period => $merkleRootByPeriod) {
        // funzione che estrae date dal period salvato su blockchain
        $dateFromPeriod = dateFromPeriod($period);

        // estraggo dal file qldb solo gli hash del mese/anno elaborato
        foreach ($qldb_json as $qldb) {
            // data ricavata dal timestamp 
            $stringDate = date('Y-m-d H:i:s', $qldb->activity_timestamp);
            // data convertita in formato datetime
            $matchDate = new \DateTime($stringDate);

            // confronto la data del qldb con il periodo
            if ($matchDate >= $dateFromPeriod->startDate && $matchDate <= $dateFromPeriod->finishDate) {
                // se appartiene al periodo la salvo in array
                $qldb_hashes[$matchDate->format('Y-m')][] = $qldb->document_hash;
                // $timestamp_qldb_hashes[$qldb->activity_timestamp][] = $qldb->document_hash;

                // salvo anche le informazioni del merkle root della blockchain relative
                $blockchain_data[$matchDate->format('Y-m')] = $merkleRootByPeriod;
            }
            $all_qldb_hashes[$matchDate->format('Y-m')][] = $qldb->document_hash;

        }
    }

    // echo '<pre>' . print_r($timestamp_qldb_hashes, true) . '</pre>';
    // asort($timestamp_qldb_hashes);
    // echo '<pre>' . print_r($timestamp_qldb_hashes, true) . '</pre>';

    // exit;

    return [
        'qldb_hashes' => $qldb_hashes,
        'blockchain_data' => $blockchain_data,
        'all_qldb_hashes' => $all_qldb_hashes
    ];
}