# App Api 

## Clone o Repositório e acesse 
```
git clone https://github.com/isaquemenezes/test-devs-uefs.git
cd test-devs-uefs
```

## Atualize as variáveis de ambiente do arquivo .env e Configure seu Banco favorito(aqui estamos com Postgres):

## Docker 
1. Suba os containers do projeto
```
docker-compose up -d --build
```
2. Acesse 
 ```
 docker-compose exec app bash
 ```

3. Instalar as dependências
```
composer install
```

4. Gerar a key do projeto Laravel
```
php artisan key:generate
```

5. Execute as migrates
```
php artisan migrate
```

6. (Opcional) Rode as seeds:
```
php artisan db:seed
```

# API
## Teste a Aplicação | navegador| Postman| Ferramenta como o curl:
```
curl http://127.0.0.1:8000/
```

## Funcionalidades Implementadas 🚀

1. CRUD de **Usuários** :heavy_check_mark: <br> 
2. CRUD de **Posts** :heavy_check_mark: <br>
3. CRUD de **Tags** :heavy_check_mark: <br>
4. Tests Funcionalidades (requisições) Api :heavy_check_mark: <br>

# Api Endpoint

## Users

- **GET** api/users — Listar todos os usuários.
- **POST** api/users — Criar um novo usuário
```
{
    "name": "Pessoa Teste"
}
```
- **GET** api/users/{id} — Exibir detalhes de um usuário.
- **PUT/PATCH** api/users/{id} — Atualizar um usuário existente.
- **DELETE** api/users/{id} — Deletar um usuário.

## Posts
 
- **GET** api/posts — Listar todos os postss.
- **POST** api/posts — Criar um novo posts vinculado ao usuário
```
{
  "user_id": 1,
  "title": "Título do post",
  "body": "Conteúdo do post"
}
```

- **GET** api/posts/{id} — Exibir detalhes de um posts.
- **PUT/PATCH** api/posts/{id} — Atualizar um posts existente.
- **DELETE** api/posts/{id} — Deletar um posts.


## Tags

- **GET** api/tags — Listar todas as tagss.
- **POST** api/tags — Criar uma nova tags
- **GET** api/tags/{id} — Exibir detalhes de uma tags.
- **PUT/PATCH** api/tags/{id} — Atualizar uma tags existente.
- **DELETE** api/tags/{id} — Deletar uma tag.


1. - Testar a associação
    1.1 **POST** /api/posts/1/tags
    ```
    {
        "tags": [1, 2]
    }
    ```

## Testes com PHPUnit
```
php artisan test
```
ou Direto com PHPUnit
```
vendor/bin/phpunit
```
1. Testes Específicos
```
php artisan test --filter=PostApiTest
```

2. Teste pelo container
```
docker compose exec app php artisan test
```


## Notas
1. :warning: Atente Para testes via json(Postman) 
- Accept application/json
- Content-Type application/json

### Tecnologias :books:

- [Postman](https://www.postman.com/)
- [Visual Studio Code](https://code.visualstudio.com/)
- [Git](https://git-scm.com/)
- [GiHub](https://github.com/)
- [Laravel | 9](https://laravel.com/)
- [PHP | 8.2 ](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Docker](https://docs.docker.com//)
- [WSL](https://learn.microsoft.com/pt-br/windows/wsl/install/)
- [PostgreSQL](https://www.postgresql.org/)
- [Swagger](https://swagger.io/)




































# Teste Técnico para a vaga de Engenheiro de Software no projeto UEFS - Netra

Este desafio técnico é destinado aos candidatos à posição de Engenheiro de Software no projeto UEFS - NETRA. O objetivo é avaliar competências práticas em desenvolvimento de software por meio da criação de uma API RESTful utilizando PHP (Laravel 8 ou superior), um Sistema de Gerenciamento de Banco de Dados (SGBD) de sua escolha, e Docker.

O prazo para a realização do teste é de 5 dias corridos, e a entrega deve ser feita por meio de um repositório no GitHub.

Para participar, faça um fork deste repositório, aplique a solução proposta e envie para nossa análise.

---

## Escopo do Teste Técnico

Você deverá desenvolver uma API RESTful com as seguintes funcionalidades:

- CRUD de **Usuários**
- CRUD de **Posts**
- CRUD de **Tags**

### Regras de Relacionamento

- Um **usuário** pode ter várias **postagens**.
- Uma **postagem** pode conter várias **tags** (palavras-chave).

### Requisitos Técnicos do Projeto

- Todas as rotas devem seguir o padrão `/api`, por exemplo: `/api/posts`.
- Fornecer um `Dockerfile` e `docker-compose.yml` para execução do projeto.
- Incluir documentação(README) clara sobre como rodar o projeto localmente, como testar os endpoints, visão geral da arquitetura e estrutura do projeto e destaques sobre decisões técnicas e particularidades da implementação.

---

## Avaliação Técnica (durante o **teste prático**)

Serão avaliados os seguintes pontos conforme o nível de senioridade:

### Para Todos os Níveis

- Conhecimento e uso de recursos do Laravel  
- Familiaridade com Docker e Docker Compose  
- Organização, clareza e estrutura do código  
- Implementação funcional da API RESTful  
- Utilização adequada do banco de dados escolhido  

### Nível Júnior

- Fundamentos de lógica de programação  
- Conhecimento básico dos princípios SOLID  
- Adesão aos padrões PSR (estilo de código PHP)  
- Uso inicial de testes (PHPUnit ou Pest) — **não obrigatório**  

### Nível Pleno

- Lógica de programação mais estruturada  
- Aplicação consistente dos princípios SOLID  
- Implementação de testes unitários (PHPUnit ou Pest)  
- Boas práticas de performance e legibilidade do código  

### Nível Sênior

- Arquitetura bem definida e organização do projeto  
- Uso estratégico dos princípios SOLID em componentes reutilizáveis  
- Testes completos (unitários e, se possível, de integração)  
- Otimizações de performance no código e consultas  
- Documentação técnica clara e abrangente (API, arquitetura, setup)  
- Uso de boas práticas de versionamento e estruturação do repositório  

---

## Avaliação Complementar (durante a **entrevista técnica**)

Após a entrega e análise do teste prático, os candidatos que avançarem para a próxima etapa participarão de uma entrevista técnica, onde serão avaliados critérios como:

- Clareza na explicação de decisões técnicas  
- Capacidade de análise e resolução de problemas  
- Conhecimento sobre arquitetura de software e design de soluções  
- Abordagem colaborativa e visão de liderança técnica (para cargos mais seniores)  
- Nível de profundidade em testes, padrões, e boas práticas além do que foi entregue  

---

## Recursos Opcionais (recomendados, mas não obrigatórios)

- Documentação automática com Swagger ou Scribe  
- Interface gráfica simples para consulta dos dados (React, Vue, Blade, Livewire, etc.)  

---

## Retorno

Após a análise técnica:

- Se aprovado, entraremos em contato para a entrevista técnica.  
- Se não aprovado, forneceremos um retorno com os principais pontos de melhoria observados.

---

**Boa sorte!**  
Equipe de Desenvolvimento NETRA – Projeto UEFS
