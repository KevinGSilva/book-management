<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Configurando projeto
- Executar os seguintes comandos na ordem
    - ```composer install```
    - ```cp .env.example .env```
    - ```php artisan key:generate```
    - ```php artisan storage:link```
    - ```php artisan migrate:fresh --seed```
    - ```npm install```
    - ```npm run build```
- Executar o comando ```php artisan show:users``` lista os usuarios para visualizar quais são admin ou não

- Configuração no .env
    - Adicionar no ``` APP_URL ``` a porta do servidor caso utilize o servidor nativo do Laravel, para que o retorno de arquivos funcione corretamente. Exemplo ```APP_URL=http://localhost:8000```.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
