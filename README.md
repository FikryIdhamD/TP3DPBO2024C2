# TP3DPBO2023
Saya Fikry Idham Dwiyana NIM 2101294 mengerjakan TP3 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Deskripsi Tugas
Buatlah program menggunakan bahasa pemrograman PHP dengan spesifikasi sebagai berikut:
* Tema program bebas, Namun tidak boleh mengadaptasi tema program ormawa seperti pada modul ini
* Menggunakan minimal 3 buah tabel (kelas)
* Terdapat proses Create, Read, Update, dan Delete data pada setiap tabel
* Minimal Memiliki fungsi pencarian dan pengurutan data (kata kunci bebas) pada salah satu tabel
* Menggunakan template/skin form tambah data dan ubah data yang sama
* 1 tabel pada database ditampilkan dalam bentuk bukan tabel, 2 tabel atau lebih sisanya ditampilkan dalam bentuk tabel (seperti contoh saat praktikum)
* Menggunakan template/skin tabel yang sama untuk menampilkan tabel


## Desaign Program

![Palworld_Database](https://github.com/FikryIdhamD/TP3DPBO2024C2/assets/147605722/5318d956-f97c-4800-89ab-85feb124ba9d)


Pada program ini terdapat 3 tabel yaitu:
1. Tabel Pal yang berisi 7 atribut dengan atribut `pal_id` sebagai primary keynya. Tabel ini memiliki relasi many to one dengan tabel Type dimana foreign keynya ada pada atribut`type_id` dan juga berelasi many to one dengan tabel Habitat dimana foreign keynya ada pada atribut `habitat_id`.
2. Tabel Type berisi 2 atribut dengan atribut `type_id` sebagai primary keynya. Tabel ini memiliki relasi one to many dengan tabel Pal
3. Tabel Habitat berisi 2 atribut dengan atribut `habitat_id` sebagai primary keynya. Tabel ini memiliki relasi one to many dengan tabel Pal.

Dokumentasi Video:

https://github.com/FikryIdhamD/TP3DPBO2024C2/assets/147605722/fe0ccb7e-2a3c-438d-ae97-93ca5bd9ba48


