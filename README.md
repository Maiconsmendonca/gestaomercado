# Projeto de Gestão de Mercado

Este repositório contém um sistema de gestão de mercado utilizando Docker para containerização, PHP para desenvolvimento backend, e outras tecnologias para suportar o ambiente de desenvolvimento.

## Configuração do Ambiente

### Requisitos

Certifique-se de ter os seguintes requisitos instalados na sua máquina:

- Docker
- Docker Compose
- PHP (opcional, dependendo das necessidades específicas do desenvolvimento)

### Passos Iniciais

1. **Clonando o Repositório**

   Clone este repositório para sua máquina local:

   ```bash
   git clone https://github.com/seu-usuario/gestaomercado.git
   cd gestaomercado
    ```


2. **Configuração do Ambiente com Docker**

Execute o Docker Compose para configurar e iniciar os serviços necessários:
    
```bash
    docker compose up -d
```

Isso criará e iniciará os containers Docker para PHP, Nginx, MySQL e Node.js.

3. **Instalando Dependências PHP com Composer**

Acesse o container PHP para instalar as dependências PHP usando o Composer:

```bash
docker compose exec php composer install
```

4. **Configurando o Arquivo `.env`**

Copie o arquivo `.env-example` para `.env` e ajuste conforme necessário:

```bash
cp .env-example .env
```

Edite o arquivo `.env` para configurar as variáveis de ambiente conforme seu ambiente local e de desenvolvimento.

5. **Gerando a Chave de Aplicativo**

Execute o seguinte comando dentro do container PHP para gerar a chave de aplicativo automaticamente:

```bash
docker compose exec php php -r "require_once 'vendor/autoload.php'; use Dotenv\Dotenv; Dotenv::createImmutable(__DIR__)->load(); file_put_contents('.env', str_replace('APP_KEY=', 'APP_KEY=' . base64_encode(random_bytes(32)), file_get_contents('.env')));"
```

Este comando gera uma chave de 32 bytes e a adiciona automaticamente ao seu arquivo .env.

### Usando o Sistema

Depois de configurar o ambiente conforme acima, você pode acessar o sistema através do navegador usando http://localhost.

### Parando os Serviços

Para parar os serviços, execute o seguinte comando:

```bash
docker compose down
```