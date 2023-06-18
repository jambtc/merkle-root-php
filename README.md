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


## Guida

- Clona questo software oppure scaricalo da questo <a href="https://github.com/jambtc/merkle-root-php/releases/tag/v1.2">link</a> in una cartella sul tuo pc.
- Copia i file json sia del Qldb che della Blockchain sotto questa stessa cartella.
- Apri una finestra shell o prompt e digita i seguenti comandi:

```bash
cd <nomecartella>
php index.php
```

Il software ti permette di selezionare 3 scelte: 

1. Verifica Merkle Root
2. Estrai i Merkle Root dal file QLDB
3. Estrai i Merkle Root dal file Blockchain

Dovresti ottenere una risposta di questo tipo:

```bash
Merkle Root Calculator

Periodo: 2023-05
Merkle root da Blockchain: 36d12cb8e28699290b0cef1ea5a1fadfd2c6bc4afad02633330e86b197b61884
Merkle root da QLDB: 36d12cb8e28699290b0cef1ea5a1fadfd2c6bc4afad02633330e86b197b61884
Verifica Merkle root: SUCCESSO
```
