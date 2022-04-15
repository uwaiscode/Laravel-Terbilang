# Laravel Terbilang

Cara sederhana untuk merubah nilai angka menjadi tulisan terbilang. Pustaka ini bisa anda gunakan untuk project seperti raport, pembayaran dan lainnya.

## Cara Pemasangan

> $ composer require uwaiscode/laravelterbilang

## Cara Penggunaan

```php

use Uwaiscode\Laravelterbilang\Converter;


Converter::getConversion(20.5);
```

#### Akan menampilkan : 

> Dua Puluh Koma Lima