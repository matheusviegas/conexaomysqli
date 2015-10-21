
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

<br />
#####DBCreate( ) - INSERT [Inserir dados no banco]

Recebe: 2 parâmetros obrigatórios e 1 opcional<br />
__Parâmetro 1[Obrigatório]:__ tabela<br />
__Parâmetro 2[Obrigatório]:__ array com os dados no formato: __'campo' => 'valor'__
__Parâmetro 3[Opcional]:__ InsertID [true ou false]
<br />
Retorna: __true__ se o registro foi inserido com sucesso ou __false__ se ocorreu algum erro.<br />
Caso o parâmetro __InsertID__ seja passado como true, o método retorna o __ID__ do registro inserido. Caso não seja passado nenhum valor para o parâmetro __InsertID__, ele terá por padrão o valor _false_.

Exemplo:


```php
    $usuario = array(
    'nome' => 'Nome do Usuario',
    'email' => 'usuario@email.com',
    'idade' => 18
    );

    $inserir = DBCreate('usuarios', $usuario);
```

<br />

#####DBDelete( ) - DELETE [Deletar dados do banco]

Recebe: 1 parâmetro obrigatório e 1 opcional<br />
__Parâmetro 1[Obrigatório]:__ tabela<br />
__Parâmetro 2[Opcional]:__ Condições [WHERE]
<br />
Retorna: __true__ se o registro foi deletado com sucesso ou __false__ se ocorreu algum erro.<br />
Lembre-se: O 2º parâmetro, embora opcional, quando não passado, excluirá __TODOS__ os registros da tabela.



Exemplo:

```php
    $deletar = DBDelete('usuarios', 'id = 1');
```

<br />

#####DBUpDate( ) - UPDATE [Edita dados do banco]

Recebe: 3 parâmetros obrigatórios e 1 opcional<br />
__Parâmetro 1[Obrigatório]:__ tabela<br />
__Parâmetro 2[Obrigatório]:__ array com os dados no formato: __'campo' => 'valor'__ <br />
__Parâmetro 3[Obrigatório]:__ condições [WHERE] <br />
__Parâmetro 4[Opcional]:__ InsertID [true ou false]
<br />
Retorna: __true__ se o registro foi alterado com sucesso ou __false__ se ocorreu algum erro.<br />
Caso o parâmetro __InsertID__ seja passado como true, o método retorna o __ID__ do registro alterado. Caso não seja passado nenhum valor para o parâmetro __InsertID__, ele terá por padrão o valor _false_.

Exemplo:

```php
    $usuarioEditado = array(
    'nome' => 'Nome do Usuario Editado',
    'email' => 'usuarioeditado@email.com',
    'idade' => 25
    );
    
    //Exemplo 1: Retorna o ID do registro alterado
    $editar = DBUpDate('usuarios', $usuarioEditado, 'id = 1', true);
    
    //Exemplo 2: Retorna true ou false
    $editar = DBUpDate('usuarios', $usuarioEditado, 'id = 1'); 
```


<br />

#####DBRead( ) - SELECT [Lista os dados do banco]

Recebe: 1 parâmetro obrigatório e 2 opcionais<br />
__Parâmetro 1[Obrigatório]:__ tabela<br />
__Parâmetro 2[Opcional]:__ condições [WHERE] <br />
__Parâmetro 3[Opcional]:__ colunas específicas <br />

<br />
Retorna: um __array__ no formato __'campo' => 'valor'__ se a consulta retornar algum registro ou __null__ se a consulta não retornar nada.<br />
Use um _foreach_ para obter os dados do array.

Exemplo:

```php
   //Exemplo 1: Retorna todos os registros da tabela usuarios
   $listar = DBRead('usuarios');
   
   //Exemplo 2: Retorna o nome e a idade do usuário com o ID = 1
   $listar = DBRead('usuarios', 'WHERE id = 1', 'nome, idade');
   
   //Exemplo 3: Retorna o nome e a idade de todos os usuários
   $listar = DBRead('usuarios', '', 'nome, idade');
   
   //Exemplo 4: Retorna todos os campos do usuário com o ID = 1
   $listar = DBRead('usuarios', 'WHERE id = 1');
   
   
   //Obtendo os dados com o foreach
   foreach($listar as $dados){
      echo "Nome: " . $dados['nome'] . "<br />";
      echo "Email: " . $dados['email'] . "<br />";
      echo "Idade: " . $dados['idade'] . "<br />";
   }
   
```

