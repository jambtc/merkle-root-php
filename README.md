# Merkle Root Calculator

## Informazioni
Il presente software effettua il Merkle Root di una serie di hash e ne confronta il contenuto con un Merkle Root fornito.

In particolare permette di confrontare il contenuto presente su QLDB con quello presente su blockchain.

Seguendo questa guida è possibile eseguire in autonomia il predetto controllo. 


## Prerequisiti

- php


## Guida

- Clona questo software oppure scaricalo da questo <a href="https://github.com/jambtc/merkle-root-php/releases/tag/v1.1">link</a> in una cartella sul tuo pc.
- Copia i file json sia del Qldb che della Blockchain sotto questa stessa cartella. Nel file `blockchain.json` lascia soltanto il merkle root che vuoi verificare. Nel file `qldb.json` lascia soltanto gli hash relativi al periodo che vuoi verificare. Ricordati di eliminare l'ultima virgola per evitare errori di formattazione del formato json.
- Apri una finestra shell o prompt e digita i seguenti comandi:

```bash
cd <nomecartella>
php index.php
```

Dovresti ottenere una risposta di questo tipo:

```bash
Merkle Root Calculator

Merkle root da Blockchain: 36d12cb8e28699290b0cef1ea5a1fadfd2c6bc4afad02633330e86b197b61884
Merkle root da QLDB: 36d12cb8e28699290b0cef1ea5a1fadfd2c6bc4afad02633330e86b197b61884
Verifica Merkle root: SUCCESSO
```
