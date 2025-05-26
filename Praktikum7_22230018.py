from Crypto.Cipher import AES
from Crypto.Util.Padding import pad, unpad
from Crypto.Random import get_random_bytes

# Input string
plaintext = "Sabbe Satta Bhavantu Sukhitatta"
key = b'RetnoDwiPangesti'

# Convert plaintext ke bytes dan pad ke blok 16 byte
data = plaintext.encode('utf-8')
data_padded = pad(data, AES.block_size)

# Enkripsi
cipher = AES.new(key, AES.MODE_ECB) # MODE_ECB untuk AES dasar
ciphertext = cipher.encrypt(data_padded)

# Deskripsi
cipher_dec = AES.new(key, AES.MODE_ECB)
decrypted = unpad(cipher_dec.decrypt(ciphertext), AES.block_size)

print("Plaintext asli  :", plaintext)
print("Ciphertext      :", ciphertext.hex())
print("Hasil deskripsi :", decrypted.decode('utf-8'))