#Sistema para escalações de time de futebol

Para instalar o sistema após baixar digitar no terminal:
composer install

Após isso é preciso configurar o banco de dados no .env

após configurar é preciso digitar

php artisan migrate --seed

após isso digite
php artisan serve

agora podemos entrar via navegador:

http://127.0.0.1:8000/login

após isso pode-se usar o login que já tem criado ou criar um novo:

Email: luisjustin72@gmail.com
Senha: 123

após isso deve-se criar a escalação, após isso pode-se visualizar relatórios e etc...

Endpoints de API:

API de relatório de escalações por atletas:
http://127.0.0.1:8000/api/reports/escalacoes_por_atetlas

API de relatŕoio de partidas disputadas:
http://127.0.0.1:8000/api/reports/partidas_disputadas