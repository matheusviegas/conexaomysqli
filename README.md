
#Conexão com MySQL (Usando mysqli)

###Configurações Básicas

#####Primeiro Passo
Edite o arquivo config.php conforme os dados do seu projeto:

```php
define('DB_HOSTNAME', 'servidor'); // Servidor (Geralmente é localhost)
define('DB_USERNAME', 'usuario'); // Usuario do Banco
define('DB_PASSWORD', 'senha'); // Senha
define('DB_DATABASE', 'banco'); // Nome do Banco
define('DB_PREFIX', 'prefixo'); // Prefixo das Tabelas (Se não estiver usando prefixo, deixe como null)
define('DB_CHARSET', 'utf8'); // Codificação

```



#####Segundo Passo

Inclua a classe no seu código usando a seguinte sintaxe:
```php
require "ConexaoMysqli.php";
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

#####Criando uma instância da classe para executarmos as consultas ao banco
Vamos instanciar um objeto da classe __ConexaoMysqli__. Usaremos este objeto para os exemplos abaixo.

```php
$con = new ConexaoMysqli;
```

#####insert( ) - INSERT [Inserir dados no banco]

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

    $inserir = $con->insert('usuarios', $usuario);
```

<br />

#####delete( ) - DELETE [Deletar dados do banco]

Recebe: 1 parâmetro obrigatório e 1 opcional<br />
__Parâmetro 1[Obrigatório]:__ tabela<br />
__Parâmetro 2[Opcional]:__ Condições [WHERE]
<br />
Retorna: __true__ se o registro foi deletado com sucesso ou __false__ se ocorreu algum erro.<br />
Lembre-se: O 2º parâmetro, embora opcional, quando não passado, excluirá __TODOS__ os registros da tabela.



Exemplo:

```php
    // Deleta o usuário com o ID = 1
    $deletar = $con->delete('usuarios', 'id = 1');
```

<br />

#####update( ) - UPDATE [Edita dados do banco]

Recebe: 3 parâmetros obrigatórios<br />
__Parâmetro 1[Obrigatório]:__ tabela<br />
__Parâmetro 2[Obrigatório]:__ array com os dados no formato: __'campo' => 'valor'__ <br />
__Parâmetro 3[Obrigatório]:__ condições [WHERE] <br />
<br />
Retorna: __true__ se o registro foi alterado com sucesso ou __false__ se ocorreu algum erro.<br />

Exemplo:

```php
    $usuarioEditado = array(
    'nome' => 'Nome do Usuario Editado',
    'email' => 'usuarioeditado@email.com',
    'idade' => 25
    );
    
    //Exemplo: Retorna true ou false
    $editar = $con->update('usuarios', $usuarioEditado, 'id = 1'); 
```


<br />

#####select( ) - SELECT [Lista os dados do banco]

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
   $listar = $con->select('usuarios');
   
   //Exemplo 2: Retorna o nome e a idade do usuário com o ID = 1
   $listar = $con->select('usuarios', 'WHERE id = 1', 'nome, idade');
   
   //Exemplo 3: Retorna o nome e a idade de todos os usuários
   $listar = $con->select('usuarios', '', 'nome, idade');
   
   //Exemplo 4: Retorna todos os campos do usuário com o ID = 1
   $listar = $con->select('usuarios', 'WHERE id = 1');
   
   
   //Obtendo os dados com o foreach
   foreach($listar as $dados){
      echo "Nome: " . $dados['nome'] . "<br />";
      echo "Email: " . $dados['email'] . "<br />";
      echo "Idade: " . $dados['idade'] . "<br />";
   }
   
```

<br />

#####executar( ) - [Executa uma consulta personalizada no banco]
Caso você queira fazer uma consulta que NÃO possa ser feita pelos métodos [select(), insert(), update() e delete()] da nossa classe, por exemplo, uma consulta com __INNER JOIN__, este método suprirá essa necessidade.

Recebe: 1 parâmetro obrigatório<br />
__Parâmetro 1[Obrigatório]:__ consulta personalizada<br />

<br />
Retorna: __true__ ou __false__ se a consulta for do tipo (insert, update ou delete).<br />
Se a consulta for um SELECT: <br />
Retorna: um __array__ no formato __'campo' => 'valor'__ se a consulta retornar algum registro ou __null__ se a consulta não retornar nada.<br />
Use um _foreach_ para obter os dados do array.

Exemplo:

```php
    $consultaPersonalizada = "SELECT posts.nome, posts.conteudo, comentarios.comentario FROM posts INNER JOIN comentarios ON posts.id = comentarios.idPost;

    $consulta = $con->executar($consultaPersonalizada);
    
    foreach($consulta as $dados){
       echo "Olá " . $dados['login'];
    }
```
