# Merkle Root Calculator

## Informazioni
Il presente software effettua il Merkle Root di una serie di hash e ne confronta il contenuto con un Merkle Root fornito.

In particolare permette di confrontare il contenuto presente su QLDB con quello presente su blockchain.

Seguendo questa guida è possibile eseguire in autonomia il predetto controllo. 

## Dettagli

Nel file blockchain.json è contenuto il merkle root di ciascun mese degli hash
generati e salvati nel qldb.
A regime avremo tanti merkle root, uno per ogni mese di attitivà.

L'operazione di verifica, pertanto, verrà eseguita estraendo per ciascun mese
gli hash dal qldb, eseguendone il merkle root e verificando che quest'ultimo
corrisponda a quello salvato in blockchain.

## Prerequisiti

- php 

### Installazione di php

Il modo più semplice di installare php è quello di scaricare xampp dal sito <https://www.apachefriends.org/it/download.html>


## Guida

- Clona questo software oppure scarica l'ultima versione da questo <a href="https://github.com/jambtc/merkle-root-php/releases/">link</a> in una cartella sul tuo pc.
- Copia i file json sia del Qldb che della Blockchain sotto questa stessa cartella.
- Apri una finestra shell o prompt e digita i seguenti comandi:

```bash
cd <nomecartella>
php index.php
```

Il software ti permette di selezionare 4 scelte: 

1. Compara i Merkle Root
2. Estrai il Merkle Root dal file QLDB
3. Estrai il Merkle Root dal file Blockchain
4. Mostra gli hash dei file


Selezionando la prima opzione, dovresti ottenere una risposta di questo tipo:

```bash
Merkle Root Calculator

Periodo: 2023-05
Merkle root da Blockchain: 36d12cb8e28699290b0cef1ea5a1fadfd2c6bc4afad02633330e86b197b61884
Merkle root da QLDB: 36d12cb8e28699290b0cef1ea5a1fadfd2c6bc4afad02633330e86b197b61884
Verifica Merkle root: SUCCESSO
```

## Verifica online in php

Se non si ha a disposizione un ambiente php installato, è possibile effettuare un controllo online
del merkle root. 
Si può utilizzare il sito <https://onlinephp.io/> e copiare al suo interno il contenuto del file `online.php`

E' necessario però modificare manualmente il contenuto dell'array `$data`, con i valori di hash che si vuole controllare dal file qldb.

## Verifica online in python

E' possibile anche usare uno script in python che funziona allo stesso modo.
Legge l'array elements e ne produce il merkle root. Il file da usare, in questo caso, è `online.py` e il sito online di test è: <https://www.programiz.com/python-programming/online-compiler/>
