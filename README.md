# Auto Load More CodeIgniter4

Import **countries.sql** (contoh data yang digunakan) yang terletak pada folder **database** ke database kalian.<br/>
Ubah nama file **env** jadi **.env**. Lalu pastikan dbhost, dbuser, dbpass, dan dbname pada file **.env** telah benar, agar bisa terkoneksi dengan database nantinya.

lalu jalankan ``` php spark serve ``` dan buka dengan url (contoh: http://localhost:8080/load_more)

Dan coba scroll tampilan hingga paling bawah. Dan data akan terload secara otomatis.<br/>
Data **countries** diambil dari: https://www.html-code-generator.com/mysql/country-name-table
