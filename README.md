# Projeto de Gestão de Mercado

Este repositório contém um sistema de gestão de mercado utilizando Docker para containerização, PHP para desenvolvimento backend, e outras tecnologias para suportar o ambiente de desenvolvimento.

## Configuração do Ambiente

### Requisitos

Certifique-se de ter os seguintes requisitos instalados na sua máquina:

- Docker
- Docker Compose
- PHP 8.3

### Passos Iniciais

1. **Clonando o Repositório**

   Clone este repositório para sua máquina local:

   ```bash
   git clone https://github.com/Maiconsmendonca/gestaomercado.git
   cd gestaomercado
    ```


2. **Configuração do Ambiente com Docker**

Execute o Docker Compose para configurar e iniciar o serviço de mysql (opcional se acaso nao tiver um servidor mysql instalado):
    
```bash
    docker compose up -d
```

3. **Configurando o Arquivo `.env`**

Copie o arquivo `.env-example` para `.env` e ajuste conforme necessário:

```bash
cp .env-example .env
```

4. **Iniciando servidor php**

Execute o seguinte comando para iniciar o servidor PHP:

```bash
php -S localhost:8000
```

Edite o arquivo `.env` para configurar as variáveis de ambiente conforme seu ambiente local e de desenvolvimento.
Em DB_HOST coloque o ip ou nome do seu servidor mysql, se for o container docker coloque o ip.

5. **Gerando a Chave de Aplicativo**

Execute o seguinte comando dentro do container PHP para gerar a chave de aplicativo automaticamente:

```bash
php ./scripts/generate_key.php
```

Este comando gera uma chave de 32 bytes e a adiciona automaticamente ao seu arquivo .env.

### Configurando o frontend

Para configurar o frontend, você precisa instalar as dependências do Node.js e compilar os arquivos de frontend.

1. **Instalando Dependências**

   Instale as dependências do Node.js executando o seguinte comando dentro da pasta gestaomercado/frontend:

   ```bash
   npm install
   ```

2. **Iniciando servidor Node**

    Inicie o servidor Node.js executando o seguinte comando dentro da pasta gestaomercado/frontend:
    
    ```bash
    npm start
    ```
    
    O servidor Node.js será iniciado e você poderá acessar o frontend através do navegador em http://localhost:8080.

### Parando os Serviços

Para parar os serviços, execute o seguinte comando:

```bash
docker compose down
```

### Migrando database

Para executar o script setup_database.php, você pode usar a linha de comando ou um navegador, dependendo
de como seu ambiente de desenvolvimento está configurado. Se estiver usando a linha de comando,
navegue até o diretório do seu projeto e execute:

```bash
php setup_database.php
```

ou voce pode copiar as queries do arquivo setup_database.sql e executar no seu banco de dados.

### Endpoints para api

se quiser acessar os endpoints e testar a api segue os endpoints:

# Gestão Mercado API

## Product

### Listar Todos Produtos

- **Método:** `GET`
- **URL:** `http://localhost:8080/api/product`

### Obter Detalhes de um Produto Específico

- **Método:** `GET`
- **URL:** `http://localhost:8080/api/product/{id}`

### Criar um Novo Produto

- **Método:** `POST`
- **URL:** `http://localhost:8080/api/product`
- **Request Headers:**
   - `Content-Type: application/json`
- **Request Body:**
  ```json
  {
    "name": "Produto um",
    "productTypeId": 1,
    "price": 80.90
  }
