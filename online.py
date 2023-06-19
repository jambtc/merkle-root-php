import hashlib

def merkle_root(data):
     # Se il numero di elementi è dispari, duplica l'ultimo elemento
    if len(data) % 2 != 0:
        data.append(data[-1])

    # Calcola gli hash dei singoli elementi
    merkle_tree = [hashlib.sha256(element.encode()).hexdigest() for element in data]

    # Calcola gli hash intermedi
    while len(merkle_tree) > 1:
        level = []
        for i in range(0, len(merkle_tree), 2):
            left = merkle_tree[i]
            right = merkle_tree[i + 1] if i + 1 < len(merkle_tree) else left
            combined = left + right
            level.append(hashlib.sha256(combined.encode()).hexdigest())
        merkle_tree = level

    return merkle_tree[0]

elements = [
	'2b44e6ec8a82f17f87f17c62b7c10b98afb0e84d8247417c7e276a438ae81d1b', 
	'2b44e6ec8a82f17f87f17c62b7c10b98afb0e84d8247417c7e276a438ae81d1b', 
	'2b44e6ec8a82f17f87f17c62b7c10b98afb0e84d8247417c7e276a438ae81d1b', 
	'2b44e6ec8a82f17f87f17c62b7c10b98afb0e84d8247417c7e276a438ae81d1b', 
	'5f2fb9087b45d6a030b1827a21dcd1816d24fec6833afff8183bafbee95e72a0'
];

result = merkle_root(elements)
print("Merkle root: " + result)