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
   git clone https://github.com/Maiconsmendonca/gestaomercado.git
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
php ./scripts/generate_key.php
```

Este comando gera uma chave de 32 bytes e a adiciona automaticamente ao seu arquivo .env.

### Usando o Sistema

Depois de configurar o ambiente conforme acima,
você pode acessar o sistema através do navegador usando:
http://localhost.

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

