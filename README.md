# Projeto gerar NIS

Este é um projeto PHP puro com um banco de dados MySQL. Ele inclui uma parte para a criação de tabelas no banco de dados e exemplos de solicitações HTTP.

## Instalação

1. Certifique-se de ter o PHP instalado em sua máquina. Você pode baixá-lo em [php.net](https://www.php.net/downloads).
2. Certifique-se de ter o MySQL instalado em sua máquina. Você pode baixá-lo em [mysql.com](https://www.mysql.com/downloads/).
3. Você pode optar por baixar o [laragon](https://laragon.org/download/index.html)
4. Clone este repositório:

    ```
    git clone https://github.com/rafaelabc/api-nis
    ```

5. Importe o arquivo SQL `create-table-cidadao.sql` para o seu banco de dados MySQL.

## Configuração do Banco de Dados

1. Edite o arquivo `db.class.php` e insira as credenciais do seu banco de dados:

    ```php
    <?php
        $host = 'localhost';
        $user = 'seu-usuario';
        $pass = 'sua-senha';
        $base = 'seu-banco-de-dados';

    ```

## Uso


- `[POST] /cidadao`: Cria um novo cidadão a partir do nome e gera um NIS para ele. O nome deve ser passado pelo body na requisição.
- `[GET] /cidadao`: Busca todos os cidadãos e Nis já gerados
- `[GET] /cidadao/{NIS}`: Busca cidadão por NIS


