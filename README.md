
#Conexão com MySQL (Usando mysqli)

###Configurações Básicas

#####Primeiro Passo
Edite o arquivo config.php conforme os dados do seu projeto:

```php
define('DB_HOSTNAME', 'servidor'); // Servidor (Geralmente é localhost)
define('DB_USERNAME', 'usuario'); // Usuario do Banco
define('DB_PASSWORD', 'senha'); // Senha
define('DB_DATABASE', 'banco'); // Nome do Banco
define('DB_PREFIX', 'prefixo'); // Prefixo das Tabelas
define('DB_CHARSET', 'utf8'); // Codificação

```



#####Segundo Passo

Inclua os arquivos no seu código usando a seguinte sintaxe:
```php
require "config.php";
require "connection.php";
require "database.php";
```


###Fazendo Consultas no Banco (CRUD)<br />

Usaremos a tabela abaixo para exemplificar o uso dos métodos do arquivo __database.php__
<br />

>######Tabela usuarios
__id__ - INT, Chave Primária e Auto Increment<br />
__nome__ - VARCHAR e NOT NULL<br />
__email__ - VARCHAR e NOT NULL<br />
__idade__ - INT e NOT NULL<br />


id            | nome            | email              | idade
------------- | ----------------|--------------------|--------
 1            | Usuario Exemplo | usuario@email.com  | 18


#####DBCreate( ) - INSERT [Inserir dados no banco]

Recebe: 2 argumentos<br />
__Argumento 1:__ tabela<br />
__Argumento 2:__ array com os dados no formato: __'campo' => 'valor'__
<br />
Retorna: __true__ se o registro foi inserido com sucesso ou __false__ se ocorreu algum erro.

Exemplo:


```php
    $usuario = array(
    'nome' => 'Nome do Usuario',
    'email' => 'usuario@email.com',
    'idade' => 18
    );

    $gravar = DBCreate('usuarios', $usuario);
```

