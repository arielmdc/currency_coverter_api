## passo a passo
Clone Repositório
```sh
git clone https://github.com/arielmdc/currency_converter_api.git
```
Mover para a pasta
```sh
cd currency_converter_api
```

copie o .env example
```sh
cp .env.example .env
```

Monte o docker
```sh
docker-compose-up
```

Procure o id do container
```sh
docker ps 'find laravel container id'
```

Acesse o container
```sh
docker exec -u 0 -it 'larevel container id' bash
```

Instale as dependencias
```sh
composer install
```

Gerar key 
```sh
php artisan key:generate
```

Commands 
```sh
##inside containr: 
php artisan migrate:fresh --seed
##outside
docker exec 'id' php artisan migrate:fresh --seed
```

if permissions needed
```sh
sudo chmod -R 775
```

### BD dfault connction
```sh
type: mysql
host: 127.0.0.1
user: root
password:123456
port:3388
```

base url: [http://localhost:8989](http://localhost:8989)